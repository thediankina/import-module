<?php

namespace app\models\db;

use xutl\snowflake\SnowflakeBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\db\Query;

/**
 * @property int $id
 * @property string $name
 * @property string $created_at
 * @property string|null $updated_at
 */
class City extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'snowflake' => [
                'class' => SnowflakeBehavior::class,
                'attribute' => 'id',
            ],
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('now()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function fields(): array
    {
        return [
            'id',
            'name',
            'created_at',
            'updated_at' => function (self $model) {
                if (is_object($model->updated_at)) {
                    $datetime = (new Query())->select($model->updated_at)->scalar();
                    return Yii::$app->formatter->asDate($datetime, 'php:Y-m-d H:i:s');
                }

                return $model->updated_at;
            },
        ];
    }
}
