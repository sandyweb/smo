<div class="bar_tab">    
    <div class="bar_tab_head">
        <a href="#">
            <?php echo HTML::image('files/template/frontend/icon_select_account.png');?>
        </a>
        <span>Personal Account</span>
        <div class="clear"></div>
    </div>
    <div class="bar_tab_body">
        <h4>Social networks</h4>
        
        <?php if (count($social_networks)>0):?>
        <ul class="filter_box">
            <li <?php echo ($social_id == NULL) ? "class=\"active\"" : "";?>>
                <?php echo HTML::anchor('users/index', "<span>All</span>");?>
            </li>
            <?php foreach ($social_networks as $item):?>
                <li <?php echo ($item->id == $social_id) ? "class=\"active\"" : "";?>>
                    <?php echo HTML::anchor('users/index/'.$item->id, "<span>".$item->title."</span>");?>
                </li>
            <?php endforeach;?>
        </ul>
        <?php endif;?>
    </div>
    <div class="bar_tab_body">
        <h4>Order List</h4>
        <ul class="filter_box">
            <li <?=(Request::current()->uri() == 'users/orders') ? 'class="active"' : '';?>>
                <?=HTML::anchor('users/orders/', '<span>My Invoices</span>');?>
            </li>
        </ul>
    </div>
</div>