<div class="logo_wrapper">
    <div class="logo">
        <?php echo HTML::image('files/template/frontend/logo.png');?>
    </div>
</div>
<div class="menu">
    <ul>
        <li>
            <span <?php echo ($action == "index") ? "class=\"active\"" : "";?>>
                <?php echo HTML::anchor('manager/index', __("Clients"));?>
            </span>
        </li>
        <li>
            <span <?php echo ($action == "inbox") ? "class=\"active\"" : "";?>>
                <?php echo HTML::anchor('manager/inbox', __("Messages"));?>
                (<?=$unread_messages_count;?>)
            </span>
        </li>
        <li>
            <span <?php echo ($action == "settings") ? "class=\"active\"" : "";?>>
                <?php echo HTML::anchor('manager/settings', __("Settings"));?>
            </span>
        </li>
    </ul>
</div>
<div class="user_info">
    <?php echo $user->email;?>
    <?php echo HTML::anchor('main/index', HTML::image('files/template/frontend/home_icon_small.png'));?>
    <?php echo HTML::anchor('auth/logout', HTML::image('files/template/frontend/logout_icon_small.png'));?>
</div>