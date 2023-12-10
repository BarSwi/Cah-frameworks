<template>
    <div tabindex="0" v-if="Auth" id="navbar-profile-container">
        <div id="navbar-nickname">{{ Nickname }}</div>
        <div id = "navbar-profile-list">
            <ul>
                <li tabindex="0" role="menuitem">
                    Mój profil
                </li>
                <li tabindex="0" role="menuitem">
                    <button @click="logout()" aria-label="Log out">Wyloguj się</button>
                </li>
            </ul>
        </div>
    </div>
</template>
<style lang ="scss">
  #navbar-profile-container{
            margin: 0 15px;
            padding: 10px;
            background-color: var(--navbar-profile-bcg);
            border: 2px solid var(--navbar-profile-border);
            position: relative;
            border-radius: 2px;
            &:hover, &:focus, &:active, &:focus-within{
                outline: none;
                cursor: pointer;
                ul{
                    transition: transform .2s ease-out;
                    transform: scaleY(1);
                    li{
                        transform: translateX(0) !important;
                    }
                }
            }
            ul{
                transform-origin: top;
                overflow: hidden;
                list-style-type: none;
                margin-top: 10px;
                // border: 2px solid var(--navbar-profile-border);
                // border-top: none;
                background-color: var(--navbar-background-color);
                padding: 0;
                right: -17px;
                top: 55px;
                transform: scaleY(0);
                text-align: center;
                width: 130px;
                position: absolute;
                transition: transform .2s .15s ease-out;
                li{
                    transition: transform .2s ease-out;
                    // border-top: 2px solid var(--navbar-profile-border);
                    padding: 10px 0;
                    &:nth-of-type(odd){
                        transform: translateX(100%);
                    }
                    &:nth-of-type(even){
                        transform: translateX(-100%);
                    }
                    &:focus{
                        outline: none;
                    }
                }
            }
            #navbar-nickname{
                font-weight: 900;
                font-size: 1.2em;
            }
        }
</style>

<script setup>
    import { userSettings } from '../../js/storage/userSettings';
    import { storeToRefs } from 'pinia';
    const store = userSettings();
    const { Auth, Nickname, Guest, getLang } = storeToRefs(store)
    const {setAuth, setNickname} = store;

    const logout = () =>{
        setAuth(false, false);
        setNickname('');
        axios.post('/api/logout');
    }
</script>