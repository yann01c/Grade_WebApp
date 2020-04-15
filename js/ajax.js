
function myAjax () {
    $.ajax({
        method: "POST",
        url: "sqlite/submit.php",
        success:function(html){
            alert(html);
        }
    });
}