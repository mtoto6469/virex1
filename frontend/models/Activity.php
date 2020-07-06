<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property int $id
 * @property int $id_country
 * @property int $id_exhibition
 * @property string $activity
 * @property int $enable
 */
class Activity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_country', 'id_exhibition', 'activity'], 'required'],
            [['id_country', 'id_exhibition', 'enable'], 'integer'],
            [['activity'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_country' => 'Id Country',
            'id_exhibition' => 'Id Exhibition',
            'activity' => 'Activity',
            'enable' => 'Enable',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ActivityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ActivityQuery(get_called_class());
    }
}
