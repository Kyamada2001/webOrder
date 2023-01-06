@extends('business.layouts.app')
@section('title','お客様一覧')
@section('content')
<div id="app" class="p-1 md:p-6 bg-white">
    <div class="p-1 md:p-6 bg-white">
        <div class="pb-2">
            <p>全{{ count($customers) }}件</p>
        </div>
        <div>
            <table class="min-w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <td class="thead-item">ID</td>
                        <td class="thead-item">ユーザー名</td>
                        <td class="thead-item">メールアドレス</td>
                        <td class="thead-item">アカウント作成日時</td>
                    </tr>
                </thead>
                @foreach($customers as $customer)
                <tbody>
                    <tr class="bg-white bcustomer-b dark:bg-gray-800 dark:bcustomer-gray-700">
                        <td class="py-3 px-1 text-sm font-medium text-sky-400 whitespace-nowrap dark:text-sky-400 hover:underline decoration-solid">{{ $customer->id }}</td>
                        <td class="py-3 px-1 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $customer->username }}</td>
                        <td class="py-3 px-1 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $customer->email }}</td>
                        <td class="py-3 px-1 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $customer->created_at }}</td>
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