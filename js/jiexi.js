$.ajax({
		url: 'http://localhost/tradeplat/api/source/1/6',
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


$.ajax({
		url: 'http://localhost/tradePlat/api/type/1/1/9',
		type: 'get',
		dataType: 'json',
		success: function (datas) {
			//闲置数码
			var hotIndex = new Vue({
				el:"#box2",
				data:datas
			});
		}
});


$.ajax({
		url: 'http://localhost/tradePlat/api/type/2/1/9',
		type: 'get',
		dataType: 'json',
		success: function (datas) {
			//校园代步
			var hotIndex = new Vue({
				el:"#box3",
				data:datas
			});
		}
});

$.ajax({
		url: 'http://localhost/tradePlat/api/type/3/1/9',
		type: 'get',
		dataType: 'json',
		success: function (datas) {
			//电器日用
			var hotIndex = new Vue({
				el:"#box4",
				data:datas
			});
		}
});

$.ajax({
		url: 'http://localhost/tradePlat/api/type/4/1/9',
		type: 'get',
		dataType: 'json',
		success: function (datas) {
			//图书教材
			var hotIndex = new Vue({
				el:"#box5",
				data:datas
			});
		}
});


$.ajax({
		url: 'http://localhost/tradePlat/api/type/5/1/9',
		type: 'get',
		dataType: 'json',
		success: function (datas) {
			//美妆衣物
			var hotIndex = new Vue({
				el:"#box6",
				data:datas
			});
		}
});


$.ajax({
		url: 'http://localhost/tradePlat/api/type/6/1/9',
		type: 'get',
		dataType: 'json',
		success: function (datas) {
			//运动棋牌
			var hotIndex = new Vue({
				el:"#box7",
				data:datas
			});
		}
});


$.ajax({
		url: 'http://localhost/tradePlat/api/type/7/1/9',
		type: 'get',
		dataType: 'json',
		success: function (datas) {
			//杂物
			var hotIndex = new Vue({
				el:"#box8",
				data:datas
			});
		}
});