import {defineStore} from 'pinia'

export const userSettings = defineStore('userSettings', {
    state: () => ({
        currentLang: "PL",
        Auth: false,
        Guest: false,
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
                registerSuccesfullFormOutcome: "Rejestracja przebiegła pomyślnie!",
                registerFailedFormOutcome: "Coś poszło nie tak, prosimy spróbować później.",
                loginValidationError: "Niepoprawne dane logowania.",
                forgetPasswordText: "Nie pamiętasz hasła?",
                registerText: 'Zarejestruj się',
                accAlreadyExistsText: 'Posiadasz już konto? Zaloguj się',
                loginFailedFormOutcome: "Coś poszło nie tak, prosimy spróbować później",
                loginSuccesfullFormOutcome: "Witamy ponownie!",
                exitFormDisclaimerDesktop: "Naciśnij ESC aby opuścić formularz",
                exitFormDisclaimerMobile: "Naciśnij aby opuścić formularz",
            },
            ENG: {
                myAccount: 'My account',
                login: "Sign in",
                createGameButton: "Create Game",
                searchGameButton: "Search for Lobby",
                createDeckButton: "Create Deck",
                editDeckButton: "Edit Deck",
                usernameInputPlaceholder: "Username",
                passwordInputPlaceholder: "Password",
                repeatPasswordInputPlaceholder: "Repeat Password",
                emailInputPlaceholder: "Email (optional)",
                registerSuccesfullFormOutcome: "Registration successful!",
                registerFailedFormOutcome: "Something went wrong, please try again later.",
                loginValidationError: "Invalid login credentials.",
                forgetPasswordText: "Forgot your password?",
                registerText: 'Register',
                accAlreadyExistsText: 'Already have an account? Log in',
                loginFailedFormOutcome: "Something went wrong, please try again later.",
                loginSuccesfullFormOutcome: "Welcome back!",
                exitFormDisclaimerDesktop: "Press ESC to exit the form.",
                exitFormDisclaimerMobile: "Tap to exit the form.",
        
            }
        }
    }),
    getters: {
        getLang: (state) => {
            return (val) => state.lang[state.currentLang][val]
        }
    },
    actions: {
        setAuth(authStatus, guestStatus = false){
            this.Auth = authStatus;
            this.Guest = guestStatus;
        },
        setNickname(nickname){
            this.Nickname = nickname;
        }
    }
})