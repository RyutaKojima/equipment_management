<style>
    .errors {
        margin: 10px 0;
        padding: 10px;
        color: red;
        border: 1px solid red;
        border-radius: 8px;
    }
</style>
<?php
/** @var \Model\Document $document */
$document = $data['document'];
?>

<main>

    <nav class="level">
        <div class="level-left">
            <div class="level-item">
                <a href="<?= \Model\Uri::make('admin/menu') ?>">メニュー</a>
            </div>
        </div>
    </nav>


    <section class="section">
        <div class="container">
            <h5 class="title is-5">資料登録ページ</h5>

            <?php if ( ! empty($data['errors'])): ?>
                <div class="errors">
                    <ul>
                        <?php foreach ($data['errors'] as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">種別</label>
                    </div>
                    <div class="field-body">
                        <?= $document->typeLabel() ?>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">名称</label>
                    </div>
                    <div class="field-body">
                        <?= $document->get('title') ?>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">ハード</label>
                    </div>
                    <div class="field-body">
                        <?= $document->hardLabel() ?>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">メーカー</label>
                    </div>
                    <div class="field-body">
                        <?= $document->get('manufacturer') ?>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">ISBN</label>
                    </div>
                    <div class="field-body">
                        <?= $document->get('isbn') ?>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">ASIN</label>
                    </div>
                    <div class="field-body">
                        <?= $document->get('asin') ?>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">発行日</label>
                    </div>
                    <div class="field-body">
                        <?= $document->getDateFormat('issued_at', 'Y-m-d') ?>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">購入日</label>
                    </div>
                    <div class="field-body">
                        <?= $document->getDateFormat('purchased_at', 'Y-m-d') ?>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">登録者</label>
                    </div>
                    <div class="field-body">
                        <?= $document->registeredUserLabel() ?>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">備考</label>
                    </div>
                    <div class="field-body">
                        <?= nl2br($document->get('remarks'), false) ?>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                    </div>
                    <div class="field-body">
                        <div class="field is-grouped">
                            <p class="control">
                            <form method="post" action="<?= \Model\Uri::make('admin/documents/registconfirm') ?>">
                                <?= $document->htmlHidden() ?>
                                <input type="hidden" name="doRegister" value="1">
                                <button class="button is-primary">登録</button>
                            </form>
                            </p>
                            <p class="control">
                            <form method="get" action="<?= \Model\Uri::make('admin/documents/regist') ?>">
                                <?= $document->htmlHidden() ?>
<!--                                <a class="button is-light" href="--><?//= \Model\Uri::make('admin/menu') ?><!--">キャンセル</a>-->
                                <button class="button is-light">キャンセル</button>
                            </form>
                            </p>
                        </div>
                    </div>
                </div>
        </div>
    </section>
</main>