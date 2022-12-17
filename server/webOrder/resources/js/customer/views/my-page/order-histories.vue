<template>
<div>
    <div class="side-menu-container flex flex-col items-center space-y-2 b-nav-pb">
        <div class="text-2xl pt-8 font-semibold">注文履歴</div>
        <div class="w-full flex md:flex-row">
            <div class="hidden md:w-64 md:flex"><my-page-menu/></div>
            <div class="w-full space-y-5">
                <div v-for="orderHistory in orderHistories" :key="orderHistory.id" class="flex flex-col w-full rounded bg-gray-200">
                    <div class="my-2 mx-2 rounded">
                        <div class="bg-orange-50 w-full rounded px-2 py-2 space-y-1">
                            <div class="flex flex-row">
                                <label>注文番号：</label>
                                <label>{{ orderHistory.id }}</label>
                            </div>
                            <div class="flex flex-row">
                                <label>注文時間：</label>
                                <label>{{ orderHistory.order_time }}</label>
                            </div>
                            <div>
                                <label>お支払い合計（1点）：</label>
                                <label>{{ orderHistory.total_amount }}</label>
                            </div>
                            <div>
                                <label>受取時間：</label>
                                <label>{{ orderHistory.total_quantity }}</label>
                            </div>
                            <div>
                                <label>注文ステータス：</label>
                                <label>{{ displayOrderStatus(orderHistory.status) }}</label>
                            </div>
                        </div>
                        <div v-for="order_detail in orderHistory.order_detail" :key="order_detail.id" class="bg-white">
                            <div class="rounded flex flex-row w-full border-b py-2 border-gray-300">
                                <div class="mx-2 my-2 shadow-lg">
                                    <img v-if="order_detail.product_imgpath" class="w-44 h-36 object-cover" :src="pathhead + order_detail.product_imgpath">
                                    <img v-else class="w-44 h-36 object-cover" :src="pathhead + noimgpath">
                                </div>
                                <div class="grid grid-cols-2 gap-py-2 pl-4 w-full py-2">
                                    <div class="col-span-2">{{ order_detail.product_name }}</div>
                                    <div class="col-span-1">
                                        <label>数量</label>
                                        <p class="w-full px-2 py-1">{{ order_detail.product_quantity }}</p>
                                    </div>
                                    <div class="col-span-1"></div>
                                    <div class="col-end-3 col-span-1 underline">小計 {{ (order_detail.product_price * order_detail.product_quantity).toLocaleString() }}円</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <pagination :currentPage="currentPage" :perPage="perPage" :total="total" @change="handlePageChange"/>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import myPageMenu from '../../components/myPageMenu.vue';
import pagination from '../../components/pagination.vue';

export default {
    data() {
        return {
            pathhead: '/storage/',
            noimgpath: 'images/noimage.png',
            orderHistories: { Object },
            // pagination用
            currentPage: 1,
            perPage: 5,
            total: 0
        }
    },
    components: {
        myPageMenu,
        pagination,
    },
    methods:{
        displayOrderStatus(orderStatus){
            switch(orderStatus){
                case "0":
                    return '未受渡';
                case "1":
                    return '受渡済';
                case "2":
                    return 'キャンセル'
            }
        },
        handlePageChange(page) {
            this.currentPage = page;
            this.fetchOrderHistories();
        },
        async fetchOrderHistories() {
            await axios.get(`/api/my-page/order-histories?page=${this.currentPage}&per_page=${this.perPage}`)
                .then(response => {
                this.orderHistories = response.data.orders;
                this.total = response.data.total;
            });
            window.scrollTo(0, 0);
        }
    },
    created(){
        this.fetchOrderHistories(1);
    },
}
</script>
