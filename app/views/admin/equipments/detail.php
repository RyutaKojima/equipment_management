<style>
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
            <h5 class="title is-5">機材詳細</h5>

            <?= $data['equipment']->get('title'); ?>
        </div>
    </section>
</main>
