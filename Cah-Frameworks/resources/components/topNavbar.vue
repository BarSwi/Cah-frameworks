<template>
    <div id = "top-navbar" :style="showLoginForm ? 'opacity: 0.3' : ' '">
        <theme-toggler></theme-toggler>
        <div id="div"></div>
    </div>
</template>

<style lang = "scss">
    @import '../css/mixins.scss';
    #top-navbar{
        justify-content: space-between;
        align-items: center;
        z-index: 5;
        max-width: 100%;
        position: sticky;
        display: flex;
        top: 0;
        background-color: var(--navbar-background-color);
        height: 100px;
        @include bottom-shadow-creator(0,6,5,-5, var(--navbar-shadow-color), moz webkit);
        transition: all var(--transition-theme-method);
    }

</style>

<script>
import themeToggler from "../components/themeToggle.vue";

export default{
    components:{
        themeToggler,
    },
    props: ['showLoginForm']
}
</script>