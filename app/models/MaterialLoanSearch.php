<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MaterialLoan;
use Yii;

/**
 * MaterialLoanSearch represents the model behind the search form of `app\models\MaterialLoan`.
 */
class MaterialLoanSearch extends MaterialLoan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['loanDate', 'returnDate', 'materialLoanId', 'accountId', 'materialId'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = MaterialLoan::find();
        $query->joinWith(['account']);
        $query->joinWith(['materialCategory']);
        $query->joinWith(['material']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'materialLoanId' => $this->materialLoanId,
            'material.inventoryNumber' => $this->materialId
        ]);
        $query->andFilterWhere(['like', 'account.email', $this->accountId])
            ->andFilterWhere(['like', 'material_category.name', $this->materialId])
            ->andFilterWhere(['like', 'loanDate', $this->loanDate])
            ->andFilterWhere(['like', 'returnDate', $this->returnDate]);

        return $dataProvider;
    }
}
