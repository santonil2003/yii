<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $active
 * @property integer $role_id
 * @property string $created_at
 * @property string $modified_at
 *
 * @property Role $role
 * @property UserHasCourse[] $userHasCourses
 * @property Course[] $courses
 */
class User extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['first_name', 'username', 'password', 'email', 'role_id', 'created_at', 'modified_at'], 'required'],
            [['active', 'role_id'], 'integer'],
            [['created_at', 'modified_at'], 'safe'],
            [['first_name', 'last_name', 'username', 'password', 'email'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'active' => 'Active',
            'role_id' => 'Role ID',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole() {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasCourses() {
        return $this->hasMany(UserHasCourse::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourses() {
        return $this->hasMany(Course::className(), ['id' => 'course_id'])->viaTable('user_has_course', ['user_id' => 'id']);
    }

    /**
     * @inheritdoc 
     */
    public static function findIdentity($id) {

        $User = User::findOne(['id' => $id]);
        if (is_object($User)) {
            return new static($User->toArray());
        }

        return null;
    }

    /**
     * @inheritdoc 
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username 
     * 
     * @param string     $username 
     * @return static|null 
     */
    public static function findByUsername($username) {

        $User = User::findOne(['username' => $username]);

        if (is_object($User)) {
            return new static($User->toArray());
        }

        return null;
    }

    /**
     * @inheritdoc 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @inheritdoc 
     */
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
     * @inheritdoc 
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password 
     * 
     * @param string $password password to validate 
     * @return boolean if password provided is valid for current user 
     */
    public function validatePassword($password) {
        return $this->password === $password;
    }

}
