

const pswd = document.getElementById('pass');
let changer_visible=document.getElementById("changer_visible");
const eye = document.querySelector('.eye');
const eyeOff = document.querySelector('.eyeOff');
      changer_visible.addEventListener("click",function(){
      if(( pswd.type)=="password"){
        pswd.type = 'text'; 
        eyeOff.classList.add('hidden');
        eye.classList.remove('hidden');
      }else{
        pswd.type='password';
        eye.classList.add('hidden');
        eyeOff.classList.remove('hidden');
      }
 })