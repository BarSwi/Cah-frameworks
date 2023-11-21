<template>
    <div class = "login-form-input-container">
        <input  @input="$emit('update:modelValue', $event.target.value)" :value="modelValue" :type="inputType" placeholder = ' ' :name="`${label}-input`" class="register-form-input">
        <label :for="`${label}-input`" class = 'label' >{{getLang(`${camelCase(label)}InputPlaceholder`)}}</label>
    </div>
    <div v-if="error && registerShown" class="error-message" id="username-error">
        {{ error }}
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
        width: 75%;
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
    errorMessageInput: String,
    registerShown: Boolean,
    inputType: String,
    modelValue: String,
    label: String,
})

const error = ref(props.errorMessageInput)
const emit = defineEmits([
    'update:modelValue'
])

// watch(usernameArray, () => {
//     if(props.takenUsername.includes(props.modelValue)){
//         error.value = "Nazwa użytkownika jest zajęta";
//     }
// }, { immediate: true });

watch(() => props.modelValue, (newVal)=>{
    switch(props.label){
        case "username":
            const regex = /[^A-Za-z0-9]+/g;
            // if(props.takenUsername.includes(newVal)){
            //     error.value = "Nazwa użytkownika jest zajęta";
            // }
            if(newVal.length>16){
                error.value = "Nazwa jest za długa";
            }
            else if(regex.test(newVal)){
                error.value = "Niedozwolone znaki";
            }
            else if(!regex.test(newVal) && newVal.length<=16){
                error.value = '';
            }
            break;
    }
})

//kebabCase to camelCase
const camelCase = s => s.replace(/-./g, x=>x[1].toUpperCase())

</script>