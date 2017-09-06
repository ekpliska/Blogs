<?php
namespace app\models;
use yii\db\ActiveRecord;

class Tags_p extends ActiveRecord {
    public static function tableName(){
        return '{{%tags_p}}';
    }
    
    public function getPost(){
        return $this->hasOne(Posts::className(), ['idPost' => 'id_Post']);
    }
    
    public function getTag(){
        return $this->hasOne(Tags::className(), ['idTag' => 'id_Tag']);
    }
}
