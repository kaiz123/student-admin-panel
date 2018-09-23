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
class State extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_state';
    }

    /**
     * {@inheritdoc}
     */
    // public function rules()
    // {
    //     return [
    //         [['code', 'name'], 'required'],
    //         [['population'], 'integer'],
    //         [['code'], 'string', 'max' => 2],
    //         [['name'], 'string', 'max' => 52],
    //         [['code'], 'unique'],
    //     ];
    // }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function attributeLabels()
    // {
    //     return [
    //         'code' => 'Code',
    //         'name' => 'Name',
    //         'population' => 'Population',
    //     ];
    // }
}
