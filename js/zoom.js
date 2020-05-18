function zoom(id) {
    imgdiv = document.getElementById("imgdiv");
    imgstaticdiv = document.getElementById("imgstaticdiv");
    img = document.getElementById(id);
    imgdiv.appendChild(img);
    //img.style.position = (img.style.position == "absolute") ? "relative" : "absolute";
    img.style.width = (img.style.width == "400px") ? "10px" : "400px";
    img.style.height = (img.style.height == "400px") ? "10px" : "400px";
    //img.style.left = (img.style.left == "750px") ? "0px" : "750px";
    //img.style.bottom = (img.style.bottom == "300px") ? "0px" : "300px";
}
function collapse(id) {
    tdclass = ".td"+id;
    td = document.getElementById(id);
    var x, i;
    x = document.querySelectorAll(tdclass);
    for (i = 0; i < x.length; i++) {
        x[i].style.display = (x[i].style.display == "block") ? "none" : "block";
        x[i].style.position = (x[i].style.position == "relative") ? "absolute" : "relative";
    }
}

function submit(id) {
    tr = document.getElementById(id);
    formid = "form"+id;
    form = document.getElementById(formid);
    form.submit();
}