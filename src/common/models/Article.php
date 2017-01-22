<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property integer $id
 * @property string $tittle
 * @property string $text
 * @property integer $cout_comments
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tittle', 'text', 'cout_comments'], 'required'],
            [['tittle', 'text'], 'string'],
            [['cout_comments'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tittle' => 'Tittle',
            'text' => 'Text',
            'cout_comments' => 'Cout Comments',
        ];
    }
}
