<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "session_frontend_user".
 *
 * @property string $id
 * @property int $id_user
 * @property string $ip
 * @property int $expire
 * @property resource $data
 */
class SessionFrontendUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'session_frontend_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ip'], 'required'],
            [['id_user', 'expire'], 'integer'],
            [['data'], 'string'],
            [['id'], 'string', 'max' => 80],
            [['ip'], 'string', 'max' => 15],
            [['id'], 'unique'],
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
            'ip' => 'Ip',
            'expire' => 'Expire',
            'data' => 'Data',
        ];
    }

    /**
     * {@inheritdoc}
     * @return SessionFrontendUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SessionFrontendUserQuery(get_called_class());
    }
}
