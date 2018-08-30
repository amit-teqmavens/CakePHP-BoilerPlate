<!-- File: src/Template/Articles/edit.ctp -->
<?= $this->element('left_nav'); ?>
<div class="users form large-10 medium-8 columns content">
    <?= $this->Form->create($article) ?>
    <fieldset>
        <legend><?= __('Edit Article') ?></legend>
        <?php
		    echo $this->Form->create($article);
		    echo $this->Form->control('title');
		    echo $this->Form->control('body', ['rows' => '3']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Save Article')) ?>
    <?= $this->Form->end() ?>
</div>
