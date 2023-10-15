<template>
<div id="login-form-container" tabindex="0" @keydown.esc="$emit('loginFormOff')">
    <form>
        <div id="login-form" ref="loginForm">
        <div id="login-form-title" >{{ showRegisterForm ? 'Rejestracja' : 'Logowanie' }}</div>
        <div id="username-input-container">
            <input v-model="usernameValue" v-focus type="text" placeholder = ' ' id="username-input" name="username" class="username-form-input">
            <label for="username-input" class ='label' id = 'username-input-label'>{{lang['usernameInputPlaceholder']}}</label>
        </div>
        <div v-if="showRegisterForm && usernameError" class="error-message" id="username-error">
                {{ loginErrorMessage }}
        </div>
        <div id="password-input-container">
            <input v-model="passwordValue" type="password" placeholder = ' ' name="password" id="password-input" class="login-form-input">
            <label for="password-input" class = 'label' id = 'password-input-label' >{{lang['passwordInputPlaceholder']}}</label>
        </div> 
        <Transition name="float-right">
        <div v-if="showRegisterForm" id="password-repeat-input-container">
            <input v-model="repeatPasswordValue" type="password" placeholder = ' ' name="password-repeat-input" id="password-repeat-input" class="register-form-input">
            <label for="password-repeat-input" class = 'label' id = 'password-repeat-input-label' >{{lang['passwordRepeatInputPlaceholder']}}</label>
        </div>
        </Transition>
        <div v-if="showRegisterForm && repeatPasswordError" class="error-message" id="repeat-password-error">
                {{ repeatPasswordErrorMessage }}
        </div>
        <Transition name = "float-left">
        <div v-if="showRegisterForm" id="email-input-container">
            <input v-model="emailValue" type="text" placeholder = ' ' name="email-input" id="email-input" class="login-form-input">
            <label for="email-input" class = 'label' id = 'email-input-label' >{{lang['emailInputPlaceholder']}}</label>
        </div>
        </Transition>
        <div v-if="showRegisterForm && emailError" class="error-message" id="email-error">
                {{ emailErrorMessage }}
        </div>
        <div id="login-form-bottom-container" ref="loginFormBottomContainer">
            <div  id="bottom-inputs-options" :class="{register: showRegisterForm}">
            <button type="button" v-if="!showRegisterForm" class="login-form-lower-btn" id="forgot-password-btn">Zapomniałeś hasła?</button>
            <button type="button" v-show="!showRegisterForm" @click="showRegisterFormOn($event)" ref="showRegisterFormBtn" class="login-form-lower-btn" id="change-to-register-btn">Zarejestruj się  </button>
            <button type="button" v-show="showRegisterForm" @click.prevent="showRegisterFormOff()" class="login-form-lower-btn" id="change-to-login-btn">Posiadasz już konto? Zaloguj się</button>
            </div>
            <button id="login-submit">
                    {{showRegisterForm ? 'Zarejestruj się' : 'Zaloguj się'}}
            </button>
            <span @click="$emit('loginFormOff')" id="disclaimer">Naciśnij ESC aby opuścić</span>
        </div>
    </div>  
    </form>
</div>
</template>

<style lang = "scss">
    #login-form-container{
        --change-form-transition: .3s ease-out;
        --min-height: 520px;
        --min-height-2: calc(520px + 12rem + 2em);
        width: 75%;
        inset: 0;
        opacity: 1 !important;
        margin: auto;
        display: flex;
        z-index: 1000;
        align-items: center;
        justify-content: center;
        position: fixed;
        height: 100%;

        &:focus, &:active{
            outline: none;
        }
        #login-form{
            overflow: hidden;
            transition: all var(--change-form-transition);
            transform-origin:center ;
            background-color: #222;
            //background-image: linear-gradient(to bottom, #222, rgb(0, 7, 1));
            min-height: var(--min-height);
            width: 400px;   
            border-radius: 5px;
            &.register-animation{
                min-height: var(--min-height-2);
            }
            input{
                outline: none;
                display: block;
                color: var(--base-light-brown);
                border-radius: 5px;
                font-weight: 900;
                margin: 3rem auto;
                padding: 1em .7em;
                background-color: #333;
                border: none;
                font-size: 1.5em;
                width: 75%;
                height: 50px;
                &:focus, &:active, &:not(:placeholder-shown){
                    +.label{
                        font-size: 1rem !important;
                        top: -50% !important;
                    }
                }
                // &:autofill, &:-webkit-autofill{
                //     font-size: 1em;
                //     -webkit-box-shadow:0 0 0 60px #333 inset; 
                // }
            }
            #username-input-container, #password-input-container,#password-repeat-input-container,#email-input-container{
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
                margin: 3rem auto;
                width: 75%;
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
                display: block;
                background-color: var(--base-light-green);
                border: none;
                border-radius: 3px;
                outline: none;
                height: 50px;
                transition: all .3s ease-out;
                font-size: 1.5rem;
                width: 75%;
                margin: 3rem auto;
                position: relative;
                &:after{
                    content: '';
                    opacity: 0;
                    height: 100%;
                    position: absolute;
                    transition: opacity .3s ease-out;
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
            #disclaimer{
                display: block;
                margin: 3rem auto;  
                text-align: center;
                opacity: .7;
                width: 75%;
                &:hover{
                    cursor: pointer;
                }
            }
            .float-left-enter-active{
                animation: float-left .3s;
            }
            .float-left-leave-active{
                animation: float-left .3s reverse;
            }
            .float-right-enter-active{
                animation: float-right .3s;
            }
            .float-right-leave-active{
                animation: float-right .3s reverse;
            }
            .error-message{
                margin: -1rem auto;
                color: red;
                font-size: 1rem;
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
            &.register-animation{
                transition: all var(--change-form-transition);
                transform: translateY(calc(var(--min-height-2) - var(--min-height) - 30px));
            }
            &.login-animation{
                animation: login-form-bottom var(--change-form-transition);
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
        @keyframes login-form-bottom{
            0%{
                transform: translateY(calc(var(--min-height-2) - var(--min-height) - 30px));
            }
            100%{
                transform: translateY(0);
            }
        }

    }
</style>

<script>

export default{
    data(){
        return{
            showRegisterForm: false,
            usernameValue: '',
            passwordValue: '',
            repeatPasswordValue: '',
            emailValue: '',
        }

    },
    inject: ['config'],
    computed:{
        lang(){
            return this.config.language
        }
    },
    methods:{
        showRegisterFormOn(e){
            const loginForm = this.$refs.loginForm
            const loginFormBottomContainer = this.$refs.loginFormBottomContainer
            // if(loginFormBottomContainer.classList.contains('login-animation')) return;
            e.target.disabled=true
            loginForm.classList.add('register-animation');
            loginFormBottomContainer.classList.add('register-animation')
            setTimeout(()=>{
                this.showRegisterForm=true;
                // loginForm.classList.remove('register-animation')
                loginFormBottomContainer.classList.remove('register-animation');
                e.target.disabled = false
            },300)
        },
        showRegisterFormOff(){
            this.showRegisterForm=false;
            const showRegisterFormBtn = this.$refs.showRegisterFormBtn
            const loginForm = this.$refs.loginForm
            const loginFormBottomContainer = this.$refs.loginFormBottomContainer
            showRegisterFormBtn.disabled=true

            setTimeout(()=>{
                loginFormBottomContainer.classList.add('login-animation'); 
                loginForm.classList.remove('register-animation');  
                setTimeout(()=>{
                    loginFormBottomContainer.classList.remove('login-animation');
                    showRegisterFormBtn.disabled=false
                },300)
            },300)
        }
    },  
    directives: {

        focus: (el)=> {{

        }
            el.focus();
        }
    }
}
</script>