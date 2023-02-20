"use strict";
var base = "https://localhost/scheduler/";
function qs(val){
	return document.querySelector(val);
}
function qsa(val){
	return document.querySelectorAll(val);
}

//Go back
var back = qs(".go-back");
if(back){
	back.addEventListener('click', function(e){
		window.history.back();
	});
}

//Delete a user
var btnList = qsa('.list-admin .del-btn');
if(btnList.length > 0){
	Array.prototype.forEach.call(btnList, function(a, i){
		var attr = btnList[i].getAttribute("value");
	
		btnList[i].addEventListener('click', function(e){
			if(confirm("Are you sure you want to delete user?")){
				window.location.assign(base+"delete-admin?id="+attr);
			}
		});
	});
}

//Delete a course
var courseBtn = qsa('.registered-courses .del-btn');
if(courseBtn.length > 0){
	Array.prototype.forEach.call(courseBtn, function(a, i){
		var attri = courseBtn[i].getAttribute("value");
	
		courseBtn[i].addEventListener('click', function(e){
			if(confirm("Are you sure you want to delete course?")){
				window.location.assign(base+"delete-course?id="+attri);
			}
		});
	});
}