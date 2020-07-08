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
    var reminder = document.getElementById("reminder");
    var submission = document.getElementById("e-sub");
    // submission.style.height = "2em";
    // submission.style.backgroundColor = "white";

    form.style.position = (form.style.position == "absolute") ? "relative" : "absolute";
    form.style.zIndex = (form.style.zIndex == "-1") ? "10" : "-1";
    submission.style.height = (submission.style.height == "2em") ? "30em" : "2em";
    submission.style.backgroundColor = (submission.style.backgroundColor == "white") ? "black" : "white";
    reminder.style.color = (reminder.style.color == "white") ? "black" : "white";
    btn.firstChild.data = (btn.firstChild.data == "Show") ? "Hide" : "Show"; 

}