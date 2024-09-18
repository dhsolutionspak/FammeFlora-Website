<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\ProductDescription;
use App\Models\ProductImage;
use App\Models\ProductOption;
use App\Models\ProductRelated;
use App\Models\StoreProductOption;
use App\Models\ProductRelatedAttribute;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\NewsLatterSubscriber;
use App\Models\Category;
use App\Models\Review;
use App\Models\Manufacturer;
use App\Models\State;
use App\Models\Language;
use App\Models\Product;
use App\Models\DOD;
use App\Models\Page;
use App\Models\Blog;
use App\Models\Contactus;
use DB;
use Str;
use Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Lang;
use Carbon\Carbon;
use App\Notification\PanelNotification;
use App\Models\User;

class GeneralController extends Controller
{
  public function __construct()
  {
  }

  //get homepage
  public function index() {

    $data['banners'] = [];

    $hompebanners =file_get_contents(base_path().'/storage/app/webhomepagesliderarr.json');
    $data['banners'] = json_decode($hompebanners);

    $categories = Category::select('category_id','image','parent_id','sort_order','status')
        ->with('categoryDescription:name,category_id')
        ->where('status','1')
        ->orderBy('sort_order','ASC')->get()->toArray();

      $data['topCategory'] = $this->buildTree($categories,0,99);

      //homepage new arrival
      $data['newProducts'] = Product::select('id','image','category_id', 'model','price', 'quantity','sort_order','status','date_available','created_at','viewed')
          ->with('productDescription:name,id,product_id','special:product_id,price,start_date,end_date')
          ->withCount(['productReview as review_avg' => function($query) {
              $query->select(DB::raw('avg(rating)'));
            }])
          ->orderBy('created_at','DESC')
          ->where('date_available','<=',date('Y-m-d'))
          ->where('status','1')
          ->take(10)
          ->get();

      //Featured Products
      $featureProduct =file_get_contents(base_path().'/storage/app/featuredProducts.json');
      $data['featuredproducts'] = json_decode($featureProduct);

      //homepage DOD
      $getDodProducts =file_get_contents(base_path().'/storage/app/dodProducts.json');
      $data['dodProducts'] = json_decode($getDodProducts);

      //trending products
      $data['trendingProducts'] = Product::select('id','image','category_id', 'model','price', 'quantity','sort_order','status','date_available','created_at','viewed')
          ->with('productDescription:name,id,product_id','special:product_id,price,start_date,end_date')
          ->withCount(['productReview as review_avg' => function($query) {
              $query->select(DB::raw('avg(rating)'));
            }])
          ->where('date_available','<=',date('Y-m-d'))
          ->where('status','1')
          ->orderBy('viewed','DESC')
          ->take(15)
          ->get();
          $data['topBrands'] = Manufacturer::select('id','name','status','sort_order','image')
          ->where('status','1')
          ->orderBy('sort_order','ASC')
          ->get();

      //home page banners
      $homethreee =file_get_contents(base_path().'/storage/app/homepagethreecolumnbannersArray.json');
      $data['homepagethreecolumnbanners'] = json_decode($homethreee);

      $hometwo =file_get_contents(base_path().'/storage/app/homepagetwocolumnbannersArray.json');
      $data['homepagetwocolumnbanners'] = json_decode($hometwo);


      $data['blogs'] = Blog::with('blogDescription')->get();

      //build dynamic seo
      $this->buildSeo(config('settingConfig.config_meta_title'),[config('settingConfig.config_meta_tag_keywords')],url('/'),config('settingConfig.config_meta_tag_description'));

      return view('frontend.home.index',compact('data'));
  }

  //all blogs
  public function allBlog() {
    return view('frontend.blog.allblog',['records' =>
      Blog::with('blogDescription')->paginate($this->defaultPaginateFrontend)
    ]);
  }

  //blog detail page
  public function blogDetail($id) {

      $blog = Blog::find($id);
      $data['recentBlog'] = Blog::take(5)->latest()->get();

      $blog->views =  isset($blog->views) ?  $blog->views+1 : 1;
      $blog->save();
      $data['blog'] = $blog;
      $this->buildSeo($data['blog']->title,['otrixcommerce','Blog'],url()->current(),$data['blog']->short_description);

      return view('frontend.blog.detail',compact('data'));
  }

  //all category
  public function allCategries() {
    $categories = Category::select('category_id','image','parent_id','sort_order','status')
        ->with('categoryDescription:name,category_id')
        ->where('status','1')->orderBy('sort_order','ASC')->get()->toArray();

    $data = $this->buildTree($categories,0,999);

    //left side banners
    $leftSideBanner = Banner::with('images:image,sort_order,banner_id,link,title,description,text_color_code')->select('id','name','status')
    ->whereHas('images',function($q){
        $q->orderBy('sort_order','ASC');
      })->where('status','1')
      ->where('name','web-left-slider')
      ->first();

    //right side banners
    $rightSideBanner = Banner::with('images:image,sort_order,banner_id,link,title,description,text_color_code')->select('id','name','status')
    ->whereHas('images',function($q){
        $q->orderBy('sort_order','ASC');
      })->where('status','1')
      ->where('name','web-right-slider')
      ->first();

    $this->buildSeo('Category Page',['otrixcommerce','category'],url()->current(),'Otrxicommerce Website');

    return view('frontend.category.index',compact('data','leftSideBanner','rightSideBanner'));
  }

  //all products
  public function allProducts($type,Request $request) {
      $data = [];

      $categories = Category::select('category_id','image','parent_id','sort_order','status')
          ->with('categoryDescription:name,category_id')
          ->where('status','1')->orderBy('sort_order','ASC')->get();

      $topCategory = $this->buildTree($categories,0,99);
      $min_price = 0;
      $max_price = 0;

      $topBrands = Manufacturer::where('status','1')
        ->orderBy('sort_order','ASC')
        ->take(20)
        ->get();

      $searchKeyword = $request->get('search', '');
      $orderBy =$request->get('sortby', 'default');
      $priceRange = $request->get('priceRange','');
      $brands = $request->get('brands','');
      $brandsArr = [];

      /**
       * view all new products
       */
      if($type == 'new') {

          $data = Product::select('id','image','category_id', 'model','price', 'quantity','sort_order','status','date_available','created_at','viewed')
            ->with('productDescription:name,id,product_id,description','special:product_id,price,start_date,end_date')
            ->withCount(['productReview as review_avg' => function($query) {
                $query->select(DB::raw('avg(rating)'));
              }])->when($searchKeyword , function($q) use($searchKeyword) {
                  $q->whereHas('productDescription',function($q) use($searchKeyword){
                      $q->where('name','like',"%$searchKeyword%");
                  });
              });

            if($priceRange != '') {
                $range = str_replace('$','',$priceRange);
                $explodeRange = explode('-',$range);

                $min_price = $explodeRange[0];
                $max_price = $explodeRange[1];

                $data = $data->whereBetween('price', [$min_price, $max_price]);

            }

            if($brands != '' ){
              $brandsArr = explode(',',$brands);
              $data = $data->whereIn('manufacturer_id',explode(',',$brands));
            }

            if($orderBy != 'default') {
              if($orderBy == 'lowtohigh') {
                $data = $data->orderBy('price','ASC');
              }
              else {
                $data = $data->orderBy('price','DESC');
              }
            }

            $data = $data->orderBy('created_at','DESC')
            ->where('date_available','<=',date('Y-m-d'))
            ->where('status','1')
            ->paginate($this->defaultPaginateFrontend);
            $count = $data->count();

      }

      /**
       * view all trending products
       */
      else if($type == 'trending') {
        $data = Product::select('id','image','category_id', 'model','price', 'quantity','sort_order','status','date_available','viewed','created_at')
            ->with('productDescription:name,id,product_id,description','special:product_id,price,start_date,end_date')
            ->withCount(['productReview as review_avg' => function($query) {
                $query->select(DB::raw('avg(rating)'));
              }])
            ->where('date_available','<=',date('Y-m-d'))
            ->where('status','1')
            ->when($searchKeyword , function($q) use($searchKeyword) {
                $q->whereHas('productDescription',function($q) use($searchKeyword){
                    $q->where('name','like',"%$searchKeyword%");
                });
            });


            if($priceRange != '') {
                $range = str_replace('$','',$priceRange);
                $explodeRange = explode('-',$range);

                $min_price = $explodeRange[0];
                $max_price = $explodeRange[1];

                $data = $data->whereBetween('price', [$min_price, $max_price]);

            }

            if($brands != '' ){
              $brandsArr = explode(',',$brands);
              $data = $data->whereIn('manufacturer_id',explode(',',$brands));
            }

            if($orderBy != 'default') {
              if($orderBy == 'lowtohigh') {
                $data = $data->orderBy('price','ASC');
              }
              else {
                $data = $data->orderBy('price','DESC');
              }
            }

            $data = $data->orderBy('viewed','DESC')->paginate($this->defaultPaginateFrontend);
            $count = $data->count();

      }

      /**
       * view all new products
       */
      if($type == 'featured') {

          $data = Product::select('id','image','category_id', 'model','price', 'quantity','sort_order','status','date_available','created_at','viewed')
            ->with('productDescription:name,id,product_id,description','special:product_id,price,start_date,end_date')
            ->withCount(['productReview as review_avg' => function($query) {
                $query->select(DB::raw('avg(rating)'));
              }])->when($searchKeyword , function($q) use($searchKeyword) {
                  $q->whereHas('productDescription',function($q) use($searchKeyword){
                      $q->where('name','like',"%$searchKeyword%");
                  });
              });


            if($priceRange != '') {
                $range = str_replace('$','',$priceRange);
                $explodeRange = explode('-',$range);

                $min_price = $explodeRange[0];
                $max_price = $explodeRange[1];

                $data = $data->whereBetween('price', [$min_price, $max_price]);

            }

            if($brands != '' ){
              $brandsArr = explode(',',$brands);
              $data = $data->whereIn('manufacturer_id',explode(',',$brands));
            }

            if($orderBy != 'default') {
              if($orderBy == 'lowtohigh') {
                $data = $data->orderBy('price','ASC');
              }
              else {
                $data = $data->orderBy('price','DESC');
              }
            }

            $data = $data->orderBy('created_at','DESC')
            ->where('date_available','<=',date('Y-m-d'))
            ->where('status','1')
            ->paginate($this->defaultPaginateFrontend);

      }

      /**
       * view all special products
       */
       if($type == 'special') {
         $data = DOD::select('id','product_id')
             ->with('productDescription:name,id,product_id','special:product_id,price,start_date,end_date','productDetails:id,image,price,quantity,sort_order,status,date_available')
             ->withCount(['productReview as review_avg' => function($query) {
                 $query->select(DB::raw('avg(rating)'));
               }])
             ->whereHas('productDetails',function($q){
                 $q->where('date_available','<=',date('Y-m-d'));
                 $q->where('status','1');
                 $q->orderBy('sort_order','ASC');
               })
               ->whereHas('special',function($q){
                   $q->where('start_date','<=',date('Y-m-d'));
                   $q->where('end_date','>=',date('Y-m-d'));
                 })
                 ->when($searchKeyword , function($q) use($searchKeyword) {
                     $q->whereHas('productDescription',function($q) use($searchKeyword){
                         $q->where('name','like',"%$searchKeyword%");
                     });
                 })
                 ->when($priceRange , function($q) use($priceRange) {
                     $q->whereHas('productDetails',function($q) use($priceRange){
                         if($priceRange == '$1000+') {
                           $range = str_replace('$','',$priceRange);
                           $q->where('price','>' ,$range);
                         }
                         else {
                           $range = str_replace('$','',$priceRange);
                           $explodeRange = explode('-',$range);
                           $min_price = $explodeRange[0];
                           $max_price = $explodeRange[1];
                           $q->whereBetween('price', [$min_price, $max_price]);
                         }
                     });
                 })
                 ->when($brands , function($q) use($brands) {
                     $q->whereHas('productDetails',function($q) use($brands){
                         $brandsArr = explode(',',$brands);
                         $q->whereIn('manufacturer_id',explode(',',$brands));
                     });
                 })
                 ->when($orderBy , function($q) use($orderBy) {
                     $q->whereHas('productDetails',function($q) use($orderBy){
                         if($orderBy != 'default') {
                           if($orderBy == 'lowtohigh') {
                             $q->orderBy('price','ASC');
                           }
                           else {
                             $q->orderBy('price','DESC');
                           }
                         }
                     });
                 });

                 if($brands != '' ){
                   $brandsArr = explode(',',$brands);
                 }


               $data = $data->paginate($this->defaultPaginateFrontend);

       }

       //left side banners
       $leftSideBanner = Banner::with('images:image,sort_order,banner_id,link,title,description,text_color_code')->select('id','name','status')
       ->whereHas('images',function($q){
           $q->orderBy('sort_order','ASC');
         })->where('status','1')
         ->where('name','web-left-slider')
         ->first();

      $this->buildSeo('All Product Page',['otrixcommerce','All Product'],url()->current(),'All '.$type.' Products');

      return view('frontend.product.allproducts',compact('data','count','min_price','max_price','type','leftSideBanner','topCategory','topBrands','searchKeyword','orderBy','priceRange','brands','brandsArr'));
    }

    //products by category
    public function getProductByCategory($id,Request $request) {
      $ids =[(int)$id];

      $categories = Category::select('category_id','image','parent_id','sort_order','status')
          ->with('categoryDescription:name,category_id')
          ->where('status','1')->orderBy('sort_order','ASC')->get();

      $topCategory = $this->buildTree($categories,0,99);

      $topBrands = Manufacturer::where('status','1')
        ->orderBy('sort_order','ASC')
        ->take(20)
        ->get();

      $type = 'all';
      $brandsArr = [];
      $priceArr = [];
      $min_price = 0;
      $max_price = 0;
      //filters
      $searchKeyword = $request->get('search', '');
      $orderBy =$request->get('sortby', 'default');
      $brands = $request->get('brands','');
      $priceRanges = $request->get('priceRange',null);
      if($priceRanges){
        $range = str_replace('$','',$priceRanges);
        $explodeRange = explode('-',$range);
        $min_price = $explodeRange[0];
        $max_price = $explodeRange[1];
      }
      //check if parent cat
      $getChildCats = Category::where('parent_id',$id)->select('category_id')->get()->toArray();

      foreach ($getChildCats as $key => $value) {
            $ids[]  =  $value['category_id'];
      }

      //build dynamic navigation
      $bradcum = Category::where('category_id',$id)->with('categoryDescription')->first();

      $bradcumArr = [];
      if($bradcum && $bradcum->parent_id != 0) {
          $parent = Category::where('category_id',$bradcum->parent_id)->with('categoryDescription')->first();
          $bradcumArr = [
            'category_id' => $parent->category_id,
            'name' => $parent->categoryDescription?->name,
            'child' =>
              ['category_id' => $bradcum->category_id,'name' => $bradcum->categoryDescription?->name]
          ];
      }
      else {
        $bradcumArr = [
          'category_id' => $bradcum->category_id,
          'name' => $bradcum->categoryDescription?->name,
        ];
      }


      $data = Product::with('category:name,category_id','productDescription:id,product_id,name','special:product_id,price,start_date,end_date')
        ->withCount(['productReview as review_avg' => function($query) {
            $query->select(DB::raw('avg(rating)'));
          }])
         ->select('id','image','category_id', 'model','price', 'quantity','sort_order','status','date_available','created_at','viewed')
         ->whereIn('category_id',$ids)
         ->where('date_available','<=',date('Y-m-d'))
         ->where('status','1')
         ->when($searchKeyword , function($q) use($searchKeyword) {
             $q->whereHas('productDescription',function($q) use($searchKeyword){
                 $q->where('name','like',"%$searchKeyword%");
             });
         });

         if($priceRanges) {
              //  $priceRangeArr = explode(',',$priceRanges);
              //  $buildPriceArr = [];
              //
              //   for($p = 0; $p<count($priceRangeArr);$p++) {
              //
              //        $priceRange = explode('-',$priceRangeArr[$p]);
              //        for($a=0;$a<2;$a++){
              //          $buildPriceArr[] = str_replace('$','',$priceRange[$a]);
              //   }
              // }
              //
              // $maxPrice = (int) max($buildPriceArr);
              // $minPrice = (int) min($buildPriceArr);

              $data = $data->where('price','>=',  $min_price)->where('price','<=',$max_price);
         }

         $data = $data->when($brands , function($q) use($brands) {
                 $brandsArr = explode(',',$brands);
                 $q->whereIn('manufacturer_id',explode(',',$brands));
         });


          $data = $data->when($orderBy , function($q) use($orderBy) {
                 if($orderBy != 'default') {
                   if($orderBy == 'lowtohigh') {
                     $q->orderBy('price','ASC');
                   }
                   else {
                     $q->orderBy('price','DESC');
                   }
                 }
         })->orderBy('created_at','DESC')
         ->paginate($this->defaultPaginateFrontend);
         $count = $data->count();

         if($brands != '' ){
           $brandsArr = explode(',',$brands);
         }
         if($priceRanges != '' ){
           $priceArr = explode(',',$priceRanges);
         }

         //left side banners
         $leftSideBanner = Banner::with('images:image,sort_order,banner_id,link,title,description,text_color_code')->select('id','name','status')
         ->whereHas('images',function($q){
             $q->orderBy('sort_order','ASC');
           })->where('status','1')
           ->where('name','web-left-slider')
           ->first();

         $this->buildSeo($bradcum->categoryDescription->meta_title,['otrixcommerce',$bradcum->categoryDescription->meta_keyword],url()->current(),$bradcum->categoryDescription->meta_description);

         return view('frontend.product.categorywiseproducts',compact('data','min_price','max_price','count','leftSideBanner','type','topCategory','topBrands','searchKeyword','orderBy','priceArr','brands','brandsArr','bradcumArr'));
    }

    //product by category ajax
    public function getProductByCategoryAjax($id,Request $request) {
      $ids =[(int)$id];

      $data = Product::with('category:name,category_id','productDescription:id,product_id,name','special:product_id,price,start_date,end_date')
        ->withCount(['productReview as review_avg' => function($query) {
            $query->select(DB::raw('avg(rating)'));
          }])
         ->select('id','image','category_id', 'model','price', 'quantity','sort_order','status','date_available','created_at','viewed')
         ->whereIn('category_id',$ids)
         ->where('date_available','<=',date('Y-m-d'))
         ->where('status','1')
         ->orderBy('created_at','DESC')
         ->take(15)
         ->get();

         $buildHtml = '';
        if(count($data) > 0) {
          foreach ($data as $key => $value) {
              $price = $value->price;
              $special = 0;
              $offTxt = '';
              $date = Carbon::parse($value->created_at);
              $now = Carbon::now();
              $diff = $date->diffInDays($now);

              if($value->special) {
                $endDate = Carbon::createFromFormat('m/d/Y',$value->special->end_date);
                $startDate = Carbon::createFromFormat('m/d/Y', $value->special->start_date);
                $todayDate = Carbon::createFromFormat('m/d/Y', date('m/d/y'));
                if($startDate->gte($todayDate) && $todayDate->lte($endDate)) {
                  $special = $value->special->price;
                  $offTxt = calculatePercentage($price,$special);
                }
            }

            $stars = $value->review_avg  ? (int)$value->review_avg : 0;
            $starResult = "";
            for ( $i = 1; $i <= 5; $i++ ) {
                if ( round( $stars - .25 ) >= $i ) {
                  $starResult .=   "<i class='fa fa-star'></i>";
                } elseif ( round( $stars + .25 ) >= $i ) {
                      $starResult .=  "<i class='fa fa-star-half-o' ></i>";
                } else {
                    $starResult .=  " <i class='fa fa-star' style='color:#BCC7D1'></i>";
                }
            }

              $buildHtml .='<li>
                <div class="product-box my-2  py-1" >
                  <a href="'.route('product.details',['id' => $value['id']]).'" class="prod-img" >
                    <img class="lazy" data-original="'.asset('uploads').'/product/'.$value->image.'" alt="" title=""  />
                  </a>';

                $buildHtml .='<div class="quickview quickview-common ">
                    <div class="d-flex justify-content-center ">
                      <a href="javascript:void(0);" class="quickviewtext" data-product="'.$value->id.'">Quick View</a>
                    </div>
                  </div>';

                  if($value->quantity <= 0)   {
                      $buildHtml .='<span class="latest-badge out-stock">'.__('common')['label_out_of_stock'].'</span>';
                  }
                  else if($value->quantity !=  0 && $offTxt == '' &&  $diff < 15 ) {
                      $buildHtml .='<span class="latest-badge ">'.__('common')['label_new'].' </span>';
                  }
                  else if($value->quantity !=  0 && $offTxt != '') {
                    $buildHtml .='<span class="latest-badge discount-badge">'.$offTxt.'</span>';
                  }
                  elseif($value->quantity !=  0 && $offTxt == '' && $diff > 15 && ((int)$value->viewed > 999 && (int)$value->viewed < 1200)){
                    $buildHtml .='<span class="latest-badge trending-badge">'.__('common')['trending'].'</span>';
                  }

                  $buildHtml .='<div class="floating-bar">
                    <div class="floating-add-to-cart  d-flex justify-content-center">
                      <input type="hidden" name="productID" value="'.$value->id.'">
                      <a href="'.route('product.details',['id' => $value['id']]).'" class="btn-add-to-cart  d-flex align-items-center">
                        <img src="'.asset('frontend').'/images/add-to-cart.png" alt="" title="" class="add-to-cart-img" />
                      </a></div>';

                      if(Auth::guard('customer')->check()){
                        if(in_array($value->id, getWishlist())){
                            $buildHtml .=  '<div class="floating-wishlist  fill-wishlist  d-flex justify-content-center">
                                <a href="javascript:void(0);" class="d-flex align-items-center" onclick="addToWish(this,'.$value->id.')">
                                    <i class="fas fa-heart" ></i>
                                  </a>
                              </div>';
                        }
                        else {
                          $buildHtml .=  '<div class="floating-wishlist  d-flex justify-content-center">
                              <a href="javascript:void(0);" class=" d-flex align-items-center" onclick="addToWish(this,'.$value->id.')">
                                <img src="'.asset('frontend').'/images/little-heart.png" alt="" title="" class="" />
                              </a>
                            </div>';
                        }
                      }
                      else {
                        $buildHtml .=  '<div class="floating-wishlist  d-flex justify-content-center">
                            <a href="javascript:void(0);" class=" d-flex align-items-center" onclick="addToWish('.$value->id.')">
                              <img src="'.asset('frontend').'/images/little-heart.png" alt="" title="" class="" />
                            </a>
                          </div>';
                      }

                    $buildHtml .= '</div>';




                  $buildHtml .='

                   <div class="mx-2 mb-3 mt-4" >
                    <div class="product-detail mb-3">
                      <p class="modeltext mt-1  mb-1">'.$value->category?->name.'</p>
                      <a href="'.route('product.details',['id' => $value['id']]).'" class="prod-title">'.Str::limit($value->productDescription?->name, 48, '...').'</a>
                      ';

                      if($special > 0){
                      $buildHtml .='  <div class="price">
                          <span class="specialPrice">'.config('settingConfig.config_currency').''.number_format($special,2).'</span>
                          <span class="originalPrice">'.config('settingConfig.config_currency').''.number_format( $value->price,2).'</span>
                        </div>';
                      }
                      else {
                        $buildHtml .='  <div class="price">'.config('settingConfig.config_currency').''.$value->price.' <span class="offer">'.$offTxt.'</span></div>';
                      }
                    $buildHtml .='<ul class="rating mt-3">
                      '.$starResult.'
                    </ul>  </div>';

                $buildHtml .='
                     </div>
                  </div>
                  ';

                $buildHtml .='</div></li>';

          }
        }
        else {
            $buildHtml .='<div class="col-12 text-center">
              <div class="mt-5">
              </div>
              <img src="'.asset('uploads').'/images/sad.png" alt="">
              <h3 class="notfoundtxt mt-5">'.__('common')['product_not_found'].' </h3>
            </div>';
        }


         return  $buildHtml;

    }


    //get product by brands
    public function getProductByBrands($id,Request $request) {

      //build dynamic navigation
      $bradcum = Manufacturer::where('id',$id)->first();
      $bradcumArr = [];
      $bradcumArr = [
        'id' => $bradcum->id,
        'name' => $bradcum?->name
      ];
      $min_price = 0;
      $max_price = 0;
      $categories = Category::select('category_id','image','parent_id','sort_order','status')
          ->with('categoryDescription:name,category_id')
          ->where('status','1')->orderBy('sort_order','ASC')->get();

      $topCategory = $this->buildTree($categories,0,99);

      $topBrands = Manufacturer::where('status','1')
        ->orderBy('sort_order','ASC')
        ->take(20)
        ->get();

      $type = 'all';

      //filters
      $searchKeyword = $request->get('search', '');
      $orderBy =$request->get('sortby', 'default');
      $priceRange = $request->get('priceRange','');
      $brands = $request->get('brands','');
      if($priceRange){
        $range = str_replace('$','',$priceRange);
        $explodeRange = explode('-',$range);
        $min_price = $explodeRange[0];
        $max_price = $explodeRange[1];
      }

      $brandsArr = [];

      $data = Product::with('category:name,category_id','productDescription:id,product_id,name','special:product_id,price,start_date,end_date')
      ->withCount(['productReview as review_avg' => function($query) {
          $query->select(DB::raw('avg(rating)'));
        }])
      ->select('id','image','category_id', 'model','price', 'quantity','sort_order','status','date_available','viewed','created_at')
      ->whereHas('productManufacturer',function($q) use($id) {
          $q->where('id',$id);
        })
        ->when($searchKeyword , function($q) use($searchKeyword) {
            $q->whereHas('productDescription',function($q) use($searchKeyword){
                $q->where('name','like',"%$searchKeyword%");
            });
        })
        ->when($priceRange , function($q) use($min_price,$max_price) {
              $q->whereBetween('price', [$min_price, $max_price]);
        })
        ->when($brands , function($q) use($brands) {
                $brandsArr = explode(',',$brands);
                $q->whereIn('manufacturer_id',explode(',',$brands));
        })
        ->when($orderBy , function($q) use($orderBy) {
                if($orderBy != 'default') {
                  if($orderBy == 'lowtohigh') {
                    $q->orderBy('price','ASC');
                  }
                  else {
                    $q->orderBy('price','DESC');
                  }
                }
        })->orderBy('created_at','DESC')
         ->where('date_available','<=',date('Y-m-d'))
         ->where('status','1')->paginate($this->defaultPaginate);
         $count = $data->count();

         //left side banners
         $leftSideBanner = Banner::with('images:image,sort_order,banner_id,link,title,description,text_color_code')->select('id','name','status')
         ->whereHas('images',function($q){
             $q->orderBy('sort_order','ASC');
           })->where('status','1')
           ->where('name','web-left-slider')
           ->first();

         $this->buildSeo($bradcum?->name,['otrixcommerce',$bradcum?->name],url()->current(),'OtrixCommerce Brand '.$bradcum?->name);

         return view('frontend.product.brandwiseproducts',compact('data','min_price','max_price','count','leftSideBanner','bradcumArr','type','topCategory','topBrands','searchKeyword','orderBy','priceRange','brands','brandsArr'));

    }

    //PRODUCT DETAILS
    public function productDetails($id) {
        $data['product'] = Product::select('id','sku','manufacturer_id','image','category_id', 'model','price', 'location', 'quantity','sort_order','status','length','width','height','viewed')
            ->with('productDescription:name,id,product_id,short_description,description,meta_title,meta_description,meta_keyword','special:product_id,price,start_date,end_date','category:name,category_id','productManufacturer:id,name,image')
            ->where('id',$id)->first();

        $data['product_images'] = ProductImage::where('product_id',$id)->get();
        $reletedId = ProductRelated::select('related_id')->where('product_id',$id)->get();
        $productOptionsData = StoreProductOption::where('product_id',$id)
        ->join('product_options','product_options.id','=','store_product_option.option_id')
        ->join('product_option_description','product_option_description.option_id','=','store_product_option.option_id')
        ->select('store_product_option.*','product_option_description.name','product_options.type')
        ->where('product_option_description.language_id',session()->get('currentLanguage'))
        ->get();


        $data['releted_products'] = Product::select('id','image','category_id', 'model','price', 'quantity','sort_order','status','date_available','created_at','viewed')
           ->with('productDescription:name,id,product_id','special:product_id,price,start_date,end_date')
           ->withCount(['productReview as review_avg' => function($query) {
               $query->select(DB::raw('avg(rating)'));
             }])
           ->orderBy('created_at','DESC')
           ->where('date_available','<=',date('Y-m-d'))
           ->where('status','1')
           ->whereIn('id',$reletedId)
           ->take(50)
           ->get();

        $reviews = Review::where('product_id',$id)
        ->where('status',1)
        ->get();

        $reviewsText = Review::where('product_id',$id)
        ->join('customer','customer.id','=','review.customer_id')
        ->select('review.*','customer.firstname','customer.image')
        ->where('review.status',1)
        ->latest()
        ->take(50)
        ->get();

        $data['reviews'] = $reviews;
        $data['reviews_text'] = $reviewsText;
        $data['totalReviews'] = count($reviews);
        $sumReview = 0;
        $star1 = 0;
        $star2 = 0;
        $star3 = 0;
        $star4 = 0;
        $star5 = 0;

        foreach ($reviews as $key => $value) {

          $sumReview += $value->rating;
          if($value->rating > 0 && $value->rating <= 1.9) {
              $star1++;
          }
          else if($value->rating >= 2 && $value->rating <= 2.9) {
            $star2++;
          }
          else if($value->rating >= 3 && $value->rating <= 3.9) {
              $star3++;
          }
          else if($value->rating >= 4 && $value->rating <= 4.9) {
              $star4++;
          }
          else if($value->rating >= 4.9 && $value->rating <= 5) {
              $star5 ++;
          }
        }

        $data['star1'] =$star1  > 0 ?   number_format($star1 / $data['totalReviews']  * 100,2) : 0;
        $data['star2'] =$star2  > 0 ? number_format($star2 / $data['totalReviews']  * 100,2) : 0;
        $data['star3'] =$star3  > 0 ? number_format($star3 / $data['totalReviews']  * 100,2) : 0;
        $data['star4'] =$star4  > 0 ? number_format($star4 / $data['totalReviews']  * 100,2) : 0;
        $data['star5'] =$star5  > 0 ? number_format($star5 / $data['totalReviews']  * 100,2) : 0;

        $data['avgReview'] = $sumReview > 0 ? number_format($sumReview/$data['totalReviews'],2) : 0;

        $productOptions = [];
        $optionName = '';
        foreach ($productOptionsData as $key => $value) {
              $productOptions[$value->type.'-'.$value?->name][] = $value;
        }

        $data['productOptions'] = $productOptions;

        $productRelatedAttribute = ProductRelatedAttribute::
          join('product_attributes','product_attributes.id','=','product_related_attributes.attribute_id')
        ->join('product_attribute_description','product_attribute_description.attribute_id','=','product_attributes.id')
        ->join('product_attribute_groups','product_attribute_groups.id','=','product_attributes.group_id')
        ->join('product_attribute_group_description','product_attribute_group_description.attribute_group_id','=','product_attribute_groups.id')
        ->select('product_related_attributes.*','product_attributes.group_id','product_attribute_description.name',
          'product_attribute_group_description.name as groupName'
        )
        ->where('product_related_attributes.product_id',$id)
        ->where('product_attribute_group_description.language_id',session()->get('currentLanguage'))
        ->where('product_attribute_description.language_id',session()->get('currentLanguage'))
        ->wherenull('product_attribute_description.deleted_at')
        ->wherenull('product_attribute_group_description.deleted_at')
        ->get()
        ->toArray();

        $result = array();
        foreach ($productRelatedAttribute as $element) {
            $result[$element['groupName']][] = $element;
        }

        $data['productAttributes'] = $result;

        $this->buildSeo($data['product']->productDescription?->meta_title ? $data['product']->productDescription?->meta_title : '' ,['otrixcommerce',$data['product']->productDescription?->meta_keyword ? $data['product']->productDescription?->meta_keyword : ''],url()->current(),$data['product']->productDescription?->meta_description);
        return view('frontend.product.productDetails',['data' => $data]);
    }

    //Search Product
    public function productSearch(Request $request) {
      try {
        $keyword = $request->get('keyword', '');
        $category = $request->get('category', 0);
        $records = Product::select('id','image', 'price', 'quantity','sort_order','status')
            ->with('productDescription:name,id,product_id','special:product_id,price,start_date,end_date')
            ->when($keyword , function($q) use($keyword) {
                $q->orderBy('sort_order','ASC');
                $q->whereHas('productDescription',function($q) use($keyword){
                    $q->where('name','like',"%$keyword%");
                });
            });

        if($category != 0) {
            $records = $records->where('category_id',$category);
        }

        $records = $records->take(10)->get();

        return response()->json(['status'=> 1,'data'=>$records]);
      } catch (\Exception $e) {
        return ['status'=> 0,'message'=>'Error'];
      }
    }

    //Product Price
    public function productPrice($id){
      $data = StoreProductOption::select('price')->where('product_option_id',$id)->first();
      echo json_encode($data);
      exit();
    }

    //get contact us
    public function getcontactus() {
      $this->buildSeo('Contact Us',['otrixcommerce'],url()->current(),'OtrixCommerce Contact Us');
      return view('frontend.contactus.index');
    }

    //store contact us
    public function contactus(Request $request) {
        $validator = $request->validate([
            'name' => 'required|max:255',
            'email'=> 'required|max:255',
            'subject'=> 'required|max:255',
            'message'=> 'required|max:1000',
        ],[
          'name' => 'Name is required',
          'email' => 'Email address is required',
          'subject' => 'Subject is required',
          'message' => 'Message is required'
        ]);


        $contactus = new Contactus($request->except(['_token']));
        $contactus->save();

        $notiData = [
             'title' => 'New Inquiry',
             'body' => 'New Inquiry by customer name '.$request->name,
             'url' => route('contact-us'),
         ];
        $users = User::all();
        Notification::send($users, new PanelNotification($notiData));

        if($contactus){
          return redirect()->back()->with('commonSuccess',' Your message was sent, thank you!');
        }
        else {
          return redirect()->back()->with('commonError','Error when submit');
        }

    }

    public function getcms($title){
        $slug = ucfirst(str_replace('-', ' ',$title));
        $cms = Page::where('title','like',"%$slug%")->first();
        $this->buildSeo($cms->title,['otrixcommerce',$cms->title],url()->current(),$cms->heading);

        return view('frontend.cms.index',compact('cms'));
    }

    //subscribe newslatter
    public function newslatter(Request $request) {
      if(!empty($request->email)) {
        $checkif = NewsLatterSubscriber::where('email',$request->email)->first();
        if(!$checkif) {
          $insert = new NewsLatterSubscriber($request->except(['_token']));
          $insert->save();
        }
         return redirect()->back()->with('commonSuccess',' Successfully Subscribed, thank you!');
      }
      else {
        return redirect()->back()->with('commonError',' Email address is required');
      }
    }

    //change language
    public function setLanguage(Request $request){
      try {
        session()->put('currentLanguage',$request->language_id);
        session()->put('locale',$request->locale);

        //language flag
        $findLanguage = Language::find($request->language_id);
        session()->put('language_flag',$findLanguage->language_flag);
        session()->put('language_name',$findLanguage->language_name);
        session()->save();

        return ['status' =>1];
      } catch (\Exception $e) {
          return ['status' =>0];
      }
    }

    public function getProductDetails(Request $request) {

      try {
          $getProduct = Product::with('special:product_id,price,start_date,end_date')->findOrFail($request->product_id);
          $productBasePrice = $getProduct->price;

          //check product exists or not
          if($getProduct) {
              //check this product already in cart

              //product special
              $price = $getProduct->price;
              $special = 0;
              if($getProduct->special) {
                $endDate = Carbon::createFromFormat('m/d/Y',$getProduct->special->end_date);
                $startDate = Carbon::createFromFormat('m/d/Y',$getProduct->special->start_date);
                $todayDate = Carbon::createFromFormat('m/d/Y', date('m/d/y'));
                if($startDate->gte($todayDate) && $todayDate->lte($endDate)) {
                  $special = number_format($getProduct->special->price,2);
                }
              }

              if($special > 0 ){
                $productBasePrice = $special;
              }

              //check product has options
              $findProductOption = StoreProductOption::where('product_id',$request->product_id)->first();


                $productData['product'] = Product::select('id','manufacturer_id','image','category_id', 'model','price', 'location', 'quantity','sort_order','status','length','width','height')
                    ->with('productDescription:name,id,product_id,description','category:name,category_id','productManufacturer:id,image')
                    ->where('id',$request->product_id)->first();

                $productOptionsData = StoreProductOption::where('product_id',$request->product_id)
                ->join('product_options','product_options.id','=','store_product_option.option_id')
                ->with('productoptionDescription:name,option_id')
                ->select('store_product_option.*','product_options.type')
                ->get();

                $productOptions = [];
                $optionName = '';
                foreach ($productOptionsData as $key => $value) {
                    $productOptions[$value->type.'-'.$value->productoptionDescription?->name][] = $value;
                }

                $productData['productOptions'] = $productOptions;
                return ['status' => 1,'productData' => $productData,'price' => $price,'special' => $special];
            }
            else {
              return ['status'=> 0,'message'=>'Product not found!'];
            }
       } catch (\Exception $e) {
         return ['status'=> 0,'message'=>'Error'];
       }
    }


    //Search Product
    public function searchProduct(Request $request) {
        $data = [];

        $categories = Category::select('category_id','image','parent_id','sort_order','status')
            ->with('categoryDescription:name,category_id')
            ->where('status','1')->orderBy('sort_order','DESC')->get();

        $topCategory = $this->buildTree($categories,0,99);
        $min_price = 0;
        $max_price = 0;

        $topBrands = Manufacturer::where('status','1')
          ->orderBy('sort_order','ASC')
          ->take(20)
          ->get();

        $searchKeyword = $request->get('search', '');
        $orderBy =$request->get('sortby', 'default');
        $priceRange = $request->get('priceRange','');
        $brands = $request->get('brands','');
        $brandsArr = [];

          $data = Product::select('id','image','category_id', 'model','price', 'quantity','sort_order','status','date_available','created_at','viewed')
            ->with('productDescription:name,id,product_id,description','special:product_id,price,start_date,end_date')
            ->withCount(['productReview as review_avg' => function($query) {
                $query->select(DB::raw('avg(rating)'));
              }])->when($searchKeyword , function($q) use($searchKeyword) {
                  $q->whereHas('productDescription',function($q) use($searchKeyword){
                      $q->where('name','like',"%$searchKeyword%");
                  });
              });

            if($priceRange != '') {
                $range = str_replace('$','',$priceRange);
                $explodeRange = explode('-',$range);

                $min_price = $explodeRange[0];
                $max_price = $explodeRange[1];

                $data = $data->whereBetween('price', [$min_price, $max_price]);

            }

            if($brands != '' ){
              $brandsArr = explode(',',$brands);
              $data = $data->whereIn('manufacturer_id',explode(',',$brands));
            }

            if($orderBy != 'default') {
              if($orderBy == 'lowtohigh') {
                $data = $data->orderBy('price','ASC');
              }
              else {
                $data = $data->orderBy('price','DESC');
              }
            }

            $data = $data->orderBy('created_at','DESC')
            ->where('date_available','<=',date('Y-m-d'))
            ->where('status','1')

            ->paginate($this->defaultPaginateFrontend);
            $count = $data->count();

            $leftSideBanner = Banner::with('images:image,sort_order,banner_id,link,title,description,text_color_code')->select('id','name','status')
            ->whereHas('images',function($q){
                $q->orderBy('sort_order','ASC');
              })->where('status','1')
              ->where('name','web-left-slider')
              ->first();

            $this->buildSeo('Search Product',['Search Product'],url()->current(),'Search Products');

            return view('frontend.product.searchProducts',compact('data','count','min_price','max_price','leftSideBanner','topCategory','topBrands','searchKeyword','orderBy','priceRange','brands','brandsArr'));

      }

      //get states by country
      public function getStates(Request $request) {
        $getStates = State::where('country_id',$request->country_id)->get();
        return ['data' => $getStates];
      }
}
