<div class="message-list-container all">
    <?php foreach($messages as $message):?>
        <div class="message-container client">
            <div class="left-subcontainer">
                <div class="message-user-avatar">
                    <?php $image = $message->sender->image;?>
                    <?php if(!$image):?>
                        <?=HTML::image('files/template/frontend/pm-icon.png');?>
                    <?php else:?>
                        <?=HTML::image('files/media/avatars/'.$image);?>
                    <?php endif;?>
                </div>
                <p><?=Date::to_datetime($message->created);?></p>
            </div>
            <div class="right-subcontainer">
                <h4><?=$message->subject;?></h4>
                <p><?=$statuses[$message->status];?></p>
                <p><?=$message->message;?></p>
            </div>
            <div class="both">
                <p><?=HTML::anchor(URL::site($action_url.$message->id), __('Details'));?></p>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    <?php endforeach;?>
    <div class="pagination-container"><?=$pagination;?></div>
</div>