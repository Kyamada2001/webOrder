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
            <div v-if="!Object.keys(cartProducts).length < 1" class="flex justify-center w-full rounded bg-gray-200 px-1 py-1">
                <div class="bg-white w-full rounded px-2 py-1">
                    <div>
                        <label class="block text-sm">携帯電話番号(ハイフンなし11桁)<span class="text-sm text-red-500">[必須]</span></label>
                        <input v-model="orderInfo.telephoneNumber" class="border rounded border-gray-300 w-full px-2 space-x-1" type="text"/>
                        <p v-if="message.telephoneNumber" class="text-sm text-red-500">{{ message.telephoneNumber }}</p>
                    </div>
                    <div>
                        <label class="block text-sm">商品受取日時<span class="text-sm text-red-500">[必須]</span></label>
                        <div>
                            <div class="flex flex-row border border-gray-300 w-full">
                                <div class="border border-gray-300 w-20 align-middle">予約日付</div>
                                <div class="flex flex-row w-full">
                                    <div class="divide-x divide-gray-300 w-auto" v-for="dateTime in dateTimes" :key="dateTime.id">
                                        <div class="justify-content-center border-b border-gray-300 px-2 py-1">{{ dateTime.month }}/{{ dateTime.date }}</div>
                                        <div class="hover:bg-orange-50" v-bind:class="{'bg-orange-300': dateTime.joinDate === storeOrderTime.date.joinDate}">
                                            <button class="px-2 py-2" @click="openOrderTimeModal(dateTime)" type="button">{{ displayDayOfWeek(dateTime.dayOfWeek) }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <base-modal v-if="showOrderTimeModal" title="商品受取時間予約" width="1/2" @close="closeOrderTimeModal">
                <div>
                    <label>予約日付</label>
                    <select v-model="modalSelectDateTime.selected.date.date" class="border border-gray-300 rounded py-1 px-1">
                        <option v-for="dateTime in dateTimes" :value="dateTime.date" :key="dateTime.id">
                            {{dateTime.joinDate + '('+ displayDayOfWeek(dateTime.dayOfWeek) + ')'}}
                        </option>
                    </select>
                </div>
                <div>
                    <label>予約日時</label>
                    <select v-model="modalSelectDateTime.selected.time" class="border border-gray-300 rounded py-1 px-1">
                        <option v-for="timeList in modalSelectDateTime.timeList" :value="timeList">
                            {{ timeList }}
                        </option>
                    </select>
                </div>

                <div class="text-right mt-4">
                    <button @click="closeOrderTimeModal" class="px-4 py-2 text-sm text-gray-600 focus:outline-none hover:underline">閉じる</button>
                    <button @click="reserveOrderTime" class="mr-2 px-4 py-2 text-sm rounded text-white bg-red-500 focus:outline-none hover:bg-red-400">予約</button>
                </div>
            </base-modal>

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
                    <input type="radio" value="0" v-model="orderInfo.prepaid_flg">
                    <label>代金引換</label>
                    <input type="radio" value="1" v-model="orderInfo.prepaid_flg">
                    <label>事前決済(クレジットカード)</label>
                </div>
                <button v-if="orderInfo.prepaid_flg == 0" @click="checkForm" type="button" class="text-white bg-red-500 hover:bg-red-400 rounded py-1 px-2">注文確認画面へ</button>
                <button v-if="orderInfo.prepaid_flg == 1" @click="checkForm" type="button" class="text-white bg-red-500 hover:bg-red-400 rounded py-1 px-2">お支払い画面へ</button>
            </div>
        </div>
    </div>
</template>

<script>
import BaseModal from '../../components/BaseModal.vue'
import OrderTimeDropdown from '../../components/ordertime-dropdown.vue';
export default{
    components: {
        BaseModal,
        OrderTimeDropdown
    },
    data() {
        return {
            cartProducts: { Object },
            total: {
                price: 0,
                quantity: 0,
            },
            orderInfo: {
                telephoneNumber: '',
                creditNumber: '',
                prepaid_flg: 0, 
                time: {},
            },
            message: { Object },
            pathhead: '/storage/',
            noimgpath: 'images/product_noimage.png',
            showOrderTimeModal: false,
            orderTime: [
                '13:00',
                '14:00',
                '15:00',
            ],//開発用
            modalSelectDateTime: {
                year: '',
                month: '',
                date: '',
                dayOfWeek: '',
                joinDate: '', //年月日をまとめたもの
                timeList: Array,
                selected: {},
            },
        }
    },
    methods: {
        checkForm(){
            if(this.orderInfo.telephoneNumber.toString().length > 11 || this.orderInfo.telephoneNumber.toString().length < 11){
                this.$set(this.message, 'telephoneNumber', "11桁の電話番号を入力して下さい");
            }else{
                this.$store.commit('order/setOrderInfo', this.orderInfo);
                if(this.orderInfo.prepaid_flg == 0) this.$router.push('/order/confirmation');
                else if(this.orderInfo.prepaid_flg == 1) this.$router.push('/order/confirmation');
            }
        },
        openOrderTimeModal(dateTime){
            this.modalSelectDateTime = Object.assign({}, dateTime);
            if(!this.storeOrderTime.date.date){//すでに予約しているか判定0
                this.modalSelectDateTime.selected = {
                    date:{
                        year: dateTime.year,
                        month: dateTime.month,
                        date: dateTime.date,
                        joinDate: dateTime.joinDate,
                    },
                    time: dateTime.timeList[0],
                };
            }else{
                this.modalSelectDateTime.selected = Object.assign({}, this.storeOrderTime);
            }
            this.showOrderTimeModal = true;

        },
        closeOrderTimeModal(){
            this.modalSelectDateTime = [];
            this.showOrderTimeModal = false;
        },
        reserveOrderTime(){
            this.$store.commit('order/setOrderTime', { date: this.modalSelectDateTime.selected.date, time: this.modalSelectDateTime.selected.time });
            this.showOrderTimeModal = false;
        },
        displayDayOfWeek(dayOfWeekFlg){
            switch(dayOfWeekFlg){
                case 0:
                    return '日';
                case 1:
                    return '月';
                case 2:
                    return '火';
                case 3:
                    return '水';
                case 4:
                    return '木';
                case 5:
                    return '金';
                case 6:
                    return '土';
            }
        }
    },
    computed: {
        storeOrderTime(){
            return this.$store.state.order.orderInfo.order_time;
        },
        computedCartProducts(){
            return this.$store.getters['order/cartProducts'];
        },
        computedOrderInfo(){
            return this.$store.state.order.orderInfo;
        },
        productAffiliationShops(){
            return this.$store.state.order.productAffiliationShops;
        },
        dateTimes(){
            const nowDate = new Date();
            const endDate = new Date().setDate(new Date().getDate() + 14);//2週間ループする
            let dateList = new Array();
            
            for(var d = new Date(); d <= endDate; d.setDate(d.getDate()+1)) {
                //if(JSON.stringify(nowDate) === JSON.stringify(d) || nowDate.getMonth() !== d.getMonth()) var date = (d.getMonth() + 1) + '/' + d.getDate();
                //else var date = d.getDate();
                var year = d.getFullYear();
                var month = d.getMonth() + 1;
                var date = d.getDate();
                var dayOfWeek = d.getDay();
                var joinDate = year + '年' + month + '月' + date + '日';
                dateList.push({ year: year, month: month, date: date, dayOfWeek: dayOfWeek, joinDate: joinDate, timeList: this.orderTime});// orderTimeは開発用
            }
            return dateList;
        }
    },
    created: function(){
        this.orderInfo = this.computedOrderInfo;
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
      orderInfo: {
        handler($val){
            this.orderInfo.telephoneNumber = $val.telephoneNumber.replace(/[^0-9]/g, '');
        },
        immediate: true,
        deep: true,
      },
      modalSelectDateTime: {
          handler: function(next, before){
              if(next.joinDate === before.joinDate){
                var selectDateTimeList = this.dateTimes.filter( function(value){
                    return value.joinDate === next.joinDate;
                })
                this.modalSelectDateTime.timeList = selectDateTimeList.timeList;
              }
          },
          deep: true
       },
    },

}
</script>
