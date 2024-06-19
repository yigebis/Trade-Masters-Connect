const acceptedRequests = document.querySelectorAll('li');

for (let i = 0; i < acceptedRequests.length; i++){
    // const newRequestBtn = document.querySelectorAll('.new-request-btn');
    acceptedRequests[i].addEventListener('click', ()=>{
        acceptedRequests[i].lastElementChild.lastElementChild.style.visibility = 'hidden';
    })
}

function pendingDetails(date){
    window.location.href = `pendingDetails.php?date=${date}`;
}
