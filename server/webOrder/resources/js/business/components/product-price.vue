<template>
    <div class="flex flex-row">
        <input class="w-full h-10 px-3 mb-2 text-base text-gray-700 border ring-stone-100 rounded-lg focus:shadow-outline outline-black"
            type="text" v-model="productPrice" name="product_price">
        <label class="mt-3">円</label>
    </div>
</template>

<script>
export default{
    data(){
        return {
            productPrice: 1000,
        }
    },
    filters: {
        formatNumber: function(productPrice){
            return productPrice.toLocaleString();
        }
    },
    watch: {
        productPrice(val, oldVal){
            if(typeof val === 'number'){
                this.productPrice = val.toString().replace(/(\d)(?=(\d{3})+$)/g, '$1, ');        
            }
            else{
                this.productPrice = oldVal;
            }
        }
    }
}
</script>