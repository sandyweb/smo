<div class="login">
    <div class="logo"><?php // echo HTML::image("files/template/frontend/logo.png");?></div>
    <div class="login_wrapper">
        <?php echo Form::open();?>
            <?php if($errors):?>
                <ul class="error">
                    <?php foreach($errors as $message):?>
                        <li><?=$message;?></li>
                    <?php endforeach;?>
                </ul>
            <?php endif;?>
            <?php echo Form::input("email", arr::get($form, 'email'), array("placeholder"=>"Email", "class"=>"input"));?>
            <?php // if (isset(arr::get($errors, 'email'))):?>
                <span class="redmessage"><?php echo arr::get($errors, 'email');?></span>
            <?php // endif;?>
                
            <?php echo Form::input("username", arr::get($form, 'username'), array("placeholder"=>"First name", "class"=>"input"));?>
            <?php // if (isset(arr::get($errors, 'firstname'))):?>
                <span class="redmessage"><?php echo arr::get($errors, 'username');?></span>
            <?php // endif;?>
                
            <?php echo Form::input("lastname", arr::get($form, 'lastname'), array("placeholder"=>"Last name", "class"=>"input"));?>
            <?php // if (isset(arr::get($errors, 'lastname'))):?>
                <span class="redmessage"><?php echo arr::get($errors, 'lastname');?></span>
            <?php // endif;?>
                
            <?php echo Form::password("password", NULL, array("placeholder"=>"Password", "class"=>"input"));?>
            <?php // if (isset(arr::get($errors, 'password'))):?>
                <span class="redmessage"><?php echo arr::get($errors, 'password');?></span>
            <?php // endif;?>
                
            <?php echo Form::password("password_confirm", NULL, array("placeholder"=>"Confirm password", "class"=>"input"));?>
            <?php // if (isset(arr::get($errors, 'password_confirm'))):?>
                <span class="redmessage"><?php echo arr::get($errors, 'password_confirm');?></span>
            <?php // endif;?>
                
            <?php echo Form::submit("register", __("REGISTER"), array("class"=>"login-btn", "style"=>"height: 26px"));?>

            <div class="actions_login">
                <?php echo HTML::anchor('auth/restorePassword', __("Forgot password ?"), array("title"=>"Forgot password"));?>
                <?php echo HTML::anchor('main/index', __("Home page"), array("title"=>"Learn More..."));?>
            </div>
        <?php echo Form::close();?>
    </div>
</div>