<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\BannerImage;
use App\Traits\CustomFileTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    use CustomFileTrait;
    protected $path = '';

    public function __construct()
    {
        $this->path = public_path(config('constant.file_path.banner'));
    }

    public function index(Request $request) {
        $name = $request->get('name', '');

        $records = Banner::select('id','name','status')

            ->when($name != '', function($q) use($name) {
                $q->where('name','like',"%$name%");
            })->paginate($this->defaultPaginate);
        return view('admin.banner.index',['records' => $records]);
    }

    public function add() {
        return view('admin.banner.add',[]);
    }

    public function store(Request $request) {

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
//            'image' => ['required','mimes:jpeg,jpg,png'],
        ]);

        $this->createDirectory($this->path);
        $banner = new Banner($request->only('name','status'));
        $banner->save();
            $bannerArray = [];
            foreach ($request->title as $key => $value ) {
                $image = null;
                if($request->image[$key]) {
                    $image = $request->image[$key];
                }

                $imageName = $this->saveCustomFileAndGetImageName($image,$this->path);
                $bannerArray[] = [
                    'banner_id' => $banner->id,
                    'title' => $request->title[$key],
                    'link' => $request->link[$key],
                    'sort_order' => $request->sort_order[$key],
                    'image' => $imageName,
                ];
            }
            BannerImage::insert($bannerArray);

            $getHomepageSlider = Banner::with('images:image,link,sort_order,banner_id,title,description,text_color_code')
            ->select('id', 'name', 'status')
            ->whereHas('images', function ($q) {
              $q->orderBy('sort_order', 'ASC');
            })->where('status', '1')->whereIn('name',['WebSlider','web-homepage-sub-banners'])
            ->get();


            $val  =	json_encode($getHomepageSlider);
            $filename = base_path().'/storage/app/webhomepagesliderarr.json';
            $fp=fopen($filename,"w");
            fwrite($fp,$val);
            fclose($fp);

            $threecolumnbanners =  Banner::with('images:image,sort_order,banner_id,link,title,description,text_color_code')->select('id','name','status')
            ->whereHas('images',function($q){
                $q->orderBy('sort_order','ASC');
              })->where('status','1')
              ->where('name','web-three-column-banner')
              ->first();

            $twocolumnbanners =  Banner::with('images:image,sort_order,banner_id,link,title,description,text_color_code')
            ->select('id','name','status')
            ->whereHas('images',function($q){
                $q->orderBy('sort_order','ASC');
              })->where('status','1')
              ->where('name','web-two-column-banner')
              ->first();

              $val  =	json_encode($threecolumnbanners);
              $filename = base_path().'/storage/app/homepagethreecolumnbannersArray.json';
              $fp=fopen($filename,"w");
              fwrite($fp,$val);
              fclose($fp);

              $val  =	json_encode($twocolumnbanners);
              $filename = base_path().'/storage/app/homepagetwocolumnbannersArray.json';
              $fp=fopen($filename,"w");
              fwrite($fp,$val);
              fclose($fp);


              //app homepage slider
              $getAppHomepageSlider = Banner::with('images:image,link,sort_order,banner_id')->select('id','name','status')
              ->whereHas('images',function($q){
                  $q->orderBy('sort_order','ASC');
                })->where('status','1')->where('name','Application Home Page Slider')->first();

              $val  =	json_encode($getAppHomepageSlider);
              $filename = base_path().'/storage/app/apphomepageSlider.json';
              $fp=fopen($filename,"w");
              fwrite($fp,$val);
              fclose($fp);

              //app homepage banenr
              $getAppHomepageBanner = Banner::with('images:image,link,sort_order,banner_id')->select('id','name','status')
              ->whereHas('images',function($q){
                  $q->orderBy('sort_order','ASC');
                })->where('status','1')->where('name','Application Banners')->first();

              $val  =	json_encode($getAppHomepageBanner);
              $filename = base_path().'/storage/app/appbanner.json';
              $fp=fopen($filename,"w");
              fwrite($fp,$val);
              fclose($fp);

        return redirect(route('banner'))->with('success','Banner Created Successfully');
    }

    public function edit($id) {

        return view('admin.banner.edit',[
            'data' => Banner::with('images')->findOrFail($id),
        ]);
    }

    public function update(Request $request,$id) {

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
        ]);
        $banner = Banner::findOrFail($id);
        $banner->fill($request->only('name','status'))->save();
        $bannerImageIds = [];
        $bannerArray = [];
        foreach ($request->title as $key => $value ) {
            $image = null;

            if (isset($request->ids[$key])) {
                $bannerImage = BannerImage::whereId($request->ids[$key])->first();
                $bannerImageIds[] = $request->ids[$key];
                if(isset($request->image[$key])) {
                    $image = $request->image[$key];
                    $this->removeOldImage($bannerImage->image,$this->path);
                    $bannerImage->image = $this->saveCustomFileAndGetImageName($image,$this->path);

                }
                $bannerImage->title = $request->title[$key];
                $bannerImage->link = $request->link[$key];
                $bannerImage->sort_order = $request->sort_order[$key];
                $bannerImage->save();
            } else {
                $image = $request->image[$key];
                $imageName = $this->saveCustomFileAndGetImageName($image,$this->path);
                $bannerArray[] = [
                    'banner_id' => $banner->id,
                    'title' => $request->title[$key],
                    'link' => $request->link[$key],
                    'sort_order' => $request->sort_order[$key],
                    'image' => $imageName,
                ];
            }
        }

        $oldBannerImagesData = BannerImage::where('banner_id',$id)->get();
        $oldBannerIds = $oldBannerImagesData->pluck('id')->toArray();
        $deletedBannerIds = array_diff($oldBannerIds,$bannerImageIds);
        $oldBannerImages = $oldBannerImagesData->pluck('image','id')->toArray();

//      Remove deleted Images
        foreach($deletedBannerIds as $key => $value) {
            $this->removeOldImage($oldBannerImages[$value],$this->path);
        }

        BannerImage::insert($bannerArray);
        BannerImage::whereIn('id',$deletedBannerIds)->delete();

        $getHomepageSlider = Banner::with('images:image,link,sort_order,banner_id,title,description,text_color_code')
        ->select('id', 'name', 'status')
        ->whereHas('images', function ($q) {
          $q->orderBy('sort_order', 'ASC');
        })->where('status', '1')->whereIn('name',['WebSlider','web-homepage-sub-banners'])
        ->get();


        $val  =	json_encode($getHomepageSlider);
        $filename = base_path().'/storage/app/webhomepagesliderarr.json';
        $fp=fopen($filename,"w");
        fwrite($fp,$val);
        fclose($fp);

        $threecolumnbanners =  Banner::with('images:image,sort_order,banner_id,link,title,description,text_color_code')->select('id','name','status')
        ->whereHas('images',function($q){
            $q->orderBy('sort_order','ASC');
          })->where('status','1')
          ->where('name','web-three-column-banner')
          ->first();

        $twocolumnbanners =  Banner::with('images:image,sort_order,banner_id,link,title,description,text_color_code')
        ->select('id','name','status')
        ->whereHas('images',function($q){
            $q->orderBy('sort_order','ASC');
          })->where('status','1')
          ->where('name','web-two-column-banner')
          ->first();

          $val  =	json_encode($threecolumnbanners);
          $filename = base_path().'/storage/app/homepagethreecolumnbannersArray.json';
          $fp=fopen($filename,"w");
          fwrite($fp,$val);
          fclose($fp);

          $val  =	json_encode($twocolumnbanners);
          $filename = base_path().'/storage/app/homepagetwocolumnbannersArray.json';
          $fp=fopen($filename,"w");
          fwrite($fp,$val);
          fclose($fp);


          //app homepage slider
          $getAppHomepageSlider = Banner::with('images:image,link,sort_order,banner_id')->select('id','name','status')
          ->whereHas('images',function($q){
              $q->orderBy('sort_order','ASC');
            })->where('status','1')->where('name','Application Home Page Slider')->first();

          $val  =	json_encode($getAppHomepageSlider);
          $filename = base_path().'/storage/app/apphomepageSlider.json';
          $fp=fopen($filename,"w");
          fwrite($fp,$val);
          fclose($fp);

          //app homepage banenr
          $getAppHomepageBanner = Banner::with('images:image,link,sort_order,banner_id')->select('id','name','status')
          ->whereHas('images',function($q){
              $q->orderBy('sort_order','ASC');
            })->where('status','1')->where('name','Application Banners')->first();

          $val  =	json_encode($getAppHomepageBanner);
          $filename = base_path().'/storage/app/appbanner.json';
          $fp=fopen($filename,"w");
          fwrite($fp,$val);
          fclose($fp);


        return redirect(route('banner'))->with('success','Banner Updated Successfully');
    }

    public function delete($id) {
        if(! $data = Banner::whereId($id)->first()) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

        $images = $data->images()->pluck('image');
        foreach($images as $key => $value) {
            $this->removeOldImage($value,$this->path);
        }
        Banner::where('id',$id)->delete();
        BannerImage::where('banner_id',$id)->delete();

        return redirect(route('banner'))->with('success', 'Banner  Deleted Successfully');
    }
}
