// DOM element
let addButton = document.getElementById('add-button');
let newInputsContainer = document.querySelector('.new-inputs-container');
let templateNode = document.querySelector('.template-node');
let countAddButtonClicks = 0;

//Listener
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

    // When new line inserted set Input name for form to work
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