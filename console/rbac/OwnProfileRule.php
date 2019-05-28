<?php


namespace console\rbac;


use yii\rbac\Rule;

class OwnProfileRule extends Rule
{
    public $name = 'isOwnProfile';

    /**
     * @inheritDoc
     * */
    public function execute($user, $item, $params)
    {
        return isset($params['id'])
            ? (int)$params['id'] === $user
            : false;
    }
}
