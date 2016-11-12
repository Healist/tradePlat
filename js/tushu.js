$.ajax({
		url: 'http://localhost/tradeplat/api/type/4/1/10000',
		type: 'get',
		dataType: 'json',
		success: function (datas) {
			//图书教材
			var recentPublic = new Vue({
				el:"#box1",
				data:datas
			});
		}
});