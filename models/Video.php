<?php

namespace app\models;

use Yii;
use app\models\User;
use yii\web\UploadedFile;

/**
 * This is the model class for table "video".
 *
 * @property integer $id
 * @property integer $course_id
 * @property string $title
 * @property string $description
 * @property string $path
 * @property integer $user_id
 * @property string $created_at
 * @property string $modified_at
 *
 * @property Comment[] $comments
 * @property Course $course
 */
class Video extends \yii\db\ActiveRecord {

    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'video';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['course_id', 'title', 'description'], 'required'],
            [['course_id', 'user_id'], 'integer'],
            [['path'], 'file', 'extensions' => 'mp4, m4v', 'maxSize' => 51200000, 'tooBig' => 'Limit is 50MB'],
            [['description'], 'string'],
            [['created_at', 'modified_at'], 'safe'],
            [['title', 'path'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'course_id' => 'Course',
            'title' => 'Title',
            'description' => 'Description',
            'path' => 'Path',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments() {
        return $this->hasMany(Comment::className(), ['video_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse() {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }

    /**
     * upload video
     * @return boolean|string
     */
    public function upload() {
        if ($this->validate()) {
            $path = 'uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($path);
            return $path;
        } else {
            return false;
        }
    }

    /**
     * before save
     * @param type $insert
     * @return boolean
     */
    public function beforeSave($insert) {

        if (parent::beforeSave($insert)) {
            $this->modified_at = date('Y-m-d H:i:s');
            $this->user_id = is_object(User::getCurrentUser()) ? User::getCurrentUser()->id : 0;
            if ($this->isNewRecord) {
                $this->created_at = date('Y-m-d H:i:s');
            }
            return true;
        }
        return false;
    }

}
