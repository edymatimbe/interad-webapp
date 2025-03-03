$(document).ready(function () {

	$("#select-supplier").select2({
		"language": {
			"noResults": function () {
				return "Sem resultado encontrado";
			}
		}
	}).on('select2:select', function (e) {
		setCookie('supplier',e.params.data.id)
	});
});

function setCookie(key,value) {
	$.ajax({
		type: 'POST',
		data: {key: key, value:value},
		url: baseURL+'purchase/setCookie',
		success: function (data) {
			if(key.toString() === 'supplier'){
				get_listed_products();
			}
		}
	})
}

$(document).on('input', '#cost_price', function () {
	calculate(1);
});
$(document).on('input', '#mark_up', function () {
	calculate(1);
});
$(document).on('input', '#profit', function () {
	calculate(2);
});
$(document).on('input', '#price_inc_tax', function () {
	// calculate_inverse();
});

function calculate(number) {
	const cost_price = $('#cost_price').val();
	let mark_up = $('#mark_up').val();
	const price_EX = $('#price_ex_tax');
	const profitElement = $('#profit');

	if (cost_price) {
		if (!mark_up) {
			mark_up = 0
		}

		if (number === 1) {
			const price_ex_tax = parseFloat(cost_price) + (parseFloat(cost_price) * (parseFloat(mark_up) / 100));
			const price_ex_tax_fixed = parseFloat(price_ex_tax.toFixed(2));
			price_EX.val(price_ex_tax_fixed);
			// $('#price_inc_tax').val(Math.round(price_ex_tax_fixed + price_ex_tax_fixed * 0.16).toFixed(2));
			$('#price_inc_tax').val((price_ex_tax_fixed + price_ex_tax_fixed * 0.16).toFixed(2));
			const lucro = price_ex_tax - parseFloat(cost_price);
			profitElement.val(lucro.toFixed(2))
		} else {
			const profit = profitElement.val();
			const price_EXF = parseFloat(cost_price)+parseFloat(profit);
			if (price_EXF >= parseFloat(cost_price)) {
				$('#price_ex_tax').val(price_EXF.toFixed(2));
				// $('#price_inc_tax').val(Math.round(price_EXF + price_EXF * 0.16).toFixed(2));
				$('#price_inc_tax').val((price_EXF + price_EXF * 0.16).toFixed(2));

				const real_profit = price_EXF - parseFloat(cost_price);
				mark_up = real_profit * 100 / parseFloat(cost_price);
				$('#mark_up').val(mark_up.toFixed(2))
			}
			if(!profit){
				price_EX.val('');
				$('#mark_up').val('');
				$('#price_inc_tax').val('')
			}
		}
		// $('#price_ex_tax').val(Math.round(price_ex_tax_fixed));
		// $('#price_inc_tax').val(Math.round(price_ex_tax_fixed+price_ex_tax_fixed* 0.16))

	} else {
		price_EX.val('');
		$('#price_inc_tax').val('')
	}
}
