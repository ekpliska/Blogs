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
            [['nameTag'], 'string', 'min' => 10, 'max' => 30],
        ];
    }

    public function getTagsP(){
        return $this->hasMany(Tags_p::className(), ['id_Tag' => 'idTag']);
    }

    // Posts.idPost => tags_p.id_Post ; tags_p.id_Tag => Posts.idPost
    public function getPost(){
        return $this->hasMany(Posts::className(), ['idPost' => 'id_Post']) ->viaTable('{{%tags_p}}', ['id_Tag' => 'idPost']);
    }

    public function attributeLabels() {
        return [
            'nameTag' => \Yii::t('common', 'Tag'),
        ];
    }
}
?>
