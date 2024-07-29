<?php
    require('checkCredentials.php');

    //array which associates skills with each technician data

    $toJSON = [];

    $sql = "select * from technician";
    $result = $conn -> query($sql);

    while ($row = $result -> fetch_assoc()){
        $fullName = $row['First Name'] . " ". $row['Father Name']. " ". $row['Grand Father Name'];        
        
        $toJSON[] = [$fullName, $row['UserName']];
    }
    
    echo json_encode($toJSON);
?>