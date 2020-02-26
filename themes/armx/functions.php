<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
define('__LAZYIMG__', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVQIW2P8+vXrfwAJpgPg8gE+iwAAAABJRU5ErkJggg==');
define('__LAZYIMG2__', 'data:image/gif;base64,R0lGODlhKwAeAJEAAP///93d3Xq9VAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFFAAAACwDAA0AJQADAAACEpSPAhDtHxacqcr5Lm416f1hBQAh+QQJFAAAACwDAA0AJQADAAACFIyPAcLtDKKcMtn1Mt3RJpw53FYAACH5BAkUAAAALAMADQAlAAMAAAIUjI8BkL0CoxQtrYrenPjcrgDbVAAAOw==');
/*Loding*/define('__LAZYIMG4__', 'data:image/gif;base64,R0lGODlh4ABKAPQAADU1NXZ2dqenp7y8vEdHR1hYWGhoaIODg5CQkJubm7KyssbGxtDQ0Nra2uPj4+zs7PX19fn5+fr6+v39/f///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQEGAD/ACwAAAAA4ABKAAAF/yAkjmRpnmiqrmzrvnAsz3Rt33iu73zv/8CgcEgsGo/IpHLJbDqf0Kh0Sq1ar9isdsvter/gsHhMLpvP6LR6zW673/C4fE6v2+/4vH7P7/v/gIGCg4SFhoeIiYqLjI2Oj5CRkpOUlZaXkg0NOgwOEJqYZwEBOgACEKOhZqk5phADA6plrCYKsSSwAp0jsA6uvb0CCp4iDbavxLJStCMHAATPww8FAAHRn9DUrqnWz8+eA97Uu8pRzK+uD9YOCgC7BKTOngnb8b+u8A/q7uXLpLj80EljMIAeqXzYTnEjMMIUg4DhyPVzck4AAF74ngUocDBBQ4Xx/kFwCDHgRIoiRZBY3NWOgTwRHFEZKFZP5seHpwSefDKqk8+HAQhSg4CA4QODRB06A2lTBD4CsKBJ3Kmkmzh03jYx0MbRaLeiTGmls1iA3lQKE6hCOQuq1ouc6NiqfWPAwIJwM+fWcalRn96/gAMLHky4sOHDiBMrXsy4sePHkCNLnky5suXLmDNr3sy5s+fPoEOLHk26tGk8IQAAIfkEBRgABAAsiAApAAIAAgAAAgOcAgUAIfkEBRgABAAsjAApAAIAAgAAAgPUEAUAIfkEBRgABAAskAApAAIAAgAAAgPUEAUAOw==');
/*Color*/define('__LAZYIMG3__','data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAkIAAAC+AQMAAADjpvIIAAAAA1BMVEXy8vJkA4prAAAAJElEQVRo3u3BMQEAAADCIPunNsYeYAAAAAAAAAAAAAAAAAAQOzbsAAGtxd3QAAAAAElFTkSuQmCC');
/**
 * 主题设置
 * @author NatLiu VirCloud
 * @date   2018-01-24T14:10:44+0800
 * @param  [type]                   $form [description]
 * @return [type]                         [description]
 */
function themeConfig($form) {
  echo "<style>
#use-intro {box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);background-color: #fff;margin: 8px;padding: 8px;padding-left: 20px;margin-bottom: 40px;border-radius: 5px;}select{color:#444;} #typecho-nav-list{display:none;} .typecho-head-nav {padding: 0 10px; background: #20af42;} .typecho-head-nav .operate a{border: none;padding-top: 0px;padding-bottom: 0px;color: rgba(255,255,255,.6);} .typecho-head-nav .operate a:hover {background-color: rgba(0, 0, 0, 0.05);color: #fff;} ul.typecho-option-tabs.fix-tabs.clearfix {background: #1a9c39;} .col-mb-12 {padding: 0px!important;} .typecho-page-title {margin:0;height: 70px;background: #20af42;background-size: cover;padding: 30px;} .typecho-page-title h2{margin: 0px;font-size: 2.28571em;color: #fff;} .typecho-option-tabs{padding: 0px;background: #fff;} .typecho-option-tabs a:hover{background-color: rgba(0, 0, 0, 0.05);color: rgba(255,255,255,.8);} .typecho-option-tabs a{border: none;height: auto;color: rgba(255,255,255,.6);padding: 15px;} li.current {background-color: #FFF;height: 4px;padding: 0 !important;bottom: 0px;} .typecho-option-tabs li.current a, .typecho-option-tabs li.active a{background:none;} .container{margin:0;padding:0;} .body.container {min-width: 100% !important;padding: 0px;} .typecho-option-tabs{margin:0;} .typecho-option-submit button {float: right;background: #20af42;box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);color: #FFF;} .typecho-option-submit button:hover,.typecho-option-submit button:active,.typecho-option-submit button:focus {background: #1a9036;} .typecho-option-tabs li{margin-left:20px;} .typecho-option{border-radius: 3px;background: #fff;padding: 12px 16px;} .col-mb-12{padding-left: 0px!important;} .typecho-option-submit{background:none!important;} .typecho-option {float: left;} .typecho-option span {margin-right: 0;} .typecho-option label.typecho-label {font-weight: 500;margin-bottom: 20px;margin-top: 10px;font-size: 16px;padding-bottom: 5px;border-bottom: 1px dashed rgba(0,0,0,0.2);} .typecho-page-main .typecho-option input.text {width: 100%;} input[type=text], textarea {border: none;border-bottom: 1px solid rgba(80, 80, 80, 0.6); color: rgba(25, 25, 25, 0.6);outline: none;border-radius: 0;}input[type=text]:hover,input[type=text]:focus,input[type=text]:active{border-bottom-color:rgba(0,0,0,.60);} .typecho-option-submit {position: fixed;right: 32px;bottom: 32px;} .typecho-foot {padding: 16px 40px;color: rgb(158, 158, 158);background-color: rgb(66, 66, 66);margin-top: 80px;} @media screen and (max-width: 480px){.typecho-option {width: 94% !important;margin-bottom: 20px !important;}} @media screen and (min-device-width: 1024px) { ::-webkit-scrollbar-track {background-color: rgba(255,255,255,0);} ::-webkit-scrollbar {width: 6px;background-color: rgba(255,255,255,0);} ::-webkit-scrollbar-thumb {border-radius: 3px;background-color: rgba(193,193,193,1);}} .row {margin: 0px;} .message{background-color:#20af42 !important;color:#fff;} .success{background-color:#20af42;color:#fff;}
#use-intro {box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);background-color: #fff;margin: 8px;padding: 8px;padding-left: 20px;margin-bottom: 40px;border-radius: 5px;} #typecho-nav-list{display:none;} .typecho-head-nav {padding: 0 10px; background: #20af42;} .typecho-head-nav .operate a{border: none;padding-top: 0px;padding-bottom: 0px;color: rgba(255,255,255,.6);} .typecho-head-nav .operate a:hover {background-color: rgba(0, 0, 0, 0.05);color: #fff;} ul.typecho-option-tabs.fix-tabs.clearfix {background: #1a9c39;} .col-mb-12 {padding: 0px!important;} .typecho-page-title {margin:0;height: 70px;background: #20af42;background-size: cover;padding: 30px;} .typecho-page-title h2{margin: 0px;font-size: 2.28571em;color: #fff;} .typecho-option-tabs{padding: 0px;background: #fff;} .typecho-option-tabs a:hover{background-color: rgba(0, 0, 0, 0.05);color: rgba(255,255,255,.8);} .typecho-option-tabs a{border: none;height: auto;color: rgba(255,255,255,.6);padding: 15px;} li.current {background-color: #FFF;height: 4px;padding: 0 !important;bottom: 0px;} .typecho-option-tabs li.current a, .typecho-option-tabs li.active a{background:none;} .container{margin:0;padding:0;} .body.container {min-width: 100% !important;padding: 0px;} .typecho-option-tabs{margin:0;} .typecho-option-submit button {float: right;background: #20af42;box-shadow: 0 2px 2px 0 rgba(0,0,0,.14),0 3px 1px -2px rgba(0,0,0,.2),0 1px 5px 0 rgba(0,0,0,.12);color: #FFF;} .typecho-option-submit button:hover,.typecho-option-submit button:active,.typecho-option-submit button:focus {background: #1a9036;} .typecho-option-tabs li{margin-left:20px;} .typecho-option{border-radius: 3px;background: #fff;padding: 12px 16px;} .col-mb-12{padding-left: 0px!important;} .typecho-option-submit{background:none!important;} .typecho-option {float: left;} .typecho-option span {margin-right: 0;} .typecho-option label.typecho-label {font-weight: 500;margin-bottom: 20px;margin-top: 10px;font-size: 16px;padding-bottom: 5px;border-bottom: 1px dashed rgba(0,0,0,0.2);} .typecho-page-main .typecho-option input.text {width: 100%;} input[type=text], textarea {border: none;border-bottom: 1px solid rgba(80, 80, 80, 0.6); color: rgba(25, 25, 25, 0.6);outline: none;border-radius: 0;}input[type=text]:hover,input[type=text]:focus,input[type=text]:active{border-bottom-color:rgba(0,0,0,.60);} .typecho-option-submit {position: fixed;right: 32px;bottom: 32px;} .typecho-foot {padding: 16px 40px;color: rgb(158, 158, 158);background-color: rgb(66, 66, 66);margin-top: 80px;} @media screen and (max-width: 480px){.typecho-option {width: 94% !important;margin-bottom: 20px !important;}} @media screen and (min-device-width: 1024px) { ::-webkit-scrollbar-track {background-color: rgba(255,255,255,0);} ::-webkit-scrollbar {width: 6px;background-color: rgba(255,255,255,0);} ::-webkit-scrollbar-thumb {border-radius: 3px;background-color: rgba(193,193,193,1);}} .row {margin: 0px;} .message{background-color:#20af42 !important;color:#fff;} .success{background-color:#20af42;color:#fff;}
#typecho-option-item-switchEnable-0,#typecho-option-item-wailian-1,#typecho-option-item-qrcodesrc-2,#typecho-option-item-src_add-3,#typecho-option-item-cdn_add-4,#typecho-option-item-createTime-5,#typecho-option-item-ChromeThemeColor-6,#typecho-option-item-isdonate-7,#typecho-option-item-donate_img-8,#typecho-option-item-lazyimg-9,#typecho-option-item-nightmode-10,#typecho-option-item-analysistype-11,#typecho-option-item-analysis-12,#typecho-option-item-mobilemode-13,#typecho-option-item-loadingtype-14,#typecho-option-item-colortype-15,#typecho-option-item-seoenable-16,#typecho-option-item-logoUrl-17,#typecho-option-item-archimg-18,#typecho-option-item-faviconimg-19,#typecho-option-item-appleimg-20,#typecho-option-item-applemode-21,#typecho-option-item-headerdesc-22,#typecho-option-item-headersite-23,#typecho-option-item-headerdropsite-24,#typecho-option-item-switch-25,#typecho-option-item-shortcode-26,#typecho-option-item-text2speech-27,#typecho-option-item-text2speechSex-28,#typecho-option-item-text2speechSpeed-29,#typecho-option-item-baiduBDUSS-30,#typecho-option-item-text2speechLength-31,#typecho-option-item-text2speechBegin-32,#typecho-option-item-text2speechEnd-33,#typecho-option-item-slimg-34,#typecho-option-item-commentfun-35,#typecho-option-item-showuatype-36,#typecho-option-item-allowcomment-37,#typecho-option-item-isyiyan-38,#typecho-option-item-inputyiyan-39,#typecho-option-item-yiyansource-40,#typecho-option-item-defaultcomment-41,#typecho-option-item-qqavatar-42,#typecho-option-item-defaultavatar-43,#typecho-option-item-cacheTime-44,#typecho-option-item-username-45,#typecho-option-item-showusertype-46,#typecho-option-item-smilescdn-47,#typecho-option-item-isme-48,#typecho-option-item-ismeimg-49,#typecho-option-item-ismeaboutimg-50,#typecho-option-item-ismeabout-51,#typecho-option-item-ismeqq-52,#typecho-option-item-ismewechat-53,#typecho-option-item-ismetel-54,#typecho-option-item-ismegithub-55,#typecho-option-item-ismeaemail-56,#typecho-option-item-isabout-57,#typecho-option-item-isrecommend-58,#typecho-option-item-istags-59,#typecho-option-item-showtagtype-60,#typecho-option-item-footerswitch-61,#typecho-option-item-isstat-62,#typecho-option-item-anbei-63,#typecho-option-item-wangbei-64,#typecho-option-item-copyright-65,#typecho-option-item-powerby-66,#typecho-option-item-footersite-67,#typecho-option-item-showad-68,#typecho-option-item-showservice1-69,#typecho-option-item-showservice1link-70,#typecho-option-item-showservice2-71,#typecho-option-item-showservice2link-72,#typecho-option-item-showad1-73,#typecho-option-item-showad1link-74,#typecho-option-item-showad2-75,#typecho-option-item-showad2link-76,#typecho-option-item-googlead-77,#typecho-option-item-googleadscript-78,#typecho-option-item-postad-79,#typecho-option-item-postadimg-80,#typecho-option-item-service1alt-81,#typecho-option-item-service2alt-82,#typecho-option-item-ad1alt-83,#typecho-option-item-ad2alt-84,#typecho-option-item-psotalt-85,#typecho-option-item-sidealt-86,#typecho-option-item-sidehb_img-87,#typecho-option-item-sideurl-88,#typecho-option-item-advanced-89,#typecho-option-item-scrollpix-90,#typecho-option-item-scrolltime-91,#typecho-option-item-splitcnt-92,#typecho-option-item-pexpire-93
{background-color: #fff;margin: 8px 1%;padding: 8px 2%;}
#typecho-option-item-switchEnable-0:hover,#typecho-option-item-wailian-1:hover,#typecho-option-item-qrcodesrc-2:hover,#typecho-option-item-src_add-3:hover,#typecho-option-item-cdn_add-4:hover,#typecho-option-item-createTime-5:hover,#typecho-option-item-ChromeThemeColor-6:hover,#typecho-option-item-isdonate-7:hover,#typecho-option-item-donate_img-8:hover,#typecho-option-item-lazyimg-9:hover,#typecho-option-item-nightmode-10:hover,#typecho-option-item-analysistype-11:hover,#typecho-option-item-analysis-12:hover,#typecho-option-item-mobilemode-13:hover,#typecho-option-item-loadingtype-14:hover,#typecho-option-item-colortype-15:hover,#typecho-option-item-seoenable-16:hover,#typecho-option-item-logoUrl-17:hover,#typecho-option-item-archimg-18:hover,#typecho-option-item-faviconimg-19:hover,#typecho-option-item-appleimg-20:hover,#typecho-option-item-applemode-21:hover,#typecho-option-item-headerdesc-22:hover,#typecho-option-item-headersite-23:hover,#typecho-option-item-headerdropsite-24:hover,#typecho-option-item-switch-25:hover,#typecho-option-item-shortcode-26:hover,#typecho-option-item-text2speech-27:hover,#typecho-option-item-text2speechSex-28:hover,#typecho-option-item-text2speechSpeed-29:hover,#typecho-option-item-baiduBDUSS-30:hover,#typecho-option-item-text2speechLength-31:hover,#typecho-option-item-text2speechBegin-32:hover,#typecho-option-item-text2speechEnd-33:hover,#typecho-option-item-slimg-34:hover,#typecho-option-item-commentfun-35:hover,#typecho-option-item-showuatype-36:hover,#typecho-option-item-allowcomment-37:hover,#typecho-option-item-isyiyan-38:hover,#typecho-option-item-inputyiyan-39:hover,#typecho-option-item-yiyansource-40:hover,#typecho-option-item-defaultcomment-41:hover,#typecho-option-item-qqavatar-42:hover,#typecho-option-item-defaultavatar-43:hover,#typecho-option-item-cacheTime-44:hover,#typecho-option-item-username-45:hover,#typecho-option-item-showusertype-46:hover,#typecho-option-item-smilescdn-47:hover,#typecho-option-item-isme-48:hover,#typecho-option-item-ismeimg-49:hover,#typecho-option-item-ismeaboutimg-50:hover,#typecho-option-item-ismeabout-51:hover,#typecho-option-item-ismeqq-52:hover,#typecho-option-item-ismewechat-53:hover,#typecho-option-item-ismetel-54:hover,#typecho-option-item-ismegithub-55:hover,#typecho-option-item-ismeaemail-56:hover,#typecho-option-item-isabout-57:hover,#typecho-option-item-isrecommend-58:hover,#typecho-option-item-istags-59:hover,#typecho-option-item-showtagtype-60:hover,#typecho-option-item-footerswitch-61:hover,#typecho-option-item-isstat-62:hover,#typecho-option-item-anbei-63:hover,#typecho-option-item-wangbei-64:hover,#typecho-option-item-copyright-65:hover,#typecho-option-item-powerby-66:hover,#typecho-option-item-footersite-67:hover,#typecho-option-item-showad-68:hover,#typecho-option-item-showservice1-69:hover,#typecho-option-item-showservice1link-70:hover,#typecho-option-item-showservice2-71:hover,#typecho-option-item-showservice2link-72:hover,#typecho-option-item-showad1-73:hover,#typecho-option-item-showad1link-74:hover,#typecho-option-item-showad2-75:hover,#typecho-option-item-showad2link-76:hover,#typecho-option-item-googlead-77:hover,#typecho-option-item-googleadscript-78:hover,#typecho-option-item-postad-79:hover,#typecho-option-item-postadimg-80:hover,#typecho-option-item-service1alt-81:hover,#typecho-option-item-service2alt-82:hover,#typecho-option-item-ad1alt-83:hover,#typecho-option-item-ad2alt-84:hover,#typecho-option-item-psotalt-85:hover,#typecho-option-item-sidealt-86:hover,#typecho-option-item-sidehb_img-87:hover,#typecho-option-item-sideurl-88:hover,#typecho-option-item-advanced-89:hover,#typecho-option-item-scrollpix-90:hover,#typecho-option-item-scrolltime-91:hover,#typecho-option-item-splitcnt-92:hover,#typecho-option-item-pexpire-93:hover
{box-shadow: 0 2px 2px 0 rgba(110,110,110,.14),0 3px 1px -2px rgba(110,110,110,.2),0 1px 5px 0 rgba(110,110,110,.12);border-radius: 5px;}
#typecho-option-item-switchEnable-0 .multiline,#typecho-option-item-mobilemode-13 .multiline,#typecho-option-item-seoenable-16 .multiline,#typecho-option-item-switch-25 .multiline,#typecho-option-item-commentfun-35 .multiline,#typecho-option-item-isme-48 .multiline,#typecho-option-item-footerswitch-61 .multiline,#typecho-option-item-showad-68 .multiline,#typecho-option-item-googlead-77 .multiline,#typecho-option-item-advanced-89 .multiline
{display:inline-table;padding-right: 5px;}
#typecho-option-item-seoenable-16,#typecho-option-item-headerdropsite-24,#typecho-option-item-slimg-34,#typecho-option-item-smilescdn-47,#typecho-option-item-showtagtype-60,#typecho-option-item-footersite-67,#typecho-option-item-sidehb_img-87
{margin-bottom: 40px;} 
#typecho-option-item-wailian-1 label,#typecho-option-item-src_add-3 label,#typecho-option-item-cdn_add-4 label,#typecho-option-item-createTime-5 label,#typecho-option-item-analysis-12 label,#typecho-option-item-logoUrl-17 label,#typecho-option-item-archimg-18 label,#typecho-option-item-faviconimg-19 label,#typecho-option-item-appleimg-20 label,#typecho-option-item-baiduBDUSS-30 label,#typecho-option-item-username-45 label,#typecho-option-item-smilescdn-47 label,#typecho-option-item-ismeimg-49 label
{color:red;}
#typecho-option-item-donate_img-8 label,#typecho-option-item-headerdesc-22 label,#typecho-option-item-headersite-23 label,#typecho-option-item-headerdropsite-24 label,#typecho-option-item-defaultavatar-43 label,#typecho-option-item-ismeabout-51 label,#typecho-option-item-ismewechat-53 label,#typecho-option-item-ismetel-54 label,#typecho-option-item-copyright-65 label,#typecho-option-item-powerby-66 label,#typecho-option-item-footersite-67 label
{color:green;}
#slimg-0-35
{width:100%;}
#typecho-option-item-switchEnable-0,#typecho-option-item-wailian-1,#typecho-option-item-qrcodesrc-2,#typecho-option-item-analysis-12,#typecho-option-item-mobilemode-13,#typecho-option-item-seoenable-16,#typecho-option-item-headersite-23,#typecho-option-item-headerdropsite-24,#typecho-option-item-switch-25,#typecho-option-item-baiduBDUSS-30,#typecho-option-item-slimg-34,#typecho-option-item-commentfun-35,#typecho-option-item-isme-48,#typecho-option-item-footersite-67,#typecho-option-item-showad-68,#typecho-option-item-googlead-77,#typecho-option-item-googleadscript-78,#typecho-option-item-advanced-89
{width:93%;}
#typecho-option-item-src_add-3,#typecho-option-item-cdn_add-4,#typecho-option-item-createTime-5,#typecho-option-item-ChromeThemeColor-6,#typecho-option-item-isdonate-7,#typecho-option-item-donate_img-8,#typecho-option-item-loadingtype-14,#typecho-option-item-colortype-15,#typecho-option-item-logoUrl-17,#typecho-option-item-archimg-18,#typecho-option-item-faviconimg-19,#typecho-option-item-appleimg-20,#typecho-option-item-applemode-21,#typecho-option-item-headerdesc-22,#typecho-option-item-shortcode-26,#typecho-option-item-text2speech-27,#typecho-option-item-text2speechSex-28,#typecho-option-item-text2speechSpeed-29,#typecho-option-item-showuatype-36,#typecho-option-item-allowcomment-37,#typecho-option-item-isyiyan-38,#typecho-option-item-inputyiyan-39,#typecho-option-item-yiyansource-40,#typecho-option-item-defaultcomment-41,#typecho-option-item-qqavatar-42,#typecho-option-item-defaultavatar-43,#typecho-option-item-cacheTime-44,#typecho-option-item-username-45,#typecho-option-item-showusertype-46,#typecho-option-item-smilescdn-47,#typecho-option-item-ismeimg-49,#typecho-option-item-ismeaboutimg-50,#typecho-option-item-ismeabout-51,#typecho-option-item-ismeqq-52,#typecho-option-item-ismewechat-53,#typecho-option-item-ismetel-54,#typecho-option-item-ismegithub-55,#typecho-option-item-ismeaemail-56,#typecho-option-item-anbei-63,#typecho-option-item-wangbei-64,#typecho-option-item-copyright-65,#typecho-option-item-powerby-66,#typecho-option-item-showservice1-69,#typecho-option-item-showservice1link-70,#typecho-option-item-showservice2-71,#typecho-option-item-showservice2link-72,#typecho-option-item-showad1-73,#typecho-option-item-showad1link-74,#typecho-option-item-showad2-75,#typecho-option-item-showad2link-76,#typecho-option-item-postad-79,#typecho-option-item-postadimg-80,#typecho-option-item-service1alt-81,#typecho-option-item-service2alt-82,#typecho-option-item-ad1alt-83,#typecho-option-item-ad2alt-84,#typecho-option-item-psotalt-85,#typecho-option-item-sidealt-86,#typecho-option-item-sidehb_img-87,#typecho-option-item-sideurl-88,#typecho-option-item-scrollpix-90,#typecho-option-item-scrolltime-91,#typecho-option-item-splitcnt-92,#typecho-option-item-pexpire-93
{width:43.5%;}
#typecho-option-item-lazyimg-9,#typecho-option-item-nightmode-10,#typecho-option-item-analysistype-11,#typecho-option-item-text2speechLength-31,#typecho-option-item-text2speechBegin-32,#typecho-option-item-text2speechEnd-33,#typecho-option-item-isstat-62
{width:27%}
#typecho-option-item-isabout-57,#typecho-option-item-isrecommend-58,#typecho-option-item-istags-59
{width: 15%;}
#typecho-option-item-showtagtype-60
{width: 30%;}
#typecho-option-item-footerswitch-61
{width: 60%;}
#typecho-option-item-lazyimg-9 li
{padding-bottom: 21px;}
#typecho-option-item-isdonate-7 li,#typecho-option-item-loadingtype-14 li,#typecho-option-item-applemode-21 li,#typecho-option-item-yiyansource-40 li,#typecho-option-item-qqavatar-42 li,#typecho-option-item-showusertype-46 li
{padding-bottom: 10px;}
#typecho-option-item-isstat-62 li
{padding-bottom: 8.38px;}
#typecho-option-item-analysistype-11 li
{padding-bottom: 2px;}
#typecho-option-item-analysis-12 textarea
{height: 40px;}
#typecho-option-item-headerdropsite-24 textarea
{height: 80px;}
#typecho-option-item-headersite-23 textarea
{height: 120px;}
#typecho-option-item-footersite-67 textarea
{height: 150px;}
#typecho-option-item-googleadscript-78 textarea
{height: 170px;}
#typecho-option-item-switchEnable-0 li label,#typecho-option-item-logoUrl-17 li label,#typecho-option-item-switch-25 li label,#typecho-option-item-commentfun-35 li label,#typecho-option-item-isme-48 li label,#typecho-option-item-footerswitch-61 li label,#typecho-option-item-showad-68 li label,#typecho-option-item-advanced-89 li label
{font-weight: bold;text-shadow: 1px 0 0 #F5F5F5, 0 1px 0 #F5F5F5, 0 -1px 0 #F5F5F5, -1px 0 0 #F5F5F5, 1px 0 1px #F5F5F5, 0 1px 1px #F5F5F5, 0 -1px 1px #F5F5F5, -1px 0 1px #F5F5F5;filter: Dropshadow(offx = 1, offy = 0, color = #F5F5F5) Dropshadow(offx = 0, offy = 1, color = #F5F5F5) Dropshadow(offx = 0, offy = -1, color = #F5F5F5) Dropshadow(offx = -1, offy = 0, color = #F5F5F5);}
#typecho-option-item-switchEnable-0 li .multiline label,#typecho-option-item-logoUrl-17 li .multiline label,#typecho-option-item-switch-25 li .multiline label,#typecho-option-item-commentfun-35 li .multiline label,#typecho-option-item-isme-48 li .multiline label,#typecho-option-item-footerswitch-61 li .multiline label,#typecho-option-item-showad-68 li .multiline label,#typecho-option-item-advanced-89 li .multiline label
{font-weight: normal;text-shadow: none;}
</style>";
  echo '<p style="font-size:14px;" id="use-intro"><span style="display:block;margin-bottom:10px;margin-top:10px;font-size:18px;color:#20af42;">Armx Mod for Typecho</span>
<span style="display:block;margin-bottom:10px;margin-top:10px;font-size:15px;">简约而不简单，支持全站 Pjax 等丰富的自定义功能，欢迎体验！</span>
<span style="display:block;margin-bottom:10px;margin-top:10px;color:#999;">Tips：功能强大意味着配置项多，要有耐心哦，<span style="color:red;">红色字体</span>为必须配置项，<span style="color:green;">绿色字体</span>为建议配置项，黑色若无特殊需求保持默认即可。</span>
<span style="margin-bottom:10px;display:block"><a href="https://vircloud.net/default/change-theme.html#comments" target="_blank">帮助&支持&建议&反馈</a></span></p>';
  
$options = Typecho_Widget::widget( 'Widget_Options' );
//*****************************************************全局*****************************************************
$switchEnable = new Typecho_Widget_Helper_Form_Element_Checkbox('switchEnable', array('enablePjax' => _t('全站 Pjax'),'EnableCopyright' =>_t( '版权提示'),'GB2Site' => _t('简繁互译'),'CountOnline' =>_t( '在线统计'),'EnableCompression' => _t('页面压缩'),'EnableNotice'=> _t('来路提示'),'enableGray' => _t('全局灰色'),'AutoScroll' => _t('自动滚屏'), 'EnableKey' => _t('按键导航') ),array('enablePjax','EnableCopyright','GB2Site','CountOnline','AutoScroll'), _t('全局功能'),_t('除全站 Pjax 外，其余及以下功能均为魔改版功能。全站 Pjax 开启时来路提示、按键导航不生效。页面压缩可能造成部分页面异常。'));
$form->addInput($switchEnable->multiMode());
$Wailian = new Typecho_Widget_Helper_Form_Element_Text('wailian', NULL, '/ext/link/?url=' , _t('外链处理'), _t('输入外链处理地址，在输出文章时将自动对外链进行替换，需要下载 <a href="https://dl.vircloud.net/Code/typecho/plugins/" target="_blank">链接转换（link.zip）</a>文件，用法参见<a href="https://vircloud.net/default/change-theme.html#article-header-33" target="_blank"> 主题页说明 </a>。'));
$form->addInput($Wailian);
$qrcodeSrc = new Typecho_Widget_Helper_Form_Element_Radio( 'qrcodesrc', array( '0' => '自建', '1' => 'KD128' ), '1', _t('二维码 API'),_t('文章二维码生成 API，在线可能不稳定影响打开速度，建议自建，搭建方法参见 <a href="https://vircloud.net/default/change-theme.html#article-header-30" target="_blank">主题页说明</a>。')
);
$form->addInput($qrcodeSrc);
$srcAddress = new Typecho_Widget_Helper_Form_Element_Text('src_add', NULL, '/usr/uploads/', _t('CDN 替换前地址'),_t('附件存放目录，需要替换成 CDN 的路径，为空则不生效。'));
$form->addInput($srcAddress);
$cdnAddress = new Typecho_Widget_Helper_Form_Element_Text('cdn_add', NULL, NULL, _t('CDN 替换后地址'),_t('CDN 存储地址，注意文件要对应，推荐使用腾讯云 COS。'));
$form->addInput($cdnAddress);
$siteCreate = new Typecho_Widget_Helper_Form_Element_Text( 'createTime', null, '2018-12-27 10:00:00', _t( '建站时间' ), _t( '格式严格遵照 yyyy-mm-dd hh:mm:ss，否则可能会导致页面显示不正常。' ));
$form->addInput( $siteCreate );
$ChromeThemeColor = new Typecho_Widget_Helper_Form_Element_Text('ChromeThemeColor', NULL, _t('#FFFFFF'), _t('Chrome 地址栏颜色'), _t('安卓系统下的 Chrome 浏览器顶部的地址栏颜色，请填写正确的颜色代码。'));
$form->addInput($ChromeThemeColor);
$isDonate = new Typecho_Widget_Helper_Form_Element_Radio('isdonate',array('0' => _t('禁用'), '1' => _t('启用') ),'1',_t('赞赏功能'),_t('是否启用赞赏功能，配合 <a href="https://dl.vircloud.net/Code/typecho/plugins/" target="_blank">Like 插件</a>。'));
$form->addInput($isDonate);
$donateImg =new Typecho_Widget_Helper_Form_Element_Text('donate_img', NULL, '/usr/themes/armx/img/weixinpay.png', _t('支付二维码'), _t('使用微信赞赏码，或多码合一，大小 250x250。'));
$form->addInput($donateImg);
$lazyImg = new Typecho_Widget_Helper_Form_Element_Radio( 'lazyimg',array( '1' => '开启','0' => '关闭' ), '0',_t('图片懒加载'),_t('一定程度上可降低服务器负载。')
);
$form->addInput($lazyImg);
$NightMode = new Typecho_Widget_Helper_Form_Element_Radio( 'nightmode', array( '0' => '禁用', '1' => '启用', '2' => '自动启用（18:00-07:00）' ), '1', _t('夜间模式'), _t('配色更暗，适合晚上浏览。'));
$form->addInput($NightMode);
$analysistype = new Typecho_Widget_Helper_Form_Element_Radio( 'analysistype',array( '1' => '谷歌','0' => '其他' ), '1',_t('统计类型'),_t('用的哪家的统计服务？推荐 Google Analysis。')
);
$form->addInput($analysistype);
$analysis = new Typecho_Widget_Helper_Form_Element_Textarea('analysis', NULL, NULL, _t('统计代码'), _t('统计代码，注意：如果是 Google Analysis 填写 ID 即可，其他家则填写<b>包括"<\script\>"标签</b>的完整代码！仅 Google Analysis 及百度支持 Pjax。'));
$form->addInput($analysis); 
$MobileMode = new Typecho_Widget_Helper_Form_Element_Checkbox('mobilemode', array('ShowService' => _t('本站服务'),'Showistags' => _t('热门标签'),'Showisstat' => _t('侧栏统计'),'Showads' => _t('主机推荐'),'Showisrecommend' => _t('随机文章'),'Showisabout' => _t('相关文章'),'Showisaboutme' => _t('关于博主')), array('Showistags'),_t('手机选项'), _t('当相应功能开启时，在手机模式下是否禁用相应模块，勾选表示禁用不显示。'));
$form->addInput($MobileMode->multiMode());
$Loadingtype = new Typecho_Widget_Helper_Form_Element_Radio( 'loadingtype', array( '0' => '不显示', '1' => '页头滚动条', '2' => '页角转圈圈' ), '2', _t('Pjax 进度条样式'),_t('开启 Pjax 功能时，进度条样式是什么？')
);
$form->addInput($Loadingtype);
$ColorType =new Typecho_Widget_Helper_Form_Element_Text('colortype', NULL, NULL, _t('主题风格'), _t('填写六位颜色代码，如 25B15E。'));
$form->addInput($ColorType);
//*****************************************************页头*****************************************************
$seoEnable = new Typecho_Widget_Helper_Form_Element_Checkbox('seoenable', array('enableSearch' => _t('结构化搜索'),'enableGlobalS' => _t('结构化分享'),'enableShare' => _t('QQ 分享')),array('enableSearch','enableGlobalS','enableShare'),_t('SEO 增强功能'),_t('以 Google Search 为基准，未必所有搜索引擎都支持。'));
$form->addInput($seoEnable->multiMode());
$logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, '/usr/themes/armx/img/header-logo.png', _t('页头功能'), _t('网站头部 LOGO, 建议尺寸 112x55。'));
$form->addInput($logoUrl);
$ArchImg = new Typecho_Widget_Helper_Form_Element_Text('archimg', NULL, '/usr/themes/armx/img/favicon.png', _t('归档 Logo'), _t('归档页 Logo，建议大小 144x144。'));
$form->addInput($ArchImg);
$Faviconimg = new Typecho_Widget_Helper_Form_Element_Text('faviconimg', NULL, '/usr/themes/armx/img/favicon.ico', _t('Favicon'), _t('默认为根目录下的 favicon.ico，显示于页签左侧。'));
$form->addInput($Faviconimg);
$AppleImg = new Typecho_Widget_Helper_Form_Element_Text('appleimg', NULL, '/usr/themes/armx/img/apple-touch-icon.png', _t('网站图标'), _t('APP 分享时显示的图标，以及 Safari 书签图标。'));
$form->addInput($AppleImg);
$AppleMode = new Typecho_Widget_Helper_Form_Element_Radio( 'applemode', array( '0' => '禁用', '1' => '启用'), '1', _t('Apple 模式'), _t('根据网站图标自动插入尺寸代码，详见<a href="https://vircloud.net/default/change-theme.html#article-header-38" target="_blank">主题页说明</a>。'));
$form->addInput($AppleMode);
$HeaderDesc = new Typecho_Widget_Helper_Form_Element_Text('headerdesc', NULL, 'Learning&Sharing', _t('标题后缀'), _t('导航栏标题后缀，会自动添加“ - ”隔开，为空则不显示。'));
$form->addInput($HeaderDesc); 
$HeaderSite = new Typecho_Widget_Helper_Form_Element_Textarea('headersite', NULL, '<li><a href="/link.html" id="link">朋友圈</a></li>
<li><a href="/cross.html" id="cross">时光机</a></li>
<li><a href="/guestbook.html" id="guestbook">留言板</a></li>
<li><a href="/saying.html" id="saying">动态</a></li>
<li><a href="/about.html" id="about">关于</a></li>', _t('页头导航'), _t('页面头部链接，按示例填写完整的 html 代码。'));
$form->addInput($HeaderSite); 
$HeaderDropSite = new Typecho_Widget_Helper_Form_Element_Textarea('headerdropsite', NULL, '<a href="https://vircloud.net/go/vultr/" target="_blank" rel="nofollow">免费主机</a>
<a href="https://vircloud.net/default/change-theme.html" title="本站使用主题">ArmxMod</a>
<a href="https://vircloud.net/change-theme-1.html" title="Armx Mod for Typecho 短代码演示">短代码</a>', _t('右侧导航'), _t('页头右侧下拉链接，按示例填写完整的 html 代码，默认显示所有独立页面，朋友圈、时光鸡等独立页面创建时记得添加隐藏属性。'));
$form->addInput($HeaderDropSite); 
//*****************************************************文章*****************************************************
$switch = new Typecho_Widget_Helper_Form_Element_Checkbox('switch',array('PostMagic' => _t( '状态标识' ),'TypeColorful' => _t( '打字特效' ),'CountPost' => _t( '字数统计' ),'Commentfirst' => _t( '回复可见' ),'SplitPost' => _t('文章分页')),array('PostMagic','TypeColorful','CountPost','Commentfirst','SplitPost'),_t('文章功能') ,_t('状态：最新、更新、置顶。'));
$form->addInput($switch->multiMode());
$shortcode = new Typecho_Widget_Helper_Form_Element_Radio('shortcode',array('0' => _t('禁用'), '1' => _t('启用')), '1',_t('短代码支持'),_t('用法参见 <a href="https://vircloud.net/change-theme-1.html" target="_blank">Armx Mod for Typecho 短代码演示</a>。'));
$form->addInput($shortcode);
$text2speech = new Typecho_Widget_Helper_Form_Element_Radio('text2speech',array('1' => '开启','0' => '关闭'),'0', _t('语音朗读'),_t('启用文章（不含独立页）语音朗读小助手功能？'));
$form->addInput($text2speech);
$text2speechSex = new Typecho_Widget_Helper_Form_Element_Radio( 'text2speechSex',array('1' => '普通男声', '0' => '普通女声','3' => '情感男声', '4' => '情感女声'),'4',_t('语音朗读合成类型'), _t('喜欢男声还是女声？'));
$form->addInput($text2speechSex);
$text2speechSpeed = new Typecho_Widget_Helper_Form_Element_Radio('text2speechSpeed',array('1' => '超慢','3' => '慢速', '5' => '正常','7' => '快速','12' => '超快'), '5',_t('语音朗读语速'), _t('说的快还是慢？') );
$form->addInput($text2speechSpeed);
$baiduBDUSS = new Typecho_Widget_Helper_Form_Element_Textarea('baiduBDUSS',NULL,
NULL,_t('百度 BDUSS'),_t('百度 Cookie 中的 BDUSS，开启语音朗读功能时必须配置，获取方法请看 <a href="https://vircloud.net/default/change-theme.html#article-header-19" target="_blank">主题页说明</a>。')
);
$form->addInput($baiduBDUSS);
$text2speechLength = new Typecho_Widget_Helper_Form_Element_Text( 'text2speechLength',NULL,'3000',_t('语音朗读分段字数'),_t('分段字数，最大 5000 字。'));
$form->addInput($text2speechLength);
$text2speechBegin = new Typecho_Widget_Helper_Form_Element_Text( 'text2speechBegin', NULL,'语音小助手为您服务，接下来将朗读：', _t('语音朗读开头内容'),_t('为语音配上一个欢迎词？'));
$form->addInput($text2speechBegin);
$text2speechEnd = new Typecho_Widget_Helper_Form_Element_Text( 'text2speechEnd',NULL, '。文章读完了，感觉写的怎么样呢？如果觉得对您有帮助，就在文章后面点个赞打个赏吧！', _t('语音朗读结尾内容'),_t('为语音配上一个结束语？'));
$form->addInput($text2speechEnd);
$slimg = new Typecho_Widget_Helper_Form_Element_Select('slimg', array( 'showon'=>'有图文章显示缩略图，无图文章随机显示缩略图','Showimg' => '有图文章显示缩略图，无图文章显示默认的缩略图','showoff' => '所有文章一律显示默认缩略图','allsj' => '所有文章一律显示随机缩略图'), 'showon',_t('缩略图设置'), _t('随机缩略图文件保存于 img/sj/，自定义字段 thumb2/thumb 可覆盖设置。'));
$form->addInput($slimg->multiMode());
//*****************************************************评论*****************************************************
$CommentFun = new Typecho_Widget_Helper_Form_Element_Checkbox('commentfun', array( 'showua' => _t('UA 文字'), 'showsmailes' => _t('评论表情'), 'showip' => _t('显示位置')), array('showua','showsmailes'), _t('评论功能'), _t('UA（浏览器、系统）文本标识及表情功能，后台表情实现参见 <a href="https://vircloud.net/default/change-theme.html#article-header-49" target="_blank">主题页说明</a>。'));
$form->addInput($CommentFun->multiMode());
$showUAType = new Typecho_Widget_Helper_Form_Element_Radio('showuatype', array( '0' => '不显示', '1' => 'iconfont', '2' => '小图标'), '1', _t('UA 风格'),_t('UA 图标标识，小图标丰富，iconfont 协调。'));
$form->addInput($showUAType);
$allowComment = new Typecho_Widget_Helper_Form_Element_Radio( 'allowcomment', array( '1' => '开启','0' => '关闭' ), '0', _t('非中文语系评论'),_t('屏蔽垃圾评论。') );
$form->addInput($allowComment);
$isYiyan = new Typecho_Widget_Helper_Form_Element_Radio('isyiyan',array('0' => _t('禁用'), '1' => _t('启用')), '0',_t('独立一言'),_t("位置：评论上方。"));
$form->addInput($isYiyan);
$inputYiyan = new Typecho_Widget_Helper_Form_Element_Radio('inputyiyan',array( '0' => _t('禁用'), '1' => _t('启用')), '1',_t('评论一言'),_t("位置：评论框中。"));
$form->addInput($inputYiyan); 
$yiyanSource = new Typecho_Widget_Helper_Form_Element_Radio('yiyansource',array( '0' => _t('本地'), '1' => _t('网络')), '0', _t('内容来源'),_t("本地读取 lib/yiyan.txt，网络则实时从网络上抓取。"));
$form->addInput($yiyanSource);
$defaultComment =new Typecho_Widget_Helper_Form_Element_Text('defaultcomment', NULL, '自古表白多白表，从来情书难书情。笑谈年少多少年，常与生人道人生。', _t('默认一言'),_t('当开启一言时，若获取一言失败则显示此处文本。'));
$form->addInput($defaultComment);
$qqAvatar = new Typecho_Widget_Helper_Form_Element_Radio( 'qqavatar',array('0' => 'Avatar', '1' => 'QQ'),'1', _t('评论头像'),_t('头像匹配优先权。')
);
$form->addInput($qqAvatar);
$defaultAvatar = new Typecho_Widget_Helper_Form_Element_Text('defaultavatar', NULL, '/usr/themes/armx/img/defaultavatar.png' , _t('默认头像'), _t('匹配： QQ > Avatar > 默认。'));
$form->addInput($defaultAvatar);
$siteCache = new Typecho_Widget_Helper_Form_Element_Text( 'cacheTime', null, '2592000', _t( '头像缓存时间' ), _t( '单位秒，默认 30 天，超过则会重新获取头像。' ) );
$form->addInput( $siteCache );
$username = new Typecho_Widget_Helper_Form_Element_Text( 'username', null, '欧文斯', _t( '博主认证设置' ), _t( '要认证的用户名，多个以空格分隔。' ));
$form->addInput( $username );
$showuserType = new Typecho_Widget_Helper_Form_Element_Radio( 'showusertype', array( '0' => '认证图片', '1' => '文字标识' ), '1', _t('认证风格'), _t('在评论处用户认证显示的风格。'));
$form->addInput($showuserType);
$smilescdn = new Typecho_Widget_Helper_Form_Element_Text( 'smilescdn', null, NULL, _t( '表情 CDN 地址'), _t('是否开启表情 CDN？'));
$form->addInput( $smilescdn );
//*****************************************************侧栏*****************************************************
$isMe = new Typecho_Widget_Helper_Form_Element_Checkbox('isme', array('ShowMe' => _t('关于博主'),'ShowLink' => _t('友情链接') ), array('ShowMe','ShowLink'),_t('侧栏功能'),_t('侧栏相关功能，勾选生效。关于博主未勾选则下面的联系方式设置也不生效。'));
$form->addInput($isMe->multiMode());
$isMeimg = new Typecho_Widget_Helper_Form_Element_Text('ismeimg', NULL, '/usr/themes/armx/img/logo.png', _t('博主头像'), _t('博主头像的完整 URL 链接，建议填相对地址。'));
$form->addInput($isMeimg);
$isMeaboutimg = new Typecho_Widget_Helper_Form_Element_Text('ismeaboutimg', NULL,'/usr/themes/armx/img/about_bg.png', _t('简介背景'), _t('博客简介背景图片链接，建议大小 900x100。'));
$form->addInput($isMeaboutimg);
$isMeabout = new Typecho_Widget_Helper_Form_Element_Text('ismeabout', NULL, 'Let\'s start learning !', _t('文字介绍'), _t('输入喜欢的一行文字吧，含标点不超过 70 字。'));
$form->addInput($isMeabout);
$isMeQQ = new Typecho_Widget_Helper_Form_Element_Text('ismeqq', NULL, NULL, _t('QQ'), _t('输入 QQ 聊天链接，点击跳转，为空则不显示。'));
$form->addInput($isMeQQ);
$isMeWechat = new Typecho_Widget_Helper_Form_Element_Text('ismewechat', NULL, '/usr/themes/armx/img/wxgroup.png', _t('微信'), _t('输入二维码图片链接，点击显示，为空则不显示。'));
$form->addInput($isMeWechat);
$isMeTel = new Typecho_Widget_Helper_Form_Element_Text('ismetel', NULL, 'https://vircloud.net/go/telegram/', _t('Telegram'), _t('输入 Telegram 链接，点击跳转，格式可参照<a href="https://vircloud.net/default/change-theme.html#article-header-30" target="_blank">主题页说明</a>。'));
$form->addInput($isMeTel);
$isMeGithub = new Typecho_Widget_Helper_Form_Element_Text('ismegithub', NULL, NULL, _t('GitHub'), _t('输入 GitHub 链接，点击跳转，为空则不显示。'));
$form->addInput($isMeGithub);
$isMeeMail = new Typecho_Widget_Helper_Form_Element_Text('ismeaemail', NULL, NULL, _t('联系邮箱'), _t('点击将自动调用 E-mail 客户端发信，为空则不显示。'));
$form->addInput($isMeeMail);
$isAbout = new Typecho_Widget_Helper_Form_Element_Radio('isabout',array( '0' => _t('禁用'),'1' => _t('启用') ), '1',_t('相关文章'),_t("文章页侧栏"));
$form->addInput($isAbout);
$isRecommend = new Typecho_Widget_Helper_Form_Element_Radio('isrecommend', array( '0' => _t('禁用'), '1' => _t('启用')),'1',_t('随机看看'),_t("全站侧栏"));
$form->addInput($isRecommend);
$isTags = new Typecho_Widget_Helper_Form_Element_Radio('istags',array('0' => _t('禁用'),'1' => _t('启用') ), '1',_t('热门标签'),_t("首页侧栏"));
$form->addInput($isTags);
$showTagType = new Typecho_Widget_Helper_Form_Element_Radio( 'showtagtype', array( '0' => '清新简洁', '1' => '科技动感' ), '0', _t('标签云风格'), _t('在右侧栏标签云要显示的风格。'));
$form->addInput($showTagType);
//*****************************************************页脚*****************************************************
$footerswitch = new Typecho_Widget_Helper_Form_Element_Checkbox('footerswitch',array('CountTime' => _t( '加载时间' ),'CountRam' => _t( '内存使用' ),'LastLogin' => _t( '上次在线' ),'LastUpdate' => _t( '最后更新' )),array('CountTime','CountRam','LastLogin','LastUpdate'),_t('页脚功能'),_t("勾选则开启相应功能，位置：侧栏按钮。"));
$form->addInput($footerswitch->multiMode());
$isStat = new Typecho_Widget_Helper_Form_Element_Radio('isstat',array('0' => _t('禁用'), '1' => _t('启用')),'1',_t('网站统计'),_t("浏览总量、友情链接等。"));
$form->addInput($isStat);
$AnBei = new Typecho_Widget_Helper_Form_Element_Text('anbei', NULL, NULL, _t('公安备案'), _t('直接填备案号，为空则不显示。'));
$form->addInput($AnBei); 
$WangBei = new Typecho_Widget_Helper_Form_Element_Text('wangbei', NULL, NULL, _t('网站备案'), _t('直接填备案号，为空则不显示。'));
$form->addInput($WangBei);
$Copyright = new Typecho_Widget_Helper_Form_Element_Text('copyright', NULL, '<a href="//www.vircloud.net/" rel="nofollow">VirCloud,LLC.</a>', _t('版权声明'), _t('页面底部版权声明，按示例填写完整的 html 代码。'));
$form->addInput($Copyright);
$Powerby = new Typecho_Widget_Helper_Form_Element_Text('powerby', NULL, '<a href="/go/typecho/" target="_blank">TYPECHO</a> & <a href="https://vircloud.net/go/vultr/" target="_blank">VULTR</a>', _t('网站驱动'), _t('页面底部网站驱动，按示例填写完整的 html 代码。'));
$form->addInput($Powerby); 
$FooterSite = new Typecho_Widget_Helper_Form_Element_Textarea('footersite', NULL, '<a href="/sitemap.xml" class="f-site" target="_blank">网站地图</a>
<a href="/go/home/" class="f-site" target="_blank">主页导航</a>
<a href="/link.html" class="f-site">友情链接</a>
<a href="/ampindex/" class="f-site" target="_blank">移动简版</a>
<a href="/go/github/" class="f-site" target="_blank">开源项目</a>
<a href="/ad-co.html" class="f-site">广告合作</a>', _t('页脚链接'), _t('页面底部链接，按示例填写完整的 html 代码。'));
$form->addInput($FooterSite); 
//*****************************************************推广*****************************************************
$showAD = new Typecho_Widget_Helper_Form_Element_Checkbox('showad', array(
'ShowAD' => _t('主机推荐'),
'ShowService' => _t('本站服务'),
'ShowGoogleAD' => _t('谷歌广告'),
'ShowPost' => _t('文章页广告'),
'ShowSide' => _t('侧栏按钮推广')
), array('ShowAD','ShowPost','ShowSide'),
_t('推广选项'), _t('本站服务位于部分页面右侧上方，主机推荐位于全站右侧下方，谷歌广告详细设置继续往下拉，文章页广告位于文章页声明下方。'));
$form->addInput($showAD->multiMode());
$ShowService1 = new Typecho_Widget_Helper_Form_Element_Text('showservice1', NULL, '/usr/themes/armx/img/vhost.png', _t('服务一图片'), _t('本站服务一图片链接，建议大小 578x190。'));
$form->addInput($ShowService1);
$ShowService1link = new Typecho_Widget_Helper_Form_Element_Text('showservice1link', NULL, '/guestbook.html#main', _t('服务一链接'), _t('建议使用<a href="https://dl.vircloud.net/Code/typecho/plugins/" target="_blank"> Golink </a>插件转成内链。'));
$form->addInput($ShowService1link);
$ShowService2 = new Typecho_Widget_Helper_Form_Element_Text('showservice2', NULL, $options->themeUrl( 'img/office.png', 'armx' ), _t('服务二图片'), _t('本站服务二图片链接，建议大小 578x190。'));
$form->addInput($ShowService2);
$ShowService2link = new Typecho_Widget_Helper_Form_Element_Text('showservice2link', NULL, '/guestbook.html#main', _t('服务二链接'), _t('建议使用<a href="https://dl.vircloud.net/Code/typecho/plugins/" target="_blank"> Golink </a>插件转成内链。'));
$form->addInput($ShowService2link);
$ShowAD1 = new Typecho_Widget_Helper_Form_Element_Text('showad1', NULL, '/usr/themes/armx/img/vultr2.jpg', _t('推荐一图片'), _t('主机推荐一图片链接，建议大小 578x190。'));
$form->addInput($ShowAD1);
$ShowAD1link = new Typecho_Widget_Helper_Form_Element_Text('showad1link', NULL, 'https://vircloud.net/go/vultr/', _t('推荐一链接'), _t('建议使用<a href="https://dl.vircloud.net/Code/typecho/plugins/" target="_blank"> Golink </a>插件转成内链。'));
$form->addInput($ShowAD1link);
$ShowAD2 = new Typecho_Widget_Helper_Form_Element_Text('showad2', NULL, '/usr/themes/armx/img/cloudcone2.jpg', _t('推荐二图片'), _t('主机推荐二图片链接，建议大小 578x190。'));
$form->addInput($ShowAD2);
$ShowAD2link = new Typecho_Widget_Helper_Form_Element_Text('showad2link', NULL, 'https://vircloud.net/go/cloudcone/', _t('推荐二链接'), _t('建议使用<a href="https://dl.vircloud.net/Code/typecho/plugins/" target="_blank"> Golink </a>插件转成内链。'));
$form->addInput($ShowAD2link);
$GoogleAD = new Typecho_Widget_Helper_Form_Element_Checkbox('googlead', array('Celan' => _t('侧栏'),'Post' => _t('正文'),'Yejiao' => _t('页脚'),'Dingbu' => _t('顶部')), array('Post','Celan'),_t('谷歌广告选项'), _t('当功能开启且勾选位置时，将在相应位置显示谷歌 ADsense 广告，注：本主题已适配 ADSense，无需再配置位置。'));
$form->addInput($GoogleAD->multiMode());
$GoogleADScript = new Typecho_Widget_Helper_Form_Element_Textarea('googleadscript', NULL, '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
(adsbygoogle = window.adsbygoogle || []).push({
google_ad_client: "广告 ID",
enable_page_level_ads: true
});
</script>', _t('谷歌广告代码'), _t('<b>注意：</b>这里面填写完整 js 代码，<b>包括"<\script\>"标签</b>！要成功开启广告则此项不能为空。'));
$form->addInput($GoogleADScript); 
$ShowPostURL = new Typecho_Widget_Helper_Form_Element_Text('postad', NULL, 'https://vircloud.net/go/vultr/', _t('文章页推广链接'), _t('文章页推广链接，建议转成内链。'));
$form->addInput($ShowPostURL);
$ShowPostIMG = new Typecho_Widget_Helper_Form_Element_Text('postadimg', NULL, '/usr/themes/armx/img/vultr2.png', _t('文章页推广图片'), _t('文章页推广图片，建议大小 600x70。'));
$form->addInput($ShowPostIMG);  
$ShowService1Alt=new Typecho_Widget_Helper_Form_Element_Text('service1alt', NULL,'代理高性价比虚拟主机、网站搭建设计及某些资源某些服务', _t('服务一广告词'), _t('图片无法加载时显示。'));
$form->addInput($ShowService1Alt);
$ShowService2Alt=new Typecho_Widget_Helper_Form_Element_Text('service2alt', NULL,'代理正版 Office（PY 可附赠大容量网盘）', _t('服务二广告词'), _t('图片无法加载时显示。'));
$form->addInput($ShowService2Alt);
$ShowAD1Alt=new Typecho_Widget_Helper_Form_Element_Text('ad1alt', NULL,'通过此邀请注册 Vultr 可享受充值 $10 立赠 $25 (可开一年 VPS)', _t('推荐一广告词'), _t('图片无法加载时显示。'));
$form->addInput($ShowAD1Alt);
$ShowAD2Alt=new Typecho_Widget_Helper_Form_Element_Text('ad2alt', NULL,'通过此邀请注册可购买 CloudCone 专属特价 ￥70/年的高性价比 VPS', _t('推荐二广告词'), _t('图片无法加载时显示。'));
$form->addInput($ShowAD2Alt);
$ShowPostAlt=new Typecho_Widget_Helper_Form_Element_Text('psotalt', NULL,'通过此邀请注册 Vultr 可享受充值 $10 立赠 $25 (可开一年 VPS)', _t('文章页广告词'), _t('图片无法加载时显示。'));
$form->addInput($ShowPostAlt);
$ShowSideAlt=new Typecho_Widget_Helper_Form_Element_Text('sidealt', NULL,'扫码领红包', _t('侧栏按钮广告词'), _t('图片无法加载时显示。'));
$form->addInput($ShowSideAlt);
$ShowSideIMG=new Typecho_Widget_Helper_Form_Element_Text('sidehb_img', NULL,'/usr/themes/armx/img/alipay.png', _t('侧栏按钮广告图片'), _t('建议大小 250x250。'));
$form->addInput($ShowSideIMG);
$ShowSideUrl=new Typecho_Widget_Helper_Form_Element_Text('sideurl', NULL,'https://vircloud.net/ext/hb/', _t('侧栏按钮广告链接'), _t('建议转成内链。'));
$form->addInput($ShowSideUrl);
//*****************************************************高级*****************************************************
$Advanced = new Typecho_Widget_Helper_Form_Element_Checkbox('advanced', array(
'AutoTitle' => _t('图片表格自动添加标题'),'AutoFimg' => _t('备案信息前添加图标')
), array('AutoTitle'),
_t('高级选项'), _t('除非明确知道改了有什么结果，否则本节配置都请保持默认。'));
$form->addInput($Advanced->multiMode());
$ScrollPix = new Typecho_Widget_Helper_Form_Element_Text('scrollpix', NULL,'1', _t('滚屏像素'), _t('双击滚屏开启时，每次滚屏的像素，越大越快。'));
$form->addInput($ScrollPix);
$ScrollTime = new Typecho_Widget_Helper_Form_Element_Text('scrolltime', NULL,'50', _t('滚屏时间'), _t('双击滚屏开启时，自动滚屏延时，单位毫秒。'));
$form->addInput($ScrollTime);
$SplitCnt = new Typecho_Widget_Helper_Form_Element_Text('splitcnt', NULL,'4000', _t('分页字数'), _t('开启文章分页功能时，默认多少字分页。'));
$form->addInput($SplitCnt);
$Pexpire = new Typecho_Widget_Helper_Form_Element_Text('pexpire', NULL, '3600', _t('页面缓存时间'), _t('开启 Pjax 时多长时间不刷新？单位：秒。'));
$form->addInput($Pexpire);
	
}


/*
 *主题配置
*/
function themeInit($self) {
    $options = $self->widget('Widget_Options');
    if ($options->shortcode) {
        require_once __DIR__ . '/shortcode.php';
    }
    if (!empty( $options->switch) && in_array('SplitPost',$options->switch)) {
        require_once __DIR__ . '/cutpost.php';
    }
}

/*
 *首页缩略图
*/

function the_index_thumbnail($post)
{
  $thumb=$post->fields->thumb;
  $thumb2=$post->fields->thumb2;
  if(isset($thumb2)){
   echo $ctu = fullurl($thumb2,0); 
  } 
  else if(isset($thumb)){
   echo $ctu = fullurl($thumb,0); 
  }
  else{
    $imgurl = Typecho_Widget::widget('Widget_Options')->themeUrl;
    $imgurl = parse_url($imgurl,PHP_URL_PATH);
    $dir = $imgurl.'/img/sj/';
    $default = $dir . 'default.jpg';
    if(Helper::options()->slimg){
     echo fullurl(get_post_thumbnail($post, $dir, $default),0);
    } else {
     echo fullurl($default,0);
    }
  }
}

/**
 * 获取缩略图
 */
function get_post_thumbnail($widget, $dir, $default)
{
    //所有文章一律显示默认缩略图
    if('showoff'==Helper::options()->slimg ){
       return $default;
    } else {
      $n=sizeof(scandir($_SERVER['DOCUMENT_ROOT'].$dir))-3;
      if($n <= 0){ $n=99; }
      $rand = rand(1,$n); 
      $random = $dir . $rand . '.jpg'; 
      if(empty($random)){
        $random = $default;
      }
      //所有文章一律显示随机缩略图
      if( 'allsj'==Helper::options()->slimg ) {
        return $random;
      } else {
        //有图文章显示文章第一张缩略图
        $attach = $widget->attachments(1)->attachment;
        $pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i'; 
        $patternMD = '/\!\[.*?\]\((http(s)?:\/\/.*?(jpg|png))/i';
        $patternMDfoot = '/\[.*?\]:\s*(http(s)?:\/\/.*?(jpg|png))/i';
        if (preg_match_all($pattern, $widget->content, $thumbUrl)) {
           $ctu = $thumbUrl[1][0];
        }
        else if (preg_match_all($patternMD, $widget->content, $thumbUrl)) {
           $ctu = $thumbUrl[1][0];  //如果是内联式markdown格式的图片
        }
        else if(preg_match_all($patternMDfoot, $widget->content, $thumbUrl)) {
           $ctu = $thumbUrl[1][0]; //如果是脚注式markdown格式的图片
        }
        //无图文章显示随机缩略图 showon
        if(empty($ctu) && 'showon'==Helper::options()->slimg) {
           $ctu = $random;
        }
        //无图文章显示默认的缩略图 Showimg
        if(empty($ctu) && 'Showimg'==Helper::options()->slimg ){
           $ctu = $default;
        }
        return $ctu;
     }
    }
}

/**
 * 留空
 * @author NatLiu
 * @date   2018-01-24T14:00:43+0800
 * @param  string                   $message   [description]
 * @param  string                   $className [description]
 * @return [type]                              [description]
 */
function empty_message( $message = '', $className = '' )
{
    $class = 'empty-placeholder';
    if(!empty($className)){
        $class .= ' '.$className;
    }
    echo '<div class="'.$class.'"><div class="placeholder-bg"></div><div class="placeholder-content">'.$message.'</div></div>';
}

/**
* 补齐链接
*
*/
function lIIIIl($l1, $l2) {
    $I2 = $l1;
	if (preg_match ( "/(.*)(href|src)\=(.+?)( |\/\>|\>).*/i", $l1, $regs )) {
		$I2 = $regs [3];
	}
	if (strlen ( $I2 ) > 0) {
		$I1 = str_replace ( chr ( 34 ), "", $I2 );
		$I1 = str_replace ( chr ( 39 ), "", $I1 );
	} else {
		return $l1;
	}
	$url_parsed = parse_url ( $l2 );
	$scheme = $url_parsed ["scheme"];
	if ($scheme != "") {
		$scheme = $scheme . "://";
	}
	$host = $url_parsed ["host"];
	$l3 = $scheme . $host;
	if (strlen ( $l3 ) == 0) {
		return $l1;
	}
	$port = isset($url_parsed ["port"]) ? ":".$url_parsed ["port"] : NULL;
	$l3 = $l3 . $port;
	if(!empty($url_parsed ["path"])){
	$path = dirname ( $url_parsed ["path"] );
	if ($path [0] == "\\") { 
		$path = ""; 
		} 
	}else{
		$path = "";
	}
//	$pos = strpos ( $I1, "#" ); 
//	if ($pos > 0) 
//		$I1 = substr ( $I1, 0, $pos ); 
//判断类型 
	if (preg_match ( "/^(http|https|ftp):(\/\/|\\\\)(([\w\/\\\+\-~`@:%])+\.)+([\w\/\\\.\=\?\+\-~`@\':!%#]|(&amp;)|&)+/i", $I1 )) { 
		return $l1; 
	} //http开头的url类型要跳过 
	elseif ($I1 [0] == "/") { 
		if( !empty($I1[1]) && $I1[1] == "/"){  //相对协议
			return $l1; 
		} else{
			$I1 = $l3 . $I1; 
	}
	} //绝对路径 
	elseif (substr ( $I1, 0, 3 ) == "../") { //相对路径 
		while ( substr ( $I1, 0, 3 ) == "../" ) { 
			$I1 = substr ( $I1, strlen ( $I1 ) - (strlen ( $I1 ) - 3), strlen ( $I1 ) - 3 ); 
			if (strlen ( $path ) > 0) { 
				$path = dirname ( $path ); 
			} 
		} 
		$I1 = $l3 . $path . "/" . $I1; 
	} 
	elseif (substr ( $I1, 0, 2 ) == "./") { 
		$I1 = $l3 . $path . substr ( $I1, strlen ( $I1 ) - (strlen ( $I1 ) - 1), strlen ( $I1 ) - 1 ); 
	} 
	elseif (strtolower ( substr ( $I1, 0, 7 ) ) == "mailto:" || strtolower ( substr ( $I1, 0, 11 ) ) == "javascript:" ||strtolower ( substr ( $I1, 0, 4 ) ) == "tel:" ||strtolower( substr ( $I1, 0, 10 ) ) == "data:image") { 
		return $l1; 
	} 
	else { 
		$I1 = $l3 . $path . "/" . $I1; 
	} 
	return str_replace ( $I2, "\"$I1\"", $l1 );
}
/*
* 批量补齐链接
*/
function formaturl($l1, $l2) {
	if (preg_match_all ( "/(<img[^>]+src=\"([^\"]+)\"[^>]*>)|(<a[^>]+href=\"([^\"]+)\"[^>]*>)|(<img[^>]+src='([^']+)'[^>]*>)|(<a[^>]+href='([^']+)'[^>]*>)/i", $l1, $regs )) {
	foreach ( $regs [0] as $num => $url ) {
		$l1 = str_replace ( $url, lIIIIl ( $url, $l2 ), $l1 );
	}
	}
	return $l1;
}

/*
* 单独补齐链接
*/
function fullurl($url,$host){
    $realhost = Helper::options()->siteUrl;
    if($host){
      $realurl = lIIIIl ( $url, $host );
    }else{
	  $realurl = lIIIIl ( $url, $realhost );
    }
    return preg_replace('/\"/','',$realurl);
}

/**
* 下载远程文件
* 
*/
function get_remote_file($filename,$url,$save_dir){
     $ch=curl_init();  
     $timeout=3;  

     if(trim($save_dir)=='' || trim($filename)=='' || trim($url)==''){  
        return false;  
     } else {
       
     $base_dir = parse_url($save_dir,PHP_URL_PATH);
     set_time_limit (10);  
     $file = fopen($url, "rb"); 
     if ($file) {   
       $newf = fopen ($_SERVER['DOCUMENT_ROOT'].$base_dir.$filename, "wb");
       if ($newf) {
         while (!feof($file)) {  fwrite($newf, fread($file, 1024 * 8), 1024 * 8);  }  
       }
     }  
     if ($file) {  fclose($file); }  
     if ($newf) {  fclose($newf); }  
       
     if (true){   return $save_dir.$filename; } else{   return false; }   
     }
}

/**
* Avatar 头像
* 
*/
function get_avatar($filename,$hash,$size,$save_dir){
    $default = Helper::options()->defaultavatar;
    $realurl = Helper::options()->siteUrl;
    $default = fullurl($default,$realurl);
  
    $host = 'http://secure.gravatar.com/avatar/';  //CDN 目录
    $rating = Helper::options()->commentsAvatarRating;
    $avatarurl = $host . $hash . '?s=' . $size . '&r=' . $rating . '&d';
    $avatartest = $host . $hash .'?d=404';
  
   $test = get_headers($avatartest);
   if ($test[0] == 'HTTP/1.1 200 OK') { 
     $imgurl = get_remote_file($filename,$avatarurl,$save_dir);
     return $imgurl;
   } else { 
     $base_dir = parse_url($save_dir,PHP_URL_PATH);
     $cacheimg = $_SERVER['DOCUMENT_ROOT'].$base_dir.$filename;
     copy($default,$cacheimg); //避免开一次页面就重新执行一次；
     if (true) {
#       return $cacheimg; 
       return $save_dir.$filename;
     } else{
       return 'copy failed'; 
     }
   } 
}


/**
 * 头像：先QQ、再 gravatar、最后是默认的
 * @param $email 评论者邮箱
 *
 * @return string 头像的img标签
 */
function avatar( $email) {
    $switchav = Helper::options()->qqavatar;
    if ( empty( Helper::options()->cacheTime ) ) {	$ct = 2592000;	} else {	$ct = Helper::options()->cacheTime;	}  
    $size = '32'; //大小
    $emaill = strtolower(trim($email));
    $hash = md5($emaill);
    $ext = '.jpg';
    $filename = $hash.$ext;
    $save_dir = Typecho_Widget::widget('Widget_Options')->themeUrl.'/img/avatarcache/';
    $base_dir = parse_url($save_dir,PHP_URL_PATH);
    $relpath = $_SERVER['DOCUMENT_ROOT'] . $base_dir . $filename;
    if (file_exists($relpath) &&  (time() - filemtime($relpath) < $ct)){
         $save_dir_x=parse_url($save_dir,PHP_URL_PATH);  //取相对路径
         return  $save_dir_x.$filename;
     }else  if($switchav ='1' && strpos($emaill, '@qq.com') !== false){
         $qmail = explode("@",$emaill);
         $qqhao = $qmail[0];
         $qqimg  = 'http://q.qlogo.cn/headimg_dl?dst_uin='.$qqhao.'&spec=100';
         $imgurl = get_remote_file($filename,$qqimg,$save_dir);
         if ($imgurl){
          $imgurl = parse_url($imgurl,PHP_URL_PATH);
          sleep(2);
          return  $imgurl;
         }
         else {
            $imgurl = get_avatar($filename,$hash,$size,$save_dir);
            sleep(2);
            return parse_url($imgurl,PHP_URL_PATH);
         }
         fixpic($relpath);
     } else{
            $imgurl = get_avatar($filename,$hash,$size,$save_dir); 
            sleep(2);
      	    return parse_url($imgurl,PHP_URL_PATH);
	    fixpic($relpath);
     }
}


/**
 * 评论输出
 * @author NatLiu
 * @date   2018-01-24T14:00:59+0800
 * @param  [type]                   $that                 [description]
 * @param  [type]                   $singleCommentOptions [description]
 * @return [type]                                         [description]
 */
function threadedComments($that, $singleCommentOptions)
{
    $size = '32'; //大小
    $pbimg = '/usr/themes/armx/img/pingback.png';
    $domain = trim($_SERVER['HTTP_HOST']);
    $saying = strrpos($_SERVER['REQUEST_URI'],'saying');
    $commentClass = '';
        if ($that->authorId) {
            if ($that->authorId == $that->ownerId) {
                $commentClass .= ' comment-by-author';
            } else {
                $commentClass .= ' comment-by-user';
            }
        }
?>
<li itemscope itemtype="http://schema.org/UserComments" id="<?php $that->theId(); ?>" class="comment-item<?php
    if ($that->levels > 0) {
        echo ' comment-child';
        $that->levelsAlt(' comment-level-odd', ' comment-level-even');
    } else {
        echo ' comment-parent';
    }
    $that->alt(' comment-odd', ' comment-even');
    echo $commentClass;
?>">

<?php if($that->type == 'comment'):?>

    <div class="comment-author" itemprop="creator" itemscope itemtype="http://schema.org/Person">
      <?php  if (Helper::options()->lazyimg) :?> 
          <img class="avatar lazyloading circular b-lazy" src="<?php echo __LAZYIMG__; ?>" data-src="<?php echo fullurl(avatar($that->mail),0); ?>" alt="<?php echo $that->author; ?>" width="<?php echo $size ?>" height="<?php echo $size ?>"/>
      <?php else:?>
          <img class="avatar lazyloading circular" src="<?php echo avatar($that->mail); ?>" alt="<?php echo $that->author; ?>" width="<?php echo $size ?>" height="<?php echo $size ?>" />
      <?php endif;?>
    </div>
<div class="comment-body">
    <div class="comment-meta<?php if($saying > 0){ echo ' saying-meta';} ?>">
        <strong class="author-name">
          <?php if(isset($that->url)){
            //  if ($that->url = $domain){
                $arr = explode(' ',Helper::options()->username);
                if ( in_array( $that->author, $arr ) ) {
                   $aurl = Helper::options()->rootUrl;
                   if (!Helper::options() ->showusertype){
                     $img = Helper::options()->themeUrl . '/img/vip.png';
                     if($img){
                       $img = parse_url($img,PHP_URL_PATH);
                       $img = fullurl($img,0);
                     }
                     echo "<a href=\"$aurl\">$that->author<img src=\"$img\" alt=\"博主认证\" class=\"vip\"/></a>";
                   }else{
                     echo "<a href=\"$aurl\">$that->author<span class=\"authorrz\">博主</span></a>"; 
                   }
                } else{
                  echo "<a href=\"//$domain/ext/link/?url=$that->url\" target=\"_blank\" rel=\"external nofollow\">$that->author</a>";
                }
          } else{ 
           echo $that->author;
} ?>
        </strong>
<?php if($saying < 1):?>
    <span class="comment-reply" id="comment-reply-<?php echo $that->coid;?>">
        <a data-commentid="<?php echo $that->coid;?>" data-respondid="<?php echo $that->parameter->respondId;?>" onclick="return TypechoComment.reply('<?php echo
                    $that->theId; ?>', '<?php echo $that->coid;?>');">回复</a>
    </span>
<?php endif;?>
        <p <?php if($saying > 0){ echo 'class="saying-date"';} ?>>
<a class="comment-date" href="<?php $that->permalink();?>">
        <time itemprop="commentTime" datetime="<?php $that->date('Y-m-d H:i:s'); ?>"><?php $singleCommentOptions->beforeDate();
        $that->dateWord();
        $singleCommentOptions->afterDate(); ?></time> 
</a>

<?php $arr = explode(' ',Helper::options()->username); //博主信息不显示
      if ( !in_array( $that->author, $arr)){
         if (Helper::options() ->showuatype){
            echo getOS($that->agent,0).getBR($that->agent,0);
         }else{
            echo '<span class="ossingle">'.getOS($that->agent,0).'</span><span class="broswersingle">'.getBR($that->agent,0).'</span>';
         }
	if (!empty(Helper::options()->commentfun) && in_array('showip',Helper::options()->commentfun)) {
	    $loc = show_ip_addr($that->coid,$that->ip);
	    echo '<span class="comefrom"><i class="fa fa-map-marker"></i>来自 '.$loc.' 的大神</span>';
	}
      }	
?>
        <?php if ('waiting' == $that->status) { ?>
        <em class="comment-awaiting-moderation fa-pause"><?php $singleCommentOptions->commentStatus(); ?></em>
        <?php } ?>
        </p>
    </div>
    <div class="comment-content" itemprop="commentText">
    <?php 
    Helper::options()->commentsHTMLTagAllowed .= '<img src="" alt="" title="" />'; 
    if (!empty(Helper::options()->commentfun) && in_array('showsmailes', Helper::options()->commentfun)) {
      $smailetag = array_merge(parsesmilies(0)[1],parsesmilies(1)[1],parsesmilies(2)[1]);
      $smaileimg = array_merge(parsesmilies(0)[2],parsesmilies(1)[2],parsesmilies(2)[2]);
      //$smailelist = array_combine($smailetag,$smaileimg);
      $parsecomment = str_replace($smailetag, $smaileimg, $that->content);
    } else {
      $parsecomment = $that->content();
    }
      $parsecomments = commentimg($parsecomment);
      echo $parsecomments;
    ?>
    </div>

</div>
<div class="clearfix" id="comment-clear-<?php echo $that->coid;?>"></div>
    <?php if ($that->children) { ?>
    <div class="comment-children" itemprop="discusses">
        <?php $that->threadedComments(); ?>
    </div>
    <?php } ?>
<?php else :?>
<div class="comment-author" itemprop="creator" itemscope="" itemtype="http://schema.org/Person">
<?php  if (Helper::options()->lazyimg) :?>
        <img class="avatar lazyloading circular b-lazy" src="<?php echo __LAZYIMG__; ?>" data-src="<?php echo fullurl($pbimg,0); ?>" alt="<?php echo $that->author; ?>" width="<?php echo $size ?>" height="<?php echo $size ?>"/>
<?php else:?>
        <?php $that->gravatar($singleCommentOptions->avatarSize, $singleCommentOptions->defaultAvatar); ?>
<?php endif;?>
</div>
<div class="comment-body pingback-body">
<div class="comment-meta pingbackmeta<?php if($saying > 0){ echo ' saying-meta';} ?>">
<strong class="author-name pingbackname">Pingback</strong>
<p><a class="comment-date" href="<?php $that->permalink();?>"><time itemprop="commentTime" datetime="<?php $that->date('Y-m-d H:i:s'); ?>"><?php $singleCommentOptions->beforeDate();
        $that->dateWord();
        $singleCommentOptions->afterDate(); ?></time>
</a></p>
</div>
<div class="comment-content" itemprop="commentText"><p>
<?php echo "<a href=\"//$domain/ext/link/?url=$that->url\" target=\"_blank\" rel=\"external nofollow\" class=\"pingbackurl fa fa-external-link\">$that->author</a>";?>
</p>
</div>
</div>
<?php endif;?>
</li>
<?php
}

/**
 * 获取文章分类
 * @author NatLiu
 * @date   2018-01-24T14:01:28+0800
 * @param  [type]                   $post [description]
 * @return [type]                         [description]
 */
function the_post_cat($post){
  $type = $post->fields->type;
  $category = $post->categories[0];
   if(isset($type)){
     if($type == 'jiaocheng') { $type = '教程'; }
     else if ($type == 'youhui') { $type =  "优惠"; }
     else if ($type == 'fuli') { $type =  "福利"; }
     else if ($type == 'jingyan') { $type =  "经验"; }
     else { $type =  "生活"; } }
   else {
     $type =  $category['name']; 
   }
   echo "<a class=\"post-cat\" href=\"".$category['permalink']."\"><span>$type</span></a>";
}

/**
 * 搜索关键词高亮
 * @author NatLiu
 * @date   2018-01-24T14:01:58+0800
 * @param  string                   $keyword [description]
 * @param  string                   $text    [description]
 * @return [type]                            [description]
 */
function highlightSearch($keyword = '', $text = '')
{
    if ($keyword==='') {
        return $text;
    }
    $text = preg_replace_callback('/'.preg_quote($keyword).'/i', function ($matches)
    {
       return "<strong class=\"search-keyword\">$matches[0]</strong>";
    }, $text);
    return $text;
}


//文章阅读次数含cookie
function get_post_view($archive)
{
    $cid    = $archive->cid;
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
 $views = Typecho_Cookie::get('extend_contents_views');
        if(empty($views)){
            $views = array();
        }else{
            $views = explode(',', $views);
        }
if(!in_array($cid,$views)){
       $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
array_push($views, $cid);
            $views = implode(',', $views);
            Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
        }
    }
    echo $row['views'];
}

//最新文章或更新文章
function new_or_update($post)
{
  if(isset($post->fields->biaoshi)){
   echo "<span class=\"zd zdl\">限时</span>";
  } else{

  if (!empty( Helper::options()->switch) && in_array('PostMagic', Helper::options()->switch)){
     date_default_timezone_set('PRC');
     $t1 = date('Y-m-d H:i:s',$post->modified);
     $t2 = date('Y-m-d H:i:s');
     $t3 = date('Y-m-d H:i:s',$post->created);
     $diff = (strtotime($t2)-strtotime($t1))/3600; //修改
     $diff2 = (strtotime($t2)-strtotime($t3))/3600;  //创建
     if($diff2<36){   //36小时
      echo "<span class=\"zd zdn\">最新</span>";
     }
     if($diff<36 && $diff2>=36){
      echo "<span class=\"zd zdu\">更新</span>";
     }
  } 
 }
}

// 5月之前的关闭语音播报
function readable($post)
{
     date_default_timezone_set('PRC');
     $t1 = date('Y-m-d H:i:s',$post->created);
     $t2 = '1525104000';
     $diff = (strtotime($t1) - $t2)/86400;
     if($diff>0){
        return true;
     }else
     {
       return false;
     }
}


//运行秒数 
function uptime($type)
{
  //$type 不指定： 秒
  //$type = d   ： 天
   date_default_timezone_set('PRC');
   if (empty(Helper::options()->createTime)){
		$ct = '2017-03-06 21:11:12';
   }else{
		$ct = Helper::options()->createTime;
   }
   $t = date('Y-m-d H:i:s');
   $tn = strtotime($t);
   $ts = strtotime($ct); //2017-03-06 21:11:12
   $cle = $tn - $ts;
  
   if($type){
     $cle = floor( $cle / 86400 ); //天
   }
  
   echo $cle;
}


//随机文章
function theme_random_posts($random){
$defaults = array(
'number' => 6, //输出文章条数
'xformat' => '<li><a href="{permalink}">{title}</a></li>'
);
$db = Typecho_Db::get();
 
$sql = $db->select()->from('table.contents')
->where('status = ?','publish')
->where('type = ?', 'post')
->where('created <= ?',time())
->limit($defaults['number'])
->order('RAND()');
 
$result = $db->fetchAll($sql);
foreach($result as $val){
$val = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($val);
echo '<li class="recent recent-0 redash">
 <a href="' . $val['permalink'] . '" title="' . $val['title'] . '"><span class="recent-title"><i class="fa fa-random likepost"></i> ' . $val['title'] . '</span></a>
            </li>';
}
}

//重新处理文章
function parseContent($obj,$login){
    $options = Typecho_Widget::widget('Widget_Options');

    if( $login ){
        $obj->content = preg_replace("/\[hide\](.*?)\[\/hide\]/sm",'$1',$obj->content);
    }else{
    	$obj->content = preg_replace("/\[hide\](.*?)\[\/hide\]/sm",'<div class="reply2view">隐藏内容评论回复可见。</div>',$obj->content);
    }
  
    $obj->content = preg_replace("/\[tbn\](.*?)\[\/tbn\]/sm",'<div id="tbn" style="display:none;">$1</div>',$obj->content);

    if(!empty($options->src_add) && !empty($options->cdn_add)) {   //CDN
	if(!strrpos($_SERVER["REQUEST_URI"],'attachment')){  //不对附件处理
		$obj->content = str_ireplace('src="'.$options->src_add,'src="'.$options->cdn_add,$obj->content);
		}
    }
  
    if($options->wailian){ //外链处理
 	preg_match_all('/<a(.*?)href="(.*?)"(.*?)>/',$obj->content,$matches);  
	$domain = trim($_SERVER['HTTP_HOST']);
	if($matches){
	  foreach($matches[2] as $val)
             {
		if(strpos($val,'://')!==false && strpos($val,$domain)===false && !preg_match('/\.(jpg|jepg|png|ico|bmp|gif|tiff|swf)/i',$val))
                  {
			  $obj->content=str_replace("href=\"$val\"", "href=\"$options->wailian$val\" target=\"_blank\" rel=\"external nofollow\" class=\"fa fa-external-link\"",$obj->content);
		  }
        if(preg_match('/go/i',$val))
                  {
              $obj->content=str_replace("href=\"$val\"", "href=\"$options->wailian//$domain$val\" target=\"_blank\" rel=\"external nofollow\" class=\"fa fa-external-link\"",$obj->content);
                  }
        if(preg_match('/\/[a-zA-Z0-9]/i',$val))
                  {
              $obj->content=str_replace("href=\"$val\"", "href=\"$val\" class=\"fa fa-link\"",$obj->content);
                  }
        if(preg_match('/mailto/i',$val))
                  {
              $obj->content=str_replace("href=\"$val\"", "href=\"$val\" class=\"fa fa-envelope-o\"",$obj->content);
                  }
      }
	}  
    }  
    
    preg_match_all('/--img--/',$obj->content,$matches); //匹配纯图片拼接
    if($matches){
      $obj->content = str_replace('<p><!--img--></p>', '<div id="onlyimg"></div>', $obj->content);
      $obj->content = str_replace('<p>&lt;!--img--&gt;</p>', '<div id="onlyimg"></div>', $obj->content);
    }
  
    //if($options->siteUrl != $options->rootUrl){  //补齐链接
    $obj->content = formaturl($obj->content,$options->rootUrl);  
    //}    

    if ($options->lazyimg){//懒加载
        $obj->content= preg_replace(['/<p>(<div(.+?)<\/div>)<\/p>/', '/<img(.+?)src="/'],['$1', '<img$1src="' . __LAZYIMG2__ . '" data-src="'],$obj->content);
    }
  
    if ($options->shortcode) {   //短代码
       $obj->content = do_shortcode($obj->content);
    }  

    if (!empty( $options->switchEnable ) && in_array('EnableCompression',$options->switchEnable)){
        $obj->content = compressHtml($obj->content);
    }
//分页
    if (!empty( $options->switch) && in_array('SplitPost',$options->switch) && !empty($options->splitcnt)){
      $yes = $obj->fields->next;
      if(( $yes == 'Y' ) or ( $yes =='y')){ 
        @$ipage = $_GET["ipage"]? intval($_GET["ipage"]):1;
        $CP = new cutpage(trim($obj->content));
        $page = $CP->cut_str();
        echo $page[$ipage-1];
        echo $CP->pagenav();
      } else {
        echo trim($obj->content);
      }
    } else {
      echo trim($obj->content);
    }
}

//iOS 系统判断
function isiOS(){ 
    if (isset($_SERVER['HTTP_USER_AGENT'])){
       $ua= $_SERVER['HTTP_USER_AGENT'];
       $browser = getBR($ua, 1);
       $os = getOS($ua, 1);
       if(strstr($browser, 'Safari') || strstr($os, 'iPhone')||strstr($os, 'iPad')||strstr($os, 'Mac')){
         return true;
       }else{
         return false;
     } 
    }else{
       return false;
    }
} 

//热门文章（访问最多）
function theme_hot_posts($hot){
$days = 99999999999999;
$num = 6;
$defaults = array(
'before' => '',
'after' => '',
'xformat' => '<li><a href="{permalink}">{title}</a></li>'
);
$time = time() - (24 * 60 * 60 * $days);
$db = Typecho_Db::get();
$sql = $db->select()->from('table.contents')
->where('created >= ?', $time)
->where('type = ?', 'post')
->where('status = ?','publish')
->where('created <= ?',time())
->limit($num)
->order('views',Typecho_Db::SORT_DESC);
$result = $db->fetchAll($sql);
echo $defaults['before'];
foreach($result as $val){
$val = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($val);
if(isset($hot) && $hot=='1'){
echo '<li class="recent recent-0 redash"><a href="'.$val['permalink'].'" title="'.$val['title'].'"><span class="recent-title"><i class="fa fa-free-code-camp likepost-c"></i>'.$val['title'].'</span></a></li>';
}
else{
echo '<li class="hotpage"> <a href="' . $val['permalink'] . '" title="' . $val['views'] . ' 人阅览了这篇文章"> ' . $val['title'] . ' </a><br /></li>';
}
}
}

//热评文章（评论最多）
function theme_mocom_posts($mocom){
$days = 99999999999999;
$num = 6;
$defaults = array(
'before' => '',
'after' => '',
'xformat' => '<li><a href="{permalink}">{title}</a></li>'
);
$time = time() - (24 * 60 * 60 * $days);
$db = Typecho_Db::get();
$sql = $db->select()->from('table.contents')
->where('created >= ?', $time)
->where('type = ?', 'post')
->limit($num)
->order('commentsNum',Typecho_Db::SORT_DESC);
$result = $db->fetchAll($sql);
echo $defaults['before'];
foreach($result as $val){
$val = Typecho_Widget::widget('Widget_Abstract_Contents')->filter($val);
echo '<li class="hotpage"> <a href="' . $val['permalink'] . '" title="收到了评论 ' . $val['commentsNum'] . ' 条"> ' . $val['title'] . ' </a><br />
</li>';
}
}

//活跃用户
function getFriendWall(){
$options = Typecho_Widget::widget('Widget_Options');
$domain = trim($_SERVER['HTTP_HOST']);
$db = Typecho_Db::get();   
$sql = $db->select('COUNT(author) AS cnt', 'author', 'url', 'mail')   
          ->from('table.comments')   
          ->where('status = ?', 'approved')   
          ->where('type = ?', 'comment')   
          ->where('authorId = ?', '0')   
          ->where('mail != ?', $options->socialemail)   //排除自己上墙   
          ->group('author')   
          ->order('cnt', Typecho_Db::SORT_DESC)   
          ->limit('16');    //读取几位用户的信息   
$result = $db->fetchAll($sql);   
if (count($result) > 0) {   
  $maxNum = $result[0]['cnt'];   
  $mostactive = ' ';
  foreach ($result as $value) {   
    if($value['url']){
        $mostactive .= '
         <li class="tabs-active-item"><a href="//'.$domain.'/ext/link/?url=' . $value['url'] . '" target="_blank" rel="nofollow" class="leader-links" title="积极互动了 '.$value['cnt'].' 次">
           ' . $value['author'] . '
        </a></li>
        ';       
  }else{
      $mostactive .= '
        <li class="tabs-active-item"><a class="leader-links" title="累计互动 '.$value['cnt'].' 次">
           ' . $value['author'] . '
        </a></li>
        '; 
    }
  }  
//  $mostactive .='</li>';
  echo $mostactive;   
 }  
}

// Http 请求
function mcFetch ($args = array()) {
    $args = array_merge(array(
        'method' => 'GET',
        'url' => null,
        'header' => array(),
        'data' => array()
    ), $args);
    $args['header'] = array_merge(array(
        'Referer' => 'https://www.google.co.uk',
        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'
    ), $args['header']);
    if (!$args['url']) {
        return;
    }
    if ($client = Typecho_Http_Client::get()) {
        if (!empty($args['header'])) {
            foreach($args['header'] as $key => $val) {
                $client->setHeader($key, $val);
            }
        }
        if (!empty($args['data'])) {
            if ($args['method'] === 'GET') {
                $client->setQuery($args['data']);
            }
            if ($args['method'] === 'POST') {
                $client->setData($args['data']);
            }
        }
        $client->setTimeout(15);
        $client->send($args['url']);
        return $client->getResponseBody();
    }
}

// 获取音频地址
function getSpeech ($title, $content) {
    $options = Typecho_Widget::widget('Widget_Options');
    if($options->baiduBDUSS != null) {
    $result = mcFetch(array(
        'method' => 'POST',
        'url' => 'https://developer.baidu.com/vcast/getVcastInfo',
        'header' => array(
            'Referer' => 'https://developer.baidu.com/vcast',
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
            'X-Requested-With' => 'XMLHttpRequest',
            'Cookie' => 'BDUSS=' . $options->baiduBDUSS
        ),
        'data' => array(
            'title' => $title,
            'content' => $content,
            'sex' => $options->text2speechSex >= 0 ? $options->text2speechSex : 4,
            'speed' => $options->text2speechSpeed ? $options->text2speechSpeed : 5,
            'volumn' => 9,
            'pit' => 5,
            'method' => 'TRADIONAL'
        )
    ));
    if ($data = json_decode($result)) {
        if ($data) {
            return $data->bosUrl;
        }
    }
    }
}

// 分割字符串，转语音
function mb_str_split($str, $length = 1) {
    if ($length < 1) return false;
    $result = array();
    for ($i = 0; $i < mb_strlen($str); $i += $length) {
        $result[] = mb_substr($str, $i, $length);
    }
    return $result;
}

// 文字转语音
function text2speech ($that) {
    $cid = $that->cid;
    Typecho_Widget::widget('Widget_Archive', 'type=post&cid=' . $cid)->to($post);
    $options = Typecho_Widget::widget('Widget_Options');
    $content = $post->content;

    if (!empty($options->switch) && in_array('Commentfirst',$options->switch)){
                $db = Typecho_Db::get();
                $sql = $db->select()->from('table.comments')
                        ->where('cid = ?',$that->cid)
                        ->where('mail = ?', $that->remember('mail',true))
                        ->limit(1);
                $result = $db->fetchAll($sql);
                if($result) {
			$content = preg_replace("/\[hide\](.*?)\[\/hide\]/sm",'$1',$content);
		}else{
      		  	$content = preg_replace("/\[hide\](.*?)\[\/hide\]/sm",'<div class="reply2view">隐藏内容评论回复可见。</div>',$content);
		}
    }

    if ($options->shortcode) {
        $content = do_shortcode($content);
    }

    $content = strip_tags($content);
    $content = str_replace("</p><p>", "。", $content);
    $content = str_replace(
        array('“', '”', '"', '\'', '@', '#', '%', '&', '——', '…', '*'),
        ' ',
        $content
    );
    $speech = [];
    $length = $options->text2speechLength ? (int) $options->text2speechLength : 3000;
    $contentList = mb_str_split($content, $length);
    $contentLength = count($contentList);
    foreach ($contentList as $key => $val) {
        $title = $post->title;
        if ($key === 0) {
            $title = $options->text2speechBegin . '。' . $title. '。。';
            $val = '。' . $val ;
        } else {
            if ($contentLength > 1) {
                $title = mb_substr($val, 0, 2);
                $val = mb_substr($val, 2);
            }
        }
        if ($key === $contentLength - 1) {
            $val = $val . '。' . $options->text2speechEnd;
        }
        $speech[] = getSpeech($title, $val);
    }
    return $speech;
}

//非中文评论
function allowcomment(){
    $options = Typecho_Widget::widget('Widget_Options');
    if ($options->allowcomment) {
        return true;
    } 
    else {
       if(!empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) && stripos($_SERVER['HTTP_ACCEPT_LANGUAGE'], 'zh') > -1){ 
         return true;
       }
       else {
         return false;
       }
    }
}

//文章二维码

/** 其他几个
* "http://qr.liantu.com/api.php?w=250&text=$post";
* "http://mobile.qq.com/qrcode?width=250&height=250&url=$post";     
* "http://qrcode.devincloud.cn/qrcode?w=250&text=$post";
* "https://pan.baidu.com/share/qrcode?w=250&h=250&url=$post";
*/

function postqrcode($post){
    $options = Typecho_Widget::widget('Widget_Options');
    if($options->qrcodesrc) {
      echo "//tool.kd128.com/qrcode?w=250&m=20&water=0&text=$post";
    }else{
      $domain = trim($_SERVER['HTTP_HOST']);
      echo "//$domain/ext/qr/?m=3&e=H&p=5&url=$post";
    }
}

/**
 * 根据 UA 解析操作系统与浏览器
 * @param $ua 访客的UA
 * @param $isPic 是否显示图片
 *
 * @return string img标签
 */
function getOS($ua,$op) {
    //开始解析操作系统
    $os = null;
    if (preg_match('/Windows NT 6.0/i', $ua)) $os = "Windows Vista";
    elseif(preg_match('/Windows NT 6.1/i', $ua)) $os = "Windows 7";
    elseif(preg_match('/Windows NT 6.2/i', $ua)) $os = "Windows 8";
    elseif(preg_match('/Windows NT 6.3/i', $ua)) $os = "Windows 8.1";
    elseif(preg_match('/Windows NT 10.0/i', $ua)) $os = "Windows 10";
    elseif(preg_match('/Windows NT 5.1/i', $ua)) $os = "Windows XP";
    elseif(preg_match('/Windows NT 5.2/i', $ua) && preg_match('/Win64/i', $ua)) $os = "Windows XP 64 bit";
    elseif(preg_match('/Windows NT 5.0/i', $ua)) $os = "Windows 2000 Professional";
    elseif(preg_match('/Android ([0-9.]+)/i', $ua, $matches)) $os = "Android ".$matches[1];
    elseif(preg_match('/iPhone OS ([_0-9]+)/i', $ua, $matches)) $os = 'iPhone '.$matches[1];
    elseif(preg_match('/iPad/i', $ua)) $os = "iPad";
    elseif(preg_match('/Mac OS X ([_0-9]+)/i', $ua, $matches)) $os = 'Mac OS X '.$matches[1];
    elseif(preg_match('/Windows Phone ([_0-9]+)/i', $ua, $matches)) $os = 'Windows Phone '.$matches[1];
    elseif(preg_match('/Gentoo/i', $ua)) $os = 'Gentoo Linux';
    elseif(preg_match('/Ubuntu/i', $ua)) $os = 'Ubuntu Linux';
    elseif(preg_match('/Debian/i', $ua)) $os = 'Debian Linux';
    elseif(preg_match('/curl/i', $ua)) $os = 'Linux distribution';
    elseif(preg_match('/X11; FreeBSD/i', $ua)) $os = 'FreeBSD';
    elseif(preg_match('/X11; Linux/i', $ua)) $os = 'Linux';
    elseif(preg_match('/X11; SunOS/i', $ua) || preg_match('/Solaris/i', $ua)) $os = 'SunOS';
    elseif(preg_match('/BlackBerry/i', $ua)) $os = 'BlackBerry';
    else $os = '未知操作系统';
  
  if(!$op){
    if(Helper::options() ->showuatype){
      if(Helper::options() ->showuatype == 2){
       $prePath1 = Helper::options() ->themeUrl.'/img/ua/';
        if (strstr($os, 'Vista')){ $prePath1 .= 'Vista'.'.png';}
        elseif(strstr($os, 'Windows 7')){ $prePath1 .= 'Windows7'.'.png';}
        elseif(strstr($os, 'Windows 8')) {$prePath1 .= 'Windows8'.'.png';}
        elseif(strstr($os, 'Windows 8.1')){ $prePath1 .= 'Windows8.1'.'.png';}
        elseif(strstr($os, 'Windows 10')){ $prePath1 .= 'Windows10'.'.png';}
        elseif(strstr($os, 'Windows XP')){ $prePath1 .= 'WindowsXP'.'.png';}
        elseif(strstr($os, 'Windows 2000')){ $prePath1 .= 'Windows2000'.'.png';}
        elseif(strstr($os, 'Android')){ $prePath1 .= 'Android'.'.png';}
        elseif(strstr($os, 'iPhone')){ $prePath1 .= 'ios'.'.png';}
        elseif(strstr($os, 'iPad')) {$prePath1 .= 'ios'.'.png';}
        elseif(strstr($os, 'Mac')) {$prePath1 .= 'Mac'.'.png';}
        elseif(strstr($os, 'Windows Phone')){ $prePath1 .= 'WindowsPhone'.'.png';}
        elseif(strstr($os, 'Gentoo')){ $prePath1 .= 'Gentoo'.'.png';}
        elseif(strstr($os, 'Ubuntu')) {$prePath1 .= 'Ubuntu'.'.png';}
        elseif(strstr($os, 'Debian')) {$prePath1 .= 'Debian'.'.png';}
        elseif(strstr($os, 'FreeBSD')){ $prePath1 .= 'FreeBSD'.'.png';}
        elseif(strstr($os, 'SunOS') || strstr($os, 'Solaris')){ $prePath1 .= 'Sun'.'.png';}
        elseif(strstr($os, 'BlackBerry')){ $prePath1 .= 'BlackBerry'.'.png';}
        elseif(strstr($os, 'Linux')){ $prePath1 .= 'Linux'.'.png';}
        else{ $prePath1 .= 'unknowOS'.'.png';}
       
        if(!empty(Helper::options()->commentfun) && in_array('showua', Helper::options()->commentfun)){
          return '<span class="osimg"><img src="'.$prePath1.'"/>'.$os.'</span>';
        }
        else{
          return '<span class="osimgfa"><img src="'.$prePath1.'"/></span>';
        }
      }

     if(Helper::options() ->showuatype == 1){
        if (strstr($os, 'Vista')){ $prePath1 = 'windows';}
        elseif(strstr($os, 'Windows')){ $prePath1 = 'windows';}
        elseif(strstr($os, 'Android')){ $prePath1 = 'android';}
        elseif(strstr($os, 'iPhone')){ $prePath1 = 'apple';}
        elseif(strstr($os, 'iPad')) {$prePath1 = 'apple';}
        elseif(strstr($os, 'Mac')) {$prePath1 = 'apple';}
        elseif(strstr($os, 'Gentoo')){ $prePath1 = 'linux';}
        elseif(strstr($os, 'Ubuntu')) {$prePath1 = 'linux';}
        elseif(strstr($os, 'Debian')) {$prePath1 = 'linux';}
        elseif(strstr($os, 'FreeBSD')){ $prePath1 = 'freebsd';}
        elseif(strstr($os, 'SunOS') || strstr($os, 'Solaris')){ $prePath1 = 'linux';}
        elseif(strstr($os, 'BlackBerry')){ $prePath1 = 'blackberry';}
        elseif(strstr($os, 'Linux')){ $prePath1 = 'linux';}
        else{ $prePath1 = 'question-circle';}

        if(!empty(Helper::options()->commentfun) && in_array('showua', Helper::options()->commentfun)){
          return '<span class="osicon"><i class="fa fa-'. $prePath1 .'"></i>'.$os.'</span>';
        }
        else{
          return '<span class="osiconfa"><i class="fa fa-'. $prePath1 .'"></i></span>';
        }
     }
    }else{
     if(!empty(Helper::options()->commentfun) && in_array('showua', Helper::options()->commentfun)){
        return $os;
     }else{
        return '';
     }
    }
  } else{
     return $os; 
  }
}

function getBR($ua,$op) {
    //解析浏览器
    if (preg_match('#(Camino|Chimera)[ /]([a-zA-Z0-9.]+)#i', $ua, $matches)) $browser = 'Camino '.$matches[2];
    elseif(preg_match('#SE 2([a-zA-Z0-9.]+)#i', $ua, $matches)) $browser = '搜狗浏览器 2'.$matches[1];
    elseif(preg_match('#360([a-zA-Z0-9.]+)#i', $ua, $matches)) $browser = '360浏览器 '.$matches[1];
    elseif(preg_match('#Maxthon( |\/)([a-zA-Z0-9.]+)#i', $ua, $matches)) $browser = 'Maxthon '.$matches[2];
    elseif(preg_match('#Edge( |\/)([a-zA-Z0-9.]+)#i', $ua, $matches)) $browser = 'Edge '.$matches[2];
    elseif(preg_match('#MicroMessenger/([a-zA-Z0-9.]+)#i', $ua, $matches)) $browser = '微信 '.$matches[1];
    elseif(preg_match('#QQ/([a-zA-Z0-9.]+)#i', $ua, $matches)) $browser = '手机QQ '.$matches[1];
    elseif(preg_match('#Chrome/([a-zA-Z0-9.]+)#i', $ua, $matches)) $browser = 'Chrome '.$matches[1];
    elseif(preg_match('#CriOS/([a-zA-Z0-9.]+)#i', $ua, $matches)) $browser = 'Chrome '.$matches[1];
    elseif(preg_match('#Chromium/([a-zA-Z0-9.]+)#i', $ua, $matches)) $browser = 'Chromium '.$matches[1];
    elseif(preg_match('#XiaoMi/MiuiBrowser/([0-9.]+)#i', $ua, $matches)) $browser = '小米浏览器 '.$matches[1];
    elseif(preg_match('#Safari/([a-zA-Z0-9.]+)#i', $ua, $matches)) $browser = 'Safari '.$matches[1];
    elseif(preg_match('#opera mini#i', $ua)) {
        preg_match('#Opera/([a-zA-Z0-9.]+)#i', $ua, $matches);
        $browser = 'Opera Mini '.$matches[1];
    }
    elseif(preg_match('#Opera.([a-zA-Z0-9.]+)#i', $ua, $matches)) $browser = 'Opera '.$matches[1];
    elseif(preg_match('#TencentTraveler ([a-zA-Z0-9.]+)#i', $ua, $matches)) $browser = '腾讯TT浏览器 '.$matches[1];
    elseif(preg_match('#QQBrowser ([a-zA-Z0-9.]+)#i', $ua, $matches)) $browser = 'QQ浏览器 '.$matches[1];
    elseif(preg_match('#UCWEB([a-zA-Z0-9.]+)#i', $ua, $matches)) $browser = 'UCWEB '.$matches[1];
    elseif(preg_match('#wp-(iphone|android)/([a-zA-Z0-9.]+)#i', $ua, $matches)) $browser = 'WordPress客户端 '.$matches[1];
    elseif(preg_match('#MSIE ([a-zA-Z0-9.]+)#i', $ua, $matches)) $browser = 'Internet Explorer '.$matches[1];
    elseif(preg_match('#Trident/([a-zA-Z0-9.]+)#i', $ua, $matches)) $browser = 'Internet Explorer 11';
    elseif(preg_match('#(Firefox|Phoenix|Firebird|BonEcho|GranParadiso|Minefield|Iceweasel)/([a-zA-Z0-9.]+)#i', $ua, $matches)) $browser = 'Firefox '.$matches[2];
    elseif(preg_match('/curl/i', $ua)) $browser = 'curl';
    else $browser = '未知浏览器';

  if(!$op){
    if(Helper::options() ->showuatype){
      if(Helper::options() ->showuatype == 2){
        $prePath2 = Helper::options() ->themeUrl.'/img/ua/';
         if (strstr($browser, 'Camino')){ $prePath2 .= 'Camino'.'.png';}
         elseif(strstr($browser, '搜狗浏览器')) {$prePath2 .= 'sogou'.'.png';}
         elseif(strstr($browser, '360浏览器')){ $prePath2 .= '360'.'.png';}
         elseif(strstr($browser, 'Maxthon')) {$prePath2 .= 'Maxthon'.'.png';}
         elseif(strstr($browser, 'Edge')) {$prePath2 .= 'Edge'.'.png';}
         elseif(strstr($browser, '微信')){ $prePath2 .= 'weixin'.'.png';}
         elseif(strstr($browser, 'QQ')){ $prePath2 .= 'QQ'.'.png';}
         elseif(strstr($browser, 'Chrome')){ $prePath2 .= 'Chrome'.'.png';}
         elseif(strstr($browser, 'Chromium')){ $prePath2 .= 'Chromium'.'.png';}
         elseif(strstr($browser, '小米')) {$prePath2 .= 'xiaomi'.'.png';}
         elseif(strstr($browser, 'Safari')){ $prePath2 .= 'Safari'.'.png';}
         elseif(strstr($browser, 'Opera')) {$prePath2 .= 'Opera'.'.png';}
         elseif(strstr($browser, '腾讯TT浏览器')) {$prePath2 .= 'tt'.'.png';}
         elseif(strstr($browser, 'QQ浏览器')){ $prePath2 .= 'qqbrowser'.'.png';}
         elseif(strstr($browser, 'UCWEB')) {$prePath2 .= 'ucweb'.'.png';}
         elseif(strstr($browser, 'Internet Explorer')){ $prePath2 .= 'ie'.'.png';}
         elseif(strstr($browser, 'WordPress客户端')){ $prePath2 .= 'wordpress'.'.png';}
         elseif(strstr($browser, 'Firefox')) {$prePath2 .= 'firefox'.'.png';}
         else{ $prePath2 .= 'question-circle';}
        if(!empty(Helper::options()->commentfun) && in_array('showua', Helper::options()->commentfun)){
           return '<span class="broswerimg"><img src="'.$prePath2.'"/>'.$browser.'</span>';
        }else{
           return '<span class="broswerimgfa"><img src="'.$prePath2.'"/></span>';
        }
      }
      if(Helper::options() ->showuatype == 1){
         if (strstr($browser, 'Edge')) {$prePath2 = 'edge';}
         elseif(strstr($browser, '微信')){ $prePath2 = 'weixin';}
         elseif(strstr($browser, 'QQ')){ $prePath2 = 'qq';}
         elseif(strstr($browser, 'Chrome')){ $prePath2 = 'chrome';}
         elseif(strstr($browser, 'Chromium')){ $prePath2 = 'chrome';}
         elseif(strstr($browser, 'Safari')){ $prePath2 = 'safari';}
         elseif(strstr($browser, 'Opera')) {$prePath2 = 'opera';}
         elseif(strstr($browser, 'Internet Explorer')){ $prePath2 = 'internet-explorer';}
         elseif(strstr($browser, 'WordPress客户端')){ $prePath2 = 'wordpress';}
         elseif(strstr($browser, 'Firefox')) {$prePath2 = 'firefox';}
         else{ $prePath2 = 'question-circle';}
         if(!empty(Helper::options()->commentfun) && in_array('showua', Helper::options()->commentfun)){
            return '<span class="browsericon"><i class="fa fa-'. $prePath2 .'"></i>'.$browser.'</span>';
         }else{
            return '<span class="browsericonfa"><i class="fa fa-'. $prePath2 .'"></i></span>';
         }
     }
    }else{
     if(!empty(Helper::options()->commentfun) && in_array('showua', Helper::options()->commentfun)){
        return $browser;
     }else{
        return '';
     }
    }
  }else{
     return $browser;
  }
}

/**
 * 一言
 */
function getYiyan(){
  $default = Helper::options() ->defaultcomment;
  $filedir= Typecho_Widget::widget('Widget_Options')->themeUrl.'/lib/yiyan.txt';
  $file = $_SERVER['DOCUMENT_ROOT'].'/'.parse_url($filedir,PHP_URL_PATH);
  
  if(Helper::options() ->yiyansource){
  //在线
  $url = 'https://v1.hitokoto.cn/?encode=text&c=f'; 
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($curl, CURLOPT_CONNECTTIMEOUT,5);
  $str = curl_exec($ch);
  curl_close($ch);
  
  if($str){
    if(file_exists($file)){
      $savestr= $str.PHP_EOL;
      file_put_contents($file, $savestr, FILE_APPEND);
    }
     return '如是说：'.$str; 
  }else{
     return $default;
   }
  }else{
  //本地 
  if(file_exists($file)){
    $a=file($file);
    $n=count($a);
    $rnd=rand(0,$n-1);
    $str=chop($a[$rnd]);
    if($str){
      return '如是说：'.$str; 
    }else{
      return $default;
    }
   }
  else{
    return $default;
  }
 }
}

/**
 * 欢迎信息
 */
function welcome_hello() {
    if(empty($_SERVER["HTTP_REFERER"])){
      $referer     = null;
    }else{
	  $referer     = $_SERVER["HTTP_REFERER"];
    }
	$refererhost = parse_url( $referer );
	$host        = strtolower( parse_url( $referer,PHP_URL_HOST));
	$ben         = $_SERVER['HTTP_HOST'];
	$callback    = "Hello，欢迎来自 <strong>" . $host . "</strong> 的朋友！";
	if ( $referer == "" || $referer == null ) {
		if ( ! Typecho_Cookie::get( 'firstView' ) ) {
			Typecho_Cookie::set( 'firstView', '1', 0, Helper::options()->siteUrl );
			$callback = "欢迎访问我的博客，倍感荣幸啊，嘿嘿~";
		} else {
            Typecho_Cookie::set( 'firstView', '1', 0, Helper::options()->siteUrl );
			$callback = "您直接访问了本站！莫非您记住了我的<strong>域名</strong>，厉害！";
		}
	} elseif ( strstr( $ben, $host ) ) {
		$callback = "host";
	} elseif ( preg_match( '/bennythink.*/i', $host ) ) {
		$callback = '您通过 <strong>小土豆</strong> 找到了我，一定很不一般噢！';
	} elseif ( preg_match( '/baiducontent.*/i', $host ) ) {
		$callback = '您通过 <strong>百度快照</strong> 找到了我，厉害！';
	} elseif ( preg_match( '/baidu.*/i', $host ) ) {
		$callback = '您通过 <strong>百度</strong> 找到了我，厉害！';
	} elseif ( preg_match( '/so.*/i', $host ) ) {
		$callback = '您通过 <strong>好搜</strong> 找到了我，厉害！';
	} elseif ( ! preg_match( '/www\.google\.com\/reader/i', $referer ) && preg_match( '/google\./i', $referer ) ) {
		$callback = '您居然通过 <strong>Google</strong> 找到了我，一定是个技术宅吧，嘿嘿！';
	} elseif ( preg_match( '/search\.yahoo.*/i', $referer ) || preg_match( '/yahoo.cn/i', $referer ) ) {
		$callback = '您通过 <strong>Yahoo</strong> 找到了我，厉害哦！';
	} elseif ( preg_match( '/cn\.bing\.com\.*/i', $referer ) || preg_match( '/yahoo.cn/i', $referer ) ) {
		$callback = '您通过 <strong>Bing</strong> 找到了我，厉害哦！';
	} elseif ( preg_match( '/google\.com\/reader/i', $referer ) ) {
		$callback = "感谢通过 <strong>Google</strong> 订阅博客，既然过来读原文了，欢迎留言指导哦 ^_^";
	} elseif ( preg_match( '/xianguo\.com\/reader/i', $referer ) ) {
		$callback = "感谢通过 <strong>鲜果</strong> 订阅博客，既然过来读原文了，欢迎留言指导哦 ^_^";
	} elseif ( preg_match( '/zhuaxia\.com/i', $referer ) ) {
		$callback = "感谢通过 <strong>抓虾</strong> 订阅博客，既然过来读原文了，欢迎留言指导哦 ^_^";
	} elseif ( preg_match( '/inezha\.com/i', $referer ) ) {
		$callback = "感谢通过 <strong>哪吒</strong> 订阅博客，既然过来读原文了，欢迎留言指导哦 ^_^";
	} elseif ( preg_match( '/reader\.youdao/i', $referer ) ) {
		$callback = "感谢通过 <strong>有道</strong> 订阅博客，既然过来读原文了，欢迎留言指导哦 ^_^";
		//自己
	}
	if ( $callback != "host" )//排除本地访问
	{
		echo '<script>ArmMessage.info("'.$callback.'");</script>';
	}
}

/**
 * 加载时间
 * @return bool
 */
function timer_start() {
	global $timestart;
	$mtime     = explode( ' ', microtime() );
	$timestart = $mtime[1] + $mtime[0];
	return true;
}
timer_start();
function timer_stop( $display = 0, $precision = 3 ) {
	global $timestart, $timeend;
	$mtime     = explode( ' ', microtime() );
	$timeend   = $mtime[1] + $mtime[0];
	$timetotal = number_format( $timeend - $timestart, $precision );
	//$r         = $timetotal < 1 ? $timetotal * 1000 . " ms" : $timetotal . " s";
    $r = number_format($timetotal,2) . " s";
	if ( $display ) {
		echo $r;
	}
	return $r;
}

/**
 * 字数统计
 * @param $cid 文章ID
 */
function art_count($cid) {
	$db   = Typecho_Db::get();
	$rs   = $db->fetchRow( $db->select( 'table.contents.text' )->from( 'table.contents' )->where( 'table.contents.cid=?', $cid )->order( 'table.contents.cid', Typecho_Db::SORT_ASC )->limit( 1 ) );
	$text = preg_replace( "/[^\x{4e00}-\x{9fa5}]/u", "", $rs['text'] );
	return mb_strlen( $text, 'UTF-8' );
}

/**
*
* 公安备案号
*
**/

function getanbei(){
  $str = Helper::options() -> anbei;
  if($str){
   return preg_replace('/\D/s', '', $str);
  } 
}

/**
*
* 内存使用
*
**/
function ramusage(){
  if(function_exists('memory_get_usage')){
    return  round(memory_get_usage() / 1024 / 1024, 2).' MB';
  }else {
    return 0;
  }
}

/**
*
* 自动夜间模式
* 
*/

function autoNight(){
   date_default_timezone_set('PRC');
   $now = date('His',$_SERVER['REQUEST_TIME']);
   $cookiename = 'tmode';
   $begin = '180000';
   $end = '070000';
   if(!($now>$end && $now<$begin)){
     if(!isset($_COOKIE[$cookiename])){
       setcookie($cookiename,'dark');
     //  return '<script>ArmMessage.success("天黑了哦，已经自动调为夜间模式啦！");</script>';
     }
   }else{
     if (isset($_COOKIE[$cookiename])){
       setcookie($cookiename,'light');
     //  return '<script>ArmMessage.success("天亮了哦，已经自动调为日间模式啦！");</script>';
     }
   }
}

/**
*
* 在线人数
*
**/

function getOnline(){
$base_dir = Typecho_Widget::widget('Widget_Options')->themeUrl.'/lib/';
$filename = $_SERVER['DOCUMENT_ROOT'].'/'.parse_url($base_dir,PHP_URL_PATH).'online.txt';
$cookiename = 'ARMXMODONLINE';
$onlinetime = 600; //10分钟

$online = file($filename);
$nowtime =$_SERVER['REQUEST_TIME'];
$nowonline = array();
foreach($online as $line){
 $row=explode('|',$line);
 $sesstime=trim($row[1]);
 if(($nowtime - $sesstime)<=$onlinetime){
  $nowonline[$row[0]]=$sesstime;
 }
}

if(isset($_COOKIE[$cookiename])){
 $uid=$_COOKIE[$cookiename];
}else{
 $vid=0;
 do{
  $vid++;
  $uid='U'.$vid;
  }
 while(array_key_exists($uid,$nowonline));
 @setcookie($cookiename,$uid);
}

$nowonline[$uid]=$nowtime;
$total_online=count($nowonline);
if($fp=fopen($filename,'w')){
	if(flock($fp,LOCK_EX)){
		rewind($fp);
		foreach($nowonline as $fuid=>$ftime){
			$fline=$fuid.'|'.$ftime."\n";
			fwrite($fp,$fline);
		}
		flock($fp,LOCK_UN);
		fclose($fp);
	}
}
 return $total_online;
}


/**
*
* 截取文件名
*
*/

function getFN($filename,$type){
  if(!empty($filename) && !empty($type)){
    $suffix = substr(strrchr($filename, '.'), 1);
    $name = basename($filename,".".$suffix);
    $path = str_replace($name.'.'.$suffix,'',$filename);
    if($type == '3'){  //路径
      return $path;}
    if($type == '1'){  //文件名
      return $name;}
    if($type == '2'){  //后缀
      return $suffix;}
  }else{
   return $filename;
  }
}

//最近登录
function get_last_login($user){
    $user   = '1';
    $now = time();
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    $row = $db->fetchRow($db->select('activated')->from('table.users')->where('uid = ?', $user));
    echo Typecho_I18n::dateWord($row['activated'], $now);
}

//最近更新
function get_last_update(){
    $num   = '1';
    $now = time();
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    $create = $db->fetchRow($db->select('created')->from('table.contents')->limit($num)->order('created',Typecho_Db::SORT_DESC));
    $update = $db->fetchRow($db->select('modified')->from('table.contents')->limit($num)->order('modified',Typecho_Db::SORT_DESC));
    if($create>=$update){
      echo Typecho_I18n::dateWord($create['created'], $now);
    }else{
      echo Typecho_I18n::dateWord($update['modified'], $now);
    }
}

//标签数统计
function get_sum_tags(){
	$db = Typecho_Db::get();
	$po= $db->select('table.metas.mid')->from ('table.metas')->where ('type = ?', 'tag');
	$pom = $db->fetchAll($po);
	$num = count($pom);
	echo $num;
}

//浏览数统计
function get_sum_views(){
	$db = Typecho_Db::get();
	$prefix = $db->getPrefix();
	if (array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))){
		$pom = $db->fetchAll("SELECT SUM(VIEWS) FROM `" . $prefix . "contents` WHERE `type`='page' or `type`='post'");
		$num = number_format($pom[0]['SUM(VIEWS)'],0,'','');
		return $num;
	}else{
		return 0; 
	}
}

//友情链接数统计
function get_sum_links(){
	$db = Typecho_Db::get();
	$po= $db->select('table.links.lid')->from ('table.links')->where ('sort = ?', 'one');
	$pom = $db->fetchAll($po);
	$num = count($pom);
	echo $num;
}

/*表情功能
* $type 0: QQ
* $type 1: Alu
* $type 2: QQPlus
*/
function parsesmilies($type){
	$turl = Typecho_Widget::widget('Widget_Options')->themeUrl.'/img/smiles/';
	$smsort = array('icon_mrgreen.gif','icon_neutral.gif','icon_twisted.gif','icon_arrow.gif','icon_eek.gif','icon_smile.gif','icon_confused.gif','icon_cool.gif','icon_evil.gif','icon_biggrin.gif','icon_idea.gif','icon_redface.gif','icon_razz.gif','icon_rolleyes.gif','icon_wink.gif','icon_cry.gif','icon_surprised.gif','icon_lol.gif','icon_mad.gif','icon_sad.gif','icon_exclaim.gif','icon_question.gif');
	if(!isset($type)){
		$type = '0';
	}
	if($type == '0'){
		$pattern = array(':mrgreen:',':neutral:',':twisted:',':arrow:',':shock:',':smile:',':???:',':cool:',':evil:',':grin:',':idea:',':oops:',':razz:',':roll:',':wink:',':cry:',':eek:',':lol:',':mad:',':sad:',':!:',':?:');
	} elseif($type == '1'){
		$pattern = array(':alumrgreen:',':aluneutral:',':alutwisted:',':aluarrow:',':alushock:',':alusmile:',':alu???:',':alucool:',':aluevil:',':alugrin:',':aluidea:',':aluoops:',':alurazz:',':aluroll:',':aluwink:',':alucry:',':alueek:',':alulol:',':alumad:',':alusad:',':alu!:',':alu?:');
	} elseif($type == '2') {
		$pattern = array(':qqmrgreen:',':qqneutral:',':qqtwisted:',':qqarrow:',':qqshock:',':qqsmile:',':qq???:',':qqcool:',':qqevil:',':qqgrin:',':qqidea:',':qqoops:',':qqrazz:',':qqroll:',':qqwink:',':qqcry:',':qqeek:',':qqlol:',':qqmad:',':qqsad:',':qq!:',':qq?:');
	}
	$smtrans = array_combine($pattern,$smsort);
	$smiled = array();
	$smiliesicon = array();
	$smiliestag = array();
	$smiliesimg = array();
	$loading = 'data:image/gif;base64,R0lGODlhKwAeAJEAAP///93d3Xq9VAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFFAAAACwDAA0AJQADAAACEpSPAhDtHxacqcr5Lm416f1hBQAh+QQJFAAAACwDAA0AJQADAAACFIyPAcLtDKKcMtn1Mt3RJpw53FYAACH5BAkUAAAALAMADQAlAAMAAAIUjI8BkL0CoxQtrYrenPjcrgDbVAAAOw==';
	if(Helper::options()->smilescdn){
		$smurl = str_ireplace($turl,Helper::options()->smilescdn,$turl);
	}else{
		$smurl = $turl;
	}
	if($type == '0'){
		$smurl = $smurl.'qq/';
	} elseif($type == '1'){
		$smurl = $smurl.'alu/';
	} elseif($type == '2') {
		$smurl = $smurl.'qqplus/';
	}
	foreach ($smtrans as $tag=>$grin) {
	if (!in_array($grin,$smiled)) {
		$smiled[] = $grin;
		if( Helper::options()->lazyimg ){
		if( $type =='1' ){
			$smiliesicon[] ='<a href="javascript:grin(\''.$tag.'\')"><img src="'.$loading.'" data-src="'.$smurl.$grin.'" alt="'.$grin.'" class="asmile lazyloading b-lazy"/></a>';
			$smiliesimg[] = '<img src="'.$loading.'" data-src="'.$smurl.$grin.'" alt="'.$grin.'" class="smilies lazyloading b-lazy"/>'; 
		}else{
                        $smiliesicon[] ='<a href="javascript:grin(\''.$tag.'\')"><img src="'.$loading.'" data-src="'.$smurl.$grin.'" alt="'.$grin.'" class="asmile lazyloading b-lazy qqplus"/></a>';
                        $smiliesimg[] = '<img src="'.$loading.'" data-src="'.$smurl.$grin.'" alt="'.$grin.'" class="smilies lazyloading b-lazy qqplus"/>';
		}}else{
		if( $type =='1' ){
			$smiliesicon[] ='<a href="javascript:grin(\''.$tag.'\')"><img src="'.$smurl.$grin.'" alt="'.$grin.'" class="asmile lazyloading b-lazy"/></a>'; 
			$smiliesimg[] = '<img src="'.$smurl.$grin.'" alt="'.$grin.'" class="smilies lazyloading b-lazy"/>'; 
		}else{
                        $smiliesicon[] ='<a href="javascript:grin(\''.$tag.'\')"><img src="'.$smurl.$grin.'" alt="'.$grin.'" class="asmile lazyloading b-lazy qqplus"/></a>';
                        $smiliesimg[] = '<img src="'.$smurl.$grin.'" alt="'.$grin.'" class="smilies lazyloading b-lazy qqplus"/>';

		}}
	}
	$smiliestag[] = $tag;
//	$smiliesmanage[] ='<img src="'.$smurl.$grin.'" class="asmile lazyloading b-lazy" alt="'.$grin.'"/>'; 后台
	}
		return array($smiliesicon,$smiliestag,$smiliesimg);
}

//输出选框
function outputsilies($type){
	$arrays = parsesmilies($type);
	$smilies = '';
	foreach ($arrays['0'] as $icon) {
		$smilies .= $icon;
	}
	$output = $smilies;
		echo $output;
}

//文章压缩
function compressHtml($html_source) {
    $chunks = preg_split('/(<!--<nocompress>-->.*?<!--<\/nocompress>-->|<nocompress>.*?<\/nocompress>|<pre.*?\/pre>|<textarea.*?\/textarea>|<script.*?\/script>)/msi', $html_source, -1, PREG_SPLIT_DELIM_CAPTURE);
    $compress = '';
    foreach ($chunks as $c) {
        if (strtolower(substr($c, 0, 19)) == '<!--<nocompress>-->') {
            $c = substr($c, 19, strlen($c) - 19 - 20);
            $compress .= $c;
            continue;
        } else if (strtolower(substr($c, 0, 12)) == '<nocompress>') {
            $c = substr($c, 12, strlen($c) - 12 - 13);
            $compress .= $c;
            continue;
        } else if (strtolower(substr($c, 0, 4)) == '<pre' || strtolower(substr($c, 0, 9)) == '<textarea') {
            $compress .= $c;
            continue;
        } else if (strtolower(substr($c, 0, 7)) == '<script' && strpos($c, '//') != false && (strpos($c, "\r") !== false || strpos($c, "\n") !== false)) {
            $tmps = preg_split('/(\r|\n)/ms', $c, -1, PREG_SPLIT_NO_EMPTY);
            $c = '';
            foreach ($tmps as $tmp) {
                if (strpos($tmp, '//') !== false) {
                    if (substr(trim($tmp), 0, 2) == '//') {
                        continue;
                    }
                    $chars = preg_split('//', $tmp, -1, PREG_SPLIT_NO_EMPTY);
                    $is_quot = $is_apos = false;
                    foreach ($chars as $key => $char) {
                        if ($char == '"' && $key != '0' && $chars[$key - 1] != '\\' && !$is_apos) {
                            $is_quot = !$is_quot;
                        } else if ($char == '\'' && $key != '0' && $chars[$key - 1] != '\\' && !$is_quot) {
                            $is_apos = !$is_apos;
                        } else if ($char == '/' && $chars[$key + 1] == '/' && !$is_quot && !$is_apos) {
                            $tmp = substr($tmp, 0, $key);
                            break;
                        }
                    }
                }
                $c .= $tmp;
            }
        }
        $c = preg_replace('/[\\n\\r\\t]+/', ' ', $c);
        $c = preg_replace('/\\s{2,}/', ' ', $c);
        $c = preg_replace('/>\\s</', '> <', $c);
        $c = preg_replace('/\\/\\*.*?\\*\\//i', '', $c);
        $c = preg_replace('/<!--[^!]*-->/', '', $c);
        $compress .= $c;
    }
    return $compress;
}

//评论图片
function commentimg($content){
	$options = Typecho_Widget::widget('Widget_Options');
	preg_match_all('/<img(.*?)src="(.*?)"(.*?)>/',$content,$matches);
	if($matches){
		foreach ($matches[2] as $val){
			if($options->lazyimg){
				$content = str_replace('/<img(.*?)/','<a data-no-instant="true" data-fancybox="comment-gallery" data-type="image" href="$val" class="light-link"><img src="' . __LAZYIMG2__ . '" data-src="$val" class="b-lazy commentimg"/></a>',$content);
			}else{
				$content = str_replace('/<img(.*?)>/','<a data-no-instant="true" data-fancybox="comment-gallery" data-type="image" href="$val" class="light-link"><img src="$val" class="b-lazy commentimg"/></a>',$content);
			}
		}
	}
	return $content;
}

//获取实际 IP 地址
function get_ip(){
	static $realip; //定义常量
	if (isset($_SERVER)){
		if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
			$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		} else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
			$realip = $_SERVER["HTTP_CLIENT_IP"];
		} else {
			$realip = $_SERVER["REMOTE_ADDR"];
		}
	} else {
		if (getenv("HTTP_X_FORWARDED_FOR")){
			$realip = getenv("HTTP_X_FORWARDED_FOR");
		} else if (getenv("HTTP_CLIENT_IP")) {
			$realip = getenv("HTTP_CLIENT_IP");
		} else {
			$realip = getenv("REMOTE_ADDR");
		}
	}
	return $realip;
}

//获取 IP 来源位置
function get_ip_addr($ip){
	$get_json = file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=$ip");
	$loc = json_decode($get_json,true);
	//国家：$loc["data"]["country"],省份:$loc["data"]["region"],城市:$loc["data"]["city"],运营商:$loc["data"]["isp"];
	if($loc["data"]["region"]){
		return $loc["data"]["region"];
	}else{
		return "火星";
	}
}

function show_ip_addr($coid,$ip){
	$db     = Typecho_Db::get();
	$prefix = $db->getPrefix();
	if (!array_key_exists('loc', $db->fetchRow($db->select()->from('table.comments')))) {
		$db->query('ALTER TABLE `' . $prefix . 'comments` ADD `loc` VARCHAR(50) DEFAULT NULL;');
		return "火星";
	}
	$row = $db->fetchRow($db->select('loc')->from('table.comments')->where('coid = ?', $coid));
	if (!isset($row['loc'])){
		$addr = get_ip_addr($ip);
		$db->query($db->update('table.comments')->rows(array('loc' => $addr))->where('ip = ?',$ip));
		return $addr;
	}
	return $row['loc'];
}

function theNext($widget, $default = NULL){
    $db = Typecho_Db::get();
    $sql = $db->select()->from('table.contents')
        ->where('table.contents.created > ?', $widget->created)
        ->where('table.contents.status = ?', 'publish')
        ->where('table.contents.type = ?', $widget->type)
        ->where('table.contents.password IS NULL')
        ->order('table.contents.created', Typecho_Db::SORT_ASC)
        ->limit(1);
    $content = $db->fetchRow($sql);
    if ($content) {
        $content = $widget->filter($content);
//        $link = '<a href="' . $content['permalink'] . '" title="' . $content['title'] . '">←</a>';
	if(isset($content['permalink'])){
	  $link = 'var nextpost="'.$content['permalink'].'";';
	}else{
	  $link = NULL;
        }
        echo $link;
    } else {
        echo $default;
    }
}
function thePrev($widget, $default = NULL){
    $db = Typecho_Db::get();
    $sql = $db->select()->from('table.contents')
        ->where('table.contents.created < ?', $widget->created)
        ->where('table.contents.status = ?', 'publish')
        ->where('table.contents.type = ?', $widget->type)
        ->where('table.contents.password IS NULL')
        ->order('table.contents.created', Typecho_Db::SORT_DESC)
        ->limit(1);
    $content = $db->fetchRow($sql);
    if ($content) {
        $content = $widget->filter($content);
//        $link = '<a href="' . $content['permalink'] . '" title="' . $content['title'] . '">→</a>';
        if(isset($content['permalink'])){
           $link = 'var prevpost="'.$content['permalink'].'";';
        }else{
	   $link = NULL;
	}
	echo $link;
    } else {
        echo $default;
    }
}
function fixpic($file){
$ext = pathinfo($file,PATHINFO_EXTENSION);
$imginfo = getimagesize($file);
$type = substr(strrchr($imginfo['mime'],'/'),1);
if ($type !='jpeg'){
   $pw = $imginfo[0];
   $ph = $imginfo[1];
   $dstimg = imagecreatetruecolor($pw,$ph);
   $color = imagecolorallocate($dstimg,255,255,255);
   imagefill($dstimg,0,0,$color);
   if ($type=='png'){
      $srcimg = imagecreatefrompng($file);
   }
   if ($type=='gif'){
      $srcimg = imagecreatefromgif($file);
   }
   imagecopyresampled($dstimg,$srcimg,0,0,0,0,$pw,$ph,$pw,$ph);
   imagejpeg($dstimg,$file,90);
   imagedestroy($dstimg);
}
}
