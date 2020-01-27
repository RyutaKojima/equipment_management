<style>
    .table td, .table th {
        width: 50%;
    }
</style>
<?php
/**
 * @var $data array
 */
?>
<main>
    <nav class="level">
        <div class="level-left"></div>
        <div class="level-right">
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading"><?= $data['user']->userName() ?></p>
                    <p class="title"><a class="button" href="<?= \Model\Uri::make('admin/signout') ?>">ログアウト</a></p>
                </div>
            </div>
        </div>
    </nav>

    <section class="section">
        <div class="container">
            <h5 class="title is-5">管理者ページ</h5>

            <table class="table is-fullwidth">
                <thead>
                    <tr>
                        <th colspan="2">各種手続き</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="<?= \Model\Uri::make('admin/equipments/regist') ?>">機材登録</a></td>
                        <td><a href="<?= \Model\Uri::make('admin/equipments/itemlist') ?>">機材一覧</a></td>
                    </tr>
                    <tr>
                        <td><a href="<?= \Model\Uri::make('admin/documents/regist') ?>">資料登録</a></td>
                        <td><a href="<?= \Model\Uri::make('admin/documents/itemlist') ?>">資料一覧</a></td>
                    </tr>
                    <tr>
                        <td><a href="<?= \Model\Uri::make('admin/pulldown/edit') ?>">プルダウン項目の管理</a></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><a href="<?= \Model\Uri::make('admin/password/generate') ?>">設定用パスワード文字列生成</a></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</main>
