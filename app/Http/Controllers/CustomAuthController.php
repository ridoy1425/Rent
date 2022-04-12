<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration; 
use Illuminate\Support\Facades\Hash;
use Session;

class CustomAuthController extends Controller
{
    public function registration(Request $request){
        $this->validate($request,[
            'email' => 'required|email|unique:registrations',
            'phone_number' => 'required|regex:/(01)[0-9]{9}/',
            'password' => 'required_with:password_confirmation|same:password_confirmation'
            ]);

        $input = new Registration();
        $input->first_name = $request->first_name;
        $input->last_name = $request->last_name;
        $input->phone_number = $request->phone_number;
        $input->email = $request->email;
        $input->password = Hash::make($request->password);
        $result = $input->save();

        if($result)
        {
            return redirect('login')->with('success','Registration successfull');
        }
        else{
            return redirect('login')->with('error','Something Wrong');
        }   
    }

    public function userLogin(Request $request)
    {
        $user = Registration::where('email', $request->user_email)->first();
        if($user)
        {
            if(Hash::check($request->password, $user->password))
            {
                $request->session()->put('loginId', $user->id);
                return redirect('/');
            }
            else
            {
                return back()->with('error','Password does not matches');
            }
        }
        else
        {
            return back()->with('error','This Email does not exist');
        }
    }

    public function logout()
    {
        if(Session::has('loginId'))
        {
            Session::pull('loginId');
            return redirect('login');
            
        }
    }
}
