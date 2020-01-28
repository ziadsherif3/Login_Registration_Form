<!DOCTYPE html>
<html lang = "en">
    <head>
        <title>
            Login
        </title>
        <link rel = "stylesheet" href = "loginstyle.css">
        <script>
            function valid(){

                var e = document.forms["logform"]["email"].value;
                var p = document.forms["logform"]["password"].value;
                
                if(e.length == 0 || p.length == 0){
                    alert("Can't proceed while some fields are empty.");
                    return false;
                }else if(!e.includes("@") || !e.includes(".com")){
                    alert("Invalid E-mail");
                    return false;
                }else if((e.indexOf(".com") == e.indexOf("@") + 1) || (e.indexOf(".") != e.length - 4)){
                    alert("Invalid E-mail");
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <div id = "mainarea">
            <form name = "logform" action = "#" onsubmit = "return valid();" method = "post">
                <label id = "el">
                    Email:
                </label>
                <input type = "text" name = "email">
                <label id = "pl">
                    Password:
                </label>
                <input type = "password" name = "password">
                <input id = "login" type = "submit" name = "login" value = "Login">
            </form>
        </div>
        <?php
            session_start();
            if(isset($_POST['login'])){
                $connect = mysqli_connect('localhost','root','', 'registration');
                if (mysqli_connect_errno()){
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
                $email = $_POST['email'];
                $pass= $_POST['password'];
                $query = mysqli_query($connect, "SELECT username FROM users WHERE email = '$email' and pass = '$pass'");
                if(mysqli_num_rows($query) == 0){
                    echo '<script language="javascript">';
                    echo 'alert("The e-mail or password is incorrect")';
                    echo '</script>';
                }else{
                    $val = mysqli_fetch_object($query);
                    $_SESSION['uname'] = $val->username;
                    header('location:welcome.php');
                }
                mysqli_close($connect);
            }
        ?>
    </body>
</html>