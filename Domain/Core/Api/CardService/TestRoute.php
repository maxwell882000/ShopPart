<?php

namespace App\Domain\Core\Api\CardService;

use App\Domain\Core\Api\CardService\BindCard\Model\BindCardService;
use App\Http\Controllers\Controller;
use http\Env\Request;
use App\Domain\Core\Api\CardService\Model\AuthPaymoService;

class TestRoute extends Controller
{
    public $ser;
    public $res;

    public function __construct(AuthPaymoService $ser, BindCardService $res){
        $this->ser=$ser;
        $this->res=$res;
    }

    public function get_access_token(){
        $this->ser->getToken();
    }

    public function create(Request $request){
        $g = $this->res->create($request->card_number, $request->expiry, $request->language);
        return $g;
    }

    public function apply(Request $request){
        $g = $this->res->apply($request->transaction_id, $request->otp, $request->language);
        return $g;
    }

    public function dial(Request $request){
        $g = $this->res->dial($request->transaction_id);
        return $g;
    }

    public function listCards(Request $request){
        $g = $this->res->list_cards($request->page, $request->page_size);
        return $g;
    }
}
