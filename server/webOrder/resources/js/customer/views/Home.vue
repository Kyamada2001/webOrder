<template>
    <diV class="h-full">
        <header class="bg-stone-100 h-1/5">
            <Navbar/>
        </header>

        <main>
            <div class="container">
                メイン
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
