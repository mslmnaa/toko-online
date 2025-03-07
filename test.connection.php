<?php
$host = 'smtp.gmail.com';
$port = 587;

echo "Attempting to connect to $host:$port...\n";

$socket = @fsockopen($host, $port, $errno, $errstr, 5);

if (!$socket) {
    echo "Failed to connect: $errno - $errstr\n";
} else {
    echo "Connection successful!\n";
    fclose($socket);
}

echo "\nTesting DNS resolution...\n";
$ip = gethostbyname($host);
echo "$host resolves to: $ip\n";

