<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order;
use App\clientUser;
use Carbon\Carbon;
use App\Mpos;
use App\product;
use App\voucher;
use App\reviews;
use App\User;
use DB;

class manageDashboard extends Controller
{
  public function daySales()
  {
    $day_sales = DB::table('MPOS_SALE')
      ->where('date_time', '>=', Carbon::today())
      ->groupBy('og_invoice_type')
      ->select('og_invoice_type', DB::raw('count(*) as total'))
      ->get();

    $day_sales_labels = [];
    $day_sales_data = [];
    $day_sales_total = 0;

    foreach ($day_sales as $row) {

      $day_sales_total += $row->total;
      $day_sales_data[] = $row->total;
      $day_sales_labels[] = $row->og_invoice_type;
      
    }

    return [
      'total' => $day_sales_total,
      'labels' => $day_sales_labels,
      'data' => $day_sales_data
    ];
  }

  public function monthSales()
  {
    $month_sales = DB::table('MPOS_SALE')
      ->where(DB::raw('YEAR(date_time)'), '=', Carbon::now()->year)
      ->groupBy(DB::raw('MONTH(date_time)'))
      ->select(DB::raw('MONTH(date_time) as month'), DB::raw('count(*) as total'))
      ->get();

    $months = [
      'January',
      'February',
      'March',
      'April',
      'May',
      'June',
      'July',
      'August',
      'September',
      'October',
      'November',
      'December'
    ];

    $month_sales_data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    foreach ($month_sales as $row) {
      $month_sales_data[$row->month - 1] = $row->total;
    }

    return [
      'year' => Carbon::now()->year,
      'labels' => array_values($months),
      'data' => $month_sales_data
    ];
  }

  public function productYearSales()
  {
    $product_year_sales = DB::table('MPOS_SALE')
      ->select(DB::raw('SUM(MPOS_SALE.quntity) as total'), 'product.name')
      ->join('product', 'product.id', '=', 'MPOS_SALE.product_id')
      ->where(DB::raw('YEAR(MPOS_SALE.date_time)'), '=', Carbon::now()->year)
      ->groupBy('MPOS_SALE.code_Artigo', 'product.name')
      ->get();

    $produc_sales_labels = [];
    $produc_sales_data = [];
    $produc_sales_total = 0;

    foreach ($product_year_sales as $row) {

      $produc_sales_total += $row->total;
      $produc_sales_data[] = $row->total;
      $produc_sales_labels[] = $row->name;
    }

    return [
      'total' => $produc_sales_total,
      'labels' => $produc_sales_labels,
      'data' => $produc_sales_data
    ];
  }

  public function getHome(Request $request)
  {
    $day_sales = $this->daySales();
    $month_sales = $this->monthSales();
    $product_year_sales = $this->productYearSales();
    $total_saleprice = 0;

    $total_sale = order::where('created_at', '<', Carbon::today())->get();

    $total_saleyesterday = order::where('created_at', '<', Carbon::yesterday())->get();

    $total_order_week = order::where('created_at', '<', Carbon::today()->subWeek())->get();

    $newClient = clientUser::where('created_at', '=', Carbon::today()->subWeek())->get();

    $voucherR = voucher::where('voucherPoint', '>=', '10')->whereNotNull('voucher')->get();

    $offerProduct = product::whereHas('campaign_Product', function ($query) {
      $query->where('status', '=', '1');
    })->get();

    $mpos = Mpos::all();

    $currentOrder = order::where('created_at', '>=', Carbon::today())->get();

    $reviews = Mpos::with('mposRate')->get();

    $user = User::all();

    foreach ($total_sale as $saleprice) {

      $total_saleprice += $saleprice->total_price;
    }

    return view('home.home', compact(
      'total_sale',
      'total_saleyesterday',
      'total_order_week',
      'newClient',
      'voucherR',
      'offerProduct',
      'mpos',
      'reviews',
      'total_saleprice',
      'currentOrder',
      'day_sales',
      'user',
      'month_sales',
      'product_year_sales'
    ));
  }
}


