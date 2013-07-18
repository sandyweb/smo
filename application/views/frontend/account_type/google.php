<div class="fb-container">
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
        <div class="inline">
            <label><?=__('Follow');?></label>
            <?=Form::input('followers', '', array('class="input span2"'));?>
        </div>
        <div class="inline">
            <label><?=__('Circles');?></label>
            <?=Form::input('friends', '', array('class="input span2"'));?>
        </div>
    </div>
    <div class="options-container">
        <h4><?=__('Required input information source');?></h4>
        <?php foreach($sources as $source):?>
            <?php if($source->name == 'Custom post creation') continue;?>
            <?php $selected = ($source->id == $default_source) ? TRUE : FALSE;?>
            <?=Form::radio('information_source', $source->id, $selected, array('data-price' => $source->price));?>
            <span><?=$source->name;?></span>
        <?php endforeach;?>
    </div>
</div>
<script>
    $(document).ready(function(){
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

        var $information_source = $('input[name="information_source"]');
        $information_source.change(function(){
            calculateSummary();
        });

        function calculateSummary(){
            var price = parseInt($('input[name="posting_range"]:checked').attr('data-price'));
            if($posting_range_custom.val() != ''){
                price *= parseInt($posting_range_custom.val());
            }
            price += parseInt($('input[name="comments_range"]:checked').attr('data-price'));
            if($comments_range_custom.val() != ''){
                price *= parseInt($comments_range_custom.val());
            }

            price += parseInt($('input[name="like_range"]:checked').attr('data-price'));
            if($like_range_custom.val() != ''){
                price *= parseInt($like_range_custom.val());
            }

            price += parseInt($('input[name="information_source"]:checked').attr('data-price'));
            $('.account-price').text('$' + convertCentsDollars(price));
            $('input[name="price"]').val(price);
        }
    });
</script>