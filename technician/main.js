document.addEventListener("DOMContentLoaded", function () {
    // Get the "See more" button element
    var seeMoreButton = document.getElementById('see-more');

    // Get the hidden elements
    var hiddenElements = document.querySelectorAll('#requestsList .hidden');

    // Add a click event listener to the "See more" button
    seeMoreButton.addEventListener('click', function () {
        // Toggle the visibility of hidden elements
        hiddenElements.forEach(function (element) {
            element.classList.toggle('hidden');
        });

        // Update the text of the "See more" button
        if (seeMoreButton.innerHTML === 'See more...') {
            seeMoreButton.innerHTML = 'See less';
        } else {
            seeMoreButton.innerHTML = 'See more...';
        }
    });
});
document.addEventListener("DOMContentLoaded", function() {
var homeButton = document.querySelector(".button2:nth-child(1)");
var requestButton = document.querySelector(".button2:nth-child(2)");
var shareRatingButton = document.querySelector(".button2:nth-child(3)");
var previousAcceptanceButton = document.querySelector(".button2:nth-child(4)");
var aboutUsButton = document.querySelector(".button2:nth-child(5)");
var logoutButton = document.querySelector(".button2:nth-child(6)");

homeButton.addEventListener("click", function() {
    // Handle home button click
    window.location.href = "home.html"; // Replace with the actual home page URL
});

requestButton.addEventListener("click", function() {
    // Handle request button click
    var newRequestCount = 5; // Replace with your logic to get the actual number of new requests
    alert("Number of new requests: " + newRequestCount);
    // Add your custom functionality here
    // For example, you can make an API request to fetch the new requests and display them on the page
});

shareRatingButton.addEventListener("click", function() {
    // Handle share rating button click
    // Open a modal or form for users to provide ratings and feedback
    // For example, you can use a library like Bootstrap or create a custom modal
    var ratingModal = document.getElementById("ratingModal");
    ratingModal.style.display = "block";
});

previousAcceptanceButton.addEventListener("click", function() {
    // Handle previous acceptance button click
    // Retrieve and display a list of previous accepted requests
    // For example, you can fetch the data from an API and dynamically generate the list
    var previousAcceptanceList = document.getElementById("previousAcceptanceList");
    // Make an API request to fetch the previous accepted requests data
    fetch("your-api-url")
        .then(response => response.json())
        .then(data => {
            // Process the data and generate the list
            data.forEach(request => {
                var listItem = document.createElement("li");
                listItem.textContent = request.title;
                previousAcceptanceList.appendChild(listItem);
            });
        });
});

aboutUsButton.addEventListener("click", function() {
    // Handle about us button click
    window.location.href = "about us.html"; // Replace with the actual about us page URL
    });
    });


logoutButton.addEventListener("click", function() {
    // Handle logout button click
    // Perform logout actions, such as clearing session data and redirecting to the login page
    // For example, you can use localStorage to clear session data and redirect to the login page
    localStorage.clear();
    window.location.href = "login.html";
});

