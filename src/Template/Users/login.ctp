<?php //code for setting variables based on set cookie
    if(isset($remembered_data)){
        $email = $remembered_data['email'];
        $password = $remembered_data['password'];
        $checkedvalue = 'checked';
    }else{ 
        $password = $email = ''; 
        $checkedvalue = '';
    } 
?>
<div class="users form large-5 medium-8 columns content">
    <?= $this->Form->create('loginform', ['url' => ['action' => '/login'], 'id' => 'login_form']);?>
    <fieldset>
        <legend><?= __('Login') ?></legend>
            <?= $this->Form->control('email', ['placeholder' => 'Email','value' =>@$email, 'required' => true]); ?>
            <?= $this->Form->control('password', ['type' => 'password','value' =>@$password, 'placeholder' => 'Password', 'required' => true]); ?>
            <?= $this->Form->checkbox('remember_me', ['hiddenField' => false, 'value' => 1, 'checked' => $checkedvalue ]); ?>
            <label>Remember Me</label>
    </fieldset>
    <?= $this->Form->button(__('Login'), ['type' => 'submit']) ?>
    <?= $this->Form->end() ?>
</div>

