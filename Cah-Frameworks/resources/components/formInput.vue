<template>
<div class = "login-form-input-container">
    <input @input="$emit('update:title', $event.target.value)" :value="modelValue" :type="inputType" placeholder = ' ' :name="label" class="register-form-input">
    <label :for="label" class = 'label' >{{getLang('passwordRepeatInputPlaceholder')}}</label>
</div>
<div v-if="showRegisterForm && registerValidator.usernameError" class="error-message" id="username-error">
        {{ usernameErrorMessage }}
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

const store = userSettings();
const { getLang } = storeToRefs(userList)
const props = defineProps({
    errorMessage: String,
    inputType: String,
    modelValue: String,
    label: String,
})
const emit = defineEmits([
    'update:modelValue'
])

</script>