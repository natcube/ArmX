var isIE = (function(w, html){
  var ua = w.navigator.userAgent;
  if (!/MSIE/i.test(ua)) {
    return false;
  }
  var version = ua.match(new RegExp("MSIE (\\d+)(\\.\\d+)?;", 'i'));
  var v = 5;
  var className = html.className;
  while (v <= version[1]) {
      if(v > 11){
        break;
      }
      className += ' ie'+v;
      v++;
  }
  html.className = className;
  return 1*version[1]; 
})(window, document.documentElement);

if (!Array.prototype.forEach) {
  Array.prototype.forEach = function(callback, thisArg) {
    var T, k;
    if (this == null) {
      throw new TypeError(' this is null or not defined');
    }
    var O = Object(this);
    var len = O.length >>> 0;
    if (typeof callback !== "function") {
      throw new TypeError(callback + ' is not a function');
    }
    if (arguments.length > 1) {
      T = thisArg;
    }
    k = 0;
    while (k < len) {
      var kValue;
      if (k in O) {
        kValue = O[k];
        callback.call(T, kValue, k, O);
      }
      k++;
    }
  };
}
if (!Array.prototype.filter)
{
  Array.prototype.filter = function(fun /* , thisArg*/)
  {
    "use strict";

    if (this === void 0 || this === null)
      throw new TypeError();

    var t = Object(this);
    var len = t.length >>> 0;
    if (typeof fun !== "function")
      throw new TypeError();

    var res = [];
    var thisArg = arguments.length >= 2 ? arguments[1] : void 0;
    for (var i = 0; i < len; i++)
    {
      if (i in t)
      {
        var val = t[i];
        if (fun.call(thisArg, val, i, t))
          res.push(val);
      }
    }
    return res;
  };
}
if (!Object.keys) {
  Object.keys = (function () {
    var hasOwnProperty = Object.prototype.hasOwnProperty,
        hasDontEnumBug = !({toString: null}).propertyIsEnumerable('toString'),
        dontEnums = [
          'toString',
          'toLocaleString',
          'valueOf',
          'hasOwnProperty',
          'isPrototypeOf',
          'propertyIsEnumerable',
          'constructor'
        ],
        dontEnumsLength = dontEnums.length;

    return function (obj) {
      if (typeof obj !== 'object' && typeof obj !== 'function' || obj === null) throw new TypeError('Object.keys called on non-object');

      var result = [];

      for (var prop in obj) {
        if (hasOwnProperty.call(obj, prop)) result.push(prop);
      }

      if (hasDontEnumBug) {
        for (var i=0; i < dontEnumsLength; i++) {
          if (hasOwnProperty.call(obj, dontEnums[i])) result.push(dontEnums[i]);
        }
      }
      return result;
    }
  })()
};

if (!String.prototype.trim) {
  String.prototype.trim = function () {
    return this.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '');
  };
}

if (Object.defineProperty 
  && Object.getOwnPropertyDescriptor 
  && Object.getOwnPropertyDescriptor(Element.prototype, "textContent") 
  && !Object.getOwnPropertyDescriptor(Element.prototype, "textContent").get) {
  (function() {
    var innerText = Object.getOwnPropertyDescriptor(Element.prototype, "innerText");
    Object.defineProperty(Element.prototype, "textContent",
     {
       get: function() {
         return innerText.get.call(this);
       },
       set: function(s) {
         return innerText.set.call(this, s);
       }
     }
   );
  })();
}

if (!Array.prototype.map) {

  Array.prototype.map = function(callback/*, thisArg*/) {

    var T, A, k;

    if (this == null) {
      throw new TypeError('this is null or not defined');
    }
    var O = Object(this);
    var len = O.length >>> 0;
    if (typeof callback !== 'function') {
      throw new TypeError(callback + ' is not a function');
    }

    if (arguments.length > 1) {
      T = arguments[1];
    }

    A = new Array(len);

    k = 0;

    while (k < len) {

      var kValue, mappedValue;

      if (k in O) {

        kValue = O[k];

        mappedValue = callback.call(T, kValue, k, O);

        A[k] = mappedValue;
      }
      k++;
    }

    return A;
  };
}

if (typeof Object.create !== "function") {
    Object.create = function (proto, propertiesObject) {
        if (typeof proto !== 'object' && typeof proto !== 'function') {
            throw new TypeError('Object prototype may only be an Object: ' + proto);
        } else if (proto === null) {
            throw new Error("This browser's implementation of Object.create is a shim and doesn't support 'null' as the first argument.");
        }
        function F() {}
        F.prototype = proto;
        if(typeof propertiesObject == 'object'){
          for (prop in propertiesObject) {
            F.prototype[prop] = propertiesObject[prop].value;
          }
        }
        return new F();
    };
}

if (!Element.prototype.setAttribute) {

    Element.prototype.setAttribute = function(attributename,attributevalue){
        var atr = document.createAttribute(attributename);
        atr.nodeValue = attributevalue;
        this.setAttributeNode(atr);
    }
}