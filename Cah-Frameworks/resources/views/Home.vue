
<template>
    <Loader v-if="!loaded" />
    <nav v-if="loaded">
        <top-navbar :showLoginForm="showLoginForm"></top-navbar>
    </nav>
    <main v-if="loaded" id="container-home"  :style="showLoginForm ? 'opacity: 0.3' : ' '">
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
            @blur="unlockPotentialOff()"
            @click="registerGuest()" class = "guest-button">
                Graj jako gość
            </button>
        </div>
        <!-- </Transition> -->
        <buttons-after-login  :unlock-potential="unlockPotential"/>
        <h2>
        </h2>
    </main>
    <Transition name="bounce">
        <login-form v-if="showLoginForm" @login-form-off="loginFormOff"></login-form>
    </Transition>
    <div v-if="showLoginForm" id="login-layer"></div>
</template>
<style lang = "scss">
    @import '../css/homeBtn.scss';
    #login-layer{
        background-color: black;
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: .6 ;
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
                @include button(clamp(15rem,20vw,20vw), clamp(6rem, 125px, 125px));
            
            }
            .login-button{
                font-weight: 900;
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
import topNavbar from "../components/topNavbar.vue";
import buttonsAfterLogin from "../components/buttonsAfterLogin.vue";
import loginForm from "../components/loginForm.vue";
import Loader from '../components/Loader.vue';
import { checkAuth } from "../js/methods";
import {userSettings} from '@/storage/userSettings.js';
import { mapState } from 'pinia';
import { mapWritableState } from "pinia";
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
        Loader
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
        },
        registerGuest(){
            axios.post('/api/guest')
            .then((res) => {
                this.Auth=true;
                this.Guest=true;
                this.Nickname= res.data.nickname;
            })
            .catch(e => console.log(e.message));
        }
    },
    computed:{
        ...mapState(userSettings, ['getLang','Auth']),
        ...mapWritableState(userSettings, ['Auth','Nickname','Guest'])
    },
    mounted(){
        if(!this.Auth){
            //checkAuth is function from methods.js that checks if suer is authenticated
            checkAuth().then(()=>{
                this.loaded=true
            })
        }

    }
  }
</script>
