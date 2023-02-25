<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('backend.coupon.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $coupons = Coupon::latest()->get();
        return view('backend.coupon.index',compact('coupons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' =>'required|max:50|unique:coupons,name',
            'discount'=>'required|numeric|max:99',
            'validity'=>'required',
        ]);
        $data = $request->all();
        $data['name'] = strtoupper($request->name);
        Coupon::create($data);
        toast('Coupon created successfully!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('coupons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('backend.coupon.index',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' =>'required|max:50|unique:coupons,name,'.$id,
            'discount'=>'required|numeric|max:99',
            'validity'=>'required',
        ]);
        $data = $request->all();
        $coupon = Coupon::findOrFail($id);
        $data['name'] = strtoupper($request->name);
        $coupon->update($data);
        toast('Coupon updated!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('coupons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        toast('Coupon deleted!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->back();
    }

    public function couponInactive($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update([
            'status' => 0,
        ]);
        toast('Coupon inactive!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('coupons.index');
    }

    public function couponActive($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update([
            'status' => 1,
        ]);
        toast('Coupon active!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('coupons.index');
    }
}
