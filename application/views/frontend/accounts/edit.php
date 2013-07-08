<h2>Social Network: <?=$account->title;?></h2>
<div>
    <input type="hidden" name="account_id" value="<?=$account->id;?>" />
    <h5>Title : </h5>
    <?=Form::input('title', $account->title, array("class"=>"input", "style"=>"width:340px; margin:5px 0 5px 0;"));?>
    <br/>
    <h5><?php echo __("Network type");?></h5>
    <?php if (count($networks_types)>0):?>
        <select name="type">
            <?php foreach($networks_types as $type):?>
                <?php $selected = ($account->accounts_types_id == $type->id) ? "selected" : "";?>
                <option <?=$selected;?> value="<?=$type->id;?>"><?=$type->title;?></option>
            <?php endforeach;?>
        </select>
    <?php endif;?>
    <h5>Description : </h5>
    <textarea name="description" class="input" style="width:340px; height:50px; margin:5px 0 5px 0"><?=$account->description;?></textarea>
    <br/>
    <span>
        <?=Form::button('add_to_order_btn', 'Add to order list', array("class"=>"login-btn", "style"=>"height: 26px", "id"=>"add_to_order_btn"));?>
        <?=Form::button('purchase_btn', 'Purchase', array("class"=>"login-btn", "style"=>"height: 26px", "id"=>"purchase_btn"));?>
    </span>
    <br/>
    <?php echo Form::button('save', __("Save"), array("class"=>"login-btn", "style"=>"height: 26px", "id"=>"update_account_btn"));?>
</div>