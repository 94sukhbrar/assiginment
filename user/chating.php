<?php

include '../dbconnection.php';


$result_array = array();


$sendMessage = mysqli_query($con,  "select * from chat ");

$string = '<ul>';


while ($row = mysqli_fetch_array($sendMessage)) {
    if (($row['message_from'] == $_POST['from']) && ($row['message_to'] == $_POST['to'])) {
        $string .= "<li style='background-color: transparent;height: 10px;width: 100%;text-align: end'>" . $row['message'] . '</li>';
    } else if (($row['message_from'] == $_POST['to']) && ($row['message_to'] == $_POST['from'])) {
        $string .= "<li style='background-color: transparent;height: 10px;width: 100%;text-align: inherit'>" . $row['message'] . '</li>';
    }
}


$string .= '</ul><br/>';




header('Content-type: application/json');
echo json_encode($string);

$con->close();
