$.ajax({
		url: 'http://localhost/tradeplat/api/type/6/1/10000',
		type: 'get',
		dataType: 'json',
		success: function (datas) {
			//运动棋牌
			var recentPublic = new Vue({
				el:"#box1",
				data:datas
			});
		}
});