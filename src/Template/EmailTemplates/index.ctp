<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EmailTemplate[]|\Cake\Collection\CollectionInterface $emailTemplates
 */
?>
<?= $this->element('left_nav'); ?>
<div class="emailTemplates index large-10 medium-8 columns content">
    <h3><?= __('Email Templates') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subject') ?></th>
                <th scope="col"><?= $this->Paginator->sort('code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($emailTemplates)>0) {
                foreach ($emailTemplates as $emailTemplate): ?>
            <tr>
                <td><?= $this->Number->format($emailTemplate->id) ?></td>
                <td><?= h($emailTemplate->title) ?></td>
                <td><?= h($emailTemplate->subject) ?></td>
                <td><?= h($emailTemplate->code) ?></td>
                <td><?= h($emailTemplate->created) ?></td>
                <td><?= $this->Number->format($emailTemplate->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $emailTemplate->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $emailTemplate->id]) ?>
                </td>
            </tr>
            <?php endforeach; 
            } else { ?>
                        <tr>
                            <td><?= __('No records found') ?></td>
                        </tr>
                <?php 
                }?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
