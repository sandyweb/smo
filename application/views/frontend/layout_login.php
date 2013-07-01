<!DOCTYPE HTML>
<html>
    <head>
        <?php foreach ($styles as $file) echo HTML::style($file);?>
        <?php foreach ($scripts as $file) echo HTML::script($file);?>
        <title><?php echo $title;?></title>
    </head>
    <body class="login">
        <!-- content -->
        <div class="content_wrapper">
            <?php echo $content;?>
        </div>
    </body>
</html>