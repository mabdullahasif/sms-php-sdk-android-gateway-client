<?php

require __DIR__ . '/vendor/autoload.php';

use AndroidSmsGateway\Client;
use AndroidSmsGateway\Domain\MessageBuilder;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$login = $_ENV['SMS_GATEWAY_LOGIN'];
$password = $_ENV['SMS_GATEWAY_PASSWORD'];

$client = new Client($login, $password);

// verification code
// $code = rand(100000,999999);
// $messageText = "Your verification code is: $code";

$messageText = "Hello, this is a test message from Android SMS Gateway API.";
$phone = "+923001234567";

$message = (new MessageBuilder($messageText, [$phone]))
    ->setSimNumber(1)
    ->setWithDeliveryReport(true)
    ->setPriority(100)
    ->build();

try {
    $result = $client->SendMessage($message);
    echo "Message sent. ID: ".$result->ID();
} catch (Exception $e) {
    echo "Error: ".$e->getMessage();
}