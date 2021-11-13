// DOM element
let addButton = document.getElementById('add-button');
let firstName = document.getElementById('first-name-input');
let lastName = document.getElementById('last-name-input');
let namesContent = document.querySelector('.names-content-p');

//Listener
addButton.addEventListener("click", e => {

    // Get value of the inputs
    let firstNameValue = firstName.value;
    let lastNameValue = lastName.value;
    console.log(firstNameValue + " " + lastNameValue);

    namesContent.innerHTML += " " + firstNameValue + " " + lastNameValue + " - ";

    // Modify DOM
    /* let appendToDOM = (firstNameValue, lastNameValue) => {
        namesContent.innerHTML = firstNameValue + " " + lastNameValue;
    } */

})