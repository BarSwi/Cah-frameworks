<template>
    <div class="selection-section">
        <div class="selection-section-container">
            <button class="selection-home-button" id="create-game-btn"></button>
            <button class="selection-home-button"></button>
            <button class="selection-home-button"></button>
            <button class="selection-home-button"></button>
        </div>
        <login-requirment :unlock-potential="unlockPotential"></login-requirment>
    </div>
</template>
<style lang="scss">
    .selection-section{
        position: relative;
        margin-top: 100px;
        width: 100%;
        opacity: .7;
        min-height: 300px;


        .selection-section-container{
            overflow: auto;
            display: flex;
            width: 100%;
            height: 100%;
            justify-content: space-evenly;
            align-items: center;
            flex-wrap: wrap;
            .selection-home-button{
                outline: none;
                box-sizing: border-box;
                font-size: 1.5rem;
                letter-spacing: 0.2em;
                margin: 2rem;
                min-height: 120px;
                width: calc(50% - 4rem);
                min-width: 200px;
                -webkit-box-shadow: inset 0px 0px 0.5em 0px var(--base-dark-green-2),
                0px 0px 0.5em 0px var(--base-dark-green-2);
                -moz-box-shadow: inset 0px 0px 0.5em 0px var(--base-dark-green-2),
                    0px 0px 0.5em 0px var(--base-dark-green-2);
                box-shadow: inset 0px 0px 0.5em 0px var(--base-dark-green-2),
                    0px 0px 0.5em 0px var(--base-dark-green-2);
                border-radius: 30px;
                background-color: transparent;
                border: 4px solid var(--base-dark-green-2);
                color: white;
                transition: color .3s cubic-bezier(.64,.08,.34,1.41);
                &:hover,:focus,:active{
                    cursor: pointer;
                    color: var(--base-light-green-2);
                }
            }
        }

    }
</style>
<script>
import loginRequirment from '../components/loginRequirment.vue'
import { userSettings } from '../storage/userSettings';
import {mapState} from 'pinia'
export default{
    components:{
        loginRequirment,
    },
    methods:{
    },
    computed:{
        ...mapState(userSettings, ['getLang']),
    },
    props: ['unlockPotential'],
}

</script>