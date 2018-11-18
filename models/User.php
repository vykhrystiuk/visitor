<?php

namespace app\models;

use app\components\ActiveRecord;
use Yii;
use yii\base\NotSupportedException;
use app\components\TimestampBehavior;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $email
 * @property string $name
 * @property int $role
 * @property int $status
 * @property string $wallet
 * @property string $balance
 * @property string $balance_frozen
 * @property int $karma
 * @property string $imagePath
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Review[] $reviews
 * @property Task[] $tasks
 */
class User extends ActiveRecord implements IdentityInterface
{
    const ROLE_AGENT = 1;
    const ROLE_COMPANY = 2;

    /** @var string */
    public $password;

    /** @var string */
    public $password_confirm;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'role'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['role', 'status', 'karma'], 'integer'],
            [['balance', 'balance_frozen'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'password_hash', 'email', 'name', 'wallet'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['imagePath'], 'string', 'max' => 2000],
            ['email', 'trim'],
            [['email'], 'email'],
            [['email'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            ['role', 'in', 'range' => [self::ROLE_AGENT, self::ROLE_COMPANY]],
            ['password', 'string', 'min' => 5],
            ['password_confirm', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'email' => 'Email',
            'name' => 'Name',
            'role' => 'Role',
            'status' => 'Status',
            'wallet' => 'Wallet',
            'balance' => 'Balance',
            'balance_frozen' => 'Balance Frozen',
            'karma' => 'Karma',
            'imagePath' => 'Image Path',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['user_id' => 'id']);
    }

    /**
     * @param bool $insert
     * @return bool
     * @throws \yii\base\Exception
     */
    public function beforeSave($insert)
    {
        if (isset($this->password) && !empty($this->password)) {
            $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        }
        $this->generateAuthKey();

        return parent::beforeSave($insert);
    }

    public static function findIdentity($id)
    {
        if (Yii::$app->getSession()->has('user-'.$id)) {
            return new self(Yii::$app->getSession()->get('user-'.$id));
        } else {
            return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
        }
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @param $email
     * @return static
     */
    public static function findByEmail($email)
    {
        return self::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     * @throws \yii\base\Exception
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * @throws \yii\base\Exception
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @return array|User[]
     */
    public static function getCompanies(): array
    {
        return self::findAll(['role' => self::ROLE_COMPANY]);
    }

    /**
     * @return array|Task[]
     */
    public function getFreeTasks(): array
    {
        return $this->getTasks()->andWhere(['>', 'quota', 0])->all();
    }

    public static function getCurrentBalance()
    {
        return Yii::$app->user->identity->balance;
    }
}
