<main>

    <section class="section">
        <div class="container">
            <?php if (isset($data['errors']) && is_array($data['errors'])): ?>
                <?php foreach ($data['errors'] as $message): ?>
                    <div>
                        <?= $message ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <form action="<?= \Model\Uri::make('admin/signin') ?>" method="post">
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">ログインID </label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input name="account" type="text" value="<?= $data['account'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label">
                        <label class="label">パスワード </label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input name="password" type="password">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label">
                        <!-- Left empty for spacing -->
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <button class="button is-primary" type="submit">認証</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>
