<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>


<div class="err-content">
<pre><code>
<span class="function"><span class="keyword">function</span> <span class="title">errorHandler</span>(<span class="params"> req </span>)</span>{
  <span class="keyword">if</span> (req.status == <span class="number">404</span>) {
    <span class="built_in">console</span>.log(<span class="string">"Page not found"</span>);
    <span class="built_in">window</span>.location.href = <span class="link"><a href="<?php $this->options->rootUrl();?>"><?php $this->options->rootUrl();?></a></span>;
    <span class="built_in">window</span>.refresh = after <span id="timer"></span>;
  }
}
</code></pre>
</div>

<!-- end #content-->
 <script type="text/javascript">
    var delay = 5;
    var timer = document.getElementById('timer');

    function timerDown(delay) {
        if(!delay){
            window.location.href = "<?php $this->options->rootUrl(); ?>";
            return;
        }
        timer.innerHTML = delay+' sec';
        delay--;
        setTimeout(function(){
            timerDown(delay);
        }, 1000);
        
    }

    timerDown(delay);
    </script>
<div class="template-404"></div>
	<?php $this->need('footer.php'); ?>
