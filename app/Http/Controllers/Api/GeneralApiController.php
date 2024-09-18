<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\CategoryDescription;
use App\Models\Banner;
use App\Models\Country;
use App\Models\BannerImage;
use App\Models\Product;
use App\Models\ProductRelatedAttribute;
use App\Models\ProductAttributeGroup;
use App\Models\ProductDescription;
use App\Models\ProductRelated;
use App\Models\ProductSpecial;
use App\Models\ProductImage;
use App\Models\StoreProductOption;
use App\Models\Manufacturer;
use App\Models\Review;
use App\Models\DOD;
use App\Models\Page;
use App\Models\Language;
use Validator;
use File;
use DB;
use Auth;
use Carbon\Carbon;

class GeneralApiController extends Controller
{

    public function __construct()
    {
    }

    //homepage init api
    public function getHomePageInit(Request $request)
    {
        try {
            //set language
            $lang = Language::where('code', $request->get('language') ? $request->get('language') : 'en')->first();
            session()->put('currentLanguage', $lang->id);
            session()->save();

            $deviceID = $request->get('device_id', '');
            $deviceType = $request->get('deviceType', '');
            if ($deviceID != '') {
                //insert device
                $checkExists = DB::table('devices')->where('device_id', $deviceID)->first();
                if (!$checkExists) {
                    DB::table('devices')->insert(['device_id' => $deviceID, 'device_type' => $deviceType]);
                }
            }

            //homepage categories
            $categories = Category::select('category_id', 'image', 'parent_id', 'sort_order', 'status')
                ->with('categoryDescription:name,category_id')
                ->where('status', '1')->orderBy('sort_order', 'ASC')->get()->toArray();

            $data['categories'] = buildTree($categories, 0, 9);

            //homepage banners
            $brands = file_get_contents(base_path() . '/storage/app/apphomepageSlider.json');
            $data['homepageSlider'] = json_decode($brands);

            //banners
            $brands = file_get_contents(base_path() . '/storage/app/appbanner.json');
            $data['banners'] = json_decode($brands);

            //homepage manufacturers
            $brands = file_get_contents(base_path() . '/storage/app/brands.json');
            $data['manufacturers'] = json_decode($brands);

            //Featured Products
            $featureProduct = file_get_contents(base_path() . '/storage/app/featuredProducts.json');
            $data['featuredproducts'] = json_decode($featureProduct);

            //homepage DOD
            $getDodProducts = file_get_contents(base_path() . '/storage/app/dodProducts.json');
            $data['dodProducts'] = json_decode($getDodProducts);

            //homepage new arrival
            $data['newProducts'] = Product::select('id', 'image', 'category_id', 'model', 'price', 'quantity', 'sort_order', 'status', 'date_available')
                ->with('productDescription:name,id,product_id', 'special:product_id,price,start_date,end_date')
                ->withCount([
                    'productReview as review_avg' => function ($query) {
                        $query->select(DB::raw('avg(rating)'));
                    }
                ])
                ->orderBy('created_at', 'DESC')
                ->where('date_available', '<=', date('Y-m-d'))
                ->where('status', '1')
                ->take(4)
                ->get();


            return ['status' => 1, 'data' => $data];
        } catch (\Exception $e) {
            return ['status' => 0, 'message' => 'Error'];
        }
    }

    //homepage api
    public function getHomePage(Request $request)
    {
        try {
            $data = [];
            $lang = Language::where('code', $request->get('language') ? $request->get('language') : 'en')->first();
            session()->put('currentLanguage', $lang->id);
            session()->save();

            //homepage Trending
            $data['trendingProducts'] = Product::select('id', 'image', 'category_id', 'model', 'price', 'quantity', 'sort_order', 'status', 'date_available')
                ->with('productDescription:name,id,product_id', 'special:product_id,price,start_date,end_date')
                ->withCount([
                    'productReview as review_avg' => function ($query) {
                        $query->select(DB::raw('avg(rating)'));
                    }
                ])
                ->where('date_available', '<=', date('Y-m-d'))
                ->where('status', '1')
                ->orderBy('viewed', 'DESC')
                ->take(4)
                ->get();

            if (!$request->get('reactnativeapp')) {
                //homepage DOD
                $dealsFlutter = DOD::select('id', 'product_id')
                    ->with('productDescription:name,id,product_id', 'special:product_id,price,start_date,end_date', 'productDetails:id,image,price,quantity,sort_order,status,date_available')
                    ->withCount([
                        'productReview as review_avg' => function ($query) {
                            $query->select(DB::raw('avg(rating)'));
                        }
                    ])
                    ->whereHas('productDetails', function ($q) {
                        $q->where('date_available', '<=', date('Y-m-d'));
                        $q->where('status', '1');
                        $q->orderBy('sort_order', 'ASC');
                    })
                    ->whereHas('special', function ($q) {
                        $q->where('start_date', '<=', date('Y-m-d'));
                        $q->where('end_date', '>=', date('Y-m-d'));
                    })
                    ->take(4)
                    ->get();

                $flutterDOD = [];
                foreach ($dealsFlutter as $key => $value) {
                    $flutterDOD[] = [
                        'id' => $value->id,
                        'product_id' => $value->product_id,
                        'review_avg' => $value->review_avg,
                        'product_description' => $value->productDescription,
                        'special' => $value->special,
                        'image' => $value->productDetails->image,
                        'price' => $value->productDetails->price,
                        'quantity' => $value->productDetails->quantity,
                        'sort_order' => $value->productDetails->sort_order,
                        'date_available' => $value->productDetails->date_available
                    ];
                }
                $data['flutter_dod'] = $flutterDOD;
            }

            $categoriesArr = DB::table('homepage_categories')
                ->join('category', 'category.category_id', '=', 'homepage_categories.category_id')
                ->join('category_description', 'category_description.category_id', '=', 'homepage_categories.category_id')
                ->select('category.category_id', 'category_description.name', 'homepage_categories.sort_order', 'homepage_categories.id')
                ->where('category_description.language_id', $lang->id)
                ->orderBy('homepage_categories.sort_order', 'ASC')
                ->get()
                ->toArray();

            $dataCatWiseProducts = [];

            foreach ($categoriesArr as $key => $value) {

                $ids = [(int) $value->category_id];
                //check if parent cat
                $getChildCats = Category::where('parent_id', $value->category_id)->select('category_id')->get()->toArray();

                foreach ($getChildCats as $key => $value2) {
                    $ids[] = $value2['category_id'];
                }

                $catProducts = Product::with('category:name,category_id', 'productDescription:id,product_id,name', 'special:product_id,price,start_date,end_date')
                    ->select('id', 'image', 'category_id', 'model', 'price', 'quantity', 'sort_order', 'status', 'date_available')
                    ->whereIn('category_id', $ids)
                    ->orderBy('created_at', 'DESC')
                    ->where('date_available', '<=', date('Y-m-d'))
                    ->where('status', '1')->take(10)->get()->toArray();

                $dataCatWiseProducts[$value->name] = $catProducts;
            }

            $data['categoryWiseProduct'] = $dataCatWiseProducts;
            $data['enable_image_similarity'] = config('imagesimilarity.ENABLE_IMAGE_SIMILARITY');
            return ['status' => 1, 'data' => $data];

        } catch (\Exception $e) {
            return ['status' => 0, 'message' => 'Error'];
        }
    }

    //new products
    public function getNewProducts()
    {
        try {
            $data = [];
            $data = Product::select('id', 'image', 'category_id', 'model', 'price', 'quantity', 'sort_order', 'status', 'date_available')
                ->with('productDescription:name,id,product_id', 'special:product_id,price,start_date,end_date')
                ->withCount([
                    'productReview as review_avg' => function ($query) {
                        $query->select(DB::raw('avg(rating)'));
                    }
                ])
                ->orderBy('created_at', 'DESC')
                ->where('date_available', '<=', date('Y-m-d'))
                ->where('status', '1')
                ->take(20)
                ->get();
            return ['status' => 1, 'data' => $data];
        } catch (\Exception $e) {
            return ['status' => 0, 'message' => 'Error'];
        }
    }

    //dod products
    public function getDODProducts()
    {
        try {
            $data = [];
            $data = DOD::select('id', 'product_id')
                ->with('productDescription:name,id,product_id', 'special:product_id,price,start_date,end_date', 'productDetails:id,image,price,quantity,sort_order,status,date_available')
                ->withCount([
                    'productReview as review_avg' => function ($query) {
                        $query->select(DB::raw('avg(rating)'));
                    }
                ])
                ->whereHas('productDetails', function ($q) {
                    $q->where('date_available', '<=', date('Y-m-d'));
                    $q->where('status', '1');
                    $q->orderBy('sort_order', 'ASC');
                })
                ->whereHas('special', function ($q) {
                    $q->where('start_date', '<=', date('Y-m-d'));
                    $q->where('end_date', '>=', date('Y-m-d'));
                })
                ->take(25)
                ->get();

            $flutterDOD = [];
            foreach ($data as $key => $value) {
                $flutterDOD[] = [
                    'id' => $value->id,
                    'product_id' => $value->product_id,
                    'review_avg' => $value->review_avg,
                    'product_description' => $value->productDescription,
                    'special' => $value->special,
                    'image' => $value->productDetails->image,
                    'price' => $value->productDetails->price,
                    'quantity' => $value->productDetails->quantity,
                    'sort_order' => $value->productDetails->sort_order,
                    'date_available' => $value->productDetails->date_available
                ];
            }


            return ['status' => 1, 'data' => $data, 'flutterDOD' => $flutterDOD];
        } catch (\Exception $e) {
            return ['status' => 0, 'message' => 'Error'];
        }
    }

    //trending products
    public function getTrendingProducts()
    {
        try {
            $data = [];
            $data = Product::select('id', 'image', 'category_id', 'model', 'price', 'quantity', 'sort_order', 'status', 'date_available')
                ->with('productDescription:name,id,product_id', 'special:product_id,price,start_date,end_date')
                ->withCount([
                    'productReview as review_avg' => function ($query) {
                        $query->select(DB::raw('avg(rating)'));
                    }
                ])
                ->where('date_available', '<=', date('Y-m-d'))
                ->where('status', '1')
                ->orderBy('viewed', 'DESC')
                ->take(20)
                ->get();

            return ['status' => 1, 'data' => $data];
        } catch (\Exception $e) {
            return ['status' => 0, 'message' => 'Error'];
        }
    }

    //get categories
    public function getCategories(User $user)
    {
        $categories = Category::select('category_id', 'image', 'parent_id', 'sort_order', 'status')
            ->with('categoryDescription:name,category_id')
            ->where('status', '1')->orderBy('sort_order', 'ASC')->get()->toArray();

        //build tree
        $tree = buildTree($categories);

        return ['status' => 1, 'data' => $tree];
        //}
        // catch (\Exception $e) {
        //  return ['status'=> 0,'message'=>'Error'];
        //  }
    }

    //get categories
    public function getManufacturers(User $user)
    {
        try {
            $menufacturers = Manufacturer::select('id', 'name', 'status', 'sort_order', 'image')
                ->where('status', '1')
                ->orderBy('sort_order', 'ASC')
                ->get()
                ->toArray();

            return ['status' => 1, 'data' => $menufacturers];
        } catch (\Exception $e) {
            return ['status' => 0, 'message' => 'Error'];
        }
    }

    //search products
    public function searchProducts(Request $request)
    {
        try {
            $keyword = $request->get('q', '');
            $records = Product::select('id', 'image', 'price', 'quantity', 'sort_order', 'status')
                ->with('productDescription:name,id,product_id', 'special:product_id,price,start_date,end_date')
                ->when($keyword, function ($q) use ($keyword) {
                    $q->orderBy('sort_order', 'ASC');
                    $q->whereHas('productDescription', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%$keyword%");
                    });
                })->take(10)
                ->get();




            return ['status' => 1, 'data' => $records];
        } catch (\Exception $e) {
            return ['status' => 0, 'message' => 'Error'];
        }

    }

    //get product details
    public function productDetails($id)
    {

        try {
            $data = [];
            if (Product::find($id)) {
                $relatedIds = ProductRelated::getRelatedIds($id);
                $data['reletedProducts'] = [];
                $data['productImages'] = [];
                if (count($relatedIds) > 0) {
                    $data['reletedProducts'] = Product::select('id', 'image', 'price', 'quantity', 'sort_order', 'status', 'date_available')
                        ->withCount([
                            'productReview as review_avg' => function ($query) {
                                $query->select(DB::raw('avg(rating)'));
                            }
                        ])
                        ->with('productDescription:name,id,product_id', 'special:product_id,price,start_date,end_date')
                        ->orderBy('sort_order', 'ASC')
                        ->whereIn('id', $relatedIds)->get();
                }

                $productRelatedAttribute = ProductRelatedAttribute::
                    join('product_attributes', 'product_attributes.id', '=', 'product_related_attributes.attribute_id')
                    ->join('product_attribute_description', 'product_attribute_description.attribute_id', '=', 'product_attributes.id')
                    ->join('product_attribute_groups', 'product_attribute_groups.id', '=', 'product_attributes.group_id')
                    ->join('product_attribute_group_description', 'product_attribute_group_description.attribute_group_id', '=', 'product_attribute_groups.id')
                    ->select(
                        'product_related_attributes.*',
                        'product_attributes.group_id',
                        'product_attribute_description.name',
                        'product_attribute_group_description.name as groupName'
                    )
                    ->where('product_related_attributes.product_id', $id)
                    ->where('product_attribute_group_description.language_id', session()->get('currentLanguage'))
                    ->where('product_attribute_description.language_id', session()->get('currentLanguage'))
                    ->wherenull('product_attribute_description.deleted_at')
                    ->wherenull('product_attribute_group_description.deleted_at')
                    ->get()
                    ->toArray();

                $result = array();
                foreach ($productRelatedAttribute as $element) {
                    $result[$element['groupName']][] = $element;
                }

                $data['productAttributes'] = $result;
                $data['productSpecial'] = ProductSpecial::where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->where('product_id', $id)->first();
                $data['productImages'] = ProductImage::where('product_id', $id)->orderBy('sort_order_image', 'ASC')->take(10)->get();
                $data['data'] = Product::with('category:name,category_id', 'productDescription:id,product_id,name,description')->findOrFail($id);
                $productOptionsData = StoreProductOption::where('product_id', $id)
                    ->join('product_options', 'product_options.id', '=', 'store_product_option.option_id')
                    ->join('product_option_description', 'product_option_description.option_id', '=', 'store_product_option.option_id')
                    ->select('store_product_option.*', 'product_option_description.name', 'product_options.type')
                    ->where('product_option_description.language_id', session()->get('currentLanguage'))
                    ->get();
                $reviews = Review::where('product_id', $id)->where('status', 1)->get();
                $data['totalReviews'] = count($reviews);
                $sumReview = 0;
                $star1 = 0;
                $star2 = 0;
                $star3 = 0;
                $star4 = 0;
                $star5 = 0;

                foreach ($reviews as $key => $value) {

                    $sumReview += $value->rating;
                    if ($value->rating > 0 && $value->rating <= 1.9) {
                        $star1++;
                    } else if ($value->rating >= 2 && $value->rating <= 2.9) {
                        $star2++;
                    } else if ($value->rating >= 3 && $value->rating <= 3.9) {
                        $star3++;
                    } else if ($value->rating >= 4 && $value->rating <= 4.9) {
                        $star4++;
                    } else if ($value->rating >= 4.9 && $value->rating <= 5) {
                        $star5++;
                    }
                }

                $data['star1'] = $star1 > 0 ? number_format($star1 / $data['totalReviews'] * 100, 2) : "0";
                $data['star2'] = $star2 > 0 ? number_format($star2 / $data['totalReviews'] * 100, 2) : "0";
                $data['star3'] = $star3 > 0 ? number_format($star3 / $data['totalReviews'] * 100, 2) : "0";
                $data['star4'] = $star4 > 0 ? number_format($star4 / $data['totalReviews'] * 100, 2) : "0";
                $data['star5'] = $star5 > 0 ? number_format($star5 / $data['totalReviews'] * 100, 2) : "0";

                $data['avgReview'] = $sumReview > 0 ? number_format($sumReview / $data['totalReviews'], 2) : "0";

                $productOptions = [];
                $optionName = '';
                foreach ($productOptionsData as $key => $value) {
                    $productOptions[$value->name][] = $value;
                }
                $data['productOptions'] = $productOptions;

                return ['status' => 1, 'data' => $data];
            } else {
                return ['status' => 0, 'data' => 'Product not found!'];
            }
        } catch (\Exception $e) {
            return ['status' => 0, 'message' => 'Error'];
        }
    }


    //get product by category id
    public function getProductByCategory($id, Request $request)
    {

        try {

            $ids = [(int) $id];

            //check if parent cat
            $getChildCats = Category::where('parent_id', $id)->select('category_id')->get()->toArray();

            foreach ($getChildCats as $key => $value) {
                $ids[] = $value['category_id'];
            }

            $data = Product::with('category:name,category_id', 'productDescription:id,product_id,name', 'special:product_id,price,start_date,end_date')
                ->withCount([
                    'productReview as review_avg' => function ($query) {
                        $query->select(DB::raw('avg(rating)'));
                    }
                ])
                ->select('id', 'image', 'category_id', 'model', 'price', 'quantity', 'sort_order', 'status', 'date_available')
                ->whereIn('category_id', $ids)
                ->orderBy('created_at', 'DESC')
                ->where('date_available', '<=', date('Y-m-d'));

            if (!empty($request->filterPrice)) {
                $data = $data->where('price', '<=', $request->filterPrice);
            }
            if (!empty($request->filterPriceRange)) {
                $getRange = explode(',', $request->filterPriceRange);
                $data = $data->where('price', '>=', $getRange[0])->where('price', '<=', $getRange[1]);
            }
            if (!empty($request->filterRating)) {
                $data = $data->whereHas('productReview', function ($q) use ($request) {
                    $q->where('rating', '>=', $request->filterRating - 1);
                    $q->where('rating', '<=', $request->filterRating);
                });
            }

            $data = $data->where('status', '1')->paginate($this->defaultPaginate);

            $categoryData = Category::select('category_id')
                ->with('categoryDescription:name,category_id')->where('category_id', $id)->first();

            return ['status' => 1, 'productsList' => $data, 'categoryData' => $categoryData];

        } catch (\Exception $e) {
            return ['status' => 0, 'message' => 'Error'];
        }

    }

    //get product by manufacturer id
    public function getProductByManufacturer(Request $request, $id)
    {

        try {
            $data = Product::with('category:name,category_id', 'productDescription:id,product_id,name', 'special:product_id,price,start_date,end_date')
                ->withCount([
                    'productReview as review_avg' => function ($query) {
                        $query->select(DB::raw('avg(rating)'));
                    }
                ])
                ->select('id', 'image', 'category_id', 'model', 'price', 'quantity', 'sort_order', 'status', 'date_available')
                ->whereHas('productManufacturer', function ($q) use ($id) {
                    $q->where('id', $id);
                });

            //if filter applied
            if (!empty($request->filterPrice)) {
                $data = $data->where('price', '<=', $request->filterPrice);
            }
            if (!empty($request->filterPriceRange)) {
                $getRange = explode(',', $request->filterPriceRange);
                $data = $data->where('price', '>=', $getRange[0])->where('price', '<=', $getRange[1]);
            }
            if (!empty($request->filterRating)) {
                $data = $data->whereHas('productReview', function ($q) use ($request) {
                    $q->where('rating', '>=', $request->filterRating - 1);
                    $q->where('rating', '<=', $request->filterRating);
                });
            }

            $data = $data->orderBy('created_at', 'DESC')
                ->where('date_available', '<=', date('Y-m-d'))
                ->where('status', '1')->paginate($this->defaultPaginate);

            $brandData = Manufacturer::where('id', $id)->first();

            return ['status' => 1, 'productsList' => $data, 'brandData' => $brandData];

        } catch (\Exception $e) {
            return ['status' => 0, 'message' => 'Error'];
        }
    }

    //cms pages
    public function getPages($id)
    {
        try {
            $data = Page::findOrFail($id);
            if ($data) {
                return ['status' => 1, 'data' => $data];
            } else {
                return ['status' => 0, 'message' => 'Not found!'];
            }
        } catch (\Exception $e) {
            return ['status' => 0, 'message' => 'Error'];
        }
    }

    //check Login
    public function checkLogin()
    {
        $status = 0;
        if (Auth::guard('customer')->check()) {
            $status = 1;
        }
        return ["status" => 1, 'loginStatus' => $status];
    }

    //get payment methods Login
    public function getPaymentMethods()
    {
        $data = DB::table('payment_methods')->where('status', 1)->get();
        return ["status" => 1, 'payment_methods' => $data];
    }

    //clear cache
    public function checkCache(Request $request)
    {
        $deviceID = $request->get('device_id', '');

        $checkExists = DB::table('devices')->where('device_id', $deviceID)->first();
        $clearCache = false;
        if (!$checkExists) {
            $clearCache = true;
        } else {
            $clearCache = $checkExists->clear_cache == 0 ? false : true;
        }

        return ['status' => 1, 'clearCache' => $clearCache, 'device' => $deviceID];
    }

    //set cache valuee
    public function setCacheFalse(Request $request)
    {
        $deviceID = $request->get('device_id', '');
        DB::table('devices')->where('device_id', $deviceID)->update(['clear_cache' => 0]);
        return ['status' => 1, 'clearCache' => $clearCache];
    }

    //image similarity
    public function imageSimilarity(Request $request) {
      try {
          $validator = Validator::make($request->all(),[
                'image'     => 'required|image|mimes:jpeg,jpg,png|max:512',
             ]
           );

           if ($validator->fails())
           {
             $message = $this->one_validation_message($validator);
               return  ['status' => 0 , 'message' => $message];
           }

           //call AI Image Search
           $client = new \GuzzleHttp\Client();

           $res = $client->request('POST', env('AI_IMAGE_SIMILARITY_ENDPOINT').'AI-image-similarity', [
             'multipart' => [
                    [
                        'name'     => 'image',
                        'contents' => file_get_contents($request->file('image')->getPathname()),
                        'filename' => 'avata.' . $request->file('image')->getClientOriginalExtension()
                    ],
                    [
                        'name'     => 'domain',
                        'contents' => url('/')
                    ],
                ]
             ]);

             $response = json_decode($res->getBody(), true);
             if($response['status'] == 1) {
               if(count($response['data']) > 0) {
                 $data = Product::with('category:name,category_id','productDescription:id,product_id,name','special:product_id,price,start_date,end_date')
                   ->withCount(['productReview as review_avg' => function($query) {
                       $query->select(DB::raw('avg(rating)'));
                     }])
                    ->select('id','image','category_id', 'price', 'quantity','sort_order','status','date_available','created_at')
                    ->where('date_available','<=',date('Y-m-d'))
                    ->where('status','1')
                    ->orderBy('created_at','DESC')
                    ->whereIn('product.image',$response['data'])
                    ->take(20)
                    ->get();
                  }
                  else {
                    $data = [];
                  }

               return  ['status'=> 1,'data' => $data ];
             }
             else {
               return  ['status'=> 0,'message'=>'Failed to fetch','data' => [] ];
             }
      } catch (\Exception $e) {
        return  ['status'=> 0,'message'=>'Error' ];
      }
  }

}

//cat parent child function
function buildTree($elements, $parentId = 0, $limit = 100)
{
    $branch = array();
    $i = 1;
    foreach ($elements as $element) {
        if ($element['parent_id'] == $parentId) {
            if ($i < $limit) {
                $children = buildTree($elements, $element['category_id']);

                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
            $i++;
        }
    }

    return $branch;
}
