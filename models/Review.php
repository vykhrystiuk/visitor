<?php

namespace app\models;

use app\components\TimestampBehavior;
use app\components\wizbl\WizblClient;
use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "review".
 *
 * @property int $id
 * @property int $user_id
 * @property int $task_id
 * @property string $description
 * @property string $paid_amount
 * @property string $transaction_hash
 * @property string $file_path
 * @property int $features
 * @property int $state
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Task $task
 * @property User $user
 * @property ReviewOption[] $reviewOptions
 */
class Review extends \yii\db\ActiveRecord
{
    const STATE_IDLE = 1;
    const STATE_APPROVED = 2;
    const STATE_DECLINED = 3;

    const STATES = [
        self::STATE_IDLE => 'Idle',
        self::STATE_APPROVED => 'Approved',
        self::STATE_DECLINED => 'Declined',
    ];

    public $options = [];

    /** @var UploadedFile */
    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'task_id', 'options'], 'required'],
            [['user_id', 'task_id', 'features', 'state'], 'integer'],
            [['description', 'transaction_hash'], 'string'],
            [['paid_amount'], 'number'],
            [['file_path'], 'string', 'max' => 2000],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['created_at', 'updated_at'], 'safe'],
            ['file', 'safe'],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg', 'checkExtensionByMimeType'=>false],
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
            'task_id' => 'Task ID',
            'description' => 'Description',
            'paid_amount' => 'Paid Amount',
            'transaction_hash' => 'Transaction Hash',
            'file_path' => 'File Path',
            'features' => 'Features',
            'state' => 'State',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $this->saveOptions();
        } else {
            if ($this->state == self::STATE_APPROVED) {
                $this->task->quota --;
                $this->task->save(false, ['quota']);

                # review set transaction
                $client = new WizblClient();
                $hash = $client->sendFrom($this->user->wallet, $this->task->amount);
                $this->transaction_hash = $hash;
                $this->paid_amount = $this->task->amount;
                $this->save(false, ['transaction_hash', 'paid_amount']);

                # company update balance
                $this->task->user->balance = $this->task->user->balance - $this->task->amount;
                $this->task->user->save(false, ['balance']);

                # visitor update balance
                $this->user->balance = (int)$this->user->balance + (int)$this->task->amount;
            }
        }

        parent::afterSave($insert, $changedAttributes);
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
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
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
    public function getReviewOptions()
    {
        return $this->hasMany(ReviewOption::className(), ['review_id' => 'id']);
    }

    public function getStateLabel(): string
    {
        return self::STATES[$this->state] ?? '';
    }

    public function approve(): void
    {
        $this->state = self::STATE_APPROVED;
    }

    public function decline(): void
    {
        $this->state = self::STATE_DECLINED;
    }

    private function saveOptions(): void
    {
        foreach ($this->options as $option) {
            $model = new ReviewOption();
            $model->review_id = $this->id;
            $model->name = $option['name'];
            $model->value = $option['value'];
            $model->save(false);
        }
    }

    public function uploadFile(): void
    {
        $this->file_path = '/files/' . uniqid() . '.' . $this->file->extension;
        $filePath = Yii::getAlias('@app') . '/web' . $this->file_path;
        $this->file->saveAs($filePath);
    }

    /**
     * @return array|Review[]
     */
    public static function getReviewsByCurrentUser(): array
    {
        return self::findAll(['user_id' => Yii::$app->user->id]);
    }
}
