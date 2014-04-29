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