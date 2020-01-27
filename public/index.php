<?php
// よく使うディレクトリへのパスを定数型に定義します。

// このファイルがあるパス(/public/)
define('DOCROOT', __DIR__.DIRECTORY_SEPARATOR);
// プロジェクト全体の一番上の階層
define('ROOTPATH', realpath(__DIR__ . '/../').DIRECTORY_SEPARATOR);
// アプリケーションのソースコードパス(/app/)
define('APPPATH', realpath(__DIR__ . '/../app/').DIRECTORY_SEPARATOR);

require_once(APPPATH . 'bootstrap.php');

// URLを解析して、どのコントローラークラスを実行するかを決定します
$routing = \Model\Routing::factory($_REQUEST, $_SERVER);
// 実行するクラスパスを取得。マッチするクラスがない場合は空文字("")が返ります
$class = $routing->matchClass();
if (empty($class)) {
    // 予期しないURLだった場合、デフォルトのページを表示
    $class = \Model\Routing::defaultClass();
}

if ( ! class_exists($class)) {
    \Model\Log::error($class);
    echo \Model\View::import('error/404', [
        'class' => $class,
    ]);
}
else {
    // コントローラクラスを実体化し、対応する処理を呼び出します

    /** @var \Controller\Controller $controller */
    $controller = new $class();
    $controller->before();

    // HTTPリクエストの種類で、呼び出すメソッドを切り分けます
    switch ($routing->method()) {
        case 'get':
            // no break;
        case 'GET':
            $response = $controller->get();
            break;
        case 'post':
            // no break;
        case 'POST':
            $response = $controller->post();
            break;
    }

    // app/views/template.php の内容を取得します
    echo \Model\View::import('template', [
        'pageTitle' => $controller->pageTitle(),
        'js' => [
            'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js',
        ],
        'css' => [
            'https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css',
        ],
        'contents' => $response,
    ]);
}
