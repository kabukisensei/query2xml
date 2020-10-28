<?php

$db_host = 'localhost';
$db_user = 'root';
$db_password = 'root';
$db_db = 'wp_aa1cokie';
$db_port = 8889;

$mysqli = new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
);

if ($mysqli->connect_error) {
    echo 'Errno: '.$mysqli->connect_errno;
    echo '<br>';
    echo 'Error: '.$mysqli->connect_error;
    exit();
}

echo 'Success: A proper connection to MySQL was made.';

$sql = "SELECT * FROM wp_users;";

$result = mysqli_query($mysqli, $sql) or die("Bad Query: $sql");

$xml=new DOMDocument("1.0");
$xml->formatOutput=true;
$data = $xml->createElement("data");
$xml->appendChild($data);

while($row=mysqli_fetch_array($result)){

    $user=$xml->createElement("User");
    $data->appendChild($user);

    $id=$xml->createElement("ID",$row['ID']);
    $user->appendChild($id);

    $user_login = $xml->createElement("LogIn",$row['user_login']);
    $user->appendChild($user_login);

    $display_name = $xml->createElement("Name",$row['display_name']);
    $user->appendChild($display_name);

    $user_email = $xml->createElement("Email",$row['user_email']);
    $user->appendChild($user_email);

}

echo "<xmp>".$xml->saveXML()."</xmp>";

$xml->save("reports.xml");

?>