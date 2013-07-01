<h2>New Social Network</h2>
<div>
    <input type="hidden" name="account_id" value="<?php echo $account->id;?>" />
    <h5>Title : </h5>
    <?php echo Form::input('title', $account->title, array("class"=>"input", "style"=>"width:340px; margin:5px 0 5px 0;"));?>
    <span class="redmessage"><?php echo arr::get($errors, 'title');?></span>
    <br/>
    <h5><?php echo __("Network type");?></h5>
    <?php if (count($networks_types)>0):?>
        <select name="type">
            <?php foreach ($networks_types as $type):?>
                <?php $selected = ($account->accounts_types_id == $type->id) ? "selected" : "";?>
                <option <?php echo $selected;?> value="<?php echo $type->id;?>"><?php echo $type->title;?></option>
            <?php endforeach;?>
        </select>
    <?php endif;?>
    <h5>Description : </h5>
    <textarea name="description" class="input" style="width:340px; height:50px; margin:5px 0 5px 0"><?php echo $account->description;?></textarea>
    <br/>
    <?php echo Form::button('save', __("Save"), array("class"=>"login-btn", "style"=>"height: 26px", "id"=>"update_account"));?>
</div>