<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" language="javascript">
        //google analytics starts
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-19502378-1']);
        _gaq.push(['_setDomainName', '.ziptask.com']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>
    <!-- Google Site Verification -->
    <meta name="google-site-verification" content="F6U0jOp1b7yTpUajNRnHggfGL0zKZ3bNTgfcjn1YsxY" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ziptask - Fully Managed Outsourcing - Home</title>
    <script src="<?=URL::base();?>js/jquery-1.6.1.min.js"  type="text/javascript"></script>
    <script src="<?=URL::base();?>js/jquery-ui-1.10.0.custom.min.js"  type="text/javascript"></script>
    <script src="<?=URL::base();?>js/slides.min.jquery.js"  type="text/javascript"></script>
    <script src="<?=URL::base();?>js/jquery.simplemodal.js" type="text/javascript"></script>
    <script src="<?=URL::base();?>js/bselector.js" type="text/javascript"></script>
    <script src="<?=URL::base();?>js/scripts.js" type="text/javascript"></script>
    <link href="<?=URL::base();?>images/favicon.ico" rel="shortcut icon" type="image/x-icon"  >
    <link href="<?=URL::base();?>css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?=URL::base();?>css/ziptask-theme-1/jquery-ui-1.9.2.custom.css" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script type="text/javascript" language="javascript">
    $(document).ready(function () {
    $('.by_zopim widget_ui icon_zopim').remove();

    //for login...
    $('#txtPassword').keyup(function (event) {
        $("#txtPassword").removeClass('error2');
        if (event.keyCode == 13) {
            $('#btnLogin').click();
        }
    });
    $('#txtUsername').keyup(function (event) {
        $("#txtUsername").removeClass('error2');
    });

    //for signup
    $('#emailInput').keyup(function (event) {
        $("#emailInput").removeClass('error2');
        if (event.keyCode == 13) {
            $('#btnCreateAccount').click();
        }
    });
});
    function navToProcess(){
        if (window.location.pathname == '/') {
            $('#process').click();
            $('#tab2').click(function () {
                var jump = $(this).attr('href');
                var new_position = $('#' + jump).offset();
                window.scrollTo(new_position.left, new_position.top);
                return false;
            });
        }
        else {
            window.location = '/#tab2'
        }
    }
    function navToDifference() {
        if (window.location.pathname == '/') {
            $('#difference').click();
            $('#tab1').click(function () {
                var jump = $(this).attr('href');
                var new_position = $('#' + jump).offset();
                window.scrollTo(new_position.left, new_position.top);
                return false;
            });
        }
        else {
            window.location = '/#tab1'
        }
    }
    function navToPrice() {
        if (window.location.pathname == '/') {
            $('#price').click();
            $('#tab3').click(function () {
                var jump = $(this).attr('href');
                var new_position = $('#' + jump).offset();
                window.scrollTo(new_position.left, new_position.top);
                return false;
            });
        }
        else {
            window.location = '/#tab3'
        }
    }
    function navToOversight() {
        if (window.location.pathname == '/') {
            $('#oversight').click();
            $('#tab4').click(function () {
                var jump = $(this).attr('href');
                var new_position = $('#' + jump).offset();
                window.scrollTo(new_position.left, new_position.top);
                return false;
            });
        }
        else {
            window.location = '/#tab4'
        }
    }
    function navToExamples() {
        if (window.location.pathname == '/') {
            $('#examples').click();
            $('#tab5').click(function () {
                var jump = $(this).attr('href');
                var new_position = $('#' + jump).offset();
                window.scrollTo(new_position.left, new_position.top);
                return false;
            });
        }
        else {
            window.location = '/#tab5'
        }
    }
    function navToTeam() {
        if(window.location.pathname == '/') {
            $('#team').click();
            $('#tab6').click(function () {
                var jump = $(this).attr('href');
                var new_position = $('#' + jump).offset();
                window.scrollTo(new_position.left, new_position.top);
                return false;
            });
        }
        else {
            window.location = '/#tab6'
        }
    }
    function verifyEmail(email) {
    var status = false;

    if (email == '')
        return true;

    if (email == null)
        return true;

    var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
    if (email.search(emailRegEx) != -1) {
        return false;
    }
    else {
        return true;
    }
}
    function signupClick() {

    var wsurl = '<?=URL::base();?>webservices/Core.ashx';

    var email = $("#emailInput").val();

    if (verifyEmail(email)) {
        var errorMessage = "Invalid email format.";
        $("#emailError").text(errorMessage);
        $("#emailInput").addClass('error2');
        $("#emailError").css('visibility', 'visible');
        return;
    }
    else if ($('#Read').attr('checked') == undefined) {
        var errorMessage = "Please agree to terms";
        $("#emailError").text(errorMessage);
        $("#emailInput").addClass('error2');
        $("#emailError").css('visibility', 'visible');
        return;
    }
    else {
        $("#emailError").css('visibility', 'hidden');
        $("#emailInput").removeClass('error2');
    }
    //check to see if email already is in the ziptask system...
    if (email != null && email != '') {
        $.ajax({
            url: wsurl + "?fc=checkemailalreadyexists&email=" + email,
            cache: false,
            success: function (data) {
                if (data != null) {
                    if (data.toLowerCase() == "false") {
                        var errorMessage = "Email in use.";
                        $("#emailError").text(errorMessage);
                        $("#emailInput").addClass('error2');
                        $("#emailError").css('visibility', 'visible');
                    }
                    else {
                        $("#emailInput").removeClass('error2');
                        $("#emailError").css('visibility', 'hidden');
                        twoFieldSignUp();
                    }
                }
            },
            fail: function () {

            }
        });

    }
}
    function checkEmail() {

    var wsurl = '<?=URL::base();?>webservices/Core.ashx';

    var email = $("#emailInput").val();

    if (verifyEmail(email)) {
        var errorMessage = "Invalid email format.";
        $("#emailError").text(errorMessage);
        $("#emailInput").addClass('error2');
        $("#emailError").css('visibility', 'visible');
        return false;
    }
    else {
        $("#emailError").css('visibility', 'hidden');
        $("#emailInput").removeClass('error2');
    }
    //check to see if email already is in the ziptask system...
    if (email != null && email != '') {
        $.ajax({
            url: wsurl + "?fc=checkemailalreadyexists&email=" + email,
            cache: false,
            success: function (data) {
                if (data != null) {
                    if (data.toLowerCase() == "false") {
                        var errorMessage = "Email in use.";
                        $("#emailError").text(errorMessage);
                        $("#emailInput").addClass('error2');
                        $("#emailError").css('visibility', 'visible');
                    }
                    else {
                        $("#emailInput").removeClass('error2');
                        $("#emailError").css('visibility', 'hidden');
                    }
                }
            },
            fail: function () {

            }
        });

    }
}
    function closeModal() {
    $.modal.close();
}
    function twoFieldSignUp() {

    var name = $('#txtName').val();
    var email = $('#emailInput').val();

    var url = '<?=URL::base();?>webservices/Core.ashx' + "?fc=twofieldsignup&name=" + name + "&email=" + email;

    $.getJSON(url, twoFieldSignUpCallback);
}
    function twoFieldSignUpCallback(data) {

    if (data != null) {
        //handle the new signup
        if (data.SessionKey != null) {
            var SessionKey = data.SessionKey;
            var PersonID = data.PersonID;
            var wsurlsamelocation = '<?=URL::base();?>confirmationbasic' + '?s=' + SessionKey + '&firstrun=true&pid=' + PersonID;
            window.location = wsurlsamelocation;
        }
    }
}
</script>
<!-- on-page feedback script -->
<script type='text/javascript'> (function () { function loadWebreep() { var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = 'https://api.webreep.com/Feedback/Get/b379f663-8415-4070-9dc1-9e37a3292caf'; var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x); } if (window.attachEvent) { window.attachEvent('onload', loadWebreep); } else { window.addEventListener('load', loadWebreep, false); } })();</script>
<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
    window.$zopim || (function (d, s) {
        var z = $zopim = function (c) { z._.push(c) }, $ = z.s =
            d.createElement(s), e = d.getElementsByTagName(s)[0]; z.set = function (o) {
            z.set.
                _.push(o)
        }; z._ = []; z.set._ = []; $.async = !0; $.setAttribute('charset', 'utf-8');
        $.src = '//cdn.zopim.com/?113um81bEzRtnzNk3YPE1F66KkNCXeHh'; z.t = +new Date; $.
            type = 'text/javascript'; e.parentNode.insertBefore($, e)
    })(document, 'script');
</script>
<!--End of Zopim Live Chat Script-->
</head>
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
                <h2>Stop Hiring Freelancers. Use Ziptask.</h2>
                <p>Ziptask is a fully managed work platform with experienced project managers who will guide you through your project, oversee freelancers, and ensure high quality work every time. </p>
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
