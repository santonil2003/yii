<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property string $text
 * @property integer $video_id
 * @property integer $user_id
 * @property string $created_at
 * @property string $modified_at
 *
 * @property Video $video
 */
class Comment extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['text', 'video_id'], 'required'],
            [['text'], 'string'],
            [['video_id', 'user_id'], 'integer'],
            [['created_at', 'modified_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'video_id' => 'Video ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideo() {
        return $this->hasOne(Video::className(), ['id' => 'video_id']);
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
