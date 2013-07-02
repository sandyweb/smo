<!-- start container -->
<section class="wide100-contact">
    <section class="container_12" id="inside-pages">
        <h2 class="title blue">Contact Us</h2>
        <!-- start grid_9 -->
        <section class="grid_9">
            <?=Form::open(URL::site('main/contact'), array('method' => 'post', 'id' => 'signupform', 'class' => 'fillform blue2'));?>
                <?php if($errors):?>
                    <p class="message">Some errors were encountered, please check the details you entered.</p>
                    <ul class="error">
                    <?php foreach($errors as $message):?>
                        <li><?=$message;?></li>
                    <?php endforeach;?>
                    </ul>
                <?php elseif($message):?>
                    <p class="message"><?=$message;?></p>
                <?php endif;?>
                <!-- start fillform -->
                <div id="ContentPlaceHolder1_signupformDIV">
                    <section class="row" style="text-align:left">
                        <label>Type:</label>
                        <label class="second"><?=Form::radio('message[type]', 'Customer');?>Customer</label>
                        <label class="second"><?=Form::radio('message[type]', 'Freelancer');?>Freelancer</label>
                        <label class="second"><?=Form::radio('message[type]', 'Other');?>Other</label>
                        <section class="clear"></section>
                    </section>
                    <section class="row">
                        <label>Name:</label>
                        <?=Form::input('message[name]', $data['name'], array('class' => 'input1'));?>
                        <section class="clear"></section>
                    </section>
                    <section class="row">
                        <label>Email:</label>
                        <?=Form::input('message[email]', $data['email'], array('class' => 'input1'));?>
                        <section class="clear"></section>
                    </section>
                    <section class="row">
                        <label>Subject:</label>
                        <?=Form::input('message[subject]', $data['subject'], array('class' => 'input1'));?>
                        <section class="clear"></section>
                    </section>
                    <section class="row">
                        <label>Project # <span>(optional):</span></label>
                        <?=Form::input('message[project]', $data['project'], array('class' => 'input1'));?>
                        <section class="clear"></section>
                    </section>
                    <section class="row second">
                        <label for="Message">Message:</label>
                        <?=Form::textarea('message[message]', $data['message'], array('class' => 'textarea1', 'cols' => '4', 'rows' => '4'));?>
                        <section class="clear"></section>
                    </section>
                    <section class="row2">
                        <?=Form::submit('send', 'Send', array('class' => 'bt-gray'));?>
                        <section class="clear"></section>
                    </section>
                </div>
            <?=Form::close();?>
            <section class='txtb'> </section>
            <!-- end fillform -->
            <section class="clear"></section>
        </section>
        <!-- end grid_9 -->
        <!-- start grid_3 -->
        <section class="grid_3">
            <!-- start address-block -->
            <section class="tweets address-block">
                <h2>Address</h2>
                <address><p>160 S Old Springs Rd. Suite 110<br>Anaheim, CA 92808<br>Phone: 1.951.389.4014<br>Email: cs@ziptask.com</p></address>
                <h2>Socialize</h2>
                <ul>
                    <li class="facebook"><a target="_blank" href="http://www.facebook.com/pages/Ziptask/149086885141893" title="Facebook">Facebook</a></li>
                    <li class="twitter"><a target="_blank" href="http://www.twitter.com/ziptask" title="Twitter">Twitter</a></li>
                    <li class="youtube"><a target="_blank" href="http://www.youtube.com/user/ziptask" title="Youtube">Youtube</a></li>
                    <li class="tumblr"><a target="_blank" href="http://blog.ziptask.com/" title="Blog">Blog</a></li>
                    <li class="rss"><a target="_blank" href="http://blog.ziptask.com/rss" title="Rss">Rss</a></li>
                </ul>
                <section class="clear"></section>
                <section class="clear"></section>
            </section>
            <!-- end address-block -->
        </section>
        <!-- end grid_3 -->
    </section>
</section>
<!-- end container -->