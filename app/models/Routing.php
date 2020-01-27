<?php

namespace Model;

/**
 * URLを解析して、処理を適切なクラスに割り振るためのクラス
 *
 * @package Model
 */
class Routing
{
    private $request = [];
    private $server = [];

    private $method = 'GET';
    private $classPath = '';
    private $params = [];

    /**
     * オブジェクト作成
     * 
     * @param $request
     * @param $server
     *
     * @return Routing
     */
    public static function factory($request, $server)
    {
        $obj = new static($request, $server);
        return $obj;
    }

    /**
     * URLにマッチするクラスがない場合に表示するデフォルトクラス
     * 
     * @return string
     */
    public static function defaultClass()
    {
        return '\Controller\Home';
    }

    /**
     * コンストラクタ
     *
     * @param array $request  `$_REQUEST`スーパーグローバル変数をそのまま渡す
     * @param array $server   `$_SERVER`スーパーグローバル変数をそのまま渡す
     */
    private function __construct($request, $server)
    {
        $this->request = $request;
        $this->server = $server;
        $this->classPath = '';
        $this->params = [];
        $this->method = 'GET';

        $this->parse();
    }

    /**
     * 入力された値を解析して、最適なクラスパス
     */
    private function parse()
    {
        // HTMLメソッド(GET, POST)を取得
        $REQUEST_METHOD = Arr::get($this->server, 'REQUEST_METHOD');
        // URLを取得
        $REQUEST_URI = Arr::get($this->server, 'REQUEST_URI');

        // 正規表現を使ってURLを分解する
        if ( ! preg_match('/\/index.php\/?([^\?]*)\??(.*)/', $REQUEST_URI, $matches)) {
            return;
        }

        // 「?」より前の部分（どの画面を表示するかに使う）
        $page_query = $matches[1];
        // 「?」より後の部分（GETパラメータに使う）
        $param_query = $matches[2];

        $this->method = $REQUEST_METHOD;

        //----------------------------------------------------------------------
        // クラスパスを作成
        $classPath = '';
        // スラッシュで区切って配列にする
        $divide = explode('/', $page_query);
        foreach ($divide as $item) {
            if ( ! empty($item)) {
                // 文字列の最初の文字を大文字にしてつなげる
                $classPath .= '\\' . ucfirst($item);
            }
        }

        // Classパスが作られていれば、頭に"\Controller"をつける
        if ($classPath) {
            $this->classPath = '\Controller' . $classPath;
        }

        //----------------------------------------------------------------------
        // GETパラメータ部分の処理
        $params = [];
        // アンドで区切って配列にする
        $divide = explode('&', $param_query);
        foreach ($divide as $item) {
            // =で区切って配列にする
            $arg = explode('=', $item);
            // イコールが一つしか含まれないのをチェック（カウントが２＝イコールがひとつだけ）
            if (count($arg) === 2) {
                $key = $arg[0];
                $val = $arg[1];

                // キーに値が入っていれば、パラメータとして追加する
                if ( ! empty($key)) {
                    $params[ $key ] = $val;
                }
            }
        }

        $this->params = $params;
    }

    /**
     * 解析結果のクラスパスを返す
     * 
     * @return string
     */
    public function matchClass()
    {
        return $this->classPath;
    }

    /**
     * 解析結果のHTTPメソッド(GET or POST)を返す
     * 
     * @return string
     */
    public function method()
    {
        return $this->method;
    }
}