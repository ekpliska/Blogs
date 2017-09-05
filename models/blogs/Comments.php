<?php
namespace app\models;
use Yii;
use yii\db\ActiveRecord;
?>
<?php
class Comments extends ActiveRecord {
    
    public static function tableName() {
        return '{{%comments}}';
    }
    
    public function rules() {
        return [
            [['autorComment', 'textComment', 'dateComment'], 'required'],
            [['autorComment', 'textComment'], 'trim'],
            [['dateComment'], 'date'],
            [['autorComment', 'string', 'length' => [4, 50]]],
            [['textComment', 'string', 'length' => [5, 1000]]],
            [['autorComment', 'textComment'], 'trim'],
            [['autorComment', 'match', 'pattern' => '/^[a-z]\w*$/i']],            
        ];
    }

    public function getPosts(){
        return $this->hasMany(Posts::className(), ['id_Comment' => 'idComment']);
    }
}