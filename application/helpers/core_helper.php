<?php


defined('BASEPATH') or exit('Ação não permitida');


function get_user()
{
    $core_model = new Core_model();
    return  $core_model->get_user();
}
 function users_groups($condition){
    $core_model = new Core_model();
    return  $core_model->users_groups($condition);
 }
function is_service()
{
	return get_cookie('is_service') ? intval(get_cookie('is_service')) : 0;
}
function is_granted($role)
{
    $core_model = new Core_model();
    return $core_model->is_granted($role);
}

function remove_accents($string)
{
    if (!preg_match('/[\x80-\xff]/', $string))
        return $string;

    $chars = array(
        // Decompositions for Latin-1 Supplement
        chr(195) . chr(128) => 'A', chr(195) . chr(129) => 'A',
        chr(195) . chr(130) => 'A', chr(195) . chr(131) => 'A',
        chr(195) . chr(132) => 'A', chr(195) . chr(133) => 'A',
        chr(195) . chr(135) => 'C', chr(195) . chr(136) => 'E',
        chr(195) . chr(137) => 'E', chr(195) . chr(138) => 'E',
        chr(195) . chr(139) => 'E', chr(195) . chr(140) => 'I',
        chr(195) . chr(141) => 'I', chr(195) . chr(142) => 'I',
        chr(195) . chr(143) => 'I', chr(195) . chr(145) => 'N',
        chr(195) . chr(146) => 'O', chr(195) . chr(147) => 'O',
        chr(195) . chr(148) => 'O', chr(195) . chr(149) => 'O',
        chr(195) . chr(150) => 'O', chr(195) . chr(153) => 'U',
        chr(195) . chr(154) => 'U', chr(195) . chr(155) => 'U',
        chr(195) . chr(156) => 'U', chr(195) . chr(157) => 'Y',
        chr(195) . chr(159) => 's', chr(195) . chr(160) => 'a',
        chr(195) . chr(161) => 'a', chr(195) . chr(162) => 'a',
        chr(195) . chr(163) => 'a', chr(195) . chr(164) => 'a',
        chr(195) . chr(165) => 'a', chr(195) . chr(167) => 'c',
        chr(195) . chr(168) => 'e', chr(195) . chr(169) => 'e',
        chr(195) . chr(170) => 'e', chr(195) . chr(171) => 'e',
        chr(195) . chr(172) => 'i', chr(195) . chr(173) => 'i',
        chr(195) . chr(174) => 'i', chr(195) . chr(175) => 'i',
        chr(195) . chr(177) => 'n', chr(195) . chr(178) => 'o',
        chr(195) . chr(179) => 'o', chr(195) . chr(180) => 'o',
        chr(195) . chr(181) => 'o', chr(195) . chr(182) => 'o',
        chr(195) . chr(182) => 'o', chr(195) . chr(185) => 'u',
        chr(195) . chr(186) => 'u', chr(195) . chr(187) => 'u',
        chr(195) . chr(188) => 'u', chr(195) . chr(189) => 'y',
        chr(195) . chr(191) => 'y',
        // Decompositions for Latin Extended-A
        chr(196) . chr(128) => 'A', chr(196) . chr(129) => 'a',
        chr(196) . chr(130) => 'A', chr(196) . chr(131) => 'a',
        chr(196) . chr(132) => 'A', chr(196) . chr(133) => 'a',
        chr(196) . chr(134) => 'C', chr(196) . chr(135) => 'c',
        chr(196) . chr(136) => 'C', chr(196) . chr(137) => 'c',
        chr(196) . chr(138) => 'C', chr(196) . chr(139) => 'c',
        chr(196) . chr(140) => 'C', chr(196) . chr(141) => 'c',
        chr(196) . chr(142) => 'D', chr(196) . chr(143) => 'd',
        chr(196) . chr(144) => 'D', chr(196) . chr(145) => 'd',
        chr(196) . chr(146) => 'E', chr(196) . chr(147) => 'e',
        chr(196) . chr(148) => 'E', chr(196) . chr(149) => 'e',
        chr(196) . chr(150) => 'E', chr(196) . chr(151) => 'e',
        chr(196) . chr(152) => 'E', chr(196) . chr(153) => 'e',
        chr(196) . chr(154) => 'E', chr(196) . chr(155) => 'e',
        chr(196) . chr(156) => 'G', chr(196) . chr(157) => 'g',
        chr(196) . chr(158) => 'G', chr(196) . chr(159) => 'g',
        chr(196) . chr(160) => 'G', chr(196) . chr(161) => 'g',
        chr(196) . chr(162) => 'G', chr(196) . chr(163) => 'g',
        chr(196) . chr(164) => 'H', chr(196) . chr(165) => 'h',
        chr(196) . chr(166) => 'H', chr(196) . chr(167) => 'h',
        chr(196) . chr(168) => 'I', chr(196) . chr(169) => 'i',
        chr(196) . chr(170) => 'I', chr(196) . chr(171) => 'i',
        chr(196) . chr(172) => 'I', chr(196) . chr(173) => 'i',
        chr(196) . chr(174) => 'I', chr(196) . chr(175) => 'i',
        chr(196) . chr(176) => 'I', chr(196) . chr(177) => 'i',
        chr(196) . chr(178) => 'IJ', chr(196) . chr(179) => 'ij',
        chr(196) . chr(180) => 'J', chr(196) . chr(181) => 'j',
        chr(196) . chr(182) => 'K', chr(196) . chr(183) => 'k',
        chr(196) . chr(184) => 'k', chr(196) . chr(185) => 'L',
        chr(196) . chr(186) => 'l', chr(196) . chr(187) => 'L',
        chr(196) . chr(188) => 'l', chr(196) . chr(189) => 'L',
        chr(196) . chr(190) => 'l', chr(196) . chr(191) => 'L',
        chr(197) . chr(128) => 'l', chr(197) . chr(129) => 'L',
        chr(197) . chr(130) => 'l', chr(197) . chr(131) => 'N',
        chr(197) . chr(132) => 'n', chr(197) . chr(133) => 'N',
        chr(197) . chr(134) => 'n', chr(197) . chr(135) => 'N',
        chr(197) . chr(136) => 'n', chr(197) . chr(137) => 'N',
        chr(197) . chr(138) => 'n', chr(197) . chr(139) => 'N',
        chr(197) . chr(140) => 'O', chr(197) . chr(141) => 'o',
        chr(197) . chr(142) => 'O', chr(197) . chr(143) => 'o',
        chr(197) . chr(144) => 'O', chr(197) . chr(145) => 'o',
        chr(197) . chr(146) => 'OE', chr(197) . chr(147) => 'oe',
        chr(197) . chr(148) => 'R', chr(197) . chr(149) => 'r',
        chr(197) . chr(150) => 'R', chr(197) . chr(151) => 'r',
        chr(197) . chr(152) => 'R', chr(197) . chr(153) => 'r',
        chr(197) . chr(154) => 'S', chr(197) . chr(155) => 's',
        chr(197) . chr(156) => 'S', chr(197) . chr(157) => 's',
        chr(197) . chr(158) => 'S', chr(197) . chr(159) => 's',
        chr(197) . chr(160) => 'S', chr(197) . chr(161) => 's',
        chr(197) . chr(162) => 'T', chr(197) . chr(163) => 't',
        chr(197) . chr(164) => 'T', chr(197) . chr(165) => 't',
        chr(197) . chr(166) => 'T', chr(197) . chr(167) => 't',
        chr(197) . chr(168) => 'U', chr(197) . chr(169) => 'u',
        chr(197) . chr(170) => 'U', chr(197) . chr(171) => 'u',
        chr(197) . chr(172) => 'U', chr(197) . chr(173) => 'u',
        chr(197) . chr(174) => 'U', chr(197) . chr(175) => 'u',
        chr(197) . chr(176) => 'U', chr(197) . chr(177) => 'u',
        chr(197) . chr(178) => 'U', chr(197) . chr(179) => 'u',
        chr(197) . chr(180) => 'W', chr(197) . chr(181) => 'w',
        chr(197) . chr(182) => 'Y', chr(197) . chr(183) => 'y',
        chr(197) . chr(184) => 'Y', chr(197) . chr(185) => 'Z',
        chr(197) . chr(186) => 'z', chr(197) . chr(187) => 'Z',
        chr(197) . chr(188) => 'z', chr(197) . chr(189) => 'Z',
        chr(197) . chr(190) => 'z', chr(197) . chr(191) => 's'
    );

    $string = strtr($string, $chars);

    return $string;
}

function get_job_name($job_id, $small = false)
{
    if ($job_id) {
        return get_by_id('job', ['id' => $job_id])->name;
    } else {
        return $small ? 'Não definido' : 'Cargo não definido';
    }
}

function get_marital_status()
{
    return [
        ['value' => 'Solteiro', 'text' => 'Solteiro(a)'],
        ['value' => 'Casado', 'text' => 'Casado(a)'],
        ['value' => 'Divorciado', 'text' => 'Divorciado(a)'],
        ['value' => 'Viúvo', 'text' => 'Viúvo(a)'],
        ['value' => 'Separado', 'text' => 'Separado(a)'],
    ];
}

//function get_salary($employee_id)
//{
//    $employee_model = new Employee_model();
//    $active_job = $employee_model->get_active_job($employee_id);
//    return floatval($active_job->salary);
//}

function get_employees_by_subsidy($subsidy_id)
{
    $core_model = new Core_model();
    return $core_model->get_all('employee_subsidy', ['subsidy_id' => $subsidy_id, 'active' => 1]);
}


function get_array_key($id, $time, $array)
{
    $only_date = explode(' ', $time);
    foreach ($array as $key => $val) {
        $only_date_in = explode(' ', $val['in']);
        if ((trim($val['id']) == trim($id)) && (trim($only_date[0]) == trim($only_date_in[0]))) {
            return $key;
        }
    }
    return -1;
}

function is_same_day($date_one, $date_two)
{
    $date_one_ex = explode(' ', $date_one);
    $date_two_ex = explode(' ', $date_two);

    if ($date_one_ex[0] == $date_two_ex[0]) {
        return true;
    }
    return false;
}

function get_array_by_code($code, $all_presences)
{
    $big_array = array();
    foreach ($all_presences as $key => $item) {
        if ($item['code'] == $code) {
            array_push($big_array, $item);
        }
    }
    return $big_array;
}

function get_by_id($table, $condition = null)
{
    $core_model = new Core_model();
    return $core_model->get_by_id($table, $condition);
}

function get_company()
{
    $core_model = new Core_model();
    return $core_model->get_company();
}

function get_all($table, $condition = null, $sort = null, $distinct = null)
{
    $core_model = new Core_model();
    return $core_model->get_all($table, $condition, $sort, $distinct);
}

function insert($table, $data)
{
    $core_model = new Core_model();
    return $core_model->insert($table, $data);
}
function update($table, $data, $condition)
{
    $core_model = new Core_model();
    return $core_model->update($table, $data, $condition);
}

function get_subsidies()
{
    $subsidies = array();
    foreach (get_all('subsidy', ['active' => 1]) as $subsidy):
        if (get_employees_by_subsidy($subsidy->id)):
            array_push($subsidies, $subsidy);
        endif;
    endforeach;
    return $subsidies;
}

function get_subsidy_value($subsidy_id, $array)
{
    foreach ($array as $key => $item) {
        if ($item['subsidy_id'] == $subsidy_id) {
            return $item['amount'];
        }
    }
    return 0;
}

function get_setting()
{
    return get_company();
}



function this_number_format($number, $null = null)
{
    $setting = get_setting();
    $show_currency = $setting->show_currency;
    $currency_code_position = $setting->currency_code_position;
    $currency = get_by_id('currency', ['code' => $setting->currency_code]);
    if ($setting->show_currency_code_symbol == 'code') {
        $currency_code_symbol = $currency->code;
    } else {
        $currency_code_symbol = $currency->symbol;
    }
    $decimals = $setting->currency_decimals;
    $dec_point = $setting->currency_dec_point;
    $thousand_sep = $setting->currency_thousand_sep;
    $format = number_format($number, intval($decimals), $dec_point, $thousand_sep);

    if ($show_currency) {
        if ($currency_code_position == 'start') {
            $format = $currency_code_symbol . ' ' . $format;
        } else {
            $format = $format . ' ' . $currency_code_symbol;
        }
    }
    return $format;
}

function calculate_tax($salary, $inss_id, $dependent)
{
    $gross_salary = $salary;

    $irps_tax = 0;
    $irps_amount = 0;
    $irps_percent = 0;
    $dependent_amount = 0;
    $inss_amount = 0;
    $inss_tax = 0;
    $inss_percent = 0;

    if ($salary > 0) {

        $inss = get_by_id('inss', ['id' => $inss_id]);

        $inss_tax = $inss->tax / 100;
        $inss_amount = $salary * $inss_tax;
        $inss_percent = $inss->tax;
        $salary -= $inss_amount;

        $irps_filter = array(
            'min_value <' => $salary,
            'max_value >=' => $salary,
        );

        $irps = get_by_id('irps', $irps_filter);

        if ($gross_salary >= get_setting()->irps_min_salary) {

            if ($irps->tax) {
                if ($dependent < 4) {
                    $dependent_number = 'dependent_'.$dependent;
                    $dependent_amount = $irps->$dependent_number;
                } else {
                    $dependent_amount = $irps->dependent_4;
                }

                $irps_tax = $irps->tax / 100;
                $irps_amount = ($salary - $irps->min_value) * $irps_tax + floatval($dependent_amount);
                $irps_percent = $irps->tax;
            }
        }
    }

    $data = [
        'gross_salary' => $gross_salary,
        'inss_amount' => $inss_amount,
        'inss_tax' => $inss_tax,
        'inss_percent' => $inss_percent,

        'irps_amount' => $irps_amount,
        'irps_tax' => $irps_tax,
        'irps_percent' => $irps_percent,
        'net_salary' => $salary - $irps_amount, //23,637.5
        'dependent_amount' => $dependent_amount,
    ];
    return $data;
}

function get_assiduity_json($employee, $data, $with_presence = null)
{
    $salary = $employee->salary;
    $salary_day = $salary != 0 ? $salary / 30 : 0;
    $salary_hour = $salary_day != 0 ? $salary_day / 8 : 0;
    $salary_min = $salary_hour != 0 ? $salary_hour / 60 : 0;

    if ($with_presence) {
        $presence = $with_presence;
    } else {
        $presence = get_by_id('presence', $data);
    }
    $json_data = json_decode($presence->json_data, true);
    $over_time = [];
    $justified_time = [];
    $absences_justified = 0;
    foreach ($json_data['presences'] as $p) {
        if (time_to_minutes($p['time_tardiness_day']) < 0) {
            array_push($over_time, ($p['time_tardiness_day']));
        }
        if (isset($p['was_absence'])) {
            $absences_justified += 1;
        }
        if (isset($p['justified'])) {
            if ($p['justified'] == 1) {
                array_push($justified_time, ($p['time_tardiness_day']));
            }
        }
    }

    $sum_over_time = count($over_time) ? sum_times_over($over_time) : '00:00';
    $sum_over_time_min = time_to_minutes($sum_over_time);
    $sum_over_time_amount = $sum_over_time_min * $salary_min;
    $sum_justified_time = count($justified_time) ? sum_times_over($justified_time) : '00:00';
    $data_employee = [
        'year_month' => $presence->year_month,
        'year' => $presence->year,
        'month' => $presence->month,
        'employee' => $employee,
        'presences' => $json_data['presences'],
        'absences' => $json_data['absences'],
        'salary' => $json_data['salary'],
        'net_salary' => $json_data['net_salary'],
        'salary_day' => $json_data['salary_day'],
        'salary_hour' => $json_data['salary_hour'],
        'salary_min' => $json_data['salary_min'],
        'tardiness_min' => $json_data['tardiness_min'],
        'tardiness_amount' => $json_data['tardiness_amount'],
        'absences_min' => $json_data['absences_min'],
        'absences_amount' => $json_data['absences_amount'],
        'time_worked' => $json_data['time_worked'],
        'time_tardiness' => $json_data['time_tardiness'],
        'irpsinss' => $json_data['irpsinss'],
        'loan_instalment' => $json_data['loan_instalment'],
        'loan_amount' => $json_data['loan_amount'],
        'subsidies_amount' => $json_data['subsidies_amount'],
        'processed' => $presence->processed,
        'over_time' => $sum_over_time,
        'over_time_amount' => $sum_over_time_amount,
        'justified_time' => $sum_justified_time,
        'absences_justified' => $absences_justified,
    ];
    $d = $json_data['tardiness_min'] - time_to_minutes($sum_justified_time)-time_to_minutes($sum_over_time);
    $data_employee['tardiness_amount'] =  $d * $salary_min;
    return $data_employee;
}

function get_credit_note_debit($invoice_id){
	$core_model = new Core_model();
	$note = $core_model->get_by_id('note',['invoice_id' => $invoice_id]);
	if($note){
		return	$note->total;
	}
	return 0;
}

