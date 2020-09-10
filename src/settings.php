<?php
return [
    'settings' => [
        'displayErrorDetails' => true, //set to false in production
        'addContentLengthHeader' => false, //allow the web server to send the content-length header
        'upload_directory' => __DIR__ . '/../public/uploads', //upload directory

        //rendere settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        //database connection settings
        "db" => [
            "host" => "localhost",
            "dbname" => "inventory_db",
            "user" => "root",
            "pass" => "",
        ]
    ],
];