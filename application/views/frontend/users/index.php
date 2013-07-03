<div class="personal_data">
    <div class="avatar">
        <?php if ($user->image == NULL):?>
            <?php echo HTML::image('files/template/frontend/pm-icon.png');?>
        <?php else :?>
            <?php echo HTML::image('files/media/avatars/'.$user->image);?>
        <?php endif;?>
    </div>
    
    <div class="personal_info">
        <h1><?php echo $user->email;?>'s Projects</h1>
        <p>Personal Account</p>
    </div>

    <div class="clear"></div>
</div>

<div class="social_data">
    <div class="function">
        <?php // echo HTML::anchor('accounts/add', __("Add account"));?>
        <span id="add_account"><?php echo __("Add account");?></span>
    </div>

    <div class="social_accounts">
        <?php if (count($accounts)):?>
            <table id='accounts' style='width:100%;'>
                <thead>
                    <tr>
                        <th><?php echo __("ID");?></th>
                        <th><?php echo __("Title");?></th>
                        <th><?php echo __("Description");?></th>
                        <th><?php echo __("Actions");?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($accounts as $item):?>
                        <tr>
                            <td>
                                <input type="hidden" name="account_id" value="<?php echo $item->id;?>" />
                                <?php echo $item->id;?>
                            </td>
                            <td><?php echo $item->title;?></td>
                            <td><?php echo $item->description;?></td>
                            <td>
                                <?php echo HTML::anchor('users/account_edit/'.$item->id, __("Edit"));?>
                                <?php echo HTML::anchor('accounts/delete/'.$item->id, __("Delete"));?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        <?php endif;?>
    </div>
</div>

<div id="add_account">
    
</div>