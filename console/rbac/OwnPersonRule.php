<?php


namespace console\rbac;


use Yii;
use yii\rbac\Rule;

class OwnPersonRule extends Rule
{
    public $name = "isOwnPerson";

    /**
     * @inheritDoc
     * */
    public function execute($user, $item, $params)
    {
        $partnerId = Yii::$app->user->identity->partner->id ?? null;
        return isset($params['person'])
            ? $params['person']->partner_id === $partnerId
            : false;
    }
}
