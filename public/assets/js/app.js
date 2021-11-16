// DOM element
let addButton = document.getElementById('add-button');
let newInputsContainer = document.querySelector('.new-inputs-container');
let templateNode = document.querySelector('.template-node');
let countAddButtonClicks = 0;
let submitButton = document.querySelector('.submit-btn');
let firstNameInput = document.getElementById('first-name-input');
let lastNameInput = document.getElementById('last-name-input');
let firstNameError = document.getElementById('first-name-error');
let inputs = document.getElementsByClassName('form-control');
let alertBox = document.getElementById('alert-box');
let inputsContainer = document.getElementsByClassName('inputs-container');


//Listener on addButton
addButton.addEventListener("click", e => {

    // Count nb of clicks on add button
    countAddButtonClicks += 1;
    console.log(countAddButtonClicks);

    // Add to DOM
    // When add clicked insert a new input line
    function insertInputsContainer() {

        let template = document.getElementById('template');
        let clonedTemplate = template.content.cloneNode(true);
        templateNode.appendChild(clonedTemplate);
    }

    // When new line inserted set Input name for form to work with $_POST request
    function setInputName() {

        // set attribute name a firstName{countAddButtonClicks} & lastName{countAddButtonClicks} .
        document.getElementById('first-name-input-last').setAttribute('name', 'firstName' + countAddButtonClicks);
        document.getElementById('last-name-input-last').setAttribute('name', 'lastName' + countAddButtonClicks);

        // Modifier l'id pour le passer de first-name-input-last & last-name-input-last => first-name-input & last-name-input
        document.getElementById('first-name-input-last').id = 'first-name-input-' + countAddButtonClicks;
        document.getElementById('last-name-input-last').id = 'last-name-input-' + countAddButtonClicks;
    }


    insertInputsContainer();
    setInputName();


})

// Listener on SubmitButton
submitButton.addEventListener('click', e => {

    /**
     * Check if inputs value are strings, number or - and not empty
     */
    function checkInputsValue() {
        
        // check all input elements with form-control class
        for (let input of inputs) {
    
            // Trim all the inputs
            let inputValueTrim = input.value.trim();
    
            // regex checking the input is md only of letters digit and hyphen
            let regex = /^[A-Za-z0-9.-]+$/
    
            // if they have no value
            if (!inputValueTrim || inputValueTrim.length < 2 || !inputValueTrim.match(regex)) {
    
                // prevent form submission
                e.preventDefault();
    
                // and add is-invalid class + change placeholder message
                input.classList.add('is-invalid');
                input.setAttribute('placeholder', 'Enter a valid first name and last name');
    
                // and display message in alertbox
                alertBox.innerHTML = 'Value must be letters, numbers or - (hyphen) and cannot be null';
    
    
            } else {
                // if value is ok remove class is-invalid
                input.classList.remove('is-invalid');
    
                // and undisplay message in alertbox
                alertBox.innerHTML = '';
            }
        }
    }

    /**
     * ! UNUSED check if the number of participants are even
     */
    function isEven() {
        
        // check participants are even and not odd
        // check how many inputs-container class inputs we have
        let inputsContainerLength = inputsContainer.length;
        
    
        // if it's odd
        if (inputsContainerLength % 2 != 0 ) {
            
            console.log("it's odd");

            // prevent default form
            e.preventDefault();
     
            // and add message to the alertBox
            alertBox.innerHTML = "For the magic to happen participants must be even !!";
            
        }
    }

    /**
     * check if there is at least two participants
     */
     function isMoreThanOne() {
        
        // check participants are even and not odd
        // check how many inputs-container class inputs we have
        let inputsContainerLength = inputsContainer.length;
        
    
        // if it's odd
        if (inputsContainerLength <= 1 ) {
            
            console.log("more than 1 participant");

            // prevent default form
            e.preventDefault();
     
            // and add message to the alertBox
            alertBox.innerHTML = "For the magic to happen you need more than one participant !!";
            
        }
    }


    checkInputsValue();
    isMoreThanOne();

})