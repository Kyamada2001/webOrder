<template>
    <div class="w-full space-y-10">
        <div class="divide-y-2 border-gray-200 mt-8 md:mt-0">
            <router-link to="/order/histories" class="relative flex flex-row hover:bg-gray-100 py-2 border-y-2 border-gray-200">
                <p>注文履歴</p>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute right-0 w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </router-link>
        </div>
        <div>
            <div @click="logoutModalFlg = true" class="relative flex flex-row hover:bg-gray-100 py-2 border-y-2 border-gray-200">
                <button class="text-blue-400">ログアウト</button>
            </div>
        </div>
        <logout-modal v-if="logoutModalFlg" v-on:close="logoutModalFlg = false"/>
    </div>
</template>

<script>
import logoutModal from '../components/logout-modal.vue';

export default {
    components:{
        logoutModal,
    },
    data() {
        return {
            logoutModalFlg: false,
        }
    },
    methods: {
    }
}
</script>