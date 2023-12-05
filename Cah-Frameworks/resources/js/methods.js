import axios from "axios";
import { userSettings } from "@/storage/userSettings";

// Global functions used in the whole app
//Get specific cookie value by name
function getCookie(cName) {
        const name = cName + "=";
        const cDecoded = decodeURIComponent(document.cookie); //safety reasons
        const cArr = cDecoded.split('; ');
        let res;
        cArr.forEach(val => {
          if (val.indexOf(name) === 0) res = val.substring(name.length);
        })
        return res
      }


//Sends request to check if user has valid authentication token, returns a promise
export function checkAuth(){
    getCookie('auth-token');
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
        if(e.response.status==401) console.log("You are not logged in");
        else  console.log(e.message)
    })
    
}