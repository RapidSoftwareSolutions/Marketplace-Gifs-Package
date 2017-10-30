<?php
$routes = [
    'metadata',
    'importMedia',
    'uploadMedia'
];
foreach($routes as $file) {
    require __DIR__ . '/../src/routes/'.$file.'.php';
}

