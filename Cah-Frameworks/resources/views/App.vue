<template>
    <router-view />
</template>

<style lang = scss>
    @import "../css/app.scss";
</style>


<script>
import axios from 'axios';
import { mapWritableState } from 'pinia';
import { userSettings } from '../storage/userSettings';

export default{
    mounted(){
        const hook = document.querySelector("body");
        hook.setAttribute("data-theme","dark");
        hook.classList.add("dark");

        axios
        .post('/api/authCheck')
        .then((res)=>{
            console.log(res)
            
        })
    },
    beforeMounted(){

    },
    computed:{
        ...mapWritableState(userSettings, 'Auth', 'Nickname')
    }

    
}
</script>