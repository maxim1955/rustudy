<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\RestController;
use App\Models\Payment;
// use Illuminate\Support\Facades\DB;

class RobocassaController extends RestController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        if (!empty($req->out_sum)) {
            header('Access-Control-Allow-Origin: *');
            $out_sum = trim(htmlspecialchars(strip_tags($req->out_sum)));
            
        // your registration data
            $mrh_login = "Uchebnik_RKI-Privet_Rossiya_po_RKI"; 
            $mrh_pass1 = "W1bQBYhHxmE0qLH151lQ";
            // $mrh_pass1 = "AZKqf07v5oJAZaV0nD1X"; //тестовый
            
            $payments = Payment::orderByDesc('sdo_request_id')->first();
            // order number. "" for random value
            $inv_id = $payments->sdo_request_id+1;
            // echo $inv_id;
            // DB::table('posts')
            //       ->select('id as post_id', 'title as post_title', 'created_at as post_created_at')
            //       ->whereColumn('user_id', 'users.id')
            //       ->orderBy('created_at', 'desc')
            //       ->limit(3);
        
            $items = $req->items;
        // urlencoded receipt
            $book_type = implode('', $req->bookType);
            $receipt = [
                "sno"=>"osn", 
                "items" => [
                    $items
                ]
            ];
        
        // double urlencode for headers
            $receipt = json_encode($receipt);
            $receipt_urlencode = urlencode($receipt);
        
        // description of the order, if you need
            $inv_desc =  $book_type;
            // $inv_desc = '';
        
        // build own CRC
            $crc = md5("$mrh_login:$out_sum:$inv_id:$receipt:$mrh_pass1");
            
            $name = $req->fio;
            $country = $req->country;
            $email = $req->email;
            $phone = $req->telephone;
            $promocode = $req->promocode;
            $sum = $out_sum;
            $address = $req->address;
            $pickup = $req->pickup;
            $subscription = implode(', ', $req->subscription);
            $version = $req->version;
            // $courses = $req->courses;
            $courses = implode(', ', $req->courses);
        Payment::insert([
            'name' => $name,
            'country' =>$country,
            'comment' => $items,
            'email' => $email,
            'phone' => $phone,
            'promocode' => $promocode,
            'sum' => $sum,
            'address' => $address,
            'pickup' => $pickup,
            'subscription' => $subscription,
            'version' => $version,
            'courses' => $courses,
            'sdo_request_id' => $inv_id
        ]);
            $params = array(
                'MrchLogin' => $mrh_login, 
                'OutSum' => $out_sum, 
                'InvId' => $inv_id,
                'Receipt' => $receipt_urlencode,
                'Desc' => $inv_desc,
                'SignatureValue' => $crc
            );

            $link = "https://auth.robokassa.ru/Merchant/Index.aspx?". urldecode(http_build_query($params));
            // echo $link = '<p><a href="https://auth.robokassa.ru/Merchant/Index.aspx?' . urldecode(http_build_query($params) . '">Оплата</a></p>';
            // payment form
            return $link;
            //     Header
            // ("Location: https://auth.robokassa.ru/Merchant/Index.aspx?MrchLogin=$mrh_login&".
            //     "OutSum=$out_sum&InvId=$inv_id&Receipt=$receipt_urlencode&Desc=$inv_desc&".
            //     "SignatureValue=$crc");
            }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function success(Request $request)
    {
        // регистрационная информация (пароль #1)
        // registration info (password #1)
        $mrh_pass1 = "W1bQBYhHxmE0qLH151lQ";
        // $mrh_pass1 = "AZKqf07v5oJAZaV0nD1X"; // тестовый

        // чтение параметров
        // read parameters
        $out_summ = $request->OutSum;
        $inv_id = $request->InvId;
        $shp_item = $request->Shp_item;
        $crc = $request->SignatureValue;
        
        $order = Payment::where('sdo_request_id', '=', $inv_id)->first();
        if($order->courses == 8){
            $course = "Уровень А1";
        }
        else if($order->courses == 9){
            $course = "Уровень А2";
        }
        else if($order->courses == 89){
            $course = "Уровень А1,А2";
        }
        Payment::where('sdo_request_id', '=', $inv_id)
       ->update([
           'status_payment' => "оплачен"
        ]);
        $data = [
        "iform" => "true",
        "action" => "send_iform",
        "referer" => "",
        "task_id" => "2692116",
        "hash" => "03e33c259e10dd38d5d6cdd3394eb25a",
        "formdata" => [
                "A47A2C320B1DB2A6" => $order->name,
                "ACDD88C215B6AEC8" => $order->email,
                "A29C4E09B1903EC0" => 1,
                "A07C805149E94922" => $order->promocode,
                "A353E802272FC8D8" => $order->sum,
                "A32C7B222AFE2096" => date('d.m.Y H:i'),
                "F7A4002538E4DE10" => $course,
                "B8EE5D122B06DAA0" => "оплачен",
                "AA728E55381DA81C" => $order->phone,
                "ADB324849F89A902" => "form",
                "ED0291F49B4212B2" => "rus.study/",
                "A3902D25372F859A" => $order->address,
                "AF314A7589ACCBEF" => "robokassa"
            ]
        ];
        
        
        $jsonData = json_encode($data);
         
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://agent.prostoy.ru/api/ultraform.php');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $html = curl_exec($curl);
       
        if (curl_errno($curl)) {
            echo 'Error:' . curl_error($curl);
            $error = curl_error($curl);
            return $error; 
        }
        
         
        curl_close($curl);
        
        $decodedResponse = json_decode($html, true);
        // Возвращаем успешный ответ с декодированным JSON
        return response()->json([
            'status' => 'success',
            'response' => $decodedResponse
        ]);
       
        // Возвращаем ответ
        return $html()->json([
            'status' => 'success',
            'response' => json_decode($html)
        ]);
        
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
        $mrh_pass2 = "f43X1dbAVNnvcrHz14iz";
        // $mrh_pass2 = "xgl6zJ5zDI9GZmQFKd80"; // тестовый

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
        Payment::where('sdo_request_id', '=', $inv_id)
       ->update([
           'status_payment' => "не оплачен"
        ]);
        $order = Payment::where('sdo_request_id', '=', $inv_id)->first();
        if($order->courses == 8){
            $course = "Уровень А1";
        }
        else if($order->courses == 9){
            $course = "Уровень А2";
        }
        else if($order->courses == 89){
            $course = "Уровень А1,А2";
        }
        
        $data = [
        "iform" => "true",
        "action" => "send_iform",
        "referer" => "",
        "task_id" => "2692116",
        "hash" => "03e33c259e10dd38d5d6cdd3394eb25a",
        "formdata" => [
                "A47A2C320B1DB2A6" => $order->name,
                "ACDD88C215B6AEC8" => $order->email,
                "A29C4E09B1903EC0" => $order->count,
                "A07C805149E94922" => $order->promocode,
                "A353E802272FC8D8" => $order->sum,
                "A32C7B222AFE2096" => date('d.m.Y H:i'),
                "F7A4002538E4DE10" => $course,
                "B8EE5D122B06DAA0" => "не оплачен",
                "AA728E55381DA81C" => $order->phone,
                "ADB324849F89A902" => "form",
                "ED0291F49B4212B2" => "rus.study/",
                "A3902D25372F859A" => $order->address,
                "AF314A7589ACCBEF" => "robokassa"
            ]
        ];
        
        
        $jsonData = json_encode($data);
         
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://agent.prostoy.ru/api/ultraform.php');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $html = curl_exec($curl);
       
        if (curl_errno($curl)) {
            echo 'Error:' . curl_error($curl);
            $error = curl_error($curl);
            return $error; 
        }
        
         
        curl_close($curl);
        
        $decodedResponse = json_decode($html, true);
        // Возвращаем успешный ответ с декодированным JSON
        return response()->json([
            'status' => 'success',
            'response' => $decodedResponse
        ]);
       
        // Возвращаем ответ
        return $html()->json([
            'status' => 'success',
            'response' => json_decode($html)
        ]);
       
        echo "Вы отказались от оплаты. Заказ# $inv_id\n";
        echo "You have refused payment. Order# $inv_id\n";
    }
}
