var password = document.getElementById("password");
var passwordConfirm = document.getElementById("passwordCofirm");
var errorMessage = document.querySelector(".errorMessage p");

//Sign Up//
function errorM(message){
    displaySU();
    errorMessage[0].textContent = message;
    document.getElementsByClassName('errorMessage').style.display = "block";
}

password.onchange = function(){
    event.preventDefault();
    if (password.checkValidity() == false){
        errorMessage.innerHTML = "Your password must contain at least one special character, one numeric character, one capital letter and must be between 6 and 20 characters long.";
        document.getElementById("errorMessage").style.display = "block";
    }else if (password.checkValidity() == true && document.getElementById("errorMessage").style.display == "block"){
        document.getElementById("errorMessage").style.display = "none";
    }
}
//-----------------------//
//Log In Form//
function displaySU(){
    document.getElementById("logInForm").style.display = "none";
    document.getElementById("signUpForm").style.display = "block";
}

function displayLI(){
    document.getElementById("logInForm").style.display = "block";
    document.getElementById("signUpForm").style.display = "none";
}
//-----------//