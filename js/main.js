let sel = document.getElementById('c1-class');
sel.addEventListener ("change", function () {
    var cbtn = document.getElementById("c-btn");
    cbtn.innerHTML = "Go to " + this.value;
    cbtn.style.display = "flex";
    if (sel.value == "English") {
        cbtn = cbtn.href = "class.php";
    }
});

let cadd = document.getElementById("c-add");

cadd.addEventListener("click", function () {
    var cprompt = prompt("Please enter Class Name:");   
    if (cprompt != "") {
        var op1 = document.createElement("option");
        op1.value = cprompt;
        op1.innerHTML = cprompt;
        sel.appendChild(op1);    
    }
    else {
        alert("INVALID");
    }
});

//let body = document.getElementById("classes");
//body.addEventListener("click", function () {
//    body.style.color = "red";
//});