<template>
    <div>
        <p>
            <button class="btn btn-success" v-if="showBtn" @click.prevent="showPhoneBtn()"></button>
        </p>
        <p v-if="showNumber">
            <button class="btn btn-danger"> {{phoneNumber}}</button>
        </p>
    </div>
</template>
<script>
export default {
    props:['phoneNumber'],
    data(){
        return{
            showBtn:true,
            showNumber:false,
        }
    },
    methods:{
        showPhoneBtn(){
            this.showNumber = true;
        }
    }
}
</script>