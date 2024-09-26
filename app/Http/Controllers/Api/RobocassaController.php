<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\RestController;

class RobocassaController extends RestController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        if (!empty($req->out_sum)) {

            $out_sum = trim(htmlspecialchars(strip_tags($req->out_sum)));
        
        // your registration data
            $mrh_login = "Uchebnik_RKI-Privet_Rossiya_po_RKI"; 
            // $mrh_pass1 = "W1bQBYhHxmE0qLH151lQ";
            $mrh_pass1 = "AZKqf07v5oJAZaV0nD1X"; //тестовый
        // order number. "" for random value
            $inv_id = "";
        
        // urlencoded receipt
            $receipt = "%7B%22items%22:%5B%7B%22name%22:%22name%22,%22quantity%22:1,".
            "%22sum%22:11,%22tax%22:%22none%22%7D%5D%7D";
        
        // double urlencode for headers
            $receipt_urlencode = urlencode($receipt);
        
        // description of the order, if you need
            $inv_desc = "book";
        
        // build own CRC
            $crc = md5("$mrh_login:$out_sum:$inv_id:$receipt:$mrh_pass1");
            
            $params = array(
                'MrchLogin' => $mrh_login, 
                'OutSum' => $out_sum, 
                'InvId' => $inv_id,
                'Receipt' => $receipt_urlencode,
                'Desc' => $inv_desc,
                'SignatureValue' => $crc
            );
            
            // $link = "https://auth.robokassa.ru/Merchant/Index.aspx?". urldecode(http_build_query($params));
            // echo $link = '<p><a href="https://auth.robokassa.ru/Merchant/Index.aspx?' . urldecode(http_build_query($params) . '">Оплата</a></p>';
            // payment form
            Header
        ("Location: https://auth.robokassa.ru/Merchant/Index.aspx?MrchLogin=$mrh_login&".
            "OutSum=$out_sum&InvId=$inv_id&Receipt=$receipt_urlencode&Desc=$inv_desc&".
            "SignatureValue=$crc");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function success(Request $request)
    {
        // регистрационная информация (пароль #1)
        // registration info (password #1)
        // $mrh_pass1 = "W1bQBYhHxmE0qLH151lQ";
        $mrh_pass1 = "AZKqf07v5oJAZaV0nD1X"; // тестовый

        // чтение параметров
        // read parameters
        $out_summ = $request->OutSum;
        $inv_id = $request->InvId;
        $shp_item = $request->Shp_item;
        $crc = $request->SignatureValue;

        $crc = strtoupper($crc);

        $my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass1:Shp_item=$shp_item"));

        // проверка корректности подписи
        // check signature
        if ($my_crc != $crc)
        {
            echo "bad sign\n";
            exit();
        }

        // проверка наличия номера счета в истории операций
        // check of number of the order info in history of operations
        $f=@fopen("order.txt","r+") or die("error");

        while(!feof($f))
        {
            $str=fgets($f);

            $str_exp = explode(";", $str);
            if ($str_exp[0]=="order_num :$inv_id")
            { 
                echo "Операция прошла успешно\n";
                echo "Operation of payment is successfully completed\n";
            }
        }
        fclose($f);

    }


    /**
     * Update the specified resource in storage.
     */
    public function result(Request $request)
    {

        // регистрационная информация (пароль #2)
        // registration info (password #2)
        // $mrh_pass2 = "f43X1dbAVNnvcrHz14iz";
        $mrh_pass2 = "xgl6zJ5zDI9GZmQFKd80"; // тестовый

        //установка текущего времени
        //current date
        $tm=getdate(time()+9*3600);
        $date="$tm[year]-$tm[mon]-$tm[mday] $tm[hours]:$tm[minutes]:$tm[seconds]";

        // чтение параметров
        // read parameters
        $out_summ = $_REQUEST["OutSum"];
        $inv_id = $_REQUEST["InvId"];
        $shp_item = $_REQUEST["Shp_item"];
        $crc = $_REQUEST["SignatureValue"];

        $crc = strtoupper($crc);

        $my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2:Shp_item=$shp_item"));

        // проверка корректности подписи
        // check signature
        if ($my_crc !=$crc)
        {
        echo "bad sign\n";
        exit();
        }

        // признак успешно проведенной операции
        // success
        echo "OK$inv_id\n";

        // запись в файл информации о проведенной операции
        // save order info to file
        $f=@fopen("order.txt","a+") or
                die("error");
        fputs($f,"order_num :$inv_id;Summ :$out_summ;Date :$date\n");
        fclose($f);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function fail(Request $request)
    {
        $inv_id = $request->InvId;
        echo "Вы отказались от оплаты. Заказ# $inv_id\n";
        echo "You have refused payment. Order# $inv_id\n";
    }
}
