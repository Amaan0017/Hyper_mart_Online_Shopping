<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use App\Order;
use App\Product;
use App\Coupon;
use App\Category;
use illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    public function login(Request $request){
      if($request->isMethod('post')){
         $data = $request->input();
         if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
           //echo "Success"; die;
           //Sesion::put('adminSession',$data['email']);
           return redirect('admin/dashboard');
         }else{
           //echo "Failed"; die;
           return redirect('/admin')->with('flash_message_error','Invalid Username or Password');
         }
      }
      return view('admin.admin_login');
    }
    public function dashboard($id=null){
      $userCount = User::paginate();
      $orderCount = Order::paginate();
      $productsAll = Product::paginate();
      $couponCount = Coupon::paginate();
      $categoryCount = Category::paginate();
      /*if(Session::has('adminSession')){
        //perform all dashboard taks
      }else{
        return redirect('/admin')->with('flash_message_error','Please login to Success');
      }*/
      return view('admin.dashboard')->with(compact('userCount','orderCount','productsAll','couponCount','categoryCount'));
    }
    public function settings(){
      return view('admin.settings');
    }
    public function chkpassword(){
      $data = $request->all();
      $current_password = $data['current_pwd'];
      $check_password = User::where(['admin'=>'1'])->first();
      if(Hash::check($current_password,$check_password->password)){
        echo "true";die;
      }else{
        echo "false";die;
      }
    }
    
    public function logout(){
      Session::flush();
      return redirect('/admin')->with('flash_message_success','Logged Out Successfully!!!');
    }
}
