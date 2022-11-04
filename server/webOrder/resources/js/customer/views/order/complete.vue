<template>
<div class="container mx-auto">
    <div class="flex flex-col items-center">
        <div class="text-2xl pt-8 font-semibold">注文完了</div>
        <div class="pt-1">{{ customer.username }}さん、ご注文ありがとうございます。</div>
        <div v-for="shop in order.shops"  v-bind:key="shop.id" class="pt-2">{{ shop.name }}</div>
        <div class="pt-1">へ{{ order.acceptance_datetime }}にお越しください。</div>
    </div>
</div>
</template>

<script>
//デリバリーか予約かで表示を変える。
import { OK } from '../../../util.js';
export default {
    props:{
        order:  Object ,
        customer: Object,
    },
    data(){
        return {
        }
    },
    methods: {
    },
    computed: {
    },
}
</script>