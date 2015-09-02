<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "course".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $created_at
 * @property string $modified_at
 *
 * @property UserHasCourse[] $userHasCourses
 * @property User[] $users
 * @property Video[] $videos
 */
class Course extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'course';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['code', 'name'], 'required'],
            [['description'], 'string'],
            [['created_at', 'modified_at'], 'safe'],
            [['code', 'name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'description' => 'Description',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasCourses() {
        return $this->hasMany(UserHasCourse::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers() {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('user_has_course', ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideos() {
        return $this->hasMany(Video::className(), ['course_id' => 'id']);
    }

    /**
     * before save
     * @param type $insert
     * @return boolean
     */
    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            $this->modified_at = date('Y-m-d H:i:s');
            if ($this->isNewRecord) {
                $this->created_at = date('Y-m-d H:i:s');
            }
            return true;
        }
        return false;
    }

}
