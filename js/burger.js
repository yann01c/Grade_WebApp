function burger(b) {
    var check;
    x = document.getElementById("wall");
    link = document.querySelectorAll(".burger-link");

    x.style.width = (x.style.width == "75%") ? "0" : "75%";

    b.classList.toggle("change");

    for (i=0; i < link.length; i++) {
        link[i].style.opacity = (link[i].style.opacity == "1") ? "0" : "1";
        link[i].style.cursor = (link[i].style.cursor == "pointer") ? "default" : "pointer";
        link[i].style.pointerEvents = (link[i].style.pointerEvents == "auto") ? "none" : "auto";
    }
}
