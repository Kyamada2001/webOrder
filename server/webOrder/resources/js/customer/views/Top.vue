<template>
    <div class="flex flex-row">
        <div class="side-menu">
            <SideMenu/>
        </div>
        <div class="side-menu-container">
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
