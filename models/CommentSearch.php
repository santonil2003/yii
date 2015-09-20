<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Comment;

/**
 * CommentSearch represents the model behind the search form about `app\models\Comment`.
 */
class CommentSearch extends Comment {

    /**
     * related column
     * @var type 
     */
    public $videoTitle;
    public $username;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'video_id', 'user_id'], 'integer'],
            [['text', 'created_at', 'modified_at', 'videoTitle', 'username'], 'safe'],
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
        $query = Comment::find()
                ->select('comment.*, video.title, user.username')
                ->innerJoin('video', '`video`.`id` = `comment`.`video_id`')
                ->innerJoin('user', '`user`.`id` = `comment`.`user_id`');

        // echo $query->createCommand()->sql;exit;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        /**
         * Setup your sorting attributes
         * Note: This is setup before the $this->load($params) 
         * statement below
         */
        $dataProvider->setSort([
            'attributes' => [
                'id',
                'text' => [
                    'asc' => ['comment.text' => SORT_ASC],
                    'desc' => ['comment.text' => SORT_DESC]
                ],
                'videoTitle' => [
                    'asc' => ['video.title' => SORT_ASC],
                    'desc' => ['video.title' => SORT_DESC]
                ],
                'username' => [
                    'asc' => ['user.username' => SORT_ASC],
                    'desc' => ['user.username' => SORT_DESC]
                ],
                'created_at' => [
                    'asc' => ['comment.created_at' => SORT_ASC],
                    'desc' => ['comment.created_at' => SORT_DESC]
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        /* ---------------------------------------------------------------------/
         * Filter
         * --------------------------------------------------------------------- */
        $query->andFilterWhere([
            'comment.id' => $this->id,
            'comment.video_id' => $this->video_id,
            'comment.user_id' => $this->user_id,
            'comment.created_at' => $this->created_at,
            'comment.modified_at' => $this->modified_at,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text]);
        /**
         * for related column
         */
        $query->andFilterWhere(['like', 'video.title', $this->videoTitle]);
        $query->andFilterWhere(['like', 'user.username', $this->username]);


        return $dataProvider;
    }

}
