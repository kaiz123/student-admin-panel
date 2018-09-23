<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "signup".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $mobile
 * @property string $state
 * @property string $city
 * @property string $location
 * @property string $dob
 * @property string $gender
 * @property string $username
 * @property string $password
 */

class Signup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $Profile_Pic;
    public static function tableName()
    {
        return 'signup';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name','email', 'mobile'], 'required'],
            [['email', 'mobile', 'state', 'city', 'location', 'dob', 'gender'], 'string', 'max' => 100],
            ['email', 'email'],
            ['email', 'unique'],
            ['mobile', 'unique'],
            [['Profile_Pic'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg','minWidth' => 100, 'maxWidth' => 1000,
        'minHeight' => 100, 'maxHeight' => 1000,],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'mobile' => 'Mobile',
            'state' => 'State',
            'city' => 'City',
            'location' => 'Location',
            'dob' => 'Dob',
            'gender' => 'Gender',
            'Profile_Pic' => 'Profile_Pic'
        ];
    }


    public function upload($name)
    {
        if ($this->validate()) {
            $this->Profile_Pic->saveAs('../web/uploads/' . $name. '.' . $this->Profile_Pic->extension);
            return true;
        } else {
            return false;
        }
    }


    public static function findById($signup_id)
    {
        return self::findOne(['id' => $signup_id]);
    }
}
