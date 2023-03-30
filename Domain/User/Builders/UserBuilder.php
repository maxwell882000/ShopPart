<?php

namespace App\Domain\User\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;
use App\Domain\User\Interfaces\Roles;
use Illuminate\Support\Facades\DB;

class UserBuilder extends BuilderEntity
{
    protected function getSearch(): string
    {
        return "phone";
    }

    public function joinRole(): UserBuilder
    {
        return $this->join('user_roles', 'user_id', 'id');
    }

    public function findByPlastic($id): UserBuilder
    {
        return $this->join("plastic_user_cards", "plastic_user_cards.user_id",
            "=", 'users.id')->where("plastic_user_cards.plastic_id", '=', $id);
    }


    public function joinUserData()
    {
        return $this->join("user_credit_datas", "user_credit_datas.user_id", '=', 'users.id');
    }

    public function selectUserData()
    {
        return $this->joinUserData()->select("user_credit_datas.*");
    }

    public function filterBy($filter)
    {
        $this->joinRole()->where('role', Roles::USER);
        if (isset($filter['today'])) {
            $this->today();
        }
        if (isset($filter['user_credit'])) { // for taken credit
            $this->join(DB::raw("user_credit_datas as data"),
                "data.user_id",
                "=",
                'users.id')
                ->whereNotNull("data.crucial_data_id")
                ->select('users.*');
        }
        return parent::filterBy($filter);
    }

    public function onlyUser()
    {
        return $this->joinRole()->where("user_roles.role", '=', Roles::USER);
    }

    public function allUser()
    {
        return $this->onlyUser()->count();
    }

    public function today()
    {
        return $this->whereDate("created_at", now());
    }

    public function newToday()
    {
        return $this->onlyUser()->today()->count();
    }

    public function joinTakenCredit(): UserBuilder
    {
        return $this->join("taken_credits", "taken_credits.user_id", "=", 'users.id');
    }

    public function findByTakenCredit($taken_credit_id)
    {
        return $this->joinTakenCredit()
            ->where("taken_credits.id", "=", $taken_credit_id)
            ->select("users.*");
    }
}
