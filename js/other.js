$.ajax({
		url: 'http://localhost/tradeplat/api/type/7/1/10000',
		type: 'get',
		dataType: 'json',
		success: function (datas) {
			//杂物
			var recentPublic = new Vue({
				el:"#box1",
				data:datas
			});
		}
});