<template>
    <div id="register-outcome-container" :class="props.error ? 'error' : ''">
        <div v-if="!props.error" id="positiv-outcome">
            <div class="icon-register-outcome">
                <svg  width="100%" height="300px"  ref="svg" viewBox="0 0 21 20" xmlns="http://www.w3.org/2000/svg">
                    <circle ref="circle" cx="10.5" cy="10" r="5" />
                    <path ref="line" d="M13,8 L10,12 L8,10.5" /> 
                </svg>
            </div>
            <div class="text-register-outcome">
                {{ messageSuccessType }}
            </div>
        </div>
        <div v-else id="error-outcome">
            <div class="icon-register-outcome">
                <svg width="100%" height="300px"  ref="svg" class = "error" viewBox="0 0 21 20" xmlns="http://www.w3.org/2000/svg">
                    <circle ref="circle" cx="10.5" cy="10" r="5" />
                    <path ref="line" d="M12.5,8 L8.5,12 M8.5,8 L12.5,12" /> 
                </svg>
            </div>
            <div class="text-register-outcome error">
                {{ messageFailedType }}
            </div>
        </div>
        <button @click="closeForm()" id="disclaimer">{{ getLang('exitFormDisclaimerDesktop') }}</button>
    </div>
</template>
<style lang = "scss">
    #register-outcome-container{
        position: relative;
        overflow: hidden;
        width: 100%;
        height: 100%;
        .icon-register-outcome svg{
            fill: transparent;
            stroke: var(--base-dark-green-2);
            circle{
                transform-box: fill-box;
                transform-origin: center;
                animation: svg-animation-circle .9s ease-in-out forwards;
            }
            path{
                animation: svg-animation-path .9s ease-in-out forwards;
            }
            &.error{
                stroke: rgb(185, 36, 36);
            }
        }
        .text-register-outcome{
            font-weight: 900;
            color:  var(--base-dark-green-2);
            padding: 0 .5em;
            transform: translateY(300%);
            animation: text-animation .5s ease-in-out forwards;
            font-size: 2em;
            text-wrap: wrap;
            margin: 0 auto;
            text-align: center;
            &.error{
                color: rgb(185, 36, 36);
            }
        }
        &:after{
            content: '';
            height: 3px;
            background:  var(--base-dark-green-2);
            width: 100%;
            bottom: 0;
            transform-origin: left;
            position: absolute;
            animation: after-animation 3s linear forwards;
            display: block;
        }
        &.error:after{
            animation-duration: 5s;
            background: rgb(185, 36, 36);
        }
        #disclaimer{
                display: block;
                text-align: center;
                margin: 3rem auto 3rem auto;  
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
        @keyframes svg-animation-path{
            from{
                opacity: .25;
            }
            to{
                opacity: 1;
                stroke-dashoffset: 0;
            }
        }
        @keyframes svg-animation-circle{
            to{
                stroke-dashoffset: 0;
                rotate: 180deg;
            }
        }
        @keyframes text-animation{
            to{
                transform: translateY(0)
            }
        }
        @keyframes after-animation{
            to{
                transform: scaleX(0);
            }
        }
    }
</style>
<script setup>
    import {ref, onMounted,computed} from 'vue'
    import { userSettings } from '@/storage/userSettings.js';
    const circle = ref(null)
    const line = ref(null)

    const emit = defineEmits(['close'])
    onMounted(()=>{
        const circleLength = Math.ceil(circle.value.getTotalLength())+1;
        const lineLength = Math.ceil(line.value.getTotalLength())
        circle.value.style.strokeDashoffset = circleLength;
        circle.value.style.strokeDasharray = circleLength;
        line.value.style.strokeDashoffset = lineLength;
        line.value.style.strokeDasharray = lineLength;
        setTimeout(()=>{emit('close')}, props.error ? 5000 :3000)
    })
    const props = defineProps({
        error: Boolean,
        outcomeType: String
    })
    const messageSuccessType =  computed(()=>{
        switch(props.outcomeType){
            case "login":
                return getLang("loginSuccesfullFormOutcome")

            case "register":
                return getLang("registerSuccesfullFormOutcome")
        }
    })
    const messageFailedType =  computed(()=>{
        switch(props.outcomeType){
            case "login":
                return getLang("loginFailedFormOutcome")
            case "register":
                return getLang("registerFailedFormOutcome")
        }
    })
    const closeForm = ()=>{
        emit('close')
    }

    const store = userSettings()
    const {getLang} = store
</script>