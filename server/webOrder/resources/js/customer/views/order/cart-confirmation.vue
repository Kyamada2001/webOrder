<template>
    <div class="h-full">
        <div class="cursor-pointer ml-7 relative group w-auto inline-block">
            <a class="pl-3" @click="$router.back()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div class="absolute invisible group-hover:visible rounded-md text-center mt-2 px-1 py-1 w-12 border border-gyra-400">戻る</div>
        </div>
        <div class="container mx-auto mt-5 space-y-3">
            <div class="text-center text-2xl font-semibold">カート</div>
            <div class="flex justify-center w-full rounded bg-gray-200">
                <div class="bg-orange-50 w-full rounded mx-1 my-1">
                    <div v-if="Object.keys(cartProducts).length < 1" class="pl-2 py-3">カートに商品がありません。</div>
                    <div v-else class="grid grid-cols-3 pl-2 py-3">
                        <div class="col-span-1">合計金額( {{ total.quantity }} 点)</div>
                        <div class="col-span-1">：</div>
                        <div class="col-span-1">{{ total.price.toLocaleString() }}円</div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center w-full rounded bg-gray-200 px-1 py-1">
                <div class="bg-white w-full rounded px-2 py-1">
                    <label class="block text-sm">携帯番号(ハイフンなし11桁)<span class="text-sm text-red-500">[必須]</span></label>
                    <input v-model="telephoneNumber" class="border rounded border-gray-300 w-full px-2 space-x-1" type="text"/>
                    <p v-if="message.telephoneNumber" class="text-sm text-red-500">{{ message.telephoneNumber }}</p>
                </div>
            </div>
            <div v-for="cartProduct in cartProducts" :key="cartProduct.id" class="border-b border-gray-300">
                <div class="rounded flex flex-row w-full border-b py-2 border-gray-300">
                    <div class="mx-2 my-2 shadow-lg">
                        <img v-if="cartProduct.imgpath" class="w-44 h-36 object-cover" :src="pathhead + cartProduct.imgpath">
                        <img v-else class="w-44 h-36 object-cover" :src="pathhead + noimgpath">
                    </div>
                    <div class="grid grid-cols-2 gap-py-2 pl-4 w-full py-2">
                        <div class="col-span-2">{{ cartProduct.name }}</div>
                        <div class="col-span-1">
                            <label>数量</label>
                            <select
                            v-model="cartProduct.modalInput.quantity"
                            class="w-full px-2 py-1 rounded-md border border-gray-300 shadow-sm">
                                <option v-for="n in 99" :value="n">{{ n }}</option>
                            </select>
                        </div>
                        <div class="col-span-1"></div>
                        <div class="col-end-3 col-span-1 underline">小計 {{ (cartProduct.price * cartProduct.modalInput.quantity).toLocaleString() }}円</div>
                    </div>
                </div>
            </div>
            <div v-if="Object.keys(cartProducts).length > 0" class="flex justify-end sticky bottom-0 bg-gray-200 bg-opacity-75 w-auto rounded px-2 py-2 space-x-3">
                <div class="bg-white rounded py-1 px-2">
                    <input type="radio" value="0" v-model="prepaid_flg">
                    <label>代金引換</label>
                    <input type="radio" value="1" v-model="prepaid_flg">
                    <label>事前決済(クレジットカード)</label>
                </div>
                <button v-if="prepaid_flg == 0" @click="checkForm" type="button" class="text-white bg-red-500 hover:bg-red-400 rounded py-1 px-2">注文確認画面へ</button>
                <button v-if="prepaid_flg == 1" @click="checkForm" type="button" class="text-white bg-red-500 hover:bg-red-400 rounded py-1 px-2">お支払い画面へ</button>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    data() {
        return {
            cartProducts: { Object },
            total: {
                price: 0,
                quantity: 0,
            },
            telephoneNumber: '',
            message: { Object },
            pathhead: '/storage/',
            noimgpath: 'images/product_noimage.png',
            prepaid_flg: 0,
        }
    },
    methods: {
        checkForm(){
            if(this.telephoneNumber.toString().length > 11 || this.telephoneNumber.toString().length < 11){
                this.$set(this.message, 'telephoneNumber', "11桁の電話番号を入力して下さい");
            }else{
                if(this.prepaid_flg == 0) this.$router.push('/');
                else if(this.prepaid_flg == 1) this.$router.push('/');
            }
        }
    },
    computed: {
        computedCartProducts(){
            return this.$store.getters['order/cartProducts'];
        }
    },
    watch: {
      computedCartProducts: {
        handler($val){
            this.cartProducts = Object.assign({},$val);
        },
        immediate: true,
      },
      cartProducts: {
        handler($val){
            this.total.price = 0;
            this.total.quantity = 0;
            Object.keys($val).forEach(key => {
                let str_computedCartProduct = JSON.stringify(this.computedCartProducts[key]);
                let str_updateCartProduct = JSON.stringify($val[key]);
                this.total.quantity += $val[key].modalInput.quantity;
                this.total.price += $val[key].price * $val[key].modalInput.quantity;
                if(str_computedCartProduct == str_updateCartProduct){
                    let data = {
                        index: key,
                        InputProduct: $val[key]
                    };
                    this.$store.commit('order/updateCart', data);
                }
            });
          },
        immediate:true,
        deep: true,
      },
      telephoneNumber: {
        handler($val){
            this.telephoneNumber = $val.replace(/[^0-9]/g, '');
        }
      }
    },

}
</script>
