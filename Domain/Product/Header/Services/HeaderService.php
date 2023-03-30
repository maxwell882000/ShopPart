<?php

namespace App\Domain\Product\Header\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\Product\Header\Entities\Header;
use App\Domain\Product\Header\Interfaces\HeaderRelation;
use Illuminate\Support\Facades\DB;

class HeaderService extends BaseService implements HeaderRelation
{
    public HeaderBodyService $bodyService;

    public function getEntity(): Entity
    {
        return new Header();
    }

    public function __construct()
    {
        $this->bodyService = new HeaderBodyService();
        parent::__construct();
    }


    public function create(array $object_data)
    {
        try {
            DB::beginTransaction();
            $body = $this->popCondition($object_data, self::BODY_SERVICE);
            $object = parent::create($object_data);
            $body['product_header_id'] = $object->id;
            $body['product_id'] = $object_data['product_id'];
            $this->bodyService->create($body);
            DB::commit();
            return $object;
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function update($object, array $object_data)
    {
        try {
            DB::beginTransaction();
            $body = $this->popCondition($object_data, self::BODY_SERVICE);
            if (!empty($body)) {
                $object_body = $object[self::BODY_SERVICE];
                $this->bodyService->update($object_body, $body);
            }
            $object = parent::update($object, $object_data);
            DB::commit();
            return $object;
        } catch (\Throwable $exception) {

        }
    }
}
