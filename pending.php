<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/account.css">
</head>
<body id="pending">
    <div class="outer">
    <div style="z-index: -1000;width: 100%;position:absolute;display:flex;justify-content: center;height:68vh;"><svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg></div>
    <div style="z-index: -1000;width: 100%;position:absolute;display:flex;justify-content: center;height:20vh;"><h1>Mail sent to</h1></div>
        <div class="inner">
            <div>
                <div>
                    <p style="margin-top:0;width:100%;display:flex;justify-content:center;color: black;font-size:1.3em;font-family: 'Maven Pro', sans-serif;"><?php echo $_GET['email']; ?></p>
                </div>
                <div class="pending"></div>
                <input id="pending-bck" type="button" onclick="location.href='account.php'" value="Home">
            </div>
        </div>
    </div>
</body>
</html>