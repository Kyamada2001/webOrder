<template>
  <div class="fixed w-full h-full top-0 left-0 flex items-center justify-center z-10">
    <div class="bg-action-close absolute w-full h-full bg-gray-900 opacity-50" @click="close"></div>

    <div class="absolute w-full px-3 md:w-2/3">
      <div class="container bg-white overflow-hidden md:rounded">
        <div class="px-4 py-4 leading-none flex justify-between items-center font-medium text-sm bg-gray-100 border-b select-none">
          <h3 v-if="modalStatus == config.MODAL_STATUS.STATUS_ADD 
              || modalStatus == config.MODAL_STATUS.STATUS_UPDATE" class="text-lg font-semibold">カートに追加</h3>
          <h3 v-if="modalStatus ==config.MODAL_STATUS.STATUS_DELETE" class="text-lg font-semibold">カートから削除</h3>
          <div @click="close" class="text-2xl hover:text-gray-600 cursor-pointer">
            &#215;
          </div>
        </div>

        <div v-if="modalProduct" class="max-h-full px-4 py-4">
          <div  v-if="modalStatus ==config.MODAL_STATUS.STATUS_ADD || modalStatus == config.MODAL_STATUS.STATUS_UPDATE" class="flex flex-row">
            <div class="w-1/2">
                <img v-if="modalProduct.imgpath" class="border-b w-64 h-44 object-cover" :src="pathhead + modalProduct.imgpath">
                <img v-else class="border w-64 h-44 object-cover" :src="pathhead + noimgpath">
                <div class="text-lg">{{ modalProduct.name }}</div>
                <div class="flex justify-end text-lg">{{ modalProduct.price.toLocaleString() }}円</div>
            </div>
            <div class="w-full px-4">
                <label>数量</label>
                <select
                    v-model="modalProduct.modalInput.quantity"
                    class="w-full px-2 py-1 rounded-md border border-gray-300 shadow-sm">
                    <option v-for="n in 99" :value="n">{{ n }}</option>
                </select>
            </div>
          </div>
          <div v-if="modalStatus == config.MODAL_STATUS.STATUS_DELETE" class="max-h-full px-4 py-4">
            <div>
              <p>{{ modalProduct.name }}を<br>カートから削除しますか？</p>
            </div>
          </div>
          <div class="text-right mt-4">
              <button @click="close" class="px-4 py-2 text-sm text-gray-600 focus:outline-none hover:underline btn-close">キャンセル</button>
              <button v-if="modalStatus == config.MODAL_STATUS.STATUS_ADD"    @click="addCart" class="mr-2 px-4 py-2 text-sm rounded text-white bg-red-500 focus:outline-none hover:bg-red-400 btn-action">カートに追加</button>
              <button v-if="modalStatus == config.MODAL_STATUS.STATUS_UPDATE" @click="addCart" class="mr-2 px-4 py-2 text-sm rounded text-white bg-red-500 focus:outline-none hover:bg-red-400 btn-action">変更する</button>
              <button v-if="modalStatus == config.MODAL_STATUS.STATUS_DELETE" @click="addCart" class="mr-2 px-4 py-2 text-sm rounded text-white bg-red-500 focus:outline-none hover:bg-red-400 btn-action">削除する</button>
          </div>
        </div>
        <div v-else class="max-h-full px-4 py-4">
          <div class="text-red-400 font-serif font-semibold"><p>商品を選択できませんでした。再度お試しください。</p></div>
        </div>
        
      </div>
    </div>
  </div>
</template>

<script>
import { config } from '../const.js'

  export default {
    data() {
      return {
        productAffiliationShop: { Object },
        modalProduct: null,
        pathhead: '/storage/',
        noimgpath: 'images/noimage.png',
      };
    },
    props: {
      shop: Object,
      product: Object,
      modalStatus: String,
      config: { default: () => config }
    },
    methods: {
      close() {
        this.modalProduct = null;
        this.productAffiliationShop = null;
        this.$emit('close');
        console.log(config);
      },
      addCart(){
        this.$store.dispatch('order/cartAction', { 
          productAffiliationShop: this.productAffiliationShop, 
          InputProduct: this.modalProduct
        });
        this.close();
      },
    },
    watch: {
      product: {
        handler($val){
          this.modalProduct = JSON.parse(JSON.stringify($val));
          this.$set(this.modalProduct, 'modalStatus', this.modalStatus);
          if(!this.modalProduct.hasOwnProperty('modalInput')) this.$set(this.modalProduct,'modalInput', { quantity: 1 })
        },
        immediate: true,
        deep: true,
      },
      shop: {
        handler($val){
          this.productAffiliationShop = JSON.parse(JSON.stringify($val));
        },
        immediate: true,
        deep: true,
      }
    },
    mounted() {
      const onEscape = (e) => {
        if (e.key === "Esc" || e.key === "Escape") {
          this.close();
        }
      };
      document.addEventListener("keydown", onEscape);

      this.$once("hook:beforeDestroy", () => {
        document.removeEventListener("keydown", onEscape);
      });
    },
  };
</script>