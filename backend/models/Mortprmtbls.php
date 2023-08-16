<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mort_prm_tbls".
 *
 * @property int $id
 * @property string|null $MN
 * @property string|null $MS
 * @property string|null $FN
 * @property string|null $FS
 * @property string|null $UN
 * @property string|null $US
 */
class Mortprmtbls extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mort_prm_tbls';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MN', 'MS', 'FN', 'FS', 'UN', 'US'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'MN' => 'Mn',
            'MS' => 'Ms',
            'FN' => 'Fn',
            'FS' => 'Fs',
            'UN' => 'Un',
            'US' => 'Us',
        ];
    }
}
