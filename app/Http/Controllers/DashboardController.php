<?php

namespace App\Http\Controllers;
use  App\Customer;
use App\Games;
use App\Models\Category;
use App\Models\Groups;
use Illuminate\Http\Request;



class DashboardController extends Controller
{
   
    public function dashboard()
    {     
        $uicongfig = [
            'title' => "Dashboard",
            'header' => "Dashboard",
            'active' => "dashboard",
        ];   
        return view('dashboard.home',compact('uicongfig'));
    }

    public function get(Request $request)
    {
       
        $count['groups'] = Groups::count();
        $count['activegroups'] = Groups::where('status', 0)->count();
        $count['disablegroups'] = Groups::where('status', 1)->count();

        $count['category'] =Category::count();
    
        // echo"<pre>";print_r($count['teacher']);exit;
        return $count;
    }


}
