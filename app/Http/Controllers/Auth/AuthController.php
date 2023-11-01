<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Department;
use App\Models\Groups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 
use Stringable;
use Mail; 
// use Illuminate\Mail\Mailable;
class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
      if (Auth::check()) {

        return redirect()->route('dashboard');
    }

        return view('authui.login');
    } 
 
    public function dashboard()
    {
        return view('dashboard.home');
    }
    
    public function get(Request $request)
    {
       
        $count['groups'] = Groups::count();
        $count['category'] =Category::count();
    
        // echo"<pre>";print_r($count['teacher']);exit;
        return $count;
    }

    public function login(Request $request)
    {
        
      if (Auth::check()) {
        return redirect()->route('dashboard');
    }
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
        if ($user = User::where('name',$request->name)->first()) {
          if (Hash::check($request->password,$user->password)) {
              if ($user->status != 0) {
                  return back()->with('danger','User account is disable.')->onlyInput('email');
              }
              if($user->isDeleted == 1) {
                return back()->with('danger','User account  is delete.')->onlyInput('email');
            }           
            }
          }
        //   echo Hash::make('Test@123');
        //   var_dump(Hash::check($request->password,$user->password));
        //   echo"<pre>";print_r($user);exit;
        $credentials = [
            'name' => $request->name,
            'password' => $request->password,
        ];
        // echo"<pre>";print_r($credentials);exit;

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard')
                        ->with('success','You have Successfully log in');
        }
  
        return back()->with('danger','username or password are wrong.')->onlyInput('email');
    }
    
    public function forgot(){
        return view('authui.forgot');
    }

   
  
     /**
       * Write code on Method
       *
       * @return response()
       */
    


    public function logout() {
      
        Auth::logout();
  
        return Redirect('login');
    }

   
}