<template>
    <div class="selection-section" :class = "Auth ? '' : 'blocked'">
        <div class="selection-section-container">
            <button @click="logout()" class="selection-home-button" id="create-game-btn">{{ getLang('createGameButton') }}</button>
            <button class="selection-home-button">{{ getLang('searchGameButton') }}</button>
            <button class="selection-home-button">{{ getLang('createDeckButton') }}</button>
            <button class="selection-home-button">{{ getLang('editDeckButton') }}</button>
        </div>
        <login-requirment v-if="!Auth" :unlock-potential="unlockPotential"></login-requirment>
    </div>
</template>
<style lang="scss">
    @import '../css/homeBtn.scss';
    .selection-section{
        position: relative;
        margin-top: 100px;
        width: 100%;
        min-height: 300px;
        &.blocked{
           opacity: 0.7;
           pointer-events: none; 
        }

        .selection-section-container{
            overflow: auto;
            display: flex;
            width: 100%;
            height: 100%;
            justify-content: space-evenly;
            align-items: center;
            flex-wrap: wrap;
            .selection-home-button{
                //@include button(calc(50% - 4rem), 120px);
                position: relative;
                outline: none;
                border: none;   
                box-sizing: border-box;
                font-size: 1.5rem;
                letter-spacing: 0.2em;
                margin: 2rem;
                min-height: 120px;
                width: calc(50% - 4rem);
                min-width: 200px;
                // -webkit-box-shadow: inset 0px 0px 0.5em 0px var(--base-dark-green-2),
                // 0px 0px 0.5em 0px var(--base-dark-green-2);
                // -moz-box-shadow: inset 0px 0px 0.5em 0px var(--base-dark-green-2),
                //     0px 0px 0.5em 0px var(--base-dark-green-2);
                // box-shadow: inset 0px 0px 0.5em 0px var(--base-dark-green-2),
                //     0px 0px 0.5em 0px var(--base-dark-green-2);
                border-radius: 30px;
                background-color: transparent;
                //border: 4px solid var(--base-dark-green-2);
                // border-top: 4px solid var(--base-dark-green-2);
                color: white;
                transition: color .3s cubic-bezier(.64,.08,.34,1.41);
                &:hover,&:focus,&:active{
                    cursor: pointer;
                    color: var(--base-light-green-2);
                    &:after{
                        height: 100%;
                        inset: 0 0 100% 0;
                    }
                }
                &:after{
                    transition: all .2s ease-in-out;
                    background-color: var(--base-dark-green-2);
                    content: '';
                    position: absolute;
                    width: 100%;
                    height: 0;  
                    border: 3px solid var(--base-dark-green-2);
                    inset: 100% 0 0 0;
                    transform-origin: center ;
                    background: transparent;
                    border-radius: 30px;
                }
            }
        }

    }
</style>
<script>
import loginRequirment from '../components/loginRequirment.vue';
import axios from 'axios';
import { userSettings } from '@/storage/userSettings';
import {mapState} from 'pinia'
export default{
    components:{
        loginRequirment,
    },
    methods:{
        logout(){
            axios.post('/api/logout');
        }
    },
    computed:{
        ...mapState(userSettings, ['getLang','Auth']),
    },
    props: ['unlockPotential'],
}

</script>