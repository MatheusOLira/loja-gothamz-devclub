<?php

header('Content-Type: application/json');

$ref = $_GET['ref'] ?? null;

if (!$ref) {
    echo json_encode(["status" => "error"]);
    exit;
}

$arquivo = "logs/$ref.txt";

if (file_exists($arquivo)) {
    echo json_encode(["status" => "approved"]);
} else {
    echo json_encode(["status" => "pending"]);
}