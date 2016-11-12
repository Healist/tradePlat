$.ajax({
		url: 'http://localhost/tradeplat/api/source/1/1000/',
		type: 'get',
		dataType: 'json',
		success: function (datas) {
			//首页热门
			var hotIndex = new Vue({
				el:"#box1",
				data:datas
			});
		}
});

