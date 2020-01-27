<style>
    .errors {
        margin: 10px 0;
        padding: 10px;
        color: red;
        border: 1px solid red;
        border-radius: 8px;
    }
</style>
<script>
    const disableList = {
        '1': [],
        '2': [],
        '3': ['hard_id'],
    };

    document.addEventListener("DOMContentLoaded", () => {
        const typeId = document.querySelector("#type_id");
        const inputs = document.querySelectorAll('input, select');
        
        const fnToggleEffectiveItem = function () {
            const disableNamesList = disableList[typeId.value];
            for (let input of inputs) {
                const isChangeToDisabled = disableNamesList.indexOf(input.name) !== -1;
                if (isChangeToDisabled) {
                    input.value = '';
                }
                input.disabled = isChangeToDisabled;
            }
        };

        typeId.addEventListener('change', fnToggleEffectiveItem);
        fnToggleEffectiveItem();
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

            <form method="post" action="<?= \Model\Uri::make('admin/documents/registconfirm') ?>">

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">種別</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                            <div class="select">
                                <select class="select" name="type_id" id="type_id">
                                    <?php foreach (\Model\Arr::get($data, 'select_list.type', []) as $id => $label): ?>
                                        <option value="<?= $id ?>" 
                                            <?= \Model\Arr::get($data, 'input.type_id', 0) == $id ? 'selected' : '' ?>
                                            <?= is_null($label) ? 'disabled' : '' ?>
                                        >
                                            <?= is_null($label) ? '---' : $label ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">名称</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input class="input" type="text" name="title" value="<?= \Model\Arr::get($data, 'input.title', '') ?>">
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">ハード</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                            <div class="select">
                                <select class="select" name="hard_id">
                                    <?php foreach (\Model\Arr::get($data, 'select_list.hard', []) as $id => $label): ?>
                                        <option value="<?= $id ?>" 
                                            <?= \Model\Arr::get($data, 'input.hard_id', 0) == $id ? 'selected' : '' ?>
                                            <?= is_null($label) ? 'disabled' : '' ?>
                                        >
                                            <?= is_null($label) ? '---' : $label ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">メーカー</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input class="input" type="text" name="manufacturer" value="<?= \Model\Arr::get($data, 'input.manufacturer', '') ?>">
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">ISBN</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input class="input" type="text" name="isbn" value="<?= \Model\Arr::get($data, 'input.isbn', '') ?>">
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">ASIN</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input class="input" type="text" name="asin" value="<?= \Model\Arr::get($data, 'input.asin', '') ?>">
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">発行日</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input class="input" type="date" name="issued_at" value="<?= \Model\Arr::get($data, 'input.issued_at', '') ?>" required >
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">購入日</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input class="input" type="date" name="purchased_at" value="<?= \Model\Arr::get($data, 'input.purchased_at', '') ?>" required >
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">登録者</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                            <div class="select">
                                <select class="select" name="registered_by_id">
                                    <?php foreach (\Model\Arr::get($data, 'select_list.registered_user', []) as $id => $label): ?>
                                        <option value="<?= $id ?>" 
                                            <?= \Model\Arr::get($data, 'input.registered_by_id', 0) == $id ? 'selected' : '' ?>
                                            <?= is_null($label) ? 'disabled' : '' ?>
                                        >
                                            <?= is_null($label) ? '---' : $label ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">備考</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <textarea class="textarea" name="remarks" cols="30" rows="3"><?= \Model\Arr::get($data, 'input.remarks', '') ?></textarea>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                    </div>
                    <div class="field-body">
                        <div class="field is-grouped">
                            <p class="control">
                                <button class="button is-primary">登録内容確認</button>
                            </p>
                            <p class="control">
                                <a class="button is-light" href="<?= \Model\Uri::make('admin/menu') ?>">キャンセル</a>
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>