<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogDescription;
use Validator;
use File;
use Hash;
use DB;
use Auth;

class BlogController  extends Controller
{

  public function __construct()
  {
  //    $this->middleware('auth');
  }

  public function index(Request $request) {

    $name = $request->get('name', '');

    $data = Blog::select()
        ->with('adminblogDescription')
        ->when($name != '', function($q) use($name) {
            $q->whereHas('adminblogDescription',function($q) use($name){
                $q->where('title','like',"%$name%");
            });
    })->whereDeletedAt(null)->orderBy('created_at','DESC')->paginate($this->defaultPaginate);
  
    return view('admin.blog.index',compact('data'));
  }

  public function add() {
    return view('admin.blog.add',['chatGPT' => $this->getChatGPTConfig()]);
  }

  public function store(Request $request) {

    $validator = Validator::make($request->all(),[
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                  'multilanguage.*.title' => ['required'],
            ]);
    if($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }

  $fileName = '';
  if($request->hasFile('image')) {
             $file = $request->image;
             $extension = $request['image']->getClientOriginalExtension(); // getting image extension
             $fileName = rand(11111,99999).'.'.$extension; // renameing image
             $file->move(public_path().'/uploads/blog', $fileName);
    }

      $create = Blog::create([
        'image' => $fileName,
        'author' => Auth::user()->name
      ]);

      if($create) {

        $description =  new BlogDescription();
        $buildMultiLanguage = $description->buildMultiLang($create->id,$request->multilanguage);
        $description->upsert($buildMultiLanguage,['blog_id','short_description','description','language_id','title']);

        return redirect(route('blog'))->with('success','Data successfully added!');
      }
      else {
        return redirect()->back()->with('error','Unable to store data try again later');
      }
  }

  public function edit($id) {
      $data = Blog::with('blogMultipleDescription')->findOrFail($id);
      $chatGPT=  $this->getChatGPTConfig();
      return view('admin.blog.edit',compact('data','chatGPT'));
  }

  public function update($id,Request $request) {


    $validator = Validator::make($request->all(),[
                  'multilanguage.*.title' => ['required'],
            ]);

    if($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }

    $find = Blog::find($id);

    $fileName = $find->image;
    if($request->hasFile('image')) {
        if(File::exists(public_path().'/uploads/blog/'.$find->image)){
            File::delete(public_path().'/uploads/blog/'.$find->image);
         }
         $file = $request->image;
         $extension = $request['image']->getClientOriginalExtension(); // getting image extension
         $fileName = rand(11111,99999).'.'.$extension; // renameing image
         $file->move(public_path().'/uploads/blog', $fileName);
      }

      $update = $find->update([
        'image' => $fileName
      ]);

      if($update) {
        $description =  new BlogDescription();
        $description->where('blog_id',$id)->delete();
        $buildMultiLanguage = $description->buildMultiLang($id,$request->multilanguage);
        $description->upsert($buildMultiLanguage,['blog_id','short_description','description','language_id','title']);

        return redirect(route('blog'))->with('success','Data successfully updated!');
      }
      else {
        return redirect()->back()->with('error','Unable to update data try again later');
      }

  }

  public function delete($id) {
    $find = Blog::find($id);
    $delete = $find->delete();

    if($delete) {
      if(File::exists(public_path().'/uploads/blog/'.$find->image)){
        File::delete(public_path().'/uploads/blog/'.$find->image);
     }

      BlogDescription::where('blog_id',$id)->delete();

      return redirect()->back()->with('success','Data successfully deleted!');
    }
    else {
      return redirect()->back()->with('error','Unable to delete data try again later');
    }
  }





}
