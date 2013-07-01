<?php if (isset($errors)):?>
<script>
    $(document).ready(function(){
        shakeLogin();
    });
</script>
<?php endif;?>

<div class="login">
    <div class="logo"><?php // echo HTML::image("files/template/frontend/logo.png");?></div>
    <div class="login_wrapper">
        <?php echo Form::open();?>

            <?php echo Form::input("email", arr::get($form, 'email'), array("placeholder"=>"Email", "class"=>"input"));?>
        
            <?php // if (isset(arr::get($errors, 'email'))):?>
                <span class="redmessage"><?php echo arr::get($errors, 'email');?></span>
            <?php // endif;?>
            
            <?php echo Form::submit("restore", __("SEND PASSWORD"), array("class"=>"login-btn", "style"=>"height: 26px"));?>
            
            <div class="actions_login">
                <?php echo HTML::anchor('auth/login', __("Login"), array("title"=>"Login"));?>
                <?php echo HTML::anchor('main/index', __("Home page"), array("title"=>"Learn More..."));?>
            </div>

        <?php echo Form::close();?>
    </div>
</div>