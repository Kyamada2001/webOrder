<template>
    <div class="flex form-row">
        <div class="w-1/5">
            サイドバー
        </div>
        <div class="container pr-10">
            <div>店舗詳細</div>
            <div class="space-y-4">
                <div class="flex flex-row border-t border-t-gray-200 pt-4" v-for="product in shopDetails.product" v-bind:key="product.id">
                    <div>
                        <img v-if="product.imgpath" class="border" :src="pathhead + product.imgpath">
                        <img v-else class="border" :src="pathhead + noimgpath">
                    </div>
                    <div class="pl-4">
                        <router-link to="#" class="text-blue-700 text-xl font-bold hover:text-amber-400 hover:underline">{{ product.id }} {{ product.name }}</router-link>
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
            noimgpath: 'images/noimage.png',
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