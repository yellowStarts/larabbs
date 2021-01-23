<?php

return [
    // HTTP 请求的超时时间（秒）
    'timeout' => 10.0,

    // 默认发送配置
    'default' => [
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

        // 默认可用的发送网关
        'gateways' => [
            'qcloud', 'aliyun',
        ],
    ],

    // 可用的网关配置
    'gateways' => [
        'errorlog' => [
            'file' => '/tmp/easy-sms.log',
        ],

        'qcloud' => [
            'sdk_app_id' => env('SMS_TENCENT_SDK_APP_ID'), // SDK APP ID
            'app_key' => env('SMS_TENCENT_APP_KEY'), // APP KEY
            'sign_name' => env('SMS_TENCENT_SIGN_NAME'), // 短信签名，如果使用默认签名，该字段可缺省（对应官方文档中的sign）
            'templates' => [
                'register' => env('SMS_TENCENT_TEMPLATE_REGISTER'), // 注册模板ID
            ],
        ],

        'aliyun' => [
            'access_key_id' => env('SMS_ALIYUN_ACCESS_KEY_ID'),
            'access_key_secret' => env('SMS_ALIYUN_ACCESS_KEY_SECRET'),
            'sign_name' => env('SMS_ALIYUN_SIGN_NAME'),
            'templates' => [
                'register' => env('SMS_ALIYUN_TEMPLATE_REGISTER'),
            ]
        ],
    ],
];
