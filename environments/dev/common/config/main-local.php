<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://@cluster0-shard-00-00-kmudk.mongodb.net:27017,cluster0-shard-00-01-kmudk.mongodb.net:27017,cluster0-shard-00-02-kmudk.mongodb.net:27017/test?ssl=true&replicaSet=Cluster0-shard-0&authSource=admin&retryWrites=true&w=majority',
            'options' => [
                "username" => "anoop",
                "password" => "tahachhaina"
            ]
        ],
    ],
];
