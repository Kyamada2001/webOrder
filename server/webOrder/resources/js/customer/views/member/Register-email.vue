<template>
<div class="container mx-auto">
    <form @submit.prevent="register">
        <div class="flex flex-col items-center space-y-5">
            <div class="text-2xl pt-8 font-semibold">会員登録</div>
            <div class="w-3/4 md:w-5/12 space-y-2">
                <label for="email" class="text-sm block">メールアドレス</label>
                <input type="email" id="email" v-model="registerForm.email" class="w-full h-14 py-2 px-4 rounded border border-gray-500 placeholder-gray-500 placeholder-opacity-50 focus:border-black" placeholder="例)yamada@example.com">
                <div v-if="registerErrorMessages">
                    <div v-if="registerErrorMessages.email">
                        <div 
                        v-for="message in registerErrorMessages.email" 
                        :key="message"
                        class="flex flex-row text-red-500 text-sm">
                        {{ message }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-3/4 md:w-5/12 space-y-2">
                <label for="pass" class="text-sm block">パスワード</label>
                <div class="relative">
                    <input :type="showPassword ? 'password' : 'text'" v-model="registerForm.password" class="w-full h-14 py-2 px-4 rounded border border-gray-500 placeholder-gray-500 placeholder-opacity-50">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                        <button @click="showPassword = !showPassword" type="button">👁</button>
                    </div>
                </div>
                <div v-if="registerErrorMessages">
                    <div v-if="registerErrorMessages.password">
                        <div 
                        v-for="message in registerErrorMessages.password" 
                        :key="message"
                        class="flex flex-row text-red-500 text-sm">
                        {{ message }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-3/4 md:w-5/12 space-y-2">
                <label for="pass" class="text-sm block">パスワード確認</label>
                <div class="relative">
                    <input 
                        :type="showPasswordConfirmation ? 'password' : 'text'" 
                        v-model="registerForm.password_confirmation" 
                        class="w-full h-14 py-2 px-4 rounded border border-gray-500 placeholder-gray-500 placeholder-opacity-50">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                        <button @click="showPasswordConfirmation = !showPasswordConfirmation" type="button">👁</button>
                    </div>
                    <div v-if="registerErrorMessages">
                    <div v-if="registerErrorMessages.password_confirmation">
                        <div 
                        v-for="message in registerErrorMessages.password_confirmation" 
                        :key="message"
                        class="flex flex-row text-red-500 text-sm">
                        {{ message }}
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="w-3/4 md:w-5/12 space-y-2">
                <label for="text" class="text-sm block">ニックネーム</label>
                <input 
                    type="text" 
                    class="w-full h-14 py-2 px-4 rounded border border-gray-500 placeholder-gray-500 placeholder-opacity-50" 
                    placeholder="webOrder内のユーザー名"
                    v-model="registerForm.username">
                    <div v-if="registerErrorMessages">
                        <div v-if="registerErrorMessages.username">
                            <div 
                            v-for="message in registerErrorMessages.username" 
                            :key="message"
                            class="flex flex-row text-red-500 text-sm">
                            {{ message }}
                            </div>
                        </div>
                    </div>
            </div>
            <div  class="w-3/4 md:w-5/12 py-5">
                <button class="flex justify-center rounded bg-red-500 hover:bg-red-700 text-white w-full h-12 pt-2 font-semibold">次へ</button>
            </div>
        </div>
    </form>
</div>
</template>
<script>
export default {
    data() {
        return {
            showPassword: true,
            showPasswordConfirmation: true,
            registerForm: {
                email: '',
                password: '',
                password_confirmation: '',
                username: '',
            },
        }
    },
    computed: {
        apiStatus(){
            return this.$store.state.auth.apiStatus;
        },
        registerErrorMessages(){
            return this.$store.state.auth.registerErrorMessages;
        },
    },
    methods: {
        register: async function(){
            await this.$store.dispatch('auth/register', this.registerForm);

            if(this.apiStatus){
                this.$router.push('/member/register-complete');
            }
        },
    },
    watch: {
        $route: {
        async handler () {
            this.$store.dispatch('auth/clearErrorMessages');
        },
        immediate: true
        }
    }
}
</script>
