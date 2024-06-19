const passwordEl = document.getElementById('password');
const showPassEl = document.getElementById('show-hide');
const showText = document.getElementById('show-text')
const userIdEl = document.getElementById('userId');
const idError = document.getElementById('id-error');
const passError = document.getElementById('pass-error');
const loginBtn = document.getElementById('login');

showPassEl.addEventListener('click', ()=>{
    let imageSrc = showPassEl.src;
    
    if (imageSrc.includes('jpg')){
        passwordEl.type = 'text';
        showPassEl.src = '../images/hide password icon.png';
        showText.textContent = 'Hide Password';
    }
    else{
        passwordEl.type = 'password';
        showPassEl.src = '../images/show password icon.jpg';
        showText.textContent = 'Show Password';
    }
})


// function inputValidator(){
//     userId = userIdEl.value;
//     password = passwordEl.value;
//     if (userId === ""){
//         idError.style.display = 'block';
//     }
//     else{
//         idError.style.display = 'none';
//     }
//     if (password === ""){
//         passError.style.display = 'block';
//     }
//     else{
//         passError.style.display = 'none';
//     }
// }

loginBtn.addEventListener('click', ()=>{
    userId = userIdEl.value;
    password = passwordEl.value;
    if (userId === ""){
        idError.style.display = 'block';
    }
    else{
        idError.style.display = 'none';
    }
    if (password === ""){
        passError.style.display = 'block';
    }
    else{
        passError.style.display = 'none';
    }
});