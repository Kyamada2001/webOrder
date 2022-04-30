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
            <div class="text-center text-2xl font-semibold">注文確認</div>
            <div class="flex justify-center w-full rounded bg-gray-200">
                <div class="bg-orange-50 w-full rounded mx-1 my-1">
                    <div class="grid grid-cols-3 pl-2 py-3">
                        <div class="col-span-1">合計金額( {{ total.quantity }} 点)</div>
                        <div class="col-span-1">：</div>
                        <div class="col-span-1">{{ total.price }}円</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        cartProducts(){
            return this.$store.getters['order/cartProducts'];
        },
        total() {
            let total = new Object();
            total.quantity = 0;
            total.price = 0;
            Object.keys(this.cartProducts).forEach(key => {
                total.quantity += this.cartProducts[key].modalInput.quantity;
                total.price += this.cartProducts[key].price * this.cartProducts[key].modalInput.quantity;
            });
            return total;
        }
    }
}
</script>