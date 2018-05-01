<template>
    <div>
       
            <p class="text-center" v-if="loading">
                Loading....
            </p>
           
            <p class="text-center" v-if="!loading">
              <button class="btn btn-success" v-if="status==0" @click="add_friend">
                Add Friend
              </button>
              <button class="btn btn-success" v-if="status=='pending'" @click="accept_friend">
                Accept Friend
              </button> 
              <span class="text-success" v-if="status=='waiting'">
                  Waiting For Response
              </span>
              <span class="text-success" v-if="status=='friends'">
                  Friends
              </span>
            </p>
            
        
    </div>
</template>

<script>
    export default {
        mounted() {
           
            this.$http.get('/check_relationship_status/'+this.profile_user_id)
            .then( (resp) =>{
                console.log(resp)
                this.status = resp.body.status
                this.loading = false
            })
            console.log('Component mounted.')
        },
        props:['profile_user_id'],

        data(){
            return{
                status:'',
                loading:true
            }
        },
        methods:{
            add_friend(){
                this.loading = true
                this.$http.get('/add_friend/'+this.profile_user_id)
                .then( (resp)=>{
                   if (resp.body == 1) {
                     this.status = 'waiting'
                     new Noty({
                          type:'success',
                          layout:'topRight',
                          text:'Friend Request Sent.'
                      }).show();
                     this.loading = false
                   } 

                   console.log(resp)
                })
            },
            accept_friend(){
                this.loading = true
                this.$http.get('/accept_friend/'+this.profile_user_id)
                .then( (resp)=>{
                   if (resp.body == 1) {
                     this.status = 'friends'
                     new Noty({
                          type:'success',
                          layout:'topRight',
                          text:'Your are Now Friend...'
                      }).show();
                     this.loading = false
                   } 

                   console.log(resp)
                })
            }
        }
    }
</script>
