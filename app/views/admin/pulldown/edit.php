<style>
    .input[readonly] {
        cursor: initial;
    }

    .sort-icon {
        cursor: pointer;
    }
</style>
<script>
    $(function () {
        var addItem = $('.js-add-item-label');
        var pulldownList = $('.js-pulldown-list');

        $(document)
        // 新規項目の追加
            .on('submit', '.js-add-new-item', function (event) {
                event.preventDefault();
                event.stopPropagation();

                var appendDom = $(`<div class="field is-grouped">
                                <div class="control sort-icon">
                                    <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                </div>
                                <div class="control is-expanded">
                                    <input type="hidden" name="ids[]" value="0">
                                    <input class="input" type="text" name="labels[]" value="${addItem.val()}" readonly>
                                </div>

                                <div class="control">
                                    <button type="submit" class="button is-danger is-outlined js-item-delete">削除</button>
                                </div>
                            </div>`);

                pulldownList.append(appendDom);
                // 入力欄を空に戻す
                addItem.val('');
            })
            // 既存項目の削除
            .on('click', '.js-item-delete', function (event) {
                event.preventDefault();
                event.stopPropagation();

                var target = $(event.currentTarget);
                var field = target.closest('.field');
                field.remove();
            })
            // 成功メッセージを削除
            .on('click', '.js-notification-delete', function(event) {
                var target = $(event.currentTarget);
                var notification = target.closest('.notification');
                notification.remove();
            })
        ;

        // ソートの為の並べ替え
        // 項目の順番をドラッグで変更可能にする 
        $('.sortable').sortable({
            sort: function (event, ui) {
                // 画面スクロールしていると、sortableの表示がずれるので補正する
                var offset = ui.helper.offset();
                ui.helper.offset({top: offset.top + $(document).scrollTop()});
            }
        }).disableSelection();
    });
</script>
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
            <h5 class="title is-5">プルダウン項目の管理</h5>

            <div class="box">
                <form method="post" action="<?= \Model\Uri::make('admin/pulldown/edit') ?>">

                    <div class="field has-addons">
                        <div class="control">
                            <div class="select is-primary">
                                <select name="edit_table_name">
                                    <option value="">未選択</option>
                                    <option value="registered_user" <?= $data['edit_table_name'] === 'registered_user' ? 'selected' : '' ?>>
                                        登録者
                                    </option>
                                    <option value="classification" <?= $data['edit_table_name'] === 'classification' ? 'selected' : '' ?>>
                                        区分け
                                    </option>
                                    <option value="os" <?= $data['edit_table_name'] === 'os' ? 'selected' : '' ?>>OS
                                    </option>
                                    <option value="manufacturer" <?= $data['edit_table_name'] === 'manufacturer' ? 'selected' : '' ?>>
                                        メーカー
                                    </option>
                                    <option value="cpu" <?= $data['edit_table_name'] === 'cpu' ? 'selected' : '' ?>>
                                        CPU
                                    </option>
                                    <option value="hdd" <?= $data['edit_table_name'] === 'hdd' ? 'selected' : '' ?>>
                                        HDD
                                    </option>
                                    <option value="graphics" <?= $data['edit_table_name'] === 'graphics' ? 'selected' : '' ?>>
                                        グラフィック
                                    </option>
                                    <option value="memory" <?= $data['edit_table_name'] === 'memory' ? 'selected' : '' ?>>
                                        メモリ
                                    </option>
                                    <option value="insure" <?= $data['edit_table_name'] === 'insure' ? 'selected' : '' ?>>
                                        保証
                                    </option>
                                    <option value="hard" <?= $data['edit_table_name'] === 'hard' ? 'selected' : '' ?>>
                                        ハード
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="control">
                            <button type="submit" class="button is-primary">選択</button>
                        </div>
                    </div>
                </form>
            </div>

            <?php if ($data['edit_table_name']): ?>
                <?php if ($data['is_save_complete']): ?>
                    <div class="notification is-success">
                        <button class="delete js-notification-delete"></button>
                        保存しました
                    </div>
                <?php endif; ?>

                <div class="box">
                    <div class="box">
                        <form class="js-add-new-item" action="#">
                            <div class="field is-grouped">
                                <div class="control is-expanded">
                                    <input class="input js-add-item-label" type="text" value="" placeholder="項目を追加します">
                                </div>

                                <div class="control">
                                    <button type="submit" class="button is-primary is-outlined">追加</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <form method="post" action="<?= \Model\Uri::make('admin/pulldown/edit') ?>">
                        <input type="hidden" name="edit_table_name" value="<?= $data['edit_table_name'] ?>">

                        <div class="sortable js-pulldown-list">

                            <?php foreach ($data['pulldown'] as $id => $value): ?>
                                <div class="field is-grouped">
                                    <div class="control sort-icon">
                                        <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                                    </div>
                                    <div class="control is-expanded">
                                        <input type="hidden" name="ids[]" value="<?= $id ?>">
                                        <input class="input" type="text" name="labels[]" value="<?= $value ?>" readonly>
                                    </div>

                                    <div class="control">
                                        <button type="submit" class="button is-danger is-outlined js-item-delete">削除
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="field is-grouped is-grouped-centered">
                            <div class="control">
                                <button class="button is-primary" name="is_save" value="1">この内容で保存</button>
                            </div>

                            <div class="control">
                                <button class="button">キャンセル</button>
                            </div>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>
