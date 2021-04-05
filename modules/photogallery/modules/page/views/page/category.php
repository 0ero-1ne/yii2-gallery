<?php
	use yii\helpers\Html;
	use yii\grid\GridView;
	use app\modules\photogallery\models\Image;
	use yii\widgets\LinkPager;
	use yii\widgets\Pjax;
?>

<style>
		#container{
			border: 5px solid black;
			display: flex;
			justify-content: space-around;
			flex-wrap: wrap;
			padding-top: 20px;
			border-radius: 30px;
		}
		.image-item{
			cursor: pointer;
			width: 200px;
			margin-bottom: 20px;
			text-align: center;
			border: 1px solid black;
		}

		.small-image{
			width: 198px;
			height: 198px;
			display: block;
			border-left: none;
			border-top: none;
		}
</style>

<p>
	<h1>Category images: <?= $category->title ?></h1>
	<h3>Amount number of images: <?= $amount ?></h3>
</p>

<?php
	if (!count($models)) {
		echo "<h2>No images :(</h2>";
	} else {
?>

<?= LinkPager::widget([
    'pagination' => $pages,
]); ?>

<div id="container">
	<?php
		}
		foreach ($models as $model) {
			echo "<div class='image-item'>";
					echo "<img src='/images/photogallery/$model->image' class='small-image'/>";
			echo "</div>";
		}
	?>
</div>

<?php Pjax::begin() ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'pager' => [
        'class' => \kop\y2sp\ScrollPager::className(),
        'container' => '#container',
        'item' => '.image-item',
        'paginationSelector' => '.grid-view .pagination',
        'triggerTemplate' => '<tr class="ias-trigger"><td colspan="100%" style="text-align: center"><a style="cursor: pointer">{text}</a></td></tr>',
        //'noneLeftText' => '<h2>Nothing more</h2>',
        'enabledExtensions'  => [
	        \kop\y2sp\ScrollPager::EXTENSION_SPINNER,
	        //\kop\y2sp\ScrollPager::EXTENSION_NONE_LEFT,
		],
    ],
]); ?>
<?php Pjax::end() ?>

<script type="text/javascript">
	var summary = document.getElementsByClassName('summary');

	if (summary.length == 0) {
		document.getElementsByClassName('table')[0].style.display = "none";
	} else if (summary.length > 0) {
		document.getElementsByClassName('summary')[0].style.display = "none";
		document.getElementsByClassName('table')[0].style.display = "none";
	}
</script>