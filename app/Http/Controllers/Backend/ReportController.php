<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use DateTime;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //report view
    public function ordersReportView(){
        return view('backend.report.view');
    }

    //report by date
    public function reportByDate(Request $request){
        $this->validate($request,[
            'date' => 'required'
        ]);
        // return $request->all();
        $date = new DateTime($request->date);
        $formatDate = $date->format('D, d F Y');
        // return $formatDate;
        $orders = Order::where('order_date',$formatDate)->latest()->get();
        return view('backend.report.report_list',compact('orders','formatDate'));
    }

    //report by date
    public function reportByMonth(Request $request){
        $this->validate($request,[
            'month' => 'required',
            'year_month' => 'required',
        ]);
        $orders = Order::where('order_month',$request->month)->where('order_year',$request->year_month)->latest()->get();
        return view('backend.report.report_list',compact('orders'));
    }

    //report by date
    public function reportByYear(Request $request){
        $this->validate($request,[
            'year' => 'required'
        ]);
        $orders = Order::where('order_year',$request->year)->latest()->get();
        return view('backend.report.report_list',compact('orders'));
    }
}
