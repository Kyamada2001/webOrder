<template>
    <div class="container px-4">
        <div class="border rounded h-auto">
            <div class="bg-gray-100 h-10">
                <label class="flex justify-center pt-2 text-lg font-semibold">選択中の商品</label>
            </div>
            <div>
                <p v-if="!cartProducts[0]" class="flex justify-center py-3">カートに商品がありません。</p>
                <div v-else class="space-b-2">
                    <div v-for="cartProduct in cartProducts" :key="cartProduct.id"  class="border bg-orange-50 rounded my-2 mx-2">
                        <div>
                            <div class="border-b border-b-gray-200">
                                <div class="pl-3 pt-1">{{ cartProduct.name }}</div>
                                <div class="flex justify-end pb-1 pr-3">{{ cartProduct.price.toLocaleString() }}円</div>
                            </div>
                            <div class="flex flex-row">
                                <div class="pl-3 py-1">{{ cartProduct.modalInput.quantity }}点</div>
                                <div class="flex justify-end py-1 pr-3">{{ (cartProduct.price * cartProduct.modalInput.quantity) }}円</div>
                            </div>
                        </div>
                        <div class="flex flex-row">
                            <button type="button" class="w-1/2 rounded text-white bg-red-500 focus:outline-none hover:bg-red-400">変更</button>
                            <button type="button" class="w-1/2 rounded text-white bg-green-600 focus:outline-none hover:bg-green-500">削除</button>
                        </div>
                    </div>
                    <div class="pl-3">
                        <div>合計金額</div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    data(){
        return {
            cartProducts: {},
        }
    },
    computed: {
        computedCartProducts(){
            console.log(this.$store.getters['order/cartProducts']);
            return this.$store.getters['order/cartProducts'];  
        },
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
