<template>
<div class="border-orange-300">
    <div class="h-1/5">
        <div>
            <h1 class="px-2 py-1 text-sm font-serif text-gray-500">気軽にwebで注文！</h1>
        </div>
    </div>
    <div class="grid grid-rows-2">
        <div class="px-3 pb-3">
            <h1 class="font-serif text-xl text-orange-500">webOrder</h1>
        </div>
        <div class="flex flex-row absolute inset-y-0 right-0 px-4 py-2">
            <div class="px-4">
                <router-link class="hover:text-orange-300 text-sm" to="#">会員登録</router-link>
            </div>
            <div class="px-3">
                <router-link class="hover:text-orange-300 text-sm" to="#">ログイン</router-link>
            </div>
        </div>
    </div>
</div>
</template>