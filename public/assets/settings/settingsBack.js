let base64;
let elementIframe;
$(document).ready(function () {
	// $('#card-general a').addClass('py-3')
	// $('#card-general i').addClass('mr-3')
	// window.print();
	// alert()
	// $('#btnShow').on('click',function () {
	//
	// });
	// $.ajax({
	// 	type: 'GET',
	// 	url: 'getPDF',
	// 	success: function (data) {
	// 		console.log(data)
	// 		try {
	// 			// base64 = btoa(atob(data));
	//
	// 			// $('#dialog').html(data)
	// 			// printJS({
	// 			// 	printable: 'dialog',
	// 			// 	type: 'html',
	// 			// })
	// 			// $('#dialog').addClass('d-none')
	// 			// printJS({
	// 			// 	printable: data,
	// 			// 	type: 'pdf',
	// 			// 	base64: true
	// 			// })
	// 		} catch (err) {
	// 			console.log('error')
	// 		}
	// 	}, error: function () {
	// 		alert('error')
	// 	}
	// });

	// $("#card-general").stick_in_parent({
	// 	offset_top: 120
	// });
});



// $(".stickyside").stick_in_parent({
// 	offset_top: 100
// });
// $('#card-general a').click(function() {
// 	$('html, body').animate({
// 		scrollTop: $($(this).attr('href')).offset().top - 100
// 	}, 500);
// 	return false;
// });
// This is auto select left sidebar
// Cache selectors
// Cache selectors
// var lastId,
// 	// topMenu = $(".stickyside"),
// 	topMenu = $("#card-general"),
// 	topMenuHeight = topMenu.outerHeight(),
// 	// All list items
// 	menuItems = topMenu.find("a"),
// 	// Anchors corresponding to menu items
// 	scrollItems = menuItems.map(function() {
// 		var item = $($(this).attr("href"));
// 		if (item.length) {
// 			return item;
// 		}
// 	});
//
// // Bind click handler to menu items
//
//
// // Bind to scroll
// $(window).scroll(function() {
// 	// Get container scroll position
// 	var fromTop = $(this).scrollTop() + topMenuHeight - 250;
//
// 	// Get id of current scroll item
// 	var cur = scrollItems.map(function() {
// 		if ($(this).offset().top < fromTop)
// 			return this;
// 	});
// 	// Get the id of the current element
// 	cur = cur[cur.length - 1];
// 	var id = cur && cur.length ? cur[0].id : "";
//
// 	if (lastId !== id) {
// 		lastId = id;
// 		// Set/remove active class
// 		menuItems
// 			.removeClass("active")
// 			.filter("[href='#" + id + "']").addClass("active");
// 	}
// });
$('#slimtest1').slimScroll({
	height: '850px'
});

$(".stickyside").stick_in_parent({
	offset_top: 90
});
$('.stickyside a').click(function() {
	$('html, body').animate({
		scrollTop: $($(this).attr('href')).offset().top - 100
	}, 500);
	// $('#slimtest1').animate({
	// 	scrollTop: $($(this).attr('href')).offset().top
	// }, 500);
	// const div = $('')

	// $('#slimtest1').slimScroll({
	// 	start: $($(this).attr('href')),
	// });
	// $('#slimtest1').slimScroll().bind('slimscroll', function(e, pos){
	// 	console.log("Reached " + pos+"");
	// });
	// $('#slimtest1').slimScroll({ scrollTo: $($(this).attr('href')).offset().top-120+'px' });
	// $('#slimtest1').slimScroll({ scrollTo: $($(this).attr('href')).offset().top+'px' });

	// const obj =  $($(this).attr('href'));
	// var childPos = obj.offset();
	// var parentPos = obj.parent().offset();
	// // var childOffset = {
	// // 	top: childPos.top - parentPos.top,
	// // 	left: childPos.left - parentPos.left
	// // }
	// const s =(childPos.top - parentPos.top) - parentPos.top;
	// // console.log('parentPos: '+parentPos.top);
	// // console.log('S: '+s);
	// $('#slimtest1').slimScroll({ scrollTo: s+'px' });

	return false;
});
// This is auto select left sidebar
// Cache selectors
// Cache selectors
var lastId,
	topMenu = $(".stickyside"),
	topMenuHeight = topMenu.outerHeight(),
	// All list items
	menuItems = topMenu.find("a"),
	// Anchors corresponding to menu items
	scrollItems = menuItems.map(function() {
		var item = $($(this).attr("href"));
		if (item.length) {
			return item;
		}
	});

// Bind click handler to menu items


// Bind to scroll
$(window).scroll(function() {
// $('#slimtest1').scroll(function() {
	// Get container scroll position
	var fromTop = $(this).scrollTop() + topMenuHeight - 250;
	// var fromTop = $(this).scrollTop() + topMenuHeight - 50;

	// Get id of current scroll item
	var cur = scrollItems.map(function() {
		if ($(this).offset().top < fromTop)
			return this;
	});
	// Get the id of the current element
	cur = cur[cur.length - 1];
	var id = cur && cur.length ? cur[0].id : "";

	if (lastId !== id) {
		lastId = id;
		// Set/remove active class
		menuItems
			.removeClass("active")
			.filter("[href='#" + id + "']").addClass("active");
	}
});
