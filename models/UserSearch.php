<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User {

    /**
     * related columns
     */
    public $roleName;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'active', 'role_id'], 'integer'],
            [['first_name', 'last_name', 'username', 'password', 'email', 'auth_key', 'access_token', 'created_at', 'modified_at', 'roleName'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = User::find()->joinWith('role');


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);


        /**
         * sortin related columns
         */
        $dataProvider->sort->attributes['roleName'] = [
            'asc' => ['role.name' => SORT_ASC],
            'desc' => ['role.name' => SORT_DESC],
        ];

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'user.id' => $this->id,
            'user.active' => $this->active,
            'user.role_id' => $this->role_id,
            'user.created_at' => $this->created_at,
            'user.modified_at' => $this->modified_at,
        ]);

        $query->andFilterWhere(['like', 'user.first_name', $this->first_name])
                ->andFilterWhere(['like', 'user.last_name', $this->last_name])
                ->andFilterWhere(['like', 'user.username', $this->username])
                ->andFilterWhere(['like', 'user.password', $this->password])
                ->andFilterWhere(['like', 'user.email', $this->email])
                ->andFilterWhere(['like', 'user.auth_key', $this->auth_key])
                ->andFilterWhere(['like', 'user.access_token', $this->access_token])
                ->andFilterWhere(['like', 'role.name', $this->roleName]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function studentSearch($params) {

        $courseIds = \app\components\OvcCourse::getUserCourseIds();
        $userIds = \app\components\OvcUser::getUserIdsByCourseIds($courseIds);

        $query = User::find()->joinWith('role')->where(['user.id' => $userIds, 'user.role_id' => \app\components\OvcRole::STUDENT]);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);


        /**
         * sortin related columns
         */
        $dataProvider->sort->attributes['roleName'] = [
            'asc' => ['role.name' => SORT_ASC],
            'desc' => ['role.name' => SORT_DESC],
        ];

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'user.id' => $this->id,
            'user.active' => $this->active,
            'user.role_id' => $this->role_id,
            'user.created_at' => $this->created_at,
            'user.modified_at' => $this->modified_at,
        ]);

        $query->andFilterWhere(['like', 'user.first_name', $this->first_name])
                ->andFilterWhere(['like', 'user.last_name', $this->last_name])
                ->andFilterWhere(['like', 'user.username', $this->username])
                ->andFilterWhere(['like', 'user.password', $this->password])
                ->andFilterWhere(['like', 'user.email', $this->email])
                ->andFilterWhere(['like', 'user.auth_key', $this->auth_key])
                ->andFilterWhere(['like', 'user.access_token', $this->access_token])
                ->andFilterWhere(['like', 'role.name', $this->roleName]);

        return $dataProvider;
    }

}
