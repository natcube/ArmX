/*!
 * JavaScript Cookie v2.2.0
 * https://github.com/js-cookie/js-cookie
 *
 * Copyright 2006, 2015 Klaus Hartl & Fagner Brack
 * Released under the MIT license
 */
(function(factory) {
    var registeredInModuleLoader;
    if (typeof define === 'function' && define.amd) {
        define(factory);
        registeredInModuleLoader = !0
    }
    if (typeof exports === 'object') {
        module.exports = factory();
        registeredInModuleLoader = !0
    }
    if (!registeredInModuleLoader) {
        var OldCookies = window.Cookies;
        var api = window.Cookies = factory();
        api.noConflict = function() {
            window.Cookies = OldCookies;
            return api
        }
    }
} (function() {
    function extend() {
        var i = 0;
        var result = {};
        for (; i < arguments.length; i++) {
            var attributes = arguments[i];
            for (var key in attributes) {
                result[key] = attributes[key]
            }
        }
        return result
    }
    function init(converter) {
        function api(key, value, attributes) {
            if (typeof document === 'undefined') {
                return
            }
            if (arguments.length > 1) {
                attributes = extend({
                    path: '/'
                },
                api.defaults, attributes);
                if (typeof attributes.expires === 'number') {
                    attributes.expires = new Date(new Date() * 1 + (expires*1000*3600*24))//attributes.expires * 864e + 5)
                }
                attributes.expires = attributes.expires ? attributes.expires.toUTCString() : '';
                try {
                    var result = JSON.stringify(value);
                    if (/^[\{\[]/.test(result)) {
                        value = result
                    }
                } catch(e) {}
                value = converter.write ? converter.write(value, key) : encodeURIComponent(String(value)).replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g, decodeURIComponent);
                key = encodeURIComponent(String(key)).replace(/%(23|24|26|2B|5E|60|7C)/g, decodeURIComponent).replace(/[\(\)]/g, escape);
                var stringifiedAttributes = '';
                for (var attributeName in attributes) {
                    if (!attributes[attributeName]) {
                        continue
                    }
                    stringifiedAttributes += '; ' + attributeName;
                    if (attributes[attributeName] === !0) {
                        continue
                    }
                    stringifiedAttributes += '=' + attributes[attributeName].split(';')[0]
                }
                return (document.cookie = key + '=' + value + stringifiedAttributes)
            }
            var jar = {};
            var decode = function(s) {
                return s.replace(/(%[0-9A-Z]{2})+/g, decodeURIComponent)
            };
            var cookies = document.cookie ? document.cookie.split('; ') : [];
            var i = 0;
            for (; i < cookies.length; i++) {
                var parts = cookies[i].split('=');
                var cookie = parts.slice(1).join('=');
                if (!this.json && cookie.charAt(0) === '"') {
                    cookie = cookie.slice(1, -1)
                }
                try {
                    var name = decode(parts[0]);
                    cookie = (converter.read || converter)(cookie, name) || decode(cookie);
                    if (this.json) {
                        try {
                            cookie = JSON.parse(cookie)
                        } catch(e) {}
                    }
                    jar[name] = cookie;
                    if (key === name) {
                        break
                    }
                } catch(e) {}
            }
            return key ? jar[key] : jar
        }
        api.set = api;
        api.get = function(key) {
            return api.call(api, key)
        };
        api.getJSON = function(key) {
            return api.call({
                json: !0
            },
            key)
        };
        api.remove = function(key, attributes) {
            api(key, '', extend(attributes, {
                expires: -1
            }))
        };
        api.defaults = {};
        api.withConverter = init;
        return api
    }
    return init(function() {})
}));

function tmode() {
    if (Cookies.get('tmode') != 'dark') {
        Cookies.set('tmode', 'dark');
        $(".post-box,.widget-box,#about-card-list,.article-box,.article-box .links ul li,#article-index,.response-form,.select-comment,.article-extend").each(function(){$(this).addClass("darkindexback");});
        document.body.style.backgroundColor="#2e3131";
        document.getElementById("page").classList.add("darkpage");
//        document.getElementById("tmode-btn").innerHTML = "日";
	$("#nightmode-btn").attr("title","正常模式");
	document.getElementById("tmode-btn").classList.remove("fa-moon-o");
	document.getElementById("tmode-btn").classList.add("fa-sun-o");
    } else {
        Cookies.set('tmode', 'light');
        $(".post-box,.widget-box,#about-card-list,.article-box,.article-box .links ul li,#article-index,.response-form,.select-comment,.article-extend").each(function(){$(this).removeClass("darkindexback");});
        document.body.style.backgroundColor="#f6f6f6";
        document.getElementById("page").classList.remove("darkpage");
//        document.getElementById("tmode-btn").innerHTML = "夜";
	$("#nightmode-btn").attr("title","夜间模式");
	document.getElementById("tmode-btn").classList.remove("fa-sun-o");
	document.getElementById("tmode-btn").classList.add("fa-moon-o");
    }
}


