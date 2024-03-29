@extends('business.layouts.app')
@section('title','管理アカウント一覧')
@section('content')
<div id="app" class="p-1 md:p-6 bg-white">
    <div class="flex justify-center">
        <a class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 border rounded" href="{{ route('business.user.create') }}">
            新規登録
        </a>
    </div>
    <div class="p-1 md:p-6 bg-white">
        <div class="pb-2">
            <p>全{{ count($users) }}件</p>
        </div>
        <div>
            <table class="min-w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <td class="thead-item">ID</td>
                        <td class="thead-item md-vertical-text">アカウント名</td>
                        <td class="thead-item">メールアドレス</td>
                        <!-- <td class="thead-item">削除</td> -->
                    </tr>
                </thead>
                @foreach($users as $user)
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-3 px-1 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $user->id }}</td>
                        <td class="py-3 px-1 text-sm font-medium text-sky-400 whitespace-nowrap dark:text-sky-400 hover:underline decoration-solid"><a href="{{ route('business.user.edit', ['user' => $user]) }}">{{ $user->username }}</a></td>
                        <td class="py-3 px-1 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $user->email }}</td>
                        <!-- 一旦削除ボタンについては非表示に -->
                        <!-- <td class="flex justify-center items-center py-3 px-1 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hover:underline decoration-solid">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg> -->
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                            </svg> -->
                        <!-- </td> -->
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection