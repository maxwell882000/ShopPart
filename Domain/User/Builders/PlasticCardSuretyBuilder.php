<?php

namespace App\Domain\User\Builders;

class PlasticCardSuretyBuilder extends PlasticCardBuilder
{
    public function joinUser()
    {
        return $this->join("plastic_surety_cards", "plastic_surety_cards.plastic_id",
            "=", "plastic_card.id");
    }

    public function joinUserWhere($user_id)
    {
        return $this->joinUser()->where("plastic_surety_cards.surety_id", '=', $user_id);
    }

    public function filterBy($filter)
    {
        if (isset($filter['user_id'])) {
            $this->joinUserWhere($filter['user_id']);
            unset($filter['user_id']);
        }
        return parent::filterBy($filter);
    }
}
