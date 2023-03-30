<?php

use App\Domain\Dashboard\Path\DashboardRouteHandler;
use App\Domain\Installment\Jobs\PennyPaidJobs;
use App\Domain\Installment\Payable\PennyPayble;

if (!function_exists('put_env')) {
    function put_env(array $values)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {

                $str .= "\n"; // In case the searched variable is in the last line without \n
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }
            }
        }

        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str)) return false;
        return true;
    }
}
if (!function_exists('get_cities')) {
    function get_cities(array $values = [])
    {
        $s = new \App\Domain\Delivery\Api\Models\DpdGeography();
        $result = $s->getSerializedCities("UZ");
        $service = new \App\Domain\Delivery\Services\AvailableCitiesService();
        $service->bulkInsertion($result);
    }
}
if (!function_exists('test')) {
    function test(array $values = [])
    {
//        $service = new  App\Domain\Core\Api\CardService\BindCard\Model\BindCardService();
//        $service->remove_card("EE08BD125C3145F87FC7B025D13F003B", 1666711);
        // $service->list_cards(1, 10);
        \App\Domain\Telegrams\Job\TelegramJob::dispatchSync(\App\Domain\Installment\Entities\TakenCredit::first()->purchase);
    }
}
if (!function_exists('list_card')) {
    function list_card(array $values = [])
    {
        $service = new  App\Domain\Core\Api\CardService\BindCard\Model\BindCardService();
        // $service->remove_card("5b0c2883ca57d712204d988b",13678 );
        dd($service->list_cards(1, 10));
        // \App\Domain\Telegrams\Job\TelegramJob::dispatchSync(\App\Domain\Installment\Entities\TakenCredit::first()->purchase);
    }
}
if (!function_exists('remove_card')) {
    function remove_card(array $values = [])
    {
        $service = new  App\Domain\Core\Api\CardService\BindCard\Model\BindCardService();
         $service->remove_card("937675F10965005AE053C0A865A6689B",13820 );
//        dd($service->list_cards(1, 10));
        // \App\Domain\Telegrams\Job\TelegramJob::dispatchSync(\App\Domain\Installment\Entities\TakenCredit::first()->purchase);
    }
}


if (!function_exists('card_create')) {
    function card_create(array $values = [])
    {
        try {
            $service = new  App\Domain\Core\Api\CardService\BindCard\Model\BindCardService();
            // $service->remove_card("5b0c2883ca57d712204d988b",13678 );
            $transaction_id = $service->create("8600332914249390", "09/25");
            print("this must be transaction id");
            print($transaction_id);
            print("\n");
            $s = $service->apply($transaction_id, 111111);
            dd($s);
        } catch (Exception $ec) {
            print($ec->getMessage());
        }

        // \App\Domain\Telegrams\Job\TelegramJob::dispatchSync(\App\Domain\Installment\Entities\TakenCredit::first()->purchase);
    }
}
if (!function_exists('check_auto')) {
    function check_auto(array $values = [])
    {
        $auth = new \App\Domain\Core\Api\CardService\Model\AuthPaymoService();
        $auth->getToken();
    }
}
if (!function_exists('penny_check')) {
    function penny_check(array $values = [])
    {
        $s = PennyPayble::find(2);
        $s->paid = 0;
        $s->transaction_id = null;
        $s->save();
        PennyPaidJobs::dispatch($s);
    }
}


if (!function_exists('send_code')) {
    function send_code(array $values = [])
    {
        $auth = new \App\Domain\Core\Api\CardService\BindCard\Model\BindCardService();
        $transaction_id = $auth->create("8600312990314318", "08/23");
        $auth->apply($transaction_id, "111111");
    }
}

if (!function_exists('merchant')) {
    function merchant(array $values = [])
    {
        $merchant = new \App\Domain\Core\Api\CardService\Merchant\Model\Merchant();
        $create = $merchant->create("10000", "0000000");
        echo $create;
        $merchant->pre_confirm("937675F10965005AE053C0A865A6689B", $create);
        $s = $merchant->confirm($create);
        dd($s);
    }
}
if (!function_exists('reverse')) {
    function reverse(array $values = [])
    {
        $merchant = new \App\Domain\Core\Api\CardService\Merchant\Model\Merchant();
        $s = $merchant->reverse(5249132);
        dd($s);
    }
}

if (!function_exists('merchant_get')) {
    function merchant_get(array $values = [])
    {
        $merchant = new \App\Domain\Core\Api\CardService\Merchant\Model\Merchant();
        $get = $merchant->get(5249132);
        dd($get);
    }
}
if (!function_exists('str_day_of_week')) {
    function str_day_of_week(int $day): string
    {
        return \App\Domain\Shop\Interfaces\DayInterface::DB_TO_FRONT[__($day)];
    }
}
if (!function_exists('month_num')) {
    function month_num(): int
    {
        return intval(date('m'));
    }
}
if (!function_exists('today_num')) {
    function today_num(): int
    {
        return intval(date('d'));
    }
}

if (!function_exists('weekday_num')) {
    function weekday_num(): int
    {
        return intval(date('w'));
    }
}


if (!function_exists('cities')) {
    function cities()
    {
        \Maatwebsite\Excel\Facades\Excel::import(new \App\Domain\Delivery\Excell\Imports\AvailableCityImport(),
            public_path("cities.xlsx"));
    }
}
if (!function_exists('telegram')) {
    function telegram()
    {
        $telegram = new \App\Domain\Telegrams\Schedule\TelegramSchedule(new \Illuminate\Console\Scheduling\Schedule());
        $telegram->run();
    }
}

if (!function_exists('toLogo')) {
    function toLogo()
    {
        $user = auth()->user();
//        dd($user->isModerator());
        if ($user->isAdmin())
            return route(DashboardRouteHandler::new()->index());
        else if ($user->isModerator())
            return route(\App\Domain\Product\Product\Front\Moderator\Path\ModeratorProductRouteHandler::new()->index());
        return "";
    }
}
if (!function_exists('download_image')) {
    function download_image($str, $json)
    {
        $serializes = json_decode(file_get_contents($json));
        mkdir($str);
        foreach ($serializes as $key => $item) {
            echo $item;
            file_put_contents($str . "/image_" . $key . ".png", file_get_contents($item));
        }
    }
}
//function downloadObjectAsJson(exportName){
//    var array_col = Array.from(document.getElementsByTagName("img"));
//    var exportObj = array_col.map(e=>e.src);
//    var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(exportObj));
//    var downloadAnchorNode = document.createElement('a');
//    downloadAnchorNode.setAttribute("href",     dataStr);
//    downloadAnchorNode.setAttribute("download", exportName + ".json");
//    document.body.appendChild(downloadAnchorNode); // required for firefox
//    downloadAnchorNode.click();
//    downloadAnchorNode.remove();
//}
//
//downloadObjectAsJson("url_of_all_image");

