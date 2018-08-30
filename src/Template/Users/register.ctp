<div class="users form large-5 medium-8 columns content">
	
    <?= $this->Form->create('registerform', ['url' => ['action' => '/register'], 'id' => 'register_form']);?>

    <fieldset>
        <legend><?= __('Register') ?></legend>
			<?= $this->Form->control('name', ['placeholder' => 'Name', 'required' => true]); ?>
			<?= $this->Form->control('email', ['placeholder' => 'Password', 'required' => true]); ?>
			<?= $this->Form->control('password', ['type' => 'password', 'placeholder' => 'Password', 'required' => true]); ?>
			<?= $this->Form->input('confirm_password', ['type' => 'password', 'placeholder' => 'Confirm Password', 'required' => true]); ?>
    </fieldset>
    <?= $this->Form->button(__('Register'), ['type' => 'submit']) ?>
    <?= $this->Form->end() ?>
</div>

