<?php


namespace console\rbac;


use Yii;
use yii\rbac\Rule;

class OwnCompanyRule extends Rule
{
    public $name = "isOwnCompany";

    /**
     * @inheritDoc
     * */
    public function execute($user, $item, $params)
    {
        $partnerId = Yii::$app->user->identity->partner->id ?? null;

        return isset($params['id'])
            ? (int)$params['id'] === $partnerId
            : false;
    }
}
