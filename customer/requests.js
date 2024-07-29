const acceptedRequests = document.querySelectorAll('li');



function pendingDetails(date){
    window.location.href = `pendingDetails.php?date=${date}`;
}

function acceptedDetails(custUserName, techUserName, date, skillTitle){
    window.location.href = `acceptedDetails.php?custUserName=${custUserName}&techUserName=${techUserName}&date=${date}&skillTitle=${skillTitle}`;
}

function rateTechnician(techUserName, skillTitle, date){
    window.location.href = `rating.php?techUserName=${techUserName}&skillTitle=${skillTitle}&date=${date}`;
}
