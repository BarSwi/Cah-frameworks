<template>
    <nav id = "top-navbar" :style="showLoginForm ? 'opacity: 0.3' : ' '">
        <theme-toggler></theme-toggler>
        <profile></profile>
    </nav>

</template>

<style lang = "scss">
    @import '../css/mixins.scss';
    #top-navbar{
        justify-content: space-between;
        align-items: center;
        z-index: 5;
        width: 100%;
        position: sticky;
        display: flex;
        top: 0;
        background-color: var(--navbar-background-color);
        height: 80px;
        @include bottom-shadow-creator(0,6,5,-5, var(--navbar-shadow-color), moz webkit);
        transition: all var(--transition-theme-method);
    }

</style>

<script>
import themeToggler from "../components/themeToggle.vue";
import profile from '../components/NavbarComponents/profile.vue';
import { userSettings } from "../js/storage/userSettings";
import { mapState } from "pinia";

export default{
    components:{
        themeToggler,
        profile,
    },
    computed: {
        ...mapState(userSettings, ['Auth', 'Guest','Nickname'])
    },
    props: ['showLoginForm']
}
</script>