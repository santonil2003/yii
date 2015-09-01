<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "video".
 *
 * @property integer $id
 * @property integer $course_id
 * @property string $title
 * @property string $description
 * @property integer $user_id
 * @property string $created_at
 * @property string $modified_at
 *
 * @property Comment[] $comments
 * @property Course $course
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_id', 'title', 'description', 'user_id', 'created_at', 'modified_at'], 'required'],
            [['course_id', 'user_id'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'modified_at'], 'safe'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'course_id' => 'Course ID',
            'title' => 'Title',
            'description' => 'Description',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['video_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }
}
