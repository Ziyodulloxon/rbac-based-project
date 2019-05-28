<?php


namespace common\widgets\leftMenu;


use yii\base\Widget;

class LeftMenu extends Widget
{
    /**
     * @inheritDoc
     * */
    public function run()
    {
        return $this->render('left-menu');
    }
}