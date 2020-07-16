function burger(b) {
    var check;
    var y = window.matchMedia("(max-width: 520px)");
    var x = document.getElementById("wall");
    var link = document.querySelectorAll(".burger-link");
    var w = "";

    if (y.matches) {
        w = "75%";
    } else {
        w = "25%";
    }

    x.style.width = (x.style.width == w) ? "0" : w;

    if (x.style.width == w) {
        check = 1;
    } else {
        check = 0;
    }

    b.classList.toggle("change");

    for (i=0; i < link.length; i++) {
        link[i].style.opacity = (link[i].style.opacity == "1") ? "0" : "1";
        // link[i].style.position = (link[i].style.position == "relative") ? "absolute" : "relative";
    }

    if (check == 0) {
        for (i=0; i < link.length; i++) {
            link[i].style.display == "none";
        }
    } else {
        for (i=0; i < link.length; i++) {
            link[i].style.display == "flex";
        }
    }
}

