<style>
    @media screen and (min-width: 1600px) {
        .container {
            max-width: calc(100vw - 180px);
            width: calc(100vw - 180px);
        }
    }

    .section {
        padding: 0 1.5rem;
    }

    .formWrapper {
        padding: 10px;
        border: 1px solid grey;
        border-radius: 6px;
        line-height: 36px;
    }

    .tableWrapper {
        width: 100%;
        max-height: calc(100vh - 180px);
        overflow-x: scroll;
    }

    th {
        min-width: 8rem;
    }
    
    .colSmall {
        min-width: 5rem;
    }

    .colTypeDate {
        min-width: 8rem;
    }

    .colRemarks {
        min-width: 22em;
    }
</style>

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
            <h5 class="title is-5">機材一覧</h5>

            <div class="formWrapper">
                <form method="get" action="<?= \Model\Uri::make('admin/equipments/itemlist') ?>">
                    <div class="field is-grouped">
                        <?php foreach ($data['equipmentsParams'] as $id => $values): ?>
                            <p class="control">
                                <label class="checkbox">
                                    <input type="checkbox" name="filterTypes[]"
                                           value="<?= $id ?>" <?= $values['checked'] ? 'checked' : '' ?> >
                                    <?= $values['label'] ?>
                                </label>
                            </p>
                        <?php endforeach; ?>

                        <p class="control">
                            <button class="button">検索</button>
                        </p>
                    </div>
                </form>
            </div>

            <div class="tableWrapper">
                <table class="table">
                    <thead>
                    <tr>
                        <th class="colSmall">ID</th>
                        <th class="colSmall">種別</th>
                        <th class="colSmall">区分け</th>
                        <th class="">OS</th>
                        <th class="">メーカー</th>
                        <th class="">名称</th>
                        <th class="">CPU</th>
                        <th class="">SSD</th>
                        <th class="">HDD1</th>
                        <th class="">HDD2</th>
                        <th class="">グラフィック</th>
                        <th class="">メモリ</th>
                        <th class="">光学ドライブ</th>
                        <th class="">保証</th>
                        <th class="">シリアル</th>
                        <th class="">ログイン/PC名</th>
                        <th class="">パスワード</th>
                        <th class="colTypeDate">購入日</th>
                        <th class="">使用者</th>
                        <th class="colTypeDate">登録日</th>
                        <th class="">登録者</th>
                        <th class=" colRemarks">備考</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    /** @var \Model\EquipmentCollection $collection */
                    $collection = $data['collection'];
                    foreach ($collection->asArray() as $equipment): ?>
                        <tr>
                            <td>
                                <a href="<?= \Model\Uri::make('admin/equipments/detail', [
                                    'id' => $equipment->get('equipment_id'),
                                ]); ?>"><?= $equipment->get('equipment_id') ?></a>
                            </td>
                            <td><!-- 種別 -->
                                <?= $equipment->typeLabel() ?>
                            </td>
                            <td><!-- 区分け -->
                                <?= $equipment->classificationLabel() ?>
                            </td>
                            <td><!-- OS -->
                                <?= $equipment->osLabel() ?>
                            </td>
                            <td><!-- メーカー -->
                                <?= $equipment->manufacturerLabel() ?>
                            </td>
                            <td><!-- 名称 -->
                                <?= $equipment->get('title') ?>
                            </td>
                            <td><!-- CPU -->
                                <?= $equipment->cpuLabel() ?>
                            </td>
                            <td><!-- SSD -->
                                <?= $equipment->get('ssd') ?>
                            </td>
                            <td><!-- HDD1 -->
                                <?= $equipment->hdd1Label() ?>
                            </td>
                            <td><!-- HDD2 -->
                                <?= $equipment->hdd2Label() ?>
                            </td>
                            <td><!-- グラフィックボード -->
                                <?= $equipment->graphicsLabel() ?>
                            </td>
                            <td><!-- メモリ -->
                                <?= $equipment->memoryLabel() ?>
                            </td>
                            <td><!-- 光学ドライブ -->
                                <?= $equipment->get('has_drive') ? '有' : '無' ?>
                            </td>
                            <td><!-- 保証 -->
                                <?= $equipment->insureLabel() ?>
                            </td>

                            <td><!-- シリアル -->
                                <?= $equipment->get('serial') ?>
                            </td>
                            <td><!-- ログイン/PC名 -->
                                <?= $equipment->get('login_name') ?>
                            </td>
                            <td><!-- パスワード -->
                                <?= $equipment->get('login_password') ?>
                            </td>
                            <td><!-- 購入日 -->
                                <?= $equipment->getDateFormat('purchased_at', 'Y-m-d') ?>
                            </td>
                            <td><!-- 使用者 -->
                                <?= $equipment->get('user_in_use') ?>
                            </td>
                            <td><!-- 登録日 -->
                                <?= $equipment->getDateFormat('created_at', 'Y-m-d') ?>
                            </td>
                            <td><!-- 登録者 -->
                                <?= $equipment->registeredUserLabel() ?>
                            </td>
                            <td><!-- 備考-->
                                <?= nl2br($equipment->get('remarks'), false) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</main>
