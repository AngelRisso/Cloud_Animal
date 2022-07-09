<?php
   session_start();
    include_once "../conexion.php";
    $outgoing_id = $_SESSION['unique_id'];
    $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ORDER BY id DESC";
    $query = mysqli_query($mysqli, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No hay usuarios disponibles para chatear.";
    }elseif(mysqli_num_rows($query) > 0){
        require "data.php";
    }
    echo $output;
?>