<?php if(!empty($expired_accounts)):?>
    <div class="notification">
        <h4>Some clients has expired accounts</h4>
        <?php foreach($expired_accounts as $account):?>
            <p>
                <?=__('Client').': '.$account->users->email.' '.
                __('Title').': '.$account->title.' '.
                __('Cost').': $'.Inflector::string2cents($account->cost).' '.
                __('Expiration Date').': '.Date::to_datetime($account->expiration);?>
            </p>
        <?php endforeach;?>
    </div>
<?php endif;?>
<table id="clients-list-table" class="table">
    <thead>
        <tr>
            <th><?=__('Name');?></th>
            <th><?=__('Last Name');?></th>
            <th><?=__('Email');?></th>
            <th><?=__('Last Active');?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($clients as $client):?>
            <tr>
                <td><?=$client->user->username;?></td>
                <td><?=$client->user->lastname;?></td>
                <td><?=$client->user->email;?></td>
                <td><?=Date::to_datetime($client->user->last_login);?></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>
<script>
    $(document).ready(function(){
        $('#clients-list-table').dataTable({
            iDisplayLength: 20,
            bFilter: false,
            bInfo: false,
            bLengthChange: false,
            bPaginate: 'full_numbers'
        });
    });
</script>