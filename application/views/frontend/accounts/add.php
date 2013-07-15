<!--<div class="add-account-container">-->
<!--    <h2>New Social Network</h2>-->
<!--    <div class="account-type-container">-->
<!--        --><?php //foreach($networks_types as $type):?>
<!--            --><?//=Form::radio('account_type', $type->id, TRUE);?>
<!--            <span>--><?//=$type->title;?><!--</span>-->
<!--        --><?php //endforeach;?>
<!--    </div>-->
<!--</div>-->

<div>
    <h5>Title : </h5>
    <?php echo Form::input('title', arr::get($form, 'title'), array("class"=>"input", "style"=>"width:340px; margin:5px 0 10px 0;"));?>
    <span class="redmessage"><?php echo arr::get($errors, 'title');?></span>
    <br/>
    <h5><?php echo __("Network type");?></h5>
    <?php if (count($networks_types)>0):?>
        <select name="type">
            <?php foreach ($networks_types as $type):?>
                <option value="<?php echo $type->id;?>"><?php echo $type->title;?></option>
            <?php endforeach;?>
        </select>
    <?php endif;?>
    <h5>Description : </h5>
    <textarea name="description" class="input" style="width:340px; height:50px; margin:5px 0 10px 0;"><?php echo arr::get($form, 'description');?></textarea>
    <br/>
    <span>
        <?=Form::button('add_to_order_btn', 'Add to order list', array("class"=>"login-btn", "style"=>"height: 26px", "id"=>"add_to_order_btn"));?>
        <?=Form::button('purchase_btn', 'Purchase', array("class"=>"login-btn", "style"=>"height: 26px", "id"=>"purchase_btn"));?>
    </span>
    <br/>
    <?php echo Form::button('save', __("Save"), array("class"=>"login-btn", "style"=>"height: 26px", "id"=>"save_account"));?>
</div>
