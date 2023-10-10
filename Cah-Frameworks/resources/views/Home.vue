
<template>
    <top-navbar></top-navbar>
    <div id="container-home">
        <h1>
            Cards Against Hummanity
        </h1>
        <div id="login-guest-container">
            <button @mouseover="this.unlockPotential= true" @mouseleave="this.unlockPotential= false" class = "login-button">
                {{ lang['login'] }}
            </button>
            <button  @mouseover="this.unlockPotential= true" @mouseleave="this.unlockPotential= false" class = "guest-button">
                Graj jako gość
            </button>
        </div>
        
        <buttons-after-login :unlock-potential="unlockPotential"/>
        <h2>
            opis
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi diam odio, egestas nec tortor non, posuere viverra justo. Mauris dui metus, pellentesque ut elementum eget, mollis ac sapien. Nunc ligula elit, rutrum quis augue a, consectetur cursus orci. Suspendisse potenti. Vivamus nunc diam, pharetra id pretium sed, lobortis ut ligula. Phasellus porta risus quis vestibulum ornare. Integer ac mauris rutrum, ullamcorper massa id, tempor lorem. Morbi malesuada nulla nec elit condimentum, eu egestas neque rhoncus.

            Donec ac fringilla nunc. Integer vitae elementum justo. Morbi sed urna consectetur, posuere tortor eget, congue arcu. Pellentesque ut est nec dolor posuere pharetra a a lectus. Donec eget interdum nunc, quis efficitur lacus. Proin augue risus, ultricies sit amet risus vel, porta posuere tortor. Duis elementum fermentum risus nec tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum vulputate pellentesque eros, vestibulum commodo arcu efficitur tincidunt. Praesent pretium varius velit, in tempor sem sagittis id.
        </h2>
    </div>
</template>
<style lang = "scss">
    @import '../css/mixins.scss';
    #container-home{
        width: 75%;
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
                animation: button-flicker 1.5s linear infinite;
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
                &:hover,:focus,:active{
                    cursor: pointer;
                    color: var(--base-light-green);
                }
            }
            .login-button{
                font-weight: 900;
            }
        }
        @keyframes button-flicker{
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
</style>

<script>
import topNavbar from "../components/topNavbar.vue"
import buttonsAfterLogin from "../components/buttonsAfterLogin.vue";
import {config} from '../js/store'
export default {

  data() {
    return {
        loaded: false,
        unlockPotential: false
    }
  },
  components:
    {
        topNavbar,
        buttonsAfterLogin,
    },
    methods:{
        test(){
            alert("test")
        }
    },
    provide: {
        config: config
    },
    computed:{
        lang(){
            return config.language
        }
    }
  }
</script>
