function zoom(id) {
    img = document.getElementById(id);
    img.style.position = (img.style.position == "absolute") ? "relative" : "absolute";
    img.style.width = (img.style.width == "400px") ? "10px" : "400px";
    img.style.height = (img.style.height == "400px") ? "10px" : "400px";
    img.style.left = (img.style.left == "750px") ? "0px" : "750px";
    img.style.bottom = (img.style.bottom == "300px") ? "0px" : "300px";
}