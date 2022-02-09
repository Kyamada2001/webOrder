<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('/css/business/app.css') }}" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div>
            <h1>店舗一覧</h1>
    </div>
</body>
        <div>
            <table class="min-w-full leading-normal">
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">店舗ID</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">店舗名</td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">営業時間</td>
                </tr>
                @foreach($shops as $shop)
                <tr>
                    <td>{{ $shop->id }}</td>
                    <td>{{ $shop->name }}</td>
                    <td>{{ $shop->business_hour }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>
</html>