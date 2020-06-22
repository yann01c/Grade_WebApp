// class.php Open and maximize image
function zoom(id) {

    // Input field id (upload in value)
    inputid = "path"+id;
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
    download.setAttribute('id','id-download');
    download.setAttribute('download',"IMAGE"+id+".jpg");
    download.textContent = '☇';
    div.appendChild(download);
    window.close();
}

// class.php Close image
function unzoom() {

    download = document.getElementById("id-download");
    download.remove();    

    // Get container
    absolute = document.getElementById("absolutecenter");
    // Hide container
    absolute.style.display = "none";

}