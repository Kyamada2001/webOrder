<template>
    <div class="flex form-row">
        <div class="w-1/5">
            サイドバー
        </div>
        <div class="w-4/5">
            <div>店舗一覧</div>
            <div>
                <div v-for="shop in shops" v-bind:key="shop.id">
                    <label>{{ shop.name }}</label>
                    <img v-if="shop.imgpath" class="h-28 w-auto" :src="pathheader + shop.imgpath">
                    <img v-else class="h-28 w-auto" :src="pathheader + noimgpath">
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
            pathheader: 'storage/',
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