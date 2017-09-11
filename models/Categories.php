<?php
namespace app\models;
use Yii;
use yii\db\ActiveRecord;
?>
<?php
class Categories extends ActiveRecord {

    public static function tableName() {
        return '{{%categories}}';
    }

    public function rules() {
        return [
            [['nameCategories'], 'required'],
            [['nameCategories'], 'string', 'min' => 10, 'max' => 45],
    ];
    }
    public function getPosts(){
        return $this->hasMany(Posts::className(), ['id_Category' => 'idCategories']);
    }

    public function attributeLabels() {
        return [
            'nameCategories' => \Yii::t('common', 'Category'),
        ];
    }
}
?>
