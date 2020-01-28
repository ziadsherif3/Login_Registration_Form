<!DOCTYPE html>
<html lang = "en">
    <head>
        <title>
            Welcome!
        </title>
        <link rel = "stylesheet" href = "welstyle.css">
        <script>
        </script>
    </head>
    <body>
        <h1>
            Welcome!
        </h1>
        <?php
        session_start();
        echo $_SESSION['uname'];
        ?>
    </body>
</html>