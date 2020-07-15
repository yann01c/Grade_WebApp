function burger(b) {
    x = document.getElementById("wall");
    link = document.querySelectorAll(".burger-link");

    x.style.width = (x.style.width == "50%") ? "0" : "50%";

    b.classList.toggle("change");

    for (i=0; i < link.length; i++) {
        // link[i].style.display = (link[i].style.display == "flex") ? "none" : "flex";
        link[i].style.opacity = (link[i].style.opacity == "1") ? "0" : "1";
    }   
}