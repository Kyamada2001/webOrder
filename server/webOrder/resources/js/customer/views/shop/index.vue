<template>
    <div class="flex form-row pt-5 b-nav-pb">
        <div class="side-menu">
            <SideMenu/>
        </div>
        <div class="side-menu-container">
            <div class="page-title">店舗一覧</div>
            <div class="space-y-4">
                <div class="flex flex-row border-t border-t-gray-200 pt-4" v-for="shop in shops" v-bind:key="shop.id">
                    <div>
                        <img v-if="shop.imgpath" class="border w-56 h-56 object-cover" :src="pathhead + shop.imgpath">
                        <img v-else class="border w-56 h-56 object-cover" :src="pathhead + noimgpath">
                    </div>
                    <div class="pl-4">
                        <router-link 
                        :to="{
                            name: 'shopDetail',
                            params: {
                                shopId: shop.id,
                            }
                        }" 
                        class="text-blue-700 page-title hover:text-amber-400 hover:underline">
                            {{ shop.name }}
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { OK } from '../../../util';
import SideMenu from '../../components/SideMenu.vue'
export default{
    components: {
        SideMenu,
    },
    data() {
        return {
            shops: {},
            pathhead: '/storage/',
            noimgpath: 'images/noimage.png',
        }
    },
    methods: {
        async fetchShops(){
            const response = await axios.get('/api/shops').catch(err => err.response || err);

            if(response.status !== OK) {
                this.$store.commit('error/setCode', response.status);
                return false;
            }

            this.shops = response.data.shops;
        }
    },
    created(){
        this.fetchShops();
    },
    /*watch: {
        $route: {
        async handler () {
            await this.fetchShops();
        },
        immediate: true
        }
    }*/
}
</script>