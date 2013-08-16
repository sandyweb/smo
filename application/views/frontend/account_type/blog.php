<div class="fb-container">
    <div>
        <h5><?=__('Title:');?></h5>
        <?=Form::input('title', '', array("class"=>"input", "style"=>"width:340px; margin:5px 0 10px 0;"));?>
    </div>
    <div class="clear"></div>
    <div class="options-container">
        <?=Form::radio('description_type', 1, TRUE);?>
        <span><?=__('Existing blog ');?></span>
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
        <h4><?=__('Required input information source');?></h4>
        <?=Form::radio('information_source', $source->id, TRUE, array('data-price' => $source->price));?>
        <span><?=$source->name;?></span>
        <?=Form::hidden('source', '');?>
    </div>
    <div class="error-message f16">NOTE! ARTICLES WILL BE CREATED BY PROFICIENT COPYWRITER USING YOUR TIP, SUBJECTS, ETC. ONE ARTICLE ABOUT 200-400 WORDS.
        IF YOU WANT ADDITIONAL INFORMATION OR OPTIONS PLEASE CONTACT OUR MANAGER BEFORE MAKE ANY PURCHASE</div>
    <div>
        <?=Form::checkbox('agree');?>
        <span>I've read note above and ready to make order</span>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#add-account input[type="submit"]').addClass('disabled').attr('disabled', 'disabled');
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
                if($posting_range_custom.val() > 5){
                    price += tmp;
                }
            }
            else{
                price += tmp;
            }
            $('.account-price').text('$' + convertCentsDollars(price));
            $('input[name="price"]').val(price);
        }
    });
</script>