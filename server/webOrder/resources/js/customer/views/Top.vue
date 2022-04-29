<template>
    <div class="flex flex-row">
        <div class="w-96">
            <SideMenu/>
        </div>
        <div class="container pr-10">
            トップ画面
        </div>
    </div>
</template>

<script>
import SideMenu from '../components/SideMenu.vue'

export default {
    components: {
        SideMenu,
    }

}
</script>
