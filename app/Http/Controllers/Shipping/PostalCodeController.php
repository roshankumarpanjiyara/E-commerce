<?php

namespace App\Http\Controllers\Shipping;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\PostalCode;
use App\Models\State;
use Illuminate\Http\Request;

class PostalCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::orderBy('name','ASC')->get();
        $districts = District::orderBy('name','ASC')->get();
        $postalcodes = PostalCode::orderBy('pincode','ASC')->get();
        return view('backend.shipping.postal.index',compact('states','districts','postalcodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'pincode' => 'required|numeric|digits:6|unique:postal_codes,pincode',
            'state_id'=>'required',
            'district_id'=>'required',
        ]);
        PostalCode::create([
            'pincode' => $request->pincode,
            'state_id' => $request->state_id,
            'district_id' => $request->district_id,
        ]);
        toast('Pincode added successfully!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->route('postalcodes.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postal = PostalCode::findOrFail($id);
        $postal->delete();
        toast('Pincode deleted!','success')->autoClose(5000)->width('450px')->timerProgressBar();
        return redirect()->back();
    }

    public function getDistrict($state_id)
    {
        $district = District::where('state_id',$state_id)->orderBy('name','ASC')->get();
        return json_encode($district);
    }
}
