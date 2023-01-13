<template>
    <div class="flex flex-row">
        <!-- カート商品があったら表示 -->
        <!-- <div class="side-menu">
            <SideMenu/>
        </div> -->
        <div class="h-80">
            <img class="border-b w-fit h-80 object-cover" :src="IMG_PATH_HEAD +'images/top/top-1.jpg'">
            <!-- <div class="z-20"></div> -->
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
