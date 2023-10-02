export function changeTheme(){
    const hook = document.querySelector("body")
    const theme = hook.getAttribute("data-theme")
    if(theme=="light"){
        document.querySelector("body").setAttribute("data-theme","dark")
    } 
    else{
        document.querySelector("body").setAttribute("data-theme","light")
    } 
}