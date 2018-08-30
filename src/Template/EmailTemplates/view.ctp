<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EmailTemplate $emailTemplate
 */
?>
<?= $this->element('left_nav'); ?>
<div class="emailTemplates view large-10 medium-8 columns content">
    <h3><?= h($emailTemplate->title) ?></h3> 

    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= $this->Html->link($emailTemplate->title, ['action' => 'edit', $emailTemplate->id]) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= h($emailTemplate->subject) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Code') ?></th>
            <td><?= h($emailTemplate->code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?php if($emailTemplate->status == '1') echo "Active"; else echo "Inactive" ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($emailTemplate->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Content') ?></h4>
        <?= html_entity_decode($emailTemplate->content); ?>
    </div>
</div>
