<section class="wide100-about">
    <section class="container_12" id="inside-pages">
        <!-- start grid_9 -->
        <section class="grid_9 blue2 light-shadow">
            <!-- start commoncol2 -->
            <h2 class="title blue">About Smoook</h2>
            <ul class="commoncol2 gap1">
                <li>
                    <h2>About Us</h2>
                    <p>Smoook was founded in 2010. Our team including highly qualified social media managers. We are here to help you with your social networks.</p>
                </li>
                <li>
                    <h2>What Drives Us</h2>
                    <p>A social media manager is the individual in an organization trusted with monitoring, contributing to, filtering, measuring and otherwise guiding the social media presence of a brand, product, individual or corporation. The role is similar to that of a community manager on a website forum or public relations representative. Social media managers are often found in the marketing and public relations departments of large organizations. We are providing your individual social media manager much cheaper that hiring it on site. </p>
                </li>
            </ul>
            <!-- end commoncol2 -->
            <section class="clear"></section>
        </section>
        <!-- end grid_9 -->
        <!-- start grid_3 -->
        <section class="grid_3">
            <!-- start latest-post -->
            <section class="latest-post">
                <h2>Latest Blog Posts</h2>
                <ul id="ReplaceWithRSSFeedData">
                </ul>
                <section class="clear"></section>
            </section>
            <!-- end latest-post -->
            <!-- start tweets -->
            <section class="tweets">
                <h2>Twitter Feed</h2>
                <p id="ReplaceWithTweet"></p>
            </section>
            <!-- end tweets -->


        </section>
        <!-- end grid_3 -->
    </section>
</section>
<!-- end container -->


<script src="<?=URL::base();?>js/jquery.RSSfeed.js" type="text/javascript"></script>
<script src="<?=URL::base();?>js/jquery.tweet.js" type="text/javascript"></script>

<script language="ecmascript" type="text/javascript">

    $(document).ready(function () {

    $('#ReplaceWithRSSFeedData').rssfeed('http://blog.Smoook.com//rss?randomvalue=' + $.now(), {
    limit: 4,
    header: false,
    date: true,
    content: false,
    snippet: false,
    media: false,
    linktarget: '_blank'
    });

    $("#ReplaceWithTweet").tweet({
    avatar_size: 32,
    count: 3,
    fetch: 10,
    filter: function (t) { return !/^@\w+/.test(t.tweet_raw_text); },
    username: "Smoook"
    });

    });


</script>