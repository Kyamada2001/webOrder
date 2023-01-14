<template>
    <div class="h-full">
        <div class="cursor-pointer ml-7 relative group w-auto inline-block">
            <a class="pl-3" @click="$router.back()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div class="absolute invisible group-hover:visible rounded-md text-center mt-2 px-1 py-1 w-12 border border-gray-400">戻る</div>
        </div>
        <div class="mx-3 md:container md:mx-auto mt-5 space-y-3  b-nav-pb">
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
                <div class="bg-white w-full rounded px-2 py-1 space-y-2">
                    <div>
                        <label class="block text-sm">携帯電話番号(ハイフンなし11桁)<span class="text-sm text-red-500">[必須]</span></label>
                        <input v-model="orderInfo.telephoneNumber" class="border rounded border-gray-300 w-full px-2 space-x-1" type="text"/>
                        <p v-if="message.telephoneNumber" class="text-sm text-red-500">{{ message.telephoneNumber }}</p>
                    </div>
                    <div>
                        <label class="block text-sm">商品受取日時<span class="text-sm text-red-500">[必須]</span></label>
                        <div class="flex overflow-x-auto">
                            <div class="flex flex-row w-full flex-none">
                                <div class="flex flex-row w-full">
                                    <div class="order-date-lists" v-for="dateTime in dateTimes" :key="dateTime.id">
                                        <div class="justify-content-center border-b border-gray-300 px-5 py-1">{{ dateTime.month }}/{{ dateTime.date }}</div>

                                        <div v-if="dateTime.orderAbleFlg === 0" class="bg-gray-200 flex flex-col h-12">
                                            <div class="mx-auto">{{ displayDayOfWeek(dateTime.dayOfWeek) }}</div>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-auto">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                            </svg>
                                        </div>
                                        <div v-else @click="openOrderTimeModal(dateTime)" class="cursor-pointer bg-orange-100 hover:bg-orange-50 h-12 flex flex-col">
                                            <div class="mx-auto">{{ displayDayOfWeek(dateTime.dayOfWeek) }}</div>
                                            <div class="mx-auto">
                                                <div v-if="storeOrderTime.joinDate && storeOrderTime.date == dateTime.date" class=" bg-green-300 reounded align-bottom inline-block w-full px-2">{{ storeOrderTime.time }}</div>
                                                <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 block">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zM12 2.25V4.5m5.834.166l-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243l-1.59-1.59" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p v-if="message.order_time" class="text-sm text-red-500">{{ message.order_time }}</p>
                    </div>
                </div>
            </div>

            <base-modal v-if="showOrderTimeModal" title="商品受取日時予約" @close="closeOrderTimeModal">
                <div v-if="message.orderTimeModalError">
                    <p class="text-sm text-red-500">{{ message.orderTimeModalError }}</p>
                </div>
                <div>
                    <label>予約日付</label>
                    <select v-model="modalSelectDateTime.date" v-on:change="changeSelectDate" class="border border-gray-300 rounded py-1 px-1">
                        <option v-for="dateTime in dateTimes" :value="dateTime.date" :key="dateTime.id">
                            {{dateTime.joinDate + '('+ displayDayOfWeek(dateTime.dayOfWeek) + ')'}}
                        </option>
                    </select>
                </div>
                <div>
                    <label>予約日時</label>
                    <select v-model="modalSelectDateTime.time" class="border border-gray-300 rounded py-1 px-1">
                        <option v-for="timeList in modalSelectDateTime.timeList" :value="timeList" :key="timeList.id">
                            {{ timeList }}
                        </option>
                    </select>
                </div>

                <div class="text-right mt-4">
                    <button @click="closeOrderTimeModal" class="px-4 py-2 text-sm text-gray-600 focus:outline-none hover:underline">閉じる</button>
                    <button @click="reserveOrderTime" class="mr-2 px-4 py-2 text-sm rounded text-white bg-red-500 focus:outline-none hover:bg-red-400">予約</button>
                </div>
            </base-modal>

            <div v-for="shop in productAffiliationShops" :key="shop.id">
                <div>{{ shop.name }}</div>
                <div v-for="cartProduct in viewCartProducts[shop.id]" :key="cartProduct.id" class="border-b border-gray-300">
                    <div class="rounded flex flex-row w-full border-b py-2 border-gray-300">
                        <div class="mx-2 my-2 shadow-lg">
                            <img v-if="cartProduct.imgpath" class="w-44 h-36 object-cover" :src="IMG_PATH_HEAD + cartProduct.imgpath">
                            <img v-else class="w-44 h-36 object-cover" :src="IMG_PATH_HEAD + NO_IMG_PATH">
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
                                <button type="button" @click="openCancelModal(cartProduct)" class="col-span-1"><p class="text-sm hover:underline">購入をやめる</p></button>
                            </div>
                            <div class="col-span-1 underline mt-auto">小計 {{ (cartProduct.price * cartProduct.modalInput.quantity).toLocaleString() }}円</div>
                        </div>
                    </div>
                </div>
            </div>

            <add-cart-modal v-if="cancelModalFlg" @close="closeCancelModal()" :product="cancelModalProduct" :modalStatus="'delete'" :shop="null"/>

            <div v-if="Object.keys(cartProducts).length > 0" class="flex justify-end sticky bottom-0 bg-gray-200 bg-opacity-75 w-auto rounded px-2 py-2 space-x-3">
                <div class="bg-white rounded py-1 px-2 md:flex md:flex-row">
                    <div>
                        <input type="radio" value="0" v-model="orderInfo.prepaid_flg">
                        <label>代金引換</label>
                    </div>
                    <div>
                        <input type="radio" value="1" v-model="orderInfo.prepaid_flg">
                        <label>事前決済(クレジットカード)</label>
                    </div>
                </div>
                <button v-if="orderInfo.prepaid_flg == 0" @click="checkForm" type="button" class="text-white bg-red-500 hover:bg-red-400 rounded py-1 px-2">注文確認画面へ</button>
                <button v-if="orderInfo.prepaid_flg == 1" @click="checkForm" type="button" class="text-white bg-red-500 hover:bg-red-400 rounded py-1 px-2">お支払い画面へ</button>
            </div>
        </div>
    </div>
</template>

<script>
import BaseModal from '../../components/BaseModal.vue'
import OrderTimeDropdown from '../../components/ordertime-dropdown.vue'
import addCartModal from '../../components/addCart-modal.vue'
import { OK } from '../../../util.js';
import { mapState } from 'vuex'

export default{
    components: {
        BaseModal,
        OrderTimeDropdown,
        addCartModal,
    },
    data() {
        return {
            cartProducts: { Object },
            viewCartProducts: { Object },
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
            showOrderTimeModal: false,
            modalSelectDateTime: {
                year: '',
                month: '',
                date: '',
                dayOfWeek: '',
                joinDate: '', //年月日をまとめたもの
                time: '',
                timeList: Array,
            },
            dateTimes: [],
            cancelModalFlg: false,
            cancelModalProduct: { Object },
        }
    },
    methods: {
        checkForm(){
            let errorFlg = false;
            //課題：もっといい処理書きたい。エラー発生後、クリアできていたらエラー文を非表示にしたい
            if(this.orderInfo.telephoneNumber.toString().length > 11 || this.orderInfo.telephoneNumber.toString().length < 11){
                errorFlg = true;
                this.$set(this.message, 'telephoneNumber', "11桁の電話番号を入力して下さい");
            } else this.$set(this.message, 'telephoneNumber', null);
            if(!this.$store.state.order.orderInfo.order_time.date){
                this.$set(this.message, 'order_time', "商品受取日付を選択して下さい");
                errorFlg = true;
                //注文受け取り時間が正常な時間かAPI側で判定したいが、とりあえず保留。
            }  else this.$set(this.message, 'order_time', null);
            if(!errorFlg) {
                this.$store.commit('order/setOrderInfo', this.orderInfo);
                if(this.orderInfo.prepaid_flg == 0) this.$router.push('/order/confirmation');
                else if(this.orderInfo.prepaid_flg == 1) this.$router.push('/order/confirmation');
            }
        },
        openOrderTimeModal(dateTime){
            this.getReservableDateTime();//開発用
            //this.modalSelectDateTime = Object.assign({}, dateTime);
            if(!this.storeOrderTime.date){//すでに予約しているか判定0
                this.modalSelectDateTime = Vue.util.extend({}, dateTime);
                this.modalSelectDateTime.time = JSON.parse(JSON.stringify(dateTime.timeList[0]));
                //this.$set(this, 'modalSelectDateTime', dateTime);
            }else{
                this.modalSelectDateTime = Object.assign({}, this.storeOrderTime);
            }
            this.showOrderTimeModal = true;
        },
        changeSelectDate(){
            var selectDateInfo = this.dateTimes.filter( v => v.date === this.modalSelectDateTime.date);
            this.modalSelectDateTime = Vue.util.extend({}, selectDateInfo[0]);
            //this.$set(this, 'modalSelectDateTime', selectDateInfo[0]);
            this.modalSelectDateTime.time =  JSON.parse(JSON.stringify(selectDateInfo[0].timeList[0]));
        },
        closeOrderTimeModal(){
            this.modalSelectDateTime = new Object();
            this.showOrderTimeModal = false;
            if(this.message.orderTimeModalError) this.$set(this.message, 'orderTimeModalError', null);
        },
        reserveOrderTime(){
            if(this.modalSelectDateTime.orderAbleFlg == 0){
                this.$set(this.message, 'orderTimeModalError', "選択した日時は予約できません。");
                return false;
            }else{
                this.$set(this.message, 'orderTimeModalError', null);
            }
            this.$store.commit('order/setOrderTime', this.modalSelectDateTime);
            this.showOrderTimeModal = false;
        },
        displayDayOfWeek(dayOfWeekFlg){
            switch(dayOfWeekFlg){
                case "0":
                    return '日';
                case "1":
                    return '月';
                case "2":
                    return '火';
                case "3":
                    return '水';
                case "4":
                    return '木';
                case "5":
                    return '金';
                case "6":
                    return '土';
            }
        },
        async getReservableDateTime(){
            const response = await axios.get('/api/shop/reservable-dateTime', {
                params: {
                    shop_id: this.$store.state.order.productAffiliationShops[0].id,//データを改竄されないようにサーバー側で店舗情報は取得する
                },
            }).catch(err => err.response || err);
            
            if(response.status !== OK) {
                this.$store.commit('error/setCode', response.status);
                return false;
            }

            this.dateTimes = response.data.dateTimes;
        },
        openCancelModal(product){
            this.cancelModalFlg = true;
            this.cancelModalProduct = product;
        },
        closeCancelModal(){
            this.cancelModalFlg = false;
            this.cancelModalProduct = null;
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
        ...mapState(['IMG_PATH_HEAD', 'NO_IMG_PATH']),
    },
    created: function(){
        this.orderInfo = this.computedOrderInfo;
        this.dateTimes = this.getReservableDateTime();
    },
    watch: {
      computedCartProducts: {
        handler($val){
            this.cartProducts = Object.assign({},$val);
            // もっといい処理を作りたい。(表示用、処理用と分けているのをまとめたり)
            this.productAffiliationShops.forEach(function(shop){
                let shopProduct = $val.filter(product =>{
                    return shop.id == product.shop_id;
                });
                this.$set(this.viewCartProducts, shop.id, shopProduct);
            }, this);
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
    },

}
</script>
