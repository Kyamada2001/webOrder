<template>
<div class="w-full box-sizing">
    <div class="h-1/3">
        <div>
            <h1 class="px-10 py-1 text-sm font-serif text-gray-500">気軽にwebで注文できるサービス</h1>
        </div>
    </div>
    <div class="md:flex flex-row justify-around w-full">
        <div class="px-10 pb-3 w-1/5">
            <router-link class="font-serif text-2xl text-orange-500" to="/">webOrder</router-link>
        </div>
        <div class="md:flex justify-center w-full space-x-10 hidden">
            <router-link class="hover:text-orange-300 text-lg" to="/shops">店舗一覧</router-link>
            <router-link class="hover:text-orange-300 text-lg" to="/products">商品一覧</router-link>
        </div>
        <div v-if="isLogin" class="hidden md:flex flex-row inset-y-0 right-0 px-4 pb-5 justify-end items-end w-full">
            <div class="px-4">
                <router-link to="/my-page/top" class="hover:text-orange-300 text-sm" >{{ login_customer }}</router-link>
            </div>
            <div class="pl-1 pr-6">
                 <button @click="logoutModalFlg = true" type="button" class="hover:text-orange-300 text-sm">ログアウト</button>
            </div>
        </div>
        <div v-else class="hidden md:flex flex-row inset-y-0 right-0 px-4 pb-5 justify-end items-end w-full">
            <div class="px-4">
                <router-link class="hover:text-orange-300 text-sm" to="/member/select-register">会員登録</router-link>
            </div>
            <div class="pl-1 pr-6">
                <router-link class="hover:text-orange-300 text-sm" to="/member/select-login">ログイン</router-link>
            </div>
        </div>
        <logout-modal v-if="logoutModalFlg" v-on:close="logoutModalFlg = false"/>
        <!-- ボトムナビゲーションに変更<div @click="hambergerMenuOpen" class="md:hidden flex flex-row inset-y-0 right-0 px-7 pb-5 justify-end items-end w-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </div> -->
    </div>
    <!-- <div v-if="humbergerMenuFlg" class="fixed w-full h-full top-0 left-0 flex items-center justify-center">
        <div @click="hambergerMeneClose" class="absolute w-full h-full bg-gray-900 bg-opacity-50 z-10"></div>
    </div> -->
</div>
</template>

<script>
import logoutModal from '../components/logout-modal.vue';

export default {
    components:{
        logoutModal,
    },
    data(){
        return {
            logoutModalFlg: false,
        }
    },
    methods: {
        //　ボトムナビゲーションに変更。
        // hambergerMenuOpen(){
        //     this.humbergerMenuFlg = true;
        // },
        // hambergerMeneClose(){
        //     this.humbergerMenuFlg = false;
        // }
    },
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