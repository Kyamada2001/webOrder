<template>
    <div class="flex form-row pt-5 b-nav-pb">
        <div class="side-menu">
            <SideMenu/>
        </div>
        <div class="side-menu-container">
            <div class="page-title">{{ shopDetails.name }}の店舗詳細</div>
            <div class="flex flex-wrap w-full gap-2 mt-5">
                <div v-if="errorMessage" class="bg-orange-50 w-full rounded mx-1 my-1 text-red-500">
                    <div class="pl-3 py-5">{{ errorMessage }}</div>
                </div>
                <div v-for="product in shopDetails.product" v-bind:key="product.id" class="product-items">
                    <div  @click="modalOpen(product)">
                        <div class="border rounded">
                            <div>
                                <img v-if="product.imgpath" class="border-b w-full h-36 object-cover" :src="IMG_PATH_HEAD + product.imgpath">
                                <img v-else class="border-b w-full h-36 object-cover" :src="IMG_PATH_HEAD + NO_IMG_PATH">
                            </div>
                            <div>
                                <div class="flex justify-start pt-1 pl-1">{{ product.name }}</div>
                                <div class="flex justify-end pb-1 pr-2">{{ product.price.toLocaleString() }}円</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <add-cart-modal v-if="open" @close="closeModal" :product="modalProduct" :modalStatus="'add'" :shop="shopDetails"/>
    </div>
</template>

<script>
import { OK } from '../../../util'
import { mapState } from 'vuex'
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
            modalProduct: { Object }, //モーダル商品
            open: false,
            errorMessage: null,
        }
    },
    computed: {
        ...mapState(['IMG_PATH_HEAD', 'NO_IMG_PATH']),
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
        },
        async nothingMessage(){
            let nothingProduct = Object.keys(this.shopDetails.product).length < 1;
            if (nothingProduct) this.errorMessage = '店舗に注文可能な商品がありません';
            else                this.errorMessage = null;
        }
    },
    async created() {
        await this.getShopDetails();
        this.nothingMessage();
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