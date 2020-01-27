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
        '1': [
        ],
        '2': [
            'os_id',
            'cpu_id',
            'ssd',
            'hdd_1_id',
            'hdd_2_id',
            'graphics_id',
            'memory_id',
            'has_drive',
            'insure_id',
            
        ],
        '3': [
            'os_id',
            'cpu_id',
            'ssd',
            'hdd_1_id',
            'hdd_2_id',
            'graphics_id',
            'memory_id',
            'has_drive',
            'login_name',
            'login_password',
        ]
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

            <form method="post" action="<?= \Model\Uri::make('admin/equipments/registconfirm') ?>">

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
                        <label class="label">区分け</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                            <div class="select">
                                <select class="select" name="classification_id">
                                    <?php foreach (\Model\Arr::get($data, 'select_list.classification', []) as $id => $label): ?>
                                        <option value="<?= $id ?>" 
                                            <?= \Model\Arr::get($data, 'input.classification_id', 0) == $id ? 'selected' : '' ?>
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
                        <label class="label">OS</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                            <div class="select">
                                <select class="select" name="os_id">
                                    <?php foreach (\Model\Arr::get($data, 'select_list.os', []) as $id => $label): ?>
                                        <option value="<?= $id ?>" 
                                            <?= \Model\Arr::get($data, 'input.os_id', 0) == $id ? 'selected' : '' ?>
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
                            <div class="select">
                                <select class="select" name="manufacturer_id">
                                    <?php foreach (\Model\Arr::get($data, 'select_list.manufacturer', []) as $id => $label): ?>
                                        <option value="<?= $id ?>" 
                                            <?= \Model\Arr::get($data, 'input.manufacturer_id', 0) == $id ? 'selected' : '' ?>
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
                                <input class="input" type="text" name="title" value="<?= \Model\Arr::get($data, 'input.title', '') ?>" >
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">CPU</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                            <div class="select">
                                <select class="select" name="cpu_id">
                                    <?php foreach (\Model\Arr::get($data, 'select_list.cpu', []) as $id => $label): ?>
                                        <option value="<?= $id ?>" 
                                            <?= \Model\Arr::get($data, 'input.cpu_id', 0) == $id ? 'selected' : '' ?>
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
                        <label class="label">SSD</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input class="input" type="text" name="ssd" value="<?= \Model\Arr::get($data, 'input.ssd', '') ?>" >
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">HDD1</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                            <div class="select">
                                <select class="select" name="hdd_1_id">
                                    <?php foreach (\Model\Arr::get($data, 'select_list.hdd', []) as $id => $label): ?>
                                        <option value="<?= $id ?>" 
                                            <?= \Model\Arr::get($data, 'input.hdd_1_id', 0) == $id ? 'selected' : '' ?>
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
                        <label class="label">HDD2</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                            <div class="select">
                                <select class="select" name="hdd_2_id">
                                    <?php foreach (\Model\Arr::get($data, 'select_list.hdd', []) as $id => $label): ?>
                                        <option value="<?= $id ?>" 
                                            <?= \Model\Arr::get($data, 'input.hdd_2_id', 0) == $id ? 'selected' : '' ?>
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
                        <label class="label">グラフィック</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                            <div class="select">
                                <select class="select" name="graphics_id">
                                    <?php foreach (\Model\Arr::get($data, 'select_list.graphics', []) as $id => $label): ?>
                                        <option value="<?= $id ?>" 
                                            <?= \Model\Arr::get($data, 'input.graphics_id', 0) == $id ? 'selected' : '' ?>
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
                        <label class="label">メモリ</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                            <div class="select">
                                <select class="select" name="memory_id">
                                    <?php foreach (\Model\Arr::get($data, 'select_list.memory', []) as $id => $label): ?>
                                        <option value="<?= $id ?>" 
                                            <?= \Model\Arr::get($data, 'input.memory_id', 0) == $id ? 'selected' : '' ?>
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
                        <label class="label">光学ドライブ</label>
                    </div>
                    <div class="field-body">
                        <div class="control">
                            <label class="radio">
                                <input type="radio" name="has_drive" value="1" required <?= \Model\Arr::get($data, 'input.has_drive') ? 'checked' : ''?> >
                                有
                            </label>
                            <label class="radio">
                                <input type="radio" name="has_drive" value="0" required <?= \Model\Arr::get($data, 'input.has_drive') === '0' ? 'checked' : ''?> >
                                無
                            </label>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">保証</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                            <div class="select">
                                <select class="select" name="insure_id">
                                    <?php foreach (\Model\Arr::get($data, 'select_list.insure', []) as $id => $label): ?>
                                        <option value="<?= $id ?>" 
                                            <?= \Model\Arr::get($data, 'input.insure_id', 0) == $id ? 'selected' : '' ?>
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
                        <label class="label">シリアル</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input class="input" type="text" name="serial" value="<?= \Model\Arr::get($data, 'input.serial', '') ?>" >
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">ログイン/PC名</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input class="input" type="text" name="login_name" value="<?= \Model\Arr::get($data, 'input.login_name', '') ?>" >
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">パスワード</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input class="input" type="text" name="login_password" value="<?= \Model\Arr::get($data, 'input.login_password', '') ?>" >
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
                        <label class="label">使用者</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <p class="control">
                                <input class="input" type="text" name="user_in_use" value="<?= \Model\Arr::get($data, 'input.user_in_use', '') ?>" >
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
