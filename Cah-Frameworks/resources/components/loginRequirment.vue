<template>
    <div id="login-requirment-layout">
        <div id="lock" :class = "unlockPotential ? 'unlock-potential' : ' '"></div>
    </div>
</template>

<style lang = "scss">
    // @import '../css/mixins.scss';
    #login-requirment-layout{
        position: absolute;
        display: flex;
        min-width: 100%;
        align-items: center;
        justify-content: center;
        height: 100%;
        inset: 0;
        background-color: rgb(32, 30, 30); 
        opacity: .5;
        border-radius: 10px;
        #lock{
            width: 2.9rem;
            position: relative;
            height: 2.3rem;
            border-radius: 5px;
            border: 4.5px solid var(--base-light-brown);
            transition: all .1s ease-in-out;
            &:after{
                content: "";
                transform-origin: center;
                display: block;
                background: var(--base-light-brown);
                width:  .25em;
                height: .6em;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%,-50%);
                -webkit-transition: all 0.1s ease-in-out;
                transition: all 0.1s ease-in-out;
            }
            &:before{
                content: "";
                display: block;
                width: 1.5em;
                height: 1.3em;
                bottom: 100%;
                position: absolute;
                left: 18%;
                border: 4.5px solid var(--base-light-brown);
                border-top-right-radius: 50%;
                border-top-left-radius: 50%;
                border-bottom: 0;
                -webkit-transition: all 0.1s ease-in-out;
                transition: all 0.1s ease-in-out;
            }
            &.unlock-potential{
                transform: translateY(-10%);
                &:before{
                    height: 1.4em;
                    // margin-left: -0.3em;
                    // transform: rotate(-45deg) translateY(-.35em);
                }
            }
        }
    }   
</style>
 
<script>
    export default{
        props: ['unlocked', 'unlockPotential'],

    }
</script>