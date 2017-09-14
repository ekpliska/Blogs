<?php
    namespace app\models;
    use Yii;
    use yii\db\ActiveRecord;
    use yii\behaviors\SluggableBehavior;
?>
<?php
class Posts extends ActiveRecord {
    public $_selectTagID = array();

    public static function tableName() {
        return '{{%posts}}';
    }

    public function behaviors ()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'titlePost',
            ],
        ];
    }

    public function rules() {
        return [
            [['autorPost', 'titlePost', 'textPost', 'id_Category', 'datePost'], 'required'],
            [['datePost'], 'date', 'format' => 'php:Y-m-d', 'timestampAttribute' => 'datePost'],
            [['autorPost'], 'string', 'min' => 4, 'max' => 50],
            [['autorPost', 'titlePost', 'textPost'], 'trim'],
            [['date'], 'safe'],
            [['selectTagID'], 'safe'],
            //[['autorPost'], 'match', 'pattern' => '/^[a-z]\w*$/i'],
        ];
    }

    public function setSelectTagID ($idTags) {
        $this->_selectTagID = (array) $idTags;
    }

    public function getselectTagID (){
        return $this->getRelation('tags_p')->indexBy('id_Tag')->select('id_Tag')->column();
    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        $this->unlinkAll('tags_p', true);
        $addtags = Tags::find()->where(['idTag' => $this->_selectTagID])->all();
        // if ($insert) {
            $tagssave = New Tags_p;
            foreach ($addtags as $tag) {
                $tagssave->isNewRecord = true;
                $tagssave->idTags_p = null;
                $tagssave->id_Tag = $tag->idTag;
                $tagssave->id_Post = $this->idPost;
                $tagssave->save();
            }
        // }
    }

    public function afterDelete () {
        parent::afterDelete();
        //$comments = Comments::find()->where(['id_Post' => $this->idPost])->all();
        Comments::deleteAll(['id_Post' => $this->idPost]);
        Tags_p::deleteAll(['id_Post' => $this->idPost]);
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->datePost = Yii::$app->formatter->asDate($this->datePost, 'php:d.m.Y');
    }

    public function getCategories(){
        return $this->hasOne(Categories::className(), ['idCategories' => 'id_Categories']);
    }

    // public function getComments(){
    //     return $this->hasMany(Comments::className(), ['idComment' => 'id_Comment']);
    // }

    public function getTags_p(){
        return $this->hasMany(Tags_p::className(), ['id_Post' => 'idPost']);
    }

    // Tags.idTag => tags_p.id_Tag ; tags_p.id_Post => Tags.idTag
    public function getTag(){
        return $this->hasMany(Tags::className(), ['idTag' => 'id_Tag']) -> viaTable('{{%tags_p}}', ['id_Post' => 'idPost']);
    }

    public function attributeLabels() {
        return [
            'autorPost' => \Yii::t('common', 'Author post'),
            'titlePost' => \Yii::t('common', 'Title post'),
            'datePost' => \Yii::t('common', 'Date post'),
            'textPost' => \Yii::t('common', 'Text post'),
            'id_Category' => \Yii::t('common', 'Category'),
            'selectTag' => \Yii::t('common', 'Select tags')
        ];
    }
}
?>
