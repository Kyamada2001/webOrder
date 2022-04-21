<template>
    <div class="container px-4">
        <div class="border rounded h-auto">
            <div class="bg-gray-100 h-10">
                <label class="flex justify-center pt-2 text-lg font-semibold">選択中の商品</label>
            </div>
            <div>
                <p v-if="!cartProducts[0]" class="flex justify-center py-3">カートに商品がありません。</p>
                <div v-else class="space-b-2">
                    <div v-for="cartProduct in cartProducts" :key="cartProduct.id"  class="border bg-orange-100 rounded my-2 mx-2">
                        <div class="pl-4 py-1 space-y-1">
                            <div class="border-b-2 border-b-white py-1">
                                <div>{{ cartProduct.name }}</div>
                            </div>
                            <div class="grid grid-cols-3">
                                <div class="col-span-2">{{ cartProduct.modalInput.quantity }}点</div>
                                <div class="col-span-1">{{ (cartProduct.price * cartProduct.modalInput.quantity).toLocaleString() }}円</div>
                            </div>
                        </div>
                        <div class="flex flex-row pb-2 px-3 space-x-3">
                            <button type="button" @click="addUpdateStatus(cartProduct)" class="w-1/2 rounded text-white bg-green-600 focus:outline-none hover:bg-green-500">変更</button>
                            <button type="button" @click="addDeleteStatus(cartProduct)" class="w-1/2 rounded text-white bg-red-500 focus:outline-none hover:bg-red-400">削除</button>
                        </div>
                    </div>
                    <div class="flex flex-row border-b-2 border-b-black mb-2 mx-4">
                        <div class="w-24">合計</div>
                        <div class="flex justify-end w-full">{{ totalPrice.toLocaleString() }}円</div>
                    </div>
                </div>
            </div>
        </div>
        <add-cart-modal v-if="open" @close="closeModal" :product="modalProduct" :modalStatus="modalStatus"/>
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
            cartProducts: { Object },
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
            Object.keys(this.cartProducts).forEach(key => {
                total += this.cartProducts[key].price * this.cartProducts[key].modalInput.quantity;
            });
            return total;
        },
    },
    methods: {
        addUpdateStatus(product){
            this.modalStatus = 'update';
            this.openModal(product);
        },
        addDeleteStatus(product){
            this.modalStatus = 'delete';
            this.openModal(product);
        },
        openModal(product){
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
                this.cartProducts = Object.assign({}, $val);
            },
            immediate: true
        }
    }
}
</script>
