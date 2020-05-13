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
    tr = document.getElementById(id);
    tdclass = ".td"+id;
    td = document.querySelectorAll("td"+"."+tdclass);
    td.style.display = (td.style.display == "block") ? "none" : "block";
    td.style.position = (td.style.position == "relative") ? "absolute" : "relative";
}