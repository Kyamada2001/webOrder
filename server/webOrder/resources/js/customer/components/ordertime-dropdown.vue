
<template>
    <div>
        <div>
            <div class="flex align-middle">
                <div v-if="dateTime.timeList.length > 0" @click="isActive = !isActive" class="bg-green-400 rounded-sm">
                    <div  class="mx-1 my-1">
                        予約する
                    </div>
                    <i class="el-icon-caret-bottom hover:cursor-pointer"></i>
                </div>
                <div v-else class="bg-gray-300 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <transition>
                <div class="absolute w-auto h-auto border border-solid bg-white" v-if="isActive">
                    <template  v-for="time in dateTime.timeList">
                        <template v-if="dateTime.timeList.length > 0">
                            <p @click="setOrderTime(dateTime, time)" class="border border-solid h-auto hover:bg-green-400 px-1 py-1 text-xs">
                                {{time}}
                            </p>
                        </template>
                        <template v-else>
                            <p class="w-20 h-36 border border-solid mt-0">
                                選択肢がありません
                            </p>
                        </template>
                    </template>
                </div>
            </transition>
        </div>
        <div class="w-full h-full" @click="isActive = false" v-if="isActive"></div>
    </div>
</template>

<script>
export default {
    props: {
        dateTime: Object,
        activeItemKey: {
            type: [String, Number],
            required: false,
        },
    },
    data() {
        return {
            isActive: false,
        };
    },
    computed: {
        existsListItems() {
            return this.dateTime.timeList.length > 0;
        },
    },
    methods: {
        setOrderTime() {
            this.$store.commit('order/setOrderTime')
        }
    },
    onFocus (){
        this.isActive = true;
    },
    onFocusOut() {
        this.isActive = false;
    }
}
</script>

<style>

</style>
