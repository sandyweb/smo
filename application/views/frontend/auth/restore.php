<?php if (isset($errors)):?>
<script>
    $(document).ready(function(){
        shakeLogin();
    });
</script>
<?php endif;?>
<div class="login">
    <div class="logo"></div>
    <div class="login_wrapper">
        <?=Form::open();?>
            <span class="error-message"><?=arr::get($errors, 'email');?></span>
            <?=Form::input("email", arr::get($form, 'email'), array("placeholder"=>"Email", "class"=>"input"));?>
            <?=Form::submit("restore", __("Send Password"), array("class"=>"login-btn", "style"=>"height: 26px"));?>
            <div class="actions_login">
                <?=HTML::anchor('auth/login', __("Login"), array("title"=>"Login"));?>
                <?=HTML::anchor(URL::base(), __("Home page"), array("title"=>"Learn More..."));?>
            </div>
        <?=Form::close();?>
    </div>
</div>