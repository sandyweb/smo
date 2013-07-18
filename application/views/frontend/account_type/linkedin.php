<div class="li-container">
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

        var $information_source = $('input[name="information_source"]');
        $information_source.change(function(){
            calculateSummary();
        });

        function calculateSummary(){
            var price = parseInt($('input[name="information_source"]:checked').attr('data-price'));
            $('.account-price').text('$' + convertCentsDollars(price));
            $('input[name="price"]').val(price);
        }
    });
</script>