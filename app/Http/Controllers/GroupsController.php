<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Groups;
use Illuminate\Support\Facades\Validator;
use DataTables;


use Illuminate\Http\Request;

class GroupsController extends Controller
{
 public function index(){

  $uicongfig = [
    'title' => "Groups",
    'header' => "Groups",
    'active' => "groups",
];  
    return view('groups.index',compact('uicongfig'));
 }


 public function get(Request $request)
 {
  //echo"<pre>";print_r($request->All());exit;
     return Groups::where('id',$request->id)->first();
 }

 public function list(Request $request)
 {

     if (!$request->ajax()) {
         return response()->json([
           "status" => "fail",
           "message" => "Bad Request."
         ], 401);
       }
   
       $list = Groups::orderBy('id','Desc')->get();
       return datatables($list)
         ->addIndexColumn()
         ->addColumn('status', function ($row) {
          if ($row->status) {
            
            return '<button type="button" class="btn btn-block btn-danger btn-sm" onclick="changestatus('.($row->id).')">Disable</button>';
          } else {
            return '<button type="button" class="btn btn-block btn-success btn-sm" onclick="changestatus('.($row->id).')">Enable</button>';
          }
        })
        ->rawColumns(['status'])
         ->make(true); 
  //echo"<pre>";print_r($list);exit;


 }

 public  function status(Request $request)
 {
   $user = Groups::where('id',$request->id)->first();
   if ($user) {
     if ($user->status) {
       $user->status = 0;
     } else {
       $user->status = 1;
     }
     $user->save();
     return response()->json(array(
       'error' => 0,
       'msg' => "Staff status has been changed successfully."
     ), 200);
   } else {
     return response()->json(array(
       'error' => 1,
       'msg' => "Staff status failed to change."
     ), 200);
   }
 }

//category
 public function categoryindex(){

  $uicongfig = [
    'title' => "Category",
    'header' => "Category",
    'active' => "category",
];  
    return view('groups.category',compact('uicongfig'));
 }

 public function categoryget(Request $request)
 {
  //echo"<pre>";print_r($request->All());exit;
     return Category::where('category_id',$request->category_id)->first();
 }
 
 public function categorylist(Request $request)
 {
 // echo"<pre>";print_r($request->All());exit;
     if (!$request->ajax()) {
         return response()->json([
           "status" => "fail",
           "message" => "Bad Request."
         ], 401);
       }
   
       $list = Category::get();
       return datatables($list)
         ->addIndexColumn()
         ->addColumn('status', function ($row) {
          if ($row->status) {
            
            return '<button type="button" class="btn btn-block btn-danger btn-sm" onclick="changestatus('.($row->id).')">Disable</button>';
          } else {
            return '<button type="button" class="btn btn-block btn-success btn-sm" onclick="changestatus('.($row->id).')">Enable</button>';
          }
        })
         ->make(true); 
  //echo"<pre>";print_r($list);exit;


 }
}

 
