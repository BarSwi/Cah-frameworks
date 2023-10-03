<template>
    <div id = "top-navbar">
        <theme-toggler></theme-toggler>
        <div id="div">sda</div>
    </div>
</template>

<style lang = "scss">
    #top-navbar{
        justify-content: space-between;
        align-items: center;
        width: 100%;
        position: sticky;
        display: flex;
        top: 0;
        background-color: #0b0b16;
        height: clamp(100px, 100px, 200px);
        border-bottom: 1px solid purple;
        
    }

</style>

<script>
import themeToggler from "../components/themeToggle.vue";

export default{
    components:{
        themeToggler,
    }
}
</script>