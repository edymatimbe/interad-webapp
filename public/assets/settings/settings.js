$(document).ready(function () {
	cropImage(
		'image_company',
		'file_image_company',
		'image_data_company',
		'modal-image-company',
		'div-cropper-company',
		95
	)
})

$(document).on('submit', '#form-company', function (e) {
	e.preventDefault();
	$.ajax({
		url: "<?=base_url('company/save')?>",
		
		type: 'POST',
		dataType: "JSON",
		data: new FormData(this),
		cache: false,
		contentType: false,
		processData: false,
		beforeSend:function(){
			show_loader()
		},
		success: function (data) {
			close_loader();
			if (data.status.toString() === 'success') {
				console.log('account: '+data.account)
				show_toast_success(data.message)
				$('#account').html(data.account)
			}
			if (data.status.toString() === 'error') {
				alert(data.message)
			}
			if (data.status.toString() === 'error_validation') {
				setErrorValidation(data)
			}
		},
		error: function (xhr, status, error) {
			close_loader();
			show_toast_error('Error when try save company');
		}
	})

});

$(document).on('click','#btn-change-image',function () {
	$('#image_company').trigger('click')
});



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
//

const topMenu = $("#topMenu");

topMenu.stick_in_parent({
	offset_top: 90
});
topMenu.find('a').click(function () {
	$('html, body').animate({
		scrollTop: $($(this).attr('href')).offset().top - 100
	}, 500);
	return false;
});

var lastId;
// All list items
var scrollItems = topMenu.find("a").map(function () {
	var item = $($(this).attr("href"));
	if (item.length) {
		return item;
	}
});

// // Bind to scroll
$(window).scroll(function () {
	var fromTop = $(this).scrollTop() + topMenu.outerHeight() - 220;
	// Get id of current scroll item
	var cur = scrollItems.map(function () {
		if ($(this).offset().top < fromTop) {
			return this;
		}
	});
	// Get the id of the current element
	cur = cur[cur.length - 1];
	var id = cur && cur.length ? cur[0].id : "";
	if (lastId !== id) {
		lastId = id;
		// Set/remove active class
		topMenu.find("a").removeClass("active").filter("[href='#" + id + "']").addClass("active");
	}
});
