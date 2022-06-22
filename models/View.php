<?php

namespace app\models;

use Yii;
use app\models\View\Component;
use app\models\User;

/**
 * This is the model class for table "views".
 *
 * @property integer $id
 * @property string $name
 * @property integer $user_id
 * @property integer $active
 * @property string $config
 * @property string $refresh_time
 *
 * @property View\Component[] $viewComponents
 * @property User $user
 */
class View extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'views';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'active'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['config', 'refresh_time'], 'string'],
            [['refresh_time'], 'match', 'pattern' => '/^\d{1,5}[YMWDHmS]{1}$/',
                'message' => 'Enter valid format(nY/nM/nW/nD/nH/nm/nS)!'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'user_id' => Yii::t('app', 'User ID'),
            'active' => Yii::t('app', 'Active'),
            'config' => Yii::t('app', 'Config'),
            'refresh_time' => Yii::t('app', 'Refresh time')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViewComponents()
    {
        return $this->hasMany(Component::className(), ['view_id' => 'id'])
                    ->orderBy(['order' => SORT_ASC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
