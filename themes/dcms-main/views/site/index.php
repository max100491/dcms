<div class="home">
    <?php if($model->pages): ?>
        <h1><?php echo $model->pages[0]->name_page; ?></h1>
        <?php echo $model->pages[0]->text_page; ?>
    <?php else: ?>
        <p>Сайт находится в разработке</p>
    <?php endif; ?>
</div>