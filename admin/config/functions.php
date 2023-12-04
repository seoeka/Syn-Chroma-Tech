<?php
include "database.php";

function query($query)
{
    // Koneksi database
    global $database;

    $result = mysqli_query($database, $query);

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}