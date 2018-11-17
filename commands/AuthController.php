<?php

namespace app\commands;

use app\models\User;
use yii\console\Controller;

class AuthController extends Controller
{
    const DEFAULT_PASSWORD = 'testtest';

    public function actionCreateUser($name, $email, $role)
    {
        $user = new User();
        $user->setAttributes([
            'username' => $name,
            'email' => $email,
            'status' => User::STATUS_ACTIVE,
            'password' => self::DEFAULT_PASSWORD,
            'role' => $role
        ]);

        if (!$user->validate()) {
            $this->stderr('Errors:' . PHP_EOL);
            print_r($user->getErrors());
            return;
        }

        $user->save();

        $roleName = $role == 1 ? 'Agent' : 'Company';

        $this->stdout($roleName . ' created:' . PHP_EOL);
        $this->stdout($user->email . PHP_EOL);
        $this->stdout(self::DEFAULT_PASSWORD . PHP_EOL);
    }
}
