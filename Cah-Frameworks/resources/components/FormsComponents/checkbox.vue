<template>
    <div class="checkbox-container">
        <input :checked="checked" type="checkbox" @change="$emit('inputChanged')" style="display: none;"  class="checkbox-input" id="checkbox-input"/>
        <label @keydown.enter="checked=!checked" tabindex="0" for="checkbox-input" class="checkbox-toggle">
            <slot></slot>
            <span class="checkbox-toggle-handler"></span>
        </label>
    </div>
</template>

<style lang="scss">
    .checkbox-container{
        display: flex;
        justify-content: center;
        .checkbox-toggle{
            transition: all .2s cubic-bezier(0,.35,0,1);
            display: flex;
            justify-content: center;
            gap: 10px;
            &:active, &:focus, &:hover {
                cursor: pointer;
                outline: none;
                transform: translateY(-3px);
            }
            @media (max-width: 280px){
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
        }
        .checkbox-input{

            margin: 0;

            &:checked + .checkbox-toggle{
               
                .checkbox-toggle-handler{
                    background-color: #a5a1a1;
                    &:after{
                        transform: translate(15px);
                        //background-color: var(--base-light-green-2);
                    }
                    &:before{
                        opacity: 1;
                    }
                }

            }
        }
        .checkbox-toggle-handler{
            transition: all .2s cubic-bezier(0,.35,0,1);
            display: inline-block;
            position: relative;
            width: 35px;
            height: 20px;
            background-color: #111010;
            border-radius: 30px;
            &:after{
                content: '';
                position: absolute;
                background: rgb(207, 204, 204);
                border-radius: 50%;
                height: 20px;
                width: 20px;
                transition: all .2s cubic-bezier(0,.35,0,1);
            }
            &:before{
                content: '';
                position: absolute;
                inset: 0;
                width: 100%;
                height: 100%;
                opacity: 0;
                filter: blur(1px);
                border: 1px solid var(--base-light-green);
                border-radius: 30px;
            }
        }
    }
</style>
 
<script setup>
const props = defineProps({
    checked:{
        type: Boolean,
        required: true
    }
})
</script>