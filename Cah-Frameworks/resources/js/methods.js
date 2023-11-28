import axios from "axios";
import { userSettings } from "../storage/userSettings";

// Global functions used in the whole app

//Sends request to check if user has valid authentication token, returns a promise
export function checkAuth(){
    const store = userSettings();

    return axios
    .post('/api/auth-check')
    .then((res)=>{
        const validation = res.data.auth;
        if(validation){
            store.setAuth(true);
            store.setNickname(res.data.nickname)
        } 
        
    })
    .catch((e)=>{
        console.log(e.message)
    })
    
}