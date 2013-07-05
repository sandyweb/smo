<table>
    <thead>
        <tr>
            <td></td>
            <td>Date</td>
            <td>Sender</td>
            <td>Subject</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($messages as $message):?>
            <tr>
                <td></td>
                <td><?=Date::to_datetime($message->created);?></td>
                <td><?=$message->sender->email;?></td>
                <td><?=$message->subject;?></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>
<script>
    $(document).ready(function(){

    });
</script>