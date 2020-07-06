<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "exhibitionn".
 *
 * @property int $id
 * @property int $id_country
 * @property string $title
 * @property string $image
 * @property string $holding_date
 * @property string $holding_date_ir
 * @property string $completion_date
 * @property string $completion_date_ir
 * @property string $holding_time
 * @property string $completion_time
 * @property int $enable
 */
class Exhibitionn extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exhibitionn';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_country', 'title', 'holding_date', 'holding_date_ir', 'completion_date', 'completion_date_ir', 'enable'], 'required'],
            [['id_country', 'enable'], 'integer'],
            [['holding_date', 'completion_date', 'holding_time', 'completion_time'], 'safe'],
            [['title', 'image'], 'string', 'max' => 250],
            [['holding_date_ir', 'completion_date_ir'], 'string', 'max' => 10],
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
            'title' => 'Title',
            'image' => 'Image',
            'holding_date' => 'Holding Date',
            'holding_date_ir' => 'Holding Date Ir',
            'completion_date' => 'Completion Date',
            'completion_date_ir' => 'Completion Date Ir',
            'holding_time' => 'Holding Time',
            'completion_time' => 'Completion Time',
            'enable' => 'Enable',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ExhibitionnQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ExhibitionnQuery(get_called_class());
    }
}
