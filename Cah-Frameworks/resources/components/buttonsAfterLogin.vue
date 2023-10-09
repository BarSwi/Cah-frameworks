<template>
    <div class="selection-section">
        <div class="selection-section-container">
            <button class="selection-home-button" id="create-game-btn">{{ lang['createGameButton']}}</button>
            <button class="selection-home-button">test</button>
            <button class="selection-home-button">test</button>
            <button class="selection-home-button">test</button>
        </div>
        <login-requirment></login-requirment>
    </div>
</template>
<style lang="scss">
    .selection-section{
        position: relative;
        margin-top: 100px;
        width: 100%;
        min-height: 300px;


        .selection-section-container{
            opacity: 0.5;
            overflow: auto;
            display: flex;
            background-color: red;
            width: 100%;
            min-height: 100%;
            justify-content: space-evenly;
            align-items: center;
            flex-wrap: wrap;
            .selection-home-button{
                outline: none;
                border: none;
                box-sizing: border-box;
                font-size: 1.5rem;
                margin: 25px;
                min-height: 120px;
                width: 25%;
                min-width: 200px;
            }
        }

    }
</style>
<script>
import loginRequirment from '../components/loginRequirment.vue'
// import {config} from '../js/store'
import {setLanguage} from '../js/store'
export default{
    // data(){
    //     return{
    //     }
    // },
    components:{
        loginRequirment,
    },
    inject: ['config'],
    methods:{
    },
    computed:{
        lang(){
            return this.config.language
        }
    }
}

</script>