<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "nextexhibition".
 *
 * @property int $id
 * @property string $nextExhibition
 * @property int $enable
 */
class Nextexhibition extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nextexhibition';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enable'], 'integer'],
            [['nextExhibition'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nextExhibition' => 'Next Exhibition',
            'enable' => 'Enable',
        ];
    }

    /**
     * {@inheritdoc}
     * @return NextexhibitionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NextexhibitionQuery(get_called_class());
    }
}
