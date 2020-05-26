// class.php Open and maximize image
function zoom(id) {

    // Input field id (upload in value)
    inputid = "imginput"+id;
    // Get value from input (upload/...)
    imginput = document.getElementById(inputid).value;
    // Get absolute div (container)
    absolute = document.getElementById("absolutecenter");
    // URL for background-image tag
    imgurl = "url('" + imginput + "')";
    // Change background-image tag for absolute div
    absolute.style.backgroundImage = imgurl;
    // Display absolut div
    absolute.style.display = "flex";

    var download = document.createElement("a");
    var div = document.getElementById("download");
    download.setAttribute('href',imginput);
    download.setAttribute('class','a-download');
    download.setAttribute('download',"IMAGE"+id)
    download.textContent = 'DOWNLOAD';
    div.appendChild(download);
}

// class.php Close image
function unzoom() {
    var x, i;
    x = document.querySelectorAll("a-download");

    for (i = 0; i < x.length; i++) { 
        x[i].style.display = "none";
    }

    

    // Get container
    absolute = document.getElementById("absolutecenter");
    // Hide container
    absolute.style.display = "none";

}

// class.php Collapse tables
function collapse(id) {
    // Unique class
    tdclass = ".td"+id;
    // Select table
    td = document.getElementById(id);
    // Init vars
    var x, i;
    // Select rows
    x = document.querySelectorAll(tdclass);

    // For loop for arrays ([0],[1],...)
    for (i = 0; i < x.length; i++) {
        x[i].style.display = (x[i].style.display == "block") ? "none" : "block";
        x[i].style.position = (x[i].style.position == "relative") ? "absolute" : "relative";
    }

}

// classes.php Submit onclick
function submit(id) {

    tr = document.getElementById(id);
    formid = "form"+id;
    form = document.getElementById(formid);
    form.submit();
    
}