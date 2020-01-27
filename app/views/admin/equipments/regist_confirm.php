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
/** @var \Model\Equipment $equipment */
$equipment = $data['equipment'];
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
            <h5 class="title is-5">機材登録ページ</h5>

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
                    <?= $equipment->typeLabel() ?>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">区分け</label>
                </div>
                <div class="field-body">
                    <?= $equipment->classificationLabel() ?>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">OS</label>
                </div>
                <div class="field-body">
                    <?= $equipment->osLabel() ?>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">メーカー</label>
                </div>
                <div class="field-body">
                    <?= $equipment->manufacturerLabel() ?>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">名称</label>
                </div>
                <div class="field-body">
                    <?= $equipment->get('title') ?>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">CPU</label>
                </div>
                <div class="field-body">
                    <?= $equipment->cpuLabel() ?>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">SSD</label>
                </div>
                <div class="field-body">
                    <?= $equipment->get('ssd') ?>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">HDD1</label>
                </div>
                <div class="field-body">
                    <?= $equipment->hdd1Label() ?>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">HDD2</label>
                </div>
                <div class="field-body">
                    <?= $equipment->hdd2Label() ?>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">グラフィック</label>
                </div>
                <div class="field-body">
                    <?= $equipment->graphicsLabel() ?>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">メモリ</label>
                </div>
                <div class="field-body">
                    <?= $equipment->memoryLabel() ?>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">光学ドライブ</label>
                </div>
                <div class="field-body">
                    <?= $equipment->get('has_drive') ? '有' : '無' ?>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">保証</label>
                </div>
                <div class="field-body">
                    <?= $equipment->insureLabel() ?>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">シリアル</label>
                </div>
                <div class="field-body">
                    <?= $equipment->get('serial') ?>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">ログイン/PC名</label>
                </div>
                <div class="field-body">
                    <?= $equipment->get('login_name') ?>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">パスワード</label>
                </div>
                <div class="field-body">
                    <?= $equipment->get('login_password') ?>
                </div>
            </div>


            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">購入日</label>
                </div>
                <div class="field-body">
                    <?= $equipment->getDateFormat('purchased_at', 'Y-m-d') ?>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">使用者</label>
                </div>
                <div class="field-body">
                    <?= $equipment->get('user_in_use') ?>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">登録者</label>
                </div>
                <div class="field-body">
                    <?= $equipment->registeredUserLabel() ?>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">備考</label>
                </div>
                <div class="field-body">
                    <?= nl2br($equipment->get('remarks'), false) ?>
                </div>
            </div>


            <div class="field is-horizontal">
                <div class="field-label">
                </div>
                <div class="field-body">
                    <div class="field is-grouped">
                        <p class="control">
                        <form method="post" action="<?= \Model\Uri::make('admin/equipments/registconfirm') ?>">
                            <?= $equipment->htmlHidden() ?>
                            <input type="hidden" name="doRegister" value="1">
                            <button class="button is-primary">登録</button>
                        </form>
                        </p>
                        <p class="control">
                        <form method="get" action="<?= \Model\Uri::make('admin/equipments/regist') ?>">
                            <?= $equipment->htmlHidden() ?>
<!--                            <a class="button is-light" href="--><?//= \Model\Uri::make('admin/menu') ?><!--">キャンセル</a>-->
                            <button class="button is-light">キャンセル</button>
                        </form>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
