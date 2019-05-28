<?php


namespace console\rbac;


use common\models\PartnerUser;
use yii\rbac\Rule;

class OwnJobRule extends Rule
{
    public $name = "isOwnJob";

    /**
     * @inheritDoc
     * */
    public function execute($user, $item, $params)
    {
        if (isset($params['id'])) {
            return PartnerUser::find()
                ->where([
                    'user_id' => $user,
                    'partner_id' => $params['id']
                ])
                ->exists();
        }

        return false;
    }
}