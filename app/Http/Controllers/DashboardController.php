<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Result;
use Session;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function result(){
        return view('result');
    }
    public function markshit(){
         return view('markshit');
    }

    public function studentResult(Request $request)
    {
        
        $input = new Result();
        $input->sName = $request->sName;
        $input->roll = $request->roll;
        $input->group = $request->group;
        $input->fName = $request->fName;
        $input->mName = $request->nName;
        foreach($request->subName as $key=>$value)
        {
            if($value == "en")
            {
                $input->english = $request->Mark[$key];
            }
            if($value == "bn")
            {
                $input->bangla = $request->Mark[$key];
            }
            if($value == "mt")
            {
                $input->math = $request->Mark[$key];
            }
        }
        $result = $input->save();

        return redirect()->back();
    }

}
