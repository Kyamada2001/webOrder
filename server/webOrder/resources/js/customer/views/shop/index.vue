<template>
    <div class="flex form-row">
        <div class="w-1/5">
            サイドバー
        </div>
        <div class="container pr-10">
            <div>店舗一覧</div>
            <div class="space-y-4">
                <div class="flex flex-row border-t border-t-gray-200 pt-4" v-for="shop in shops" v-bind:key="shop.id">
                    <div>
                        <img v-if="shop.imgpath" class="border" :src="pathhead + shop.imgpath">
                        <img v-else class="border" :src="pathhead + noimgpath">
                    </div>
                    <div class="pl-4">
                        <router-link 
                        :to="{
                            name: 'shopDetail',
                            params: {
                                shopId: shop.id,
                            }
                        }" 
                        class="text-blue-700 text-xl font-bold hover:text-amber-400 hover:underline">
                            {{ shop.name }}
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    data() {
        return {
            shops: {},
            pathhead: '/storage/',
            noimgpath: 'images/noimage.png',
        }
    },
    methods: {
        async fetchShops(){
        const response = await axios.get('/api/shops');


        this.shops = response.data.shops;
        }
    },
    watch: {
        $route: {
        async handler () {
            await this.fetchShops();
        },
        immediate: true
        }
    }
}
</script>