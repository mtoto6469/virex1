<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "marked".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_participant
 * @property int $enable
 */
class Marked extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'marked';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_participant'], 'required'],
            [['id_user', 'id_participant', 'enable'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_participant' => 'Id Participant',
            'enable' => 'Enable',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MarkedQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MarkedQuery(get_called_class());
    }
}
