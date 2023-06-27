<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminController extends Controller
{
    public function AdminDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        
        $notification = array(
            'message' => 'Admin Logout Successfully',
            'alert-type' => 'info'
        );

        return redirect('/logout')->with($notification);
    } //End Method


    public function AdminLogoutPage(){
        return view('admin.admin_logout');
    }


    public function AdminProfilePage(){
        $id = Auth::user()->id; // to get the specific user id logged in from the User table
        $adminData = User::find($id); // to get the user logged in by the id



        return view('admin.admin_profile', compact('adminData'));
    }

    public function AdminProfileStore(Request $request){

        $id = Auth::user()->id; // to get the specific user id logged in from the User table
        $data = User::find($id); // to get the user logged in by the id
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_image/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_image'), $filename);
            $data['photo'] = $filename;
        }
        $data->save();


        $notification = array(
            'message' => 'Admin Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function ChangePassword(){
        return view('admin.changepassword');
    }


    public function UpdatePassword(Request $request){


        //validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        //old password check
        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notification = array(
                'message' => 'Old Password Doesnt Match!!',
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }


        //update the new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = array(
            'message' => 'Password Updated Successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification); //send notification after update

    }
}
