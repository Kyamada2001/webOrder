<template>
<div>
    <div class="h-1/6">
        <div>
            <h1 class="px-10 py-1 text-sm font-serif text-gray-500">気軽にwebで注文できるサービス</h1>
        </div>
    </div>
    <div class="flex flex-row justify-items-stretch">
        <div class="px-10 pb-3 w-screen">
            <h1 class="font-serif text-2xl text-orange-500">webOrder</h1>
        </div>
        <div class="flex flex-row inset-y-0 right-0 px-4 pb-5 justify-end items-end w-screen">
            <div class="px-4">
                <router-link class="hover:text-orange-300 text-sm" to="#">会員登録</router-link>
            </div>
            <div class="pl-1 pr-6">
                <router-link class="hover:text-orange-300 text-sm" to="#">ログイン</router-link>
            </div>
        </div>
    </div>
</div>
</template>