<template>
    <div class="flex form-row pt-5">
        <div class="w-96">
            <SideMenu/>
        </div>
        <div class="container pr-10">
            <div>{{ shopDetails.name }}の店舗詳細</div>
            <div class="flex flex-row flex-wrap">
                <div v-for="product in shopDetails.product" v-bind:key="product.id" class="mr-4 py-3 w-1/5">
                    <div class="border rounded">
                        <div>
                            <button>
                                <img v-if="product.imgpath" class="border-b" :src="pathhead + product.imgpath">
                                <img v-else class="border-b" :src="pathhead + noimgpath">
                            </button>
                        </div>
                        <div class="pl-2 py-2">
                            <label>{{ product.name }}</label>
                            <br><label>{{ product.price.toLocaleString() }}円</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { OK } from '../../../util'
import SideMenu from '../../components/SideMenu.vue' //なぜかSideMenuが大文字だとエラーが発生する、、要改善

export default{
    components: {
        SideMenu,
    },
    data(){
        return {
            shopDetails: {},
            pathhead: '/storage/',
            noimgpath: 'images/product_noimage.png',
        }
    },
    methods: {
        async getShopDetails(){
            const response = await axios.get('/api/shop/detail', {
                params: {
                    shopId: this.$route.params.shopId
                }
            }).catch(err => err.response || err); //catchハンドラーがないと以降の処理が実行されない

            if(response.status !== OK) {
                this.$store.commit('error/setCode', response.status);
                return false;
            }

            this.shopDetails = response.data.shopDetails;
        }
    },
    watch: {
        $route: {
        handler () {
            this.getShopDetails();
        },
        immediate: true
        }
    }
}
</script>