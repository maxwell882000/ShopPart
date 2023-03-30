<?php


namespace App\Domain\Shop\Services;

use App\Domain\Core\Main\Entities\Entity;
use App\Domain\Core\Main\Services\BaseService;
use App\Domain\File\Traits\FileUploadService;
use App\Domain\Shop\Entities\Shop;
use App\Domain\Shop\Interfaces\ShopRelationInterface;
use Illuminate\Support\Facades\DB;

class ShopService extends BaseService implements ShopRelationInterface
{
    use FileUploadService;

    private UserShopService $userService;
    private ShopAddressService $addressService;

    public function __construct()
    {
        $this->userService = new UserShopService();
        $this->addressService = new ShopAddressService();
        parent::__construct();
    }

    public function getEntity(): Entity
    {
        return new Shop();
    }

    /**
     * @throws \Throwable
     */
    public function create(array $object_data)
    {
        $this->serializeTempFile($object_data);
        try {
            DB::beginTransaction();

            $user_array = $this->popCondition($object_data, self::USER);
            $address = $this->popCondition($object_data, self::SHOP_ADDRESS);
            $object_data['id'] = $this->userService->create($user_array)->id;
            $object = parent::create($object_data);
            $address['user_id'] = $object_data['id'];
            $this->addressService->create($address);
            DB::commit();
            return $object;
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * @throws \Throwable
     */
    public function update($object, array $object_data)
    {
        try {
            DB::beginTransaction();
            $userData = $this->popCondition($object_data, self::USER);
            $address = $this->popCondition($object_data, self::SHOP_ADDRESS);
            $this->userService->update($object[self::USER], $userData);
            $this->addressService->update($object[self::SHOP_ADDRESS], $address);
            $object = parent::update($object, $object_data);
            DB::commit();
            return $object;
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
