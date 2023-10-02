<template>
    <a href = "/" >test</a>
    <button @click="changeTheme()">Change theme</button>
    <router-view />
</template>

<style lang = scss>
    @import "../css/app.scss"
</style>


<script>
import {changeTheme} from '../js/methods'
export default{
    mounted(){
        const hook = document.querySelector("body");
        hook.setAttribute("data-theme","dark");
        hook.classList.add("dark");
        
    },
    methods:
    {
        changeTheme,
    }
    
}
</script>