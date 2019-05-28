<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "partner".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 * @property User[] $person
 */
class Partner extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'partner';
    }

    /**
     * @inheritDoc
     * */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            ['class' => TimestampBehavior::class]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 50],
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
            'user_id' => 'User ID',
            'title' => 'Title',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function beforeDelete()
    {
        $this->user->inactivate();
        foreach ($this->person as $person) {
            $person->inactivate();
        }

        return parent::beforeDelete();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getPartnerUser()
    {
        return $this->hasMany(PartnerUser::class, ['partner_id' => 'id']);
    }

    public function getPerson()
    {
        return $this->hasMany(User::class, ['id' => 'user_id'])
            ->via('partnerUser')
            ->select(['user.*', 'partner_user.id partnerUser'])
            ->joinWith('partnerUser');
    }
}
