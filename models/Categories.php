<?php
    namespace app\models;
    use Yii;
    use yii\db\ActiveRecord;
    use yii\behaviors\SluggableBehavior;
?>
<?php
class Categories extends ActiveRecord {

    public static function tableName() {
        return '{{%categories}}';
    }

    public function behaviors () {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'nameCategories',
            ],
        ];
    }

    public function rules() {
        return [
            [['nameCategories'], 'required'],
            [['nameCategories'], 'string', 'min' => 10, 'max' => 45],
            [['slug'], 'string', 'max' => 100],
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
