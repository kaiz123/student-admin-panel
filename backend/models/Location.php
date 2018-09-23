<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "country".
 *
 * @property string $code
 * @property string $name
 * @property int $population
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_locations';
    }

    public static function getLocationsList($state_id,$city_id){
        $LocationList = self::findAll(['gt_state' =>$state_id,'gt_city' =>$city_id]);
        $arr=array();
        $outer=array();
        foreach ($LocationList as $location) {
            $inner=["id"=>($location->gt_id),"name"=>($location->gt_locality)];
            array_push($arr,$inner);
        }

        $new_array = array('out'=>$arr,'selected'=>'1');

        array_merge($outer, $new_array);
        return $arr;
    }
}
