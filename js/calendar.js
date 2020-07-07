function AddEvent() {
    var eprompt = prompt("Enter Eventname:", "");
    String(eprompt);

    var newDiv = document.createElement("div");
    var newContent = document.createTextNode(eprompt);
    newDiv.appendChild(newContent);

    var calendar = document.getElementById("events");
    calendar.appendChild(newDiv);
}