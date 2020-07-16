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
function droptop(a) {
    var i;
    var x = document.getElementById("top-wall");
    var arrow = document.getElementById("top-arrow");
    var link = document.querySelectorAll(".top-a");
    var element = document.querySelectorAll(".top-element");
    var h = "50vh";
    var check = 0;

    // a.classList.toggle("top-change");

    arrow.style.transform = (arrow.style.transform == "rotate(180deg)") ? "rotate(0deg)" : "rotate(180deg)";
    x.style.height = (x.style.height == h) ? "0" : h;

    for (i=0; i < link.length;i++) {
        link[i].style.opacity = (link[i].style.opacity == "1") ? "0" : "1";
    }

    if (x.style.height == "0px") {
        for (i=0; i < element.length;i++) {
            element[i].style.display == "none";
        } 
    } else {
        for (i=0; i < element.length;i++) {
            element[i].style.display == "flex";
        }
    }

    // if (check == 0) {
    //     for (i=0; i < link.length; i++) {
    //         link[i].style.display == "none";
    //     }
    // } else {
    //     alert(11);
    //     for (i=0; i < link.length; i++) {
    //         alert(111);
    //         link[i].style.display == "flex";
    //         link[i].style.color == "red";
    //     }
    // }
}