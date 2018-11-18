<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "review_option".
 *
 * @property int $id
 * @property int $review_id
 * @property string $name
 * @property int $value
 *
 * @property Review $review
 */
class ReviewOption extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review_option';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['review_id', 'name', 'value'], 'required'],
            [['review_id', 'value'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['review_id'], 'exist', 'skipOnError' => true, 'targetClass' => Review::className(), 'targetAttribute' => ['review_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'review_id' => 'Review ID',
            'name' => 'Name',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReview()
    {
        return $this->hasOne(Review::className(), ['id' => 'review_id']);
    }
}
