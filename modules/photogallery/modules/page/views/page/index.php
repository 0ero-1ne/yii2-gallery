<?php
	use yii\helpers\Html;
	use yii\grid\GridView;
	use app\modules\photogallery\models\Image;
	use yii\widgets\LinkPager;
	use yii\widgets\Pjax;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		#container{
			border: 1px solid white;
			display: flex;
			justify-content: space-around;
			flex-wrap: wrap;
			padding-top: 20px;
		}
		.category-item{
			cursor: pointer;
			border: 1px solid black;
			width: 200px;
			margin-bottom: 20px;
			text-align: center;
		}

		.category-image{
			width: 199px;
			height: 199px;
			display: block;
			border: 1px solid black;
			border-left: none;
			border-top: none;
		}

		.span-elem{
			display: block;
			width: 199px;
			color: white;
			background-color: black;
			padding: 10px 5px;
			border: 1px solid black;
			text-align: center;
			font-size: 20px;
			opacity: 85%;
		}
	</style>
</head>
<body>

	<h1>Categories</h1>
	<h3>Amount number of categories: <?= $amount ?></h3>

	<?php
		if (!count($models)) {
			echo "<h2>No categories :(</h2>";
		} else {
	?>

	<?= LinkPager::widget([
        'pagination' => $pages,
    ]); ?>
	
	<div id="container">
		<?php
			}
			foreach ($models as $model) {
				$img = Image::find()->where(['category' => $model->title])->orderBy('id DESC')->one();

				echo "<div class='category-item'>";
					if ($img->image == NULL) {
						echo "<a href='2'><img src='/images/photogallery/No image.png' class='category-image'/></a>";
					} else {
						echo "<a href='2'><img src='/images/photogallery/$img->image' class='category-image'/></a>";
					}
					echo "<span class='span-elem'>$model->title $model->count</span>";
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
	        'item' => '.category-item',
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
		document.getElementsByClassName('summary')[0].style.display = "none";
		document.getElementsByClassName('table')[0].style.display = "none";
	</script>
</body>
</html>