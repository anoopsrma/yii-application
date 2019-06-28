<?php

namespace backend\modules\api\models;

use Yii;

/**
 * This is the model class for collection "company".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $name
 * @property mixed $description
 * @property mixed $status
 * @property mixed $employee
 */
class Company extends \yii\mongodb\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return ['test', 'company'];
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return [
            '_id',
            'name',
            'description',
            'status',
            'employee',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'status', 'employee'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'employee' => 'Employee',
        ];
    }
}
