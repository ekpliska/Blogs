<?php
namespace app\models;
use Yii;
use yii\db\ActiveRecord;
?>
<?php
class Tags extends ActiveRecord {

    public static function tableName() {
        return '{{%tags}}';
    }
    
    public function rules() {
        return [
            [['nameTag'], 'required'],
            [['nameTag', 'string', 'length' => [10, 30]]],
        ];
    }

    public function getPosts(){
        return $this->hasMany(Posts::className(), ['id_Post' => 'idPost']);
    }
}
?>
