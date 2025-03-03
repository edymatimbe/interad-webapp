
function setCookie(cname, cvalue, exdays) {
	const d = new Date();
	d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	const expires = "expires=" + d.toGMTString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
	let name = cname + "=";
	let decodedCookie = decodeURIComponent(document.cookie);
	let ca = decodedCookie.split(';');
	for (let i = 0; i < ca.length; i++) {
		let c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}



function activeOrNot(id) {
	$('#btn-submit-' + id).trigger('click')
}

function submitForm() {
	$('#new-submit').trigger('click');
}

function formatValue(value) {
	return value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,').replace(/.([^.]*)$/, '.$1')
}

function performClick(elemId) {
	const elem = document.getElementById(elemId);
	if (elem && document.createEvent) {
		const evt = document.createEvent("MouseEvents");
		evt.initEvent("click", true, false);
		elem.dispatchEvent(evt);
	}
}

function cropImage(image_element, input_file, image_data, modal, div_cropper, height, width = null) {
	$(document).on('click', '#' + image_element, function () {
		if (!$("#" + input_file).val()) {
			performClick(input_file);
		}
		$('#' + modal).modal('show');
	});
	let c_height = 250;
	let c_width = 250;
	if (height) {
		c_height = height
		console.log('new height: ' + c_height)
	}

	if (width) {
		c_width = width
	}

	//crop de logo
	const cropper = $('#' + div_cropper);
	const imageCrop = cropper.croppie('destroy').croppie({
		enableExif: true,
		viewport: {
			width: c_width,
			height: c_height
		},
		boundary: {
			width: 100,
			height: 80
		}
	});

	const fileReader = new FileReader();

	$(document).on('change', '#' + input_file, function () {
		fileReader.onload = function (e) {
			imageCrop.croppie('bind', {
				url: e.target.result,
			})
		};
		fileReader.readAsDataURL(this.files[0]);
	});

	const btn_crop = 'btn-crop-' + image_element;
	cropper.find('.cr-slider-wrap').addClass('w-100 d-flex justify-content-center').prepend(
		'<label for="' + input_file + '" id="lb-' + input_file + '" class="btn btn-sm btn-secondary mr-1 text-nowrap">' +
		'<i class="fa fa-upload">&nbsp;</i>Selecionar</label>'
	).append(
		'<label id="' + btn_crop + '" class="btn btn-sm btn-success ml-sm-2 text-nowrap">' +
		'<i class="fa fa-check">&nbsp;</i>Salvar</label>'
	);

	$('#' + btn_crop).on('click', function () {
		imageCrop.croppie('result', {
			type: 'canvas',
			size: 'viewport'
		}).then(function (resp) {
			document.getElementById(image_element).src = resp;
			$('#' + image_data).val(resp);
			$('#' + modal).modal('toggle');
		})
	});
}

function cropImage_(image_element, input_file, image_data, modal_cropper, div_cropper) {
	$('#' + input_file).val('');
	$('#' + image_data).val('');
	const modal = $('#' + modal_cropper);
	$(document).on('click', '#' + image_element, function () {
		if (!$("#" + input_file).val()) {
			performClick(input_file);
		} else {
			modal.modal('show');
		}
	});

	const cropper = $('#' + div_cropper);
	let imageCrop = cropper.croppie('destroy').croppie({
		enableExif: true,
		viewport: {
			width: 230,
			height: 230
		},
		boundary: {
			width: 100,
			height: 80
		}
	});
	const fileReader = new FileReader();
	let selectedFile = null;
	let changed = false;

	$(document).on('change', '#' + input_file, function () {
		fileReader.onload = function (e) {
			imageCrop.croppie('bind', {
				url: e.target.result,
			})
		};
		selectedFile = this.files[0];
		if ((modal.data('bs.modal') || {})._isShown) {
			modal.modal('hide');
			changed = true
		} else {
			modal.modal('show');
		}
	});

	modal.on("shown.bs.modal", function () {
		if (document.getElementById(input_file).files.length > 0) {
			console.log('file selected')
			fileReader.readAsDataURL(selectedFile);
		}
	}).on('hidden.bs.modal', function (e) {
		if (changed) {
			modal.modal('show');
			changed = false;
		}
	})

	const btn_crop = 'btn-crop-' + image_element;
	cropper.find('.cr-slider-wrap').addClass('w-100 d-flex justify-content-center').prepend(
		'<label for="' + input_file + '" id="lb-' + input_file + '" class="btn btn-sm btn-secondary mr-1 text-nowrap">' +
		'<i class="fa fa-upload">&nbsp;</i>Choose</label>'
	).append(
		'<label id="' + btn_crop + '" class="btn btn-sm btn-success ml-sm-2 text-nowrap">' +
		'<i class="fa fa-check">&nbsp;</i>Save</label>'
	);

	$('#' + btn_crop).on('click', function () {
		imageCrop.croppie('result', {
			type: 'canvas',
			size: 'viewport'
		}).then(function (resp) {
			document.getElementById(image_element).src = resp;
			$('#' + image_data).val(resp);
			modal.modal('hide');
		})
	});
}

$(document).on('change', '.toggle-switch', function () {
	const id = $(this).data('id');
	const active = $(this).val();
	const table = $(this).data('table');
	console.log('table: ' + table);
	$.ajax({
		type: 'POST',
		dataType: "JSON",
		url: 'base/activeOrNot_ajax',
		data: { 'id': id, 'active': active, 'table': table },
		success: function (data) {
			if (data.ok) {
				show_toast_success(data.message);
				getAllData() // all
			}
		},
		error: function (data) {
			console.log('error: ' + data)
		}
	});
});

function removeCard(cardID) {
	const card = $('#' + cardID);
	card.addClass("anim-close-card"), card.animate({ "margin-bottom": "0" }),
		setTimeout(function () {
			card.children(".card-block").slideToggle(),
				card.children(".card-body").slideToggle(),
				card.children(".card-header").slideToggle(),
				card.children(".card-footer").slideToggle()
		}, 300), setTimeout(function () {
			card.remove()
		}, 400)
}

function setFullHeight(elementID, decrease) {
	const element = $(elementID);
	const offsetTopCart = element.offset().top;
	const height = $(window).height() - offsetTopCart - decrease
	element.css('height', height + 'px')
}

function number_format(number, decimals, dec_point, thousands_sep) {
	// *     example: number_format(1234.56, 2, ',', ' ');
	// *     return: '1 234,56'
	number = (number + '').replace(',', '').replace(' ', '');
	var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function (n, prec) {
			var k = Math.pow(10, prec);
			return '' + Math.round(n * k) / k;
		};
	// Fix for IE parseFloat(0.55).toFixed(0) = 0;
	s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
	if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	}
	if ((s[1] || '').length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1).join('0');
	}
	return s.join(dec);
}
function checkInput(input, msg) {
	if (!input.val()) {
		// show_toast_warning(msg)
		input.on('focusin', function () {
			input.removeClass('border-danger');
		});
		input.addClass('border-danger');
		return false
	} else {
		return true
	}
}

function scrollDiv(div) {
	$('html, body').stop().animate({
		scrollTop: $('#' + div).offset().top - 110
	}, 900, 'swing');
}
function setUpDualBox(box, label) {
	$('.' + box).find('input').removeClass('form-control').addClass('form-control-bs f-s-12 mb-2 d-none');
	$('.' + box).find('.info').after('' +
		'<div class="inputBox no-icon form-group mb-0">\n' +
		'<input id="form-' + box + '" type="text"  class="f-s-12">\n' +
		'<label for="form-' + box + '">' + label + '</label>\n' +
		'</div>');

	$('#form-' + box).on('input', function () {
		$('.' + box).find('input.filter').val($(this).val()).trigger('change')
	});
	$('.' + box).find('select').addClass('mb-4')

	// setFullHeight('#form-'+box,0);
}
function formatDateByPicker(date) {
	const day = date[0];
	const m = date[1];
	const y = date[2];
	return y + '-' + m + '-' + day;
}

sethrefs = function () {

	if (document.querySelectorAll) {

		var datahrefs = document.querySelectorAll('[data-href]'),
			dhcount = datahrefs.length;

		while (dhcount-- > 0) {

			var ele = datahrefs[dhcount],
				addevent = function (ele, event, func) {

					if (ele.addEventListener) ele.addEventListener(event, link, false);
					else ele.attachEvent('on' + event, link);

				},
				link = function (event) {

					var target = event.target,
						url = this.getAttribute('data-href');

					if (!target.href) {

						var newevent = document.createEvent("MouseEvents");

						if (newevent.initMouseEvent) {

							var newlink = document.createElement("a");

							newlink.setAttribute('href', url);
							newlink.innerHTML = 'link event';

							newevent.initMouseEvent(event.type, true, false, window, event.detail, event.screenX, event.screenY, event.clientX, event.clientY, event.ctrlKey, event.altKey, event.shiftKey, event.metaKey, event.button, null);

							newlink.dispatchEvent(newevent);

						} else {

							var meta = (event.metaKey) ? '_self' : '_blank';

							window.open(url, meta);

						}

					}

				};

			addevent(ele, 'click', link);

		}

	}

};

sethrefs();