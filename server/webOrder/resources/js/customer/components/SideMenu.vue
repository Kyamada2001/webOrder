<template>
    <div class="container px-4">
        <div class="border rounded h-auto">
            <div class="bg-gray-100 h-10">
                <label class="flex justify-center pt-2 text-lg font-semibold">選択中の商品</label>
            </div>
            <p v-if="Object.keys(computedCartProducts).length < 1" class="flex justify-center py-3">カートに商品がありません。</p>
            <div v-else class="py-2 px-2 space-y-3">
                <div v-for="productAffiliationShop in productAffiliationShops" :key="productAffiliationShop.id">
                    <div class="text-lg font-semibold">{{ productAffiliationShop.name }}</div>
                    <div class="space-y-2">
                        <div v-for="cartProduct in cartProducts[productAffiliationShop.id]" :key="cartProduct.id"  class="border bg-orange-100 rounded">
                            <div class="py-1 space-y-1">
                                <div class="border-b-2 border-b-white py-1">
                                    <div class="pl-4">{{ cartProduct.name }}</div>
                                </div>
                                <div class="grid grid-cols-3 pl-4">
                                    <div class="col-span-2">{{ cartProduct.modalInput.quantity }}点</div>
                                    <div class="col-span-1">{{ (cartProduct.price * cartProduct.modalInput.quantity).toLocaleString() }}円</div>
                                </div>
                            </div>
                            <div class="flex flex-row pb-2 px-3 space-x-3">
                                <button type="button" @click="openModal(cartProduct, 'update')" class="w-1/2 rounded text-white bg-green-600 focus:outline-none hover:bg-green-500">変更</button>
                                <button type="button" @click="openModal(cartProduct, 'delete')" class="w-1/2 rounded text-white bg-red-500 focus:outline-none hover:bg-red-400">削除</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-row border-b-2 border-b-black mb-2 mx-4">
                    <div class="w-24">合計</div>
                    <div class="flex justify-end w-full">{{ totalPrice }}円</div>
                </div>
            </div>
            <div class="px-2 py-2">
                <router-link to="/order/cart" v-if="Object.keys(computedCartProducts).length > 0" class="w-full h-9 rounded text-center pt-1 text-white bg-red-500 focus:outline-none hover:bg-red-400" type="button">お支払いへ進む</router-link>
                <p v-else class="text-center pt-1 w-full h-9 rounded text-white bg-gray-300">お支払いへ進む</p>
            </div>
        </div>
        <add-cart-modal v-if="open" @close="closeModal" :product="modalProduct" :modalStatus="modalStatus" :shop="null"/>
    </div>
</template>

<script>
import addCartModal from './addCart-modal.vue'
export default{
    components: {
        addCartModal,
    },
    data(){
        return {
            cartProducts: {},
            modalProduct: { Object },
            modalStatus: String,
            open: false,
        }
    },
    computed: {
        computedCartProducts(){
            return this.$store.getters['order/cartProducts'];
        },
        totalPrice(){
            let total = null;
            Object.keys(this.computedCartProducts).forEach(key => {
                total += this.computedCartProducts[key].price * this.computedCartProducts[key].modalInput.quantity;
            });
            return total;
        },
        productAffiliationShops(){
            return this.$store.state.order.productAffiliationShops;
        },
    },
    methods: {
        openModal(product, modalStatus){
            this.modalStatus = modalStatus;
            this.modalProduct = JSON.parse(JSON.stringify(product));
            this.open = true;
        },
        closeModal(){
            this.modalStatus = null;
            this.modalProduct = null;
            this.open = false;
        }
    },
    watch: {
        computedCartProducts: {
            handler($val){
                this.productAffiliationShops.forEach(shop =>{
                    let shopProduct = $val.filter(product =>{
                        return shop.id == product.shop_id;
                    });
                    this.$set(this.cartProducts, shop.id, shopProduct);
                });
            },
            immediate: true,
            deep: true,
        },
    }
}
</script>