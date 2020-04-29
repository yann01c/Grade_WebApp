// Sleep (Wait) function
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

// Prompt, send data to insert_class.php
function newClass() {
    var cprompt = prompt("Enter Classname:", "");
    String(cprompt);
    if(cprompt == "" || cprompt == null) {
        invalidClass();
    } else {
        var xhr = new XMLHttpRequest();
        
        // Response from insert_class.php
                xhr.onload = async function() {
            var serverResponse = document.getElementById("classadded");
            serverResponse.innerHTML = this.responseText;
            await sleep(3000);
            location.reload();
        }
        xhr.open("POST", "classes/insert_classes.php");
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("class=" + cprompt);
    }
}

// If prompt is empty | invalid
async function invalidClass() {
    var serverResponse = document.getElementById("classadded");
    serverResponse.innerHTML = "Invalid Classname!";
    await sleep(3000);
    location.reload();
}

// Change button text to selected class (Invisible when "-" is selected)
function cbtnAppear() {
    var cbutton = document.getElementById("c-btn");
    var dropdown = document.getElementById("c1-class").value;
    if(dropdown == "-") {
        cbutton.style.display = "none";
    } else {
        cbutton.innerHTML = "-> " + dropdown;
        cbutton.style.display = "flex";
    }
}

// Change button text to selected grade (Invisible when "-" is selected)
function cgradebtnAppear() {
    var classbtn = document.getElementById("class-btn");
    var cgradedropdown = document.getElementById("class-grades");
    if(classdropdown == "-") {
        classbtn.style.display = "none";
    } else {
        classbtn.innerHTML = "Go to " + clasdropdown;
        classbtn.style.display = "flex";
    }
}