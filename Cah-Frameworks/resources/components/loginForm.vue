<template>
<div id="login-form-container" tabindex="0" @keydown.esc="$emit('loginFormOff')">
        <div  id="login-form" ref="loginForm" animation-time="300" style="--animation-time: 300ms">
            <Loader v-if="loading"></Loader>
            <form-outcome @close="$emit('loginFormOff')"  v-if="formOutcome" :error="formError" :outcomeType="formOutcomeType"></form-outcome>
            <form v-if="!loading && !formOutcome" @submit.prevent="showRegisterForm ? registerHandler() : loginHandler()">
                <div id="login-form-title" >{{ showRegisterForm ? 'Rejestracja' : 'Logowanie' }}</div>
                <formInput label="username" inputType="text" :registerShown=showRegisterForm :errorMessageInput=errorMessage v-model="usernameValue"/>
                <formInput label="password" inputType="password" :registerShown=showRegisterForm :errorMessageInput=errorMessage v-model="passwordValue" :repeatPasswordVal="repeatPasswordValue"/>  
                <Transition name="float-right">
                <div v-if ="showRegisterForm">
                    <formInput label="repeat-password" inputType="password" :registerShown=showRegisterForm :errorMessageInput=errorMessage v-model="repeatPasswordValue" :passwordVal="passwordValue"/>  
                </div>
                </Transition>
                <Transition name = "float-left">
                <div v-if="showRegisterForm">
                    <formInput label="email" inputType="text" :registerShown=showRegisterForm :errorMessageInput=errorMessage v-model="emailValue"/>  
                </div>
                </Transition>
                <div v-if="loginValidationError" id="login-error-validation-message">
                    {{ getLang('loginValidationError') }}
                </div>
                <div id="login-form-bottom-container" ref="loginFormBottomContainer">
                    <div v-if="!showRegisterForm" id="checkbox-input-container">
                        <checkbox @inputChanged="remember=!remember" :checked="remember">Zapamiętaj dane logowania</checkbox>
                    </div>
                    <div  id="bottom-inputs-options" :class="{register: showRegisterForm}">
                        <button type="button" :class="loginValidationError ? 'validation-error' : ''" v-if="!showRegisterForm" class="login-form-lower-btn" id="forgot-password-btn">{{ getLang('forgetPasswordText') }}</button>
                        <button type="button" v-show="!showRegisterForm" @click="showRegisterFormOn($event)" ref="showRegisterFormBtn" class="login-form-lower-btn" id="change-to-register-btn">{{ getLang('registerText') }}</button>
                        <button type="button" v-show="showRegisterForm" @click.prevent="showRegisterFormOff()" ref="hideRegisterFormBtn" class="login-form-lower-btn" id="change-to-login-btn">{{ getLang('accAlreadyExistsText') }}</button>
                    </div>
                    <button type="submit" :disabled="(!registerAvailible && showRegisterForm) || !loginAvailible" :class="[(registerAvailible && showRegisterForm) || (loginAvailible && !showRegisterForm) ? 'enabled' : 'disabled']" id="login-submit">
                            {{showRegisterForm ? 'Zarejestruj się' : 'Zaloguj się'}}
                    </button>
                    <button @click.prevent="$emit('loginFormOff')" class="exit-form" id="disclaimer">{{ getLang('exitFormDisclaimerDesktop') }}</button>
                    <button @click.prevent="$emit('loginFormOff')" class = "exit-form" id="disclaimer-phone">{{ getLang('exitFormDisclaimerMobile') }}</button>
                </div>
        </form>
    </div>  
</div>
</template>

<style lang = "scss">
    #login-form-container{
        
        --min-height: 520px;
        --min-height-2: calc(720px);
        width:100%;
        z-index: 1000;
        inset: 50% 0 0 50%;
        transform: translate(-50%,-50%);
        display: grid;
        place-items:center;
        position: fixed;
        height: 100%;
        &:focus, &:active{
            outline: none;
        }
        #login-form{
            overflow: auto;
            overflow-x: hidden;
            position: relative;
            transition: all var(--animation-time) ease-out;
            transform-origin:center ;
            background-color: var(--login-form-bcg-color);
            height: var(--min-height);
            max-height: 100vh;
            width: clamp(300px, 400px, calc(100vw - 20px));   
            margin: 0 10px 0 10px;
            border-radius: 5px;
            &.register-animation{
                height: var(--min-height-2);
                max-height: 100vh;
            }
            input{
                outline: none;
                display: block;
                border-radius: 5px;
                margin: 3rem auto;
                padding: 1em .7em;
                background-color: var(--login-form-input-bcg-color);
                color: var(--login-form-txt-color);
                border: none;
                font-size: 1.1em;
                width: 75%;
                height: 50px;
                &:focus, &:active, &:not(:placeholder-shown){
                    +.label{
                        font-size: 1rem !important;
                        top: -50% !important;
                    }
                }
                color: var(--login-form-txt-color);
            }
            #checkbox-input-container{
                width: 100%;
                margin: 20px auto;
            }
            // .login-form-input-container{
            //     position: relative;
            //     .label{
            //         font-size: 1.2rem;
            //         height: max-content;
            //         position: absolute;
            //         transition: all .2s ease-out;
            //         user-select: none;
            //         display: block;
            //         width: max-content;
            //         color: #aaa;
            //         inset: 30% 0 0 15%;
            //         pointer-events: none;
            //     }
            // }
            #login-form-title{
                width: 100%;
                font-weight: 900;
                text-align: center;
                color: var(--login-form-title-color);
                margin-top: 1.8rem;
                font-size: 2rem;
            }
            #bottom-inputs-options{
                display: flex;
                margin:  auto;
                width: 75%;
                flex-wrap:wrap;
                justify-content: center;
                align-items: center;
                &.register{
                    justify-content: center !important;
                }
                #change-to-register-btn, #change-to-login-btn{
                    color: var(--login-form-change-btn-color);
                }
                #forgot-password-btn{
                    color: white;
                    &:hover,&:focus,&:active{
                        transform: scale(1.05);
                    }
                    &.validation-error{
                        animation: pulsing 5s ease-in-out infinite ;
                    }
                }
                button{
                    font-size: 1rem;
                    outline: none;
                    background-color: transparent;
                    border: none;
                    &:hover{
                        cursor: pointer;
                    }
                }
            }
            #login-submit{
                &.disabled{
                    opacity: .5;
                }
                display: block;
                background-color: var(--login-submit-btn);
                border: none;
                border-radius: 3px;
                outline: none;
                height: 50px;
                transition: all .15s ease-out;
                font-size: 1.5rem;
                width: 75%;
                margin: 1.5rem auto;
                position: relative;
                &.enabled{
                    transform: translateY(0px);
                    &:after{
                    content: '';
                    opacity: 0;
                    height: 100%;
                    position: absolute;
                    z-index: -1;
                    width: 100%;
                    inset: 0;
                    transition: opacity .3s ease;
                    filter: blur(2px);
                    border: 1px solid var(--login-submit-border);
                }
                &:hover{
                    cursor: pointer;
                }
                &:hover,&:focus,&:active{
                    transform: translateY(-2px);
                    &:after{
                        opacity: 1;
                    }
                }
                }

            }
            .exit-form{
                display: block;
                text-align: center;
                color:var(--login-form-txt-color);
                letter-spacing: .1em;
                text-align: center;
                background: none;
                outline: none;
                border: none;
                opacity: .7;
                width: 100%;
                &:hover{
                    cursor: pointer;
                }
                &#disclaimer-phone{
                    display: none;
                    @media (max-width: 780px){
                        display: block;
                    }
                }
                &#disclaimer{
                    @media (max-width: 780px){
                        display: none;
                    }
                }
            }
            .float-left-enter-active{
                animation: float-left var(--animation-time);
            }
            .float-left-leave-active{
                animation: float-left var(--animation-time) reverse;
            }
            .float-right-enter-active{
                animation: float-right var(--animation-time);
            }
            .float-right-leave-active{
                animation: float-right var(--animation-time) reverse;
            }
            .error-message{
                margin: -2rem auto auto auto;
                color: var(--login-form-error-message);
                font-size: 1.2rem;
                word-wrap: break-word;
                width: 75%;
                text-align: center;
            }
            .login-form-lower-btn{
                transition: all .2s ease-in-out;
                &:hover, &:focus{
                    transform: scale(1.05);
                }
            }
            #login-error-validation-message{
                margin: -2rem auto auto auto;
                color: yellow;
                font-size: 1.2rem;
                word-wrap: break-word;
                width: 100%;
                text-align: center;
            }
        }
        #login-form-bottom-container{
            // position: absolute;
            // bottom: 50px;
            margin: 20px auto 17px auto;
            width: 100%;    
           // transition: all var(--animation-time) ease-out;
            &.register{
                transition: all var(--animation-time) ease-out;
                transform: translateY(calc(var(--min-height-2) - var(--min-height)));
            }
            &.login{
                animation: login-bottom-cont-animation var(--animation-time) ease-out;
            }
        }
        @keyframes login-bottom-cont-animation{
            0%{
                transform: translateY(calc(var(--min-height-2) - var(--min-height)));
            }
            100%{
                transform: translateY(0);
            }
        }
        @keyframes float-right{
            0%{
                transform: translateX(100%)
            }
            100%{
                transform: translateX(0);
            }
        }
        @keyframes float-left{
            0%{
                transform: translateX(-100%)
            }
            100%{
                transform: translateX(0);
            }    
        }
        @keyframes pulsing{
            0%{
                transform: scale(1);
            }
            20%{
                transform: scale(1.05);
            }
            40%{
                transform: scale(1);
            }
            100%{
                transform: scale(1);
            }
        }
    }
</style>

<script>
import axios from 'axios';
import Loader from './Loader.vue';
import formOutcome from './FormsComponents/formOutcome.vue';
import { userSettings } from '@/storage/userSettings';
import {mapState} from 'pinia';
import { mapWritableState } from 'pinia';
import formInput from './FormsComponents/formInput.vue';
import checkbox from './FormsComponents/checkbox.vue';
export default{
    data(){
        return{
            usernameValue: '',
            passwordValue: '',
            repeatPasswordValue: '',
            emailValue: '',
            remember: false,
            errorMessage: {username: "", password: "", repeatPassword: "", email: ""},
            showRegisterForm: false,
            loading: false,
            formOutcome: false,
            formOutcomeType: String,
            formError: false,
            loginValidationError: false
        }
    },
    components:
    {
        Loader,
        formOutcome,
        formInput,
        checkbox,
    },
    computed:{
        ...mapState(userSettings, ['getLang']),
        ...mapWritableState(userSettings, ['Auth', 'Nickname']),
        registerAvailible(){
            return this.showRegisterForm && Object.values(this.errorMessage).every(val => val==='') && this.essentialInputsValues
        },
        loginAvailible(){
            return this.usernameValue && this.passwordValue ? true : false
        },
        essentialInputsValues(){
            return this.usernameValue && this.passwordValue && this.repeatPasswordValue
        }
    },
    methods:{
        async loginHandler(){
            if(!this.loginAvailible) return
            this.formOutcomeType = 'login'
            this.loading=true;
            axios
            .post("/api/login", {name: this.usernameValue, password: this.passwordValue, remember: this.remember})
            .then(res =>{
                if(!res.data.validation) this.loginValidationError = true
                else{
                    this.formOutcome = true;
                    this.Auth = true;
                    this.Nickname = res.data.name;
                }
            })
            .catch(()=>{
                this.formOutcome=true
                this.formError=true
            })
            .finally(()=>this.loading=false)
        },
        async registerHandler(){
            if(!this.registerAvailible) return
            this.formOutcomeType='register'
            this.loading=true;
            axios
            .post("/api/register",{name: this.usernameValue, email: this.emailValue, password: this.passwordValue})
            .then((response)=>{
                this.Nickname = response.data.name
                this.Auth = true
                this.formOutcome=true;
                this.showRegisterFormOff()
            })
            .catch((err)=>{ 
                if(err.response.status!=422){
                    this.showRegisterFormOff()
                    this.formOutcome=true;
                    this.formError=true
                    return 
                }
                if(err.response.data.errors.email && err.response.data.errors.email[0]==="Email Taken"){
                    this.errorMessage.email = "Adres email jest zajęty";
                } 
                if(err.response.data.errors.name && err.response.data.errors.name[0]==="Name Taken"){
                    this.errorMessage.username = "Nazwa użytkownika jest zajęta";
                }
                else{
                    this.showRegisterFormOff()
                    this.formOutcome=true;
                    this.formError=true
                } 
            })
            .finally(()=> {
                this.loading=false
            })
        },
        showRegisterFormOn(){
            const animationTime = this.$refs.loginForm.getAttribute('animation-time')
            const loginForm = this.$refs.loginForm
            const hideRegisterFormBtn = this.$refs.hideRegisterFormBtn ? this.$refs.hideRegisterFormBtn : false
            const loginFormBottomContainer = this.$refs.loginFormBottomContainer ? this.$refs.loginFormBottomContainer : false
            if(hideRegisterFormBtn) hideRegisterFormBtn.disabled=true
            loginForm.classList.add('register-animation');
            if(loginFormBottomContainer) loginFormBottomContainer.classList.add('register');
            this.loginValidationError=false;
            setTimeout(()=>{
                this.showRegisterForm=true;
                if(hideRegisterFormBtn) hideRegisterFormBtn.disabled=false
                if(loginFormBottomContainer) loginFormBottomContainer.classList.remove('register');
            },animationTime)
        },
        showRegisterFormOff(){
            const animationTime = this.$refs.loginForm.getAttribute('animation-time')
            this.showRegisterForm=false;
            const showRegisterFormBtn = this.$refs.showRegisterFormBtn ? this.$refs.showRegisterFormBtn : false
            const loginForm = this.$refs.loginForm
            const loginFormBottomContainer = this.$refs.loginFormBottomContainer ? this.$refs.loginFormBottomContainer : false
            if(showRegisterFormBtn) showRegisterFormBtn.disabled=true
            setTimeout(()=>{
                loginForm.classList.remove('register-animation');  
                if(loginFormBottomContainer) loginFormBottomContainer.classList.add('login');
                if(showRegisterFormBtn) {
                    setTimeout(()=>{
                        if(loginFormBottomContainer) loginFormBottomContainer.classList.remove('login');
                        showRegisterFormBtn.disabled=false
                    },animationTime)
                }
            },animationTime)
        },
    },  
}
</script>