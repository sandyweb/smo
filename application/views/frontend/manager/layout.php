<!DOCTYPE HTML>
<html>
<head>
    <base href="<?=URL::base();?>">
    <link rel="icon" href="<?=URL::base();?>images/favicon.ico" type="image/x-icon" />
    <?php foreach ($styles as $file) echo HTML::style($file);?>
    <?php foreach ($scripts as $file) echo HTML::script($file);?>
    <title><?php echo $title;?></title>
</head>
<body>
<!-- header -->
<div class="header">
    <?php echo $header;?>
    <div class="clear"></div>
</div>

<!-- content -->
<div class="content_wrapper">
    <div class="left_bar"><?php echo $left_bar;?></div>
    <div class="actions" id="actions" style="display:none;">
        <!-- For add or edit accounts -->
    </div>
    <div class="content"><?php echo $content;?></div>

    <div class='clear'></div>
</div>
</body>
</html>