<template>
<div class="container mx-auto">
	<div class="flex flex-col items-center space-y-5">
        <div class="text-2xl pt-8 font-semibold">会員完了</div>
		<div>
			<div>{{ this.login_customer }}さん！会員登録ありがとうございます！</div>
		</div>
	</div>
</div>
</template>
<script>
export default{
	data(){
		return {
			login_customer: '',
		}
	},
	created: function(){
		this.login_customer = this.$store.getters['auth/customername'];
	}
}
</script>
