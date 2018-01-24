<?php
if ($request->isPost()) {
	Typecho_Widget::widget('Widget_Abstract_Contents')->to($post);
	$result = array('error'=>0);
	if (!empty($request->cid) ) {
		if ($request->action === "delete") {
			$id = delete_field_by_name( $request->cid, ArmX_Plugin::THUMB_FIELD, ArmX_Plugin::THUMB_FIELD_TYPE);
		}else{
			if (!empty($request->thumbnail_id)) {
				$id = $post->setField(ArmX_Plugin::THUMB_FIELD, ArmX_Plugin::THUMB_FIELD_TYPE, $request->thumbnail_id, $request->cid);
			}
		}
		if (!is_numeric($id)) {
			$result['error'] = 'error';
		}
	}
	$response->throwJson($result);
}else{
include 'header.php';
$phpMaxFilesize = function_exists('ini_get') ? trim(ini_get('upload_max_filesize')) : 0;
if (preg_match("/^([0-9]+)([a-z]{1,2})$/i", $phpMaxFilesize, $matches)) {
    $phpMaxFilesize = strtolower($matches[1] . $matches[2] . (1 == strlen($matches[2]) ? 'b' : ''));
}
$upload_url = '/action/upload?imagesize=thumbnail';
$cid = !empty($_GET['cid']) ? $_GET['cid'] : '';
if ($cid) {
    Typecho_Widget::widget('Widget_Contents_Attachment_Related', 'parentId=' . $cid)->to($attachment);
    $upload_url .= '&cid='.$cid;
} else {
    Typecho_Widget::widget('Widget_Contents_Attachment_Unattached')->to($attachment);
}
$thumbnail_id = '';
if (!empty($_GET['thumbnail_id'])) {
	$thumbnail_id = $_GET['thumbnail_id'];
}
$tab = $attachment->have() ? 'attachment-list' : 'upload-thumbnail';
$image_src_key = in_array('uploadTypechoRoot', ArmX_Plugin::getConfig('enable')) ? 'path' :'url';
?>
<div class="layer-panel edit-thumbnail-panel" id="post-thumbnail-area">
    <div class="layer-panel-head">
		 <ul class="typecho-option-tabs" id="layer-panel-tabs">
	        <li<?php echo $tab==='upload-thumbnail'?' class="active"':''?>><a href="#upload-thumbnail">上传图片</a></li>
	        <li<?php echo $tab==='attachment-list'?' class="active"':''?>><a href="#attachment-list">图片附件</a></li>
		</ul>
	</div>
	<div class="layer-panel-body">
		<div id="upload-thumbnail" class="layer-panel-tab<?php echo $tab==='upload-thumbnail'?'':' hidden'?>">
			<div class="layer-panel-inner"><div class="layer-panel-uploader"><p>拖动图片文件到任何地方</p><button class="btn" id="post-thumbnail-btn">选择图片</button><p>最大上传文件大小：<?php echo $phpMaxFilesize;?></p></div></div>
		</div>
		<div id="attachment-list" class="layer-panel-tab<?php echo $tab==='attachment-list'?'':' hidden'?>">
			<div class="layer-panel-inner">
				<ul class="layer-panel-attachments clearfix">
<?php while ($attachment->next()): if(!$attachment->attachment->isImage){ continue;} $image = get_small_size_image($attachment->attachment->sizes); ?>
		        <li<?php echo $thumbnail_id == $attachment->cid ? ' class="selected"':'';?> data-cid="<?php $attachment->cid(); ?>" data-url="<?php echo $attachment->attachment->url;?>">
					<a class="layer-panel-imagebox">
						<div class="layer-imagebox-inner">
							<img class="<?php echo $image['width'] > $image['height'] ? 'imagebox-width-image':'imagebox-height-image';?>" src="<?php echo $image[$image_src_key]; ?>">
						</div>
						<span class="layer-imagebox-check"></span>
					</a>
		        </li>
    <?php endwhile; ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="layer-panel-foot">
		<button class="btn primary" id="set-thumbnail">设为缩略图</button>
	</div>
</div>

<?php
include 'common-js.php';
include 'footer.php';
?>
<script src="<?php $options->adminStaticUrl('js', 'moxie.js?v=' . $suffixVersion); ?>"></script>
<script src="<?php $options->adminStaticUrl('js', 'plupload.js?v=' . $suffixVersion); ?>"></script>
<script>
$(function($){

    function thumbnailUploadStart (file) {
        $('.layer-panel-attachments').prepend('<li id="upload-'+file.id+'"><a class="layer-panel-imagebox upload-imagebox"><div class="status-text"><span class="loading"> 上传中...</span></div></a></li>');
        $("#layer-panel-tabs li").eq(1).trigger('click');
    }

    function thumbnailUploadError (error) {
        var file = error.file, code = error.code, word; 
        
        switch (code) {
            case plupload.FILE_SIZE_ERROR:
                word = '<?php _e('图片大小超过限制'); ?>';
                break;
            case plupload.FILE_EXTENSION_ERROR:
                word = '<?php _e('图片扩展名不被支持'); ?>';
                break;
            case plupload.FILE_DUPLICATE_ERROR:
                word = '<?php _e('图片已经上传过'); ?>';
                break;
            case plupload.HTTP_ERROR:
            default:
                word = '<?php _e('上传出现错误'); ?>';
                break;
        }

        var fileError = '<?php _e('%s 上传失败'); ?>'.replace('%s', file.name),
            li, exist = $('#upload-' + file.id);

        if (exist.length > 0) {
            li = exist.find('.loading').removeClass('loading').html(fileError);
        } else {
            li = $('<li id="upload-'+file.id+'"><a class="layer-panel-imagebox upload-imagebox"><div class="status-text"><span>'+fileError+'</span></div></a></li>').prependTo('.layer-panel-attachments');
        }

        li.effect('highlight', {color : '#FBC2C4'}, 1000, function () {
            $(this).remove();
        });

        this.removeFile(file);
    }

    function thumbnailUploadComplete (id, url, data) {
        $li = $('#upload-'+id);
        if (!$li.length) {
        	$li = $('<li />').appendTo('.layer-panel-attachments');
        }
        $li.data('thumbnail', data).addClass('selected').attr('data-cid', data.cid).attr('data-url', url).html('<a class="layer-panel-imagebox">\
						<div class="layer-imagebox-inner">\
							<img class="imagebox-width-image" src="'+url+'">\
						</div>\
						<span class="layer-imagebox-check"></span>\
					</a>').siblings('.selected').removeClass('selected');
    }

    var uploadThumbnail = new plupload.Uploader({
            browse_button   :   $('#post-thumbnail-btn').get(0),
            url             :   '<?php $security->index($upload_url); ?>',
            runtimes        :   'html5,flash,html4',
            flash_swf_url   :   '<?php $options->adminStaticUrl('js', 'Moxie.swf'); ?>',
            drop_element    :   $('#post-thumbnail-area').get(0),
            filters         :   {
                max_file_size       :   '<?php echo $phpMaxFilesize ?>',
                mime_types          :   [{'title' : '<?php _e('允许上传的图片类型'); ?>', 'extensions' : 'gif,jpg,jpeg,png,tiff,bmp'}],
                prevent_duplicates  :   true
            },

            init            :   {
                FilesAdded      :   function (up, files) {
                    for (var i = 0; i < files.length; i ++) {
                        thumbnailUploadStart(files[i]);
                    }
                    uploadThumbnail.start();
                },

                FileUploaded    :   function (up, file, result) {
                    if (200 == result.status) {
                        var data = $.parseJSON(result.response);

                        if (data) {
                            thumbnailUploadComplete(file.id, data[0], data[1]);
                            uploadThumbnail.removeFile(file);
                            return;
                        }
                    }

                    thumbnailUploadError.call(uploadThumbnail, {
                        code : plupload.HTTP_ERROR,
                        file : file
                    });
                },

                Error           :   function (up, error) {
                    thumbnailUploadError.call(uploadThumbnail, error);
                }
            }
        });
    uploadThumbnail.init();
});
</script>
<script type="text/javascript">
$(function($){
	$("#layer-panel-tabs li").on('click', function(event) {
		event.preventDefault();
		$(this).addClass('active').siblings().removeClass('active current');
		var id = $(this).find('a').attr("href");
		$('.layer-panel-tab').not(id).addClass('hidden');
		$(id).removeClass('hidden');
	});

	$(".layer-panel-attachments").on('click', 'li', function(event) {
		event.preventDefault();
		$(this).toggleClass('selected').siblings('.selected').removeClass('selected');
	});

	function setThumbnail(){
		var $selected = $(".layer-panel-attachments").find("li.selected").eq(0);
		if (!$selected || !$selected.length) {
			return layer.alert('请选择缩略图', {icon:0});
		}
		var $cid = $selected.attr('data-cid');
		if (!$cid.length) {
			return layer.alert('无效的图片', {icon:0});
		}
		var src = $selected.attr('data-url');
		var thumbnail = $selected.data('thumbnail');
		$.ajax({
			url: '<?php echo Typecho_Common::url('extending.php?panel=ArmX/edit-thumbnail.php&cid='.$cid, $options->adminUrl) ;?>',
			type: 'post',
			dataType: 'json',
			data: {
				thumbnail_id: $cid
			}
		})
		.done(function(result) {
			if (result.error) {
				layer.alert('设置失败,请重试', {icon:0});
			}else{
				window.parent.setThumbnailSuccess($cid, src, thumbnail);
			}
		})
		.fail(function() {
			layer.alert('设置失败,请重试', {icon:0});
		})
		.always(function() {
			
		});
		
	}

	$("#set-thumbnail").on('click', function(event) {
		event.preventDefault();
		setThumbnail();
	});
});
</script>

<?php
}