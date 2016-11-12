var urlinfo = window.location.href;             
//资源ID                                               
var sourceId = urlinfo.split("?")[1].split("=")[1];  
//回复时的commentId
var CID;
//回复的回复 （此时的回复ID）
var tid;

$(function(){
	
	//解析页面数据
	$.ajax({
		url: 'http://localhost/tradeplat/api/resource/'+sourceId,
		type: 'get',
		dataType: 'json',
		success: function (datas) {
			//商品详情
			var hotIndex = new Vue({
				el:"#box1",
				data:datas
			});
		}
	});

	//提交评论事件绑定
	$(".comment-submit").bind("click",commentSubmit);

})


function commentSubmit(){

	var commentValue = document.getElementById('commentbox').value;
	if(commentValue == "") {
		alert("输入不能为空,请重新提交！");
		return false;
	}
	var commentForm = document.getElementById('myform');
	commentForm.action='./action/action.php?action=comment';
	commentForm.sourceId.value = sourceId;
	commentForm.submit();
}

function replySubmit(type, replyId){

	var replyValue = document.getElementById('replyContent').value;
	if(replyValue == "") {
		alert("输入不能为空,请重新提交！");
		return false;
	}
	var replyForm = document.getElementById('replyForm');
	replyForm.action='./action/action.php?action=reply';
	replyForm.sourceId.value = sourceId;
	replyForm.commentId.value = CID;
	replyForm.to_id.value = replyId;
	replyForm.type.value = type;
	replyForm.submit();
	replyValue = "";
}

function replySubmit2(type){

	var replyValue = document.getElementById('replyContent2').value;
	if(replyValue == "") {
		alert("输入不能为空,请重新提交！");
		return false;
	}
	var replyForm = document.getElementById('replyForm2');
	replyForm.action='./action/action.php?action=reply';
	replyForm.sourceId.value = sourceId;
	replyForm.commentId.value = CID;
	replyForm.to_id.value = tid;
	replyForm.type.value = type;
	replyForm.submit();
	replyValue = "";
}

function modalTrigger(commentId) {
    $('#modal1').openModal();
    CID = commentId;
}

function modalTrigger2(commentId,replyId) {
    $('#modal2').openModal();
    CID  = commentId;
    tid  = replyId;  
}

function doDel(id){
	if(confirm("确定要删除吗？")){
		window.location='./action/action.php?action=del&id='+ id + '&sourceId=' + sourceId;
	}
}

function doDelReply(id){
	if(confirm("确定要删除吗？")){
		window.location='./action/action.php?action=del_reply&id='+id + '&sourceId=' + sourceId;
	}
}