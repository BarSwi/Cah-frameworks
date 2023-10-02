export function changeTheme(){
    const hook = document.querySelector("body")
    const theme = hook.getAttribute("data-theme")
    if(theme=="light"){
        hook.setAttribute("data-theme","dark")
        hook.classList.add('dark')
        hook.classList.remove('light')
        
    } 
    else{
        hook.setAttribute("data-theme","light")
        hook.classList.add('light')
        hook.classList.remove('dark')
    } 
}