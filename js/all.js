$.ajax({
		url: 'http://localhost/tradeplat/api/source/1/10000',
		type: 'get',
		dataType: 'json',
		success: function (datas) {
			//最新发布
			var recentPublic = new Vue({
				el:"#box1",
				data:datas
			});
		}
});