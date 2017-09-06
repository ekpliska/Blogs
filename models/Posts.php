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
    
    public function getTagsPost(){
        return $this->hasMany(Tags_p::className(), ['id_Post' => 'idPost']);
    }
    
    // Tags.idTag => tags_p.id_Tag ; tags_p.id_Post => Tags.idTag
    public function getTag(){
        return $this->hasMany(Tags::className(), ['idTag' => 'id_Tag']) ->viaTable('{{%tags_p}}', ['id_Post' => 'idTag']);
    }
}
?>