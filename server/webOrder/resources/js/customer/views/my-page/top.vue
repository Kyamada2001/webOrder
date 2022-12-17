<template>
<div>
    <div class="side-menu-container flex flex-col items-center space-y-2">
        <div class="text-2xl pt-8 font-semibold">マイページ</div>
        <div class="w-full flex md:flex-row-reverse">
            <div class="hidden md:flex flex-col w-full">メイン</div>
            <div class="flex flex-col w-full md:w-64"><my-page-menu/></div>
        </div>
    </div>
</div>
</template>

<script>
import myPageMenu from '../../components/myPageMenu.vue';
import logoutModal from '../../components/logout-modal.vue';

export default {
    components:{
        myPageMenu,
        logoutModal,
    },
    data() {
        return {
            logoutModalFlg: false
        }
    },
}
</script>
