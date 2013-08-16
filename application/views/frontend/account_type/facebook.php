<div class="fb-container">
    <div>
        <h5><?=__('Title:');?></h5>
        <?=Form::input('title', '', array("class"=>"input", "style"=>"width:340px; margin:5px 0 10px 0;"));?>
    </div>
    <div class="clear"></div>
    <div class="options-container">
        <?=Form::radio('description_type', 1, TRUE);?>
        <span><?=__('Existing social page');?></span>
        <?=Form::radio('description_type', 2, FALSE);?>
        <span><?=__('Create new social page');?></span>
        <div>
            <h5><?=__('Description:');?></h5>
            <textarea name="description" class="input textarea">Please, input account details to your social network, like Email, Login, Passwords, etc.</textarea>
        </div>
    </div>
    <div class="clear"></div>
    <div class="options-container">
        <h4><?=__('Page Posting');?></h4>
        <?php foreach($posting_range as $range):?>
            <?php $selected = ($range->id == $default_posting_range) ? TRUE : FALSE;?>
            <?=Form::radio('posting_range', $range->id, $selected, array('data-price' => $range->price));?>
            <span><?=$range->name;?></span>
        <?php endforeach;?>
        <?=Form::input('posting_range_custom', '', array('class="input span2 hide"'));?>
    </div>
    <div class="options-container">
        <h4><?=__('Comments Posting');?></h4>
        <?php foreach($comments_range as $range):?>
            <?php $selected = ($range->id == $default_comments_range) ? TRUE : FALSE;?>
            <?=Form::radio('comments_range', $range->id, $selected, array('data-price' => $range->price));?>
            <span><?=$range->name;?></span>
        <?php endforeach;?>
        <?=Form::input('comments_range_custom', '', array('class="input span2 hide"'));?>
    </div>
    <div class="options-container">
        <h4><?=__('Like Posting');?></h4>
        <?php foreach($like_range as $range):?>
            <?php $selected = ($range->id == $default_like_range) ? TRUE : FALSE;?>
            <?=Form::radio('like_range', $range->id, $selected, array('data-price' => $range->price));?>
            <span><?=$range->name;?></span>
        <?php endforeach;?>
        <?=Form::input('like_range_custom', '', array('class="input span2 hide"'));?>
    </div>
    <div class="options-container">
        <label><?=__('Total page likes');?></label>
        <?=Form::input('total_page_likes', '', array('class="input span2"'));?>
    </div>
    <div class="options-container">
        <h4><?=__('Required input information source');?></h4>
        <?php foreach($sources as $source):?>
            <?php $selected = ($source->id == $default_source) ? TRUE : FALSE;?>
            <?=Form::radio('information_source', $source->id, $selected, array('data-price' => $source->price));?>
            <span><?=$source->name;?></span>
        <?php endforeach;?>
        <textarea name="source" id="source-1" class="input textarea">
Please, describe source of articles, links, images, videos, etc. for postings
YOU CAN ALSO POINT YOUR ANOTHER SMOOOK PROJECT TO DUPLICATE POSTS FROM IT
        </textarea>
        <textarea name="source" id="source-2" class="input textarea hide">
Smoook can post things like
- links to YOUR SUBJECTS articles
- links to YOUR SUBJECTS videos
- Jokes or funny things related to YOUR SUBJECTS
- Interest YOUR SUBJECTS Facts
- New developments and technology in YOUR SUBJECTS field
- Etc

Please describe your SUBJECTS:
        </textarea>
        <textarea name="source" id="source-3" class="input textarea hide">
* Unique articles that will be created by Smoook copywriter
Please, contact our manager to discuss this option, will be charged additionally
        </textarea>
    </div>
    <div class="error-message f16">NOTE! ALL LIKES, COMMENTS, ETC. WILL BE PLACED BY CUSTOM ENGLISH SPEAKING PEOPLE PROFILES AROUND THE WORLD, IF YOU NEED CUSTOM LOCATION OF PROFILES THAT LIKE, COMMENT YOUR PAGE, PLEASE, CONTACT OUR MANAGER BEFORE MAKE ANY PURCHASE</div>
    <div>
        <?=Form::checkbox('agree');?>
        <span>I've read note above and ready to make order</span>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('input[name="description_type"]').click(function(){
            if($(this).val() == 1){
                $('textarea[name="description"]').text('Please, input account details to your social network, like Email, Login, Passwords, etc.');
            }
            else{
                $('textarea[name="description"]').text('Please, input all contact details of your company like email, website, phone, address, skype, etc., full description, that will be used for registration social page.');
            }
        });
        var $posting_range_custom = $('input[name="posting_range_custom"]');
        var $posting_range = $('input[name="posting_range"]');
        $posting_range.change(function(){
            if($(this).next().text() == 'Customs posts/month'){
                $posting_range_custom.show()
            }
            else{
                $posting_range_custom.hide();
                $posting_range_custom.val('');
                calculateSummary();
            }
        });
        $posting_range_custom.change(function(){
            calculateSummary();
        });

        var $comments_range_custom = $('input[name="comments_range_custom"]');
        var $comments_range = $('input[name="comments_range"]');
        $comments_range.change(function(){
            if($(this).next().text() == 'Custom comments per post'){
                $comments_range_custom.show()
            }
            else{
                $comments_range_custom.hide();
                $comments_range_custom.val('');
                calculateSummary();
            }
        });
        $comments_range_custom.change(function(){
            calculateSummary();
        });

        var $like_range_custom = $('input[name="like_range_custom"]');
        var $like_range = $('input[name="like_range"]');
        $like_range.change(function(){
            if($(this).next().text() == 'Custom like per post'){
                $like_range_custom.show()
            }
            else{
                $like_range_custom.hide();
                $like_range_custom.val('');
                calculateSummary();
            }
        });
        $like_range_custom.change(function(){
            calculateSummary();
        });

        var $total_page_likes = $('input[name="total_page_likes"]');
        $total_page_likes.change(function(){
            calculateSummary();
        });

        var $information_source = $('input[name="information_source"]');
        $information_source.change(function(){
            $('textarea[name="source"]').addClass('hide');
            $('#source-' + $(this).val()).removeClass('hide');
            calculateSummary();
        });

        $('input[name="agree"]').click(function(){
            if($(this).is(':checked')){
                $('#add-account input[type="submit"]').removeClass('disabled').prop('disabled', '');
            }
            else{
                $('#add-account input[type="submit"]').addClass('disabled').attr('disabled', 'disabled');
            }
        });

        calculateSummary();

        function calculateSummary(){
            var price = parseInt($('input[name="base_price"]').val());
            //calculate posting price
            var tmp = parseInt($('input[name="posting_range"]:checked').attr('data-price'));
            if($posting_range_custom.is(':visible')){
                if($posting_range_custom.val() > 10){
                    price += tmp;
                }
            }
            else{
                price += tmp;
            }

            //calculate comments price
            tmp = parseInt($('input[name="comments_range"]:checked').attr('data-price'));
            if($comments_range_custom.is(':visible')){
                if($comments_range_custom.val() > 10){
                    price += ($posting_range_custom.val() > 40) ? (2 * tmp) : tmp;
                }
            }
            else{
                if($('input[name="comments_range"]:checked').next().text() == '2-4 comments per post'){
                    price += ($posting_range_custom.val() > 40) ? 500 : 0;
                }
                else{
                    price += ($posting_range_custom.val() > 40) ? (2 * tmp) : tmp;
                }
            }

            //calculate likes price
            tmp = parseInt($('input[name="like_range"]:checked').attr('data-price'));
            if($like_range_custom.is(':visible')){
                if($like_range_custom.val() > 10){
                    price += ($posting_range_custom.val() > 40) ? (2 * tmp) : tmp;
                }
            }
            else{
                if($('input[name="like_range"]:checked').next().text() == '5-10 like per post'){
                    price += ($posting_range_custom.val() > 40) ? 500 : 0;
                }
                else{
                    price += ($posting_range_custom.val() > 40) ? (2 * tmp) : tmp;
                }
            }

            if($total_page_likes.val() > 10000){
                price += 1000; // +$10
            }

            var $source = $('input[name="information_source"]:checked');
            tmp = parseInt($source.attr('data-price'));
            price += ($posting_range_custom.val() > 40) ? (tmp * 2) : tmp;
            $('.account-price').text('$' + convertCentsDollars(price));
            $('input[name="price"]').val(price);
        }
    });
</script>