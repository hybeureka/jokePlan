/**
 * 将某一网址设为首页
 * @param url 网址
 */
function setHomePage(url) {
	if (document.all) {
		document.body.style.behavior = "url(#default#homepage)";
		document.body.setHomePage(url);
	} else {
		if (window.sidebar) {
			if (window.netscape) {
				try {
					netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
				}
				catch (e) {
					alert("\u60a8\u76ee\u524d\u4f7f\u7528\u7684\u6d4f\u89c8\u5668\u6ca1\u6709\u542f\u7528\u8be5\u529f\u80fd\uff0c\u5982\u679c\u60a8\u6b63\u5728\u4f7f\u7528FireFox\u6d4f\u89c8\u5668\u5e76\u60f3\u542f\u7528\u8be5\u529f\u80fd\uff0c\u8bf7\u5728\u5730\u5740\u680f\u5185\u8f93\u5165 about:config\uff0c\u5c06\u9879 \"signed.applets.codebase_principal_support\" \u503c\u8bbe\u4e3atrue\uff0c\u518d\u70b9\u51fb\"\u8bbe\u4e3a\u9996\u9875\"\uff01");
				}
			}
			var prefs = Components.classes["@mozilla.org/preferences-service;1"].getService(Components.interfaces.nsIPrefBranch);
			prefs.setCharPref("browser.startup.homepage", url);
		}
	}
}

/**
 * 加入收藏
 */
function addFavorite(sURL, sTitle) {
	try {
		window.external.addFavorite(sURL, sTitle);
	}
	catch (e) {
		try {
			window.sidebar.addPanel(sTitle, sURL, "");
		}
		catch (e) {
		}
	}
}


function initMenu(){
	var nav_id=Cookie.get('nav');
	if(null==nav_id)
		nav_id=1;
	$('#nav_'+nav_id+'').attr("class","a");
}

function setMenu(id){
	var nav_id=Cookie.set('nav',id);
}

/**
 * 红色高亮显示查询关键字(目前主要用于关键字列表查询)
 * @param strx 当前查询的关键字
 * @tagName 列表中可能包含关键字的dom容器
 * @param idName 包含关键字的dom容器的id
 */
function disKeyWord(strx,tagName,idName)
{
	var keyword = strx;
    keyword = keyword.trim();
    if(keyword.length == 0) return;
    var filter = "&nbsp;";
    var arrKeyword = keyword.split(",");
    for(var j = 0; j < arrKeyword.length; j++)
    {
        keyword = arrKeyword[j].trim();
        if(filter.indexOf(keyword) >= 0) break;
        var obj=document.getElementsByTagName(tagName);
        if(obj.length>0)
        {
	        for(var i = 0; i < obj.length; i++)
	        {
	        	if(obj[i].id==idName)
	        	{
	        		obj[i].innerHTML = makeKeyword(obj[i].innerHTML, keyword);
	        	}
	        }
		}
		else
		{
			if(obj.id==idName)
	        {
	        	obj.innerHTML = makeKeyword(obj.innerHTML, keyword);
	        }
		}
    }
}

/**
 * 红色高亮显示查询关键字(目前主要用于关键字列表查询)
 * @param str 可能包含查询关键字的dom容器的innerHTML内容
 * @param keyword 当前查询的关键字
 */
function makeKeyword(str, keyword)
{
	if(s == "") return "";

    var rgExpHtml1 = new RegExp("<", "gi");
    var rgExpHtml2 = new RegExp(">", "gi");
    var rgExpKey = new RegExp(keyword, "gi");
    var replaceText = "<span style=\"color:#FF0000;\">" + keyword + "</span>";

    if(str.search(rgExpHtml1) == -1){
        return str.replace(rgExpKey, replaceText);
    }else{
        var result = "";
        var begin = 0;
        var end = 0;
        var transact = false;
        var s;
        for(var i = 0; i < str.length; i++){
            s = str.charAt(i);

            if(s == '<'){
                end = i;
                result += str.substring(begin, end).replace(rgExpKey, replaceText);
                begin = i;
                end = i;
            }

            if(s == '>'){
                result += str.substring(begin, i + 1);
                begin = i + 1;
                end = i + 1;
            }

        }
        result += str.substring(begin, i + 1).replace(rgExpKey, replaceText);

        return result;
    }
}
$(document).ready(function(){
		//回顶部
		var flhtml ='<div class="floatbar" id="floatbar">';
		if(typeof itemHtml != 'undefined'){
			flhtml += itemHtml;
		}
		flhtml += '<a href="javascript:;" title="收藏" class="quick" id="quick">收藏</a>';
		flhtml += '<a href="javascript:;" class="suggest" >Top</a>';
		flhtml += '<a href="javascript:;" title="回顶部" class="toplink" id="toplink">回顶部</a>';
		flhtml += '</div>';
		$(document.body).prepend(flhtml);
		quickTopLink();
	});
	//回顶部
	function quickTopLink() {
	    //ie6下定位
	    var item = $('#toplink');
	    var ch = document.documentElement.clientHeight || document.body.clientHeight;
	
	    $(window).scroll(function () {
	        var sh = $(window).scrollTop();
	        check(sh);
	        spIe6(sh);
	    });
	
	    function check(sh) {
	        if ($.browser.msie && (parseInt($.browser.version) < 9) && !$.support.style) {
	            sh >= 100 ? item.show() : item.hide();
	        } else {
	            sh >= 100 ? item.fadeIn(250) : item.fadeOut(250);
	        }
	    }
	
	    function spIe6(sh) {
	        if ($.browser.msie && ($.browser.version == "6.0") && !$.support.style) {
	            item.css({ 'top': sh + ch - 150 + 'px', 'bottom': '150px' });
	        }
	    }
		
		$("#toplink").click(function(){$("html, body").animate({scrollTop:0},"slow");})
		$("#quick").click(function(){
			var quick=$("#quickurl").val();
			document.location.href=quick;
		})
	}