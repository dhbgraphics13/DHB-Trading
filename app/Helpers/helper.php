<?php


use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

function trimStr5($string)
{
    return $result = substr($string, 0, -5);
}

function randomName($length=null)
{
    $str = Str::random($length);
    return Str::lower($str);
}

function getFormData($request)
{
    $inputs = [];
    $data = $request->all();
    parse_str($data['form-data'], $inputs);
    return $inputs;
}


function parseErrorMessagesForAjaxForm($validator)
{
    $errors = [];

    if($validator->errors()->getMessages()) {
        foreach($validator->errors()->getMessages() as $key => $value) {
            $errors[] =  $value[0];

        }
    }
    return $errors;
}


function jsonErrors($errors)
{
    $err = [];
    if(count($errors) > 0) {
        foreach($errors as $key => $error) {
            $err[$key] = $error;
        }
    }
    echo json_encode(['status' => false, 'errors' => $err]);
}


function generateValidationErrorsForAjaxSubmit($errors, $validationError = true)
{
    $response = [];
    $errors = ($validationError == true) ? $errors->getMessages() : $errors;
    if(count($errors) > 0) {
        foreach($errors as $key => $error) {
            $response[] = [
                'key' => $key,
                'error' => $error[0]
            ];
        }
    }

    return $response;
}

function generateRandomName($length = 16)
{
    return bin2hex(openssl_random_pseudo_bytes($length));
}

function fileRandomName($length = 30)
{
    return Str::random($length);
}

function statusOptions()
{
    return [
        'N'  => 'Disable',
        'Y'  => 'Active',
    ];
}

function yesNoOptions()
{
    return [
        'N'  => 'No',
        'Y'  => 'Yes',
    ];
}

function userRoles()
{
    return [
        'U'  => 'User',
        'M'  => 'Manager',
    ];
}




function unSlug($var = null)
{
    return str_replace('-', ' ', $var);
}

function makeSlug($var)
{
    //return Str::slug($var);
    $var = Str::lower($var);
    return Str::slug($var, '-');
}


function strLimit($string = null, $length = null)
{
    return Str::limit($string, $length, ' ...');
}


function dateFormat($date, $format = 'Y-m-d')
{
    return date($format, strtotime($date));
}


function inputFormat($date, $format = 'd M, Y')
{
    return date($format, strtotime($date));
}

function dateTimeFormat($date, $format = 'Y-m-d H:i:s')
{
    return date($format, strtotime($date));
}


function dateHuman($date, $format = 'F j, Y')
{
    return date($format, strtotime($date));
}

function timeHuman($time, $format = 'H:i A')
{
    return date($format, strtotime($time));
}

function dateTimeHuman($date, $format = 'M j, Y H:i A')
{
    return date($format, strtotime($date));
}



function sizes(){

    return [
        null  => '-- Select Item Size --',
        'small'  => 'Small',
        'medium'  => 'Medium',
        'large'  => 'Large',
        'x-large'  => 'X-Large',
    ];
}

function firstCapital($str)
{
    return Str::ucfirst($str);
}


function paymentOptions()
{
    return [
        ''         => '-- Select --',
        'Cash'         => 'Cash',
        'Credit Card'  => 'Credit Card',
        'Debit Card'   => 'Debit Card',
        'e-Transfer'   => 'E- Transfer',
    ];
}

function arrayInList($array , $id)
{
    $collection = collect($array);

    if($collection->contains($id))
    {
        return true;
    }
}



function deciamlRoundOff($decimal, $number)
{
   return number_format($decimal, $number,'.','');
}

function OrderStatusOptions() {
    return [
     //   null   => '-- select status --',
        '0'    => 'Pending',
        '1'    => 'Process',
        '2'    => 'Order Complete',
        '3'    => 'Cancel'
    ];
}


function getStatusName($id)
{
    if($id==''){
        return ' ';
    }elseif ($id=="0"){
        return 'Pending';
    }elseif ($id=="1"){
        return 'In Process';
    }elseif ($id=="2"){
        return 'Complete';
    }elseif ($id=="3"){
        return 'Cancel';
    }
    else{
        return null;
    }
}




function uuid()
{
    return (string) Str::uuid();
}
