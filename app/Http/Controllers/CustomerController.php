<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $customers = Customer::all();
        return view('Customers.list',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //show form tao moi khach hang
        return view('Customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //thuc hien them moi khach hang
        $customer = new Customer();
        $customer->name = $request->input('name');
        $customer->gmail = $request->input('gmail');
        $customer->password =Hash::make($request->input('password'));
        $customer->save();
        //dung session de dua ra thong bao them thanh cong
        Session::flash('seccess','tao moi thanh cong');
        //them xong thi quay ve trang index
        return redirect()->route('customer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Hien thi form va khach hang can sua
        $customer = Customer::findorFail($id);
        return view('Customers.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //thuc hien tac vu sua
        $customer = Customer::findorFail($id);
        $customer->name = $request->input('name');
        $customer->gmail = $request->input('gmail');
        $customer->password = $request->input('password');
        $customer->save();
        //dung session de dua ra thong bao
        Session::flash('success','Cap nhat thanh cong');
        //cap nhat xong quay ve trang danh sach khach hang
        return redirect()->route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //xoa khach hang
        $customer = Customer::findorFail($id);
        $customer->delete();
        //dung session de dua ra thong bao
        Session::flash('success','Xoa thanh cong');
        //xoa xong thi quay ve trang danh sach khach hang
        return redirect()->route('customer.index');
    }
}
