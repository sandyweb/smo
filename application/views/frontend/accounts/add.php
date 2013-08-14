<?=Form::open('accounts/add', array('method' => 'post'));?>
<div class="add-account-container">
    <div class="summary-account-price">
        <p><?=__('Total:');?><span class="account-price">$0.00</span></p>
        <?=Form::hidden('price', 0);?>
    </div>
    <h2><?=__('New Social Network');?></h2>
    <div class="clear"></div>
    <div class="account-type-container">
        <?php foreach($networks_types as $type):?>
            <?=Form::radio('account_type', $type->id, TRUE);?>
            <span><?=$type->title;?></span>
        <?php endforeach;?>
    </div>
    <div>
        <h5><?=__('Title:');?></h5>
        <?=Form::input('title', arr::get($form, 'title'), array("class"=>"input", "style"=>"width:340px; margin:5px 0 10px 0;"));?>
        <span class="error-message"><?php echo arr::get($errors, 'title');?></span>
    </div>
    <div>
        <h5><?=__('Description:');?></h5>
        <textarea name="description" class="input" style="width:340px; height:50px; margin:5px 0 10px 0;"></textarea>
    </div>
    <div class="clear"></div>
    <div class="account-type-view"></div>
    <div>
        <?=Form::submit('add_to_order', __('Add to order list'), array("class"=>"login-btn", "style"=>"height: 26px"));?>
        <?=Form::submit('purchase', __('Purchase'), array("class"=>"login-btn", "style"=>"height: 26px"));?>
        <?=Form::submit('save', __("Save"), array("class"=>"login-btn", "style"=>"height: 26px"));?>
    </div>
</div>
<?=Form::close();?>
