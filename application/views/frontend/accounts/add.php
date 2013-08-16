<?=Form::hidden('base_price', $base_price);?>
<?=Form::open('accounts/add', array('method' => 'post', 'id' => 'add-account'));?>
<div class="add-account-container">
    <div class="summary-account-price">
        <p><?=__('Total:');?><span class="account-price">$<?=Inflector::cents2dollars($base_price);?></span></p>
        <?=Form::hidden('price', $base_price);?>
    </div>
    <h2><?=__('New Social Network');?></h2>
    <div class="clear"></div>
    <div class="account-type-container">
        <?php foreach($networks_types as $type):?>
            <?=Form::radio('account_type', $type->id, ($type->id == $account_type));?>
            <span><?=$type->title;?></span>
        <?php endforeach;?>
    </div>
    <div class="account-type-view"></div>
    <div>
        <?=Form::submit('add_to_order', __('Add to order list'), array('class' => 'login-btn disabled', 'disabled' => 'disabled'));?>
        <?=Form::submit('purchase', __('Purchase'), array('class' => 'login-btn disabled', 'disabled' => 'disabled'));?>
        <?=Form::submit('save', __("Save"), array('class' => 'login-btn disabled', 'disabled' => 'disabled'));?>
    </div>
</div>
<?=Form::close();?>
