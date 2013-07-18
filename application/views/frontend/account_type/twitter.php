<div class="twitter-container">
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
        <label><?=__('Followers');?></label>
        <?=Form::input('followers', '', array('class="input span2"'));?>
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

        var $information_source = $('input[name="information_source"]');
        $information_source.change(function(){
            calculateSummary();
        });

        function calculateSummary(){
            var price = parseInt($('input[name="posting_range"]:checked').attr('data-price'));
            if($posting_range_custom.val() != ''){
                price *= parseInt($posting_range_custom.val());
            }
            price += parseInt($('input[name="information_source"]:checked').attr('data-price'));
            $('.account-price').text('$' + convertCentsDollars(price));
            $('input[name="price"]').val(price);
        }
    });
</script>