<?php

namespace admin\models;

use common\models\User;
use yii\data\ActiveDataProvider;

class UserSearch extends User
{
    public function rules()
    {
        return [
            [['cellphone', 'name'], 'string'],
            [['created_at'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                    'id' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'cellphone', $this->cellphone])
            ->andFilterWhere(['like', 'name', $this->name]);


        $timeRangeAttributes = ['created_at'];
        foreach ($timeRangeAttributes as $attribute) {
            if ($this->$attribute) {
                list($start, $end) = explode(' - ', $this->$attribute);
                $query->andWhere(['between', $attribute, strtotime($start), strtotime($end)]);
            }
        }

        return $dataProvider;
    }
}
