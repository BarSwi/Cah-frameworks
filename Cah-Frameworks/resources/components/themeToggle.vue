<template>
<div class="toggleWrapper">
  <input type="checkbox"  v-model="darkTheme" @click="changeTheme()" class="dn" id="dn"/>
  <label for="dn" class="toggle">
    <span class="toggle__handler">
      <span class="crater crater--1"></span>
      <span class="crater crater--2"></span>
      <span class="crater crater--3"></span>
    </span>
    <span class="cloud"></span>
    <span class="cloud cloud--2"></span>
    <span class="star star--1"></span>
    <span class="star star--2"></span>
    <span class="star star--3"></span>
    <span class="star star--4"></span>
  </label>
</div>
</template>

<style lang="scss">
.toggleWrapper {
  position: relative;
  -webkit-tap-highlight-color: transparent;
  margin: 0 1.5rem;
  overflow: hidden;
  
  input {
    position: absolute;
    inset:0;
    margin: 0;
    opacity: 0;
  }
  &:hover .toggle__handler{
    transform: translateX(2px) rotate(20deg);
  }
  &:hover .cloud{
    transform: translateX(2px);
  }
}

.toggle {
  cursor: pointer;
  display: inline-block;
  position: relative;
  width: 60px;
  height: 25px;
  background-color: #83D8FF;
  border-radius: 90px - 6;
  transition: background-color var(--transition-theme-method);
 
}

.toggle__handler {
  overflow: hidden;
  display: inline-block;
  position: relative;
  z-index: 1;
  top: 3px;
  left: 2px;
  width: 20px;
  height: 20px;
  background-color: #FFCF96;
  border-radius: 50px;
  transition: all var(--transition-theme-method);
  transform:  rotate(-45deg);
  
  &:before{
    position: absolute;
    inset: 0;
    content: '';
    border: 2px solid black;
    height: 100%;
    width: 100%;
    filter: blur(5px);
    
    border-radius: 50px;
  }
  .crater {
    position: absolute;
    background-color: #977540;
    opacity: 0;
    transition: opacity var(--transition-theme-method);
    border-radius: 100%;
  }

  
  .crater--1 {
    top: 5px;
    left: 3px;
    width: 2px;
    height: 2px;
  }
  
  .crater--2 {
    top: 12px;
    left: 12px;
    width: 4px;
    height: 4px;
  }
  .crater--3 {
    top: 5px;
    left: 13px;
    width: 3px;
    height: 3px;
  }
  
}
.cloud{
  --cloud-width: 18px;
  --cloud-height:  6px;
  position: absolute;
  top: 15px;
  left: 13px;
  z-index: 1;
  border-radius: calc(0.83*var(--cloud-height));
  width: var(--cloud-width); 
  height: var(--cloud-height);
  background-color: white;
  transition: all var(--transition-theme-method);
  &:before, &:after{
    content: '';
    position: absolute;
    background: #f2f9fe;
  }
  &:after{
    width: calc(0.38*var(--cloud-width)); height: calc(0.85*var(--cloud-height));
    top: -4px;
    left: 2px;
    border-radius: 50%;
  }
  &:before{
    width: calc(0.51*var(--cloud-width)); height: calc(1.5*var(--cloud-height));
    top: -5px;
    left: 6px;
    border-radius: 50%;
  }
  &.cloud--2{
    left: 32px;
    top: 6px;
  }
}

.star {
  position: absolute;
  background-color: #ffffff;
  transition: all var(--transition-theme-method);
  border-radius: 50%;
}
.star--1,
.star--2,
.star--3,
.star--4 {
  z-index: 0;
  opacity: 0;
  transition: all var(--transition-theme-method);
  transform: translateX(3px);
}

.star--4 {
  top: 16px;
  left: 11px;
  width: 2px;
  height: 2px;
}


input:checked {
  + .toggle {
    background-color: #03152e;
  
    &:before {
      color: #749ED7;
    }

    &:after {
      color: #ffffff;
    }
    &:hover .toggle__handler{
        transform: translateX(33px) rotate(-20deg);
    } 
    .toggle__handler {
      background-color: #FFE5B5;
      transform: translateX(35px) rotate(0);
  
      .crater { opacity: 1; }

    }
    .cloud{
      transform: translateX(100%) !important;
      opacity: 0;
    }
    .star--1 {
      top: 10px;
      left: 30px;
      width: 2px;
      height: 2px;
    }
    
    .star--2 {
      top: 17px;
      left: 23px;
      width: 4px;
      height: 4px;

    }
    
    .star--3 {
      top: 6px;
      left: 16px;
      width: 2px;
      height: 2px;
    }

    .star--1,
    .star--2,
    .star--3,
    .star--4{
      opacity: 1;
    }
  }
}

  
</style>

<script>
export default{
    data(){
        return{
            darkTheme: true
        }
    },
    methods:
    {
        changeTheme(){
            console.log(this.darkTheme)
            const hook = document.querySelector("body")
            if(!this.darkTheme){
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
    }
}
</script>