;(function($){
	$(function(){
		$(".i-logo").remove();
		$("form").each(function(index, form) {
			$('.typecho-option input[type="checkbox"],input[type="radio"]', form).on('change', function(event) {
				event.preventDefault();
				var step = this.id;
				var msg = '';
				var id = this.id.replace('enable-', '') + '-option-group';
				if($("#"+id).length && this.checked){
					step = id;
				}
				if(this.checked){
					switch (true) {
						case /multiSizesImage/i.test(this.value):
							msg = '已启用多尺寸图片，须设置图片尺寸';
							break;

						case /uploadServer/i.test(this.value):
							msg = '已启用静态资源站，须设置站点根目录及访问URL';
							break;

						case /cdnUrl/i.test(this.value):
							msg = '已启用CDN静态加速，须设置加速域名';
							break;

						default:
							// statements_def
							break;
					}
				}
				$('input[name="optionStep"]', form).val(step);
				$('input[name="optionMsg"]', form).val(msg);
				$("form").submit();
			});
		
		});
	});
})(window.jQuery);