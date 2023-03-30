<?php

namespace App\Domain\User\Builders;

use App\Domain\Core\Main\Builders\BuilderEntity;

class PlasticCardBuilder extends BuilderEntity
{
    public function joinUser()
    {
        return $this->join("plastic_user_cards", "plastic_user_cards.plastic_id",
            "=", "plastic_card.id");
    }

    public function joinUserWhere($user_id)
    {
        return $this->joinUser()->where("plastic_user_cards.user_id", '=', $user_id);
    }

    public function filterBy($filter)
    {
        if (isset($filter['user_id'])) {
            $this->joinUserWhere($filter['user_id']);
        }
        return parent::filterBy($filter);
    }

    public function byToken($token): PlasticCardBuilder
    {
        return $this->where('card_token', $token);
    }

    protected function getSearch(): string
    {
        return "card_number";
    }
}
