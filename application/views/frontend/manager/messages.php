<?=Form::hidden('action_url', $action_url);?>
    <div class="inbox-container">
        <div class="header">
            <div class="menu">
                <ul>
                    <li>
                        <span class="active"><?=HTML::anchor('#', __("Messages"), array('class' => 'all-messages'));?></span>
                        <span><?=HTML::anchor('#', __("Unread"), array('class' => 'unread-messages'));?></span>
                        <span><?=HTML::anchor('#', __("Read"), array('class' => 'read-messages'));?> </span>
                        <span><?=HTML::anchor('#', __("Archived"), array('class' => 'archived-messages'));?> </span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="additional"><?=$additional;?></div>
        <div>
            <?=Form::select('client', $clients);?>
        </div>
        <div class="messages-container"></div>
    </div>
<?=HTML::script(URL::base().'js/frontend/inbox.js');?>