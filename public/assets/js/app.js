// DOM element
let addButton = document.getElementById('add-button');
let newInputsContainer = document.querySelector('.new-inputs-container');
let templateNode = document.querySelector('.template-node');
let submitButton = document.querySelector('.submit-btn');
let firstNameInput = document.getElementById('first-name-input');
let lastNameInput = document.getElementById('last-name-input');
let firstNameError = document.getElementById('first-name-error');
let inputs = document.getElementsByClassName('form-control');
let alertBox = document.getElementById('alert-box');
let inputsContainer = document.getElementsByClassName('inputs-container');
let inputsContainerLast = document.querySelector('.inputs-container-last');
let deleteButtons = document.getElementsByClassName('delete-btn');

function countInputIndex(number) {
    // on crée une collection de tous les inputs-container
    // on compte le nombre de inputs-container existant
    let countInputsContainer = document.getElementsByClassName('inputs-container').length - number;
    // console.log(countInputsContainer);
    return countInputsContainer;
};

//Listener on addButton
addButton.addEventListener("click", e => {

    // Add to DOM
    // When add clicked insert a new input line
    function insertInputsContainer() {

        let template = document.getElementById('template');
        let clonedTemplate = template.content.cloneNode(true);
        templateNode.appendChild(clonedTemplate);
    }

    // When new line inserted set Input name for form to work with $_POST request
    function setInputName() {

        let countActualIndex = countInputIndex(0);
        console.log('from setInputName count is ' + countActualIndex);

        // set attribute name a firstName{countActualIndex} & lastName{countActualIndex} .
        document.getElementById('first-name-input-last').setAttribute('name', 'firstName' + countActualIndex);
        document.getElementById('last-name-input-last').setAttribute('name', 'lastName' + countActualIndex);

        // Modifier l'id pour le passer de first-name-input-last & last-name-input-last => first-name-input & last-name-input
        document.getElementById('first-name-input-last').id = 'first-name-input-' + countActualIndex;
        document.getElementById('last-name-input-last').id = 'last-name-input-' + countActualIndex;
    }

    // When new line inserted add an indexed id to inputs-container and delete btn
    function setInputsContainerId() {

        let countActualIndex = countInputIndex(0);
        console.log('from setInputsContainer count is ' + countActualIndex);

        // creating an id for the container. id = inputs-container-list{countActualIndex}
        document.querySelector('.inputs-container-last').setAttribute('id', 'inputs-container-' + countActualIndex);
                
        // modifying container class
        document.querySelector('.inputs-container-last').classList.replace('inputs-container-last', 'inputs-container');

        // modifying delete-btn id = delete-btn-{countActualIndex}
        document.getElementById('delete-btn').setAttribute('id', 'delete-btn-' + countActualIndex);

    }

    // When adding a new line previous line delete button is removed
    function removeDeleteButton() {
        // target previous line
        let inputIndexToRemove = countInputIndex(1);
        console.log('delete button to remove is ' + inputIndexToRemove);
        let deleteButtonToRemove = document.getElementById('delete-btn-' + inputIndexToRemove);
        
        // if there are at least 2 existing input => remove the targeted line
        if (deleteButtonToRemove != null) {
            
            deleteButtonToRemove.remove();

        }
    }

    
    removeDeleteButton();
    insertInputsContainer();
    setInputName();
    setInputsContainerId();
    deleteFields();


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
            let regex = /^[A-Za-z0-9À-ú.-]+$/
    
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
            
            console.log("less than 1 participant");

            // prevent default form
            e.preventDefault();
     
            // and add message to the alertBox
            alertBox.innerHTML = "For the magic to happen you need more than one participant !!";
            
        }
    }


    checkInputsValue();
    isMoreThanOne();

})


// function
function deleteFields() {

    for (let deleteButton of deleteButtons) {

        
        deleteButton.addEventListener('click', e => {

            console.log('delete button id = ' + deleteButton.id);

            // recuperer l'id du delete button sur lequel on à cliqué
            let clickedDeleteButtonId =  deleteButton.id;
            let clickedDeleteButtonIndex = clickedDeleteButtonId.slice(-1);
            console.log('id to delete' + clickedDeleteButtonIndex);

            // delete le container correspondant à l'id du delete-btn
            let deleteInputContainer = document.getElementById('inputs-container-' + clickedDeleteButtonIndex);
            deleteInputContainer.remove();
        });
    }
}


