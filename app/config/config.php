<?php
return [
    'env' => 'production',
    'db' => [
        // DBのスキーマ名（データベース名）
        'dbname' => getenv('DB_DATABASE') ?: 'management',
        // DBのホスト名
        'host' => getenv('DB_HOST') ?: 'site_mysql',
        // DBサーバの利用ポート
        'port' => getenv('DB_PORT') ?: '3306',
        // DBログインユーザー名
        'username' => getenv('DB_USERNAME') ?: 'adminuser',
        // DBログインパスワード
        'password' => getenv('DB_PASSWORD') ?: 'adminuser',
    ],
    
    'equipments' => [
        '1' => 'PC',
        '2' => 'ソフト',
        '3' => '周辺機器',
    ],
    'documents' => [
        '1' => '映像',
        '2' => 'GAME',
        '3' => '書籍',
    ],
];