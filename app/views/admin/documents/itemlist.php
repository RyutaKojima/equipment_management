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
                <?php if ($data['user']->isLoggedIn()): ?>
                    <a href="<?= \Model\Uri::make('admin/menu') ?>">メニュー</a>
                <?php else: ?>
                    <a href="<?= \Model\Uri::make('home') ?>">メニュー</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <section class="section">
        <div class="container">
            <h5 class="title is-5">資料一覧</h5>

            <div class="formWrapper">
                <form method="get" action="<?= \Model\Uri::make('admin/documents/itemlist') ?>">

                    <div class="field is-grouped">
                        <?php foreach ($data['documentsParams'] as $id => $values): ?>
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
                        <th>名称</th>
                        <th>ハード</th>
                        <th>メーカー</th>
                        <th>ISBN</th>
                        <th>ASIN</th>
                        <th class="colTypeDate">発行日</th>
                        <th class="colTypeDate">購入日</th>
                        <th class="colTypeDate">登録日</th>
                        <th>登録者</th>
                        <th class="colRemarks">備考</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data['collection']->asArray() as $document): ?>
                        <tr>
                            <td>
                                <a href="<?= \Model\Uri::make('admin/documents/detail', [
                                    'id' => $document->get('document_id'),
                                ]); ?>"><?= $document->get('document_id') ?></a>
                            </td>
                            <td>
                                <?= $document->typeLabel() ?>
                            </td>
                            <td>
                                <?= $document->get('title') ?>
                            </td>
                            <td>
                                <?= $document->hardLabel() ?>
                            </td>
                            <td>
                                <?= $document->get('manufacturer') ?>
                            </td>
                            <td>
                                <?= $document->get('isbn') ?>
                            </td>
                            <td>
                                <?= $document->get('asin') ?>
                            </td>
                            <td>
                                <?= $document->getDateFormat('issued_at', 'Y-m-d') ?>
                            </td>
                            <td>
                                <?= $document->getDateFormat('purchased_at', 'Y-m-d') ?>
                            </td>
                            <td>
                                <?= $document->getDateFormat('created_at', 'Y-m-d') ?>
                            </td>
                            <td>
                                <?= $document->registeredUserLabel() ?>
                            </td>
                            <td>
                                <?= nl2br($document->get('remarks'), false) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</main>
