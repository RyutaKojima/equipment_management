<?php
return [
    'env' => 'production',
    'db' => [
        // DBのスキーマ名（データベース名）
        'dbname' => 'management',
        // DBのホスト名
        'host' => 'site_mysql',
        // DBサーバの利用ポート
        'port' => '3306',
        // DBログインユーザー名
        'username' => 'adminuser',
        // DBログインパスワード
        'password' => 'adminuser',
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