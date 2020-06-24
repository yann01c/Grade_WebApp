function dropdown() {
    content = document.getElementById("myDropdown");
    btn = document.getElementById("drpbtn");
    arrow = document.getElementById("arrow");
    content.style.display = (content.style.display == "block") ? "none" : "block";
    arrow.style.transform = (arrow.style.transform == "rotate(90deg)") ? "rotate(0deg)" : "rotate(90deg)";
}