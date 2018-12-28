if (!Array.prototype.get) {
  Array.prototype.get = function(index){
    return this[index];
  }
}
/* 
 * addEventListener:监听Dom元素的事件 
 * 
 * target：监听对象 
 * type：监听函数类型，如click,mouseover 
 * func：监听函数 
 */

var support_css = (function() {
 var div = document.createElement('div'),
  vendors = 'Ms O Moz Webkit'.split(' '),
  len = vendors.length;
  
 return function(prop) {
  if ( prop in div.style ) return true;
  
  prop = prop.replace(/^[a-z]/, function(val) {
   return val.toUpperCase();
  });
  
  while(len--) {
   if ( vendors[len] + prop in div.style ) {
   return true;
   } 
  }
  return false;
 };
})();

function addEventHandler(target,type,func, useCapture){
  if (!target) {
    return;
  }
 if(target.addEventListener){ 
  //监听IE9，谷歌和火狐 
  target.addEventListener(type, func, useCapture==true); 
 }else if(target.attachEvent){ 
  target.attachEvent("on" + type, func); 
 }else{ 
  target["on" + type] = func; 
 } 
} 
/* 
 * removeEventHandler:移除Dom元素的事件 
 * 
 * target：监听对象 
 * type：监听函数类型，如click,mouseover 
 * func：监听函数 
 */
function removeEventHandler(target, type, func, useCapture) { 
  if (!target) {
    return;
  }
 if (target.removeEventListener){ 
  //监听IE9，谷歌和火狐 
  target.removeEventListener(type, func, userClose == true); 
 } else if (target.detachEvent){ 
  target.detachEvent("on" + type, func); 
 }else { 
  delete target["on" + type]; 
 } 
}

function zIndex(index, level){
  var level = level || 0;
  var num = +new Date + '';
  var str = num.substr(-5-level);
  var index = index || 0;
  return str + index;
}

function windowSize(){
  if (window.innerWidth){
    winWidth = window.innerWidth;
  }else if ((document.body) && (document.body.clientWidth)){
    winWidth = document.body.clientWidth;
  }
  // 获取窗口高度
  if (window.innerHeight){
    winHeight = window.innerHeight;
  }else if ((document.body) && (document.body.clientHeight)){
    winHeight = document.body.clientHeight;
  }
  // 通过深入 Document 内部对 body 进行检测，获取窗口大小
  if (document.documentElement && document.documentElement.clientHeight && document.documentElement.clientWidth)
  {
  winHeight = document.documentElement.clientHeight;
  winWidth = document.documentElement.clientWidth;
  }
  return {
    width: winWidth,
    height: winHeight
  }
}

var userUpTimer, userDownTimer;
function usrOpen(event){
  if (userDownTimer) {
   clearTimeout(userDownTimer);
   userDownTimer = null;
 }
   document.getElementById('user-tools').className = 'user-tools user-tools-active';
   userUpTimer = setTimeout(function(){
      document.getElementById('user-menu').className = 'user-menu user-menu-up';
   },1);
}

function userClose(){
  if (userUpTimer) {
  clearTimeout(userUpTimer);
  userUpTimer = null;
}
  document.getElementById('user-menu').className = 'user-menu user-menu-down';
  userDownTimer = setTimeout(function(){
     document.getElementById('user-tools').className = 'user-tools';
     document.getElementById('user-menu').className = 'user-menu';
  },300);
}

function ajaxForm(form, $url){
   if (typeof form === "string") {
      form = document.getElementById(form);
   }
   if (!form || !form.tagName || !form.submit) {
    return;
   }
   var data = serialize(form, true);
   if (this.slug && !validate(data, this.slug)) {
     return;
   }
   if (!InstantClick.supported) {
      return form.submit();
   }
   var that = this;
   var url = form.action ? form.action : window.location.href,
        $url = $url || url;

    if (this.target && this.target=="comment-form") {
       var hashIndex = $url.indexOf("#");
       var hash = "#comment-form";
       if (data.parent) {
          hash = "#comment-"+data.parent;
       }
       if(hashIndex>-1){
         $url = $url.substr(0, hashIndex);
       }
       $url += hash;
    }
    NProgress.start();
    NProgress.inc();
    //InstantClick.bar.start(0, true);
    var start = +new Date + 0;
    var type = form.method ? form.method : 'post';
    return ajax(url, {
      type:type,
      data: data,
      success:function(responseText){
        that.text && ArmMessage.success(that.text+'成功');
	//20181224
	//var uri =window.location.href.split("/")[0]+"//"+window.location.href.split("/")[2]+"/xx" + window.location.pathname;
	//console.log(uri);
	//$.get(uri,function(data,status){
	//	return ture;
	//});
        InstantClick.reload($url);
      },
      error:function(){
        ArmMessage.error(target.text+'失败, 请重试');
        //$('html,body').animate({scrollTop: $('#comments').offset().top + 50}, 500);
      },
      complete:function(){
	  NProgress.done();
        //InstantClick.bar.done();
      }
    });
}


function validate(data, rule){
  switch (rule) {
    case 'comment':
          if (typeof data.author!=="undefined" && !trim(data.author).length) {
            return returnFalse('昵称没填哦');
          }
          if (typeof data.mail!=="undefined" && !trim(data.mail).length) {
            return returnFalse('邮箱没填哦');
          }
    //      var reg = /^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/;
    //      if (!reg.test(data.mail)) {
    //        return returnFalse('这个邮箱收不到邮件啦');
    //      }
   //    var reg = /^https?:\/\/([^.]+)\.([^.]+)/;
   //      if (trim(data.url).length && reg.test(data.url)) {
   //         return returnFalse('这个网站打不开啊');
   //       }
          if (typeof data.text!=="undefined" && !trim(data.text).length) {
            return returnFalse('没有评论内容呢');
          }
      break;
  }

  return true;
}

function serialize(form, toArray) {
  if (typeof form === "string") {
    form = document.getElementById(form);
  }
  if (!form) {
    return toArray ? [] : null;
  }
  var data = [];
  var parse = function(elems){
    for (var i = 0; i < elems.length; i++) {
      if ((/radio|checkbox/.test(elems[i].type) && !elems[i].checked) || elems[i].disabled ) {
         continue;
      }
      data[elems[i].name] =  trim(elems[i].value);
    }
  }
  parse(form.getElementsByTagName('input'));
  parse(form.getElementsByTagName('select'));
  parse(form.getElementsByTagName('textarea'));
  return data;
}

function trim(string){
  return string.replace(/^\s+/,'').replace(/\s+$/,'');
}

function extend(obj1, obj2, newObj) {
  var key;
  if (typeof obj2==="object" && typeof obj1 === "object") {
    if(newObj){
      var obj = {};
      for (key in obj1) {
        obj[key] = obj1[key];
      }
      for (key in obj2) {
        obj[key] = obj2[key];
      }
      return obj;
    }else{
      for(key in obj2){
        obj1[key] = obj2[key];
      }
    }
  }
  return obj1;
}

function showLoading(){
  var loading = document.getElementById('loading');
  if (!loading) {
     loading = document.createElement('div');
     loading.className = 'loading';
     loading.id = 'loading';
     document.body.appendChild(loading);
  }
  loading.className = 'loading loading-active';
}

function hideLoading(){
  if (document.getElementById('loading')) {
    document.getElementById('loading').className = 'loading';
  }
}

function addClass(element, className){
  if (!element) {
    return;
  }
   var className = trim(className).split(/\s+/);
   var _className = element.className;
   for (var i = 0; i < className.length; i++) {
     if (!className[i] ||
      new RegExp('([\s\'"]+)?'+className[i]+'([\s\'"]+)?', 'ig').test(_className) ) {
      continue;
     }
     _className += ' ' + className[i];
   }
   element.className = trim(_className).replace(/\s+/, ' ');
}

function hasClass(element, className) {
  return element && element.className && new RegExp('([\s\'"]+)?'+className+'([\s\'"]+)?', 'ig').test(element.className);
}

function removeClass(element, className) {
  if (!element) {
    return;
  }
  var className = trim(className).split(/\s+/);
  var _className = trim(element.className);
  for (var i = 0; i < className.length; i++) {
    if (!className[i]) {
      continue;
    }
    _className = _className.replace(new RegExp('([\s\'"]+)?'+className[i]+'([\s\'"]+)?', 'ig'), '$1$2');
  }
  if (_className!==element.className) {
    element.className = trim(_className).replace(/\s+/, ' ');
  }
}

function getScrollOffset(){
    // 除IE8及更早版本
    if( window.pageXOffset != null ){
        return {
            x : window.pageXOffset,
            y : window.pageYOffset
        }
    }
    // 标准模式下的IE
    if( document.compatMode == "css1Compat" ){
        return {
            x : document.documentElement.scrollLeft,
            y : document.documentElement.scrollTop
        }
    }
    // 怪异模式下的浏览器
    return {
        x : document.body.scrollLeft,
        y : document.body.scrollTop
    }
}

/**
 * 判断是否为选择元素
 * @author NatLiu
 * @date   2018-01-18T10:29:27+0800
 * @param  {[type]}                 element  [description]
 * @param  {[type]}                 selector [description]
 * @return {Boolean}                         [description]
 */
function isSelectorElement(element, selector) {
  if (!element || element.nodeType!=1) {
    return false;
  }
  if (typeof selector === "string") {
    if (selector === '*') {
      return true;
    }
    if ( /^#\S+/i.test(selector) ) {
       return document.getElementById( selector.replace(/^#/,'') ) == element;
    }
    var match = selector.match(/([^\.\[]+)?(\[\w+=\w+\])?(\.\S+)?/);
    if (!match || !match.length) {
      return false;
    }

    if (match[1] && match[1].toUpperCase() != element.tagName.toUpperCase() ) {
       return false;
    }

    if (match[2]) {
       var attrs = match[2].replace(/\[([^\[\]]+)\]/,'$1').split('=');
       if (element.getAttribute(attrs[0]) != attrs[1] ) {
         return false;
       }
    }

    if (match[3]) {
      var classNames = match[3].split('.');
      for (var i = 0; i < classNames.length; i++) {
        if ( !hasClass(element, classNames[i] ) ) {
          return false;
        }
      }

    }

    return true;
  }
  return element == selector;
}
/**
 * 查找所有匹配的子元素
 * @author NatLiu
 * @date   2018-01-18T11:23:29+0800
 * @param  {[type]}                 selector [description]
 * @param  {[type]}                 finds    [description]
 * @param  {[type]}                 parent   [description]
 * @return {[type]}                          [description]
 */
function findElements(selector, context, querySelectorAll) {
  if (typeof selector!=="string") {
    if (typeof selector == "object" && selector.tagName) {
      return [selector];
    }
    return [];
  }
  var parent;
  if (context) {
    var parent = findElements(context)[0];
    if (!parent) {
      return [];
    }
  }
  if (typeof document.querySelectorAll == "function" ) {
    var parent = parent || document;
    var finds = parent.querySelectorAll(selector);
    return finds;
  }
  var matches = selector.split(','), finds = [], selectorGroup = [];
  for (var j = 0; j < matches.length; j++) {
    var selectors = matches[j].split(/\s+/), isBreak = false;
    for (var i = 0; i < selectors.length; i++) {
      if (/^#\S+/i.test(selectors[i]) && !document.getElementById( selectors[i].replace(/^#/,'') ) ) {
        isBreak = true;
        break;
      }
    }
    if (!isBreak) {
      if (parent) {
        selectors.splice(0,0, parent);
      }
      selectorGroup.push(selectors);
    }
  }
  if (selectorGroup.length==1 && selectorGroup[0].length == 1 && /^#\S+/i.test(selectorGroup[0][0])) {
     return [document.getElementById( selectorGroup[0][0].replace(/^#/,'') )];
  }

  var elements = document.getElementsByTagName('*');
  for (var i = 0; i < elements.length; i++) {

     var matches = _matchChildNodes(elements[i], selectorGroup);
     if (matches === true) {
        finds.push(elements[i]);
        continue;
     }
     if (!matches.length) {
       continue;
     }
     var parentMatches = _matchParentNodes( elements[i], matches );
     if ( parentMatches ) {
        finds.push(elements[i]);
     }
     
  }
  return finds;
}

/**
 * 匹配子元素
 * @author NatLiu
 * @date   2018-01-22T09:10:49+0800
 * @param  {[type]}                 element       [description]
 * @param  {[type]}                 selectorGroup [description]
 * @return {[type]}                               [description]
 */
function _matchChildNodes(element, selectorGroup) {
  var matches = [];
  for (var i = 0; i < selectorGroup.length; i++) {
    var selector = selectorGroup[i][selectorGroup[i].length-1];
    if (isSelectorElement(element, selector) ) {
       if (selectorGroup[i].length==1) {
         matches = true;
         break;
       }
       matches.push(selectorGroup[i]);
    }
  }
  return matches;
}

/**
 * 匹配父级元素
 * @author NatLiu
 * @date   2018-01-22T09:11:07+0800
 * @param  {[type]}                 element     [description]
 * @param  {[type]}                 parentGroup [description]
 * @return {[type]}                             [description]
 */
function _matchParentNodes(element, parentGroup) {
   var parent = element.parentNode, parentMathes = [];
   var match = false;
   while (parent && parent != parent.parentNode && !match) {
      for (var i = 0; i < parentGroup.length; i++) {
         var node = parentGroup[i];
         parentMathes[i] = typeof parentMathes[i] == "undefined" ? node.length - 2 : parentMathes[i];
         if (isSelectorElement(parent, node[parentMathes[i]] )) {
            if (parentMathes[i] == 0) {
              match = true;
              break;
            }
            parentMathes[i]--;
         }
      }
      if (match) {
        break;
      }
      parent = parent.parentNode;
   }
   return match;
}

/**
 * 选择第一级子元素
 * @author NatLiu
 * @date   2018-01-18T10:29:41+0800
 * @param  {[type]}                 element  [description]
 * @param  {[type]}                 selector [description]
 * @return {[type]}                          [description]
 */
function childrenElements(selector, parent) {
  parent = parent || document.documentElement;
  if (typeof parent !=="object" || parent.nodeType!=1) {
    parent = findElements(parent)[0];
  }
  if (!parent || !parent.childNodes || !parent.childNodes.length) {
    return [];
  }
  var children = [], nodes = parent.childNodes;
   for (var i = 0; i < nodes.length; i++) {
     if (nodes[i].nodeType == 1) {
      if (selector) {
        if (isSelectorElement(nodes[i], selector )) {
          children.push(nodes[i]);
        }
      }else{
        children.push(nodes[i]);
      }
     }
   }
   return children;
}

function getHeight(dom, height, withPadding){
   var height = dom.innerHeight || dom.clientHeight || dom.offsetHeight || dom.scrollHeight;
   if (withPadding && dom.style) {
      height += parseInt(dom.style.paddingTop) + parseInt(dom.style.paddingBottom);
      height += parseInt(dom.style.borderTop) + parseInt(dom.style.borderBottom);
   }
   return height;
}

function getWidth(dom, height, withPadding){
   var width = dom.innerWidth || dom.clientWidth || dom.offsetWidth || dom.scrollWidth;
   if (withPadding && dom.style) {
      width += parseInt(dom.style.paddingLeft) + parseInt(dom.style.paddingRight);
      width += parseInt(dom.style.borderLeft) + parseInt(dom.style.borderRight);
   }
   return width;
}

var prefixStyle = (function(){
  var _elementStyle = document.createElement('div').style;
  return function _prefixStyle (style) {
    if(style in _elementStyle)
      return style;
    var vendors = ['webkit', 'Moz', 'ms', 'O'],
          s,
          i = 0,
          l = vendors.length;

      for ( ; i < l; i++ ) {
          s = vendors[i] + style.charAt(0).toUpperCase() + style.substr(1);
          if ( s in _elementStyle) return s;
      }
      return false;
  }
})();

function toggleClass(element, className) {
    if (!element) {
    return;
  }
    if(new RegExp('([\s\'"]+)?'+className+'([\s\'"]+)?', 'ig').test(element.className)){
      removeClass(element, className);
    }else{
      addClass(element, className);
    }
}
var rvalidtokens = /(,)|(\[|{)|(}|])|"(?:[^"\\\r\n]|\\["\\\/bfnrt]|\\u[\da-fA-F]{4})*"\s*:?|true|false|null|-?(?!0\d)\d+(?:\.\d+|)(?:[eE][+-]?\d+|)/g;
function parseJSON(data){
   if (window.JSON && JSON.parse) {
      return JSON.parse(data);
   }
  var requireNonComma,
    depth = null,
    str = trim( data + "" );
  return str && !trim( str.replace( rvalidtokens, function( token, comma, open, close ) {

    if ( requireNonComma && comma ) {
      depth = 0;
    }
    if ( depth === 0 ) {
      return token;
    }
    requireNonComma = open || comma;

    depth += !close - !open;
    return "";
  } ) ) ?
    ( Function( "return " + str ) )() :
    throwError( "Invalid JSON: " + data );

}

function throwError(str){
    throw new Error( str );
}

function addZero(number, digits){
  var number = ''+number;
  var digits = digits || 2;
   if (digits > number.length) {
      number = new Array(digits - number.length + 1).join('0') + number;
   }
   return number;
}

function getRandomNum(Min,Max){   
  var Range = Max - Min;   
  var Rand = Math.random();   
  return (Min + Math.round(Rand * Range));   
}

function ajaxResponse(){
  var handler = arguments[0];
  var args = [];
  if (arguments.length>1) {
    for (var i = 1; i < arguments.length; i++) {
      args.push(arguments[i]);
    }
  }
  typeof this.options[handler] === "function" && this.options[handler].apply(this, args);
  typeof this.options.complete === "function" && this.options.complete.apply(this, args);
}

function ajaxConvert(text, type) {
  switch (type) {
    case 'json':
      return parseJSON(text);
      break;
  }
  return text;
}

function ajax(url, params){
  var xmlhttp;
  if (window.XMLHttpRequest)
  {// code for all new browsers
    xmlhttp=new XMLHttpRequest();
  }
  else if (window.ActiveXObject)
  {// code for IE5 and IE6
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  if (!xmlhttp) {
    return throwError("Your browser does not support XMLHTTP.");
  }
  
  var type = 'GET',
      async = true,
      data = [],
      paramstring = '',
      url = url.replace(/(#.+)?/i, ''),
      urlParamstring = url.replace(/[^\?]+\?([^=]+=[\S]+)?/i, "$1"),
      formData = null;
  if (typeof params === "object") {
    if (typeof params.type == "string" && (params.type.toUpperCase() === "GET" || params.type.toUpperCase() ==="POST") ) {
      type = params.type.toUpperCase();
    }

    if (typeof params.async === "boolean") {
       async = params.async;
    }

    if (typeof params.data === "object") {
      if (window.FormData && params.formData === true) {
        formData = new FormData();
      }
       for (key in params.data) {
         if (formData) {
           formData.append(key, params.data[key]);
         }
         if (typeof params.data[key] === "object") {
            params.data[key] = JSON.stringify(params.data[key]);
         }
         data.push(key+'=' + params.data[key]);
       }
    }else if(typeof params.data === "string" && /[^=]+=[\S]+/i.test(params.data)){
      data.push(params.data);
    }
  }

  paramstring = data.join('&');

  if (type === "GET") {
     if (urlParamstring !== url) {
        url = url + (paramstring.length ? '&' + paramstring : '');
     }else{
        url = url + (paramstring.length ? '?' + paramstring : '');
     }
  }
  xmlhttp.open(type, url, async);

  var options = typeof params === "object" ? params : {};
  var xhrData = {
     url: url,
     xhr: xmlhttp,
     options: options
  };
  xmlhttp.onabort = function(event){
    ajaxResponse.call(xhrData, 'error', event, 'abort');
  };

  xmlhttp.onerror = function(event){
    ajaxResponse.call(xhrData, 'error', event, 'error');
  }

  xmlhttp.ontimeout = function(event){
    ajaxResponse.call(xhrData, 'error', event, 'timeout');
  }

  xmlhttp.onreadystatechange = function(){
    if (xmlhttp.readyState==4) {
      var isSuccess = xmlhttp.status >= 200 && xmlhttp.status < 300 || xmlhttp.status === 304;
      if (isSuccess) {
        ajaxResponse.call(xhrData, 'success', ajaxConvert(xmlhttp.responseText, options.dataType));
      }else{
        ajaxResponse.call(xhrData, 'error', xmlhttp.status, 'error');
      }
    }
  }

  if (type === "POST") {
    xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xmlhttp.send( formData ? formData : (paramstring ? paramstring : null) );
  }else{
    xmlhttp.send(null);
  }
  return xhrData;
  
}

function returnFalse(msg){
  ArmMessage.error(msg);
  return false;
}

var cookie = (function(doc){

  function getCookie(name){
    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
    if(arr=doc.cookie.match(reg)){
        return unescape(arr[2]);
    }
    return null;
  }

  function setCookie(name,value,time){
    time = time || '3d'; //默认3天
    var strsec = getsec(time);
    var exp = new Date();
    exp.setTime(exp.getTime() + strsec*1);
    doc.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
  }

  function removeCookie(name){
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval = getCookie(name);
    if(cval!=null)
    doc.cookie= name + "="+cval+";expires="+exp.toGMTString();
  }

  function getsec(str){
    if (typeof str ==="number") {
      return str *1000;
    }
    var str1= 1 * str.substring(0,str.length-1);
    var str2=str.substr(-1,1);
    if (str2=="s"){
      return str1*1000;
    }
    else if (str2=="h"){
      return str1*60*60*1000;
    }else if (str2=="d"){
      return str1*24*60*60*1000;
    }
  }

  return {
    getItem: getCookie,
    setItem: setCookie,
    removeItem: removeCookie
  }
})(document);


/**
 * 对话框
 * @param  {[type]} win [description]
 * @param  {[type]} doc [description]
 * @return {[type]}     [description]
 */
;(function(win, doc){

    var current;
    var dialog = function(){
        
    }

    dialog.prototype.open = function(el, options){
        if (typeof el === "string") {
          el = document.getElementById(el);
        }
        if (current) {
          this._close(current);
        }
        var newcreate = false;
        if (!el || !el.tagName) {
            newcreate = true;
            options = typeof el === "object" ? el : options;
            var el = document.createElement('DIV'),
            body = typeof options.content == "function" ? options.content() : options.content;
            if (options.type==="iframe") {
               body = '<div class="dialog-loading"></div><iframe src="'+body+'" style="position:absolute; right:0; top:0; bottom:0; left:0;" width="100%" height="100%" marginheight="0" marginheight="0" frameborder="0" scrolling="auto"></iframe>';
            }
          var style = '', win = windowSize(),
              className = 'dialog dialog-dynamic' + (options.className ? ' '+options.className : '');;
          if (options.width) {
             options.width = parseInt(options.width);
             if (options.width > win.width-10) {
              options.width = win.width-10;
             }
             style += 'width:'+options.width + 'px;';
             style += 'margin-left:'+(-options.width/2) + 'px;';
             style += 'left:50%; right:auto;';
          }
          if (options.width) {
            options.height = parseInt(options.height);
            if (options.height > win.height-10) {
              options.height = win.height-10;
            }
            style += 'height:'+options.height + 'px;';
            style += 'margin-top:'+(-options.height/2) + 'px;';
            style += 'top:50%; bottom:auto;';
          }
          el.innerHTML = '<div class="dialog-bg" data-dialog-toggle="close"></div>\
                          <div class="dialog-box" style="'+style+'">\
                            <div class="dialog-body">'
                            + body +
                            '</div>\
                          </div>';

          var iframe = findElements('iframe', el)[0], loading = findElements('.dialog-loading', el)[0];
          el.className = className;
          document.body.appendChild(el);
          if (iframe && loading) {
            setTimeout(function(){
              loading.style.width = options.width*0.9 + 'px';
            }, 700);
            iframe.onload = function(){
              loading.style.width = options.width + 'px';
              loading.parentNode.removeChild(loading);
            }
          }
        }
        if (!el.id) {
           el.id = options.id || 'dialog-' + Number(new Date());
        }
        if (newcreate) {
          typeof options.oncreate == "function" && options.oncreate.call(el);
        }
        return this._open(el, options ? options : {});
    }

    dialog.prototype._open = function(el, options){
      var that = this;
      addClass(el, 'dialog dialog-open');
      el.style.zIndex = zIndex();
      current = el;
      if (!el._isDialog) {
        addEventHandler(el, 'click', function(event){
          var target = event.target || event.srcElement;
          if (target) {
            var action = target.getAttribute('data-dialog-toggle');
            if (action==="close") {
               that.close(el);
            }
          }
        });
        el._isDialog = true;
      }
      typeof options.open == "function" && options.open.call(el);
    }

    dialog.prototype.close = function(el){
      if (typeof el === "string") {
        el = document.getElementById(el);
      }
      if (el && el.tagName) {
        this._close(el);
      }
    }

    dialog.prototype._close = function(el){
      if (hasClass(el, 'dialog-dynamic')) {
        el.parentNode.removeChild(el);
      }else{
        removeClass(el, 'dialog-open');
      }
      current = null;
    }

    window.ArmDialog = new dialog;
})(window, document);

;(function(win, doc){
    var support = support_css('transform');
    var messageTypes = {
        success: {},
        error:{},
        warn: {},
        info:{},
        normal:{
           icon:false
        }
    };
    var idx = 0;
    var queue = [];
    var tags = {};
    var map = {};
    var box = null;
    var config = {
        animateIn: 400,
        animateOut: 400,
        time: 1000, //提示框超时
        position: 'rb',
        distance: '10px',
        boxWidth: 240,
        opacity: 0.8,
        translateY: false,
        translateBack: true
    };
    var _position = config.position;

    var poses = {
        rb: {

        },
        rt: {

        },
        lb:{

        },
        lt:{

        },
        cb:{

        },
        ct:{

        }
    };

    function msgId(index){
      return 'msg'+index;
    }

    function getMsg(index){
      return queue[map[msgId(index)]];
    }

    function msgBox(position, open){
       if (!box) {
          box = doc.createElement('DIV');
          box.className = 'message-box';
          box.id = 'message-box';
          doc.body.appendChild(box);
        }
        if (open==true) {
          var pos = poses[position] ? position : config.position;
          box.style.left = /l/i.test(pos) ? config.distance : 'auto';
          box.style.right = /r/i.test(pos) ? config.distance : 'auto';
          box.style.top = /t/i.test(pos) ? config.distance : 'auto';
          box.style.bottom = '50%';      //    /b/i.test(pos) ? config.distance : 'auto';
          if (/c/i.test(pos)) {
            box.style.left = "50%";
            box.style.right = "auto";
            box.style.marginLeft =  - config.boxWidth / 2 + 'px';
          }
          box.style.zIndex = zIndex(1,1);
          _position = pos;
        }
        return box;
    }

    function getConfig(key){
        if (key && typeof key==="string") {
          return config[key];
        }
        if (typeof key === "object") {
          for (i in key) {
            if(typeof i !=="undefined"){
              break;
            }
            config[i] = key[i];
          }
        }
        var name, _config = {};
        for (name in config) {
          _config[name] = config[name];
        }
        return _config;
    }

    function closeAll(){
       queue = [];
       map = {};
       tags = {};
       msgBox().innerHTML = '';
    }

    function close(index, destroy){
      var msgData = getMsg(index);
      if (msgData && msgData.id) {
        var target = document.getElementById(msgData.id);
        if (!target) {
          return;
        }
        msgData.status = -1;
        var timer = support && !destroy ? config.animateOut : 0;
        if (support) {
          target.style[prefixStyle('transition')] = 'all '+config.animateOut+'ms';
          setTimeout(function(){
            var distance = msgData.translateBack == false ? 0 - msgData.ani.distance : msgData.ani.distance;
            target.style[prefixStyle('transform')] = msgData.ani.translate+'('+ distance +'px)';
            target.style.opacity = 0;
          },1);
        }
        setTimeout(function(){
          if (target && target.nodeType == 1){
            try {
              msgBox().removeChild(target);
            } catch(e) {
            }
          }
        }, timer);
      }
    }

    function delay(index, delay){
      var msgData = getMsg(index);
      if (msgData) {
        msgData.timer = setTimeout(function(){
          close(index);
        }, delay);
      }
    }

    function getAni(translateY){
      var translate = 'translateX';
      var distance = config.boxWidth;
      var dir = translateY || config.translateY;
       if (/c/i.test(_position) || dir) {
          translate = 'translateY';
          distance = 100;
       }
       if ( (translate==="translateX" && /l/i.test(_position)) 
          ||(translate==="translateY" && /t/i.test(_position)) ){
          distance = -distance;
       }
       return {
          translate: translate,
          distance: distance
       }
    }

    function getTag(tagName, index, type){
      var tagName = tagName || 'message';
      if (!tags[tagName]) {
        tags[tagName] = [];
      }
      if (!tags[type]) {
        tags[type] = [];
      }
      tags[tagName].push(index);
      tags[type].push(index);
      return tagName;
    }

    function open(text, options){
      if (!support) {
        closeAll();
      }
      var msg = doc.createElement('DIV'),
            timestamp = +new Date;
            index = zIndex(++idx, 1);
            id = msgId(index),
            type = messageTypes[options.type] ? options.type : 'normal';

        msg.className = 'message message-'+type;
        msg.id = id;
        msg.style.zIndex = index;
        var _type = messageTypes[type];
        var icon = options.icon || '';
        if(!icon){
          if (_type.icon) {
            icon = 'message-type-icon icon-white-'+_type.icon;
          }else if(_type.icon!==false){
            icon = 'message-type-icon icon-white-'+type;
          }
          if (options.tag && options.tag!=='message' && options.icon!==false) {
            icon = 'message-tag-icon icon-white-'+options.tag;
          }
        }
        var html = '<div class="message-body">\
                        <div class="message-content">'+text+'</div>\
                    </div>';
        if (icon) {
          msg.className += ' message-has-icon';
          html += '<div class="message-icon icon '+icon+'"></div>';
        }
        msg.innerHTML = html;
        var msgData = {
           index: index,
           timestamp: timestamp,
           id: id,
           type: type,
           text: text,
           status: 0,
           tag: getTag(options.tag, index, type),
           time: typeof options.time ==="number" ? options.time : config.time,
           ani: getAni(options.translateY),
           action: options.action || '',
           translateBack: options.translateBack !== false,
           position: options.position || config.position
        };
        if (support) {
          msg.style[prefixStyle('transform')] = msgData.ani.translate+'('+msgData.ani.distance+'px)';
          msg.style.opacity = 0;
          msg.style[prefixStyle('transition')] = 'all '+config.animateIn+'ms';
        }
        if (msgData.action) {
           msg.setAttribute('data-action', msgData.action);
        }
        map[id] = queue.length;
        queue.push(msgData);
        var box = msgBox(options.position, true);
        if (box.childNodes.length) {
           box.insertBefore(msg, box.childNodes[0]);
        }else{
          box.appendChild(msg);
        }
        typeof options.onopen === "function" && options.onopen.call(msg, msgData);
        if (support) {
          setTimeout(function(){
            msg.style[prefixStyle('transform')] = msgData.ani.translate+'(0px)';
            msg.style.opacity = config.opacity;
          },15);
        }

        setTimeout(function(){
          typeof options.onopened === "function" && options.onopened.call(msg, msgData);
        }, support ? config.animateIn : 0);

        options.clickClose && addEventHandler(msg, 'click', function(){
           close(index);
        }, true);
        addEventHandler(msg, 'mouseenter', function(){
          if (msgData.timer) {
             clearTimeout(msgData.timer);
             msgData.timer = null;
          }
           addClass(msg, 'message-focus');
        });
        addEventHandler(msg, 'mouseleave', function(){
           delay(index, 500);
        });
        delay(index, msgData.time);
        return index;
    }

    var message = function(){
        this.version = '1.0';
    };
    message.prototype.config = function(key, value){
        if (typeof key==="string" && arguments.length == 2) {
           config[key] = value;
           return true;
        }
        return getConfig(key);
    }

    message.prototype.success = function(text, options){
       return this.open(text ,options, 'success');
    }

     message.prototype.error = function(text, options){
       return this.open(text , options, 'error');
    }

     message.prototype.warn = function(text, options){
       return this.open(text ,options, 'warn');
    }

     message.prototype.info = function(text, options){
       return this.open(text ,options, 'info');
    }

    message.prototype.open = function(text, options, _type){
        if (!text && text!=='' && text!==0) {
          return null;
        }
        if (typeof options === "object") {
          var type = options.type || 'normal';
        }else{
          var type = options;
          options = {}
        }
        options.type = _type || options.type;
        return open(text, options);
    }

    message.prototype.close = function(index){
        return close(index);
    }

    message.prototype.destroy = function(index){
      return close(index, true);
    }

    window.ArmMessage = new message;
})(window, document);
function getScrollTop() {
	return document.body.scrollTop || document.documentElement.scrollTop;
}
function getScrollHeight() {
	return document.body.scrollHeight || document.documentElement.scrollHeight;
}
function getClientHeight() {
	return Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
}
function reloadPage(){
  if (InstantClick && InstantClick.supported) {
    InstantClick.removeCache();
    InstantClick.reload(window.location.href);
  }else{
    setTimeout(function(){
      window.location.reload();
    },500);
  }
}


;(function(win, doc){
  var defaults = {
     fixed: false,
     title: '目录'
  };
  var Index = function(){
     
  };

  Index.prototype.init = function(element, options){
    this.element = findElements(element)[0];
    this.options = extend(defaults, options);
    if (!this.element || !this.options.target) {
      this.hasInit = false;
      return this;
    }
    this.headers = findElements('h2,h3', this.options.target);
    if (!this.headers || !this.headers.length) {
      this.hasInit = false;
      return this;
    }
    this.hasInit = true;
    this.options.width = getWidth(this.element);
    this.options.offsetTop = this.element.offsetTop;
    this.parseHeaders();
    this.build(this.data, this.element);
    var that = this;
    addEventHandler(window, 'scroll', function(event){
      that.scroll(event);
    });
  }

  Index.prototype.parseHeaders = function(){
    if (!this.hasInit) {
      return [];
    }
    this.data = [];
    this.headerIds = [];
    for (var i = 0; i < this.headers.length; i++) {
      var header = this.headers[i], tagName = header.tagName.toLowerCase();
      if (!header.id) {
        header.id = 'article-header-'+i;
      }
      this.headerIds.push(header.id);
      if ('h2'==tagName) {
        this.data.push(
            {
              id:header.id,
              title: header.innerHTML,
              children: []
            }
        );
      }else if('h3'==tagName){
        this.data[this.data.length-1].children.push({
          id: header.id,
          title: header.innerHTML
        });
      }
    }
    return this.data;
  }

  Index.prototype.build = function(headers, element){
    if (!this.hasInit) {
      return this;
    }
    if (!headers||!headers.length) {
      element.innerHTML = '';
      return this;
    }
    var html = '<div class="article-index"><div class="article-index-head">'+this.options.title+'</div><ul class="article-index-list" id="article-index-list">';
    for (var i = 0; i < headers.length; i++) {
      var data = headers[i];
      html += '<li class="article-index-item"><a id="article-index-'+data.id+'" class="article-index-anchor" href="#'+data.id+'">'+data.title+'</a>';
      if (data.children && data.children.length) {
        html += '<ul>';
        for (var j = 0; j < data.children.length; j++) {
          html += '<li><a id="article-index-'+data.children[j].id+'" class="article-index-anchor" href="#'+data.children[j].id+'">'+data.children[j].title+'</a></li>';
        }
        html += '</ul>';
      }
      html += '</li>';
    }

    html += '</ul></div>';
    element.innerHTML = html;
    element.className = (element.className ? element.className + ' ' : '') + 'article-index-wrapper';
    var that = this;
    addEventHandler(document.getElementById('article-index-list'), 'click', function(event){
      event.preventDefault();
      var target = event.target || event.srcElement;
      if (target && target.className == 'article-index-anchor') {
        that.index(target);
      }
    });
    this.slideblock = document.createElement('DIV');
    this.slideblock.className = 'article-index-slide';
    this.slideblock.style.display = 'none';
    element.appendChild(this.slideblock);
    this.scroll();
  }

  Index.prototype.index = function(target){
    if (!this.hasInit) {
      return this;
    }
    var id = target.getAttribute('href');
    this.scrollTo(id.replace(/^#/, ''));
  }

  Index.prototype.active = function(id){
     if (!this.hasInit) {
      return this;
    }
    var element = element || document.getElementById('article-index-'+id);
    if (this.current) {
      removeClass(this.current, 'active');
    }
    this.current = element;
    addClass(element, 'active');
    if (this.slideblock) {
      this.slideblock.style.top = (element.offsetTop - childrenElements('.article-index', this.element)[0].offsetTop) + 'px';
      this.slideblock.style.display = 'block';
    }
  }

  Index.prototype.scrollTo = function(id){
     if (!this.hasInit) {
      return this;
    }
    var header = document.getElementById(id);
    if (!header) {
      return;
    }
    this.active(id);
    var scrollTop = header.offsetTop - this.options.fixed;
    window.scrollTo(0, scrollTop);
  }

  Index.prototype.scroll = function(event){
     if (!this.hasInit) {
      return this;
    }
    var scroll = getScrollOffset().y;
    var offsetTop = this.options.offsetTop - this.options.fixed;
    var mlh = getHeight(window) - this.options.fixed - getHeight(footer) - 15; //20180529 最大高度
    if (scroll < offsetTop ) {
      this.element.style.top = '';
      this.element.style.width = '';
      this.element.style.maxHeight = '';
      removeClass(this.element, 'article-index-fixed');
    }else{
      this.element.style.top = this.options.fixed + 'px';
      this.element.style.width = this.options.width+'px';
      
      /*20180529 目录超出*/
      if ( getScrollTop() + getClientHeight()>=getScrollHeight() ){
        this.element.style.maxHeight = mlh + 'px';
      }else{
        
      this.element.style.maxHeight = (getHeight(window) - this.options.fixed - 100) + 'px';
        
      }
      
      addClass(this.element, 'article-index-fixed');
    }

    for (var i = this.headerIds.length - 1; i >= 0; i--) {
       var header = document.getElementById(this.headerIds[i]);
       var top = header.offsetTop - this.options.fixed;
       if (window.scrollY > top -1 ) {
          this.active(this.headerIds[i]);
          break;
       }
    }
  }

  win.articleIndex = new Index();

})(window, document);

/**
 * 页面实现
 * @author NatLiu
 * @date   2018-01-09T16:59:08+0800
 * @return {[type]}                 [description]
 */
function login(dialogId, isBind) {
   var user = trim(document.getElementById('login-name').value),
       pswd = trim(document.getElementById('login-password').value);

   if (!user || !user.length) {
      return returnFalse('请填写用户名');
   }
   if (user.length < 2 || user.length > 32) {
     return returnFalse('无效用户名');
   }
   if (!pswd || !pswd.length) {
     return returnFalse('请填写密码');
   }
   if (pswd.length < 6 || pswd.length > 18) {
      return returnFalse('无效密码');
   }

   ajax('/api/user/login', {
      type:'post',
      dataType:"json",
      data: {
        name: user,
        password: pswd,
        bindOAuth: isBind ? 1 : 0,
        _: window.__onece
      },
      success:function(res){
          if (res && res.error) {
            returnFalse(res.msg);
          }else{
            ArmDialog.close(dialogId);
            ArmMessage.success(res.msg ? res.msg : '登录成功');
            reloadPage();
          }
      },
      error:function(){
        ArmMessage.error('请检查网络后重试');
      }
   });
}

function register(dialogId, isBind) {
   var user = trim(document.getElementById('register-name').value),
       pswd = trim(document.getElementById('register-password').value),
       confirm = trim(document.getElementById('register-confirm').value);

   if (!user || !user.length) {
      return returnFalse('请填写用户名');
   }
   if (user.length < 2 || user.length > 32) {
     return returnFalse('无效用户名');
   }
   if (!pswd || !pswd.length) {
     return returnFalse('请填写密码');
   }
   if (pswd.length < 6 || pswd.length > 18) {
      return returnFalse('无效密码');
   }

   if (confirm!==pswd) {
    return returnFalse('2次密码不相同');
   }

   ajax('/api/user/register', {
      type:'post',
      dataType:"json",
      data: {
        name: user,
        password: pswd,
        confirm: confirm,
        bindOAuth: isBind ? 1 : 0,
        _: window.__onece
      },
      success:function(res){
          if (res && res.error) {
            returnFalse(res.msg);
          }else{
            ArmDialog.close(dialogId);
            ArmMessage.success(res.msg ? res.msg : '欢迎您，注册成功');
            reloadPage();
          }
      },
      error:function(){
        ArmMessage.error('请检查网络后重试');
      }
   });
}

function logout() {
  ajax('/api/user/logout', {
      type:'get',
      dataType:"json",
      data: {
        _: window.__onece
      },
      success:function(res){
          if (res && res.error) {
            returnFalse(res.msg);
          }else{
            ArmMessage.success('退出成功');
            reloadPage();
          }
      },
      error:function(){
        ArmMessage.error('请检查网络后重试');
      }
   });
}

function oauthLogout(){
  ajax('/api/user/oauthLogout', {
      type:'get',
      dataType:"json",
      data: {
        _: window.__onece
      },
      success:function(res){
          if (res && res.error) {
            returnFalse(res.msg);
          }else{
            ArmMessage.success('退出成功');
            reloadPage();
          }
      },
      error:function(){
        ArmMessage.error('请检查网络后重试');
      }
   });
}

function doDialog(id) {
  var bindOAuth = /_bind/i.test(id);
   if (/^login/i.test(id)) {

       ArmDialog.open({
          id:'login-dialog',
          content: '<div class="login-logo">\
                      <div class="login-title">码圃<span class="login-logo-img"></span>通行证</div>\
                    </div>\
                    <div class="login-panel">\
                      <h3 class="panel-title">'+(bindOAuth ? '绑定已有账号':'用户登录')+'</h3>\
                      <div class="login-form">\
                        <div class="form-item"><div class="tip">用户名</div><input type="text" name="name" id="login-name" placeholder="用户名" /></div>\
                        <div class="form-item"><div class="tip">密码</div><input type="password" name="password" id="login-password" placeholder="密码" /></div>\
                        <div class="form-item"><button class="action-btn login-btn" id="login-submit">'+(bindOAuth ? '绑定':'登录')+'</button><a onclick="doAction(\'dialog.register'+(bindOAuth ? '_bind':'')+'\')" class="fr">'+(bindOAuth ? '新用户绑定':'新用户注册')+'</a></div>\
                        ' + (bindOAuth ? '' :'<p>第三方帐号登录</p>\
                        <div class="login-third-platform">\
                        <a href="javascript:;" title="QQ号登录" class="action-btn login-third login-qq" data-action="oauth.qq"></a>\
                        <a href="javascript:;" class="action-btn login-third login-weibo" title="新浪微博登录" data-action="oauth.weibo"></a>\
                        <a href="javascript:;" class="action-btn login-third login-osc" title="开源中国" data-action="oauth.osc"></a>\
                        <a href="javascript:;" class="action-btn login-third login-github" title="Github" data-action="oauth.github"></a>\
                        <a href="javascript:;" class="action-btn login-third login-alipay" title="支付宝登录" data-action="oauth.alipay"></a>\
                        </div>')+
                      '</div>\
                    </div>',
          className:'login-dialog',
          oncreate:function(){
            var dialogId = this.id;
             addEventHandler(document.getElementById('login-submit'), 'click', function(){
                login(dialogId, bindOAuth);
             });
          }
       });
   }

   if (/^register/i.test(id)) {
       ArmDialog.open({
          id:'login-dialog',
          content: '<div class="login-logo">\
                      <div class="login-title">码圃<span class="login-logo-img"></span>通行证</div>\
                    </div>\
                    <div class="login-panel">\
                      <h3 class="panel-title">'+(bindOAuth ? '绑定新用户':'用户注册')+'</h3>\
                      <div class="login-form">\
                        <div class="form-item"><div class="tip">用户名</div><input type="text" name="name" id="register-name" placeholder="用户名" /></div>\
                        <div class="form-item"><div class="tip">设置密码</div><input type="password" name="password" id="register-password" placeholder="设置密码（6到18个字符）" /></div>\
                        <div class="form-item"><div class="tip">重复密码</div><input type="password" name="confirm" id="register-confirm" placeholder="重复密码（6到18个字符）" /></div>\
                        <div class="form-item"><button class="action-btn login-btn" id="register-submit">注册</button><a onclick="doAction(\'dialog.login'+(bindOAuth ? '_bind':'')+'\')" class="fr">'+(bindOAuth ? '绑定已有账号':'已有账号登录')+'</a>\
                        </div>\
                      </div>\
                    </div>',

          className:'login-dialog',
          oncreate:function(){
            var dialogId = this.id;
             addEventHandler(document.getElementById('register-submit'), 'click', function(){
                register(dialogId, bindOAuth);
             });
          }
       });
   }
}

/**
 * 用户操作
 * @author NatLiu
 * @date   2018-01-09T17:06:42+0800
 * @param  {[type]}                 action [description]
 * @return {[type]}                        [description]
 */
var __ACTIONS = {
  comment: '评论'
};
function doAction(action) {
  if (!action) {
    return;
  }
  var actions = action.split('@'),
      mod = actions[0].split('.'),
      module = mod[0],
      action = mod[1],
      params = (actions[1] ? actions[1] : '').split(':'),
      target = params[0],
      slug = params[1];

  var _this = {
    target: target,
    slug: slug,
    srcElement: this,
    module: module,
    action: action,
    text: slug ? __ACTIONS[slug] : '操作', 
    _action: action
  };

  if (module==="dialog") {
     doDialog(action);
  }

  if (module=="logout") {
     logout();
  }
  if (module=="form") {
    action == "submit" && target && ajaxForm.call(_this, target, window.location.href);
  }

  if (module==="oauth") {
    oauth(action);
  }
}

function oauth($platform) {
  if ($platform==="logout") {
      oauthLogout();
     return;
  }
  if (!/qq|weixin|weibo|wxqrcode|alipay|github|osc/i.test($platform)) {
    ArmMessage.error('不支持此平台登录');
  }
  $url = "/api/oauth/"+$platform+"?do=connect";
  var sizes = {
    weibo:[600, 340],
    alipay:[480, 394],
    osc:[600, 340]
  };
  if ($platform==="github") {
     try {
        var win = window.open($url, 'github_oauth', "width=360,height=480,left="+(Math.ceil(getWidth(window)/2)-180) );
        win.document.title = '授权登录';
      } catch(e) {
        window.location.href = $url;
      }
      return;
  }
  var size = sizes[$platform];
  ArmDialog.open({
    id:'login-dialog',
    width: size ? size[0] : 480,
    height:size ? size[1] : 320,
    type:'iframe',
    content:$url
  });
}

function oauthSuccess(msg){
    ArmDialog.close('login-dialog');
    ArmMessage.success(msg?msg:'登录成功');
    reloadPage();
}

function oauthError(msg){
    ArmDialog.close('login-dialog');
    ArmMessage.error(msg?msg:'请检查网络后重试');
}

function toggleNav() {
  var nav = document.getElementById('nav');
  var className = nav.className;
  if (/nav-show/i.test(className)) {
    className = className.replace('nav-show', '');
  }else{
    className += ' nav-show';
  }
  nav.className = className;
}

/**
 * 页面初始化
 * @author NatLiu
 * @date   2018-01-09T15:36:34+0800
 * @return {[type]}                 [description]
 */
function pageInit(){
  // 代码美化
  if (window.hljs) {
    var codes = document.getElementsByTagName('code');
    for (var i = 0; i < codes.length; i++) {
      if(codes[i].parentNode && codes[i].parentNode.tagName.toLowerCase() == "pre"){
        if (window.isIE && isIE < 8) {
          codes[i].textContent = codes[i].innerText;
        }
        hljs.highlightBlock(codes[i]);
      }
    }
  }

  articleIndex.init('#article-index', {
    target: '.article-content',
    fixed: 72
  });

  // 事件监听
  addEventHandler(document.getElementById('search-btn'), 'click', search);
  addEventHandler(document.getElementById('user-tools'), 'mouseenter', usrOpen);
  addEventHandler(document.getElementById('user-tools'), 'touchstart', usrOpen);
  addEventHandler(document.getElementById('user-tools'), 'mouseleave', userClose);
  addEventHandler(document.getElementById('search'), 'submit', function(e){
    e.preventDefault();
    return false;
  });

  addEventHandler(document.getElementById('menu-switch'), 'click', toggleNav);
}

/**
 * 回车执行函数
 * @return {[type]} [description]
 */
function enterKey() {

  switch (true) {
    case document.activeElement.id == 's':
      search();
      break;
    case document.activeElement.id == 'search-box':
      searchBox();
    default:
      // statements_def
      break;
  }
}

// 全局事件绑定
function bindEvent(){
    addEventHandler(document.body, 'click', function(event){
      var target = event.target || event.srcElement;
        // 事件派发
         if (target && target !==document) {
           target.getAttribute('data-action') && doAction.call(target, target.getAttribute('data-action'));
         }
    });

    addEventHandler(document, 'keyup', function(event){
      switch (event.keyCode) {
        case 13:
          enterKey.call(this, event);
          break;
      }
    });
}
bindEvent();

//进度条
!function(n,e){"function"==typeof define&&define.amd?define(e):"object"==typeof exports?module.exports=e():n.NProgress=e()}(this,function(){function n(n,e,t){return e>n?e:n>t?t:n}function e(n){return 100*(-1+n)}function t(n,t,r){var i;return i="translate3d"===c.positionUsing?{transform:"translate3d("+e(n)+"%,0,0)"}:"translate"===c.positionUsing?{transform:"translate("+e(n)+"%,0)"}:{"margin-left":e(n)+"%"},i.transition="all "+t+"ms "+r,i}function r(n,e){var t="string"==typeof n?n:o(n);return t.indexOf(" "+e+" ")>=0}function i(n,e){var t=o(n),i=t+e;r(t,e)||(n.className=i.substring(1))}function s(n,e){var t,i=o(n);r(n,e)&&(t=i.replace(" "+e+" "," "),n.className=t.substring(1,t.length-1))}function o(n){return(" "+(n.className||"")+" ").replace(/\s+/gi," ")}function a(n){n&&n.parentNode&&n.parentNode.removeChild(n)}var u={};u.version="0.2.0";var c=u.settings={minimum:.08,easing:"ease",positionUsing:"",speed:200,trickle:!0,trickleRate:.02,trickleSpeed:800,showSpinner:!0,barSelector:'[role="bar"]',spinnerSelector:'[role="spinner"]',parent:"body",template:'<div class="bar" role="bar"><div class="peg"></div></div><div class="spinner" role="spinner"><div class="spinner-icon"></div></div>'};u.configure=function(n){var e,t;for(e in n)t=n[e],void 0!==t&&n.hasOwnProperty(e)&&(c[e]=t);return this},u.status=null,u.set=function(e){var r=u.isStarted();e=n(e,c.minimum,1),u.status=1===e?null:e;var i=u.render(!r),s=i.querySelector(c.barSelector),o=c.speed,a=c.easing;return i.offsetWidth,l(function(n){""===c.positionUsing&&(c.positionUsing=u.getPositioningCSS()),f(s,t(e,o,a)),1===e?(f(i,{transition:"none",opacity:1}),i.offsetWidth,setTimeout(function(){f(i,{transition:"all "+o+"ms linear",opacity:0}),setTimeout(function(){u.remove(),n()},o)},o)):setTimeout(n,o)}),this},u.isStarted=function(){return"number"==typeof u.status},u.start=function(){u.status||u.set(0);var n=function(){setTimeout(function(){u.status&&(u.trickle(),n())},c.trickleSpeed)};return c.trickle&&n(),this},u.done=function(n){return n||u.status?u.inc(.3+.5*Math.random()).set(1):this},u.inc=function(e){var t=u.status;return t?("number"!=typeof e&&(e=(1-t)*n(Math.random()*t,.1,.95)),t=n(t+e,0,.994),u.set(t)):u.start()},u.trickle=function(){return u.inc(Math.random()*c.trickleRate)},function(){var n=0,e=0;u.promise=function(t){return t&&"resolved"!==t.state()?(0===e&&u.start(),n++,e++,t.always(function(){e--,0===e?(n=0,u.done()):u.set((n-e)/n)}),this):this}}(),u.render=function(n){if(u.isRendered())return document.getElementById("nprogress");i(document.documentElement,"nprogress-busy");var t=document.createElement("div");t.id="nprogress",t.innerHTML=c.template;var r,s=t.querySelector(c.barSelector),o=n?"-100":e(u.status||0),l=document.querySelector(c.parent);return f(s,{transition:"all 0 linear",transform:"translate3d("+o+"%,0,0)"}),c.showSpinner||(r=t.querySelector(c.spinnerSelector),r&&a(r)),l!=document.body&&i(l,"nprogress-custom-parent"),l.appendChild(t),t},u.remove=function(){s(document.documentElement,"nprogress-busy"),s(document.querySelector(c.parent),"nprogress-custom-parent");var n=document.getElementById("nprogress");n&&a(n)},u.isRendered=function(){return!!document.getElementById("nprogress")},u.getPositioningCSS=function(){var n=document.body.style,e="WebkitTransform"in n?"Webkit":"MozTransform"in n?"Moz":"msTransform"in n?"ms":"OTransform"in n?"O":"";return e+"Perspective"in n?"translate3d":e+"Transform"in n?"translate":"margin"};var l=function(){function n(){var t=e.shift();t&&t(n)}var e=[];return function(t){e.push(t),1==e.length&&n()}}(),f=function(){function n(n){return n.replace(/^-ms-/,"ms-").replace(/-([\da-z])/gi,function(n,e){return e.toUpperCase()})}function e(n){var e=document.body.style;if(n in e)return n;for(var t,r=i.length,s=n.charAt(0).toUpperCase()+n.slice(1);r--;)if(t=i[r]+s,t in e)return t;return n}function t(t){return t=n(t),s[t]||(s[t]=e(t))}function r(n,e,r){e=t(e),n.style[e]=r}var i=["Webkit","O","Moz","ms"],s={};return function(n,e){var t,i,s=arguments;if(2==s.length)for(t in e)i=e[t],void 0!==i&&e.hasOwnProperty(t)&&r(n,t,i);else r(n,s[1],s[2])}}();return u});

//语法高亮
/*! highlight.js v9.1.0 | BSD3 License | git.io/hljslicense */
!function(e){"undefined"!=typeof exports?e(exports):(self.hljs=e({}),"function"==typeof define&&define.amd&&define("hljs",[],function(){return self.hljs}))}(function(e){function t(e){return e.replace(/&/gm,"&amp;").replace(/</gm,"&lt;").replace(/>/gm,"&gt;")}function r(e){return e.nodeName.toLowerCase()}function a(e,t){var r=e&&e.exec(t);return r&&0==r.index}function n(e){return/^(no-?highlight|plain|text)$/i.test(e)}function i(e){var t,r,a,i=e.className+" ";if(i+=e.parentNode?e.parentNode.className:"",r=/\blang(?:uage)?-([\w-]+)\b/i.exec(i))return y(r[1])?r[1]:"no-highlight";for(i=i.split(/\s+/),t=0,a=i.length;a>t;t++)if(y(i[t])||n(i[t]))return i[t]}function s(e,t){var r,a={};for(r in e)a[r]=e[r];if(t)for(r in t)a[r]=t[r];return a}function c(e){var t=[];return function a(e,n){for(var i=e.firstChild;i;i=i.nextSibling)3==i.nodeType?n+=i.nodeValue.length:1==i.nodeType&&(t.push({event:"start",offset:n,node:i}),n=a(i,n),r(i).match(/br|hr|img|input/)||t.push({event:"stop",offset:n,node:i}));return n}(e,0),t}function o(e,a,n){function i(){return e.length&&a.length?e[0].offset!=a[0].offset?e[0].offset<a[0].offset?e:a:"start"==a[0].event?e:a:e.length?e:a}function s(e){function a(e){return" "+e.nodeName+'="'+t(e.value)+'"'}u+="<"+r(e)+Array.prototype.map.call(e.attributes,a).join("")+">"}function c(e){u+="</"+r(e)+">"}function o(e){("start"==e.event?s:c)(e.node)}for(var l=0,u="",d=[];e.length||a.length;){var b=i();if(u+=t(n.substr(l,b[0].offset-l)),l=b[0].offset,b==e){d.reverse().forEach(c);do o(b.splice(0,1)[0]),b=i();while(b==e&&b.length&&b[0].offset==l);d.reverse().forEach(s)}else"start"==b[0].event?d.push(b[0].node):d.pop(),o(b.splice(0,1)[0])}return u+t(n.substr(l))}function l(e){function t(e){return e&&e.source||e}function r(r,a){return new RegExp(t(r),"m"+(e.cI?"i":"")+(a?"g":""))}function a(n,i){if(!n.compiled){if(n.compiled=!0,n.k=n.k||n.bK,n.k){var c={},o=function(t,r){e.cI&&(r=r.toLowerCase()),r.split(" ").forEach(function(e){var r=e.split("|");c[r[0]]=[t,r[1]?Number(r[1]):1]})};"string"==typeof n.k?o("keyword",n.k):Object.keys(n.k).forEach(function(e){o(e,n.k[e])}),n.k=c}n.lR=r(n.l||/\b\w+\b/,!0),i&&(n.bK&&(n.b="\\b("+n.bK.split(" ").join("|")+")\\b"),n.b||(n.b=/\B|\b/),n.bR=r(n.b),n.e||n.eW||(n.e=/\B|\b/),n.e&&(n.eR=r(n.e)),n.tE=t(n.e)||"",n.eW&&i.tE&&(n.tE+=(n.e?"|":"")+i.tE)),n.i&&(n.iR=r(n.i)),void 0===n.r&&(n.r=1),n.c||(n.c=[]);var l=[];n.c.forEach(function(e){e.v?e.v.forEach(function(t){l.push(s(e,t))}):l.push("self"==e?n:e)}),n.c=l,n.c.forEach(function(e){a(e,n)}),n.starts&&a(n.starts,i);var u=n.c.map(function(e){return e.bK?"\\.?("+e.b+")\\.?":e.b}).concat([n.tE,n.i]).map(t).filter(Boolean);n.t=u.length?r(u.join("|"),!0):{exec:function(){return null}}}}a(e)}function u(e,r,n,i){function s(e,t){for(var r=0;r<t.c.length;r++)if(a(t.c[r].bR,e))return t.c[r]}function c(e,t){if(a(e.eR,t)){for(;e.endsParent&&e.parent;)e=e.parent;return e}return e.eW?c(e.parent,t):void 0}function o(e,t){return!n&&a(t.iR,e)}function b(e,t){var r=v.cI?t[0].toLowerCase():t[0];return e.k.hasOwnProperty(r)&&e.k[r]}function p(e,t,r,a){var n=a?"":w.classPrefix,i='<span class="'+n,s=r?"":"</span>";return i+=e+'">',i+t+s}function m(){if(!x.k)return t(E);var e="",r=0;x.lR.lastIndex=0;for(var a=x.lR.exec(E);a;){e+=t(E.substr(r,a.index-r));var n=b(x,a);n?(B+=n[1],e+=p(n[0],t(a[0]))):e+=t(a[0]),r=x.lR.lastIndex,a=x.lR.exec(E)}return e+t(E.substr(r))}function f(){var e="string"==typeof x.sL;if(e&&!N[x.sL])return t(E);var r=e?u(x.sL,E,!0,C[x.sL]):d(E,x.sL.length?x.sL:void 0);return x.r>0&&(B+=r.r),e&&(C[x.sL]=r.top),p(r.language,r.value,!1,!0)}function g(){return void 0!==x.sL?f():m()}function h(e,r){var a=e.cN?p(e.cN,"",!0):"";e.rB?(M+=a,E=""):e.eB?(M+=t(r)+a,E=""):(M+=a,E=r),x=Object.create(e,{parent:{value:x}})}function _(e,r){if(E+=e,void 0===r)return M+=g(),0;var a=s(r,x);if(a)return M+=g(),h(a,r),a.rB?0:r.length;var n=c(x,r);if(n){var i=x;i.rE||i.eE||(E+=r),M+=g();do x.cN&&(M+="</span>"),B+=x.r,x=x.parent;while(x!=n.parent);return i.eE&&(M+=t(r)),E="",n.starts&&h(n.starts,""),i.rE?0:r.length}if(o(r,x))throw new Error('Illegal lexeme "'+r+'" for mode "'+(x.cN||"<unnamed>")+'"');return E+=r,r.length||1}var v=y(e);if(!v)throw new Error('Unknown language: "'+e+'"');l(v);var k,x=i||v,C={},M="";for(k=x;k!=v;k=k.parent)k.cN&&(M=p(k.cN,"",!0)+M);var E="",B=0;try{for(var $,z,L=0;;){if(x.t.lastIndex=L,$=x.t.exec(r),!$)break;z=_(r.substr(L,$.index-L),$[0]),L=$.index+z}for(_(r.substr(L)),k=x;k.parent;k=k.parent)k.cN&&(M+="</span>");return{r:B,value:M,language:e,top:x}}catch(R){if(-1!=R.message.indexOf("Illegal"))return{r:0,value:t(r)};throw R}}function d(e,r){r=r||w.languages||Object.keys(N);var a={r:0,value:t(e)},n=a;return r.forEach(function(t){if(y(t)){var r=u(t,e,!1);r.language=t,r.r>n.r&&(n=r),r.r>a.r&&(n=a,a=r)}}),n.language&&(a.second_best=n),a}function b(e){return w.tabReplace&&(e=e.replace(/^((<[^>]+>|\t)+)/gm,function(e,t){return t.replace(/\t/g,w.tabReplace)})),w.useBR&&(e=e.replace(/\n/g,"<br>")),e}function p(e,t,r){var a=t?k[t]:r,n=[e.trim()];return e.match(/\bhljs\b/)||n.push("hljs"),-1===e.indexOf(a)&&n.push(a),n.join(" ").trim()}function m(e){var t=i(e);if(!n(t)){var r;w.useBR?(r=document.createElementNS("http://www.w3.org/1999/xhtml","div"),r.innerHTML=e.innerHTML.replace(/\n/g,"").replace(/<br[ \/]*>/g,"\n")):r=e;var a=r.textContent,s=t?u(t,a,!0):d(a),l=c(r);if(l.length){var m=document.createElementNS("http://www.w3.org/1999/xhtml","div");m.innerHTML=s.value,s.value=o(l,c(m),a)}s.value=b(s.value),e.innerHTML=s.value,e.className=p(e.className,t,s.language),e.result={language:s.language,re:s.r},s.second_best&&(e.second_best={language:s.second_best.language,re:s.second_best.r})}}function f(e){w=s(w,e)}function g(){if(!g.called){g.called=!0;var e=document.querySelectorAll("pre code");Array.prototype.forEach.call(e,m)}}function h(){addEventListener("DOMContentLoaded",g,!1),addEventListener("load",g,!1)}function _(t,r){var a=N[t]=r(e);a.aliases&&a.aliases.forEach(function(e){k[e]=t})}function v(){return Object.keys(N)}function y(e){return e=(e||"").toLowerCase(),N[e]||N[k[e]]}var w={classPrefix:"hljs-",tabReplace:null,useBR:!1,languages:void 0},N={},k={};return e.highlight=u,e.highlightAuto=d,e.fixMarkup=b,e.highlightBlock=m,e.configure=f,e.initHighlighting=g,e.initHighlightingOnLoad=h,e.registerLanguage=_,e.listLanguages=v,e.getLanguage=y,e.inherit=s,e.IR="[a-zA-Z]\\w*",e.UIR="[a-zA-Z_]\\w*",e.NR="\\b\\d+(\\.\\d+)?",e.CNR="(-?)(\\b0[xX][a-fA-F0-9]+|(\\b\\d+(\\.\\d*)?|\\.\\d+)([eE][-+]?\\d+)?)",e.BNR="\\b(0b[01]+)",e.RSR="!|!=|!==|%|%=|&|&&|&=|\\*|\\*=|\\+|\\+=|,|-|-=|/=|/|:|;|<<|<<=|<=|<|===|==|=|>>>=|>>=|>=|>>>|>>|>|\\?|\\[|\\{|\\(|\\^|\\^=|\\||\\|=|\\|\\||~",e.BE={b:"\\\\[\\s\\S]",r:0},e.ASM={cN:"string",b:"'",e:"'",i:"\\n",c:[e.BE]},e.QSM={cN:"string",b:'"',e:'"',i:"\\n",c:[e.BE]},e.PWM={b:/\b(a|an|the|are|I|I'm|isn't|don't|doesn't|won't|but|just|should|pretty|simply|enough|gonna|going|wtf|so|such|will|you|your|like)\b/},e.C=function(t,r,a){var n=e.inherit({cN:"comment",b:t,e:r,c:[]},a||{});return n.c.push(e.PWM),n.c.push({cN:"doctag",b:"(?:TODO|FIXME|NOTE|BUG|XXX):",r:0}),n},e.CLCM=e.C("//","$"),e.CBCM=e.C("/\\*","\\*/"),e.HCM=e.C("#","$"),e.NM={cN:"number",b:e.NR,r:0},e.CNM={cN:"number",b:e.CNR,r:0},e.BNM={cN:"number",b:e.BNR,r:0},e.CSSNM={cN:"number",b:e.NR+"(%|em|ex|ch|rem|vw|vh|vmin|vmax|cm|mm|in|pt|pc|px|deg|grad|rad|turn|s|ms|Hz|kHz|dpi|dpcm|dppx)?",r:0},e.RM={cN:"regexp",b:/\//,e:/\/[gimuy]*/,i:/\n/,c:[e.BE,{b:/\[/,e:/\]/,r:0,c:[e.BE]}]},e.TM={cN:"title",b:e.IR,r:0},e.UTM={cN:"title",b:e.UIR,r:0},e.registerLanguage("apache",function(e){var t={cN:"number",b:"[\\$%]\\d+"};return{aliases:["apacheconf"],cI:!0,c:[e.HCM,{cN:"section",b:"</?",e:">"},{cN:"attribute",b:/\w+/,r:0,k:{nomarkup:"order deny allow setenv rewriterule rewriteengine rewritecond documentroot sethandler errordocument loadmodule options header listen serverroot servername"},starts:{e:/$/,r:0,k:{literal:"on off all"},c:[{cN:"meta",b:"\\s\\[",e:"\\]$"},{cN:"variable",b:"[\\$%]\\{",e:"\\}",c:["self",t]},t,e.QSM]}}],i:/\S/}}),e.registerLanguage("bash",function(e){var t={cN:"variable",v:[{b:/\$[\w\d#@][\w\d_]*/},{b:/\$\{(.*?)}/}]},r={cN:"string",b:/"/,e:/"/,c:[e.BE,t,{cN:"variable",b:/\$\(/,e:/\)/,c:[e.BE]}]},a={cN:"string",b:/'/,e:/'/};return{aliases:["sh","zsh"],l:/-?[a-z\.]+/,k:{keyword:"if then else elif fi for while in do done case esac function",literal:"true false",built_in:"break cd continue eval exec exit export getopts hash pwd readonly return shift test times trap umask unset alias bind builtin caller command declare echo enable help let local logout mapfile printf read readarray source type typeset ulimit unalias set shopt autoload bg bindkey bye cap chdir clone comparguments compcall compctl compdescribe compfiles compgroups compquote comptags comptry compvalues dirs disable disown echotc echoti emulate fc fg float functions getcap getln history integer jobs kill limit log noglob popd print pushd pushln rehash sched setcap setopt stat suspend ttyctl unfunction unhash unlimit unsetopt vared wait whence where which zcompile zformat zftp zle zmodload zparseopts zprof zpty zregexparse zsocket zstyle ztcp",_:"-ne -eq -lt -gt -f -d -e -s -l -a"},c:[{cN:"meta",b:/^#![^\n]+sh\s*$/,r:10},{cN:"function",b:/\w[\w\d_]*\s*\(\s*\)\s*\{/,rB:!0,c:[e.inherit(e.TM,{b:/\w[\w\d_]*/})],r:0},e.HCM,r,a,t]}}),e.registerLanguage("coffeescript",function(e){var t={keyword:"in if for while finally new do return else break catch instanceof throw try this switch continue typeof delete debugger super then unless until loop of by when and or is isnt not",literal:"true false null undefined yes no on off",built_in:"npm require console print module global window document"},r="[A-Za-z$_][0-9A-Za-z$_]*",a={cN:"subst",b:/#\{/,e:/}/,k:t},n=[e.BNM,e.inherit(e.CNM,{starts:{e:"(\\s*/)?",r:0}}),{cN:"string",v:[{b:/'''/,e:/'''/,c:[e.BE]},{b:/'/,e:/'/,c:[e.BE]},{b:/"""/,e:/"""/,c:[e.BE,a]},{b:/"/,e:/"/,c:[e.BE,a]}]},{cN:"regexp",v:[{b:"///",e:"///",c:[a,e.HCM]},{b:"//[gim]*",r:0},{b:/\/(?![ *])(\\\/|.)*?\/[gim]*(?=\W|$)/}]},{b:"@"+r},{b:"`",e:"`",eB:!0,eE:!0,sL:"javascript"}];a.c=n;var i=e.inherit(e.TM,{b:r}),s="(\\(.*\\))?\\s*\\B[-=]>",c={cN:"params",b:"\\([^\\(]",rB:!0,c:[{b:/\(/,e:/\)/,k:t,c:["self"].concat(n)}]};return{aliases:["coffee","cson","iced"],k:t,i:/\/\*/,c:n.concat([e.C("###","###"),e.HCM,{cN:"function",b:"^\\s*"+r+"\\s*=\\s*"+s,e:"[-=]>",rB:!0,c:[i,c]},{b:/[:\(,=]\s*/,r:0,c:[{cN:"function",b:s,e:"[-=]>",rB:!0,c:[c]}]},{cN:"class",bK:"class",e:"$",i:/[:="\[\]]/,c:[{bK:"extends",eW:!0,i:/[:="\[\]]/,c:[i]},i]},{b:r+":",e:":",rB:!0,rE:!0,r:0}])}}),e.registerLanguage("cpp",function(e){var t={cN:"keyword",b:"\\b[a-z\\d_]*_t\\b"},r={cN:"string",v:[e.inherit(e.QSM,{b:'((u8?|U)|L)?"'}),{b:'(u8?|U)?R"',e:'"',c:[e.BE]},{b:"'\\\\?.",e:"'",i:"."}]},a={cN:"number",v:[{b:"\\b(\\d+(\\.\\d*)?|\\.\\d+)(u|U|l|L|ul|UL|f|F)"},{b:e.CNR}],r:0},n={cN:"meta",b:"#",e:"$",k:{"meta-keyword":"if else elif endif define undef warning error line pragma ifdef ifndef"},c:[{b:/\\\n/,r:0},{bK:"include",e:"$",k:{"meta-keyword":"include"},c:[e.inherit(r,{cN:"meta-string"}),{cN:"meta-string",b:"<",e:">",i:"\\n"}]},r,e.CLCM,e.CBCM]},i=e.IR+"\\s*\\(",s={keyword:"int float while private char catch export virtual operator sizeof dynamic_cast|10 typedef const_cast|10 const struct for static_cast|10 union namespace unsigned long volatile static protected bool template mutable if public friend do goto auto void enum else break extern using class asm case typeid short reinterpret_cast|10 default double register explicit signed typename try this switch continue inline delete alignof constexpr decltype noexcept static_assert thread_local restrict _Bool complex _Complex _Imaginary atomic_bool atomic_char atomic_schar atomic_uchar atomic_short atomic_ushort atomic_int atomic_uint atomic_long atomic_ulong atomic_llong atomic_ullong",built_in:"std string cin cout cerr clog stdin stdout stderr stringstream istringstream ostringstream auto_ptr deque list queue stack vector map set bitset multiset multimap unordered_set unordered_map unordered_multiset unordered_multimap array shared_ptr abort abs acos asin atan2 atan calloc ceil cosh cos exit exp fabs floor fmod fprintf fputs free frexp fscanf isalnum isalpha iscntrl isdigit isgraph islower isprint ispunct isspace isupper isxdigit tolower toupper labs ldexp log10 log malloc realloc memchr memcmp memcpy memset modf pow printf putchar puts scanf sinh sin snprintf sprintf sqrt sscanf strcat strchr strcmp strcpy strcspn strlen strncat strncmp strncpy strpbrk strrchr strspn strstr tanh tan vfprintf vprintf vsprintf endl initializer_list unique_ptr",literal:"true false nullptr NULL"};return{aliases:["c","cc","h","c++","h++","hpp"],k:s,i:"</",c:[t,e.CLCM,e.CBCM,a,r,n,{b:"\\b(deque|list|queue|stack|vector|map|set|bitset|multiset|multimap|unordered_map|unordered_set|unordered_multiset|unordered_multimap|array)\\s*<",e:">",k:s,c:["self",t]},{b:e.IR+"::",k:s},{bK:"new throw return else",r:0},{cN:"function",b:"("+e.IR+"[\\*&\\s]+)+"+i,rB:!0,e:/[{;=]/,eE:!0,k:s,i:/[^\w\s\*&]/,c:[{b:i,rB:!0,c:[e.TM],r:0},{cN:"params",b:/\(/,e:/\)/,k:s,r:0,c:[e.CLCM,e.CBCM,r,a]},e.CLCM,e.CBCM,n]}]}}),e.registerLanguage("cs",function(e){var t="abstract as base bool break byte case catch char checked const continue decimal dynamic default delegate do double else enum event explicit extern false finally fixed float for foreach goto if implicit in int interface internal is lock long null when object operator out override params private protected public readonly ref sbyte sealed short sizeof stackalloc static string struct switch this true try typeof uint ulong unchecked unsafe ushort using virtual volatile void while async protected public private internal ascending descending from get group into join let orderby partial select set value var where yield",r=e.IR+"(<"+e.IR+">)?";return{aliases:["csharp"],k:t,i:/::/,c:[e.C("///","$",{rB:!0,c:[{cN:"doctag",v:[{b:"///",r:0},{b:"<!--|-->"},{b:"</?",e:">"}]}]}),e.CLCM,e.CBCM,{cN:"meta",b:"#",e:"$",k:{"meta-keyword":"if else elif endif define undef warning error line region endregion pragma checksum"}},{cN:"string",b:'@"',e:'"',c:[{b:'""'}]},e.ASM,e.QSM,e.CNM,{bK:"class interface",e:/[{;=]/,i:/[^\s:]/,c:[e.TM,e.CLCM,e.CBCM]},{bK:"namespace",e:/[{;=]/,i:/[^\s:]/,c:[e.inherit(e.TM,{b:"[a-zA-Z](\\.?\\w)*"}),e.CLCM,e.CBCM]},{bK:"new return throw await",r:0},{cN:"function",b:"("+r+"\\s+)+"+e.IR+"\\s*\\(",rB:!0,e:/[{;=]/,eE:!0,k:t,c:[{b:e.IR+"\\s*\\(",rB:!0,c:[e.TM],r:0},{cN:"params",b:/\(/,e:/\)/,eB:!0,eE:!0,k:t,r:0,c:[e.ASM,e.QSM,e.CNM,e.CBCM]},e.CLCM,e.CBCM]}]}}),e.registerLanguage("css",function(e){var t="[a-zA-Z-][a-zA-Z0-9_-]*",r={b:/[A-Z\_\.\-]+\s*:/,rB:!0,e:";",eW:!0,c:[{cN:"attribute",b:/\S/,e:":",eE:!0,starts:{eW:!0,eE:!0,c:[{b:/[\w-]+\s*\(/,rB:!0,c:[{cN:"built_in",b:/[\w-]+/}]},e.CSSNM,e.QSM,e.ASM,e.CBCM,{cN:"number",b:"#[0-9A-Fa-f]+"},{cN:"meta",b:"!important"}]}}]};return{cI:!0,i:/[=\/|'\$]/,c:[e.CBCM,{cN:"selector-id",b:/#[A-Za-z0-9_-]+/},{cN:"selector-class",b:/\.[A-Za-z0-9_-]+/},{cN:"selector-attr",b:/\[/,e:/\]/,i:"$"},{cN:"selector-pseudo",b:/:(:)?[a-zA-Z0-9\_\-\+\(\)"'.]+/},{b:"@(font-face|page)",l:"[a-z-]+",k:"font-face page"},{b:"@",e:"[{;]",c:[{cN:"keyword",b:/\S+/},{b:/\s/,eW:!0,eE:!0,r:0,c:[e.ASM,e.QSM,e.CSSNM]}]},{cN:"selector-tag",b:t,r:0},{b:"{",e:"}",i:/\S/,c:[e.CBCM,r]}]}}),e.registerLanguage("diff",function(e){return{aliases:["patch"],c:[{cN:"meta",r:10,v:[{b:/^@@ +\-\d+,\d+ +\+\d+,\d+ +@@$/},{b:/^\*\*\* +\d+,\d+ +\*\*\*\*$/},{b:/^\-\-\- +\d+,\d+ +\-\-\-\-$/}]},{cN:"comment",v:[{b:/Index: /,e:/$/},{b:/=====/,e:/=====$/},{b:/^\-\-\-/,e:/$/},{b:/^\*{3} /,e:/$/},{b:/^\+\+\+/,e:/$/},{b:/\*{5}/,e:/\*{5}$/}]},{cN:"addition",b:"^\\+",e:"$"},{cN:"deletion",b:"^\\-",e:"$"},{cN:"addition",b:"^\\!",e:"$"}]}}),e.registerLanguage("http",function(e){var t="HTTP/[0-9\\.]+";return{aliases:["https"],i:"\\S",c:[{b:"^"+t,e:"$",c:[{cN:"number",b:"\\b\\d{3}\\b"}]},{b:"^[A-Z]+ (.*?) "+t+"$",rB:!0,e:"$",c:[{cN:"string",b:" ",e:" ",eB:!0,eE:!0},{b:t},{cN:"keyword",b:"[A-Z]+"}]},{cN:"attribute",b:"^\\w",e:": ",eE:!0,i:"\\n|\\s|=",starts:{e:"$",r:0}},{b:"\\n\\n",starts:{sL:[],eW:!0}}]}}),e.registerLanguage("ini",function(e){var t={cN:"string",c:[e.BE],v:[{b:"'''",e:"'''",r:10},{b:'"""',e:'"""',r:10},{b:'"',e:'"'},{b:"'",e:"'"}]};return{aliases:["toml"],cI:!0,i:/\S/,c:[e.C(";","$"),e.HCM,{cN:"section",b:/^\s*\[+/,e:/\]+/},{b:/^[a-z0-9\[\]_-]+\s*=\s*/,e:"$",rB:!0,c:[{cN:"attr",b:/[a-z0-9\[\]_-]+/},{b:/=/,eW:!0,r:0,c:[{cN:"literal",b:/\bon|off|true|false|yes|no\b/},{cN:"variable",v:[{b:/\$[\w\d"][\w\d_]*/},{b:/\$\{(.*?)}/}]},t,{cN:"number",b:/([\+\-]+)?[\d]+_[\d_]+/},e.NM]}]}]}}),e.registerLanguage("java",function(e){var t=e.UIR+"(<"+e.UIR+"(\\s*,\\s*"+e.UIR+")*>)?",r="false synchronized int abstract float private char boolean static null if const for true while long strictfp finally protected import native final void enum else break transient catch instanceof byte super volatile case assert short package default double public try this switch continue throws protected public private",a="\\b(0[bB]([01]+[01_]+[01]+|[01]+)|0[xX]([a-fA-F0-9]+[a-fA-F0-9_]+[a-fA-F0-9]+|[a-fA-F0-9]+)|(([\\d]+[\\d_]+[\\d]+|[\\d]+)(\\.([\\d]+[\\d_]+[\\d]+|[\\d]+))?|\\.([\\d]+[\\d_]+[\\d]+|[\\d]+))([eE][-+]?\\d+)?)[lLfF]?",n={cN:"number",b:a,r:0};return{aliases:["jsp"],k:r,i:/<\/|#/,c:[e.C("/\\*\\*","\\*/",{r:0,c:[{b:/\w+@/,r:0},{cN:"doctag",b:"@[A-Za-z]+"}]}),e.CLCM,e.CBCM,e.ASM,e.QSM,{cN:"class",bK:"class interface",e:/[{;=]/,eE:!0,k:"class interface",i:/[:"\[\]]/,c:[{bK:"extends implements"},e.UTM]},{bK:"new throw return else",r:0},{cN:"function",b:"("+t+"\\s+)+"+e.UIR+"\\s*\\(",rB:!0,e:/[{;=]/,eE:!0,k:r,c:[{b:e.UIR+"\\s*\\(",rB:!0,r:0,c:[e.UTM]},{cN:"params",b:/\(/,e:/\)/,k:r,r:0,c:[e.ASM,e.QSM,e.CNM,e.CBCM]},e.CLCM,e.CBCM]},n,{cN:"meta",b:"@[A-Za-z]+"}]}}),e.registerLanguage("javascript",function(e){return{aliases:["js"],k:{keyword:"in of if for while finally var new function do return void else break catch instanceof with throw case default try this switch continue typeof delete let yield const export super debugger as async await import from as",literal:"true false null undefined NaN Infinity",built_in:"eval isFinite isNaN parseFloat parseInt decodeURI decodeURIComponent encodeURI encodeURIComponent escape unescape Object Function Boolean Error EvalError InternalError RangeError ReferenceError StopIteration SyntaxError TypeError URIError Number Math Date String RegExp Array Float32Array Float64Array Int16Array Int32Array Int8Array Uint16Array Uint32Array Uint8Array Uint8ClampedArray ArrayBuffer DataView JSON Intl arguments require module console window document Symbol Set Map WeakSet WeakMap Proxy Reflect Promise"},c:[{cN:"meta",r:10,b:/^\s*['"]use (strict|asm)['"]/},{cN:"meta",b:/^#!/,e:/$/},e.ASM,e.QSM,{cN:"string",b:"`",e:"`",c:[e.BE,{cN:"subst",b:"\\$\\{",e:"\\}"}]},e.CLCM,e.CBCM,{cN:"number",v:[{b:"\\b(0[bB][01]+)"},{b:"\\b(0[oO][0-7]+)"},{b:e.CNR}],r:0},{b:"("+e.RSR+"|\\b(case|return|throw)\\b)\\s*",k:"return throw case",c:[e.CLCM,e.CBCM,e.RM,{b:/</,e:/>\s*[);\]]/,r:0,sL:"xml"}],r:0},{cN:"function",bK:"function",e:/\{/,eE:!0,c:[e.inherit(e.TM,{b:/[A-Za-z$_][0-9A-Za-z$_]*/}),{cN:"params",b:/\(/,e:/\)/,eB:!0,eE:!0,c:[e.CLCM,e.CBCM]}],i:/\[|%/},{b:/\$[(.]/},{b:"\\."+e.IR,r:0},{cN:"class",bK:"class",e:/[{;=]/,eE:!0,i:/[:"\[\]]/,c:[{bK:"extends"},e.UTM]},{bK:"constructor",e:/\{/,eE:!0}],i:/#(?!!)/}}),e.registerLanguage("json",function(e){var t={literal:"true false null"},r=[e.QSM,e.CNM],a={e:",",eW:!0,eE:!0,c:r,k:t},n={b:"{",e:"}",c:[{cN:"attr",b:'\\s*"',e:'"\\s*:\\s*',eB:!0,eE:!0,c:[e.BE],i:"\\n",starts:a}],i:"\\S"},i={b:"\\[",e:"\\]",c:[e.inherit(a)],i:"\\S"};return r.splice(r.length,0,n,i),{c:r,k:t,i:"\\S"}}),e.registerLanguage("makefile",function(e){var t={cN:"variable",b:/\$\(/,e:/\)/,c:[e.BE]};return{aliases:["mk","mak"],c:[e.HCM,{b:/^\w+\s*\W*=/,rB:!0,r:0,starts:{e:/\s*\W*=/,eE:!0,starts:{e:/$/,r:0,c:[t]}}},{cN:"section",b:/^[\w]+:\s*$/},{cN:"meta",b:/^\.PHONY:/,e:/$/,k:{"meta-keyword":".PHONY"},l:/[\.\w]+/},{b:/^\t+/,e:/$/,r:0,c:[e.QSM,t]}]}}),e.registerLanguage("xml",function(e){var t="[A-Za-z0-9\\._:-]+",r={b:/<\?(php)?(?!\w)/,e:/\?>/,sL:"php"},a={eW:!0,i:/</,r:0,c:[r,{cN:"attr",b:t,r:0},{b:"=",r:0,c:[{cN:"string",c:[r],v:[{b:/"/,e:/"/},{b:/'/,e:/'/},{b:/[^\s\/>]+/}]}]}]};return{aliases:["html","xhtml","rss","atom","xsl","plist"],cI:!0,c:[{cN:"meta",b:"<!DOCTYPE",e:">",r:10,c:[{b:"\\[",e:"\\]"}]},e.C("<!--","-->",{r:10}),{b:"<\\!\\[CDATA\\[",e:"\\]\\]>",r:10},{cN:"tag",b:"<style(?=\\s|>|$)",e:">",k:{name:"style"},c:[a],starts:{e:"</style>",rE:!0,sL:["css","xml"]}},{cN:"tag",b:"<script(?=\\s|>|$)",e:">",k:{name:"script"},c:[a],starts:{e:"</script>",rE:!0,sL:["actionscript","javascript","handlebars","xml"]}},r,{cN:"meta",b:/<\?\w+/,e:/\?>/,r:10},{cN:"tag",b:"</?",e:"/?>",c:[{cN:"name",b:/[^\/><\s]+/,r:0},a]}]}}),e.registerLanguage("markdown",function(e){return{aliases:["md","mkdown","mkd"],c:[{cN:"section",v:[{b:"^#{1,6}",e:"$"},{b:"^.+?\\n[=-]{2,}$"}]},{b:"<",e:">",sL:"xml",r:0},{cN:"bullet",b:"^([*+-]|(\\d+\\.))\\s+"},{cN:"strong",b:"[*_]{2}.+?[*_]{2}"},{cN:"emphasis",v:[{b:"\\*.+?\\*"},{b:"_.+?_",r:0}]},{cN:"quote",b:"^>\\s+",e:"$"},{cN:"code",v:[{b:"`.+?`"},{b:"^( {4}|	)",e:"$",r:0}]},{b:"^[-\\*]{3,}",e:"$"},{b:"\\[.+?\\][\\(\\[].*?[\\)\\]]",rB:!0,c:[{cN:"string",b:"\\[",e:"\\]",eB:!0,rE:!0,r:0},{cN:"link",b:"\\]\\(",e:"\\)",eB:!0,eE:!0},{cN:"symbol",b:"\\]\\[",e:"\\]",eB:!0,eE:!0}],r:10},{b:"^\\[.+\\]:",rB:!0,c:[{cN:"symbol",b:"\\[",e:"\\]:",eB:!0,eE:!0,starts:{cN:"link",e:"$"}}]}]}}),e.registerLanguage("nginx",function(e){var t={cN:"variable",v:[{b:/\$\d+/},{b:/\$\{/,e:/}/},{b:"[\\$\\@]"+e.UIR}]},r={eW:!0,l:"[a-z/_]+",k:{literal:"on off yes no true false none blocked debug info notice warn error crit select break last permanent redirect kqueue rtsig epoll poll /dev/poll"},r:0,i:"=>",c:[e.HCM,{cN:"string",c:[e.BE,t],v:[{b:/"/,e:/"/},{b:/'/,e:/'/}]},{b:"([a-z]+):/",e:"\\s",eW:!0,eE:!0,c:[t]},{cN:"regexp",c:[e.BE,t],v:[{b:"\\s\\^",e:"\\s|{|;",rE:!0},{b:"~\\*?\\s+",e:"\\s|{|;",rE:!0},{b:"\\*(\\.[a-z\\-]+)+"},{b:"([a-z\\-]+\\.)+\\*"}]},{cN:"number",b:"\\b\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}(:\\d{1,5})?\\b"},{cN:"number",b:"\\b\\d+[kKmMgGdshdwy]*\\b",r:0},t]};return{aliases:["nginxconf"],c:[e.HCM,{b:e.UIR+"\\s+{",rB:!0,e:"{",c:[{cN:"section",b:e.UIR}],r:0},{b:e.UIR+"\\s",e:";|{",rB:!0,c:[{cN:"attribute",b:e.UIR,starts:r}],r:0}],i:"[^\\s\\}]"}}),e.registerLanguage("objectivec",function(e){var t={cN:"built_in",b:"(AV|CA|CF|CG|CI|MK|MP|NS|UI|XC)\\w+"},r={keyword:"int float while char export sizeof typedef const struct for union unsigned long volatile static bool mutable if do return goto void enum else break extern asm case short default double register explicit signed typename this switch continue wchar_t inline readonly assign readwrite self @synchronized id typeof nonatomic super unichar IBOutlet IBAction strong weak copy in out inout bycopy byref oneway __strong __weak __block __autoreleasing @private @protected @public @try @property @end @throw @catch @finally @autoreleasepool @synthesize @dynamic @selector @optional @required",literal:"false true FALSE TRUE nil YES NO NULL",built_in:"BOOL dispatch_once_t dispatch_queue_t dispatch_sync dispatch_async dispatch_once"},a=/[a-zA-Z@][a-zA-Z0-9_]*/,n="@interface @class @protocol @implementation";return{aliases:["mm","objc","obj-c"],k:r,l:a,i:"</",c:[t,e.CLCM,e.CBCM,e.CNM,e.QSM,{cN:"string",v:[{b:'@"',e:'"',i:"\\n",c:[e.BE]},{b:"'",e:"[^\\\\]'",i:"[^\\\\][^']"}]},{cN:"meta",b:"#",e:"$",c:[{cN:"meta-string",v:[{b:'"',e:'"'},{b:"<",e:">"}]}]},{cN:"class",b:"("+n.split(" ").join("|")+")\\b",e:"({|$)",eE:!0,k:n,l:a,c:[e.UTM]},{b:"\\."+e.UIR,r:0}]}}),e.registerLanguage("perl",function(e){var t="getpwent getservent quotemeta msgrcv scalar kill dbmclose undef lc ma syswrite tr send umask sysopen shmwrite vec qx utime local oct semctl localtime readpipe do return format read sprintf dbmopen pop getpgrp not getpwnam rewinddir qqfileno qw endprotoent wait sethostent bless s|0 opendir continue each sleep endgrent shutdown dump chomp connect getsockname die socketpair close flock exists index shmgetsub for endpwent redo lstat msgctl setpgrp abs exit select print ref gethostbyaddr unshift fcntl syscall goto getnetbyaddr join gmtime symlink semget splice x|0 getpeername recv log setsockopt cos last reverse gethostbyname getgrnam study formline endhostent times chop length gethostent getnetent pack getprotoent getservbyname rand mkdir pos chmod y|0 substr endnetent printf next open msgsnd readdir use unlink getsockopt getpriority rindex wantarray hex system getservbyport endservent int chr untie rmdir prototype tell listen fork shmread ucfirst setprotoent else sysseek link getgrgid shmctl waitpid unpack getnetbyname reset chdir grep split require caller lcfirst until warn while values shift telldir getpwuid my getprotobynumber delete and sort uc defined srand accept package seekdir getprotobyname semop our rename seek if q|0 chroot sysread setpwent no crypt getc chown sqrt write setnetent setpriority foreach tie sin msgget map stat getlogin unless elsif truncate exec keys glob tied closedirioctl socket readlink eval xor readline binmode setservent eof ord bind alarm pipe atan2 getgrent exp time push setgrent gt lt or ne m|0 break given say state when",r={cN:"subst",b:"[$@]\\{",e:"\\}",k:t},a={b:"->{",e:"}"},n={v:[{b:/\$\d/},{b:/[\$%@](\^\w\b|#\w+(::\w+)*|{\w+}|\w+(::\w*)*)/},{b:/[\$%@][^\s\w{]/,r:0}]},i=[e.BE,r,n],s=[n,e.HCM,e.C("^\\=\\w","\\=cut",{eW:!0}),a,{cN:"string",c:i,v:[{b:"q[qwxr]?\\s*\\(",e:"\\)",r:5},{b:"q[qwxr]?\\s*\\[",e:"\\]",r:5},{b:"q[qwxr]?\\s*\\{",e:"\\}",r:5},{b:"q[qwxr]?\\s*\\|",e:"\\|",r:5},{b:"q[qwxr]?\\s*\\<",e:"\\>",r:5},{b:"qw\\s+q",e:"q",r:5},{b:"'",e:"'",c:[e.BE]},{b:'"',e:'"'},{b:"`",e:"`",c:[e.BE]},{b:"{\\w+}",c:[],r:0},{b:"-?\\w+\\s*\\=\\>",c:[],r:0}]},{cN:"number",b:"(\\b0[0-7_]+)|(\\b0x[0-9a-fA-F_]+)|(\\b[1-9][0-9_]*(\\.[0-9_]+)?)|[0_]\\b",r:0},{b:"(\\/\\/|"+e.RSR+"|\\b(split|return|print|reverse|grep)\\b)\\s*",k:"split return print reverse grep",r:0,c:[e.HCM,{cN:"regexp",b:"(s|tr|y)/(\\\\.|[^/])*/(\\\\.|[^/])*/[a-z]*",r:10},{cN:"regexp",b:"(m|qr)?/",e:"/[a-z]*",c:[e.BE],r:0}]},{cN:"function",bK:"sub",e:"(\\s*\\(.*?\\))?[;{]",eE:!0,r:5,c:[e.TM]},{b:"-\\w\\b",r:0},{b:"^__DATA__$",e:"^__END__$",sL:"mojolicious",c:[{b:"^@@.*",e:"$",cN:"comment"}]}];return r.c=s,a.c=s,{aliases:["pl"],k:t,c:s}}),e.registerLanguage("php",function(e){var t={b:"\\$+[a-zA-Z-每][a-zA-Z0-9-每]*"},r={cN:"meta",b:/<\?(php)?|\?>/},a={cN:"string",c:[e.BE,r],v:[{b:'b"',e:'"'},{b:"b'",e:"'"},e.inherit(e.ASM,{i:null}),e.inherit(e.QSM,{i:null})]},n={v:[e.BNM,e.CNM]};return{aliases:["php3","php4","php5","php6"],cI:!0,k:"and include_once list abstract global private echo interface as static endswitch array null if endwhile or const for endforeach self var while isset public protected exit foreach throw elseif include __FILE__ empty require_once do xor return parent clone use __CLASS__ __LINE__ else break print eval new catch __METHOD__ case exception default die require __FUNCTION__ enddeclare final try switch continue endfor endif declare unset true false trait goto instanceof insteadof __DIR__ __NAMESPACE__ yield finally",c:[e.CLCM,e.HCM,e.C("/\\*","\\*/",{c:[{cN:"doctag",b:"@[A-Za-z]+"},r]}),e.C("__halt_compiler.+?;",!1,{eW:!0,k:"__halt_compiler",l:e.UIR}),{cN:"string",b:/<<<['"]?\w+['"]?$/,e:/^\w+;?$/,c:[e.BE,{cN:"subst",v:[{b:/\$\w+/},{b:/\{\$/,e:/\}/}]}]},r,t,{b:/(::|->)+[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/},{cN:"function",bK:"function",e:/[;{]/,eE:!0,i:"\\$|\\[|%",c:[e.UTM,{cN:"params",b:"\\(",e:"\\)",c:["self",t,e.CBCM,a,n]}]},{cN:"class",bK:"class interface",e:"{",eE:!0,i:/[:\(\$"]/,c:[{bK:"extends implements"},e.UTM]},{bK:"namespace",e:";",i:/[\.']/,c:[e.UTM]},{bK:"use",e:";",c:[e.UTM]},{b:"=>"},a,n]}}),e.registerLanguage("python",function(e){var t={cN:"meta",b:/^(>>>|\.\.\.) /},r={cN:"string",c:[e.BE],v:[{b:/(u|b)?r?'''/,e:/'''/,c:[t],r:10},{b:/(u|b)?r?"""/,e:/"""/,c:[t],r:10},{b:/(u|r|ur)'/,e:/'/,r:10},{b:/(u|r|ur)"/,e:/"/,r:10},{b:/(b|br)'/,e:/'/},{b:/(b|br)"/,e:/"/},e.ASM,e.QSM]},a={cN:"number",r:0,v:[{b:e.BNR+"[lLjJ]?"},{b:"\\b(0o[0-7]+)[lLjJ]?"},{b:e.CNR+"[lLjJ]?"}]},n={cN:"params",b:/\(/,e:/\)/,c:["self",t,a,r]};return{aliases:["py","gyp"],k:{keyword:"and elif is global as in if from raise for except finally print import pass return exec else break not with class assert yield try while continue del or def lambda async await nonlocal|10 None True False",built_in:"Ellipsis NotImplemented"},i:/(<\/|->|\?)/,c:[t,a,r,e.HCM,{v:[{cN:"function",bK:"def",r:10},{cN:"class",bK:"class"}],e:/:/,i:/[${=;\n,]/,c:[e.UTM,n,{b:/->/,eW:!0,k:"None"}]},{cN:"meta",b:/^[\t ]*@/,e:/$/},{b:/\b(print|exec)\(/}]}}),e.registerLanguage("ruby",function(e){var t="[a-zA-Z_]\\w*[!?=]?|[-+~]\\@|<<|>>|=~|===?|<=>|[<>]=?|\\*\\*|[-/+%^&*~`|]|\\[\\]=?",r="and false then defined module in return redo if BEGIN retry end for true self when next until do begin unless END rescue nil else break undef not super class case require yield alias while ensure elsif or include attr_reader attr_writer attr_accessor",a={cN:"doctag",b:"@[A-Za-z]+"},n={b:"#<",e:">"},i=[e.C("#","$",{c:[a]}),e.C("^\\=begin","^\\=end",{c:[a],r:10}),e.C("^__END__","\\n$")],s={cN:"subst",b:"#\\{",e:"}",k:r},c={cN:"string",c:[e.BE,s],v:[{b:/'/,e:/'/},{b:/"/,e:/"/},{b:/`/,e:/`/},{b:"%[qQwWx]?\\(",e:"\\)"},{b:"%[qQwWx]?\\[",e:"\\]"},{b:"%[qQwWx]?{",e:"}"},{b:"%[qQwWx]?<",e:">"},{b:"%[qQwWx]?/",e:"/"},{b:"%[qQwWx]?%",e:"%"},{b:"%[qQwWx]?-",e:"-"},{b:"%[qQwWx]?\\|",e:"\\|"},{b:/\B\?(\\\d{1,3}|\\x[A-Fa-f0-9]{1,2}|\\u[A-Fa-f0-9]{4}|\\?\S)\b/}]},o={cN:"params",b:"\\(",e:"\\)",endsParent:!0,k:r},l=[c,n,{cN:"class",bK:"class module",e:"$|;",i:/=/,c:[e.inherit(e.TM,{b:"[A-Za-z_]\\w*(::\\w+)*(\\?|\\!)?"}),{b:"<\\s*",c:[{b:"("+e.IR+"::)?"+e.IR}]}].concat(i)},{cN:"function",bK:"def",e:"$|;",c:[e.inherit(e.TM,{b:t}),o].concat(i)},{cN:"symbol",b:e.UIR+"(\\!|\\?)?:",r:0},{cN:"symbol",b:":",c:[c,{b:t}],r:0},{cN:"number",b:"(\\b0[0-7_]+)|(\\b0x[0-9a-fA-F_]+)|(\\b[1-9][0-9_]*(\\.[0-9_]+)?)|[0_]\\b",r:0},{b:"(\\$\\W)|((\\$|\\@\\@?)(\\w+))"},{b:"("+e.RSR+")\\s*",c:[n,{cN:"regexp",c:[e.BE,s],i:/\n/,v:[{b:"/",e:"/[a-z]*"},{b:"%r{",e:"}[a-z]*"},{b:"%r\\(",e:"\\)[a-z]*"},{b:"%r!",e:"![a-z]*"},{b:"%r\\[",e:"\\][a-z]*"}]}].concat(i),r:0}].concat(i);s.c=l,o.c=l;var u="[>?]>",d="[\\w#]+\\(\\w+\\):\\d+:\\d+>",b="(\\w+-)?\\d+\\.\\d+\\.\\d(p\\d+)?[^>]+>",p=[{b:/^\s*=>/,starts:{e:"$",c:l}},{cN:"meta",b:"^("+u+"|"+d+"|"+b+")",starts:{e:"$",c:l}}];return{aliases:["rb","gemspec","podspec","thor","irb"],k:r,i:/\/\*/,c:i.concat(p).concat(l)}}),e.registerLanguage("sql",function(e){var t=e.C("--","$");return{cI:!0,i:/[<>{}*]/,c:[{bK:"begin end start commit rollback savepoint lock alter create drop rename call delete do handler insert load replace select truncate update set show pragma grant merge describe use explain help declare prepare execute deallocate release unlock purge reset change stop analyze cache flush optimize repair kill install uninstall checksum restore check backup revoke",e:/;/,eW:!0,k:{keyword:"abort abs absolute acc acce accep accept access accessed accessible account acos action activate add addtime admin administer advanced advise aes_decrypt aes_encrypt after agent aggregate ali alia alias allocate allow alter always analyze ancillary and any anydata anydataset anyschema anytype apply archive archived archivelog are as asc ascii asin assembly assertion associate asynchronous at atan atn2 attr attri attrib attribu attribut attribute attributes audit authenticated authentication authid authors auto autoallocate autodblink autoextend automatic availability avg backup badfile basicfile before begin beginning benchmark between bfile bfile_base big bigfile bin binary_double binary_float binlog bit_and bit_count bit_length bit_or bit_xor bitmap blob_base block blocksize body both bound buffer_cache buffer_pool build bulk by byte byteordermark bytes c cache caching call calling cancel capacity cascade cascaded case cast catalog category ceil ceiling chain change changed char_base char_length character_length characters characterset charindex charset charsetform charsetid check checksum checksum_agg child choose chr chunk class cleanup clear client clob clob_base clone close cluster_id cluster_probability cluster_set clustering coalesce coercibility col collate collation collect colu colum column column_value columns columns_updated comment commit compact compatibility compiled complete composite_limit compound compress compute concat concat_ws concurrent confirm conn connec connect connect_by_iscycle connect_by_isleaf connect_by_root connect_time connection consider consistent constant constraint constraints constructor container content contents context contributors controlfile conv convert convert_tz corr corr_k corr_s corresponding corruption cos cost count count_big counted covar_pop covar_samp cpu_per_call cpu_per_session crc32 create creation critical cross cube cume_dist curdate current current_date current_time current_timestamp current_user cursor curtime customdatum cycle d data database databases datafile datafiles datalength date_add date_cache date_format date_sub dateadd datediff datefromparts datename datepart datetime2fromparts day day_to_second dayname dayofmonth dayofweek dayofyear days db_role_change dbtimezone ddl deallocate declare decode decompose decrement decrypt deduplicate def defa defau defaul default defaults deferred defi defin define degrees delayed delegate delete delete_all delimited demand dense_rank depth dequeue des_decrypt des_encrypt des_key_file desc descr descri describ describe descriptor deterministic diagnostics difference dimension direct_load directory disable disable_all disallow disassociate discardfile disconnect diskgroup distinct distinctrow distribute distributed div do document domain dotnet double downgrade drop dumpfile duplicate duration e each edition editionable editions element ellipsis else elsif elt empty enable enable_all enclosed encode encoding encrypt end end-exec endian enforced engine engines enqueue enterprise entityescaping eomonth error errors escaped evalname evaluate event eventdata events except exception exceptions exchange exclude excluding execu execut execute exempt exists exit exp expire explain export export_set extended extent external external_1 external_2 externally extract f failed failed_login_attempts failover failure far fast feature_set feature_value fetch field fields file file_name_convert filesystem_like_logging final finish first first_value fixed flash_cache flashback floor flush following follows for forall force form forma format found found_rows freelist freelists freepools fresh from from_base64 from_days ftp full function g general generated get get_format get_lock getdate getutcdate global global_name globally go goto grant grants greatest group group_concat group_id grouping grouping_id groups gtid_subtract guarantee guard handler hash hashkeys having hea head headi headin heading heap help hex hierarchy high high_priority hosts hour http i id ident_current ident_incr ident_seed identified identity idle_time if ifnull ignore iif ilike ilm immediate import in include including increment index indexes indexing indextype indicator indices inet6_aton inet6_ntoa inet_aton inet_ntoa infile initial initialized initially initrans inmemory inner innodb input insert install instance instantiable instr interface interleaved intersect into invalidate invisible is is_free_lock is_ipv4 is_ipv4_compat is_not is_not_null is_used_lock isdate isnull isolation iterate java join json json_exists k keep keep_duplicates key keys kill l language large last last_day last_insert_id last_value lax lcase lead leading least leaves left len lenght length less level levels library like like2 like4 likec limit lines link list listagg little ln load load_file lob lobs local localtime localtimestamp locate locator lock locked log log10 log2 logfile logfiles logging logical logical_reads_per_call logoff logon logs long loop low low_priority lower lpad lrtrim ltrim m main make_set makedate maketime managed management manual map mapping mask master master_pos_wait match matched materialized max maxextents maximize maxinstances maxlen maxlogfiles maxloghistory maxlogmembers maxsize maxtrans md5 measures median medium member memcompress memory merge microsecond mid migration min minextents minimum mining minus minute minvalue missing mod mode model modification modify module monitoring month months mount move movement multiset mutex n name name_const names nan national native natural nav nchar nclob nested never new newline next nextval no no_write_to_binlog noarchivelog noaudit nobadfile nocheck nocompress nocopy nocycle nodelay nodiscardfile noentityescaping noguarantee nokeep nologfile nomapping nomaxvalue nominimize nominvalue nomonitoring none noneditionable nonschema noorder nopr nopro noprom nopromp noprompt norely noresetlogs noreverse normal norowdependencies noschemacheck noswitch not nothing notice notrim novalidate now nowait nth_value nullif nulls num numb numbe nvarchar nvarchar2 object ocicoll ocidate ocidatetime ociduration ociinterval ociloblocator ocinumber ociref ocirefcursor ocirowid ocistring ocitype oct octet_length of off offline offset oid oidindex old on online only opaque open operations operator optimal optimize option optionally or oracle oracle_date oradata ord ordaudio orddicom orddoc order ordimage ordinality ordvideo organization orlany orlvary out outer outfile outline output over overflow overriding p package pad parallel parallel_enable parameters parent parse partial partition partitions pascal passing password password_grace_time password_lock_time password_reuse_max password_reuse_time password_verify_function patch path patindex pctincrease pctthreshold pctused pctversion percent percent_rank percentile_cont percentile_disc performance period period_add period_diff permanent physical pi pipe pipelined pivot pluggable plugin policy position post_transaction pow power pragma prebuilt precedes preceding precision prediction prediction_cost prediction_details prediction_probability prediction_set prepare present preserve prior priority private private_sga privileges procedural procedure procedure_analyze processlist profiles project prompt protection public publishingservername purge quarter query quick quiesce quota quotename radians raise rand range rank raw read reads readsize rebuild record records recover recovery recursive recycle redo reduced ref reference referenced references referencing refresh regexp_like register regr_avgx regr_avgy regr_count regr_intercept regr_r2 regr_slope regr_sxx regr_sxy reject rekey relational relative relaylog release release_lock relies_on relocate rely rem remainder rename repair repeat replace replicate replication required reset resetlogs resize resource respect restore restricted result result_cache resumable resume retention return returning returns reuse reverse revoke right rlike role roles rollback rolling rollup round row row_count rowdependencies rowid rownum rows rtrim rules safe salt sample save savepoint sb1 sb2 sb4 scan schema schemacheck scn scope scroll sdo_georaster sdo_topo_geometry search sec_to_time second section securefile security seed segment select self sequence sequential serializable server servererror session session_user sessions_per_user set sets settings sha sha1 sha2 share shared shared_pool short show shrink shutdown si_averagecolor si_colorhistogram si_featurelist si_positionalcolor si_stillimage si_texture siblings sid sign sin size size_t sizes skip slave sleep smalldatetimefromparts smallfile snapshot some soname sort soundex source space sparse spfile split sql sql_big_result sql_buffer_result sql_cache sql_calc_found_rows sql_small_result sql_variant_property sqlcode sqldata sqlerror sqlname sqlstate sqrt square standalone standby start starting startup statement static statistics stats_binomial_test stats_crosstab stats_ks_test stats_mode stats_mw_test stats_one_way_anova stats_t_test_ stats_t_test_indep stats_t_test_one stats_t_test_paired stats_wsr_test status std stddev stddev_pop stddev_samp stdev stop storage store stored str str_to_date straight_join strcmp strict string struct stuff style subdate subpartition subpartitions substitutable substr substring subtime subtring_index subtype success sum suspend switch switchoffset switchover sync synchronous synonym sys sys_xmlagg sysasm sysaux sysdate sysdatetimeoffset sysdba sysoper system system_user sysutcdatetime t table tables tablespace tan tdo template temporary terminated tertiary_weights test than then thread through tier ties time time_format time_zone timediff timefromparts timeout timestamp timestampadd timestampdiff timezone_abbr timezone_minute timezone_region to to_base64 to_date to_days to_seconds todatetimeoffset trace tracking transaction transactional translate translation treat trigger trigger_nestlevel triggers trim truncate try_cast try_convert try_parse type ub1 ub2 ub4 ucase unarchived unbounded uncompress under undo unhex unicode uniform uninstall union unique unix_timestamp unknown unlimited unlock unpivot unrecoverable unsafe unsigned until untrusted unusable unused update updated upgrade upped upper upsert url urowid usable usage use use_stored_outlines user user_data user_resources users using utc_date utc_timestamp uuid uuid_short validate validate_password_strength validation valist value values var var_samp varcharc vari varia variab variabl variable variables variance varp varraw varrawc varray verify version versions view virtual visible void wait wallet warning warnings week weekday weekofyear wellformed when whene whenev wheneve whenever where while whitespace with within without work wrapped xdb xml xmlagg xmlattributes xmlcast xmlcolattval xmlelement xmlexists xmlforest xmlindex xmlnamespaces xmlpi xmlquery xmlroot xmlschema xmlserialize xmltable xmltype xor year year_to_month years yearweek",
literal:"true false null",built_in:"array bigint binary bit blob boolean char character date dec decimal float int int8 integer interval number numeric real record serial serial8 smallint text varchar varying void"},c:[{cN:"string",b:"'",e:"'",c:[e.BE,{b:"''"}]},{cN:"string",b:'"',e:'"',c:[e.BE,{b:'""'}]},{cN:"string",b:"`",e:"`",c:[e.BE]},e.CNM,e.CBCM,t]},e.CBCM,t]}}),e});

//输出
window.onload=function(){
  console.log("%c喵~ 大佬好！","color: #0069D6 !important;font-size:14px;");
  console.log("%c%c主题%cArmx Mod for Typecho","line-height:28px;","line-height:28px;padding:4px;background:#25b15e;color:#fff;font-size:14px;margin-right:15px","color:#25b15e;line-height:28px;font-size:14px;");
  console.log("%c%c反馈%chttps://vircloud.net","line-height:28px;","line-height:28px;padding:4px;background:#F24C27;color:#fff;font-size:14px;margin-right:15px","color:#F24C27;line-height:28px;font-size:14px;");
  console.log("%c%c联络%cTelegram：@vircloud","line-height:28px;","line-height:28px;padding:4px;background:#58666e;color:#fff;font-size:14px;margin-right:15px","color:#58666e;line-height:28px;font-size:14px;");
}

function getQueryVariable(variable)
{
       var query = window.location.search.substring(1);
       var vars = query.split("&");
       for (var i=0;i<vars.length;i++) {
               var pair = vars[i].split("=");
               if(pair[0] == variable){return pair[1];}
       }
       return(false);
}
