/*
 * The information and software code below,
 * located at http://www.invoca.net/0/publisher_integration.js,
 * are confidential and are the sole property of Invoca.
 * Your application or use of this information in any way is subject to
 * Invoca&#x27;s Terms of Service, which are located at
 * http://www.invoca.com/terms-of-service. In accordance with those terms, your
 * use of this information and code may be terminated by Invoca at any time
 * for any reason.  The rights granted to you under those terms are expressly
 * non-exclusive. You may not sell, assign, sublicense, or otherwise transfer or
 * agree to transfer all or any portion of those rights without Invoca&#x27;s
 * prior written consent.  You agree not to copy, republish, frame, download,
 * transmit, modify, rent, lease, loan, sell, assign, distribute, license,
 * sublicense, reverse engineer, or create derivative works based on the
 * information and/or software code on this page except as expressly authorized
 * in Invoca&#x27;s Terms of Service.  Your use and continued use of this
 * information and/or code constitute your acceptance of Invoca&#x27;s Terms of Service.
 *
 * Copyright (c) 2014 Invoca (r)
 */

if("undefined"==typeof Invoca)var Invoca={};"undefined"==typeof Invoca.log&&(Invoca.log=function(n,o){"undefined"!=typeof console&&(o&&"undefined"!=typeof console.error?console.error(n):this.debugMode&&"undefined"!=typeof console.log&&console.log(n))}),"undefined"==typeof Invoca.now&&(Invoca.now=function(){return(new Date).getTime()}),Invoca.getCurrentLocation=function(){return window.location.toString()},Invoca.countHash=function(n){var o=0;for(var e in n)n.hasOwnProperty(e)&&(o+=1);return o};

Invoca.AffiliateIntegration = { URL : "//json6.ringrevenue.com/6/publisher_map_number" };

Invoca.affiliate_integration = function(options)
{
  Invoca.affiliate_integration_options = options || {};
};

!function(Invoca){function f(e){return 10>e?"0"+e:e}function quote(e){return escapable.lastIndex=0,escapable.test(e)?'"'+e.replace(escapable,function(e){var t=meta[e];return"string"==typeof t?t:"\\u"+("0000"+e.charCodeAt(0).toString(16)).slice(-4)})+'"':'"'+e+'"'}function str(e,t){var n,r,o,a,i,c=gap,l=t[e];switch(l&&"object"==typeof l&&"function"==typeof l.toJSON&&(l=l.toJSON(e)),"function"==typeof rep&&(l=rep.call(t,e,l)),typeof l){case"string":return quote(l);case"number":return isFinite(l)?String(l):"null";case"boolean":case"null":return String(l);case"object":if(!l)return"null";if(gap+=indent,i=[],"[object Array]"===Object.prototype.toString.apply(l)){for(a=l.length,n=0;a>n;n+=1)i[n]=str(n,l)||"null";return o=0===i.length?"[]":gap?"[\n"+gap+i.join(",\n"+gap)+"\n"+c+"]":"["+i.join(",")+"]",gap=c,o}if(rep&&"object"==typeof rep)for(a=rep.length,n=0;a>n;n+=1)"string"==typeof rep[n]&&(r=rep[n],o=str(r,l),o&&i.push(quote(r)+(gap?": ":":")+o));else for(r in l)Object.prototype.hasOwnProperty.call(l,r)&&(o=str(r,l),o&&i.push(quote(r)+(gap?": ":":")+o));return o=0===i.length?"{}":gap?"{\n"+gap+i.join(",\n"+gap)+"\n"+c+"}":"{"+i.join(",")+"}",gap=c,o}}Invoca.JSON=window.JSON||{},"function"!=typeof Date.prototype.toJSON&&(Date.prototype.toJSON=function(){return isFinite(this.valueOf())?this.getUTCFullYear()+"-"+f(this.getUTCMonth()+1)+"-"+f(this.getUTCDate())+"T"+f(this.getUTCHours())+":"+f(this.getUTCMinutes())+":"+f(this.getUTCSeconds())+"Z":null},String.prototype.toJSON=Number.prototype.toJSON=Boolean.prototype.toJSON=function(){return this.valueOf()});var cx=/[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,escapable=/[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,gap,indent,meta={"\b":"\\b","	":"\\t","\n":"\\n","\f":"\\f","\r":"\\r",'"':'\\"',"\\":"\\\\"},rep;"function"!=typeof Invoca.JSON.stringify&&(Invoca.JSON.stringify=function(e,t,n){var r;if(gap="",indent="","number"==typeof n)for(r=0;n>r;r+=1)indent+=" ";else"string"==typeof n&&(indent=n);if(rep=t,t&&"function"!=typeof t&&("object"!=typeof t||"number"!=typeof t.length))throw new Error("JSON.stringify");return str("",{"":e})}),"function"!=typeof Invoca.JSON.parse&&(Invoca.JSON.parse=function(text,reviver){function walk(e,t){var n,r,o=e[t];if(o&&"object"==typeof o)for(n in o)Object.prototype.hasOwnProperty.call(o,n)&&(r=walk(o,n),void 0!==r?o[n]=r:delete o[n]);return reviver.call(e,t,o)}var j;if(text=String(text),cx.lastIndex=0,cx.test(text)&&(text=text.replace(cx,function(e){return"\\u"+("0000"+e.charCodeAt(0).toString(16)).slice(-4)})),/^[\],:{}\s]*$/.test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,"@").replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,"]").replace(/(?:^|:|,)(?:\s*\[)+/g,"")))return j=eval("("+text+")"),"function"==typeof reviver?walk({"":j},""):j;throw new SyntaxError("JSON.parse")})}(Invoca),/*
* Original version:
* Lightweight JSONP fetcher
* Copyright 2010 Erik Karlsson. All rights reserved.
* BSD licensed
*/
function(e){var t,n,r=this;e.JSONP=e.JSONP||{},e.JSONP.counter=0,e.JSONP.load=function(e){var n=document.createElement("script"),r=!1;n.src=e,n.async=!0,n.onload=n.onreadystatechange=function(){r||this.readyState&&"loaded"!==this.readyState&&"complete"!==this.readyState||(r=!0,n.onload=n.onreadystatechange=null,n&&n.parentNode&&n.parentNode.removeChild(n))},t||(t=document.getElementsByTagName("head")[0]),t.appendChild(n)},e.JSONP.requestWithLandingPage=function(t,o,a,i,c,l){var u=!1;return c&&-1!=c.search(/%ESCAPED_URL%/)&&(u=!0),{get:function(){var t="json_rr"+ ++e.JSONP.counter;return r[t]=function(e){l(e);try{delete r[t]}catch(n){}r[t]=null},o.jsoncallback=t,e.JSONP.load(this.encodeUrl(),l),t},encodeUrl:function(){var e=-1==t.search(/\?/)?"?":"&";for(n in o)o.hasOwnProperty(n)&&(e+=encodeURIComponent(n)+"="+encodeURIComponent(o[n])+"&");return t=this.encodeVal(t+e,u?1:0),t+=a+this.encodeVal("=",u?1:0)+this.buildLandingPageUrl(),c?u?c.replace(/%ESCAPED_URL%/,t):c.replace(/%UNESCAPED_URL%/,t):t},buildLandingPageUrl:function(){var e=Invoca.getCurrentLocation(),t="",r="";if(i){t=-1==e.search(/\?/)?"?":"&";for(n in i)if(i.hasOwnProperty(n)){var o,a,c=i[n];"object"==typeof c?(o="undefined"==typeof c.escape||c.escape,a=c.value):(o=!0,a=c.toString()),r+=this.encodeVal(n,u?3:2)+this.encodeVal("=",u?2:1)+(o?this.encodeVal(a,u?3:2):a)+this.encodeVal("&",u?2:1)}r=r.replace(u?/(%2526)$/:/(%26)$/,"")}return this.encodeVal(e+t,u?2:1)+r},encodeVal:function(e,t){for(var n=e,r=0;t>r;++r)n=encodeURIComponent(n);return n}}}}(Invoca),function(e){function t(){if(!c&&(c=!0,l)){for(var t=0;t<l.length;t++)l[t].call(document,e);l=[]}}function n(){if(!i){if(i=!0,document.readyState&&"complete"===document.readyState||"loaded"===document.readyState)return c=!0,void 0;document.addEventListener?document.addEventListener("DOMContentLoaded",function(){document.removeEventListener("DOMContentLoaded",arguments.callee,!1),t()},!1):document.attachEvent&&(document.attachEvent("onreadystatechange",function(){"complete"===document.readyState&&(document.detachEvent("onreadystatechange",arguments.callee),t())}),document.documentElement.doScroll&&window==window.top&&function(){if(!c){try{document.documentElement.doScroll("left")}catch(e){return setTimeout(arguments.callee,0),void 0}t()}}());var e=window.onload;window.onload=function(){"function"==typeof e&&e(),t()}}}function r(){e.DOM.support={};var t=document.createElement("div");t.style.width=t.style.paddingLeft="1px",document.body.appendChild(t),e.DOM.support.boxModel=2===t.offsetWidth,document.body.removeChild(t).style.display="none"}function o(e,t,n){var r;return r=document.getElementsByClassName?function(e,t,n){n=n||document;for(var r,o=n.getElementsByClassName(e),a=t?new RegExp("\\b"+t+"\\b","i"):null,i=[],c=0,l=o.length;l>c;c+=1)r=o[c],(!a||a.test(r.nodeName))&&i.push(r);return i}:document.evaluate?function(e,t,n){t=t||"*",n=n||document;for(var r,o,a=e.split(" "),i="",c="http://www.w3.org/1999/xhtml",l=document.documentElement.namespaceURI===c?c:null,u=[],s=0,f=a.length;f>s;s+=1)i+="[contains(concat(' ', @class, ' '), ' "+a[s]+" ')]";try{r=document.evaluate(".//"+t+i,n,l,0,null)}catch(d){r=document.evaluate(".//"+t+i,n,null,0,null)}for(;o=r.iterateNext();)u.push(o);return u}:function(e,t,n){t=t||"*",n=n||document;for(var r,o,a=e.split(" "),i=[],c="*"===t&&n.all?n.all:n.getElementsByTagName(t),l=[],u=0,s=a.length;s>u;u+=1)i.push(new RegExp("(^|\\s)"+a[u]+"(\\s|$)"));for(var f=0,d=c.length;d>f;f+=1){r=c[f],o=!1;for(var h=0,p=i.length;p>h&&(o=i[h].test(r.className),o);h+=1);o&&l.push(r)}return l},r(e,t,n)}function a(e){return(e||"").replace(/^\s+|\s+$/g,"")}var i=!1,c=!1,l=[];e.onReady=function(t){return n(),c?t.call(document,e):l.push(t),this},e.DOM={support:{}},e.onReady(r),e.DOM.show=function(t){for(var n=e.DOM.selectElements(t),r=0,o=n.length;o>r;r++)n[r].style.display=""},e.DOM.hide=function(t,n){for(var r=e.DOM.selectElements(t),o=0,a=r.length;a>o;o++)n?r[o].style.visibility="hidden":r[o].style.display="none"},e.DOM.setHTML=function(t,n,r){if(void 0!==t)for(var o=e.DOM.selectElements(n,r),a=0,i=o.length;i>a;a++)try{o[a].innerHTML=t}catch(c){e.log("Could not set HTML of element type "+o[a].nodeName+" from selector "+n+". Error: "+c.message,!0)}},e.DOM.getHTML=function(t,n){var r=e.DOM.selectElements(t,n);return r.length>0?r[0].innerHTML:""},e.DOM.addClass=function(t,n,r){for(var o=e.DOM.selectElements(n,r),a=0,i=o.length;i>a;a++)try{var c=o[a].className;o[a].className=c?c+" "+t:t}catch(l){e.log("Could not add class "+t+" to "+o[a].nodeName+" from selector "+n+". Error: "+l.toString(),!0)}},e.DOM.addCss=function(t,n,r){for(var o=e.DOM.selectElements(n,r),a=0,i=o.length;i>a;a++)e.DOM.addCssToElement(o[a],t)},e.DOM.addCssToElement=function(t,n){try{for(var r in n)t.style[r]=n[r]}catch(o){e.log("Could not add css styles "+n+" to "+t.nodeName+". Error: "+o.toString(),!0)}},e.DOM.selectElements=function(t,n){for(var r,i,c=t.split(","),l=[],u=void 0,s=0,f=c.length;f>s;s++)if(i=a(c[s]),i.indexOf(".")>-1&&i.indexOf("#")>-1)e.log("Selector not supported: '"+i+"'. Can not combine ID and class in a single selector.",!0);else if(i.indexOf(".")>-1)l=l.concat(o(i.replace(/\./g,""),u,n));else{if(!(i.indexOf("#")>-1)){e.log("Selector not supported: '"+i+"'. Specify an ID or class using '#' or '.' respectively.",!0);continue}(r=document.getElementById(i.replace("#","")))&&l.push(r)}if(c.length>1){for(var d=[],h=0;h<l.length;h++){for(var p=!1,g=0;g<d.length;g++)p||d[g]!=l[h]||(p=!0);p||d.push(l[h])}return d}return l},e.DOM.filterElementsByClass=function(e,t){for(var n=[],r=0;r<e.length;r++)new RegExp("(^|\\s)"+t+"(\\s|$)").test(e[r].className)&&n.push(e[r]);return n},e.DOM.selectTags=function(e){return document.getElementsByTagName(e)},e.DOM.Event={},e.DOM.Event.add=function(){return window.addEventListener?function(e,t,n){e.addEventListener(t,n,!1)}:window.attachEvent?function(e,t,n){var r=function(){n.call(e,window.event)};e.attachEvent("on"+t,r)}:function(e,t,n){e["on"+t]=n}}(),e.DOM.Event.remove=function(){return window.removeEventListener?function(e,t,n){e.removeEventListener(t,n,!1)}:function(){}}()}(Invoca),function(e){function t(e){var t=/[^\d]/g,n=e.replace(t,"");return n}var n="-",r=" ",o="1",a="0";e.NANP_COUNTRY_CODE=o,e.PhoneNumber=function(i,c){var l=t(c?i:""),u=t(c?c:i),s=c?c:i;if(!l)if(11==u.length&&u.charAt(0)==o)l=o,u=u.substr(1);else if(10==u.length&&u.charAt(0)!=a)l=o;else if("+"==i.charAt(0)||"0"==i.charAt(0)){var f=/[\+|0]([\d]{1,2})[^\d]/g,d=i.match(f);if(d){var h=d[0].replace(/^\s+|\s+$/g,"");l=h.substr(1),u=u.substr(l.length)}else e.log("When prefixing a number with + or 0, include a non digit character after the country code")}l==o&&10!=u.length&&e.log("Invalid number: "+l+", "+s,!0),this.format=function(e,t,o){var a;if(this.isNANP()){a=o||n;var i=u.slice(0,3),c=u.slice(3,6),s=u.slice(6),f=i+a+c+a+s;return e&&(f="1"+a+f),f}return a=o||r,(t&&l?"+"+l+a:"")+u},this.formatFromOriginal=function(e,t){var a="",i=/[\s-]/g,c="";return this.isNANP()?(a=t||n,c=s.replace(i,a),e&&"+"!=c.charAt(0)&&(c=o+a+c)):(a=t||r,c=s.replace(i,a)),c},this.isNANP=function(){return l==o},this.isEmpty=function(){return!u},this.toParam=function(){return l==o?u:"00"+l+u},this.toString=function(){return this.format(!0)},this.countryCode=l,this.nationalNumber=u;var p="([^0-9]{0,10})",g="([([])?";this.to_replacement_regex=function(){var e="";"0"==u.charAt(0)?e+="([([]?0[^0-9]{0,10})?"+g:e="(1[^0-9]{0,10})?"+g+u.charAt(0)+p;for(var t=1;t<u.length;t++)e+=t==u.length-1?u.charAt(t):u.charAt(t)+p;return new RegExp(e,"gi")},this.formatFromOther=function(e,t){var n=t.to_replacement_regex().exec(e);if(null==n)return e;for(var r="",o="0"==u.charAt(0)?1:0,a=1;a<=n.length+1;a++)"undefined"!=typeof n[a]&&(r+=n[a]),a>1&&(r+=u.charAt(o),o++);return r}}}(Invoca),"undefined"==typeof Invoca.PublisherNumberLoader&&(Invoca.PublisherNumberLoader=function(){function e(e,t){return"undefined"==typeof e?t:e}this.campaigns={},this.add_campaign=function(e,t){null!==e&&(this.campaigns[e]=t)},this.init=function(t){var n=t||{};Invoca.debugMode=e(n.debug,!1),Invoca.log("Publisher NumberLoader initializing...");for(var r=this,o=Invoca.DOM.selectElements(Invoca.PublisherNumberLoader.CAMPAIGN_SELECTOR),a=0,i=o.length;i>a;a++)r.add_campaign(r.get_id_from_class_list(o[a].className),{pn:Invoca.DOM.getHTML(Invoca.PublisherNumberLoader.PHONE_NUMBER_SELECTOR,o[a]),mobile:Invoca.DOM.selectElements(Invoca.PublisherNumberLoader.MOBILE_FLAG_SELECTOR,o[a]).length>0});var c={url:window.location.toString(),referer:document.referrer,campaigns:Invoca.JSON.stringify(this.campaigns)};Invoca.log("Getting data from: "+window.location.protocol+Invoca.AffiliateIntegration.URL);var l=new Invoca.JSONP.requestWithLandingPage(window.location.protocol+Invoca.AffiliateIntegration.URL,c,"url",{},null,function(e,t){r.on_response(e,t)});l.get()},this.get_id_from_class_list=function(e){for(var t=e.split(/\s+/),n=0;n<t.length;++n)if(matches=t[n].match(Invoca.PublisherNumberLoader.CAMPAIGN_ID_REGEX))return matches[1];return Invoca.log("No ppc_<id> class found for "+Invoca.PublisherNumberLoader.CAMPAIGN_SELECTOR+" container"),null},this.on_response=function(e){e.error?Invoca.log("Error: "+e.error):(Invoca.log("Inserting numbers on page"),Invoca.log(e.campaigns),this.insert_numbers(e))},this.insert_numbers=function(e){try{var t=e.campaigns,n=Invoca.DOM.selectElements(Invoca.PublisherNumberLoader.CAMPAIGN_SELECTOR),r=e.mobile;for(var o in this.campaigns){var a,i,c,l=t[o].promo_number,u=t[o].click_url,s=Invoca.DOM.filterElementsByClass(n,Invoca.PublisherNumberLoader.CAMPAIGN_ID_PREFIX+o);if(l||Invoca.log("No valid number for "+o),0!=s.length){for(var f=0;f<s.length;f++)if(l&&(c=r&&(a=t[o].cc)&&(i=t[o].national_number)&&Invoca.DOM.selectElements(Invoca.PublisherNumberLoader.DISABLE_TEL_SELECTOR,s[f]).length<=0?'<a href="tel:+'+a+i+'">'+l+"</a>":l,Invoca.DOM.setHTML(c,Invoca.PublisherNumberLoader.PHONE_NUMBER_SELECTOR,s[f]),Invoca.log("Inserting number at "+o+": "+l),c!=l&&Invoca.log("Tel link wrapping number: "+c)),u){var d=Invoca.DOM.selectElements(Invoca.PublisherNumberLoader.LINK_SELECTOR,s[f]);if(d.length>0){for(var h=0;h<d.length;h++)d[h].setAttribute("href",u);Invoca.log("Inserting link at "+o+": "+u)}}}else Invoca.log("Could not find element with class: "+Invoca.PublisherNumberLoader.CAMPAIGN_ID_PREFIX+o)}}catch(p){Invoca.log(p.toString(),!0)}}},Invoca.PublisherNumberLoader.CAMPAIGN_ID_PREFIX="ppc_id_",Invoca.PublisherNumberLoader.CAMPAIGN_ID_REGEX=new RegExp(Invoca.PublisherNumberLoader.CAMPAIGN_ID_PREFIX+"(.*)"),Invoca.PublisherNumberLoader.CAMPAIGN_SELECTOR=".ppc_integration",Invoca.PublisherNumberLoader.PHONE_NUMBER_SELECTOR=".ppc_number",Invoca.PublisherNumberLoader.LINK_SELECTOR=".ppc_link",Invoca.PublisherNumberLoader.MOBILE_FLAG_SELECTOR=".ppc_mobile",Invoca.PublisherNumberLoader.DISABLE_TEL_SELECTOR=".ppc_no_tel",Invoca.affiliate_integration_loader=new Invoca.PublisherNumberLoader);

Invoca.affiliate_integration_loaded = false;

Invoca.onReady( function()
{
    if ( !Invoca.affiliate_integration_loaded && Invoca.affiliate_integration_options )
    {
        Invoca.affiliate_integration_loader.init(Invoca.affiliate_integration_options);
        Invoca.affiliate_integration_loaded = true;
    }
});

var RingRevenue = Invoca;