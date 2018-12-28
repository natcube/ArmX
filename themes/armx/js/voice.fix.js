'use strict';

var sec2minute = function sec2minute(sec) {
	return [parseInt(sec / 60 % 60), parseInt(sec % 60)].join(':').replace(/\b(\d)\b/g, '0$1');
};
var mcAudio = $('.mc-audio__source')[0];
var mcAudioBar = $('.mc-audio__bar');
var mcAudioBtn = $('.mc-audio__ctl-btn');
var mcAudioTime = $('.mc-audio__ctl-time');
$(mcAudio).on('canplay timeupdate', function () {
	var time = sec2minute(mcAudio.duration - mcAudio.currentTime);
	var outer = 100 - mcAudio.currentTime / mcAudio.duration * 100;
	$(mcAudioTime).text(time);
	$(mcAudioBar).css('transform', 'translateX(-' + outer + '%)');
});
$(mcAudio).on('play', function () {
	$(mcAudioBtn).addClass('play');
});
$(mcAudio).on('ended error abort', function () {
	$(mcAudioBtn).removeClass('play');
});
$(mcAudioBtn).on('click', function () {
	$(mcAudioBtn).toggleClass('play');
	if (mcAudio.paused) {
		mcAudio.play();
	} else {
		mcAudio.pause();
	}
});

var speechList = [];
var speechIndex = 0;
var speechIsGet = false;
$('#post-text2speech').on('click', function () {
	if (speechIsGet) return;
	var $self = $(this);
	var $text = $('#post-text2speech-text');
	var $time = $('#post-text2speech-time');
	var $progress = $('#post-text2speech-progress');
	var currentTime = 0;
	var duration = 0;
	if (speechList.length) {
		var speech = speechList[speechIndex];
		if (!speech.paused) {
			speech.pause();
		} else {
			speech.play();
		}
		return;
	}
	speechIsGet = true;
	if ($("#needpwd").length > 0) {} else {
		$text.text('正在召唤小助手 ...');
	}
	$.get('', { do: 'getSpeech' }, function (r) {
		speechIsGet = false;
		if (!r || !r.data || !Array.isArray(r.data)) {
			$text.text('啊哦，召唤失败，点击重试~');
			return;
		}
		r.data.forEach(function (v) {
			var speech = new window.Audio(v);
			speech.preload = 'metadata';
			speechList.push(speech);
			$(speech).on('play', function () {
				$text.text('正在朗读 ...');
				$self.addClass('isPlaying');
			});
			$(speech).on('pause', function () {
				$text.text('已暂停，点击继续');
				$self.removeClass('isPlaying');
			});
			$(speech).on('loadedmetadata', function () {
				duration = duration + speech.duration;
				$time.text('00:00 / ' + sec2minute(duration));
			});
			$(speech).on('timeupdate', function () {
				var nowTime = currentTime + speech.currentTime;
				$progress.css('width', (nowTime / duration * 100).toFixed(2) + '%');
				$time.text(sec2minute(nowTime) + ' / ' + sec2minute(duration));
			});
			$(speech).on('ended', function () {
				currentTime += speech.duration;
				if (speechIndex >= speechList.length - 1) {
					speechIndex = 0;
					currentTime = 0;
					$text.text('再次召唤小助手');
				} else {
					speechIndex += 1;
					speechList[speechIndex].play();
				}
			});
			$(speech).on('error', function () {
				$text.text('语音资源加载失败');
			});
		});
		if (OS) {
			$text.text('小助手已上线，点击开始朗读');
		} else {
			speechList[0].play();
		}
	});
});
