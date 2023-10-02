import {reactive} from 'vue';

export const config = reactive({
    auth: false,
    nickname: String,
    language: Object,
    currentLang: String
});

export function setLanguage(lang){
    config.currentLang = lang;
    config.language = languages[lang];
}

export const languages = {
    PL: {
        myAccount: 'Moje konto',

    },
    ENG: {
        myAccount: 'My account',

    }
}