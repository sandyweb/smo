<?=Form::open(URL::site($action, array('method' => 'post')));?>
<?=Form::hidden('message[sender_id]', $message['sender_id']);?>
    <div class="message-details-container">
        <div>
            <h5><?=__('Client');?></h5>
            <span><?=Form::select('message[receiver_id]', $clients);?></span>
        </div>
        <div>
            <h5><?=__('Subject');?></h5>
            <span><?=Form::input('message[subject]', '', array("class"=>"input"));?></span>
        </div>
        <div class="clear"></div>
        <div>
            <h5><?=__('Message');?></h5>
            <span><?=Form::textarea('message[message]', '', array("class"=>"input"));?></span>
        </div>
        <div class="clear"></div>
        <div>
            <?=Form::submit('send-answer', __('Send'), array('class' => 'login-btn'));?>
        </div>
    </div>
<?=Form::close();?>