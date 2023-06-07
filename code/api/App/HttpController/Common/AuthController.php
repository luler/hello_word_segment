<?php


namespace App\HttpController\Common;

class AuthController extends BaseController
{
    public function onRequest(?string $action): ?bool
    {
        if (parent::onRequest($action)) {
//            $this->writeJson(401, '', '登入已过期');
//            return false;
            return true;
        }
        return false;
    }
}
