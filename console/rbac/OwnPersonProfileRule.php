<?php


namespace console\rbac;


use common\models\PartnerUser;
use yii\rbac\Rule;
use Yii;

class OwnPersonProfileRule extends Rule
{
    public $name = "isOwnPersonProfile";

    /**
     * @inheritDoc
     * */
    public function execute($user, $item, $params)
    {
        $partnerId = Yii::$app->user->identity->partner->id ?? null;
        return isset($params['id']) ? PartnerUser::find()
            ->where([
                'partner_id' => $partnerId,
                'user_id' => $params['id']
            ])->exists() : false;
    }
}
