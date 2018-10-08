<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

        </div><!-- end .row -->
    </div>
</div><!-- end #body -->

<footer id="footer" class="footer">
    <div class="container">Copyright &copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?>.</a></div>
</footer><!-- end #footer -->

<script type="text/javascript">
window.__onece = <?php echo Typecho_Common::shuffleScriptVar(
          $this->security->getToken($this->request->getRequestUrl())) ?>;
<?php if($this->options->commentsThreaded && $this->is('single')): ?>
var __respondId = '<?php echo $this->respondId;?>';
  (function () {
      window.TypechoComment = {
          currentParent: null,
          dom : function (id) {
              return document.getElementById(id);
          },
      
          create : function (tag, attr) {
              var el = document.createElement(tag);
          
              for (var key in attr) {
                  el.setAttribute(key, attr[key]);
              }
          
              return el;
          },

          reply : function (cid, coid) {
              var comment = this.dom(cid), parent = comment.parentNode,
                  response = this.dom(__respondId), input = this.dom('comment-parent'),
                  form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                  textarea = response.getElementsByTagName('textarea')[0];

              if (null == input) {
                  input = this.create('input', {
                      'type' : 'hidden',
                      'name' : 'parent',
                      'id'   : 'comment-parent'
                  });

                  form.appendChild(input);
              }

              input.setAttribute('value', coid);

              if (null == this.dom('comment-form-place-holder')) {
                  var holder = this.create('div', {
                      'id' : 'comment-form-place-holder'
                  });

                  response.parentNode.insertBefore(holder, response);
              }
              comment.insertBefore(response, this.dom('comment-clear-'+coid));
              this.dom('cancel-comment-reply-link').style.display = '';
              this.dom('comment-reply-'+coid).style.display = 'none';
              if(null!=this.currentParent){
                this.dom('comment-reply-'+this.currentParent).style.display = '';
              }
              this.currentParent = coid;
              if (null != textarea && 'text' == textarea.name) {
                  textarea.focus();
              }

              return false;
          },

          cancelReply : function () {
              var response = this.dom(__respondId),
              holder = this.dom('comment-form-place-holder'), input = this.dom('comment-parent');

              if (null != input) {
                  input.parentNode.removeChild(input);
              }

              if (null == holder) {
                  return true;
              }

              this.dom('cancel-comment-reply-link').style.display = 'none';
              if(null!=this.currentParent){
                this.dom('comment-reply-'+this.currentParent).style.display = '';
              }
              this.currentParent = null;
              holder.parentNode.insertBefore(response, holder);
              return false;
          }
      };
  })();
  <?php if ($this->options->commentsAntiSpam && $this->is('single')): ?>
  (function () {
      var event = document.addEventListener ? {
          add: 'addEventListener',
          triggers: ['scroll', 'mousemove', 'keyup', 'touchstart'],
          load: 'DOMContentLoaded'
      } : {
          add: 'attachEvent',
          triggers: ['onfocus', 'onmousemove', 'onkeyup', 'ontouchstart'],
          load: 'onload'
      }, added = false;

      var r = document.getElementById(__respondId),
          input = document.createElement('input');
      input.type = 'hidden';
      input.name = '_';
      input.value = window.__onece;

      if (null != r) {
          var forms = r.getElementsByTagName('form');
          if (forms.length > 0) {
              function append() {
                  if (!added) {
                      forms[0].appendChild(input);
                      added = true;
                  }
              }
          
              for (var i = 0; i < event.triggers.length; i ++) {
                  var trigger = event.triggers[i];
                  document[event.add](trigger, append);
                  window[event.add](trigger, append);
              }
          }
      }
  })();
  <?php endif;?>

  <?php if($replyId = $this->request->filter('int')->replyTo): ?>
    TypechoComment.reply('comment-<?php echo $replyId;?>', <?php echo $replyId;?>);
  <?php endif;?>
<?php endif;?>
</script>

</div> <!-- end #page-->
<?php
  $this->footer();
  $switchEnablePjax = !empty($this->options->switchEnable) && in_array('enablePjax', $this->options->switchEnable);
  $switchEnablePlayer = !empty($this->options->switchEnable) && in_array('ShowMusicPlayer', $this->options->switchEnable);
?>
<script type="text/javascript" data-no-instant="true" src="https://apps.bdimg.com/libs/highlight.js/9.1.0/highlight.min.js"></script>
<?php if($switchEnablePjax):?><script type="text/javascript" data-no-instant="true" src="/usr/themes/armx/js/instantclick.js"></script><?php endif; ?>
<script type="text/javascript" data-no-instant="true" src="/usr/themes/armx/js/main.js"></script>
<script type="text/javascript" data-no-instant="true">
<?php if( $switchEnablePjax ):?>
/**
 * InstantClick
 */
if(InstantClick && InstantClick.supported){
  InstantClick.expire(60*1000); // 设置缓存时间60秒
  InstantClick.content('page');
  InstantClick.on('change', function(init){
    !init && pageInit();
  });
  InstantClick.init('mousedown');
}
<?php endif;?>
pageInit();

<?php $ArmX_Plugin_Config = $this->options->plugin(ArmX_Plugin::NAME); if($ArmX_Plugin_Config && $ArmX_Plugin_Config->api && in_array('music', $ArmX_Plugin_Config->api) && $switchEnablePlayer ):?>

var PLAYER = document.createElement('DIV');
    PLAYER.id = 'music-player';
    PLAYER.className = 'music-player';
    document.body.appendChild(PLAYER);
new ArmPlayer(PLAYER, {
  debug:false,
  source: {
     platform:'xiami',
     list: 'album:234282',
     apikey: function(){
        return window.__onece;
     }
  },
  onload: function(musicName){
    ArmMessage.destroy(this.messageId);
    this.messageId = ArmMessage.warn(musicName, {
        icon: 'icon-white-music',
        time: 5000,
        tag: 'music'
     });
  }
});
<?php endif;?>
</script>
</body>
</html>