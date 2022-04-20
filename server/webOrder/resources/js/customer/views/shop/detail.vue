<template>
    <div class="flex form-row pt-5">
        <div class="w-96">
            <SideMenu
            @updateCartProduct="showAddCartModal"/>
        </div>
        <div class="container pr-10">
            <div>{{ shopDetails.name }}の店舗詳細</div>
            <div class="flex flex-wrap">
                <div v-for="product in shopDetails.product" v-bind:key="product.id" class="mr-5 py-3 w-44">
                    <button type="button" @click="addStatus(product)">
                        <div class="border rounded">
                            <div>
                                <img v-if="product.imgpath" class="w-full border-b" :src="pathhead + product.imgpath">
                                <img v-else class="w-full border-b" :src="pathhead + noimgpath">
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
        <add-cart-modal v-if="addCartModalStatus" title="商品選択" v-on:close="closeModal">
            <div class="flex flex-row">
                <div class="w-1/2">
                    <img v-if="modalProduct.imgpath" class="border-b w-full" :src="pathhead + modalProduct.imgpath">
                    <img v-else class="border w-full" :src="pathhead + noimgpath">
                    <div class="text-lg">{{ modalProduct.name }}</div>
                    <div class="flex justify-end text-lg">{{ modalProduct.price }}円</div>
                </div>
                <div class="w-full px-4">
                    <label>数量</label>
                    <select
                    v-model="modalProduct.modalInput.quantity"
                        class="w-full px-2 py-1 rounded-md border border-gray-300 shadow-sm">
                        <option v-for="n in 99" :value="n">{{ n }}</option>
                    </select>
                </div>
            </div>
            <div class="text-right mt-4">
                <button @click="closeModal" class="px-4 py-2 text-sm text-gray-600 focus:outline-none hover:underline">キャンセル</button>
                <button @click="addCart" class="mr-2 px-4 py-2 text-sm rounded text-white bg-red-500 focus:outline-none hover:bg-red-400">カートに追加</button>
            </div>
        </add-cart-modal>
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
            addCartModalStatus: false,
            modalProduct: { Object }, //モーダル商品
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
        addStatus(product){
            let modalStatus = 'add';
            this.showAddCartModal(product, modalStatus);
        },
        showAddCartModal(product, modalStatus){//もっといい処理があるかも。productの値をそのままモーダルに持って来れたり
            this.modalProduct = JSON.parse(JSON.stringify(product));
            this.modalProduct.modalStatus = modalStatus;
            if(!this.modalProduct.hasOwnProperty('modalInput')) this.$set(this.modalProduct,'modalInput', { quantity: 1 })
            this.addCartModalStatus = true;
        },
        addCart(){
            this.$store.commit('order/setCartProducts',this.modalProduct);
            this.modalProduct = null;
            this.addCartModalStatus = false;
        },
        closeModal(){
            this.modalProduct = null;
            this.addCartModalStatus = false;
        }
    },
    watch: {
        $route: {
            handler () {
                this.getShopDetails();
            },
            immediate: true
        },
    },
}
</script>