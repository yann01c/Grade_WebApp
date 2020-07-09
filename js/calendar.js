function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
 }

function hideshow() {
    var form = document.getElementById("eform");
    var btn = document.getElementById("e-btn");
    var back = document.getElementById("e-back");
    var addbtn = document.getElementById("e-add");
    var reminder = document.getElementById("reminder");
    var submission = document.getElementById("e-sub");

    submission.style.height = (submission.style.height == "0em") ? "40em" : "0em";
    btn.firstChild.data = (btn.firstChild.data == "Show") ? "Hide" : "Show";
    back.style.top = (back.style.top == "0em") ? "no" : "0em";

    setTimeout(3000);
    form.style.display = (form.style.display == "none") ? "block" : "none";


}