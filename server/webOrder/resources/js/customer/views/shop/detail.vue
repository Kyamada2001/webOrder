<template>
    <div class="flex form-row">
        <div class="w-1/5">
            サイドバー
        </div>
        <div class="container pr-10">
            <div>{{ shopDetails.name }}の店舗詳細</div>
            <div class="flex flex-row flex-wrap">
                <div v-for="product in shopDetails.product" v-bind:key="product.id" class="mr-4 py-3 w-1/5">
                    <div class="border rounded">
                        <div>
                            <img v-if="product.imgpath" class="border-b-1" :src="pathhead + product.imgpath">
                            <img v-else class="border-b-1" :src="pathhead + noimgpath">
                        </div>
                        <div class="pl-2 py-2">
                            <label>{{ product.name }}</label>
                            <br><label>{{ product.price.toLocaleString() }}円</label>
                        </div>
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
            shopDetails: {},
            pathhead: '/storage/',
            noimgpath: 'images/product_noimage.png',
        }
    },
    methods: {
        async getShopDetails(){
            const response = await axios.get('/api/shop/detail', {
                params: {
                    shopId: this.$route.params.shopId
                }
            });
        
        this.shopDetails = response.data.shopDetails;
        }
    },
    watch: {
        $route: {
        async handler () {
            await this.getShopDetails();
        },
        immediate: true
        }
    }
}
</script>