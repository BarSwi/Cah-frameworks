<template>

    <router-view />
</template>

<style lang = scss>
    @import "../css/app.scss";
</style>


<script>

export default{
    mounted(){


        const hook = document.querySelector("body");
        hook.setAttribute("data-theme","dark");
        hook.classList.add("dark");
    },

    
}
</script>