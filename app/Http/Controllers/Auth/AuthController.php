<?php

namespace App\Http\Controllers\Auth;

use Hash;
// use Session;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;

class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        if(session('user_email') != '' && session('user_email') != ''){
            return redirect('dashboard');
        }else{
            return view('auth.login');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'ordernumber' => 'required',
        ]);

        $ordercount = Order::where('order_number', $request->ordernumber)->get();
        if (count($ordercount) > 0) {
            // order exist
            if ($ordercount[0]->user_id == null || $ordercount[0]->user_id == '') {
                // user id not exist
                $emailcount = User::where('email', $request->email)->get();
                //user check by email
                if (count($emailcount) > 0) {
                    return redirect()->back()->with('fail', 'Email Already Exist');
                } else {
                    $user = new User;
                    $user->name = $request->email;
                    $user->email = $request->email;
                    $user->password = '123456';
                    $response = $user->save();
                    if ($response) {
                        if ($user->id != '' && $user->id != null) {
                            // dd($user->id);
                            $insertuserid = Order::where('order_number', $request->ordernumber)->update(["user_id" => $user->id]);
                            if ($insertuserid) {
                                return redirect()->back()->with('success', 'User Id updated Successfully');
                            } else {
                                return redirect()->back()->with('fail', 'Error Occured while user id updation');
                            }
                        }
                        // return redirect()->back()->with('success', 'User Creatd Successfully');
                    } else {
                        return redirect()->back()->with('fail', 'Error Occured While user creation');
                    }
                }
            } else {
                //code User exist
                $userData = User::where('email', $request->email)->get();
                $orderData = Order::where('order_number',$request->ordernumber)->get();
                if(count($userData) > 0 && count($orderData) > 0){
                    Session::put('user_id',$userData[0]->id);
                    Session::put('user_email',$userData[0]->email);
                    Session::put('order_number',$orderData[0]->order_number);
                    return redirect('dashboard');
                }else{
                    return redirect()->back()->with('fail', 'The given order number is associated with other Email');
                }
            }
        } else {
            // order not exist
            return redirect()->back()->with('fail', 'Order Number Does not exist');
        }

        // $credentials = $request->only('email', 'password');
        // if (Auth::attempt($credentials)) {
        //     return redirect()->intended('dashboard')
        //         ->withSuccess('You have Successfully loggedin');
        // }

        // return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        dd('dashboard');
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout()
    {
        // dd('logout');
        Session::flush();

        return Redirect('login');
    }
}
