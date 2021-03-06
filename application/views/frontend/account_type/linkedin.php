<div class="li-container">
    <div>
        <h5><?=__('Title:');?></h5>
        <?=Form::input('title', '', array("class"=>"input", "style"=>"width:340px; margin:5px 0 10px 0;"));?>
    </div>
    <div class="clear"></div>
    <div class="options-container">
        <?=Form::radio('description_type', 1, TRUE);?>
        <span><?=__('Existing LinkedIn page');?></span>
        <div>
            <h5><?=__('Description:');?></h5>
            <textarea name="description" class="input textarea">Please, input account details to your social network, like Email, Login, Passwords, etc.</textarea>
        </div>
    </div>
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
Please, contact our manager to discuss this option, will be charged additionally
        </textarea>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#add-account input[type="submit"]').removeClass('disabled').prop('disabled', '');
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

        var $information_source = $('input[name="information_source"]');
        $information_source.change(function(){
            $('textarea[name="source"]').addClass('hide');
            $('#source-' + $(this).val()).removeClass('hide');
            calculateSummary();
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
            var $source = $('input[name="information_source"]:checked');
            tmp = parseInt($source.attr('data-price'));
            price += ($posting_range_custom.val() > 35) ? (tmp * 2) : tmp;
            $('.account-price').text('$' + convertCentsDollars(price));
            $('input[name="price"]').val(price);
        }
    });
</script>