@extends('business.layouts.app')
@section('title', '管理アカウント編集')
@section('content')
<div id="app" class="p-6 bg-white">
    <form action="{{ route('business.user.update', ['user' => $user]) }}" method="post">
        @csrf
        <div class="divide-gray-200 space-y-3">
            <div class="form-control">
                <div class="form-label">
                    <label>アカウント名</label>
                </div>
                <div>
                    <input class="w-full h-10 px-3 mb-2 text-base text-gray-700 border ring-stone-400 rounded focus:shadow-outline outline-gray-400  @error('username') border-red-400 @enderror"
                            type="text" name="username" value="{{ old('name', $user->username ?? null) }}">
                    @if($errors->has('username'))
                        @foreach($errors->get('username') as $error)
                        <div>
                            <p class="text-red-500 text-xs italic mb-3">{{ $error }}</p>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="form-control">
                <div class="form-label">
                    <label>メールアドレス</label>
                </div>
                <div>
                    <input class="w-full h-10 px-3 mb-2 text-base text-gray-700 border ring-stone-400 rounded focus:shadow-outline outline-gray-400  @error('email') border-red-400 @enderror"
                            type="email" name="email" value="{{ old('email', $user->email) }}">
                    @if($errors->has('email'))
                        @foreach($errors->get('email') as $error)
                        <div>
                            <p class="text-red-500 text-xs italic mb-3">{{ $error }}</p>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="form-control">
                <div class="form-label">
                    <label>パスワード</label>
                </div>
                <div>
                    <input class="w-full h-10 px-3 mb-2 text-base text-gray-700 border ring-stone-400 rounded focus:shadow-outline outline-gray-400  @error('password') border-red-400 @enderror"
                            type="password" name="password">
                    @if($errors->has('password'))
                        @foreach($errors->get('password') as $error)
                        <div>
                            <p class="text-red-500 text-xs italic mb-3">{{ $error }}</p>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="form-control">
                <div class="form-label">
                    <label>パスワード確認</label>
                </div>
                <div>
                    <input class="w-full h-10 px-3 mb-2 text-base text-gray-700 border ring-stone-400 rounded focus:shadow-outline outline-gray-400  @error('password') border-red-400 @enderror"
                            type="password" name="password_confirmation">
                    @if($errors->has('password_confirmation'))
                        @foreach($errors->get('password_confirmation') as $error)
                        <div>
                            <p class="text-red-500 text-xs italic mb-3">{{ $error }}</p>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="flex justify-center py-4">
                <button class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 border rounded">送信</button>
            </div>
        </div>
    </form>
</div>

@endsection

@section('script')
@endsection