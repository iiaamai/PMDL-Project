const RegisterButton=document.getElementById('RegisterButton');
const LoginButton=document.getElementById("LoginButton");
const registerForm=document.getElementById('register');
const loginForm=document.getElementById('login');

RegisterButton.addEventListener('click',function(){
    loginForm.style.display="none";
    registerForm.style.display="block";
})
LoginButton.addEventListener('click',function(){
    registerForm.style.display="none";
    loginForm.style.display="block";
})