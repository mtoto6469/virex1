<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "views".
 *
 * @property int $id
 * @property int $id_participant
 * @property string $file_name
 * @property int $file_visits
 * @property int $visits
 * @property string $date
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
            [['id_participant', 'file_visits', 'visits'], 'integer'],
            [[ 'date'], 'required'],
            [['date'], 'safe'],
            [['file_name'], 'string', 'max' => 250],
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
            'file_name' => 'File Name',
            'file_visits' => 'File Visits',
            'visits' => 'Visits',
            'date' => 'Date',
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
