const passwordEl = document.getElementById('password');
const confirmEl = document.getElementById('confirm');
const errorEl = document.getElementById('error');
const showPassEl = document.getElementById('show-hide');
const showText = document.getElementById('show-text');



confirmEl.addEventListener('blur', ()=>{
    let password = passwordEl.value, confirm = confirmEl.value;

    if (password != confirm){
        errorEl.style.display = 'block';
    }
    else{
        errorEl.style.display = 'none';
    }
})

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
