<?php

namespace App\Domain\Delivery\Api\Models;


use App\Domain\Delivery\Api\Base\DpdClient;
use Illuminate\Support\Facades\Validator;

class DpdGeography extends DpdClient
{
    const GEOGRAPHY = "geography2?wsdl";

    /**
     * @params string $countryCode
     * @return array for creation AvailableCities
     *
     * Параметр    Описание    Тип    Пример
     * city        Массив городов с поддержкой доставки с наложенным платежом
     * cityId    Идентификатор города    Число    195644235
     * countryCode    Код страны    Строка    RU
     * countryName    Страна    Строка    Россия
     * regionCode    Код региона    Число    50
     * regionName    Регион    Строка    Московская
     * cityCode    Код населенного пункта    Строка    50017001000
     * cityName    Населенный пункт    Строка    Люберцы (буквенные обозначения аббревиатур и других знаков)
     * abbreviation    Аббревиатура    Строка    г
     * indexMin    Минимальный индекс    Строка    140000
     * indexMax    Максимальный индекс    Строка    143818
     */
    public function __construct()
    {
        parent::__construct(self::GEOGRAPHY);
    }


    /**
     * с наложеннным платежём
     */
    protected function getCities(string $countryCode): array
    {
        $request = [
            'countryCode' => $countryCode
        ];
        $response = $this->callSoapMethod($request, "request", "getCitiesCashPay");
        /**
         * check the status of the response raise the error if the error occured
         */
        return $response['return'];
    }

    /**
     * @return  array of serialized data for inseration to AvailableCities
     * */
    public function getSerializedCities(string $countryCode)
    {
        $response = $this->getCities($countryCode);
        foreach ($response as $key => $item) {
            $item['countryName'] = json_encode(['ru' => $item['countryName']], JSON_UNESCAPED_UNICODE);
            $item['cityName'] = json_encode(['ru' => $item['cityName']], JSON_UNESCAPED_UNICODE);
            $item['indexMin'] = null;
            $item['indexMax'] = null;
            $response[$key] = $item;
            $validation = Validator::make($item, [
                'cityId' => "required",
                'countryCode' => "required",
                "countryName" => "required",
                "regionCode" => "required",
                "regionName" => "required",
                "cityCode" => "required",
                "cityName" => "required",
                "abbreviation" => "required",
            ]);
            if ($validation->fails()) {
                throw  new \Exception($validation->errors()->toJson());
            }
        }
        return $response;

    }
}
