<?php

namespace App\Http\Controllers\Business;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Shop;
use Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;        
    }

    public function index()
    {
        $users = User::get();
        return view('business.users.index', [
            'users' => $users,
        ]);
    }

    public function create () {
        $user = $this->user;
        return view('business.users.create', [
            'user' => $user,
        ]);
    }

    public function edit (Request $request, User $user) {
        $user = User::find($user->id);
        return view('business.users.edit', [
            'user' => $user,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        try{
            DB::beginTransaction();
            $user = $this->user;
            $attribute = $request->only(['username', 'email', 'password']);
            $user->fill($attribute);
            $user->password = Hash::make($attribute['password']);
            $user->save();
            DB::commit();
        }catch(\Exception $e){
            Log::error('user,store()' . $e);
            throw $e;
            // abort(500);
        }
        return redirect()->route('business.user.index');


        
    }

    // Serviceクラスを作成して処理をまとめたい
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        try{
            DB::beginTransaction();
            $user = User::find($user->id);
            $attribute = $request->only(['username', 'email', 'password']);
            $user->fill($attribute);
            $user->password = Hash::make($attribute['password']);
            $user->save();
            DB::commit();
        }catch(\Exception $e){
            Log::error('user,store()' . $e);
            throw $e;
            // abort(500);
        }

        return redirect()->route('business.user.index');
    }
}
