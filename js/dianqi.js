$.ajax({
		url: 'http://localhost/tradeplat/api/type/3/1/10000',
		type: 'get',
		dataType: 'json',
		success: function (datas) {
			//日用电器
			var recentPublic = new Vue({
				el:"#box1",
				data:datas
			});
		}
});