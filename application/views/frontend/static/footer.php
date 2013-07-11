<!-- start footer -->
<footer id="footer">
    <section class="wide100-footer">
        <section class="container_12">
            <section class="grid_12 footer-container">
                <img src="<?=URL::base();?>images/footer_logo.png" class="footer-logo">
                <!-- start footer top -->
                <section id="footer-top">
                    <a href="<?=URL::base();?>" title="Smoook" class="logo-footer">Smoook</a>
                </section>
                <section class="clear"></section>
                <!-- start left -->
                <section id="footer-left">
                    <section class="footer-link">
                        <ul>
                            <li><a href="#tab2" onclick="javascript:navToProcess();" title="Process">Process</a></li>
                            <li><a href="#tab1" onclick="javascript:navToDifference();" title="Difference">Difference</a></li>
                            <li><a href="#tab3" onclick="javascript:navToPrice();" title="Pricing">Pricing</a></li>
                        </ul>
                    </section>
                    <section class="footer-link">
                        <ul>
                            <li><a href="<?=URL::base();?>" title="Sign Up" class="modal">Sign Up</a></li>
                            <li><a href="<?=URL::site('auth/login');?>" title="Login">Login</a></li>
                        </ul>
                    </section>
                    <section class="footer-link">
                        <ul>
                            <li><a href="<?=URL::site('about');?>" id="about" title="About">About</a></li>
                            <li><a href="<?=URL::site('contact');?>" id="contact" title="Contact Us">Contact</a></li>
                        </ul>
                    </section>
                </section>
                <!-- end left -->
                <!-- start mid -->
                <section id="footer-mid"></section>
                <!-- end mid -->
                <!-- start right -->
                <section id="footer-right"></section>
            </section>
        </section>
    </section>
    <section class="wide100-footerBottom">
        <section class="container_12">
            <section id="footer-bottom">
                <p class="privacy">&copy; <?=date('Y');?> Inc.  All right are reserved <a href="<?=URL::site('termsofservice');?>" id="A1" class="nyroModal" title="Terms &amp; Conditions">Terms &amp; Conditions</a> | <a href="<?=URL::site('privacypolicy');?>" id="A2" class="nyroModal" title="Privacy Policy">Privacy Policy</a></p>
            </section>
        </section>
    </section>
</footer>
<!-- end footer -->