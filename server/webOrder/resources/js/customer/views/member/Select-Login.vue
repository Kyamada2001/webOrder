<template>
<div class="container mx-auto">
	<div class="flex flex-col items-center space-y-5">
		<div class="text-2xl pt-8 font-semibold">ログイン</div>
		<div class="flex flex-col items-center space-y-4 border-b w-full border-b-gray-400 pb-4">
				<router-link  to="/member/login-email" class="grid justify-items-center rounded bg-red-500 hover:bg-red-700 text-white w-1/2 h-11 pt-2 font-semibold">
                    メールアドレスでログインする
                </router-link>
				<router-link to="#" class="grid justify-items-center rounded border-solid border border-black bg-white w-1/2 h-11 pt-2 font-semibold">
                    Googleでログインする
                </router-link>
		</div>
		<div class="flex flex-col items-center w-full space-y-3">
			<h2>アカウントをお持ちでない方</h2>
			<router-link class="grid justify-items-center rounded border-solid border border-red-500 hover:bg-red-50 text-red-500 w-1/2 h-11 pt-2 font-semibold" to="/member/select-register">会員登録</router-link>
		</div>
	</div>
</div>
</template>