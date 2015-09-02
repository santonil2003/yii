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
 * @property string $auth_key
 * @property string $access_token
 * @property string $created_at
 * @property string $modified_at
 *
 * @property Role $role
 * @property UserHasCourse[] $userHasCourses
 * @property Course[] $courses
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {

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
            [['first_name', 'username', 'password', 'email', 'active', 'role_id'], 'required'],
            [['active', 'role_id'], 'integer'],
            [['created_at', 'modified_at'], 'safe'],
            [['first_name', 'last_name', 'username', 'password', 'email', 'auth_key', 'access_token'], 'string', 'max' => 255]
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
            'role_id' => 'Role',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
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

    /*     * ****************************************************Modifiy below****************************************************** */

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
        return $this->auth_key;
    }

    /**
     * @inheritdoc  
     */
    public function validateAuthKey($authKey) {
        return $this->auth_key === $authKey;
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

    /**
     * @inheritdoc  
     */
    public static function findIdentity($id) {
        return static::findOne($id);
    }

    /**
     * @inheritdoc  
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username  
     *  
     * @param string    $username  
     * @return static|null  
     */
    public static function findByUsername($username) {
        return static::findOne(['username' => $username]);
    }

    /**
     * get current user
     * @return type
     */
    public static function getCurrentUser() {
        return \Yii::$app->user->identity;
    }

    /**
     * is User admin
     * @return boolean
     */
    public static function isUserAdmin() {
        $user = self::getCurrentUser();

        if (!is_object($user)) {
            return false;
        }

        return ($user->role_id == '1') ? true : false;
    }

    public static function getActiveLabel($active) {
        switch ($active) {
            case '0':
                return 'Inactive';
            case '1':
                return 'Active';
            default:
                return 'Unknown';
        }
    }

    /**
     * generate random auth key 
     * @param type $insert 
     * @return boolean 
     */
    public function beforeSave($insert) {

        if (parent::beforeSave($insert)) {

            $this->modified_at = date('Y-m-d H:i:s');

            if ($this->isNewRecord) {
                $this->access_token = \Yii::$app->security->generateRandomString();
                $this->auth_key = \Yii::$app->security->generateRandomString();
                $this->created_at = date('Y-m-d H:i:s');
            }
            return true;
        }
        return false;
    }

}
