<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EventsNormalized;

/**
 * EventsNormalizedSearch represents the model behind the search form about `app\models\EventsNormalized`.
 */
class EventsNormalizedSearch extends EventsNormalized
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cef_event_class_id', 'cef_severity', 'src_port', 'dst_port'], 'integer'],
            [['datetime', 'host', 'cef_version', 'cef_vendor', 'cef_dev_prod', 'cef_dev_version', 'cef_name', 'src_ip', 'dst_ip', 'protocol', 'src_mac', 'dst_mac', 'extensions', 'raw', 'src_country', 'dst_country', 'src_city', 'dst_city', 'src_latitude', 'dst_latitude', 'src_longitude', 'dst_longitude', 'request_url', 'request_client_application', 'request_method'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
     * @throws \yii\base\InvalidConfigException
     */
    public function search($params)
    {
        $query = EventsNormalized::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['datetime' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            // 'datetime' => $this->datetime,
            'cef_event_class_id' => $this->cef_event_class_id,
            'cef_severity' => $this->cef_severity,
            'src_port' => $this->src_port,
            'dst_port' => $this->dst_port,
        ]);

        $query->andFilterWhere(['>=', 'datetime', $this->datetime]);

        $query->andFilterWhere(['like', 'host', $this->host])
            ->andFilterWhere(['like', 'cef_version', $this->cef_version])
            ->andFilterWhere(['like', 'cef_vendor', $this->cef_vendor])
            ->andFilterWhere(['like', 'cef_dev_prod', $this->cef_dev_prod])
            ->andFilterWhere(['like', 'cef_dev_version', $this->cef_dev_version])
            ->andFilterWhere(['like', 'cef_name', $this->cef_name])
            ->andFilterWhere(['like', 'src_ip', $this->src_ip])
            ->andFilterWhere(['like', 'dst_ip', $this->dst_ip])
            ->andFilterWhere(['like', 'protocol', $this->protocol])
            ->andFilterWhere(['like', 'src_mac', $this->src_mac])
            ->andFilterWhere(['like', 'dst_mac', $this->dst_mac])
            ->andFilterWhere(['like', 'src_country', $this->src_country])
            ->andFilterWhere(['like', 'dst_country', $this->dst_country])
            ->andFilterWhere(['like', 'src_city', $this->src_city])
            ->andFilterWhere(['like', 'dst_city', $this->dst_city])
            ->andFilterWhere(['like', 'src_latitude', $this->src_latitude])
            ->andFilterWhere(['like', 'dst_latitude', $this->dst_latitude])
            ->andFilterWhere(['like', 'src_longitude', $this->src_longitude])
	    ->andFilterWhere(['like', 'dst_longitude', $this->dst_longitude])
	    ->andFilterWhere(['like', 'request_method', $this->request_method])
	    ->andFilterWhere(['like', 'request_url', $this->request_url])
	    ->andFilterWhere(['like', 'request_client_application', $this->request_client_application])
            ->andFilterWhere(['like', 'extensions', $this->extensions])
            ->andFilterWhere(['like', 'raw', $this->raw]);

        Yii::$app->cache->flush();

        return $dataProvider;
    }
}
