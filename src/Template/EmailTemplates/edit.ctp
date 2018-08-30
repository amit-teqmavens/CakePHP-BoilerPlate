<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EmailTemplate $emailTemplate
 */
?>
<?= $this->element('left_nav'); ?>
<div class="emailTemplates form large-10 medium-8 columns content">
    <?= $this->Form->create($emailTemplate) ?>
    <fieldset>
        <legend><?= __('Edit Email Template') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('subject');
            echo $this->Form->control('content');
            echo $this->Form->control('code', ['disabled' => 'disabled']); 
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Save')) ?>
    <?= $this->Form->end() ?>
</div>
