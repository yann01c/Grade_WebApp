function AddEvent() {
    var eprompt = prompt("Enter Eventname:", "");
    String(eprompt);

    var newDiv = document.createElement("div");
    var newContent = document.createTextNode(eprompt);
    newDiv.appendChild(newContent);

    var calendar = document.getElementById("events");
    calendar.appendChild(newDiv);
}

function hideshow() {
    var form = document.getElementById("form");
    var btn = document.getElementById("e-btn");
    var back = document.getElementById("e-back");
    var addbtn = document.getElementById("e-add");
    var reminder = document.getElementById("reminder");
    var submission = document.getElementById("e-sub");

    submission.style.height = (submission.style.height == "0em") ? "30em" : "0em";
    btn.firstChild.data = (btn.firstChild.data == "Show") ? "Hide" : "Show";
    back.style.top = (back.style.top == "0em") ? "no" : "0em";


}