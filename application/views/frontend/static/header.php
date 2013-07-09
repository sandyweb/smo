<!-- start container -->
<section class="container_12">
    <!-- start logo -->
    <section id="logo" class="grid_6">
        <h1><a href="<?=URL::base();?>" title="smoook">smoook</a></h1>
    </section>
    <!-- end logo -->
    <!-- start header right -->
    <section id="header-right" class="grid_6 alignright">
        <a href="<?=URL::base();?>" title="Sign Up" class="bt-blue f-face4 modal">Sign Up</a>
        <a href="<?=URL::site('auth/login');?>" title="Login" class="bt-gray f-face4">Login</a>
        <!-- start signup -->
        <form action="#" id="SignUp" class="popup blue signup">
            <h3>Sign Up for Free</h3>
            <section class="row">
                <label for="Name">Name:</label>
                <input type="text" name="txtName" id="txtName" value="" class="input1 input2" />
                <section class="clear"></section>
            </section>
            <section class="row">
                <label for="Email">Email:</label>
                <input id="emailInput" type="text" name="Email" id="emailInput" value="" class="input1 input2"/>
                <section class="clear"></section>
                <small id="emailError" style="visibility:hidden;">Sorry this email is not valid</small>
            </section>
            <section class = "row" style="margin-left:15px;">
                <p style="font-size: 11px;"><input type="radio" name="read" id="Read" value="0" style="float:left; margin-right:10px; margin-top:3px;" />
                    <span for="Read" style=" width:250px; float:left;">Yes, I have read and I accept the
                        <a class="blueTxtLink" href="<?=URL::site('termsofservice');?>"> Smoook Terms of Service</a> and the
                        <a class="blueTxtLink" href="<?=URL::site('privacypolicy');?>">Smoook Privacy Statement</a>.
                    </span>
                </p>
            </section>
            <section class="clear"></section>
            <input name="btnCreateMyAccount" value="Create My Account" class="bt-blue"/>
            <!-- start ribbon -->
            <section class="ribbon">
                <p><span>Fully Managed</span><span>Oversight Built-In</span>
                    <span>No Interviews</span><span>No Negotiations</span>
                    <span>No Language Barriers</span>
                </p>
            </section>
            <!-- end ribbon -->
        </form>
        <!-- end signup -->
    </section>
    <!-- end header right -->
</section>
<!-- end container -->