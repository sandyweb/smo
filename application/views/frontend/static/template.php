<!DOCTYPE html>
<html>
<head>
    <!-- Google Site Verification -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Smoook - Fully Managed Outsourcing - Home</title>
    <script src="<?=URL::base();?>js/jquery-1.10.1.min.js"  type="text/javascript"></script>
    <script src="<?=URL::base();?>js/jquery-ui-1.10.0.custom.min.js"  type="text/javascript"></script>
    <script src="<?=URL::base();?>js/slides.min.jquery.js"  type="text/javascript"></script>
    <script src="<?=URL::base();?>js/jquery.simplemodal.js" type="text/javascript"></script>
    <script src="<?=URL::base();?>js/bselector.js" type="text/javascript"></script>
    <script src="<?=URL::base();?>js/scripts.js" type="text/javascript"></script>
    <script src="<?=URL::base();?>js/main_static.js" type="text/javascript"></script>
    <link href="<?=URL::base();?>images/favicon.ico" rel="shortcut icon" type="image/x-icon"  >
    <link href="<?=URL::base();?>css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?=URL::base();?>css/ziptask-theme-1/jquery-ui-1.9.2.custom.css" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<!-- on-page feedback script -->
<script type='text/javascript'> (function () { function loadWebreep() { var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = 'https://api.webreep.com/Feedback/Get/b379f663-8415-4070-9dc1-9e37a3292caf'; var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x); } if (window.attachEvent) { window.attachEvent('onload', loadWebreep); } else { window.addEventListener('load', loadWebreep, false); } })();</script>
<body>
<!-- start wrapper -->
<section id="wrapper">
    <section id="wrapper-right">
        <!-- start header -->
        <header id="header">
            <?=View::factory('frontend/static/header');?>
        </header>
        <!-- end header -->
        <?=$content;?>
        <section class="container_12">
            <section class="footer-tagline">
                <h2>Stop Hiring Freelancers. Use Smoook.</h2>
                <p>Smoook is a fully managed work platform with experienced project managers who will guide you through your project, oversee freelancers, and ensure high quality work every time. </p>
            </section>
        </section>

        <section class="clear"></section>
        <?=View::factory('frontend/static/footer');?>
        <section class="clear"></section>
    </section>
</section>
<!-- end wrapper -->
<!-- Google Code for Retargeting Campaign #1 -->
<script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 955519611;
    var google_conversion_label = "MGRSCN2u3wkQ-6TQxwM";
    var google_custom_params = window.google_tag_params;
    var google_remarketing_only = true;
    /* ]]> */
</script>
<script type="text/javascript" src="http://googleadservices.com/pagead/conversion.js"></script>
<noscript>
    <div style="display:inline;background-color:none;">
        <img height="1" width="1" style="border-style:none;" alt="" src="http://googleads.g.doubleclick.net/pagead/viewthroughconversion/955519611/?value=0&label=MGRSCN2u3wkQ-6TQxwM&guid=ON&script=0"/>
    </div>
</noscript>
</body>
</html>
