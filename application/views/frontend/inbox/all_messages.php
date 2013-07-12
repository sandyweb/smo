<table id="message-list-table">
    <thead>
        <tr>
            <td>Date</td>
            <td>Sender</td>
            <td>Subject</td>
            <td>Status</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($messages as $message):?>
            <tr>
                <td><?=Date::to_datetime($message->created);?></td>
                <td><?=$message->sender->email;?></td>
                <td><?=$message->subject;?></td>
                <td><?=$statuses[$message->status];?></td>
                <td><?=HTML::anchor(URL::site($action_url.$message->id), __('Read'));?></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>
<script>
    $(document).ready(function(){
        $('#message-list-table').dataTable();
    });
</script>