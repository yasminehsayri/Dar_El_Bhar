<?php

function validateInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (isset($_POST['submit'])) {

  $First_Name = validateInput($_POST['First_Name']);
  $Last_Name = validateInput($_POST['Last_Name']);
  $Mail = validateInput($_POST['Mail']);
  $Room_Type = validateInput($_POST['Room_Type']);
  $Number_Room = validateInput($_POST['Number_Room']);
  $Number_Personnes = validateInput($_POST['Number_Personnes']);
  $Number_Childrens = validateInput($_POST['Number_Childrens']);
  $CHECK_IN = validateInput($_POST['CHECK_IN']);
  $CHECK_OUT= validateInput($_POST['CHECK_OUT']);

  if (empty($name) || empty($firstName) || empty($email) || $roomType == 0 || $roomNumber == 0 || $numPeople == 0 || empty($checkIn) || empty($checkOut)) {
    $errorMessage = "Please fill out all required fields.";
  } else {
    $message = "Thank you for your reservation! Here are the details:<br>";
    $message .= "Name: $name $firstName<br>";
    $message .= "Email: $email<br>";
    $message .= "Room Type: $roomType<br>";
    $message .= "Number of Rooms: $roomNumber<br>";
    $message .= "Number of People: $numPeople<br>";
    $message .= "Number of Children: $numChildren<br>";
    $message .= "Check-in: $checkIn<br>";
    $message .= "Check-out: $checkOut<br>";

    echo $message;
  }
  $conn = new mysqli('localhost','root','','dar_el_ghab');
if($conn->connect_error){
  echo "$conn->connect_error";
  die("Connection Failed : ". $conn->connect_error);
} else {
  $stmt = $conn->prepare("insert into reservations(First_Name,Last_Name,Mail,Room_Type,Number_Room,Number_Personnes,Number_Childrens,CHECK_IN,CHECK_OUT) values(?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sssssi",$First_Name,$Last_Name,$Mail,$Room_Type,$Number_Room,$Number_Personnes,$Number_Childrens,$CHECK_IN,$CHECK_OUT);
  $execval = $stmt->execute();
  echo $execval;
  echo "Registration successfully...";
  $stmt->close();
  $conn->close();
}
}

?>