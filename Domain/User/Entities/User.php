<?php


namespace App\Domain\User\Entities;


use App\Domain\Core\Main\Entities\Authenticable;
use App\Domain\Order\Entities\Order;
use App\Domain\Order\Entities\UserPurchase;
use App\Domain\Product\Product\Entities\Product;
use App\Domain\Search\Entities\Search;
use App\Domain\User\Builders\UserBuilder;
use App\Domain\User\Interfaces\UserRelationInterface;
use App\Domain\User\Traits\HasRoles;

class User extends Authenticable implements UserRelationInterface
{
    use HasRoles;

    protected $table = 'users';

    public $timestamps = true;

    public function newEloquentBuilder($query)
    {
        return new UserBuilder($query);
    }

    public function basket(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'basket',
            "user_id",
            "order_id");
    }

    public function favourite(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class, "favourites",
            "user_id",
            "product_id");
    }

    public function search(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {

        return $this->belongsToMany(Search::class,
            'user_searches',
            "user_id",
            "search_id");
    }

    public function userPurchase(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserPurchase::class, "user_id");
    }

    public function userCreditData(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserCreditData::class, "user_id");
    }

    public function plasticCard(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            PlasticCard::class,
            "plastic_user_cards",
            "user_id",
            "plastic_id"
        );
    }

    public function surety(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Surety::class, 'user_id');
    }


    public function avatar(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserAvatar::class, "user_id");
    }

    public static function getCreateRules(): array
    {
        return [
            'phone' => "required",
            'password' => 'required'
        ];
    }

}
