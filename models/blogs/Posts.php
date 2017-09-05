<?php
namespace app\models;
use Yii;
use yii\db\ActiveRecord;
?>
<?php
class Posts extends ActiveRecord {
    
    public static function tableName() {
        return '{{%posts}}';
    }

    public function rules() {
        return [
            [['autorPost', 'titlePost', 'textPost'], 'required'],
            [['datePost'], 'datetime'],
            [['autorPost', 'string', 'length' => [4, 50]]],
            [['autorPost', 'titlePost', 'textPost'], 'trim'],
            [['autorPost', 'match', 'pattern' => '/^[a-z]\w*$/i']],
        ];
    }
    
    
    public function getCategories(){
        return $this->hasOne(Categories::className(), ['idCategories' => 'id_Categories']);
    }
    
    public function getComments(){
        return $this->hasMany(Comments::className(), ['id_Comment' => 'idComment']);
    }
    
    public function getTags(){
        return $this->hasOne(Tags::className(), ['idTags' => 'id_Tags']);
    }
}
?>