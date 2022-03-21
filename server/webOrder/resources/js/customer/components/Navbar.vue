<template>
<div>
    <div class="h-1/6">
        <div>
            <h1 class="px-10 py-1 text-sm font-serif text-gray-500">気軽にwebで注文できるサービス</h1>
        </div>
    </div>
    <div class="flex flex-row justify-around w-full">
        <div class="px-10 pb-3 w-1/5">
            <router-link class="font-serif text-2xl text-orange-500" to="/">webOrder</router-link>
        </div>
        <div class="flex justify-center w-3/5 space-x-10">
            <router-link class="hover:text-orange-300 text-lg" to="#">店舗一覧</router-link>
            <router-link class="hover:text-orange-300 text-lg" to="#">商品一覧</router-link>
            <router-link class="hover:text-orange-300 text-lg" to="#">店舗一覧</router-link>
        </div>
        <div v-if="isLogin" class="flex flex-row inset-y-0 right-0 px-4 pb-5 justify-end items-end w-1/3">
            <div class="px-4">
                <router-link to="#" class="hover:text-orange-300 text-sm" >{{ login_customer }}</router-link>
            </div>
            <div class="pl-1 pr-6">
                <router-link to="#" class="hover:text-orange-300 text-sm">ログアウト</router-link>
            </div>
        </div>
        <div v-else class="flex flex-row inset-y-0 right-0 px-4 pb-5 justify-end items-end w-1/3">
            <div class="px-4">
                <router-link class="hover:text-orange-300 text-sm" to="/member/select-register">会員登録</router-link>
            </div>
            <div class="pl-1 pr-6">
                <router-link class="hover:text-orange-300 text-sm" to="/member/select-login">ログイン</router-link>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default{
    computed: {
        isLogin(){
            return this.$store.getters['auth/check'];
        },
        login_customer(){
            return this.$store.getters['auth/customername'];
        }
    }
}
</script>