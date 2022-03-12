<template>
	<div class="flex flex-col items-center space-y-5">
        <div class="text-2xl pt-8 font-semibold">会員完了</div>
        <div class="w-5/12 space-y-2">
            <label for="text" class="text-sm block">ニックネーム</label>
            <input type="text" class="w-full h-14 py-2 px-4 rounded border border-gray-500 placeholder-gray-500 placeholder-opacity-50" placeholder="webOrder内のユーザー名">
        </div>
        <div  class="w-5/12 py-5">
            <router-link to="#" class="flex justify-center rounded bg-red-500 hover:bg-red-700 text-white w-full h-12 pt-2 font-semibold">次へ</router-link>
        </div>
	</div>
</template>