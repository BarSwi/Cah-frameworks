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
        document.querySelector("body").setAttribute("data-theme","dark")
    },
    methods:
    {
        changeTheme,
    }
    
}
</script>