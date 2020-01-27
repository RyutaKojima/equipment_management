<script>
    setTimeout(function(){
        window.location.href = '<?= \Model\Uri::make('admin/menu') ?>';
    }, 5*1000);
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
            <h5 class="title is-5">登録しました</h5>

            <p>５秒後に自動でメニューに戻ります</p>
        </div>
    </section>
</main>
