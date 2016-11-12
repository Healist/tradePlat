$.ajax({
		url: 'http://localhost/tradeplat/api/type/5/1/10000',
		type: 'get',
		dataType: 'json',
		success: function (datas) {
			//美妆衣物
			var recentPublic = new Vue({
				el:"#box1",
				data:datas
			});
		}
});