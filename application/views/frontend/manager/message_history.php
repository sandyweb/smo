<div class="message-list-container">
    <?php foreach($messages as $message):?>
        <?php $class = ($sender == $message->sender_id) ? 'manager' : 'client';?>
        <div class="message-container <?=$class;?>">
            <div class="left-subcontainer">
                <div class="message-user-avatar">
                    <?php $image = $message->sender->image;?>
                    <?php if(!$image):?>
                        <?=HTML::image('files/template/frontend/pm-icon.png');?>
                    <?php else :?>
                        <?=HTML::image('files/media/avatars/'.$image);?>
                    <?php endif;?>
                </div>
                <p><?=Date::to_datetime($message->created);?></p>
            </div>
            <div class="right-subcontainer">
                <h4><?=$message->subject;?></h4>
                <p><?=$message->message;?></p>
            </div>
            <div class="both">
                <p><?=HTML::anchor(URL::site('manager/outbox_view/'.$message->id), __('Details'));?></p>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    <?php endforeach;?>
    <div class="pagination-container"><?=$pagination;?></div>
</div>