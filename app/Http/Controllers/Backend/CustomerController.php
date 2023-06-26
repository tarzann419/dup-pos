<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Customer;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    public function AllCustomer()
    {
        $customer = Customer::latest()->get();
        return view('backend.customer.all_customer', compact('customer'));
    }

    public function AddCustomer()
    {
        return view('backend.customer.add_customer');
    }
    public function StoreCustomer(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:200',
            'email' => 'unique:customers|max:200',
            'phone' => 'max:200',
            // 'address' => 'required|max:400',
            // 'shopname' => 'required|max:200',
            // 'account_holder' => 'required|max:200',
            // 'account_number' => 'required',
            // 'image' => 'required',
        ]);

        // $image = $request->file('image');
        // $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        // Image::make($image)->resize(300, 300)->save('upload/customer/' . $name_gen);
        // $save_url = 'upload/customer/' . $name_gen;

        Customer::insert([

            'name' => $request->name, //'name' => $request->name: This assigns the value of the name field from the $request object to the 'name' column in the database table.
            'email' => $request->email,
            'phone' => $request->phone,
            // 'address' => $request->address,
            // 'shopname' => $request->shopname,
            // 'account_holder' => $request->account_holder,
            // 'account_number' => $request->account_number,
            // 'bank_name' => $request->bank_name,
            // 'bank_branch' => $request->bank_branch,
            // 'city' => $request->city,
            // 'image' => $save_url,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Customer Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.customer')->with($notification);
    }

    public function EditCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        return view('backend.customer.edit_customer', compact('customer'));
    }

    public function UpdateCustomer(Request $request)
    {
        $customer_id = $request->id;

        // if ($request->file('image')) {

        // $image = $request->file('image');
        // $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        // Image::make($image)->resize(300, 300)->save('upload/customer/' . $name_gen);
        // $save_url = 'upload/customer/' . $name_gen;

        Customer::findOrFail($customer_id)->update([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            // 'address' => $request->address,
            // 'shopname' => $request->shopname,
            // 'account_holder' => $request->account_holder,
            // 'account_number' => $request->account_number,
            // 'bank_name' => $request->bank_name,
            // 'bank_branch' => $request->bank_branch,
            // 'city' => $request->city,
            // 'image' => $save_url,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Customer Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.customer')->with($notification);
        // } 
    }

    public function CustomerDelete($id){

        $customers = Customer::findOrFail($id);
        // $img = $customers->customer_image;
        // unlink($img);

        Customer::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Customer Deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method


    
}
