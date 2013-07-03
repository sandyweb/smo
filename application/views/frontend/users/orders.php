<div class="order_list">
    <h4>Unpaid Orders</h4>
    <table class="order-list-table">
        <thead>
            <tr>
                <th><?=__('Date');?></th>
                <th><?=__('Description');?></th>
                <th><?=__('Paid');?></th>
                <th><?=__('Status');?></th>
                <th><?=__('Pay');?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($unpaid_orders as $order):?>
                <tr data-order-id="<?=$order->id;?>">
                    <td><?=Date::to_datetime($order->created);?></td>
                    <td><?=$order->description;?></td>
                    <td>$<?=Inflector::cents2dollars($order->paid);?></td>
                    <td><?=__('Unpaid');?></td>
                    <td><button type="button" class="login-btn"><?=__('Pay');?></button></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>

<div class="order_list">
    <h4>Paid Orders</h4>
    <table class="order-list-table">
        <thead>
        <tr>
            <th><?=__('Date');?></th>
            <th><?=__('Description');?></th>
            <th><?=__('Paid');?></th>
            <th><?=__('Status');?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($paid_orders as $order):?>
            <tr data-order-id="<?=$order->id;?>">
                <td><?=Date::to_datetime($order->created);?></td>
                <td><?=$order->description;?></td>
                <td>$<?=Inflector::cents2dollars($order->paid);?></td>
                <td><?=__('Paid');?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>