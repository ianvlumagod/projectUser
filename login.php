
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <h1>LOGIN</h1>
    <p>Please fill in your credentials to login.</p>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <label for="username">Username</label>
        <input type="text" name="username">
        <br>
        <label for="password">Password</label>
        <input type="password" name="password">
        <br>
        <input type="submit" value="submit">
        <br>
        <p>Don't have an account? <a href="signup.php">Sign up now</a>.</p>
    </form>
</body>
</html>
<?php
require_once('config.php');

$username = "";
$pasword = "";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT username, password FROM user WHERE username = ?";

    if($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $param_username);

        $param_username = trim($username);
        
        if(mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $use, $pass);
                if(mysqli_stmt_fetch($stmt)) {
                
                    if(trim($password) == $pass) {
                        echo "SUCCESS";
                        header("location: index.html");
                    }
                    else {
                        echo "INCORRECT PASSWORD";
                    }
                }
            }
            else {
                echo "INVALID USERNAME";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>