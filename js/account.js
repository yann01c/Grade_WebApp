// Change button text to selected group (Invisible when "-" is selected)
function registerBtn() {
    var registerbtn = document.getElementById("r-btn");
    var registerdropdown = document.getElementById("r-group");
    if(registerdropdown == "-") {
        registerbtn.style.display = "none";
    } else {
        registerbtn.innerHTML = "Register as " + registerdropdown;
        registerbtn.style.display = "flex";
    }
}