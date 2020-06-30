var savebtn = document.getElementById("save-btn");
var editbtn = document.getElementById("edit-btn");
var cancelbtn = document.getElementById('cancel-btn');
var iuid = document.getElementById("i-uid");
var imail = document.getElementById("i-mail");
var sgroup = document.getElementById("s-group");

function Sleep(milliseconds) {
    return new Promise(resolve => setTimeout(resolve, milliseconds));
 }

function edit() {
    savebtn.style.visibility = 'visible';
    cancelbtn.style.visibility = 'visible';
    iuid.style.backgroundColor = 'rgba(255, 255, 255, 0.1)';
    imail.style.backgroundColor = 'rgba(255, 255, 255, 0.1)';
    //sgroup.style.backgroundColor = 'rgba(255, 255, 255, 0.1)';
    editbtn.disabled = true;
    sgroup.disabled = true;
    iuid.disabled = false;
    imail.disabled = false;
}
async function cancel() {
    savebtn.style.visibility = 'hidden';
    cancelbtn.style.visibility = 'hidden';
    iuid.style.backgroundColor = 'rgba(255, 255, 255, 0.3)';
    imail.style.backgroundColor = 'rgba(255, 255, 255, 0.3)';
    sgroup.style.backgroundColor = 'rgba(255, 255, 255, 0.3)';
    editbtn.disabled = false;
    iuid.disabled = true;
    imail.disabled = true;
    sgroup.disabled = true;
    await Sleep(500);
    location.reload();
}