<template>
	<div>
		
	</div>
</template>

<script>
	export default
	{
		mounted(){
			this.listen()
		},
		props:['id'],
		methods:{
			listen(){
				Echo.private('App.User.'+this.id)
				.notification( (notification) => {
					//alert('new notification')
					new Noty({
		              type:'success',
		              layout:'topCenter',
		              text:notification.name + notification.message
		          }).show();

					this.$store.commit('add_not',notification)
		            document.getElementById('noty_audio').play() 
					console.log(notification)
				})
			}
		}
	}
</script>