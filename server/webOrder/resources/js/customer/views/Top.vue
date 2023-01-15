<template>
        <!-- カート商品があったら表示 -->
        <!-- <div class="side-menu">
            <SideMenu/>
        </div> -->
        <div class="relative w-full h-full animate-box-focus-in">
            <div class="h-full">
                <img class="w-full object-cover" style="min-height:100%;max-height:100%;" :src="IMG_PATH_HEAD +'images/top/top-1.jpg'">
                <div class="w-4/5 md:w-1/2 absolute top-1/4 inset-10 md:inset-x-1/4 font-serif space-y-5">
                    <p class="text-2xl text-white text-center animate-text-focus-in">-好きなものを好きな時に-</p>
                    <div class="grid md:flex md:flex-row w-full place-content-around animate-text-focus-in-delay">
                        <router-link to="/shops"><p class="text-xl text-orange-300 hover:underline">お店を選ぶ</p></router-link>
                        <router-link to="/products"><p class="text-xl text-orange-300 hover:underline">商品を選ぶ</p></router-link>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
import SideMenu from '../components/SideMenu.vue'
import { mapState } from 'vuex'

export default {
    components: {
        SideMenu,
    },
    computed: {
        ...mapState(['IMG_PATH_HEAD', 'NO_IMG_PATH']),
    }


}
</script>
