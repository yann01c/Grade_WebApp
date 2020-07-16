function Sleep(milliseconds) {
    return new Promise(resolve => setTimeout(resolve, milliseconds));
}

async function burger(b) {
    var check;
    x = document.getElementById("wall");
    link = document.querySelectorAll(".burger-link");

    x.style.width = (x.style.width == "75%") ? "0" : "75%";

    if (x.style.width == "75%") {
        check = 1;
    } else {
        check = 0;
    }

    b.classList.toggle("change");

    for (i=0; i < link.length; i++) {
        link[i].style.opacity = (link[i].style.opacity == "1") ? "0" : "1";
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