var ico_wrong_img="<img src='/images/ico_wrong.gif' align='absmiddle' hspace='2'/>";//error msg image
var ico_right_img="<img src='/images/ico_right.gif' align='absmiddle' hspace='2'/>";//right msg image
var ico_loadg_img="<img src='/images/ico_arrow.gif' align='absmiddle' hspace='2'/>";//loadg msg image
var cssFocus="color:#660000";//focus css
var cssError="color:#FC2C11";//error css
var cssRight="color:#318A05";//right css
var VALID_PASS="jpass";
var hasSubmit=false;
/**
  * 按字节长度控制输入内容的函数。主要用于文本框中onKeyUp()事件
  * @param currObj 当前输入内容的表单对象
  * @parm iNum 可以输入的最大内容长度
  */
function setMaxLen(currObj,iNum)
{
    if (length(currObj.value) > iNum)
    {
        currObj.value = subString(currObj.value,iNum);
        currObj.focus();
    }
}
/**
 * 将指定的字符串以指定的长度进行截取并返回
 * @param szValue 要截取的字符串
 * @param iLen 要截取的长度 
 */
function subString(szValue,iLen)
{
    var szObjValue = "";
    var iCount = 0;
    for(i = 0; i < szValue.length; i++)
    {
        var szTmpUn = escape(szValue.charAt(i));
        if (szTmpUn.length >= 6)	//中文
        {
           iCount = iCount + 2;
        }
        else 
        {
            iCount = iCount + 1;
        }
        if (iCount > iLen){break;}
        szObjValue = szObjValue + szValue.charAt(i);
	}
    return szObjValue;
	
}
 /**
 * 验证某一字符串是否为空并提示错误
 * @param checkString 要检查的字段值
 * @return boolean 是否为空（true为空，false不为空）
 */
function isNull(checkString)
{
	if(trim(checkString)!="")
		return false;
	else
		return true;
}
/**
 * 将一字符串去空格处理
 * @param checkString 要去除空格的字符串
 * @return checkString 去除空格后的字符串
 */
function trim(checkString)
{
	if(null == checkString)
		return "";
	else
		return checkString.replace(/(^\s*)|(\s*$)/g, "");
}
/**
 * 检查字符串中是否含有非法字符
 * @param szOriginal 要检查的字符串
 * @return boolean 是否含有非法字符
 */
function hasBadChar(szOriginal)
{
    var szExp = "'\\/?\"<>|";
    if( szOriginal.length <=0 || szExp.length <=0 ) {
        return false;
    }
    for( var counter = 0 ; counter < szExp.length ; counter ++ ){
        curr_char = szExp.charAt(counter);
        if( szOriginal.indexOf( curr_char) >= 0 ){
            return true ;
        }
    }
    return false;
}
/**
 * 取得一字符串的长度值
 * @param checkString 要处理的字符串
 * @return integer 字符串长度
 */
function length(checkString)
{
	if(isNull(checkString))
		return 0;
	var len=0;
    for(var i=0;i<checkString.length;i++)
    {
 		if(!isChinese(checkString.charAt(i)))
 		{
            len+=1;
        }
        else 
        {
            len+=2;
        }
    }
	return len;
}
/**
 * 判断一字符串中是否含有中文字
 * @param checkString 要验证的字符串
 * @return bool 是否含有中文字
 */
function isChinese(checkString)
{
	var ret=false;
    for(var i=0;i<checkString.length;i++)
    {
    	if(checkString.charCodeAt(i)>=256)
    	{
			ret=true;
			break;
    	}
	}
   	return ret;
}
/**
 * 验证某一字符串是否为有效的日期（格式为：2007-12-25或2007/12/25）
 * @param checkString 要检查的字符串
 * @return boolean 是否为有效日期
 */
function isDate(checkString)
{
	var r = trim(checkString).match(/^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2})$/);
	if(r==null)
		return false;
	var d = new Date(r[1], r[3]-1,r[4]);
	return (d.getFullYear()==r[1]&&(d.getMonth()+1)==parseInt(r[3],10)&&d.getDate()==r[4]);
}

/**
 * 支持多个以;号隔开的限制最大长度，是否必须，匹配正则的抽象验证
 * @param checkString 要检查的字符串
 * @param isRequired 是否必须
 * @param maxLength 最大长度 
 * @param regu 正则表达式
 */
function validate(checkString,isRequired,maxLength,regu)
{
	var bChk=isRange(checkString,isRequired,maxLength);
	if(bChk && !isNull(checkString))
	{
		checkString = trim(checkString);
		checkString = quanToBan(checkString);
		var re   = new RegExp(regu);
		if(checkString.indexOf(";")==-1)
		{
			if (checkString.search(re) == -1)
				bChk=false;
		}
		else
		{	
			var strArray=checkString.split(";");
			for(var i=0;i<strArray.length;i++)
			{
				var str=strArray[i];
				if(str.search(re)==-1)
				{
					bChk=false;
					break;
				}
			}
		}
	}
	return bChk;		
}
/**
 * 验证某一字符串是否为正确格式的电话号码(正确格式：0752-2566623或07522566623)支持多个验证
 * 支持多个以;号隔开的电话号码验证
 * @param checkString 要检查的字符串
 * @param isRequired 是否必须
 * @param maxLength 最大长度 
 * @return boolean 是否为正确格式的电话号
 */
function isValidPhone(checkString,isRequired,maxLength) 
{
	var regu = "^([0-9]{3,4}-{1}[0-9]{7,8}(-[0-9]{2,6})?)?$";
	return validate(checkString,isRequired,maxLength,regu);
}
/**
 * 邮件地址格式验证(支持以;号隔开的多个邮件地址验证)
 * @param checkString 要检查的字符串
 * @param isRequired 是否必须
 * @param maxLength 最大长度
 * @return boolean 是否通过验证
 */
function isValidMail(checkString,isRequired,maxLength)
{
	var regu = "^(([0-9a-zA-Z]+)|([0-9a-zA-Z]+[_.0-9a-zA-Z-]*[_.0-9a-zA-Z]+))@([a-zA-Z0-9-]+[.])+(.+)$";
	return validate(checkString,isRequired,maxLength,regu);
}

/**
 * 验证某一字符串是否为正确的手机号码格式(支持以;号隔开的多个手机号码验证)
 * @param checkString 要检查的字符串
 * @param isRequired 是否必须
 * @param maxLength 最大长度
 * @return boolean 是否通过验证
 */
function isValidMobile(checkString,isRequired,maxLength)
{
	var regu="^(1[0-9]{10})?$";
	return validate(checkString,isRequired,maxLength,regu);
}

/**
 * 验证某一字符串是否为正确的邮政编码格式(支持以;号隔开的多个邮政编码验证)
 * @param checkString 要检查的字符串
 * @param isRequired 是否必须
 * @param maxLength 最大长度
 * @return boolean 是否通过验证
 */
function isValidZipCode(checkString,isRequired,maxLength)
{
	var regu="^([1-9][0-9]{5})?$";
	return validate(checkString,isRequired,maxLength,regu);
}

/**
 * 验证某一字符串是否为正确的身份证号码格式(支持以;号隔开的多个身份证号码验证)
 * @param checkString 要检查的字符串
 * @param isRequired 是否必须
 * @param maxLength 最大长度
 * @return boolean 是否通过验证
 */
function isValidID(checkString,isRequired,maxLength)
{
	var regu="^([1-9][0-9]{14}|[1-9][0-9]{17}|[1-9][0-9]{16}x)?$";
	return validate(checkString,isRequired,maxLength,regu);
}

/**
 * 验证某一字符串是否为正确的IP地址格式(支持以;号隔开的多个IP地址验证)
 * @param checkString 要检查的字符串
 * @param isRequired 是否必须
 * @param maxLength 最大长度
 * @return boolean 是否通过验证
 */
function isValidIP(checkString,isRequired,maxLength)
{
	var regu="^(((2[0-4]\\d|25[0-5]|[01]?\\d\\d?)\\.){3}(2[0-4]\\d|25[0-5]|[01]?\\d\\d?))?$";
	return validate(checkString,isRequired,maxLength,regu);
}

/**
 * 验证某一字符串是否为正确的URL地址格式(支持以;号隔开的多个URL地址验证)
 * @param checkString 要检查的字符串
 * @param isRequired 是否必须
 * @param maxLength 最大长度
 * @return boolean 是否通过验证
 */
function isValidURL(checkString,isRequired,maxLength)
{
	var regu="^(http|https|ftp)://([\\w-]+\\.)+[\\w-]+(/[\\w- ./?%&=]*)?$";
	return validate(checkString,isRequired,maxLength,regu);
}

/**
 * 验证某一字符串是否有效的文件路径及名称
 * @param checkString 要检查的字符串
 * @param extensions 允许的扩展名称（例：gif|jpg|png|bmp|jpeg）
 * @param isRequired 是否必须
 * @return boolean 是否正确的文件
 */
function isValidFile(checkString,extensions,isRequired)
{
	var bChk=true;
	if (isRequired) 
	{
		bChk = !isNull(checkString);
	}
	if(bChk)
	{		
		checkString=trim(checkString);
		if(bChk==true && extensions!="")
		{
			var re = new RegExp("\.(" + extensions.replace(/,/gi,"|") + ")$","i");
			if(!re.test(checkString))
			{
				bChk=false;
			}
		}
	}
	return bChk;
}

/**
 * 验证一字符串是否匹配指定的正则表达式
 * @param checkString 要验证的字符串
 * @param isRequired 是否必须不为空
 * @param match 指定的正则表达式
 * @return boolean 验证是否通过
 */
function isMatch(checkString,isRequired,match)
{
	var bChk=true;
	var boolNull=isNull(checkString);
	if (isRequired) 
	{
		bChk = !boolNull;
	}
	if(!boolNull && trim(match)!="")
	{
		var re = new RegExp(match);
		if(checkString.search(re) == -1)
		{
			bChk=false;
		}
	}
	return bChk;
}
/**
 * 验证某一字符串是否为正确的日期格式或有效日期<yyyy-mm-dd>
 * @param checkString 要检查的字符串
 * @param format 指定的日期格式
 * @param isRequired 是否必须输入
 * @return boolean 是正确的有效的日期
 */
function isValidDate(checkString,format,isRequired)
{
	var bChk=true;
	var boolNull=isNull(checkString);
	if (isRequired) 
	{
		bChk = !boolNull;
	}
	if(!boolNull)
	{
		checkString = trim(checkString);
		if(format==montFormat)
		{
			checkString+="-1";
		}
		bChk=isDate(checkString);
		if(bChk==true && format==dateFormat)
		{
			var regu = "^([0-9]{4}-[0-9]{1,2}-[0-9]{1,2})?$";
			var re = new RegExp(regu);
			if(checkString.search(re) == -1)
			{
				bChk=false;
			}
		}
	}
	return bChk;
}

/**
 * 是否正确时间的验证<格式：yyyy-mm-dd hh:mm:ss>
 * @param checkString 要验证的字符串
 * @return true/false 是否正确
 */
function isTime(checkString)
{
	var r = trim(checkString).match("^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{2})[:]{1}([0-9]{2})[:]{1}([0-9]{2})?$");
	//alert(r[1]);//年
	//alert(r[2]);//月
	//alert(r[3]);//日
	//alert(r[4]);//时
	//alert(r[5]);//分
	//alert(r[6]);//秒
	if(r==null)
		return false;
	var d = new Date(r[1], r[2]-1,r[3],r[4],r[5],r[6]);
	//alert(d.getHours()+"==="+parseInt(r[4],10)+"===");
	return (d.getFullYear()==r[1]&&(d.getMonth()+1)==parseInt(r[2],10)&&d.getDate()==r[3] && d.getHours()==parseInt(r[4],10) && d.getMinutes()==parseInt(r[5],10) && d.getSeconds()==parseInt(r[6],10));
}

/**
 * 验证某一字符串是否为正确的日期格式或有效日期<yyyy-mm-dd hh:mm:ss)
 * @param checkString 要检查的字符串
 * @param format 指定的日期格式
 * @param isRequired 是否必须输入
 * @return boolean 是正确的有效的日期
 */
function isValidSecTime(checkString,format,isRequired)
{
	var bChk=true;
	var boolNull=isNull(checkString);
	if (isRequired) 
	{
		bChk = !boolNull;
	}
	if(!boolNull)
	{
		checkString = trim(checkString);
		bChk=isTime(checkString);
		if(bChk==true && format==secdFormat)
		{
			var regu = "^([0-9]{4}-[0-9]{1,2}-[0-9]{1,2}) ([0-9]{2}[:]{1}[0-9]{2}[:]{1}[0-9]{2})?$";
			var re = new RegExp(regu);
			if(checkString.search(re) == -1)
			{
				bChk=false;
			}
		}
	}
	return bChk;
}

/**
 * 是否正确日期的验证<格式：yyyy-mm-dd hh:mm>
 * @param checkString 要验证的字符串
 * @return true/false 是否正确
 */
function isDates(checkString)
{
	var r = trim(checkString).match("^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{2})[:]{1}([0-9]{2})?$");
	//alert(r[1]);//年
	//alert(r[2]);//月
	//alert(r[3]);//日
	//alert(r[4]);//时
	//alert(r[5]);//分
	if(r==null)
		return false;
	var d = new Date(r[1], r[2]-1,r[3],r[4],r[5]);
	//alert(d.getHours()+"==="+parseInt(r[4],10)+"===");
	return (d.getFullYear()==r[1]&&(d.getMonth()+1)==parseInt(r[2],10)&&d.getDate()==r[3] && d.getHours()==parseInt(r[4],10) && d.getMinutes()==parseInt(r[5],10));
}
/**
 * 验证某一字符串是否为正确的日期格式或有效日期<yyyy-mm-dd hh:mm>
 * @param checkString 要检查的字符串
 * @param format 指定的日期格式
 * @param isRequired 是否必须输入
 * @return boolean 是正确的有效的日期
 */
function isValidDates(checkString,format,isRequired)
{
	var bChk=true;
	var boolNull=isNull(checkString);
	if (isRequired) 
	{
		bChk = !boolNull;
	}
	if(!boolNull)
	{
		checkString = trim(checkString);		
		bChk=isDates(checkString);
		//alert(checkString+"==="+bChk+"===");
		if(bChk==true && format==timeFormat)
		{
			var regu = "^([0-9]{4}-[0-9]{1,2}-[0-9]{1,2}) ([0-9]{2}[:]{1}[0-9]{2})?$";
			var re = new RegExp(regu);
			if(checkString.search(re) == -1)
			{
				bChk=false;
			}
		}
	}
	return bChk;
}
/**
 * 验证某一整数是否在指定范围之内
 * @param checkString 要检查的整数
 * @param iMin 最小数值
 * @param iMax 最大数值
 * @param isRequired 是否必须输入
 * @return boolean 是否正确的数字
 */
function isIntRange(checkString,iMin,iMax,isRequired)
{
	var bChk=true;
	var boolNull=isNull(checkString);
	if (isRequired) 
	{
		bChk = !boolNull;
	}
	if(!boolNull)
	{
		bChk=!isNaN(checkString);
		if(bChk==true)
		{
			checkString = trim(checkString);
			//if(iMin!=0 && iMax!=0)
			//{
				iNum=parseInt(checkString);
				if(iNum>iMax || iNum<iMin)
					bChk=false;
			//}
		}
	}
	return bChk;
}
/**
 * 验证某一字符串是否为正确的系统验证码格式
 * @param checkString 要检查的字符串
 * @param isRequired 是否必须输入
 * @param len 验证码长度
 * @return boolean 是否正确的系统验证码
 */
function isValidCode(checkString,isRequired,len)
{
	var bChk=true;
	var boolNull=isNull(checkString);
	if (isRequired) 
	{
		bChk = !boolNull;
	}
	if(!boolNull)
	{
		checkString = trim(checkString);
		var regu="^[a-zA-Z0-9_]{"+len+"}$";	//英文及数字
		var re = new RegExp(regu);
		if(checkString.search(re) == -1)
		{
			bChk=false;
		}
	}
	return bChk;
}
/**
 * 验证某一字符串是否为正确的帐号密码格式
 * @param checkString 要检查的字符串
 * @param isRequired 是否必须输入
 * @param minLen 最小长度
 * @param maxLen 最大长度
 * @return boolean 是否正确的帐号格式
 */
function isValidAccount(checkString,isRequired,minLen,maxLen)
{
	var bChk=true;
	var boolNull=isNull(checkString);
	if (isRequired) 
	{
		bChk = !boolNull;
	}
	if(!boolNull)
	{
		checkString = trim(checkString);
		var regu="^([0-9A-Za-z_.@-]{" + minLen + "," + maxLen + "})?$";
		var re = new RegExp(regu);
		if(checkString.search(re) == -1)
		{
			bChk=false;
		}
	}
	return bChk;
}
/**
 * 普通字符串验证，主要验证是否必须和最大长度
 * @param checkString 要检查的字符串
 * @param isRequired 是否必须
 * @param maxLength 最大长度
 * @return boolean 是否通过验证
 */
function isRange(checkString,isRequired,maxLength)
{
	var bChk=true;
	var boolNull=isNull(checkString);
	if (isRequired) 
		bChk = !boolNull;
	if(!boolNull)
	{
		if(maxLength != 0)	//如果指定maxLength=0，则不验证字符串长度
		{
			checkString = trim(checkString);
			bChk=length(checkString)<=maxLength;
		}
	}
	return bChk;
}

/**
 * 普通字符串验证，主要验证是否必须和长度范围
 * @param checkString 要检查的字符串
 * @param isRequired 是否必须
 * @param minLength 最小长度
 * @param maxLength 最大长度
 * @return boolean 是否通过验证
 */
function isInRange(checkString,isRequired,minLength,maxLength)
{
	var bChk=true;
	var boolNull=isNull(checkString);
	if (isRequired) 
		bChk = !boolNull;
	if(!boolNull)
	{
		if(minLength!=0  && maxLength!=0)//如果指定maxLength=0和minLength=0，则不验证字符串长度
		{
			checkString = trim(checkString);
			var iLen=length(checkString);
			bChk=(iLen>=minLength) && (iLen<=maxLength);
		}
	}
	return bChk;
}

/**
 * 正确格式的日期大小比较
 * @param date1 系统正确格式的日期一(dateFormat或montFormat)
 * @param date2 系统正确格式的日期二(dateFormat或montFormat)
 * @param dateFormat 系统日期格式：dateFormat或montFormat
 * @return boolean true：date1>date2，false：date1<date2
 */
function dateCompare(date1,date2,dateFormat)
{
	if(!isNull(date1) && !isNull(date2))
	{
		date1=date1.replace(/-/gi,"/");
		date2=date2.replace(/-/gi,"/");
		if(dateFormat==montFormat)
		{
			date1=date1+"/01";
			date2=date2+"/01";
			return (new Date(date1)>new Date(date2));
		}
		if(dateFormat==dateFormat)
		{
			return (new Date(date1)>new Date(date2));
		}
	}		
}
/**
 * 将指定字符串的半角内容转为全角内容
 * @param txtstring 要转换的字符串
 * @return string 转换后的内容
 */
function banToQuan(txtstring)
{
	var tmp = "";
	for(var i=0;i<txtstring.length;i++)
	{
		if(txtstring.charCodeAt(i)==32)
		{
			tmp= tmp+ String.fromCharCode(12288);
		}
		if(txtstring.charCodeAt(i)<127)
		{
			tmp=tmp+String.fromCharCode(txtstring.charCodeAt(i)+65248);
		}
	}
	return tmp;
}

/**
 * 将指定字符串的全角内容转为半角内容
 * @param str 要转换的字符串
 * @param string 转换后的字符串
 */
function quanToBan(str)
{
	var tmp = "";
	for(var i=0;i<str.length;i++)
	{
		if(str.charCodeAt(i)>65248&&str.charCodeAt(i)<65375)
		{
			tmp += String.fromCharCode(str.charCodeAt(i)-65248);
		}
		else
		{
			tmp += String.fromCharCode(str.charCodeAt(i));
		}
	}
	return tmp
}
/**
 * 表单验证时得到焦点的处理
 * @param obj 要处理的对象
 * @param msgText 要显示的文字
 */
function objFocus(obj,msgText)
{
	obj.style.cssText=cssFocus;
	obj.innerHTML=msgText;
}
/**
 * 表单验证时失去焦点的处理
 * @param obj 要处理的对象
 * @param bool 检查结果
 * @param rightMsg 通过时的信息
 * @param errMsg 失败时的信息
 */
function objBlur(obj,bool,rightMsg,errMsg)
{
	if(bool)
	{
		obj.style.cssText=cssRight;
		obj.innerHTML=ico_right_img+rightMsg;
	}
	else
	{
		obj.style.cssText=cssError;;
		obj.innerHTML=ico_wrong_img+errMsg;
	}
}