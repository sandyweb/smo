<table id="message-history-table">
    <thead>
    <tr>
        <td></td>
        <td>Date</td>
        <td>Subject</td>
        <td>Status</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($messages as $message):?>
        <tr>
            <?php if($sender == $message->sender_id):?>
                <td>Manager:</td>
            <?php else:?>
                <td>Client:</td>
            <?php endif;?>
            <td><?=Date::to_datetime($message->created);?></td>
            <td><?=$message->subject;?></td>
            <td><?=HTML::anchor(URL::site('manager/outbox_view/'.$message->id), __('Details'));?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
<script>
    $(document).ready(function(){
        $('#message-history-table').dataTable({
            iDisplayLength: 20,
            bFilter: false,
            bInfo: false,
            bLengthChange: false,
            bSort: false
        });
    });
</script>