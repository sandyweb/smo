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
            <span class="error-message"><?=arr::get($errors, 'auth');?></span>
            <span class="error-message"><?=arr::get($errors, 'validation');?></span>
            <?=Form::input("email", arr::get($form, 'email'), array("placeholder"=>"Email", "class"=>"input"));?>
            <?=Form::password("password", NULL, array("class"=>"input", "placeholder"=>"Password"));?>
            <?=Form::submit("login", __("Login"), array("class"=>"login-btn", "style"=>"height: 26px"));?>
            <div class="actions_login">
                <?=HTML::anchor('auth/restorePassword', __("Forgot password ?"), array("title"=>"Forgot password"));?>
                <?=HTML::anchor(URL::base(), __("Home page"), array("title"=>"Learn More..."));?>
            </div>
        <?=Form::close();?>
    </div>
</div>