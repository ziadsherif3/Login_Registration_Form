<!DOCTYPE html>
<html lang = "en">
    <head>
        <title>
            Register
        </title>
        <link rel = "stylesheet" href = "regstyle.css">
        <script>
            function valid(){

                var u = document.forms["regform"]["username"].value;
                var e = document.forms["regform"]["email"].value;
                var p = document.forms["regform"]["password"].value;

                if(u.length == 0 || e.length == 0 || p.length == 0){
                    alert("Can't proceed while some fields are empty.");
                    return false;
                }else if(!e.includes("@") || !e.includes(".com")){
                    alert("Invalid E-mail");
                    return false;
                }else if((e.indexOf(".com") == e.indexOf("@") + 1) || (e.indexOf(".") != e.length - 4) || (e.indexOf("@") == 0) || (((e.match(/@/g) || []).length) > 1)){
                    alert("Invalid E-mail");
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <div id = "mainarea">
            <form name = "regform" action = "#" onsubmit = "return valid();" method = "post">
                <label id = "unl">
                    Username:
                </label>
                <input type = "text" name = "username">
                <label id = "el">
                    Email:
                </label>
                <input type = "text" name = "email">
                <label id = "pl">
                    Password:
                </label>
                <input type = "password" name = "password">
                <input id = "signup" type = "submit" name = "signup" value = "Sign up">
            </form>
        </div>
        <?php
            session_start();
            if(isset($_POST['signup'])){
                $connect = mysqli_connect('localhost','root','', 'registration');
                if (mysqli_connect_errno()){
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
                $name = $_POST['username'];
                $pass= $_POST['password'];
                $email = $_POST['email'];
                $query = mysqli_query($connect, "SELECT * FROM users WHERE email = '$email'");
                if(mysqli_num_rows($query) == 0){
                    $query = mysqli_query($connect, "INSERT INTO users (email, username, pass) VALUES ('$email', '$name', '$pass')");
                    $_SESSION['uname'] = $name;
                    header('location:welcome.php');
                }else{
                    echo '<script language="javascript">';
                    echo 'alert("A user with the same e-mail exists")';
                    echo '</script>';
                }
                mysqli_close($connect);
            }
        ?>
    </body>
</html>