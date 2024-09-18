<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\User;
use App\Models\State;
use App\Models\Product;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Models\Category;
use DB;
use Hash;
use Auth;
use App\Notification\PanelNotification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $user = \Auth::user();

        $data = [];
        $data['totalOrders'] = Order::count();
        $data['totalSale'] = Order::sum('grand_total');
        $data['totalCustomer'] = Customer::count();
        $data['totalProduct'] = Product::count();
        $data['latestOrders'] = Order::select('id', 'firstname', 'lastname', 'payment_method', 'shipping_name', 'order_status_id', 'total', 'order_date', 'grand_total', 'invoice_prefix', 'invoice_no')
            ->withCount('productRelation')
            ->with('orderStatus:name,id')
            ->orderBy('created_at', 'DESC')->take(10)->get();

        $salesChart = Order::select(
            DB::raw('sum(grand_total) as sums'),
            DB::raw("DATE_FORMAT(order_date,'%m %Y') as months")
        )
            ->groupBy('months')
            ->whereYear('order_date', date('Y'))
            ->get();
        $buildChartArr = [];
        foreach ($salesChart as $key => $value) {

            if ($value->months == '01 ' . date('Y')) {
                $buildChartArr[] = ['label' => 'January', 'value' => $value->sums];
                continue;
            }
            if ($value->months == '02 ' . date('Y')) {
                $buildChartArr[] = ['label' => 'February', 'value' => $value->sums];
                continue;
            }
            if ($value->months == '03 ' . date('Y')) {
                $buildChartArr[] = ['label' => 'March', 'value' => $value->sums];
                continue;
            }
            if ($value->months == '04 ' . date('Y')) {
                $buildChartArr[] = ['label' => 'April', 'value' => $value->sums];
                continue;
            }
            if ($value->months == '05 ' . date('Y')) {
                $buildChartArr[] = ['label' => 'May', 'value' => $value->sums];
                continue;
            }

            if ($value->months == '06 ' . date('Y')) {
                $buildChartArr[] = ['label' => 'June', 'value' => $value->sums];
                continue;

            }

            if ($value->months == '07 ' . date('Y')) {
                $buildChartArr[] = ['label' => 'July', 'value' => $value->sums];
                continue;

            }

            if ($value->months == '08 ' . date('Y')) {
                $buildChartArr[] = ['label' => 'August', 'value' => $value->sums];
                continue;

            }

            if ($value->months == '09 ' . date('Y')) {
                $buildChartArr[] = ['label' => 'September', 'value' => $value->sums];
                continue;

            }

            if ($value->months == '10 ' . date('Y')) {
                $buildChartArr[] = ['label' => 'October', 'value' => $value->sums];
                continue;

            }

            if ($value->months == '11 ' . date('Y')) {
                $buildChartArr[] = ['label' => 'November', 'value' => $value->sums];
                continue;

            }

            if ($value->months == '12 ' . date('Y')) {
                $buildChartArr[] = ['label' => 'December', 'value' => $value->sums];
                continue;
            }
        }

        $data['salesChartData'] = $buildChartArr;

        $customerChart = Customer::select(
            DB::raw('count(id) as sums'),
            DB::raw("DATE_FORMAT(created_at,'%m %Y') as months")
        )
            ->groupBy('months')
            ->whereYear('created_at', date('Y'))
            ->get();


        $buildCustomerChart = [];
        foreach ($customerChart as $key => $value) {
            if ($value->months == '01 ' . date('Y')) {
                $buildCustomerChart[] = ['label' => 'January', 'value' => $value->sums];
                continue;
            }

            if ($value->months == '02 ' . date('Y')) {
                $buildCustomerChart[] = ['label' => 'February', 'value' => $value->sums];
                continue;
            }


            if ($value->months == '03 ' . date('Y')) {
                $buildCustomerChart[] = ['label' => 'March', 'value' => $value->sums];
                continue;
            }

            if ($value->months == '04 ' . date('Y')) {
                $buildCustomerChart[] = ['label' => 'April', 'value' => $value->sums];
                continue;
            }

            if ($value->months == '05 ' . date('Y')) {
                $buildCustomerChart[] = ['label' => 'May', 'value' => $value->sums];
                continue;
            }

            if ($value->months == '06 ' . date('Y')) {
                $buildCustomerChart[] = ['label' => 'June', 'value' => $value->sums];
                continue;
            }

            if ($value->months == '07 ' . date('Y')) {
                $buildCustomerChart[] = ['label' => 'July', 'value' => $value->sums];
                continue;
            }

            if ($value->months == '08 ' . date('Y')) {
                $buildCustomerChart[] = ['label' => 'August', 'value' => $value->sums];
                continue;
            }

            if ($value->months == '09 ' . date('Y')) {
                $buildCustomerChart[] = ['label' => 'September', 'value' => $value->sums];
                continue;
            }

            if ($value->months == '10 ' . date('Y')) {
                $buildCustomerChart[] = ['label' => 'October', 'value' => $value->sums];
                continue;
            }

            if ($value->months == '11 ' . date('Y')) {
                $buildCustomerChart[] = ['label' => 'November', 'value' => $value->sums];
                continue;
            }

            if ($value->months == '12 ' . date('Y')) {
                $buildCustomerChart[] = ['label' => 'December', 'value' => $value->sums];
                continue;
            }

            break;
        }

        $data['customerChartData'] = $buildCustomerChart;
        if (!session()->get('currentLanguage')) {
            $currentLanguage = Language::where('default_lang', '1')->first();
            session()->put('currentLanguage', $currentLanguage->id);
            session()->save();
        }


        return view('dashboard', compact('data'));
    }

    public function homepageCategory()
    {
        $categories = Category::select('category_id', 'parent_id', 'sort_order', 'status')
            ->with('categoryDescription:name,category_id')
            ->whereDeletedAt(null)
            ->orderBy('created_at', 'DESC')
            ->get();

        $homepagecatpluck = DB::table('homepage_categories')->pluck('category_id')->toArray();

        $records = DB::table('homepage_categories')
            ->join('category', 'category.category_id', '=', 'homepage_categories.category_id')
            ->join('category_description', 'category_description.category_id', '=', 'homepage_categories.category_id')
            ->select('category.category_id', 'category.image', 'category_description.name', 'homepage_categories.sort_order', 'homepage_categories.id')
            ->where('category_description.language_id', session()->get('currentLanguage'))
            ->get();

        return view('admin.homecat.homecategory', compact('categories', 'homepagecatpluck', 'records'));
    }

    public function storeHomepageCategory(Request $request)
    {
        DB::table('homepage_categories')->truncate();

        if (isset($request->category_id) && count($request->category_id) < 6) {
            foreach ($request->category_id as $key => $value) {
                $dataArray[] = [
                    'category_id' => $value,
                ];
            }
            DB::table('homepage_categories')->insert($dataArray);

            return redirect()->back()->with('success', 'Homepage Category Updated');
        } else {
            return redirect()->back()->with('error', 'You can select maximum 5 categories only');
        }


    }

    public function homepageCategorySortOrder(Request $request)
    {

        DB::table('homepage_categories')->where('id', $request->id)->update(['sort_order' => $request->order]);
        return ['status' => 1, 'message' => 'Successfully updated'];
    }

    //featured products
    public function featuredProduct()
    {
        $data = Product::select('id', 'image', 'price', 'quantity', 'sort_order', 'status')
            ->with('adminproductDescription:name,id,product_id')
            ->orderBy('created_at', 'DESC')
            ->take(300)
            ->get();

        $featuredProducts = DB::table('featured_products')->pluck('product_id')->toArray();

        $records = DB::table('featured_products')
            ->join('product', 'product.id', '=', 'featured_products.product_id')
            ->join('product_description', 'product_description.product_id', '=', 'product.id')
            ->where('product_description.language_id', 4)
            ->get();

        $getHomepageFProducts = DB::table('featured_products')->pluck('product_id')->toArray();
        $featuredproductsArr = Product::select('id', 'image', 'category_id', 'model', 'price', 'quantity', 'sort_order', 'status', 'date_available', 'created_at', 'viewed')
            ->with('adminproductDescription:name,id,product_id', 'category:name,category_id', 'special:product_id,price,start_date,end_date')
            ->withCount([
                'productReview as review_avg' => function ($query) {
                    $query->select(DB::raw('avg(rating)'));
                }
            ])
            ->orderBy('created_at', 'DESC')
            ->where('date_available', '<=', date('Y-m-d'))
            ->whereIn('id', $getHomepageFProducts)
            ->where('status', '1')
            ->take(5)
            ->get();


        $storeArr = $this->buildProductObj($featuredproductsArr);

        $val = json_encode($storeArr);
        $filename = base_path() . '/storage/app/featuredProducts.json';
        $fp = fopen($filename, "w");
        fwrite($fp, $val);
        fclose($fp);

        return view('admin.featuredproducts.index', ['pluckProducts' => $featuredProducts, 'records' => $records, 'data' => $data]);
    }

    //add featured products -
    public function addFeaturedProduct(Request $request)
    {

        DB::table('featured_products')->truncate();
        $productIds = $this->getProduct($request->product_id);
        $data = DB::table('featured_products')->insert($productIds);
        return redirect(route('featured-product'))->with('success', 'Featured Product Added');

    }

    protected function getProduct($productId)
    {
        $dataArray = [];
        if (isset($productId)) {
            foreach ($productId as $key => $value) {
                $dataArray[] = [
                    'product_id' => $value,
                ];
            }
        }
        return $dataArray;
    }

    //clear application cache
    public function clearApplicationCache()
    {
        if (Auth::user()->hasRole('Super Admin')) {
            DB::table('devices')->update(['clear_cache' => 1]);
            return redirect()->back()->with('success', 'Application cache cleared');
        } else {
            return redirect()->back()->with('error', "Only Superadmin can perfome this task");
        }
    }

    //fetch states
    public function fetchStates(Request $request) {
        $getStates = State::where('country_id',$request->country_id)->get();
        return ['data' => $getStates];
    }


}
