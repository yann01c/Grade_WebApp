function light() {
    var btn = document.getElementById("dl-btn");

    var cont = document.getElementById("gallery");
    var cont2 = document.getElementById("gallery_cont");

    cont2.style.backgroundColor = (cont2.style.backgroundColor == "white") ? "#2E3333" : "white";
    cont.style.backgroundColor = (cont.style.backgroundColor == "white") ? "#2E3333" : "white";
    btn.firstChild.data = (btn.firstChild.data == "DARK") ? "LIGHT" : "DARK";


}