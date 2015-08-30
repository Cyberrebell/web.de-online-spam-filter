<?php
$pdo = new PDO( 
    'mysql:host=127.0.0.1;dbname=spamfilter', 
    'root', 
    '', 
    [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']
);

$offset = 0;
while (count($data = $pdo->query("SELECT mail FROM mail ORDER BY id ASC LIMIT 50 OFFSET " . ($offset * 50) . ";")->fetchAll()) > 0) {
    $jsArray = 'var mails = [' . PHP_EOL;
    foreach ($data as $row) {
        $jsArray .= '"' . $row['mail'] . '",' . PHP_EOL;
    }
    $jsArray .= '];';
    file_put_contents(__DIR__ . '/spamlist' . $offset . '.txt', $jsArray);
    $offset++;
}
