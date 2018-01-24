<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

    <div class="error">
        <div class="error-page error-404">
            <h2 class="error-title">404</h2>
            <p>对不起，你想查看的页面已被转移或删除了</p>
            <a class="btn" href="<?php $this->options->siteUrl(); ?>"><span id="timer"></span>跳转</a>
        </div>
    </div><!-- end #content-->
    <script type="text/javascript">
    var delay = 5;
    var timer = document.getElementById('timer');

    function timerDown(delay) {
        if(!delay){
            window.location.href = "<?php $this->options->siteUrl(); ?>";
            return;
        }
        timer.innerHTML = delay+' 秒后';
        delay--;
        setTimeout(function(){
            timerDown(delay);
        }, 1000);
    }

    timerDown(delay);
    </script>
	<?php $this->need('footer.php'); ?>
