<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "plans".
 *
 * @property int $id
 * @property string $plan
 * @property float|null $qx_tbl
 * @property float|null $p_load
 * @property float|null $p_fee
 * @property float|null $c_fee
 * @property float|null $gdn_int
 * @property float|null $maturity
 * @property string|null $type
 * @property string|null $gl_trmmnt
 * @property string|null $7p_trmnt
 * @property string|null $jls_ind
 * @property string|null $life_ins_type
 */
class Plans extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plans';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plan'], 'required'],
            [['qx_tbl', 'p_load', 'p_fee', 'c_fee', 'gdn_int', 'maturity'], 'number'],
            [['plan', 'type', 'gl_trmmnt', '7p_trmnt', 'jls_ind', 'life_ins_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plan' => 'Plan',
            'qx_tbl' => 'Qx Tbl',
            'p_load' => 'P Load',
            'p_fee' => 'P Fee',
            'c_fee' => 'C Fee',
            'gdn_int' => 'Gdn Int',
            'maturity' => 'Maturity',
            'type' => 'Type',
            'gl_trmmnt' => 'Gl Trmmnt',
            '7p_trmnt' => '7p Trmnt',
            'jls_ind' => 'Jls Ind',
            'life_ins_type' => 'Life Ins Type',
        ];
    }
}
