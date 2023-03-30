<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Api\Base\ApiController;

class UserController extends ApiController
{
    public function avatar()
    {
        $this->validateRequest([
            'avatar' => "required"
        ]);
        $avatar = auth()->user()->avatar;
        $avatar->avatar = $this->request->avatar;
        $avatar->save();
        return $this->result([
            'avatar' => $avatar->avatar->fullPath()
        ]);
//        return $this->update(UserAvatarApiService::new(), , $this->request->all());
    }

    public function userData()
    {
        $this->validateRequest([
            'phone' => 'required',
            'name' => 'required'
        ]);
        $user = auth()->user();
        if ($user->phone != $this->request->phone) {
            $user->phone = $this->request->phone;
            $user->dropPhone();
        }
        $user->avatar->name = $this->request->name;
        $user->avatar->save();
        return $this->result([]);
    }


}
