var savebtn = document.getElementById("save-btn");
var editbtn = document.getElementById("edit-btn");
var cancelbtn = document.getElementById('cancel-btn');
var iuid = document.getElementById("i-uid");
var imail = document.getElementById("i-mail");
var sgroup = document.getElementById("s-group");

function edit() {
    savebtn.style.visibility = 'visible';
    cancelbtn.style.visibility = 'visible';
    editbtn.disabled = true;
    iuid.disabled = false;
    imail.disabled = false;
    sgroup.disabled = false;
}
function cancel() {
    savebtn.style.visibility = 'hidden';
    cancelbtn.style.visibility = 'hidden';
    editbtn.disabled = false;
    iuid.disabled = true;
    imail.disabled = true;
    sgroup.disabled = true;
    location.reload();
}