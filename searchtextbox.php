
<html>
<head>
<title> Welcome </title>
    <style>
        body{
            background-color: whitesmoke;
        }
        input{
            width: 40%;
            height: 5%;
            border: 1px;
            border-radius: 05px;
            padding: 8px 15px 8px 15px;
            margin: 10px 0px 15px 0px;
            box-shadow: 1px 1px 2px 1px grey;
        }
    </style>
</head>
<body>
    <center>
        <h1>Search data into textbox and update using php</h1>
            <form action="" method="post" style="background-color: lightblue">

                <input type="text" name="id" placeholder="Enter id value for search"/><br/>
                <input type="submit" name="search" value="Search Data"/>
            </form>
        <?php
        session_start();
        $connection = mysqli_connect("localhost","root","");
        $db = mysqli_select_db($connection,"pccs");

        if (isset($_POST['search'])){
            #$id = $_POST['id'];
            $_SESSION['id']=$_POST['id'];
            $query = "select * from customer where customer_id='".$_SESSION['id']."' ";
            $query_run = mysqli_query($connection,$query);
            while ($row = mysqli_fetch_array($query_run)){
                ?>
                <form action="" method="post">

                    <?php
                    echo "Name: ", $row['customer_name']; echo"<br>";
                    echo "Address: ",$row['address']; echo"<br>";

                    ?>

                    <input type="submit" name="imposefine" value="Impose Fine">
                    <input type="submit" name="viewhistory" value="View History">
                </form>
                <?php
            }
        }

        ?>

    </center>
</body>
</html>

<?php

$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection,"pccs");

if(isset($_POST['imposefine'])){
    $query = "select * from customer where customer_id='".$_SESSION['id']."' ";
    $query_run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_array($query_run)){
        ?>
        <form action="" method="post">
            Fine: <input type="text" name="fine" value="<?php echo $row['fine']?>"/><br>
            Officer ID: <input type="text" name="officer_id" value="<?php echo $row['officer_id']?>"/><br>
            Fine Date: <input type="date" name="fine_date" value="<?php echo $row['fine_date']?>"/><br>
            <input type="submit" name="confirm" value="Confirm">

        </form><?php

    }

}
if (isset($_POST['confirm'])){
    $fine = $_POST['fine'];
    $officer_id = $_POST['officer_id'];
    $fine_date = $_POST['fine_date'];
    $query = "update customer set fine='$fine',officer_id='$officer_id',fine_date='$fine_date' where customer_id='".$_SESSION['id']."'";

    $query_run = mysqli_query($connection,$query);

    if($query_run){
        echo '<script>alert("Data updated")</script>';
    }
    else{
        echo '<script>alert("Data not updated")</script>';
    }
}

if(isset($_POST['viewhistory'])){
    $query = "select * from customer where customer_id='".$_SESSION['id']."' ";
    $query_run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_array($query_run)){
        echo $row['history'];
    }

}

?>