<template>
  <div class="fixed w-full h-full top-0 left-0 flex items-center justify-center z-10" v-if="open">
    <div class="absolute w-full h-full bg-gray-900 bg-opacity-50" @click="close"></div>

    <div class="absolute max-h-full w-full px-3 md:w-2/3 md:px-0">
      <div class="container bg-white overflow-hidden md:rounded">
        <div class="px-4 py-4 leading-none flex justify-between items-center font-medium text-sm bg-gray-100 border-b select-none">
          <h3>ログアウト</h3>
          <div @click="close" class="text-2xl hover:text-gray-600 cursor-pointer">
            &#215;
          </div>
        </div>

        <div class="max-h-full px-4 py-4">
            <p class="text-gray-800">
                ログアウトしますか？
            </p>

            <div class="text-right mt-4">
                <button @click="close" class="px-4 py-2 text-sm text-gray-600 focus:outline-none hover:underline">キャンセル</button>
                <button @click="logout" class="mr-2 px-4 py-2 text-sm rounded text-white bg-red-500 focus:outline-none hover:bg-red-400">ログアウト</button>
            </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    data() {
      return {
        open: true,
      };
    },
    methods: {
        async logout() {
            await this.$store.dispatch('auth/logout');

            if(!this.$store.getters['auth/check']){
                this.open = false;
                this.$router.push('/');
            }
        },
        close() {
        this.open = false;
        this.$emit("close");
      },
    },
}
</script>
