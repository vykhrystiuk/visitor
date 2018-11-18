<?php

namespace app\models;

use app\components\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $description
 * @property string $amount
 * @property int $quota
 * @property int $features
 * @property int $state
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 * @property TaskOption[] $taskOptions
 * @property Review[] $reviews
 */
class Task extends \yii\db\ActiveRecord
{
    public $options = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'amount', 'name', 'description', 'options'], 'required'],
            [['user_id', 'quota', 'features', 'state'], 'integer'],
            [['name', 'description'], 'string'],
            [['amount'], 'number'],
            [['options'], 'each', 'rule' => ['string']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'amount' => 'Amount',
            'quota' => 'Quota',
            'features' => 'Features',
            'state' => 'State',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $this->saveOptions();
        }

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskOptions()
    {
        return $this->hasMany(TaskOption::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['task_id' => 'id']);
    }

    private function saveOptions(): void
    {
        foreach ($this->options as $option) {
            $model = new TaskOption();
            $model->task_id = $this->id;
            $model->name = $option;
            $model->save(false);
        }
    }

    /**
     * @return Task[]
     */
    public static function getAllByCurrentCompany()
    {
        return self::findAll(['user_id' => Yii::$app->user->id]);
    }
}
