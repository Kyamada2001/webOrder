<template>
    <diV class="h-full">
        <header class="bg-stone-100 h-20 border-t-4 border-b-2 border-t-orange-400 border-b-gray-300 shadow-sm sticky top-0">
            <Navbar/>
        </header>

        <main>
            <div class="container mx-auto">
                <router-view/>
            </div>
        </main>

        <footer>
        </footer>
    </diV>
</template>

<script>
import Navbar from './components/Navbar.vue'

export default{
    components: {
        Navbar,
    },
}
</script>
