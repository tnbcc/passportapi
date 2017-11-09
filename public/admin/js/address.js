/**
 * YICMS
 * ============================================================================
 * 版权所有 2014-2017 北京智享乐通科技有限公司，并保留所有权利。
 * 网站地址: http://www.haitao360.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Author: kenuo
 * Date: 2017-05-29
 */

// 选择省份弹出市区
function GetProvince() {
	var id = $("#seleAreaNext").find("option:selected").val();
	var selCity = $("#seleAreaThird")[0];
	for (var i = selCity.length - 1; i >= 0; i--) {
		selCity.options[i] = null;
	}
	var opt = new Option("请选择市", "");
	selCity.options.add(opt);
	$.ajax({
		type : "get",
		url : "/api/v1/get-city",
		dataType : "json",
		data : {
			"province_id" : id
		},
		success : function(data) {
			if (data.data != null && data.data.length > 0) {
				for (var i = 0; i < data.data.length; i++) {
					var opt = new Option(data.data[i].city_name,data.data[i].city_id);
					selCity.options.add(opt);
				}
			}
		}
	});
};


// 选择市区弹出区域
function getSelCity() {
	var id = $("#seleAreaThird").find("option:selected").val();
	var selArea = $("#seleAreaFouth")[0];
	for (var i = selArea.length - 1; i >= 0; i--) {
		selArea.options[i] = null;
	}
	var opt = new Option("请选择区县", "");
	selArea.options.add(opt);
	$.ajax({
		type : "get",
		url : "/api/v1/get-district",
		dataType : "json",
		data : {
			"city_id" : id
		},
		success : function(data) {
			if (data.data != null && data.data.length > 0) {
				for (var i = 0; i < data.data.length; i++) {
					var opt = new Option(data.data[i].district_name,data.data[i].district_id);
					selArea.options.add(opt);
				}
			}
		}
	});
}