<?php

return [
        'dbname' =>'notifier',
        'username' => 'root',
        'password' => '123',
        'host' => '127.0.0.1',
        'dbprefix' => 'mysql',
        'options' =>[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ];