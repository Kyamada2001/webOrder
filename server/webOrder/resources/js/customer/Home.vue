<template>
    <diV class="h-screen">
        <header class="bg-stone-100 h-20 border-t-4 border-b-2 border-t-orange-400 border-b-gray-300 shadow-sm sticky top-0">
            <Navbar/>
        </header>

        <main class="h-full">
            <router-view/>
        </main>

        <footer class="flex h-40 md:h-20 bg-gray-100 text-sm items-center pb-20 md:pb-0"><p class="italic">@{{ new Date().getFullYear() }} webOrder</p></footer>

        <!-- 画面縮小時に表示 -->
        <div class="md:hidden bg-stone-100 h-20 border border-b-gray-300 shadow-sm fixed bottom-0 mt-2 w-full">
            <BottomNavigation/>
        </div>
    </diV>
</template>

<script>
import Navbar from './components/Navbar.vue'
import BottomNavigation from './components/BottomNavigation.vue'
import { INTERNAL_SERVER_ERROR } from '../util.js'

export default{
    components: {
        Navbar,
        BottomNavigation,
    },
    computed: {
        errorCode(){
            return this.$store.state.error.code;
        }
    },
    watch: {
        errorCode: {
            handler(val){
                if(val === INTERNAL_SERVER_ERROR){
                    this.$router.push('/500');
                }
            },
            immediate: true
        },
        $route () {
            this.$store.commit('error/setCode', null)
        }
    }
}
</script>
