<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use DB;
use OpenAI\Laravel\Facades\OpenAI;
use App\Models\Language;
use Auth;

class AI_Controller extends Controller
{

  public function __construct()
  {
    $this->client = new \GuzzleHttp\Client();
  }

  //Image Similarity
  public function getSimilarity() {

    try {
      $getMyID = $this->initImageSimilarity();
      $request = $this->client->get(env('AI_IMAGE_SIMILARITY_ENDPOINT').'initAISimilarity?domain='.url('/'));// Url of your choosing
      $response = json_decode($request->getBody(), true);
      $config =  config('imagesimilarity');
      return view("admin.AI.AI-image-similarity",compact('response','config'));
    } catch (\Exception $e) {

      $getMyID = 0;
      $response = [];
      $config =  config('imagesimilarity');

      return view("admin.AI.AI-image-similarity",compact('response','config'));
    }

  }

  function initImageSimilarity() {
    $currenturl = url('/');
  }

  public function setImageSimilarity(Request $request) {
    $val  =		"<?php \n";
    $val  .= 	"return [\n";
    $val  .= " 'ENABLE_IMAGE_SIMILARITY' => '".addslashes ($request->enable_disable)."'  ,\n";
    $val  .= 	"];\n";
    $filename = base_path().'/config/imagesimilarity.php';
    $fp=fopen($filename,"w+");
    fwrite($fp,$val);
    fclose($fp);
    return redirect()->route('get.AI-image-similarity')->with('success','Setting successfully updated');
  }

  public function createZipFile() {
    if(Auth::user()->hasRole('Super Admin')) {
      $zip = new \ZipArchive();
      $fileName = '/uploads/products.zip';

      //delete archive if already exists
      if (File::exists(public_path($fileName))) {
        unlink(public_path($fileName));
      }

      if ($zip->open(public_path($fileName), \ZipArchive::CREATE) == TRUE)
      {
          $files = File::files(public_path('/uploads/product'));
          foreach ($files as $key => $value){
              $relativeName = basename($value);
              $zip->addFile($value, $relativeName);
          }
          $zip->close();
      }
      if (File::exists(public_path($fileName))) {
        return ['status' => 1,'path' => public_path($fileName)];
      }
    }
    else {
      return ['status' => 0,'message' => 'Only Superadmin can perfome this task'];
    }
  }

  public function uploadZipFile(Request $request)
  {
    if(Auth::user()->hasRole('Super Admin')) {
      $zipFile = fopen(public_path('uploads/products.zip'), 'rb');

      $res = $this->client->request('POST', env('AI_IMAGE_SIMILARITY_ENDPOINT').'storeZipFile', [
        'multipart' => [
               [
                   'name'     => 'zipfile',
                   'contents' =>fopen(public_path('uploads/products.zip'), 'rb')
               ],
               [
                   'name'     => 'appID',
                   'contents' => $request->appID
               ],
           ]
        ]);

        $response = json_decode($res->getBody(), true);
        return $response;
    }
  }

  //Setting up model to search fast
  public function settingUpModel(Request $request)
  {
    if(Auth::user()->hasRole('Super Admin')) {
      $res = $this->client->request('POST', env('AI_IMAGE_SIMILARITY_ENDPOINT').'doIndexing', [
        'multipart' => [
               [
                   'name'     => 'appID',
                   'contents' => $request->appID
               ],
           ]
        ]);
        return $res;
      }
  }

  public function download(Request $request)
  {
        $zip = new \ZipArchive();
        $fileName = '/uploads/products.zip';

        //delete archive if already exists
        if (File::exists(public_path($fileName))) {
          unlink(public_path($fileName));
        }
        //
        if ($zip->open(public_path($fileName), \ZipArchive::CREATE) == TRUE)
        {
            $files = File::files(public_path('/uploads/product'));
            foreach ($files as $key => $value){
                $relativeName = basename($value);
                $zip->addFile($value, $relativeName);
            }
            $zip->close();
        }
        if (File::exists(public_path($fileName))) {

        }
      //  return response()->download(public_path($fileName));
    }

  //Chat GPT
  public function getChatGPT()
  {
    return view("admin.AI.chatGPT", ['config' => $this->getChatGPTConfig()]);
  }

  public function updateChatGPTConfig(Request $request)
  {
    if (Auth::user()->hasRole('Super Admin')) {
      $apiKey = DB::table('chatgpt_config')->first();
      $chatAPI = $request->api_key;
     if (empty($request->api_key) || str_contains($request->api_key, "*") == true) {
        $chatAPI = $apiKey->api_key;
      }

      DB::table('chatgpt_config')->truncate();
      DB::table('chatgpt_config')->insert([
        'enable' => $request->enable_disable,
        'api_key' => $chatAPI,
        'product_description_text' => $request->product_description_text,
        'blog_words_count' => $request->blog_words_count,
        'product_description_words_count' => $request->product_description_words_count,
        'blog_description_text' => $request->blog_description_text
      ]);

      return redirect()->back()->with('success', "Setting successfully updated");
    } else {
      return redirect()->back()->with('error', "Only Superadmin can perfome this task");
    }
  }

  //get description and short description from ChatGPT
  public function getContentFromChatGPT(Request $request)
  {
    $getConfig = $this->getChatGPTConfig();
    $keyword = $request->keyword;

    if ($getConfig->enable == true) {
      $language = Language::where('id', $request->language)->first();

      //if type product
      if ($request->type == 'product') {
        $askGPTShortDescString = 'Write a Short description for a  ' . $keyword . ' in 50 words';
        $askGPTDescString = str_replace('PRODUCT_NAME', $keyword . ' ', $getConfig->product_description_text);
        $askGPTDescString .= ' in ' . $getConfig->product_description_words_count . ' words format the answer as an HTML';


        $askGPTMetaKeyworString = 'write a product meta title,meta_description and meta_keywords for ' . $keyword;

        if ($language) {
          $askGPTDescString .= ' in ' . $language->language_name . ' language';
          $askGPTShortDescString .= ' in ' . $language->language_name . ' language';
        }

        //hanlde response
        $gptResponse = '';
        $gptDescResponse = '';

        //long description
        $GPTLongdata = Http::withHeaders([
          'Content-Type' => 'application/json',
          'Authorization' => 'Bearer ' . $getConfig->api_key,
        ])
          ->withOptions([
            "verify" => true,
            "timeout" => 180
          ])
          ->post("https://api.openai.com/v1/chat/completions", [
            "model" => "gpt-3.5-turbo",
            'messages' => [
              [
                "role" => "user",
                "content" => $askGPTDescString
              ]
            ],
            'temperature' => 0.5,

            "top_p" => 1.0,
            "frequency_penalty" => 0.52,
            "presence_penalty" => 0.5,
            //"stop" => ["11."],
          ])
          ->json();

        if (isset($GPTLongdata['choices'])) {
          $gptDescResponse = $GPTLongdata['choices'][0]['message'];
        }

        //short description,meta title,meta description and meta keywords
        $GPTShortdata = Http::withHeaders([
          'Content-Type' => 'application/json',
          'Authorization' => 'Bearer ' . $getConfig->api_key,
        ])
          ->withOptions([
            "verify" => true,
            "timeout" => 180
          ])
          ->post("https://api.openai.com/v1/chat/completions", [
            "model" => "gpt-3.5-turbo",
            'messages' => [
              [
                "role" => "user",
                "content" => $askGPTShortDescString
              ]
            ],
            'temperature' => 1,

            "top_p" => 1.0,
            "frequency_penalty" => 0.52,
            "presence_penalty" => 0.5,
            //"stop" => ["11."],
          ])
          ->json();

        if (isset($GPTShortdata['choices'])) {
          $gptResponse = $GPTShortdata['choices'][0]['message'];
        }

        return response()->json(['short_desc' => $gptResponse ? $gptResponse['content'] : '', 'long_desc' => $gptDescResponse ? $gptDescResponse['content'] : ''], 200, [], JSON_UNESCAPED_UNICODE);
      }

      //if type if blog
      else if ($request->type == 'blog') {
        $askGPTDescString = str_replace('BLOG_TITLE', $keyword . ' ', $getConfig->blog_description_text);
        $askGPTDescString .= ' in ' . $getConfig->blog_words_count . '  words format the answer as an HTML';
        $askGPTShortDescString = 'Write short description for blog post about ' . $keyword . ' in 50 words';

        if ($language) {
          $askGPTDescString .= ' in ' . $language->language_name . ' language';
          $askGPTShortDescString .= ' in ' . $language->language_name . ' language';
        }

        //hanlde response
        $gptResponse = '';
        $gptDescResponse = '';

        //long description
        $GPTLongdata = Http::withHeaders([
          'Content-Type' => 'application/json',
          'Authorization' => 'Bearer ' . $getConfig->api_key,
        ])
          ->withOptions([
            "verify" => true,
            "timeout" => 180
          ])
          ->post("https://api.openai.com/v1/chat/completions", [
            "model" => "gpt-3.5-turbo",
            'messages' => [
              [
                "role" => "user",
                "content" => $askGPTDescString
              ]
            ],
            'temperature' => 1,
            "top_p" => 1.0,
            "frequency_penalty" => 0.52,
            "presence_penalty" => 0.5,
            //"stop" => ["11."],
          ])
          ->json();

        if (isset($GPTLongdata['choices'])) {
          $gptDescResponse = $GPTLongdata['choices'][0]['message'];
        }

        //short description,meta title,meta description and meta keywords
        $GPTShortdata = Http::withHeaders([
          'Content-Type' => 'application/json',
          'Authorization' => 'Bearer ' . $getConfig->api_key,
        ])
          ->withOptions(["verify" => true])
          ->post("https://api.openai.com/v1/chat/completions", [
            "model" => "gpt-3.5-turbo",
            'messages' => [
              [
                "role" => "user",
                "content" => $askGPTShortDescString
              ]
            ],
            'temperature' => 0.5,

            "top_p" => 1.0,
            "frequency_penalty" => 0.52,
            "presence_penalty" => 0.5,
            //"stop" => ["11."],
          ])->json();

        if (isset($GPTShortdata['choices'])) {
          $gptResponse = $GPTShortdata['choices'][0]['message'];
        }

        return response()->json(['short_desc' => $gptResponse ? $gptResponse['content'] : '', 'long_desc' => $gptDescResponse ? $gptDescResponse['content'] : ''], 200, [], JSON_UNESCAPED_UNICODE);
      }

    }
  }

  //get meta title,meta keywords and meta description from chatGPT
  public function getSeoContentFromChatGPT(Request $request)
  {

    $getConfig = $this->getChatGPTConfig();
    $keyword = $request->keyword;

    if ($getConfig->enable == true) {
      $language = Language::where('id', $request->language)->first();
      $askGPTMetaKeyworString = 'write a product meta title,meta_description and meta_keywords for ' . $keyword;
      if ($language) {
        $askGPTMetaKeyworString .= ' in ' . $language->language_name . ' language';
      }

      //hanlde response
      $gptResponse = '';

      //meta title,meta description and meta keywords
      $GPTShortdata = Http::withHeaders([
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer ' . $getConfig->api_key,
      ])
        ->withOptions(["verify" => true])
        ->post("https://api.openai.com/v1/chat/completions", [
          "model" => "gpt-3.5-turbo",
          'messages' => [
            [
              "role" => "user",
              "content" => $askGPTMetaKeyworString
            ]
          ],
          'temperature' => 0.5,

          "top_p" => 1.0,
          "frequency_penalty" => 0.52,
          "presence_penalty" => 0.5,
          //"stop" => ["11."],
        ])->json();

      if (isset($GPTShortdata['choices'])) {
        $gptResponse = $GPTShortdata['choices'][0]['message'];
      }

      $metaTitle = '';
      $metaDesc = '';
      $metaKeywords = '';

      if ($gptResponse['content']) {
        $gptBlukResponse = $gptResponse['content'];

        //get Meta Title
        $metaTitle = strstr($gptBlukResponse, 'Meta Description:', true);
        $position = strpos($metaTitle, 'Meta Title:');

        // final meta title
        $metaTitle = substr($metaTitle, $position + strlen('Meta Title:'));

        //get Meta Description
        $metaDesc = strstr($gptBlukResponse, 'Meta Description:', true);
        $position = strpos($metaDesc, 'Meta Keywords:');

        // final meta Description
        $metaDesc = substr($metaDesc, $position + strlen('Meta Description:'));

        //get Meta Keywords
        $position = strpos($gptBlukResponse, 'Meta Keywords:');
        $metaKeywords = substr($gptBlukResponse, $position + strlen('Meta Keywords:'));
      }

      // $metaDescription = '';
      // if($language->language_name == 'Arabic' && $this->isJson($metaDesc)) {
      //     $metaDescription = $metaDesc;
      // }
      // else{
      $metaDescription = $metaDesc;
      //}

      $metaFilterTitle = '';
      $metaFilterTitle = $metaTitle;



      return response()->json(['meta_title' => $metaFilterTitle, 'meta_description' => $metaDescription, 'meta_keywords' => $metaKeywords], 200, [], JSON_UNESCAPED_UNICODE);
    }
  }

  function isJson($string)
  {
    $stringNew = mb_convert_encoding($string, 'UTF-8', 'UTF-8');
    json_decode($stringNew);
    return json_last_error() === JSON_ERROR_NONE;
  }
}
