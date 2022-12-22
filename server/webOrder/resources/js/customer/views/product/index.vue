<template>
    <div class="flex form-row pt-5 b-nav-pb">
        <div class="side-menu">
            <SideMenu/>
        </div>
        <div class="side-menu-container">
            <div class="page-tile">商品一覧</div>
            <div class="flex flex-wrap justify-evenly w-full">
                <div v-for="product in products" v-bind:key="product.id" class="w-1/2 py-3 md:mr-5 sm:w-44">
                    <button type="button" @click="modalOpen(product)">
                        <div class="border rounded">
                            <div>
                                <img v-if="product.imgpath" class="border-b w-44 h-36 object-cover" :src="IMG_PATH_HEAD + product.imgpath">
                                <img v-else class="border-b w-44 h-36 object-cover" :src="IMG_PATH_HEAD + NO_IMG_PATH">
                            </div>
                            <div>
                                <div class="flex justify-start pt-1 pl-1 tex-sm text-gray-500">{{ displayShop(product).name }}</div>
                                <div class="flex justify-start pt-1 pl-1">{{ product.name }}</div>
                                <div class="flex justify-end pb-1 pr-2">{{ product.price.toLocaleString() }}円</div>
                            </div>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        <add-cart-modal v-if="open" @close="closeModal" :product="modalProduct" :modalStatus="'add'" :shop="displayShop(modalProduct)"/>
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
            products: {},
            shops: {},
            modalProduct: { Object }, //モーダル商品
            open: false,
        }
    },
    methods: {
        async getProducts(){
            const response = await axios.get('/api/products')
            .catch(err => err.response || err); //catchハンドラーがないと以降の処理が実行されない

            if(response.status !== OK) {
                this.$store.commit('error/setCode', response.status);
                return false;
            }
        
            this.products = response.data.products;
            this.shops = response.data.shops;

        },
        modalOpen(product){
            this.modalProduct = JSON.parse(JSON.stringify(product));
            this.open = true;
        },
        closeModal(){
            this.modalProduct = null;
            this.open = false;
        },
        displayShop(product) {
            let shop =  this.shops.filter(shop => {
                return shop.id == product.shop_id;
            });
            return shop[0];
        }
    },
    computed: {
        ...mapState(['IMG_PATH_HEAD', 'NO_IMG_PATH']),
    },
    created() {
        this.getProducts();
    }
}
</script>