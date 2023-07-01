<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "health";

$conn = mysqli_connect($servername , $username,$password,$database);

if(!$conn){
    die("Error : ".mysqli_connect_error());
}


// if($_SERVER["REQUEST_METHOD"]== "POST"){
if(isset($_POST["submit"])){
    // echo "hey";
    $name = $_POST["name"];
    $age = $_POST["age"];
    $weight = $_POST["weight"];
    $email = $_POST["email"];

    if(isset($_FILES['file']['name'])){
        // echo"hey";
        $file_name = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];

        move_uploaded_file($file_tmp,`./pdf/`.$file_name);

        $sql = "INSERT INTO `health`(`name`,`age`,`weight`,`email`,`report`) VALUES ('$name','$age','$weight','$email','$file_name')";

        $result = mysqli_query($conn,$sql);
        if($result){
        //   echo " inserted";
          echo"<br>Inserted succesfully";
        }
        else{
          echo mysqli_error();
        }

    }
    else{
        echo"else";
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Details </title>
    <style>
        *{
            font-size: 1.1rem;
        }
        h2{
            font-size: larger;
        }
        div {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        form {
            width: 700px;
            text-align: center;
            border: solid aquamarine;
            border-radius: 15px;
        }
    </style>

    <script>
        function validateFunction() {
            let x = document.forms["myForm"]["name"].value;
            if (x == "") {
                alert("Please Enter Name");
                return false;
            }
            else {
                document.getElementById("demo").innerHTML = "ok";
            }


        }

        

    </script>
</head>

<body>
    <h2 style="text-align: center;">Personal Details Form</h2>


    <div>
        <form method="post" action="/intern/index.php" enctype="multipart/form-data" name="myForm" onsubmit="return validateFunction()" onreset="return clear()">
            
            <p>
                <label for="name"> Name : </label>
                <input type="text" id="name" name="name">
            </p>

            <p>
                <label for="age"> Age : </label>
                <input type="number" id="age" name="age">
            </p>
            <p>
                <label for="age"> Weight : </label>
                <input type="number" id="weight" name="weight">
            </p>

            <p>
                <label for="email"> Email : </label>
                <input type="email" id="email" name="email">
            </p>

            <p>
                <label for="file"> Health Report : </label>
                <input type="file" name="file" id="file" accept = ".pdf">
            </p>

            <p>
                <input type="submit" value="Submit" name="submit">
                <input type="reset" value="Reset">
            </p>

            <p>
                <a href="/intern/fetch.php">Fetch</a>
            </p>
           
        </form>
    </div>

</body>

</html>