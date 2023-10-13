<template>
<div id="login-form-container" tabindex="0" @keydown.esc="$emit('loginFormOff')">
    <div id="login-form">
        <div id="login-form-title" >Logowanie</div>
        <div id="username-input-container">
            <input v-focus type="text" placeholder = ' ' id="username-input" name="username-input" class="username-form-input">
            <label for="username-input" class ='label' id = 'username-input-label'>{{lang['usernameInputPlaceholder']}}</label>
        </div>
        <div id="password-input-container">
            <input type="password" placeholder = ' ' name="password-input" id="password-input" class="login-form-input">
            <label for="password-input" class = 'label' id = 'password-input-label' >{{lang['passwordInputPlaceholder']}}</label>
        </div>
        <div id="bottom-inputs-options">
            <button class="login-form-lower-btn" id="forgot-password-btn">Zapomniałeś hasła?</button>
            <button class="login-form-lower-btn" id="register-btn">Zarejestruj się  </button>
        </div>
       <button type="submit" id="login-submit">
            Zaloguj się
       </button>
    </div>
</div>
</template>

<style lang = "scss">
    #login-form-container{
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
            background-color: #222;
            //background-image: linear-gradient(to bottom, #222, rgb(0, 7, 1));
            min-height: 520px;
            width: 400px;   
            border-radius: 5px;
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
            }
            #username-input-container, #password-input-container{
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
                & #register-btn{
                    color: var(--base-light-green);
                }
                & #forgot-password-btn{
                    color: white;
                }
                button{
                    outline: none;
                    background-color: transparent;
                    border: none;
                }
            }
            #login-submit{
                display: block;
                background-color: var(--base-light-green);
                border: none;
                border-radius: 3px;
                outline: none;
                height: 50px;
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
                    &:after{
                        opacity: 1;
                    }
                }
            }
        }
    }
</style>

<script>


export default{
    inject: ['config'],
    computed:{
        lang(){
            return this.config.language
        }
    },
    methods:{

    },
    directives: {

        focus: (el)=> {{

        }
            el.focus();
        }
    }
}
</script>