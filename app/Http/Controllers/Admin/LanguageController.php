<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\CustomFileTrait;
use Illuminate\Support\Facades\File;

class LanguageController extends Controller
{

  use CustomFileTrait;
  protected $path = '';

  public function __construct()
  {
    $this->path = public_path(config('constant.file_path.language'));
  }

  public function index(Request $request)
  {
    $name = $request->get('name', '');
    $records = Language::whereDeletedAt(null)->orderBy('created_at', 'DESC')->paginate($this->defaultPaginate);
    return view('admin.language.index', ['records' => $records]);
  }

  public function add()
  {
    return view('admin.language.add');
  }

  public function store(Request $request)
  {

    $this->validate($request, [
      'language_name' => ['required', 'string', 'max:255', 'unique:language'],
      'code' => ['required'],
      'language_flag' => ['required']
    ]);


    $this->createDirectory($this->path);
    $language = new Language($request->only('language_name', 'sort_order', 'default_lang', 'code', 'status'));
    $language->language_flag = $this->saveCustomFileAndGetImageName(request()->file('language_flag'), $this->path);
    $language->save();

    //set session language
    if ($request->default_lang == 1) {
      Language::query()->update(['default_lang' => 0]);
      Language::where('id', $language->id)->update(['default_lang' => 1]);
    }

    $language->save();

    //update language array file
    $records = Language::whereDeletedAt(null)->where('status', '1')->orderBy('sort_order', 'ASC')
      ->get()->toArray();

    $val = json_encode($records);
    $filename = base_path() . '/storage/app/languageArray.json';
    $fp = fopen($filename, "w");
    fwrite($fp, $val);
    fclose($fp);

    //create language file
    $defualtContent = file_get_contents(base_path() . '/resources/lang/en.json');
    $langfilename = base_path() . '/resources/lang/' . $request->code . '.json';
    $fp = fopen($langfilename, "w");
    fwrite($fp, $defualtContent);
    fclose($fp);

    return redirect(route('language'))->with('success', 'Language Created Successfully');
  }

  public function edit($id)
  {

    return view('admin.language.edit', [
      'data' => Language::findOrFail($id),
    ]);
  }

  public function update(Request $request, $id)
  {

    $this->validate($request, [
      'language_name' => ['required', 'string', 'max:255', 'unique:language,language_name,' . $id . ',id'],
    ]);

    //Update Language
    $language = Language::findOrFail($id);

    //set session language
    if ($request->default_lang == 1) {
      Language::query()->update(['default_lang' => 0]);
      Language::where('id', $id)->update(['default_lang' => 1]);
      session()->put('currentLanguage', $id);
      session()->save();
    }

    if ($request->hasFile('language_flag')) {
      if ($language->language_flag) {
        $currentImage = $this->path . '/' . $language->language_flag;
        if (File::exists($currentImage)) {
          unlink($currentImage);
        }
      }
      $language->language_flag = $this->saveCustomFileAndGetImageName(request()->file('language_flag'), $this->path);
    }

    $language->fill($request->only('default_lang', 'sort_order', 'language_name', 'status', 'code'))->save();

    //update language array file
    $records = Language::whereDeletedAt(null)->where('status', '1')->orderBy('sort_order', 'ASC')
      ->get()->toArray();

    $val = json_encode($records);
    $filename = base_path() . '/storage/app/languageArray.json';
    $fp = fopen($filename, "w");
    fwrite($fp, $val);
    fclose($fp);

    return redirect(route('language'))->with('success', 'Language Updated Successfully');
  }

  public function delete($id)
  {

    $find = Language::find($id);
    if ($find->code == 'en') {
      return redirect()->back()->with('error', 'cannot delete language english you can only deactive english language');
    }

    Language::where('id', $id)->delete();

    //update language array file
    $records = Language::whereDeletedAt(null)->where('status', '1')->orderBy('created_at', 'ASC')
      ->get()->toArray();
    $val = json_encode($records);
    $filename = base_path() . '/storage/app/languageArray.json';
    $fp = fopen($filename, "w");
    fwrite($fp, $val);
    fclose($fp);

    return redirect(route('language'))->with('success', 'Language  Deleted Successfully');
  }
}