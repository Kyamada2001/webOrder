<template>
    <div class="flex flex-row">
        <input class="w-full h-10 px-3 mb-2 text-base text-gray-700 border ring-stone-100 rounded-lg focus:shadow-outline outline-black"
            type="text" :value="computedPrice" name="product_price">
        <label class="mt-3">円</label>
    </div>
</template>

<script>
export default{
    props: {
        data:{
            price: Number,
        }
    },
    data(){
        return {
            dataPrice: Number,
        }
    },
    computed: {
        computedPrice: {
            get(){
                return this.data.price;
            },
            set(newVal){
                this.dataPrice = newVal;
            }
        }
    },
    filters: {
        formatPrice: function(price){
            //price.replace(/[^0-9]/g, '');
            return price.toLocaleString();
        }
    },
    
}
</script>