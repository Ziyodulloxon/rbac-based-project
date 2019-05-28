<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "partner_user".
 *
 * @property int $id
 * @property int $partner_id
 * @property int $user_id
 *
 * @property Partner $partner
 * @property User $user
 */
class PartnerUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'partner_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['partner_id', 'user_id'], 'required'],
            [['partner_id', 'user_id'], 'integer'],
            [
                ['partner_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Partner::class,
                'targetAttribute' => ['partner_id' => 'id']
            ],
            [
                ['user_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['user_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'partner_id' => 'Partner ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @inheritDoc
     * */
    public function beforeDelete()
    {
        $this->user->inactivate();

        return parent::beforeDelete();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartner()
    {
        return $this->hasOne(Partner::class, ['id' => 'partner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
