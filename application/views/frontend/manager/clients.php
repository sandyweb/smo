<table id="clients-list-table">
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