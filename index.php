<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Log In to PCCS Traffic System">
        <meta name="keywords" content="HTML,CSS,JavaScript">
        <meta name="author" content="PCCS">
        <meta name = "viewport" content = "width=device-width, initial scale=1.0">
        <link rel = "stylesheet" href = "Styles/LogInStyle.css">
        <script src="https://kit.fontawesome.com/35acfd843f.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Baloo+2:500&display=swap" rel="stylesheet">
        <script type = "text/javascript" src="js/LogIn.js"></script>
        <title>Log in page</title>
    </head>

    <body>

        <img class = "background" src = "Sources/watercolor.jpg">
        <div class = "container">
            <div class = "img">
                <img src = "Sources/personalization.svg">
            </div>
            <div class = "login-container">
                <form method="POST">

                    <img class = "avatar" src = "Sources/profile_avatar.svg">
                    <h2>Welcome</h2>

                    <div class = "input-div one focus">
                        <div class = "i">
                            <i class = "fas fa-user"></i>
                        </div>
                        <div>
                            <!--h5>UserID</h5-->
                            <input class = "input" type = "text" name="user" placeholder="User ID">
                        </div>
                    </div>

                    <div class = "input-div two focus">
                        <div class = "i">
                            <i class = "fas fa-lock"></i>
                        </div>
                        <div>
                            <!--h5>Password</h5-->
                            <input class = "input" type = "password" name="pass" placeholder="Password" id = "myPassword">
                        </div>
                        <div class = "i-eye">
                            <input type="checkbox" onclick="showPassword()">
                            <i class="far fa-eye"></i>
                        </div>
                    </div>
                    <a href = "#">Forgot Password?</a>

                    <div class="usertype">
                        Select user type: <select name="type">
                            <option value="customer">Customer</option>
                            <option value="traffic officer">Traffic Officer</option>
                            <option value="oic">OIC</option>
                            <option value="payment officer">Payment Officer</option>
                        </select>
                    </div>
                    <input type ="submit" class = "btn" name="submit" value = "Login"> 
                </form>
            </div>
        </div>
        <script type = "text/javascript" src = "js/LogIn.js"></script>
    </body>
</html>

<?php

$con = mysqli_connect("localhost","root","");
if(!$con)
{
    echo"Unable to establish connection ".mysqli_error($con);
}
    $db=mysqli_select_db($con,"pccs");
if(!$db)
{
    echo"Database not found ".mysqli_error($con);
}

if(isset($_POST['submit'])){
    $type=$_POST['type'];
    $username=$_POST['user'];
    $password=$_POST['pass'];

    $query="select * from login where id='$username' and password='$password' and usertype='$type'";
    $result=mysqli_query($con,$query);

    while($row=mysqli_fetch_array($result)){
        if($row['id']==$username && $row['password']=$password && $row['usertype']=='Traffic Officer'){
            header("Location: trafficofficer.html");
        }
        elseif($row['id']==$username && $row['password']=$password && $row['usertype']=='Customer'){
            header("Location: customer.html");
        }
        elseif($row['id']==$username && $row['password']=$password && $row['usertype']=='OIC'){
            header("Location: oic.html");
        }
        elseif($row['id']==$username && $row['password']=$password && $row['usertype']=='Payment Officer'){
            header("Location: paymentofficer.html");
        }
    }
}

?>
