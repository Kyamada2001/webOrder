<template>
    <form @submit.prevent="login">
        <div class="flex flex-col items-center space-y-5">
            <div class="text-2xl pt-8 font-semibold">ログイン</div>
            <div class="w-5/12 space-y-2">
                <label for="email" class="text-sm block">メールアドレス</label>
                <input 
                type="email" 
                id="email" 
                v-model="loginForm.email" 
                class="w-full h-14 py-2 px-4 rounded border border-gray-500 placeholder-gray-500 placeholder-opacity-50 focus:border-black" 
                placeholder="例)yamada@example.com">
            </div>
            <div class="w-5/12 space-y-2">
                <label for="pass" class="text-sm block">パスワード</label>
                <div class="relative">
                    <input 
                    :type="showPassword ? 'password' : 'text'" 
                    v-model="loginForm.password" 
                    class="w-full h-14 py-2 px-4 rounded border border-gray-500 placeholder-gray-500 placeholder-opacity-50">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                        <button @click="showPassword = !showPassword" type="button">👁</button>
                    </div>
                </div>
            </div>
            <div v-if="errorMessage" class="flex flex-col text-red-500 text-md ">
                <p>⚠ {{ errorMessage }}</p>
            </div>
            <div  class="w-5/12 py-5">
                <button class="flex justify-center rounded bg-red-500 hover:bg-red-700 text-white w-full h-12 pt-2 font-semibold">次へ</button>
            </div>
        </div>
    </form>
</template>
<script>
export default {
    data() {
        return {
            showPassword: true,
            loginForm: {
                email: '',
                password: '',
            },
        }
    },
    computed: {
        apiStatus(){
            return this.$store.state.auth.apiStatus;
        },
        errorMessage(){
            return this.$store.state.auth.loginErrorMessage;
        }
    },
    methods: {
        async login() {
            await this.$store.dispatch('auth/login', this.loginForm);

            if(this.apiStatus){
                this.$router.push('/');
            }
        }
    }
}
</script>
