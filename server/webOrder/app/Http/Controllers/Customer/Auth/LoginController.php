<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::CUSTOMER_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:customer')->except('logout');
    }

    public function authenticate(Request $request)
    {
        $authentication_info = $request->only('email','password');
        if(Auth::guard('customer')->attempt($authentication_info)){
            return Auth::guard('customer')->user();
        }else{
            return response()->json(['errors' => 'メールアドレスまたはパスワードが違います'] ,422);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        // セッションを再生成する
        $request->session()->regenerate();

        return response()->json();
    }
}
