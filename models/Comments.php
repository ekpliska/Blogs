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