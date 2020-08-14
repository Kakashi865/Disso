
// A flag for when the user has started the quiz or not
var hasStarted = false
// A flag for when the user has finished the quiz or not
var hasFinished = false

// This variable is for the curent position in which we are in the array.
var currentPictureIndex = 0

// This variable is for storing the answers that the user provides to us, which we can then send to the backend system, 
// which will store it in the database.
var answers = {};

// Here we are waiting for the browser to load the page, and once its finished loading to call this function which we give it.
window.onload = function () {
    // These next few lines are getting the elements on the page by reference so we can perform actions as well as setting listeners.
    const startButton = document.getElementById("startButton")
    const nextButton = document.getElementById("nextButton")
    const submitButton = document.getElementById("submitButton")
    const ratingSlider = document.getElementById("ratingSlider")

    // Setting an on click listener to the start button so we can tell the web page to update.
    startButton.onclick = function () {
        // Updating that flag so we can change the web page
        hasStarted = true
        setupWebpage()

        showRandomImage()
        startDelayedHide()
    }

    // Setting an on click listener to goto the next image in the set
    nextButton.onclick = function () {
        // here we are grabbing the current image id from the list of images.
        var id = list[currentPictureIndex].id
        // here we get the rating value 
        answers[id] = parseInt(ratingSlider.value)

        // Increase the index so move onto the next image.
        currentPictureIndex++

        showRandomImage()
        startDelayedHide()

        // Here we check if it is the last image then set the flag to update the web page.
        if (!(currentPictureIndex < (list.length - 1))) {
            hasFinished = true
            setupWebpage()
        }
    }

    // Setting an on click to submit the answers created by the users.
    submitButton.onclick = function () {
        // here we are grabbing the current image id from the list of images.
        var id = list[currentPictureIndex].id
        // here we get the rating value 
        answers[id] = parseInt(ratingSlider.value)

        // Once the user has completed the test, show a message telling them.
        alert("Well Done", "You have completed the test");

        // If it isn't a practice, then send the answers to the backend system.
        if (!isPractice) {
            sendAnswersToBackend()
        }
    }
}

// This function makes an API (Application Programming Interface) request to send the data to the backend, using the data collected.
function sendAnswersToBackend() {
    // Creating an instance of a HTTP Request
    var httpRequest = new XMLHttpRequest()

    // Create an POST request, with a API endpoint, which we can send our data to.
    httpRequest.open("POST", "api/images_submission.php", true);

    // Telling the request object what type of data we are sending so the api knows what to expect
    httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Grab the keys of the answers object.
    const keys = Object.keys(answers);
    // Grab the value of the answers object.
    const values = Object.values(answers);

    // Grabbing the name the user has submitted
    const nameInput = document.getElementById("nameInput").value

    // Getting the current test speed as a string
    var stringSpeed = speed.toString();

    // Create a variable with all the data collected as a string sepeated with &
    var output = "speed=" + stringSpeed + "&name=" + nameInput + "&";

    // Looping through the ids of each of the images, grabbing the actual value from the values array
    keys.forEach(function (key, index) {
        const answer = values[index];

        // For each answer adding the key value to the output string.
        output += "answers[" + key + "]=" + answer + "&";
    });

    // Finish off with sending the string with the API request.
    httpRequest.send(output);
}

// This is our web page state refresher, which looks at the current state from flags at the top of the screen,
// and changes the output of the web page.
function setupWebpage() {
    // These next few lines are getting the elements on the page by reference so we can change the whether or not they are showing.
    const startButton = document.getElementById("startButton")
    const sliderContainer = document.getElementById("sliderContainer")

    const nextButton = document.getElementById("nextButton")
    const submitButton = document.getElementById("submitButton")
    const nameInputContainer = document.getElementById("nameInputContainer")
    
    // Checking if the user has clicked the start button
    if (hasStarted) {
        addClassToElement(startButton, "gone")
        removeClassFromElement(sliderContainer, "gone")
    } else {
        removeClassFromElement(startButton, "gone")
        addClassToElement(sliderContainer, "gone")
    }

    // Checking if the user has gotten to the end of the quiz
    if (hasFinished) {
        addClassToElement(nextButton, "gone")
        removeClassFromElement(submitButton, "gone")
        removeClassFromElement(nameInputContainer, "gone")
    } else {
        removeClassFromElement(nextButton, "gone")
        addClassToElement(submitButton, "gone")
        addClassToElement(nameInputContainer, "gone")
    }
}

// shows the image next in line to be shown.
function showRandomImage() {

    const imageObj = list[currentPictureIndex]
    console.log(imageObj)

    const id = imageObj.id

    // Grab the image container for the web page.
    const flashingImage = document.getElementById("flashingImage"+id)
    
    // Scrolling the user to the top of the page so they can see the image popup.
    window.scrollTo(0, 0)
    removeClassFromElement(flashingImage, "gone")
}

// This function hides the image from the user after the allotted amount of time
function startDelayedHide() {

    const imageObj = list[currentPictureIndex]
    console.log(imageObj)

    const id = imageObj.id
    console.log(id)

    // Grab the image container
    const flashingImage = document.getElementById("flashingImage"+id)

    // Function to wait a certain amount of milliseconds before executing the anonymous function
    setTimeout(function () {
        // Remove the style from the image container
        addClassToElement(flashingImage, "gone")
    }, speed)
}

// This function takes in an element on the screen and adds the class provided to it, if it doesn't exist already.
function addClassToElement(element, className) {
    // Grab the class attribute from the element given.
    var classes = element.getAttribute("class")

    // Check if the classes of the element is empty.
    if (classes == null) {
        // If so set the classes to an empty string.
        classes = ""
    }

    // Checks if class name is not inside of the classes of the element given.
    if (!classes.includes(className)) {
        // Here we concatenate the classes from the element and the class we want to add
        const newClasses = classes + " " + className
        // Then we set the class attribute to the new classes we want to add to it.
        element.setAttribute("class", newClasses)
    }
}

// This function takes in an element on the screen and removes the class provided from it, if it does exist.
function removeClassFromElement(element, className) {
    // Grab the class attribute from the element given.
    const classes = element.getAttribute("class")

    // Checks if class name is inside of the classes of the element given.
    if (classes != null && classes.includes(className)) {
        // Removing the given class name from the classes already on the element.
        const newClasses = classes.replace(className, "")

        // Then add the new classes which shouldn't have the class name on it, to the element.
        element.setAttribute("class", newClasses)
    }
}