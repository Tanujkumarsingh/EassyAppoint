const Register = document.getElementById("RegisterButton");
const Login = document.getElementById("LoginButton");
const signInButtonAsClient = document.getElementById("signInButtonAsClient");
const signInButtonAsCompany = document.getElementById("signInButtonAsCompany");
const signUpButton = document.getElementById("signUpButton");
const RegisterAsCompany = document.getElementById("RegisterAsCompany");
const RegisterAsClient = document.getElementById("RegisterAsClient");
const signUpClient = document.getElementById("signUpClient");
const signUpCompany = document.getElementById("signUpCompany");
const signIn = document.getElementById("signIn");
const check = document.getElementById("ABC");

signUpButton.addEventListener('click' , function() {
    signIn.style.display = "none";
    check.style.display= "block";
})

Register.addEventListener('click' , function() {
    signIn.style.display = "none";
    check.style.display= "block";
    signUpCompany.style.display= "none";
    signUpClient.style.display= "none";

})
RegisterAsCompany.addEventListener('click' , function() {
    check.style.display = "none";
    signUpCompany.style.display= "block";
})

RegisterAsClient.addEventListener('click' , function() {
    check.style.display = "none";
    signUpClient.style.display= "block";
})

Login.addEventListener('click' , function() {
    signIn.style.display = "block";
    check.style.display= "none";
    signUpCompany.style.display= "none";
    signUpClient.style.display= "none";

})

signInButtonAsClient.addEventListener('click' , function() {
    signIn.style.display = "block";
    check.style.display= "none";
    signUpCompany.style.display= "none";
    signUpClient.style.display= "none";

})

signInButtonAsCompany.addEventListener('click' , function() {
    signIn.style.display = "block";
    check.style.display= "none";
    signUpCompany.style.display= "none";
    signUpClient.style.display= "none";

})



