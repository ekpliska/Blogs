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
            [['autorComment', 'textComment', 'id_Post', 'idComment', 'dateComment'], 'required'],
            [['autorComment', 'textComment'], 'trim'],
            [['autorComment'], 'string', 'min' => 4, 'max' => 50],
            [['textComment'], 'string', 'min' => 5, 'max' => 255],
            //[['dateComment'], 'datetime'],
        ];
    }

    public function getPosts(){
        return $this->hasOne(Posts::className(), ['idComment' => 'id_Comment']);
    }

    public function attributeLabels() {
        return [
            'autorComment' => \Yii::t('common', 'Author comment') ,
            'dateComment' => \Yii::t('common', 'Date comment'),
            'textComment' => \Yii::t('common', 'Comment'),
        ];
    }
}
