<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ult_qx_tbls".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $type
 * @property int|null $period
 * @property string|null $u_tbl
 * @property int|null $end_age
 */
class Ultqxtbls extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ult_qx_tbls';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['period', 'end_age'], 'integer'],
            [['name', 'u_tbl'], 'string', 'max' => 20],
            [['type'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'period' => 'Period',
            'u_tbl' => 'U Tbl',
            'end_age' => 'End Age',
        ];
    }
}
