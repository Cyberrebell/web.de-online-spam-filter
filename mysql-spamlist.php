<?php
$pdo = new PDO( 
    'mysql:host=127.0.0.1;dbname=spamfilter', 
    'root', 
    '', 
    [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']
);

$data = $pdo->query("SELECT mail FROM mail ORDER BY mail ASC;")->fetchAll();

$jsArray = 'var mails = [' . PHP_EOL;
foreach ($data as $row) {
    $jsArray .= '"' . reset($row) . '",' . PHP_EOL;
}
$jsArray .= '];';
file_put_contents(__DIR__ . '/spamlist.txt', $jsArray);
