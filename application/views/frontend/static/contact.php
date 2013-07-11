<!-- start container -->
<section class="wide100-contact">
    <section class="container_12" id="inside-pages">
        <h2 class="title blue">Contact Us</h2>
        <!-- start grid_9 -->
        <section class="grid_9">
            <?=Form::open(URL::site('contact'), array('method' => 'post', 'id' => 'signupform', 'class' => 'fillform blue2'));?>
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
    </section>
</section>
<!-- end container -->