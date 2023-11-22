import {defineStore} from 'pinia'

export const userSettings = defineStore('userSettings', {
    state: () => ({
        currentLang: "PL",
        Auth: false,
        Nickname: String,
        lang: {
            PL: {
                myAccount: 'Moje konto',
                login: "Zaloguj się",
                createGameButton: "Stwórz grę",
                searchGameButton: "Wyszukaj Lobby",
                createDeckButton: "Stwórz talię",
                editDeckButton: "Edytuj talię",
                usernameInputPlaceholder: "Nazwa użytkownika",
                passwordInputPlaceholder: "Hasło",
                repeatPasswordInputPlaceholder: "Potwórz hasło",
                emailInputPlaceholder: "E-mail (opcjonalnie)",
                registerSuccesfull: "Rejestracja przebiegła pomyślnie!",
                registerFailed: "Coś poszło nie tak, prosimy spróbować później."
            },
            ENG: {
                myAccount: 'My account',
                login: "Sign in",
                createGameButton: "Create Game"
        
            }
        }
    }),
    getters: {
        getLang: (state) => {
            return (val) => state.lang[state.currentLang][val]
        }
    }
})