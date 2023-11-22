<template>
<div id="login-form-container" tabindex="0" @keydown.esc="$emit('loginFormOff')">
        <div  id="login-form" ref="loginForm" animation-time="300" style="--animation-time: 300ms">
            <Loader v-if="loading"></Loader>
            <form-outcome @close="$emit('loginFormOff')"  v-if="formOutcome" :error="formError" :loginHandler="!showRegisterForm"></form-outcome>
            <form v-if="!loading && !formOutcome" @submit.prevent="showRegisterForm ? registerHandler() : loginHandler()">
                <div id="login-form-title" >{{ showRegisterForm ? 'Rejestracja' : 'Logowanie' }}</div>
                <!-- <div class = "login-form-input-container">
                    <input v-model="usernameValue" type="text" placeholder = ' ' id="username-input" name="username" class="username-form-input">
                    <label for="username-input" class ='label' id = 'username-input-label'>{{getLang('usernameInputPlaceholder')}}</label>
                </div>
                <div v-if="showRegisterForm && registerValidator.usernameError" class="error-message" id="username-error">
                        {{ usernameErrorMessage }}
                </div> -->
                <formInput label="username" inputType="text" :registerShown=showRegisterForm :errorMessageInput=errorMessage v-model="usernameValue"/>
                <formInput label="password" inputType="password" :registerShown=showRegisterForm :errorMessageInput=errorMessage v-model="passwordValue" :repeatPasswordVal="repeatPasswordValue"/>  
                <!-- <div class = "login-form-input-container">
                    <input v-model="passwordValue" type="password" placeholder = ' ' name="password" id="password-input" class="login-form-input">
                    <label for="password-input" class = 'label' id = 'password-input-label' >{{getLang('passwordInputPlaceholder')}}</label>
                </div>
                <div v-if="showRegisterForm && registerValidator.passwordError" class="error-message" id="password-error">
                        {{ passwordErrorMessage }}
                </div>  -->
                <Transition name="float-right">
                <!-- <div v-if="showRegisterForm && showRegisterForm" class = "login-form-input-container">
                    <input v-model="repeatPasswordValue" type="password" placeholder = ' ' name="password-repeat-input" id="password-repeat-input" class="register-form-input">
                    <label for="password-repeat-input" class = 'label' id = 'password-repeat-input-label' >{{getLang('passwordRepeatInputPlaceholder')}}</label>
                </div> -->
                <div v-if ="showRegisterForm">
                    <formInput label="repeat-password" inputType="password" :registerShown=showRegisterForm :errorMessageInput=errorMessage v-model="repeatPasswordValue" :passwordVal="passwordValue"/>  
                </div>
                
                </Transition>
                <!-- <div v-if="showRegisterForm && registerValidator.repeatPasswordError" class="error-message" id="repeat-password-error">
                        {{ repeatPasswordErrorMessage }}
                </div> -->
                <Transition name = "float-left">
                <div v-if="showRegisterForm" class = "login-form-input-container">
                    <input v-model="emailValue" type="text" placeholder = ' ' name="email-input" id="email-input" class="login-form-input">
                    <label for="email-input" class = 'label' id = 'email-input-label' >{{getLang('emailInputPlaceholder')}}</label>

                </div>
                </Transition>
                <!-- <div v-if="showRegisterForm && registerValidator.emailError"  class="error-message" id="email-error">
                        {{ emailErrorMessage }}
                </div> -->
                <div class="spacer"></div>
                <div id="login-form-bottom-container" ref="loginFormBottomContainer">
                    <div  id="bottom-inputs-options" :class="{register: showRegisterForm}">
                        <button type="button" v-if="!showRegisterForm" class="login-form-lower-btn" id="forgot-password-btn">Zapomniałeś hasła?</button>
                        <button type="button" v-show="!showRegisterForm" @click="showRegisterFormOn($event)" ref="showRegisterFormBtn" class="login-form-lower-btn" id="change-to-register-btn">Zarejestruj się  </button>
                        <button type="button" v-show="showRegisterForm" @click.prevent="showRegisterFormOff()" ref="hideRegisterFormBtn" class="login-form-lower-btn" id="change-to-login-btn">Posiadasz już konto? Zaloguj się</button>
                    </div>
                    <button type="submit" :disabled="(!registerAvailible && showRegisterForm) || !loginAvailible" :class="[(registerAvailible && showRegisterForm) || (loginAvailible && !showRegisterForm) ? 'enabled' : 'disabled']" id="login-submit">
                            {{showRegisterForm ? 'Zarejestruj się' : 'Zaloguj się'}}
                    </button>
                    <!-- <span @click="$emit('loginFormOff')" id="disclaimer">Naciśnij ESC aby opuścić</span> -->
                    <button @click.prevent="$emit('loginFormOff')" id="disclaimer">Naciśnij ESC aby opuścić</button>
                </div>
        </form>
    </div>  
</div>
</template>

<style lang = "scss">
    #login-form-container{
        --min-height: 520px;
        --min-height-2: calc(520px + 12rem + 2em);
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
          //  border: 4px solid #18181a;
            position: relative;
            overflow: hidden;
            transition: all var(--animation-time) ease-out;
            transform-origin:center ;
            background-color: #222;
            min-height: var(--min-height);
            width: 400px;   
            border-radius: 5px;
            &.register-animation{
                min-height: var(--min-height-2);
            }
            input{
                outline: none;
                display: block;
                border-radius: 5px;
                margin: 3rem auto;
                padding: 1em .7em;
                background-color: #333;
                color: #aaa;
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
                    caret-color: #aaa;
            }
            .login-form-input-container{
                position: relative;
                .label{
                    font-size: 1.2rem;
                    height: max-content;
                    position: absolute;
                    transition: all .2s ease-out;
                    user-select: none;
                    display: block;
                    width: max-content;
                    color: #aaa;
                    inset: 30% 0 0 15%;
                    pointer-events: none;
                }
            }
            #login-form-title{
                width: 100%;
                text-align: center;
                color: var(--base-light-green);
                margin-top: 2rem;
                font-size: 2rem;
            }
            #bottom-inputs-options{
                display: flex;
                margin: auto;
                width: 75%;
                flex-wrap:wrap;
                justify-content: space-between;
                align-items: center;
                &.register{
                    justify-content: center !important;
                }
                #change-to-register-btn, #change-to-login-btn{
                    color: var(--base-light-green);
                }
                #forgot-password-btn{
                    color: white;
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
                background-color: var(--base-light-green);
                border: none;
                border-radius: 3px;
                outline: none;
                height: 50px;
                transition: all .15s ease-out;
                font-size: 1.5rem;
                width: 75%;
                margin: 2rem auto;
                position: relative;
                &.enabled{
                    &:after{
                    content: '';
                    opacity: 0;
                    height: 100%;
                    position: absolute;
                    width: 100%;
                    inset: 0;
                    filter: blur(3px);
                    border: 3px solid var(--base-light-green);
                }
                &:hover{
                    cursor: pointer;
                }
                &:hover,&:focus,&:active{
                    transform: scale(1.03);
                    &:after{
                        opacity: 1;
                    }
                }
                }

            }
            #disclaimer{
                display: block;
                text-align: center;
                color:#aaa;
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
            }
            //Change into data-attr
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
                color: yellow;
                font-size: 1.2rem;
                word-wrap: break-word;
                width: 75%;
                text-align: center;
            }
            .login-form-lower-btn{
                transition: all .2s ease;
                &:hover, &:focus{
                    transform: scale(1.03);
                }
            }
        }
        #login-form-bottom-container{
            position: absolute;
            bottom: 50px;
            width: 100%;    
            // &.register-animation{
            //     transition: all var(--change-form-transition);
            //     transform: translateY(calc(var(--min-height-2) - var(--min-height) - 30px));
            // }
            // &.login-animation{
            //     animation: login-form-bottom var(--change-form-transition);
            // }
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
        // @keyframes login-form-bottom{
        //     0%{
        //         transform: translateY(calc(var(--min-height-2) - var(--min-height) - 30px));
        //     }
        //     100%{
        //         transform: translateY(0);
        //     }
        // }

        .spacer{
            margin-bottom: 240px;
        }

    }
</style>

<script>
import axios from 'axios';
import Loader   from './Loader.vue';
import formOutcome from './formOutcome.vue';
import { userSettings } from '../storage/userSettings';
import {mapState} from 'pinia';
import { mapWritableState } from 'pinia';
import formInput from './formInput.vue';
export default{
    data(){
        return{
            // emailTaken: [],
            // usernameTaken: [],
            showRegisterForm: false,
            usernameValue: '',
            passwordValue: '',
            repeatPasswordValue: '',
            emailValue: '',
            errorMessage: {username: "", password: "", repeatPassword: "", email: ""},
            repeatPasswordErrorMessage: '',
            emailErrorMessage: '',
            usernameErrorMessage: '',
            passwordErrorMessage: '',
            // usernameLoginErrorMessage: '',
            // passwordLoginErrorMessage: '',
            // registerValidator: {usernameError: false,repeatPasswordError: false,emailError: false,passwordError: false, },
            // usernameError: false,
            // repeatPasswordError: false,
            // emailError: false,
            // passwordError: false,
            loading: false,
            formOutcome: false,
            formError: false,
            oginValidationError: false
        }
    },
    components:
    {
        Loader,
        formOutcome,
        formInput
    },
    computed:{
        ...mapState(userSettings, ['getLang']),
        ...mapWritableState(userSettings, ['Auth', 'Nickname']),
        registerAvailible(){
            return this.showRegisterForm && Object.values(this.errorMessage).every(val => val==='') && this.usernameValue && this.passwordValue && this.repeatPasswordValue
        },
        loginAvailible(){
            return this.usernameValue && this.passwordValue ? true : false
        }
    },
    methods:{
        async loginHandler(){
            this.loading=true;
            axios
            .post("/api/login", {name: this.usernameValue, password: this.passwordValue})
            .then(res =>{
                if(!res.data.validation) this.loginValidationError = true
                else{
                    this.formOutcome = true;
                }
            })
            .catch(()=>{
                this.formOutcome=true
                this.formError=true
            })
            .finally(this.loading=false)
        },
        async registerHandler(){
            if(!this.registerAvailible) return
            this.loading=true;
            axios
            .post("/api/register",{name: this.usernameValue, email: this.emailValue, password: this.passwordValue})
            .then((response)=>{
                this.Nickname = response.data.name
                this.Auth = true
                this.showRegisterFormOff()
                this.formOutcome=true;
            })
            .catch((err)=>{ 
                if(err.response.status!=422){
                    this.showRegisterFormOff()
                    this.formOutcome=true;
                    this.formError=true
                    return 
                }
                if(err.response.data.errors.email && err.response.data.errors.email[0]==="Email Taken"){
                    // this.emailTaken.push(this.emailValue)
                    this.errorMessage.email = "Adres email jest zajęty";
                    this.registerValidator.emailError =true;
                } 
                if(err.response.data.errors.name && err.response.data.errors.name[0]==="Name Taken"){
                    // this.usernameTaken.push(this.usernameValue)
                    this.errorMessage.username = "Nazwa użytkownika jest zajęta";
                    this.registerValidator.usernameError =true;
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
            if(hideRegisterFormBtn) hideRegisterFormBtn.disabled=true
            loginForm.classList.add('register-animation');
            setTimeout(()=>{
                this.showRegisterForm=true;
                if(hideRegisterFormBtn) hideRegisterFormBtn.disabled=false
            },animationTime)
        },
        showRegisterFormOff(){
            const animationTime = this.$refs.loginForm.getAttribute('animation-time')
            this.showRegisterForm=false;
            const showRegisterFormBtn = this.$refs.showRegisterFormBtn ? this.$refs.showRegisterFormBtn : false
            const loginForm = this.$refs.loginForm
            if(showRegisterFormBtn) showRegisterFormBtn.disabled=true
            setTimeout(()=>{
                loginForm.classList.remove('register-animation');  
                if(showRegisterFormBtn) {
                    setTimeout(()=>{
                        showRegisterFormBtn.disabled=false
                    },animationTime)
                }
            },animationTime)
        },
    },  
    watch: {
       // usernameValue(newVal){

           // const regex = /[^A-Za-z0-9]+/g
            // if(this.usernameTaken.includes(newVal)){
            //     this.usernameErrorMessage = "Nazwa użytkownika jest zajęta";
            //     this.registerValidator.usernameError =true;
            // }
        //     if(newVal.length>16){
        //         this.usernameErrorMessage = "Nazwa jest za długa";
        //         this.registerValidator.usernameError = true;
        //     }
        //     else if(regex.test(newVal)){
        //         this.usernameErrorMessage = "Niedozwolone znaki";
        //         this.registerValidator.usernameError = true;
        //     }
        //     else if(!regex.test(newVal) && newVal.length<=16){
        //         this.usernameErrorMessage = '';
        //         this.registerValidator.usernameError = false;
        //     }
        // },
        emailValue(newVal){
            //Zmienic regexa
            const regex = /^([A-Za-z0-9.\-]*\w)+@+([A-Za-z0-9\-]*\w)+(\.[A-Za-z]*\w)+$/;
            // if(this.emailTaken.includes(newVal)){
            //     this.emailErrorMessage = "Adres email jest zajęty";
            //     this.registerValidator.emailError =true;
            // }
            if(!regex.test(newVal)  && newVal!=""){
                this.emailErrorMessage = "Nieprawidłowy format adresu email";
                this.registerValidator.emailError =true;
            }
            else{
                this.emailErrorMessage="";
                this.registerValidator.emailError = false;
            }
        },
            // passwordValue(newVal){
            //     const repeatPasswordVal = this.repeatPasswordValue;
            //     if(newVal.length < 8 && newVal){
            //         this.registerValidator.passwordError=true;
            //         this.passwordErrorMessage="Hasło jest za krótkie (minimum 8 znaków)";
            //     }
            //     else{
            //         this.registerValidator.passwordError=false;
            //         this.passwordErrorMessage="";
            //     }
            //     if(repeatPasswordVal  && newVal.length >=8 && newVal && repeatPasswordVal!=newVal){
            //         this.registerValidator.repeatPasswordError=true;
            //         this.repeatPasswordErrorMessage="Hasła są różne!";
            //     }
            //     else{
            //         this.registerValidator.repeatPasswordError=false
            //         this.repeatPasswordErrorMessage="";
            //     }
            // },
        // repeatPasswordValue(newVal){
        //     const passwordVal = this.passwordValue;
        //     if(passwordVal && passwordVal.length >=8 && newVal && passwordVal!=newVal){
        //         this.registerValidator.repeatPasswordError=true;
        //         this.repeatPasswordErrorMessage="Hasła są różne!";
        //     }
        //     else{
        //         this.registerValidator.repeatPasswordError=false
        //         this.repeatPasswordErrorMessage="";
        //     }
        // }
    }
}
</script>