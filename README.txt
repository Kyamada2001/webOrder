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
        │   ├── Models
        │   └── Providers
        ├── bootstrap
        │   └── cache
        ├── config                設定ファイル格納ディレクトリ
        ├── database
        │   ├── factories
        │   ├── migrations        migrationファイル格納ディレクトリ
        │   └── seeders           seederファイル格納ファイル
        ├── resources             フロント側ファイル格納ディレクトリ
        │   ├── css               CSSファイル格納ディレクトリ 
        │   │   ├──business         管理画面CSSファイル格納ディレクトリ
        │   │   └──customer         ユーザー画面CSSファイル格納ディレクトリ
        │   ├── js                JSファイル格納ディレクトリ(Vueファイルも含む)
        │   │   ├──business         管理画面JSファイル格納ディレクトリ
        │   │   └──customer         ユーザー画面JSファイル格納ディレクトリ(SPA)
        │   ├── lang
        │   ├── sass              SCSSファイル格納ディレクトリ
        │   │   ├──business         管理画面SCSSファイル格納ディレクトリ
        │   │   └──customer         ユーザー画面SCSSファイル格納ディレクトリ
        │   └── views             bladeファイル格納ディレクトリ
        │   │   ├──business         管理画面bladeファイル格納ディレクトリ
        │   │   └──customer         ユーザー画面bladeファイル格納ディレクトリ
        └── routes                ルーティングファイル格納ディレクトリ


## WEBアプリケーション概要
当アプリケーションは、ユーザー側をSPAにしております。
システムの流れとしては、管理画面で店舗や商品マスタを登録

## サンプルアカウントログイン情報
### ・管理画面
準備中
### ・ユーザー画面
準備中