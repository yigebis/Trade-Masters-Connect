const accepted = document.querySelectorAll('.accepted-more');
const pending = document.querySelectorAll('.pending-more');
// console.log(accepted);
for (let i = 0; i < accepted.length; i++){
    accepted[i].addEventListener('click', ()=>{
        window.location.href = 'accepted.php';
    })
}

for (let i = 0; i < pending.length; i++){
   pending[i].addEventListener('click', ()=>{
        window.location.href = 'pending.php';
    }) 
}