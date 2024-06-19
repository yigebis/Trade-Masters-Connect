function viewTechnician(techUserName){
    window.location.href = `technicianInfo.php?techUserName=${techUserName}`;
}

// let technicians = [];

// function addTechnician(userName, fullName){
//     technicians.push([fullName, userName]);
// }

// addTechnician('beleir', 'Beleir Kebede Gemechu');
// addTechnician('jemal', 'Jemal Kebede Gemechu');
// addTechnician('abebe', 'Abebe Kebede Gemechu');
// addTechnician('demeke', 'Demeke Kebede Gemechu');
// addTechnician('cat', 'Cat Kebede Gemechu');
// addTechnician('ekram', 'Ekram Kebede Gemechu');


// technicians.sort();
// console.log(technicians);

// let technicians = [];

async function fetchTechnicians(){
    // const technicians = [];
    try{
        const response = await fetch('jsonCreator.php');
        const data = await response.json();
        return data;
    }
    catch(error){
        console.log("Error", error);
    }
}



// console.log(fetchTechnicians());
// console.log(technicians);
const suggestedDiv = document.getElementById('suggested-words');


async function findTechnicians(size=10, prefix){
    const technicians = await fetchTechnicians();

    let result = [];

    for (let i = 0; i < technicians.length; i++){
        technician = technicians[i];
        userName = technician[1];
        fullName = technician[0];

        if (prefix != "" && (fullName.toLowerCase()).includes(prefix.toLowerCase())){
            result.push([fullName, userName]);
        }
    }

    suggestedDiv.innerHTML = '';

    for (let i = 0; i < result.length; i++){
        const suggestion = document.createElement('p');
        suggestion.textContent = result[i][0];
        
        suggestion.addEventListener('click', function(){
            searchInput.value = result[i][0];
        })

        suggestedDiv.appendChild(suggestion);
    }
    // return (result.slice(0, Math.min(size, result.length)));
}


const searchInput = document.getElementById('search-input');
searchInput.addEventListener('keyup', function(){
    // console.log(searchInput.value);
    findTechnicians(10, searchInput.value);
    
})

