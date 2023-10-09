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
        login: "Zaloguj się",
        createGameButton: "Stwórz grę"

    },
    ENG: {
        myAccount: 'My account',
        login: "Sign in",
        createGameButton: "Stwórz grę"

    }
}
config.language = languages['PL']