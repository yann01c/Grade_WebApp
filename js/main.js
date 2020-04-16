
var newclassname = document.getElementById("newclass").value;
if (newclassname !== "") {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "http://localhost/grade_webapp/sqlite/insert_class.php");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("class=",newclassname);
    xhr.onreadystatechange = function() { // Call a function when the state changes.
        const serverResponse = document.getElementById("classadded");
        serverResponse.innerHTML = "Success!";
    }
} else {
    invalidClass();
}

function invalidClass() {
    const serverResponse = document.getElementById("classadded");
    serverResponse.innerHTML = "Invalid Classname!";
}
//xhr.onload = function() {
//    const serverResponse = document.getElementById("classadded");
//    serverResponse.innerHTML = this.responseText;
//}