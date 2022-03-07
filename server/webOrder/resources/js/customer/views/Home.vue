<template>
    <diV class="h-full">
        <header class="bg-stone-100 h-1/6 border-t-4 border-orange-400">
            <Navbar/>
        </header>

        <main>
            <div class="container">
                <router-view></router-view>
            </div>
        </main>

        <footer>
        フッター
        </footer>
    </diV>
</template>

<script>
import Navbar from '../components/Navbar.vue'

export default{
    components: {
        Navbar,
    },
}
</script>
