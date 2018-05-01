<template>
	<div>
		<hr>
		<p class="text-center" v-for="like in post.likes">
			<img :src="like.user.avatar" width="20px" height="20px" alt="">
		</p>
		<hr>
       <button class="btn btn-primary btn-xs" v-if="!auth_user_likes_post" @click="like()">
       	   Like This Post
       </button>

       <button class="btn-danger btn btn-xs" @click="unlike()" v-else>
       	  Unlike Post
       </button>
	</div>
</template>


<script>
	export default{
		mounted(){
           
		},
		props:['id'],

		computed:{
			likers(){
                var likers = []
                this.post.likes.forEach((like)=>{
                	likers.push(like.user.id)
                })
                return likers
			},
			auth_user_likes_post(){
               var check_index = this.likers.indexOf(
                  this.$store.state.auth_user.id
               	)
               	if (check_index === -1) 
               	   return false
               	else
               	   return true  
			},
			post(){
				return this.$store.state.posts.find((pos)=>{
					return pos.id === this.id
				})
			}
		},
		methods:{
			like(){
				this.$http.get('/like/' + this.id)
                .then( (resp) => {
	              this.$store.commit('update_post_likes', {
	                    id: this.id,
	                    like: resp.body
	              })
                      
                  new Noty({
                      type:'success',
                      layout:'topRight',
                      text:'You successfully liked the post!'
                }).show();
                })
			},
			unlike(){
				this.$http.get('/unlike/' + this.id)
                .then( (response) => {
                      this.$store.commit('unlike_post', {
                            post_id: this.id,
                            like_id: response.body
                      })
                      new Noty({
                      type:'success',
                      layout:'topRight',
                      text:'You successfully Unliked the post!'
                }).show();
                })
			}
		}
	}
</script>