<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$db = "task";

$conn = new mysqli($servername, $username, $password, $db);


//SELECT
// $sql = "SELECT * FROM user";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//   // output data of each row
//   while($row = $result->fetch_assoc()) {
//     var_dump($row);
//   }
// } else {
//   echo "0 results";
// }


// insert

// $sql = "INSERT INTO MyGuests (firstname, lastname, email)
// VALUES ('John', 'Doe', 'john@example.com')";

// if ($conn->query($sql) === TRUE) {
//   echo "New record created successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . $conn->error;
// }

//UPDATE

// $sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";

// if ($conn->query($sql) === TRUE) {
//   echo "Record updated successfully";
// } else {
//   ec
if(isset($_POST["reg"])){

    $array = array();


    $f_name = $_POST["f_name"];
    $l_name = $_POST["l_name"];
    $email = $_POST["mail"];
    

    $pass = password($_POST["pass"]);
    $sql = "INSERT INTO user (first_name, last_name, email, password)
        VALUES ('".$f_name."', '".$l_name."', '".strtolower($email)."', '".$pass."')";
    if ($conn->query($sql) === TRUE) {
        $array["success"] = true;
    } else {
        if( strpos($conn->error, 'Duplicate entry') !== false ){
            $array["success"] = false;
            $array["error"] = "This email isset";
        }else{
            $array["success"] = false;
            $array["error"] = "Server ...";
        }
    }
    echo json_encode($array);
}

if(isset($_POST["login"])){

    $array = array();

    $email = strtolower($_POST["mail"]);
    

    $pass = password($_POST["pass"]);

$query = "SELECT id, first_name, last_name FROM user WHERE email  = '".$email."' AND password = '".$pass."' ";
$result = mysqli_query($conn, $query);
$row   = mysqli_fetch_row($result);


$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row =$result->fetch_assoc();
    $_SESSION["user"]['id'] = $row['id'];
    $_SESSION["user"]['f_name'] = $row['first_name'];
    $_SESSION["user"]['l_name'] = $row['last_name'];
    $array['success'] = true;
    $array['f_name'] = $row['first_name'];
    $array['l_name'] = $row['last_name'];
} else {
    $array['success'] = false;
    $array["error"] = "Wrong email or password";
}

    echo json_encode($array);

    

 
    // echo json_encode($array);
}

if(isset($_POST["forgot"])){

    $array = array();

    $email = strtolower($_POST["mail"]);
    

    $query = "SELECT id, first_name, last_name FROM user WHERE email  = '".$email."' ";
    $result = mysqli_query($conn, $query);
    $row   = mysqli_fetch_row($result);


    $result = $conn->query($query);

    if ($result->num_rows > 0) {

        $pass_key = generate_key();

        $sql = "UPDATE user SET forgot_pass_key='".$pass_key."', forgot_pass_date = '".date('Y-m-d H:i:s')."' WHERE email ='".$email."'";




        if ($conn->query($sql) === TRUE) {
            $array['success'] = true;
            $_SESSION["forgot_email"] = $email;


            $message = "Dear customer, this code is valid for 20 minutes < ".$pass_key." >";

            $message = wordwrap($message, 70, "\r\n");

            // Отправляем
            mail($email, 'Change password', $message);


        } else {
            $array['success'] = false;
            $array["error"] = "Wrong email";
        }
    }else{
        $array['success'] = false;
        $array["error"] = "Wrong email";
    }



    echo json_encode($array);
}



if(isset($_POST["pass_key"])){

    $array = array();

    $code = strtolower($_POST["code"]);
    

    $query = "SELECT id, first_name, last_name FROM user WHERE forgot_pass_key  = '".$code."' AND email  = '".$_SESSION["forgot_email"]."' AND forgot_pass_date > '".date('d-m-Y H:i', strtotime('-20 min'))."' ";
    $result = mysqli_query($conn, $query);
    $row   = mysqli_fetch_row($result);


    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $array['success'] = true;
    }else{
        $array['success'] = false;
        $array["error"] = "Wrong email";
    }

    echo json_encode($array);
}


if(isset($_POST["new_pass"])){

    $array = array();

    $pass = password($_POST["pass"]);


    

    $sql = "UPDATE user SET password = '".$pass."' WHERE email ='".$_SESSION["forgot_email"]."'";




    if ($conn->query($sql) === TRUE) {
        $array['success'] = true;
    } else {
        $array['success'] = false;
        $array["error"] = "Server ...";
    }


    echo json_encode($array);
}





if(isset($_POST["logout"])){
    session_destroy();
}




// session_destroy();




function password($pass){
    return hash('sha256', md5($pass));
}

function generate_key(){
    return substr(hash('sha256', md5(date('Y-m-d H:i:s').'accepted')), 0, 6);
}

?>