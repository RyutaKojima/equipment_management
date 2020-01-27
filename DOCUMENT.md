# ファイル/ディレクトリ構成

.session/
    ・セッション情報を保存するファイルの保存先ディレクトリです。

app/
  config/
    config.php
        ・アプリケーションを動かすための各種設定です。
           DBの接続設定などはここで変更します。

  controllers/
    ・画面表示の際に実行されるファイルです。
       URLが admin/signin の場合 controllers/Admin/Signin.php が実行されます。
       controllers/ の下のディレクトリ・ファイルの先頭は大文字でなければいけません。

  models/
    ・共通で使いまわす処理をまとめたクラスを定義しています。

  views/
    ・画面に表示するHTMLを定義しています。

  bootstrap.php

migrations/
  ・データベースを構築するためのSQLがまとめてあります。

public/
  index.php
    ・サイトにアクセスがあった時に実行される入り口です。

vendor/
  ・Composer(ツール)で自動作成されたものです。
     includeを書かなくても動くようにするためのものです。
     通常、これを触ることはありません。

