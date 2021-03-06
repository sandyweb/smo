<?=Form::open(URL::site($action), array('enctype' => 'multipart/form-data'));?>
<div class="user_prof">
    <h4><span>User Profile</span></h4>
    <div class="clear"></div>
    <?php if($user->image):?>
        <div class="avatar">
            <?=HTML::image('files/media/avatars/'.$user->image);?>
        </div>
    <?php endif;?>
    <div class="error-message"><?=arr::get($errors, 'validation');?></div>
    <?php if($message):?>
        <div class="success-message"><?=$message;?></div>
    <?php endif;?>
    <div style="padding:30px 20px 20px 20px;">
        <ul>
            <li>
                <label>Email</label>
                <span><?=Form::input('email', $user->email, array("class"=>"input"));?></span>
                <div class="clear"></div>
            </li>
            <li>
                <label>First Name</label>
                <span><?=Form::input('username', $user->username, array("class"=>"input"));?></span>
                <div class="clear"></div>
            </li>
            <li>
                <label>Last Name</label>
                <span><?=Form::input('lastname', $user->lastname, array("class"=>"input"));?></span>
                <div class="clear"></div>
            </li>
            <li>
                <label>Password</label>
                <span><?=Form::password('password', NULL, array("class"=>"input"));?></span>
                <div class="clear"></div>
            </li>
            <li>
                <label>Confirm Password</label>
                <span><?=Form::password('password_confirm', NULL, array("class"=>"input"));?></span>
                <div class="clear"></div>
            </li>
            <li><label>Profile Picture</label></li>
            <li>
                <?=Form::file('profile_photo');?>
                <label><em>Recommended 200 x 200px .jpeg .png or .gif</em></label>
            </li>
        </ul>
    </div>
    <div class="clear"></div>
</div>
<div class="user_prof">
    <h4><span>Contact Information</span></h4>
    <div class="clear"></div>
    <div style="padding:30px 20px 20px 20px;">
        <ul>
            <li>
                <label>Enter your mobile number<br/>
                    <em>Example: 555-666-777</em>
                </label>
                <span><?=Form::input('mobile_phone', $user->mobile_phone, array("class"=>"input"));?></span>
                <div class="clear"></div>
            </li>
            <li>
                <label>Select your mobile service provider</label>
                <?php $providers = array(0 => '-Select-');?>
                <span><?=Form::select('mobile_provider', $providers, $user->provider_id, array('class' => 'input'));?></span>
                <div class="clear"></div>
            </li>
        </ul>
    </div>
    <div class="clear"></div>
</div>
    <div class="user_prof">
        <h4><span>Email Settings</span></h4>
        <div class="clear"></div>
        <div style="padding:30px 20px 20px 20px;">
            <ul>
                <li>
                    <label>Use this format for emails sent to me</label>
                    <?php $formats = array('html' => 'html');?>
                    <span><?=Form::select('email_format', $formats, $user->email_format, array('class' => 'input'));?></span>
                    <div class="clear"></div>
                </li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
<?=Form::submit('save', __("Save"), array("class"=>"login-btn", "style"=>"height: 26px"));?>
<?=Form::close();?>