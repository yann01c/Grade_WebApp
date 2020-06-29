// Prompt, send data to insert_class.php
function newClass() {
    var cprompt = prompt("Enter Classname:", "");
    String(cprompt);
    if(cprompt == "" || cprompt == null) {
        invalidClass();
    } else {
        var xhr = new XMLHttpRequest();
        
        // Response from insert_class.php
        xhr.onload = function() {
            var serverResponse = document.getElementById("classadded");
            //serverResponse.innerHTML = this.responseText;
            alert(this.responseText);
            location.reload();
        }
        xhr.open("POST", "classes/insert_classes.php");
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("class=" + cprompt);
    }
}

// If prompt is empty | invalid
function invalidClass() {
    var serverResponse = document.getElementById("classadded");
    //serverResponse.innerHTML = "Invalid Classname!";
    alert("Invalid Classname!");
    location.reload();
}