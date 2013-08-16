<div id="answer-container" class="user_prof">
    <h4><span>Answer to <?=$message->sender->email;?></span></h4>
    <div class="clear"></div>
    <?=Form::open(URL::site($action, array('method' => 'post')));?>
        <?=Form::hidden('message[sender_id]', $message->receiver_id);?>
        <?=Form::hidden('message[receiver_id]', $message->sender_id);?>
        <div class="message-details-container">
            <ul>
                <li>
                    <label>Subject:</label>
                    <span><?=Form::input('message[subject]', 'RE: '.$message->subject, array("class"=>"input"));?></span>
                    <div class="clear"></div>
                </li>
                <li>
                    <label>Message:</label>
                    <span><?=Form::textarea('message[message]', '', array("class"=>"input"));?></span>
                    <div class="clear"></div>
                </li>
                <li>
                    <?=Form::submit('send-answer', __('Send'), array('class' => 'login-btn'));?>
                </li>
            </ul>
        </div>
    <?=Form::close();?>
</div>
<?=HTML::script(URL::base().'js/frontend/inbox.js');?>