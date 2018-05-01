<template>
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-lg-offset-3">
				<input type="text" class="input-lg form-control" placeholder="Search Users" v-model="query" @keyup.enter="search()">
				<br>
				<hr>
				<div class="row" v-if="results.length">
					<div class="text-center" v-for="user in results">
						<img :src="user.avatar" width="70px" height="70px" alt="">
						<h4 class="text-center">{{user.name}}</h4>
					</div>
				</div>
			</div>
		</div>
	</div>

</template>


<script>
    var algoliasearch = require('algoliasearch');
    var client = algoliasearch('MO29BC5LGA', 'eb83c55b1924686e8351d82a3da9ebf2');
    var index = client.initIndex('users');
	export default{
		mounted(){
            
		},
		data(){
			return{
                query:'',
                results:[]
			}
		},
		methods:{
			search(){
               index.search(this.query,(err,content)=>{
            	console.log(err,content)
            	this.results = content.hits
            })
			}
		}
	}
</script>