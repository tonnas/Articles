<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "{{%comment}}".
 *
 * @property integer $id_comment
 * @property text $text
 * @property integer $confirmation
 * @property integer $parent_id
 *
 * @property Comment $parent
 * @property Comment $comment
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['text'], 'string'],
            [['confirmation', 'parent_id'], 'integer'],
            [['who'], 'string'],
            [['article_id'], 'integer'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comment::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'text' => 'Text',
            'confirmation' => 'Confirmation',
            'parent_id' => 'Parent ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Comment::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComment()
    {
        return $this->hasMany(Comment::className(), ['parent_id' => 'id']);
    }
}
