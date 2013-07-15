<table id="message-list-table">
    <thead>
    <tr>
        <td>Date</td>
        <td>Receiver</td>
        <td>Subject</td>
        <td></td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($messages as $message):?>
        <tr>
            <td><?=Date::to_datetime($message->created);?></td>
            <td><?=$message->receiver->email;?></td>
            <td><?=$message->subject;?></td>
            <td><?=HTML::anchor(URL::site($action_url.$message->id), __('Details'));?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
<script>
    $(document).ready(function(){
        $('#message-list-table').dataTable();
    });
</script>