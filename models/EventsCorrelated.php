<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "events_correlated".
 *
 * @property string $id
 * @property string $datetime
 * @property string $host
 * @property string $cef_version
 * @property string $cef_vendor
 * @property string $cef_dev_prod
 * @property string $cef_dev_version
 * @property integer $cef_event_class_id
 * @property string $cef_name
 * @property integer $cef_severity
 * @property integer $parent_events
 * @property string $raw
 * @property string $attack_type
 */
class EventsCorrelated extends BaseEvent
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'events_correlated';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['datetime'], 'safe'],
            [['cef_version', 'cef_vendor', 'cef_dev_prod', 'cef_dev_version', 'cef_event_class_id', 'cef_name', 'cef_severity', 'parent_events'], 'required'],
            [['cef_event_class_id', 'cef_severity'], 'integer'],
            [['raw'], 'string'],
            [['host', 'cef_version', 'cef_vendor', 'cef_dev_prod', 'cef_dev_version', 'cef_name', 'parent_events', 'attack_type'], 'string', 'max' => 255],
            /* TODO otestovat a tento riadok vymazat [['host', 'cef_version', 'cef_vendor', 'cef_dev_prod', 'cef_dev_version', 'cef_name', 'parent_events'], 'string', 'max' => 255], */
        ];
    }

    public static function columns()
    {
        return [
            'id' => [ FilterTypeEnum::COMPARE ],
            'datetime' => [ FilterTypeEnum::DATE ],
            'host' => [ FilterTypeEnum::REGEX, FilterTypeEnum::COMPARE ],
            'cef_version' => [ FilterTypeEnum::REGEX, FilterTypeEnum::COMPARE ],
            'cef_vendor' => [ FilterTypeEnum::REGEX, FilterTypeEnum::COMPARE ],
            'cef_dev_prod' => [ FilterTypeEnum::REGEX, FilterTypeEnum::COMPARE ],
            'cef_dev_version' => [ FilterTypeEnum::REGEX, FilterTypeEnum::COMPARE ],
            'cef_event_class_id' => [ FilterTypeEnum::COMPARE ],
            'cef_name' => [ FilterTypeEnum::REGEX, FilterTypeEnum::COMPARE ],
            'cef_severity' => [ FilterTypeEnum::COMPARE ],
            'parent_events' => [ FilterTypeEnum::REGEX, FilterTypeEnum::COMPARE ],
            /* TODO asi odkomentovat 'attack_type' => [ FilterTypeEnum::REGEX, FilterTypeEnum::COMPARE ], */
            'raw' => [ FilterTypeEnum::REGEX, FilterTypeEnum::COMPARE ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function labels()
    {
        return [
            'id' => 'ID',
            'datetime' => 'Datetime',
            'host' => 'Host',
            'cef_version' => 'Cef Version',
            'cef_vendor' => 'Cef Vendor',
            'cef_dev_prod' => 'Cef Dev Prod',
            'cef_dev_version' => 'Cef Dev Version',
            'cef_event_class_id' => 'Cef Event Class ID',
            'cef_name' => 'Cef Name',
            'cef_severity' => 'Cef Severity',
            'parent_events' => 'Parent Events',
            'raw' => 'Raw',
            'attack_type' => 'Attack type',
        ];
    }
}
