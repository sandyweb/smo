<div class="user_prof">
    <h4><span>Message</span></h4>
    <div class="clear"></div>
    <div class="message-details-container">
        <ul>
            <li>
                <label>Subject:</label>
                <span><?=$message->subject;?></span>
                <div class="clear"></div>
            </li>
            <li>
                <label>Sent:</label>
                <span><?=Date::to_datetime($message->created);?></span>
                <div class="clear"></div>
            </li>
            <li>
                <label>Receiver:</label>
                <span><?=$message->receiver->email;?></span>
                <div class="clear"></div>
            </li>
            <li>
                <label>Message:</label>
                <span><?=$message->message;?></span>
                <div class="clear"></div>
            </li>
        </ul>
    </div>
</div>