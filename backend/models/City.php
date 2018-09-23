<?php



use Yii;
namespace app\models;

/**
 * This is the model class for table "country".
 *
 * @property string $code
 * @property string $name
 * @property int $population
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_city';
    }

    public static function getCityList($state_id){
        $CityList = self::findAll(['gt_stateid' =>$state_id]);
        $arr=array();
        foreach ($CityList as $city) {
            $inner=["id"=>($city->gt_id),"name"=>($city->gt_city)];
            array_push($arr,$inner);
        }
        return $arr;
    }
}
