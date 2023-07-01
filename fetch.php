<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "health";

$conn = mysqli_connect($servername , $username,$password,$database);

if(!$conn){
    die("Error : ".mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Details </title>
</head>

<body>
    <h2 style="text-align: center;">Fetch user health Report</h2>


    <div>
        <form method="post" action="/intern/fetch.php" enctype="multipart/form-data" name="myForm"
            onsubmit="return validateFunction()" onreset="return clear()">
            <p>
                <label for="email"> Email : </label>
                <input type="email" id="email" name="email">
            </p>

            <p>
                <input type="submit" value="Fetch" name="submit">
            </p>

            <p>
                <a href="/intern/assignment.php">Insert Record</a>
            </p>

        </form>
    </div>

    <?php

    if(isset($_POST["submit"])){
        $email = $_POST["email"];

        $existEmail = "SELECT * FROM `health` WHERE `email` = '$email'";
        $result = mysqli_query($conn,$existEmail);

        if($result->num_rows>=0){
            while($row = $result->fetch_assoc()){
                $pdf = $row["report"];
                echo " Name : ".$row["name"]."<br>";
                echo " FileName : ".$row["report"]."<br>";
            }
        }

    }

    ?>
    <br/><br/>
    <iframe src="/intern/<?php echo $pdf; ?>" width="90%" height="700px">
    </iframe>

</body>

</html>