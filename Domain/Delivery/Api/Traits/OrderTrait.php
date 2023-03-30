<?php

namespace App\Domain\Delivery\Api\Traits;

use App\Domain\Category\Entities\Category;
use App\Domain\Core\Main\Traits\HasIntToTime;
use App\Domain\Delivery\Api\Exceptions\DpdException;
use App\Domain\Order\Entities\UserPurchase;
use App\Domain\Shop\Entities\ShopAddress;
use App\Domain\Shop\Entities\WorkTimes;
use Illuminate\Support\Collection;

trait OrderTrait
{
    use HasIntToTime;

    /**
     * go one class up probably
     * @param Collection $times
     * @return array  length of array is 2
     * first item is actual date
     * second item is  chosen WorkTime
     */
    private function calculateDatePickUp(Collection $times): array
    {
        $datePickUp = $times->firstWhere("day", ">=", weekday_num()); // there can be null because working period
        // on this week ends
        if (!$datePickUp) {
            $datePickUp = $times->first(); // so first working day is picked in the next week
            $day = self::NUM_DAYS_WEEK + $datePickUp->day - weekday_num(); // we only need
        } else {
            $day = weekday_num() - $datePickUp->day;
        }
        return [now()->addDays($day)->format("Y-m-d"), $datePickUp];
    }


    private function generateSenderAddress(WorkTimes $times, ShopAddress $address): array
    {
        $address_request = $address->delivery->toArray();
        $request = [
            'name' => $address->shop->name,
            'workTimeFrom' => $this->intToTime($times->workTimeFrom),
            'workTimeTo' => $this->intToTime($times->workTimeTo),
            'contactPhone' => $address->user->phone,
        ];
        $request['contactFio'] = $request['name'];
        return array_merge($address_request, $request);
    }

    // private function orderNumberInternal(UserPurchase $pruchaseNumber, ShopAddress $fromAddress)
    // {
    //     return $pruchaseNumber->id * 100000 + $fromAddress->id;
    // }
    private function orderNumberInternal($shop_id, $purchase_id) {
        return  $purchase_id*100000+ $shop_id; 
    }
    private function purchaseToCategory(Collection $purchases)
    {
        $purchaseIds = $purchases->pluck('id');
        return Category::byPurchaseIn($purchaseIds)->get();
    }

    private function calculateWeight(Collection $purchases)
    {
        return $purchases->reduce(function ($cary, $item) {
            return $cary + $item->quantity * $item->product->weight;
        });
    }

    private function categoriesIsRegistered(Collection $categories): bool
    {
        $cargoRegistered = false;
        foreach ($categories as $category) {
            $parent = $category->parent;

            if (!$parent) {
                $parent = $category;
            } else {
                while ($parent->depth > 1) {
                    $parent = $parent->parent;
                }
            }

            if ($parent->deliveryImportant()->exists()) {
                $cargoRegistered = true;
                break;
            }
        }
        return $cargoRegistered;
    }


}
