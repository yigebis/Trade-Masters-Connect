function redirectTo(userType){
    if (userType == 'homeOwner'){
        window.location.href = 'homeOwner.html';
    }
    else{
        window.location.href = 'technician.html';
    }
}