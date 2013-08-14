<div class="logo_wrapper">
    <div class="logo">
        <?php echo HTML::image('files/template/frontend/logo.png');?>
    </div>
</div>
<div class="menu">
    <ul>	
        <li>
            <span <?php echo (($action == "index" || $action == "account_edit") && $controller == "Users") ? "class=\"active\"" : "";?>>
                <?php echo HTML::anchor('users/index', __("Projects"));?>
            </span>
        </li>
        <li><span <?php echo ($controller == "Inbox") ? "class=\"active\"" : "";?>>
                <?php echo HTML::anchor('inbox/index', __("inbox"));?>
                (<?=$unread_messages_count;?>)
            </span>
        </li>
        <li>
            <span <?php echo ($action == "settings" && $controller == "Users") ? "class=\"active\"" : "";?>>
                <?php echo HTML::anchor('users/settings', __("Settings"));?>
            </span>
        </li>
    </ul>
</div>
<div class="user_info">
    <?php echo $user->email;?>
    <?php echo HTML::anchor('users/index', HTML::image('files/template/frontend/home_icon_small.png'));?>
    <?php echo HTML::anchor('auth/logout', HTML::image('files/template/frontend/logout_icon_small.png'));?>
</div>