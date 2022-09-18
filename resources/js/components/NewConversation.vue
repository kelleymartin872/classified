<template>
    <div class="row">
        <div class="col-md-2">
            <p v-for="(user,index) in users" :key="index">
                <a href="#" @click.prevent="showMessage(user.id)">
                    {{user.name}}
                </a>
            </p>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center">
                    <span>Chat here</span>
                </div>
                <div class="card-body chat-msg">
                    <ul class="chat"
                        v-for="(message, index) in messages" :key="index">
                        <li class="sender clearfix" v-if="message.selfOwned">
                            <span class="chat-img clearfix mx-2">
                                img
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header clearfix">
                                    <strong>Name</strong>
                                    <small class="right text-muted">
                                        <span>Date </span>
                                    </small>
                                </div>
                                <p class="text-center" v-if="message.ads"> 
                                    <a :href=" '/products/'+ message.ads.id + '/'+message.ads.slug " target="_blank">
                                        {{messafe.ads.name}}
                                        <img :src=" '/storage'+ (message.ads.feature_image.substring(7))" alt="">
                                    </a>
                                </p>
                                <p>{{message.body}}</p>
                            </div>
                        </li>
                        <li class="buyer clearfix" v-else>
                            <span class="chat-img right clearfix mx-2">
                                img
                            </span>
                            <div class="chat-body2 clearfix">
                                <div class="header clearfix">
                                    <strong class="right primary-font">{{message.user.name}}</strong>
                                    <small class="right text-muted">
                                        <span>Date </span>
                                    </small>
                                </div>
                                <p>{{message.body}}</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <input v-model="body" type="text" class="form-control input-sm" placeholder="please write a message" />
                        <span class="input-group-btn">
                            <button @click.prevent="sendMessage" class="tbn btn-primary">
                                Send
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            users:[],
            messages:[],
            selectedUserId:''
        }
    },
    mounted(){
        axios.get('/users').then((response)=>{
            this.users =response.data
        })
    },
    methods:{
        showMessage(userId){
            axios.get('/message/user'+userId).then((response)=>{
                this.messages = response.data
                this.selectedUserId = userId
            })
        },
        sendMessage()
        {
            axios.post('/start-conversation',{
                body:this.body,
                receiverId: this.selectedUserId
            }).then((response)=>{
                this.message.push(response.data);
                this.body=''
            })
        }
    }
}
</script>
<style scoped>
    .chat{
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .chat li{
        margin-bottom: 40px;
        padding-bottom: 5px;
        margin-top: 10px;
        height: 10px;
        width: 80%;
    }
    .chat li .chat-body p{
        margin: 0;
    }
    .chat-msg{
        overflow: scroll;
        height: 350px;
    }
    .chat-msg .chat-img{
        width: 50px;
        height: 50px;
    }
    .chat-msg .img-circle{
        border-radius: 50%;
    }
    .chat-msg .chat-img{
        display: inline-block;
    }
    .chat-msg .chat-body{
        display: inline-block;
        max-width: 80%;
        background-attachment: #FFC195;
        border-radius: 12.5px;
        padding: 15px;
    }
    .chat-msg .chat-body2{
        display: inline-block;
        max-width: 80px;
        background-color: #ccc;
        border-radius: 12.5px;
        padding: 15px;
    }
    .chat-msg .chat-body strong{
        margin: 0;
    }
    .chat-msg .sender{
        text-align: right;
        float: right; 
    }
    .chat-msg .sender p{
        text-align: left;
    }
    .chat-msg .buyer{
        text-align: left;
        float: left;
    }
    .chat-msg .left{
        float: left;
    }
    .chat-msg .right{
        float: right;
    }
    .clearfix{
        clear: both;
    }
</style>