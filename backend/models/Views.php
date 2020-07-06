<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "views".
 *
 * @property int $id
 * @property int $id_participant
 * @property int $visits
 * @property string $date
 * @property string $enable
 */
class Views extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'views';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_participant', 'visits','enable'], 'integer'],
            [['date'], 'required'],
            [['date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_participant' => 'Id Participant',
            'visits' => 'Visits',
            'date' => 'Date',
            'enable' => 'Enable',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ViewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ViewsQuery(get_called_class());
    }
}
