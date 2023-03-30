<?php

namespace App\Domain\Product\Product\Services;

use App\Domain\Core\Main\Services\BaseService;
use App\Domain\File\Traits\FileUploadService;
use App\Domain\Product\Color\Services\ProductMainService;
use App\Domain\Product\Header\Services\HeaderService;
use App\Domain\Product\HeaderText\Services\HeaderTextService;
use App\Domain\Product\Product\Entities\Product;
use App\Domain\Product\Product\Entities\ProductHit;
use App\Domain\Product\Product\Entities\ProductOfDay;
use App\Domain\Product\Product\Interfaces\ProductInterface;
use App\Domain\Product\ProductKey\Services\ProductKeyProductService;
use Illuminate\Support\Facades\DB;

/// need dependency injection in such cases
class ProductService extends BaseService implements ProductInterface
{
    use FileUploadService;

    private CardImageService $imageService;
    private HeaderService $headerService;
    private ProductMainService $colorService;
    private ProductDescriptionService $descriptionService;
    private ProductKeyProductService $keyProductService;
    private HeaderTextService $headerTextService;
    private ProductInfoService $infoService;

    public function __construct()
    {
        parent::__construct();
        $this->imageService = CardImageService::new();
        $this->headerService = HeaderService::new();
        $this->colorService = ProductMainService::new();
        $this->descriptionService = ProductDescriptionService::new();
        $this->keyProductService = ProductKeyProductService::new();
        $this->headerTextService = new HeaderTextService();
        $this->infoService = ProductInfoService::new();
    }

    public function getEntity(): Product
    {
        return new Product();
    }

    private function createCheck(array $object_data, Product $product, string $class)
    {
        $this->toggleCheckBoxObject($object_data, $product, $class, "product_id");
    }

    public function create(array $object_data)
    {
        try {
            DB::beginTransaction();
            $this->serializeTempFile($object_data);
            $image_data = $this->popCondition($object_data, self::IMAGE_SERVICE);
            $card_image = $this->popCondition($object_data, self::CARD_IMAGE_SERVICE);
            $product_of_day = $this->popCondition($object_data, self::PRODUCT_DAY_SERVICE);
            $product_hit = $this->popCondition($object_data, self::PRODUCT_HIT_SERVICE);
            $main_credits = collect($this->popCondition($object_data, self::MAIN_CREDIT_SERVICE))->collapse()->toArray();
//            $headers = $this->popCondition($object_data, self::BODIES_SERVICE);
            $colors = $this->popCondition($object_data, self::COLORS_SERVICE);
            $descriptions = $this->popCondition($object_data, self::DESCRIPTION_SERVICE);
            $productKey = $this->popCondition($object_data, self::PRODUCT_KEY_SERVICE);
//            dd($productKey);
            $headerText = $this->popCondition($object_data, self::HEADER_TEXT_SERVICE);
            $this->popCondition($object_data, self::COLORS_TEMP);
            $product = parent::create($object_data);
            $product->images = $image_data['image'];
            $product_id = ['product_id' => $product->id];
            $this->colorService->createOrUpdateMany($colors, $product_id, 0);
//            $this->headerService->create(array_merge($headers, $product_id));
            $this->descriptionService->createWith($descriptions, $product_id);
            $this->keyProductService->createOrUpdateMany($productKey, $product_id, 0);
            $this->headerTextService->createOrUpdateMany($headerText, $product_id, 0);
            $this->infoService->create(['id' => $product->id]);
            $card_image['product_id'] = $product->id;
            $this->createCheck($product_of_day, $product, ProductOfDay::class);
            $this->createCheck($product_hit, $product, ProductHit::class);
            $main_credit = self::MAIN_CREDIT_SERVICE;
            $product->$main_credit()->attach($main_credits);
            $this->imageService->create($card_image);
            DB::commit();
            return $product;
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw  $exception;
        }

    }

    public function update($object, array $object_data): \App\Domain\Core\Main\Entities\Entity
    {
        try {
            DB::beginTransaction();
            $this->serializeTempFile($object_data);
            $product_of_day = $this->popCondition($object_data, self::PRODUCT_DAY_SERVICE);
            $product_hit = $this->popCondition($object_data, self::PRODUCT_HIT_SERVICE);
            $headers = $this->popCondition($object_data, self::BODIES_SERVICE);
            $colors = $this->popCondition($object_data, self::COLORS_SERVICE);
            $descriptions = $this->popCondition($object_data, self::DESCRIPTION_SERVICE);
            $productKey = $this->popCondition($object_data, self::PRODUCT_KEY_SERVICE);
            $headerText = $this->popCondition($object_data, self::HEADER_TEXT_SERVICE);

            $parent = ['product_id' => $object->id];
            $this->headerService->createOrUpdate($object, self::BODIES_SERVICE, $headers, $parent);
            $this->descriptionService->update($object[self::DESCRIPTION_SERVICE], $descriptions);
            $this->colorService->createOrUpdateMany($colors, $parent, 0);
            $this->keyProductService->createOrUpdateMany($productKey, $parent, 0);
            $this->headerTextService->createOrUpdateMany($headerText, $parent, 0);

            if ($object instanceof Product) {
                $this->createCheck($product_of_day, $object, ProductOfDay::class);
                $this->createCheck($product_hit, $object, ProductHit::class);
            }
            $product = parent::update($object, $object_data);
            DB::commit();
            return $product;
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw  $exception;
        }
    }
}
