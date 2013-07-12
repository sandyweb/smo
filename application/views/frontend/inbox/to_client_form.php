<div>
    <?=Form::open(URL::site($action, array('method' => 'post')));?>
    <?=Form::hidden('message[sender_id]', $message['sender_id']);?>
    <div class="message-details-container">
        <ul>
            <li>
                <label>Client:</label>
                <span><?=Form::select('message[receiver_id]', $clients);?></span>
            </li>
            <li>
                <label>Subject:</label>
                <span><?=Form::input('message[subject]', '', array("class"=>"input"));?></span>
                <div class="clear"></div>
            </li>
            <li>
                <label>Message:</label>
                <span><?=Form::textarea('message[message]', '', array("class"=>"input", "rows" => 5));?></span>
                <div class="clear"></div>
            </li>
            <li>
                <?=Form::submit('send-answer', __('Send'), array('class' => 'login-btn'));?>
            </li>
        </ul>
    </div>
    <?=Form::close();?>
</div>