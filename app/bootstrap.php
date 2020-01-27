<?php

require_once (DOCROOT . '../vendor/autoload.php');

error_reporting(E_ALL );
ini_set('display_errors', 1);

// セッションデータ保存パス設定
ini_set( 'session.save_path', ROOTPATH . '.session' );
// セッションの維持期間の設定
ini_set( 'session.gc_maxlifetime', 60*60 );  // セッションの有効期限　秒(デフォルト:1440)
ini_set( 'session.gc_probability', 1 );  // 期限切れのセッションデータを削除する確率　分子(デフォルト:1)
ini_set( 'session.gc_divisor', 1 );      // 期限切れのセッションデータを削除する確率　分母(デフォルト:100)
