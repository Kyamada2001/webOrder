<?php

namespace App\Http\Controllers\Business\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Auth::guard('user')->logout();
        $this->middleware('guest:user')->except('logout','adminLogout');
    }

    public function index(){
        return view('business.login.index');
    }

    public function authenticate(Request $request)
    {
        $this->validator($request->toArray());;
        $authenticationInfo = $request->only('name','password');
        if(Auth::guard('user')->attempt($authenticationInfo)){
            return redirect(route('business.shop.index'));
        }else{
            return back()->withErrors([
                'auth' => ['ユーザー名かパスワードが違います']
            ]);
        }
    }

    public function logout(Request $request)
    {
        // $request->session()->regenerate();
        Auth::guard('user')->logout();
        $request->session()->regenerate();

        return redirect()->route('business.login.index');
    }

    // public function adminLogout(Request $request) {
    //     // Auth::guard('user')->logout();
    //     \Log::info('logout');
    //     \Log::info(Auth::guard('user')->user());
    //     \Log::info(Auth::guard('customer')->user());
    //     Auth::guard('user')->logout();

    //     return redirect()->route('business.login.index');
    // }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}
