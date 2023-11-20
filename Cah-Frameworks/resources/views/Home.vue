
<template>
    <nav>
        <top-navbar :showLoginForm="showLoginForm"></top-navbar>
    </nav>
    <Transition name="bounce">
        <login-form v-if="showLoginForm" @login-form-off="loginFormOff"></login-form>
    </Transition>
    <div v-if="showLoginForm" id="login-layer"></div>


    <div id="container-home"  :style="showLoginForm ? 'opacity: 0.3' : ' '">
        <h1>
            Cards Against Hummanity
        </h1>
        <!-- <Transition name = "bounce"> -->
        <div v-if="!Auth" id="login-guest-container"  >
            <button 
            :disabled="showLoginForm"
            @mouseover="unlockPotentialOn()" 
            @mouseleave="unlockPotentialOff()" 
            @focus="unlockPotentialOn()"
            @blur="unlockPotentialOff()"
            @click ="loginFormOn()"
            class = "login-button">
                {{ getLang("login") }}
            </button>
            <button  
            :disabled="showLoginForm"
            @mouseover="unlockPotentialOn()" 
            @mouseleave="unlockPotentialOff()" 
            @focus="unlockPotentialOn()"
            @blur="unlockPotentialOff()" class = "guest-button">
                Graj jako gość
            </button>
        </div>
        <!-- </Transition> -->
        <buttons-after-login  :unlock-potential="unlockPotential"/>
        <h2>
        </h2>
    </div>
</template>
<style lang = "scss">
    @import '../css/mixins.scss';
    #login-layer{
        background-color: black;
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: .5;
    }
    #container-home{
        min-width: 75%;
        margin: 0 12.5%;
        text-align: center;
        h1{
            margin: 3.5rem 0 3.5rem 0;
        }
        h2{
            margin: 2rem 0 0 0;
            padding: 0 0 30px 0;
        }
        #login-guest-container{
            display: flex;
            align-items: center;
            min-width: 100%;
            flex-wrap:wrap;
            justify-content: center;
            // flex-direction: column;
            gap: 20px;
            button{
                -webkit-box-shadow: inset 0px 0px 0.5em 0px var(--base-light-green),
                0px 0px 0.5em 0px var(--base-light-green);
                -moz-box-shadow: inset 0px 0px 0.5em 0px var(--base-light-green),
                    0px 0px 0.5em 0px var(--base-light-green);
                box-shadow: inset 0px 0px 0.5em 0px var(--base-light-green),
                    0px 0px 0.5em 0px var(--base-light-green);
                animation: button-clicker 1.5s linear infinite;
                box-sizing: border-box;
                padding: .25rem;
                color: white;
                transition: color .3s cubic-bezier(.64,.08,.34,1.41);
                font-size: 1.5rem;
                text-align: center;
                height: clamp(6rem, 125px, 125px);
                width: clamp(15rem,20vw,20vw);
                letter-spacing: 0.2em;
                border-radius: 30px;
                margin: 2rem;
                border: 4px solid var(--base-light-green);
                background-color: transparent;
                outline: none;
                &:hover,&:focus,&:active{
                    cursor: pointer;
                    color: var(--base-light-green);
                }
            }
            .login-button{
                font-weight: 900;
            }
        }
        @keyframes button-clicker{
            0% {
                opacity: 0.95;
            }
            25% {
                opacity: 0.85;
            }
            50% {
                opacity: 0.75;
            }
            75% {
                opacity: 0.85;
            }
            100% {
                opacity: 1;
            }
        }
    }
    .bounce-enter-active{
        animation: bounce .6s;
    }
    .bounce-leave-active{
        animation: bounce .6s reverse;
    }
    @keyframes bounce{
        0%{
            transform: translateY(-200%) translate(-50%,-50%);
        }
        50%{
            transform: translateY(10%) translate(-50%,-50%);
        }
        100%{
            transform: translateY(0) translate(-50%,-50%);
        }
    }
</style>

<script>
import topNavbar from "../components/topNavbar.vue"
import buttonsAfterLogin from "../components/buttonsAfterLogin.vue";
import loginForm from "../components/loginForm.vue"
//import {config} from '../js/store'
import {userSettings} from '../storage/userSettings.js'
import { mapState } from 'pinia'
export default {

  data() {
    return {
        loaded: false,
        unlockPotential: false,
        showLoginForm: false,
    }
  },
  components:
    {
        topNavbar,
        buttonsAfterLogin,
        loginForm,
    },
    methods:{
        unlockPotentialOn(){
            this.unlockPotential=true
        },
        unlockPotentialOff(){
            this.unlockPotential = false;
        },
        loginFormOn(){
            const hook = document.querySelector('body');
            hook.style.setProperty('overflow','hidden');
            
            this.showLoginForm=true
        },
        loginFormOff(){
            const hook = document.querySelector('body');
            hook.style.setProperty('overflow','auto');
            this.showLoginForm=false;
        }
    },
    computed:{
        ...mapState(userSettings, ['getLang','Auth']),
    }
  }
</script>
