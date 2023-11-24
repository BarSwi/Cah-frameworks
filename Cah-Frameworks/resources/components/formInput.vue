<template>
    <div class = "login-form-input-container">
        <input :autocomplete="autoComplete"  @input="$emit('update:modelValue', $event.target.value)" :value="modelValue" :type="inputType" placeholder = ' ' :id = "`${label}-input`" class="register-form-input">
        <label :for="`${label}-input`" class = 'label' >{{getLang(`${camelCase(label)}InputPlaceholder`)}}</label>
    </div>  
    <div v-if="error[camelCase(label)] && registerShown" class="error-message" id="username-error">
        {{ error[camelCase(label)] }}
    </div>
</template>

<style lang="scss">
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
    .error-message{
        margin: -2rem auto auto auto;
        color: yellow;
        font-size: 1.2rem;
        word-wrap: break-word;
        width: 100%;
        text-align: center;
    }
}
</style>

<script setup>
import { userSettings } from '../storage/userSettings';
import { storeToRefs } from 'pinia';
import {ref, watch, computed} from 'vue'
const store = userSettings();
const { getLang } = storeToRefs(store)
const props = defineProps({
    errorMessageInput: {
        type: Object,
        text: String,
        inputType: String
    },
    inputType:{
        type: String,
        required: true
    },
    modelValue:{
        type: String,
        required:true
    },
    label:{
        type: String,
        required: true
    },

    //loginForm variables
    passwordVal: {
        type: String
    },
    repeatPasswordVal: {
        type: String
    },
    registerShown:{
        type: Boolean,
        required: true
    },
    
});
const autoComplete = computed(()=>{
    switch(props.label){
        case 'username':
            return 'username'
        case 'password':
            return props.registerShown ? 'new-password' : 'current-password'
    }
})
const error = ref(props.errorMessageInput)
const emit = defineEmits([
    'update:modelValue',
])
watch(()=> props.modelValue, ()=>{
    // prop typu obiekt errorMessageInput jest zewnetrznie modyfikowany, co pozwala na utrzymanie listy błędów w konkretnym typie formularza
    switch(props.label){
        case "username":
            const regex = /[^A-Za-z0-9]+/g;
            if(props.modelValue.length>16){
                error.value[camelCase(props.label)] = "Nazwa jest za długa";
            }
            else if(regex.test(props.modelValue)){
                error.value[camelCase(props.label)] = "Niedozwolone znaki";
            }
            else{
                error.value[camelCase(props.label)] = '';
            }
            break;
            case "password":
                const repeatPasswordVal = props.repeatPasswordVal
                if(props.modelValue.length < 8 && props.modelValue){
                    error.value[camelCase(props.label)]="Hasło jest za krótkie (minimum 8 znaków)";
                }
                else{
                    error.value[camelCase(props.label)]="";
                }
                if(repeatPasswordVal  && props.modelValue.length >=8 && repeatPasswordVal!=props.modelValue){
                    error.value.repeatPassword="Hasła są różne!";
                }
                else if((repeatPasswordVal  && repeatPasswordVal==props.modelValue) || props.modelValue.length <8){
                    error.value.repeatPassword="";
                }
                break;
            case "repeat-password":
            const passwordVal = props.passwordVal;
                if(passwordVal && passwordVal.length >=8 && props.modelValue && passwordVal!=props.modelValue){
                    error.value[camelCase(props.label)]="Hasła są różne!";
                }
                else{
                    error.value[camelCase(props.label)]="";
                }
                break;
            case "email":
                //Zmienic regexa
            const reg = /^([A-Za-z0-9.\-]*\w)+@+([A-Za-z0-9\-]*\w)+(\.[A-Za-z]*\w)+$/;
            if(!reg.test(props.modelValue)  && props.modelValue!=""){
                error.value[camelCase(props.label)] = "Nieprawidłowy format adresu email";
            }
            else{
                error.value[camelCase(props.label)] ="";
            }
    }

})

//kebabCase to camelCase
const camelCase = s => s.replace(/-./g, x=>x[1].toUpperCase())

</script>