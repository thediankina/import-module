<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

class User extends Model implements IdentityInterface
{
    public $id;
    public $authKey;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        Yii::configure($this, require __DIR__ . '/../user.php');
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id): ?IdentityInterface
    {
        $model = new self();
        return $model->getId() === (int)$id ? $model : null;
    }

    /**
     * {@inheritdoc}
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null): ?IdentityInterface
    {
        throw new NotSupportedException(__METHOD__ . ' is not supported.');
    }

    /**
     * {@inheritdoc}
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     * @return string
     */
    public function getAuthKey(): string
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     * @return bool
     */
    public function validateAuthKey($authKey): bool
    {
        return $authKey === $this->getAuthKey();
    }
}
