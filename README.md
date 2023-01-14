## ディレクトリ構成
.
├── docker　　　　　　　　　　　　    docker環境構築ファイル格納ディレクトリ
│   ├── db
│   │   ├── data
│   │   ├── my.conf
│   │   └── sql
│   ├── nginx
│   └── php
└── server
    └── webOrder 　　　　　　　　    Laravelプロジェクトディレクトリ
        ├── app                   サーバー側ファイル格納ディレクトリ
        │   ├── Console
        │   ├── Exceptions
        │   ├── Http
        │   │   ├──Controllers    Controllerファイル格納ディレクトリ
        │   │   └──Middleware     Middlewareファイル格納ディレクトリ
        │   ├── Models
        │   └── Providers
        ├── bootstrap
        │   └── cache
        ├── config                設定ファイル格納ディレクトリ
        ├── database
        │   ├── factories
        │   ├── migrations        migrationファイル格納ディレクトリ
        │   └── seeders           seederファイル格納ディレクトリ
        ├── resources             フロント側ファイル格納ディレクトリ
        │   ├── css               CSSファイル格納ディレクトリ 
        │   │   ├──business         管理画面CSSファイル格納ディレクトリ
        │   │   └──customer         ユーザー画面CSSファイル格納ディレクトリ
        │   ├── js                JSファイル格納ディレクトリ(Vueファイルも含む)
        │   │   ├──business         管理画面JSファイル格納ディレクトリ
        │   │   └──customer         ユーザー画面JSファイル格納ディレクトリ(SPA用のファイル格納)
        │   ├── lang
        │   ├── sass              SCSSファイル格納ディレクトリ
        │   │   ├──business         管理画面SCSSファイル格納ディレクトリ
        │   │   └──customer         ユーザー画面SCSSファイル格納ディレクトリ
        │   └── views             bladeファイル格納ディレクトリ
        │   │   ├──business         管理画面bladeファイル格納ディレクトリ
        │   │   └──customer         ユーザー画面bladeファイル格納ディレクトリ
        └── routes                ルーティングファイル格納ディレクトリ


## WEBアプリケーション概要
当アプリケーションは飲食店へWEBから注文する、という想定で制作しております。
ユーザー側画面はSPAになっております。
ユーザー側システムの流れは以下のようになります。

## ユーザー側システムの流れ
### 1.会員登録・ログインする
・会員登録、ログイン選択画面
<img width="1402" alt="スクリーンショット 2023-01-15 2 11 46" src="https://user-images.githubusercontent.com/93695486/212485916-be3c153d-0df6-4847-8754-7d53e10b7a94.png">

・ログイン画面
<img width="1402" alt="スクリーンショット 2023-01-15 2 14 37" src="https://user-images.githubusercontent.com/93695486/212486194-cae79a67-9de7-4653-a755-149c0b3af48c.png">

### 2.店舗一覧、商品一覧へ遷移し、注文する商品をカートに追加する
・店舗一覧画面
<img width="1403" alt="スクリーンショット 2023-01-15 2 17 12" src="https://user-images.githubusercontent.com/93695486/212486397-14573b47-c50f-46d3-91ec-20b2790764b5.png">


・店舗商品一覧
<img width="1403" alt="スクリーンショット 2023-01-15 2 17 20" src="https://user-images.githubusercontent.com/93695486/212486409-b6e5a09b-405d-408d-ab94-23cc36daba09.png">


・商品一覧
<img width="1402" alt="スクリーンショット 2023-01-15 2 17 30" src="https://user-images.githubusercontent.com/93695486/212486422-0bd51f2d-8dd1-41ae-a8a0-622835c930c1.png">

・カート追加モーダル(商品一覧の商品を押下)
<img width="1403" alt="スクリーンショット 2023-01-15 2 19 36" src="https://user-images.githubusercontent.com/93695486/212486475-fb60cb24-15c3-490c-a6ca-cc14a0fc8139.png">

・店舗商品一覧(カート追加後)
<img width="1400" alt="スクリーンショット 2023-01-15 2 21 43" src="https://user-images.githubusercontent.com/93695486/212486561-b44cf741-5f9a-4b9d-9856-78da6a05bbfa.png">

### 3.商品カート追加後、カート画面へ遷移し、必須情報を入力する
・カート画面(お支払いへ進むボタンを押下して遷移する)
<img width="1401" alt="スクリーンショット 2023-01-15 2 24 15" src="https://user-images.githubusercontent.com/93695486/212486736-4b282aec-c93a-45fe-87b6-c8bd3a92cd5e.png">

・商品受取日時予約モーダル(任意の商品受取日時を押下。※管理画面で設定した定休日、営業時間外の場合は選択できない)
<img width="1402" alt="スクリーンショット 2023-01-15 2 28 01" src="https://user-images.githubusercontent.com/93695486/212486852-d49f4f3b-b01d-46c9-80ef-70803c8b1394.png">

・カート画面(商品受取日時選択後)
<img width="1404" alt="スクリーンショット 2023-01-15 2 28 08" src="https://user-images.githubusercontent.com/93695486/212486885-9ae54227-50a2-404b-8d96-1466ee997abf.png">


### 4.注文確認画面へ遷移し、注文を確定する
・注文確認画面
<img width="1403" alt="スクリーンショット 2023-01-15 2 29 59" src="https://user-images.githubusercontent.com/93695486/212487085-52e0da05-d000-45f3-9510-4e17e899cc9b.png">

### 5.注文を確定し、注文完了画面へ遷移
・注文完了画面
<img width="1402" alt="スクリーンショット 2023-01-15 2 32 56" src="https://user-images.githubusercontent.com/93695486/212487124-4e471861-de53-49d8-a5d2-c791e49e795e.png">

### 6.注文は注文履歴画面から確認できる
・注文履歴画面
<img width="1403" alt="スクリーンショット 2023-01-15 2 33 06" src="https://user-images.githubusercontent.com/93695486/212487134-9b25907e-6767-46e9-bc3f-9085ccfd6e9f.png">

