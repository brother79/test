<?php

/**
 * Class Url
 *
 * The followings are the available columns in table 'tbl_url':
 *
 * @property integer $id
 * @property string $source
 * @property string $short
 * @property string $tags
 * @property integer $hash
 * @property $shortUrl
 */
class Url extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className
     * @return CActiveRecord the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{url}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('source', 'required'),
            array('source', 'length', 'max' => 255),
            array('source', 'generateShort'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'source' => 'Enter a long URL to make tiny:',
        );
    }

    /**
     * @return string the URL that shows the detail of the url
     */
    public function getShortUrl()
    {
        if ($this->short) {
            return Yii::app()->createAbsoluteUrl('site/short', array(
                'short' => $this->short,
            ));
        } else {
            return '';
        }
    }

    /**
     * Generate random code for short url
     * @return string
     */
    function generateCodeRandom()
    {
        $codes = "abcdefghjkmnpqrstuvwxyz23456789ABCDEFGHJKMNPQRSTUVWXYZ";
        return $codes[rand(0, 53)] . $codes[rand(0, 53)] . $codes[rand(0, 53)] . $codes[rand(0, 53)] . $codes[rand(0, 53)] . $codes[rand(0, 53)];
    }

    /**
     * Convert int for code
     *
     * @param $number
     * @return string
     */
    function generateCode($number)
    {
        $out = "";
        $codes = "abcdefghjkmnpqrstuvwxyz23456789ABCDEFGHJKMNPQRSTUVWXYZ";

        while ($number > 53) {
            $key = $number % 54;
            $number = floor($number / 54) - 1;
            $out = $codes{$key} . $out;
        }

        return substr($codes{$number} . $out, 1, 6);
    }

    /**
     * Validator for generate short url
     * @param $attribute
     * @param $params
     */
    public function generateShort($attribute, $params)
    {
        $this->hash = md5($this->source);
        $this->short = $this->generateCode(hexdec($this->hash));
        while ($this->findByAttributes(array('short' => $this->short))) {
            $this->short = $this->generateCodeRandom();
        }
    }

}