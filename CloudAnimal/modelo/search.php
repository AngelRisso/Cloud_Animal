<?php
session_start();
    include_once "../conexion.php";

    $outgoing_id = $_SESSION['unique_id'];
    $searchTerm = mysqli_real_escape_string($mysqli, $_POST['searchTerm']);

    $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (username LIKE '%{$searchTerm}%') ";
    $output = "";
    $query = mysqli_query($mysqli, $sql);
    if(mysqli_num_rows($query) > 0){
        require "data.php";
    }else{
        $output .= 'No se encontró ningún usuario relacionado con su término de búsqueda';
    }
    echo $output;
?>