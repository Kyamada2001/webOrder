<template>
<div class="container mx-auto">
	<div class="flex flex-col items-center space-y-5">
		<div class="text-2xl pt-8 font-semibold">会員登録</div>
		<div class="flex flex-col items-center space-y-4 border-b w-full border-b-gray-400 pb-4">
			<router-link  to="/member/register-email" class="grid justify-items-center rounded bg-red-500 hover:bg-red-700 text-white w-3/4 md:w-1/2 h-11 pt-2 font-semibold">メールアドレスで登録する</router-link>
			<!-- <router-link class="grid justify-items-center rounded border-solid border border-black bg-white w-3/4 md:w-1/2 h-11 pt-2 font-semibold" to="#">Googleで登録する</router-link> -->
		</div>
		<div class="flex flex-col items-center w-full space-y-3">
			<h2>アカウントをお持ちの方</h2>
			<router-link class="grid justify-items-center rounded border-solid border border-red-500 hover:bg-red-50 text-red-500 w-3/4 md:w-1/2 h-11 pt-2 font-semibold" to="/member/select-login">ログイン</router-link>
		</div>
	</div>
</div>
</template>