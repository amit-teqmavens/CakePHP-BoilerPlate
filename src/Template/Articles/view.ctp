<!-- File: src/Template/Articles/view.ctp -->
<?= $this->element('left_nav'); ?>
<div class="users index large-10 medium-8 columns content">
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($article->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($article->body) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($article->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($article->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"></th>
            <td><?= $this->Html->link('Edit', ['action' => 'edit', $article->slug]) ?></td>
        </tr>
    </table>
</div>
