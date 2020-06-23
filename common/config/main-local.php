<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=jinglanex8',
            'username' => 'jinglanex8',
            'password' => 'jinglanex8',
            'charset' => 'utf8',
            'tablePrefix' => 'jl_',
        ],
        /**
        'cache' => [
            // redis缓存
            'class' => 'yii\redis\Cache',
        ],
        // session写入缓存配置
        'session' => [
            'class' => 'yii\redis\Session',
            'redis' => [
                'class' => 'yii\redis\Connection',
                'hostname' => 'localhost',
                'port' => 6379,
                'database' => 0,
            ],
        ],
         */
//        'mailer' => [
//            'class' => 'yii\swiftmailer\Mailer',
//            'viewPath' => '@common/mail',
//            // send all mails to a file by default. You have to set
//            // 'useFileTransport' to false and configure a transport
//            // for the mailer to send real emails.
//            'useFileTransport' => true,
//        ],
    ],
];
