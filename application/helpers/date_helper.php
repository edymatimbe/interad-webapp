<?php


defined('BASEPATH') or exit('Ação não permitida');

function formatDateTimeToRelative($dateTime) {
    $dateTime = new DateTime($dateTime);
    $now = new DateTime();

    $diff = $now->diff($dateTime);
    $diffDays = (int)$diff->format("%r%a");
    $diffHours = (int)$diff->format("%r%h");
    $diffMinutes = (int)$diff->format("%r%i");
    $diffMonths = (int)$diff->format("%r%m");

    if ($diffMinutes >= 1 && $diffMinutes < 60) {
        return "há " . $diffMinutes . " min";
    } elseif ($diffHours >= 1 && $diffHours < 24) {
        $minutesRemaining = $diffMinutes % 60;
        return "há " . $diffHours . " hora" . ($diffHours > 1 ? "s" : "") . ($minutesRemaining > 0 ? " e " . $minutesRemaining . " min" : "");
    } elseif ($diffDays === 0) {
        return "hoje às " . $dateTime->format('H:i');
    } elseif ($diffDays === -1) {
        return "ontem às " . $dateTime->format('H:i');
    } elseif ($diffDays < -1 && $diffDays >= -6) {
        return "há " . abs($diffDays) . " dias";
    } elseif ($diffDays < -6 && $diffDays >= -13) {
        return "há uma semana";
    } elseif ($diffDays < -13 && $diffDays >= -30) {
        return "há duas semanas";
    } elseif ($diffMonths === -1) {
        return "há um mês";
    } elseif ($diffMonths < -1) {
        return "há " . abs($diffMonths) . " meses";
    } else {
        return $dateTime->format('d/m/Y \à\s H:i');
    }
}

function formata_data_banco_com_hora($string)
{

	$dia_sem = date('w', strtotime($string));

	if ($dia_sem == 0) {
		$semana = "Domingo";
	} elseif ($dia_sem == 1) {
		$semana = "Segunda-feira";
	} elseif ($dia_sem == 2) {
		$semana = "Terça-feira";
	} elseif ($dia_sem == 3) {
		$semana = "Quarta-feira";
	} elseif ($dia_sem == 4) {
		$semana = "Quinta-feira";
	} elseif ($dia_sem == 5) {
		$semana = "Sexta-feira";
	} else {
		$semana = "Sábado";
	}

	$dia = date('d', strtotime($string));

	$mes_num = date('m', strtotime($string));

	$ano = date('Y', strtotime($string));
	$hora = date('H:i', strtotime($string));

	return $dia . '/' . $mes_num . '/' . $ano . ' ' . $hora;
}

function formata_data_banco_sem_hora($string)
{

	$dia_sem = date('w', strtotime($string));

	if ($dia_sem == 0) {
		$semana = "Domingo";
	} elseif ($dia_sem == 1) {
		$semana = "Segunda-feira";
	} elseif ($dia_sem == 2) {
		$semana = "Terça-feira";
	} elseif ($dia_sem == 3) {
		$semana = "Quarta-feira";
	} elseif ($dia_sem == 4) {
		$semana = "Quinta-feira";
	} elseif ($dia_sem == 5) {
		$semana = "Sexta-feira";
	} else {
		$semana = "Sábado";
	}

	$dia = date('d', strtotime($string));

	$mes_num = date('m', strtotime($string));

	$ano = date('Y', strtotime($string));
	$hora = date('H:i', strtotime($string));

	return $dia . '/' . $mes_num . '/' . $ano;
}

function days_of_week()
{
	return [
		['id' => '0', 'text' => 'Domingo', 'text_sm' => 'Dom', 'text_long' => 'Domingo'],
		['id' => '1', 'text' => 'Segunda', 'text_sm' => 'Seg', 'text_long' => 'Segunda-feira'],
		['id' => '2', 'text' => 'Terça', 'text_sm' => 'Ter', 'text_long' => 'Terça-feira'],
		['id' => '3', 'text' => 'Quarta', 'text_sm' => 'Qua', 'text_long' => 'Quarta-feira'],
		['id' => '4', 'text' => 'Quinta', 'text_sm' => 'Qui', 'text_long' => 'Quinta-feira'],
		['id' => '5', 'text' => 'Sexta', 'text_sm' => 'Sex', 'text_long' => 'Sexta-feira'],
		['id' => '6', 'text' => 'Sábado', 'text_sm' => 'Sab', 'text_long' => 'Sábado']
	];
}

function day_of_week($date)
{
	$day = date('w', strtotime($date));
	return days_of_week()[$day];
}

function date_from_am_pm($date_time)
{
	$explode = explode(' ', $date_time);

	if (count($explode) == 3) {
		$date_from_format = DateTime::createFromFormat('d/m/Y H:i A', $date_time);
	} else {
		$date_from_format = DateTime::createFromFormat('d/m/Y H:i', $date_time);
	}
	return $date_from_format->format('Y-m-d H:i:s');
}

function years_old($birth_date)
{
	$year_old = intval(date('Y')) - intval(date_format(date_create($birth_date), 'Y'));
	return intval(date('m')) < intval(date_format(date_create($birth_date), 'm')) ? $year_old - 1 : $year_old;
}

function is_saturday($date)
{
	return simple_date($date, 'w') == '6' ? true : false;
}

//date 2022-11-21 12:45
function set_time_out($date)
{
	$time_in_no_time = explode(' ', $date)[0];
	$time_out = is_saturday($date) ? $time_in_no_time . ' 13:00' : $time_in_no_time . ' ' . get_setting()->time_out;
	return $time_out;
}

function simple_date($date, $format = null)
{
	if ($format) {
		return date_format(date_create($date), $format);
	} else {
		return date_format(date_create($date), 'd/m/Y');
	}
}

function simple_time($date)
{
	return date_format(date_create($date), 'H:i');
}

function simple_Year($date)
{
	return date_format(date_create($date), 'Y');
}

function month_name($date)
{
	return get_month(date_format(date_create($date), 'm'));
}

function month_number($date)
{
	return date_format(date_create($date), 'm');
}

function get_month_by_number($number)
{
	switch ($number) {
		case 1:
			return 'Janeiro';
		case 2:
			return 'Fevereiro';
		case 3:
			return 'Março';
		case 4:
			return 'Abril';
		case 5:
			return 'Maio';
		case 6:
			return 'Junho';
		case 7:
			return 'Julho';
		case 8:
			return 'Agosto';
		case 9:
			return 'Setembro';
		case 10:
			return 'Outubro';
		case 11:
			return 'Novembro';
		case 12:
			return 'Dezembro';
		default:
			return '';
	}
}

function get_month($number)
{
	switch ($number) {
		case '01':
			return 'Janeiro';
		case '02':
			return 'Fevereiro';
		case '03':
			return 'Março';
		case '04':
			return 'Abril';
		case '05':
			return 'Maio';
		case '06':
			return 'Junho';
		case '07':
			return 'Julho';
		case '08':
			return 'Agosto';
		case '09':
			return 'Setembro';
		case '10':
			return 'Outubro';
		case '11':
			return 'Novembro';
		case '12':
			return 'Dezembro';
		default:
			return '';
	}
}

function months_name()
{
	return ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
}

function get_years()
{
	$months_array = array();
	//    foreach (get_all('salary_processing', null, ['year_month', 'ASC'], 'year') as $key => $item) {
	foreach (get_all('presence', null, ['year_month', 'ASC'], 'year') as $key => $item) {
		array_push($months_array, $item->year);
	}
	return $months_array;
}

function get_months()
{
	$months_array = array();
	foreach (months_name() as $key => $month_name) {
		$month = ['id' => $key + 1, 'name' => $month_name];
		array_push($months_array, $month);
	}
	return $months_array;
}

function get_time_worked_db()
{
	$time_in = date_format(date_create('10/10/2022 ' . get_setting()->time_in), 'd/m/Y H:i:s');
	$time_out = date_format(date_create('10/10/2022 ' . get_setting()->time_out), 'd/m/Y H:i:s');
	return get_sum_dates($time_in, $time_out, true, true, 1);
}

function get_time_worked_db_saturday()
{
	$time_in = date_format(date_create('10/10/2022 ' . get_setting()->time_in_saturday), 'd/m/Y H:i:s');
	$time_out = date_format(date_create('10/10/2022 ' . get_setting()->time_out_saturday), 'd/m/Y H:i:s');
	return get_sum_dates($time_in, $time_out, true, true);
}

function get_time_lunch_db()
{
	$time_in = date_format(date_create('10/10/2022 ' . get_setting()->interval_begin), 'd/m/Y H:i:s');
	$time_out = date_format(date_create('10/10/2022 ' . get_setting()->interval_end), 'd/m/Y H:i:s');
	return get_sum_dates($time_in, $time_out, true, true);
}

//date_one =
function get_sum_dates($date_one, $date_two, $sub = false, $formatted = true, $sub_value = null)
{
	$time1 = strtotime($date_one . 'Z', 0);
	$time2 = strtotime($date_two . 'Z', 0);
	$sum_time = $time1 + $time2;
	if ($sub) {
		$sum_time = $time2 - $time1;
	}
	$hours = $sum_time / 3600;
	if ($sub_value) {
		$hours -= $sub_value;
	}
	$minutes = ($sum_time % 3600) / 60;

	//    if(simple_date($date_two))
	//    $time_rs = sprintf("%d:%d", $hours, $minutes);
	$time_rs = sprintf("%02d:%02d", $hours, $minutes);
	if ($formatted) {
		return $time_rs;
	} else {
		$time_rs_ex = explode(':', $time_rs);
		return ['hours' => $time_rs_ex[0], 'minutes' => $time_rs_ex[1]];
	}
}

function sum_times($times)
{
	$minutes = 0;
	foreach ($times as $time) {
		list($hour, $minute) = explode(':', $time);
		$minutes += $hour * 60;
		$minutes += $minute;
	}

	$hours = floor($minutes / 60);
	$minutes -= $hours * 60;

	// returns the time already formatted
	return sprintf('%02d:%02d', $hours, $minutes);
}
function sum_times_over($times)
{
	$minutes = 0;
	foreach ($times as $time) {
		list($hour, $minute) = explode(':', $time);
		$minutes += abs($hour) * 60;
		$minutes += abs($minute);
	}

	$hours = floor($minutes / 60);
	$minutes -= $hours * 60;

	// returns the time already formatted
	return sprintf('%02d:%02d', $hours, $minutes);
}

function get_time_worked($date_in, $date_out)
{
	try {
		$date_one = new DateTime($date_in);
		$date_two = new DateTime($date_out);

		if (!(simple_date($date_in, 'w') == 6)) {
			$explode = explode(':', get_time_lunch_db());
			$hours = trim($explode[0]);
			$minutes = trim($explode[1]);
			$to_sub = new DateInterval('PT' . $hours . 'H' . $minutes . 'M');
			$date_two = $date_two->sub($to_sub);
		}

		if (is_same_day($date_in, $date_out)) {
			$interval = date_diff($date_one, $date_two);
			return $interval->format('%h:%i');
		} else {
			return false;
		}
	} catch (Exception $e) {
		return false;
	}
}

//function thar return all time worked by employee
function get_total_time_worked($data, $is_tardiness = null)
{
	$array_time_worked = array();
	$array_time_tardiness = array();
	foreach ($data as $key => $datum) {
		if (isset($datum['in']) && isset($datum['out'])) {
			$time_worked = get_time_worked($datum['in'], $datum['out']);
			if ($time_worked) {
				array_push($array_time_worked, $time_worked); // presences

				$time_worked_tardiness = get_sum_dates($time_worked, get_time_worked_db(), true); //tardiness
				array_push($array_time_tardiness, $time_worked_tardiness);
			}
		}
	}

	$switch_array = ($is_tardiness) ? $array_time_tardiness : $array_time_worked;
	$sum_time = 0;
	$days = 0;
	foreach ($switch_array as $key => $item) {
		$time = strtotime($item . 'Z', 0);
		if ($time) {
			$sum_time += $time;
			$days += 1;
		}
	}
	$hours = $sum_time / 3600;
	$minutes = ($sum_time % 3600) / 60;
	//    return sprintf("%d:%d", $hours, $minutes);
	return sprintf("%02d:%02d", $hours, $minutes);
}

//$date format = 00:00
function time_to_minutes($date)
{
	$explode = explode(':', $date);
	$hours = intval($explode[0]);
	$minutes = intval($explode[1]);

	$hours = $hours * 60;
	return $hours + $minutes;
}

function was_present($date, $array)
{
	foreach ($array as $key => $val) {
		$only_date_in = explode(' ', $val['in']);
		if ($only_date_in[0] == $date) {
			return $key;
		}
	}
	return -1;
}

/**
 * Count the number of working days between two dates.
 *
 * This function calculate the number of working days between two given dates,
 * taking account of the Public festivities, Easter and Easter Morning days,
 * the day of the Patron Saint (if any) and the working Saturday.
 *
 * @param string $date1 Start date ('YYYY-MM-DD' format)
 * @param string $date2 Ending date ('YYYY-MM-DD' format)
 * @param boolean $workSat TRUE if Saturday is a working day
 * @param string $patron Day of the Patron Saint ('MM-DD' format)
 * @param bool $is_array
 *
 * @return array|int
 * @author Massimo Simonini <massiws@gmail.com>
 */
//function getWorkdays($date1, $date2, $workSat = FALSE, $patron = NULL, $is_array = false)
function getWorkdays($date1, $date2, $patron = NULL)
{
	if (!defined('SATURDAY')) define('SATURDAY', 6);
	if (!defined('SUNDAY')) define('SUNDAY', 0);

	// Array of all public festivities
	$publicHolidays = array('01-01', '02-03', '04-07', '05-01', '06-25', '09-07', '09-25', '10-04', '12-25');
	// The Patron day (if any) is added to public festivities
	if ($patron) {
		$publicHolidays[] = $patron;
	}

	/*
     * Array of all Easter Mondays in the given interval
     */
	$yearStart = date('Y', strtotime($date1));
	$yearEnd = date('Y', strtotime($date2));

	for ($i = $yearStart; $i <= $yearEnd; $i++) {
		$easter = date('Y-m-d', easter_date($i));
		list($y, $m, $g) = explode("-", $easter);
		$monday = mktime(0, 0, 0, date($m), date($g) + 1, date($y));
		$easterMondays[] = $monday;
	}

	$start = strtotime($date1);
	$end = strtotime($date2);
	$array_dates = array();
	$working_days = array();
	$setting_working_days = json_decode(get_setting()->working_days, true);
	foreach ($setting_working_days as $day) {
		array_push($working_days, $day['id']);
	}

	for ($i = $start; $i <= $end; $i = strtotime("+1 day", $i)) {
		$day = date("w", $i);  // 0=sun, 1=mon, ..., 6=sat
		$mmgg = date('m-d', $i);
		if (
			!in_array($mmgg, $publicHolidays) &&
			!in_array($i, $easterMondays) &&
			in_array($day, $working_days)
		) {
			array_push($array_dates, date('Y-m-d', $i));
		}
	}
	return $array_dates;
}

function date_to_monday($date)
{
	$date = date_format(date_create($date), 'Y-m-d');
	$day_of_week = intval(date('w', strtotime($date)));
	try {
		$date_sunday = new DateTime($date);
		if ($day_of_week === 0) { //sunday
			return $date_sunday->modify('+1 day')->format('Y-m-d');
		} else {
			return $date;
		}
	} catch (Exception $e) {
		return false;
	}
}

function get_first_last_day($date)
{
	$month = date("F", strtotime($date));
	$year = date("Y", strtotime($date));
	$timestamp = strtotime($month . ' ' . $year);
	$first_second = date('Y-m-01', $timestamp);
	$last_second = date('Y-m-t', $timestamp); // A leap year!
	return ['first_day' => $first_second, 'last_day' => $last_second];
}

function sum_date_and_date($day, $dates)
{
	return date_create($dates)->modify('+' . $day . ' day')->format('Y-m-d');
}

