<?php
$id = $_POST['eid'];
$age = $_POST['eage'];
$name = $_POST['ename'];
$address = $_POST['ead'];
$contact = $_POST['contact'];
$dob = $_POST['edob'];
$year = $_POST['yoe'];
$pw = $_POST['pw'];

if(strlen($id) == 6){
    if(preg_match("/^[0-9]*$/", $age)){
        if(preg_match("/^[a-zA-Z ]*$/", $name)){ // Added space in the regex for allowing spaces in the name
            if(strlen($address) > 25){
                if(preg_match("/^[0-9]*$/", $contact) && strlen($contact) == 10){
                    if(preg_match("/^((0|1)[0-9]|2[0-9]|3[0-1])\/(0[1-9]|1[0-2])\/((19|20)\d\d)$/", $dob)){ // Removed unnecessary asterisk (*) and fixed regex for date of birth
                        if(preg_match("/^[0-9]*$/", $year)){
                            if(preg_match("/^[a-zA-Z0-9@!#$%^&]*$/", $pw)){ // Added missing closing parenthesis and corrected variable name
                                // Database connection and insertion
                                $conn = new mysqli('127.0.0.1', 'root', '', 'restaurant');
                                if ($conn->connect_error) {
                                    die('Connection failed: ' . $conn->connect_error);
                                }

                                $sql = "INSERT INTO employee(id, name, age,address, contact, dob, yearofexp,password) VALUES ('$id', '$name','$age', '$address', '$contact', '$dob', '$year','$pw')";
                                if ($conn->query($sql) === TRUE) {
                                    echo '<script>alert("ADDED SUCCESSFULLY");</script>';
                                } else {
                                    echo json_encode(['success' => false]);
                                }
                                $conn->close();
                            } else {
                                echo '<script>alert("INVALID PASSWORD");</script>';
                            }
                        } else {
                            echo '<script>alert("INVALID YEAR OF EXPERIENCE");</script>';
                        }
                    } else {
                        echo '<script>alert("INVALID DATE OF BIRTH");</script>';
                    }
                } else {
                    echo '<script>alert("INVALID CONTACT");</script>';
                }
            } else {
                echo '<script>alert("INVALID ADDRESS");</script>';
            }
        } else {
            echo '<script>alert("INVALID NAME");</script>';
        }
    } else {
        echo '<script>alert("INVALID AGE");</script>';
    }
} else {
    echo '<script>alert("INVALID ID");</script>';
}
?>
