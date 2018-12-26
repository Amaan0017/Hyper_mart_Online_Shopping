<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Country;
use Auth;
use Session;
use Validator;
use DB;
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller
{
    public function userLoginRegister(){
        return view('users.login_register');  
    }
    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                Session::put('frontSession',$data['email']);
                if(!empty(Session::get('session_id'))){
                $session_id = Session::get('session_id');
                DB::table('cart')->where('session_id',$session_id)->update(['user_email'=>$data['email']]);
                }
                return redirect('/cart');
            }else{
                return redirect()->back()->with('flash_message_error','Invalid username & password');
            }
        }

    }
    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>";print_r($data);die;
            //Check if user already exists 
            $userCount = User::where('email',$data['email'])->count();
            if($userCount>0){
                return redirect()->back()->with('flash_message_error','Email already exists!');
            }else{
                //adding users in table
                $user =new User;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->save();
                if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                    Session::put('frontSession',$data['email']);
                if(!empty(Session::get('session_id'))){
                    $session_id = Session::get('session_id');
                    DB::table('cart')->where('session_id',$session_id)->update(['user_email'=>$data['email']]);
                }
                    return redirect('/cart');
                }
            }
        }
    }
    public function checkEmail(Request $request){
            //Check if user already exists 
            $data = $request->all();
            $userCount = User::where('email',$data['email'])->count();
            if($userCount>0){
             echo "false";
            }else{
                echo "true";die;
            }
    }
    public function account(Request $request){
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
        $countries = Country::get();

        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['country'])){
                return redirect()->back()->with('flash_message_error','Please Enter your Country ');
            }
            $user = User::find($user_id);
            $user->email = $data['email'];
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->state = $data['state'];
            $user->country = $data['country'];
            $user->pincode = $data['pincode'];
            $user->mobile = $data['mobile'];
            $user->save();
            return redirect()->back()->with('flash_message_success','Your Account Detail has been Successfully Updated!!');

        }
        return view('users.account')->with(compact('countries','userDetails'));
    }
    public function chkUserPassword(Request $request){
        $data = $request->all();
        //echo"<pre>";print_r($data);die;
        $current_password = $data['current_pwd'];
        $user_id = Auth::User()->id;
        $check_password = User::where('id',$user_id)->first();
        if(Hash::check($current_password,$check_password->password)){
            echo "true";die;
        }else{
            echo"false";die;
        }

    }
    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo"<pre>";print_r($data);die;
            $old_pwd = User::where('id',Auth::User()->id)->first();
            $current_pwd = $data['current_pwd'];
            if(Hash::check($current_pwd,$old_pwd->password)){
                //update password
            $new_pwd = bcrypt($data['new_pwd']);
            User::where('id',Auth::User()->id)->update(['password'=>$new_pwd]);
            return redirect()->back()->with('flash_message_success','Password is updated Successfully!!');
            }else{
                return redirect()->back()->with('flash_message_error','Current Password is incorrect!');
            }
        }
    }
    public function logout(){
        Auth::logout();
        Session::forget('frontSession');
        Session::forget('session_id');
        return redirect('/');
    }
}
