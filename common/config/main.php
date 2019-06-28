<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\mongodb\Cache',
        ],
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://@cluster0-shard-00-00-kmudk.mongodb.net:27017,cluster0-shard-00-01-kmudk.mongodb.net:27017,cluster0-shard-00-02-kmudk.mongodb.net:27017/test?ssl=true&replicaSet=Cluster0-shard-0&authSource=admin&retryWrites=true&w=majority',
            'options' => [
                "username" => "anoop",
                "password" => "nepal123"
            ]
        ],
    ],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
            'generators' => [
                'mongoDbModel' => [
                    'class' => 'yii\mongodb\gii\model\Generator'
                ]
            ],
        ],
    ]
];
