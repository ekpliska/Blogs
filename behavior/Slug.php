<?php
    namespace app\behavior;
    use yii;
    use yii\base\Behavior;
    use yii\db\ActiveRecord;
    use yii\helpers\Inflector;
?>
<?php
class Slug extends Behavior
{
	public $in_attribute;
	public $out_attribute = 'slug';
	public $translit = true;




	public function events()
	{
		return [
			ActiveRecord::EVENT_BEFORE_VALIDATE => 'getSlug'
		];
	}

    static public function translateSlug ($slug) {
        $alp = array (
            'A' => 'a', 'Б' => 'b', 'В' => 'v', 'Г' => 'g',
            ' ' => '_'
        );
    }

	public function getSlug ($event) {
		if (empty($this->owner->{$this->out_attribute})) {
            $this->owner->{$this->out_attribute} = $this->generateSlug($this->owner->{$this->in_attribute});
		} else {
			$this->owner->{$this->out_attribute} = $this->generateSlug($this->owner->{$this->out_attribute});
		}
	}

	private function generateSlug ($slug) {
		$slug = $this->slugify($slug);
		if ( $this->checkUniqueSlug($slug) ) {
			return $slug;
		} else {
			for ($suffix = 2; !$this->checkUniqueSlug ($new_slug = $slug . '_' . $suffix); $suffix++) {}
			return $new_slug;
		}
	}

	private function slugify ($slug) {
		if ($this->translit) {
			//return Inflector::slug( TransliteratorHelper::process( $slug ), '-', true );
            //return $this->slug ($slug , '_', true);
            return $this->slug (translateSlug($slug, $alp) , '_', true);
		} else {
			return $this->slug ($slug, '_', true);
		}
	}

	private function slug ($string, $replacement = '_', $lowercase = true) {
		$string = preg_replace('/[^\p{L}\p{Nd}]+/u', $replacement, $string);
		$string = trim ($string, $replacement);
		return $lowercase ? strtolower ($string) : $string;
	}

	private function checkUniqueSlug ($slug) {
		$pk = $this->owner->primaryKey();
		$pk = $pk[0];
		$condition = $this->out_attribute . ' = :out_attribute';
		$params = [':out_attribute' => $slug];
		if (!$this->owner->isNewRecord) {
			$condition .= ' and ' . $pk . ' != :pk';
			$params[':pk'] = $this->owner->{$pk};
		}
		return !$this->owner->find()
			->where( $condition, $params )
			->one();
	}
}
