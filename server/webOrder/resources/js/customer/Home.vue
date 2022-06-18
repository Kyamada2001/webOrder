<template>
    <diV class="h-fit">
        <header class="bg-stone-100 h-20 border-t-4 border-b-2 border-t-orange-400 border-b-gray-300 shadow-sm sticky top-0">
            <Navbar/>
        </header>

        <main class="h-screen">
            <router-view/>
        </main>
    </diV>
</template>

<script>
import Navbar from './components/Navbar.vue'
import { INTERNAL_SERVER_ERROR } from '../util.js'

export default{
    components: {
        Navbar,
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
