<template>
    <div class="flex form-row pt-5">
        <div class="side-menu">
            <SideMenu/>
        </div>
        <div class="side-menu-container">
            <div>{{ shopDetails.name }}の店舗詳細</div>
            <div class="flex flex-wrap">
                <div v-for="product in shopDetails.product" v-bind:key="product.id" class="mr-5 py-3 w-44">
                    <button type="button" @click="modalOpen(product)">
                        <div class="border rounded">
                            <div>
                                <img v-if="product.imgpath" class="border-b w-44 h-36 object-cover" :src="pathhead + product.imgpath">
                                <img v-else class="border-b w-44 h-36 object-cover" :src="pathhead + noimgpath">
                            </div>
                            <div>
                                <div class="flex justify-start pt-1 pl-1">{{ product.name }}</div>
                                <div class="flex justify-end pb-1 pr-2">{{ product.price.toLocaleString() }}円</div>
                            </div>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        <add-cart-modal v-if="open" @close="closeModal" :product="modalProduct" :modalStatus="'add'" :shop="shopDetails"/>
    </div>
</template>

<script>
import { OK } from '../../../util'
import SideMenu from '../../components/SideMenu.vue' //なぜかSideMenuが大文字だとエラーが発生する、、要改善
import addCartModal from '../../components/addCart-modal.vue'

export default{
    components: {
        SideMenu,
        addCartModal,
    },
    data(){
        return {
            shopDetails: {},
            pathhead: '/storage/',
            noimgpath: 'images/product_noimage.png',
            modalProduct: { Object }, //モーダル商品
            open: false,
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
        },
        modalOpen(product){
            this.modalProduct = JSON.parse(JSON.stringify(product));
            this.open = true;
        },
        closeModal(){
            this.modalProduct = null;
            this.open = false;
        }
    },
    created() {
        this.getShopDetails();
    }
    /*watch: {
        $route: {
            handler () {
                this.getShopDetails();
            },
            immediate: true
        },
    },*/
}
</script>