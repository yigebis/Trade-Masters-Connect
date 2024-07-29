function viewRequestDetails(date, techUsername, custUsername, skillTitle){
    window.location.href = `requestDetails.php?date=${date}&techUsername=${techUsername}&custUsername=${custUsername}&skillTitle=${skillTitle}`;
}
function viewConfirmReject(event){
    let message = "Are you sure you want to reject?";
    if (!confirm(message)){
        event.preventDefault();
    }
}
function viewConfirmAccept(event){
    let message = "Are you sure you want to accept?";
    if (!confirm(message)){
        event.preventDefault();
    }
}