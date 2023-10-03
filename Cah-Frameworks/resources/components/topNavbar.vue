<template>
    <div id = "top-navbar">
        <theme-toggler></theme-toggler>
        <div id="div">sda</div>
    </div>
</template>

<style lang = "scss">
    @import '../css/mixins.scss';
    #top-navbar{
        justify-content: space-between;
        align-items: center;
        width: 100%;
        position: sticky;
        display: flex;
        top: 0;
        background-color: var(--navbar-background-color);
        height: clamp(100px, 100px, 200px);
        @include bottom-shadow-creator(0,6,5,-5, var(--navbar-shadow-color), moz webkit)
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