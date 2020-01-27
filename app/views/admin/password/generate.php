<script>
    document.addEventListener('DOMContentLoaded', function() {
        var copyButton = document.querySelector('.js-copyClipboard');
        var copyText = document.querySelector('.js-copyText');

        // 入力前画面ではDOMがないので、存在確認が必要
        if (copyButton && copyText) {
            copyButton.addEventListener('click', function() {

                copyText.select();

                var successed = document.execCommand('copy');

                if (successed) {
                    window.alert('コピーしました');
                } else {
                    window.alert('コピーに失敗しました');
                }
            });
        }
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

    <?php if ($data['generatedHash']): ?>
        <section class="section">
            <div class="container">
                <div class="box">
                    DBに下の文字列を登録してください

                    <div class="field has-addons">
                        <div class="control is-expanded">
                            <input class="input js-copyText" type="text" value="<?= $data['generatedHash'] ?>" readonly>
                        </div>
                        <div class="control">
                            <button class="button js-copyClipboard" type="button">クリップボードにコピー</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="section">
        <div class="container">
            <h5 class="title is-5">パスワード文字列の作成</h5>

            <form method="post" action="<?= \Model\Uri::make('admin/password/generate') ?>">
                <div class="field has-addons">
                    <div class="control">
                        <input class="input" type="text" name="password" placeholder="パスワードを入力" value="<?= $data['password'] ?>">
                    </div>
                    <div class="control">
                        <button type="submit" class="button is-primary">作成！</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>
