<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserHasCourse;

/**
 * UserHasCourseSearch represents the model behind the search form about `app\models\UserHasCourse`.
 */
class UserHasCourseSearch extends UserHasCourse {

    /**
     * add related fields to searchable attributes
     * @return type
     */
    public function attributes() {
        return array_merge(parent::attributes(), ['course.name', 'user.username', 'user.role.name']);
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'course_id'], 'integer'],
            [['course.name', 'user.username', 'user.role.name'], 'safe'],
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
        $query = UserHasCourse::find()
                ->joinWith('course')
                ->joinWith('user')
                ->innerJoin('role', 'role.id = user.role_id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        /**
         * sortin related columns
         */
        $dataProvider->sort->attributes['course.name'] = [
            'asc' => ['course.name' => SORT_ASC],
            'desc' => ['course.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['user.username'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['user.role.name'] = [
            'asc' => ['role.name' => SORT_ASC],
            'desc' => ['role.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'course_id' => $this->course_id,
        ]);

        $query->andFilterWhere(['LIKE', 'course.name', $this->getAttribute('course.name')]);
        $query->andFilterWhere(['LIKE', 'user.username', $this->getAttribute('user.username')]);
        $query->andFilterWhere(['LIKE', 'role.name', $this->getAttribute('user.role.name')]);


        return $dataProvider;
    }

}
