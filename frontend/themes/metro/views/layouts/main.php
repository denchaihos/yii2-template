<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\themes\metro\MetroAsset;

/**
 * @var $this \yii\base\View
 * @var $content string
 */
// $this->registerAssetBundle('app');
MetroAsset::register($this);
$asset_path = Yii::$app->assetManager->getPublishedUrl('@frontend/themes/metro/assets');
?>
<?php $this->beginPage(); ?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
	<?php $this->beginBody() ?>

	<div class="metro-layout horizontal">
		<div class="header">
			<h1><?php echo Html::encode($this->title); ?></h1>
			<div class="controls">
				<span class="down" title="Scroll down"></span>
				<span class="up" title="Scroll up"></span>
				<span class="next" title="Scroll left"></span>
				<span class="prev" title="Scroll right"></span>
				<span class="toggle-view" title="Toggle layout"></span>
			</div>
		</div>
		<div class="content clearfix">
			<div class="items">
				<a class="box" href="#">
					<span>Mail</span>
					<img class="icon" src="<?= $asset_path; ?>/images/mail.png" alt="" />
				</a>
				<a class="box" href="#" style="background: #6b6b6b;">
					<span>Settings</span>
					<img class="icon" src="<?= $asset_path; ?>/images/settings.png" alt="" />
				</a>
				<a class="box" href="#" style="background: #43b51f;">
					<span>Make a call</span>
					<img class="icon" src="<?= $asset_path; ?>/images/phone.png" alt="" />
				</a>
				<a class="box width2 height2" href="#">
					<span>Photos</span>
					<img class="cover" src="<?= $asset_path; ?>/images/gallery.jpg" alt="" />
				</a>
				<a class="box" href="#" style="background: #00aeef;">
					<span>Music</span>
					<img class="icon" src="<?= $asset_path; ?>/images/music.png" alt="" />
				</a>
				<a class="box" href="#" style="background: #f58d00;">
					<span>Firefox</span>
					<img class="icon" src="<?= $asset_path; ?>/images/firefox.png" alt="" />
				</a>
				<a class="box" href="#" style="background: #640f6c;">
					<span>Yahoo</span>
					<img class="icon" src="<?= $asset_path; ?>/images/yahoo.png" alt="" />
				</a>
				<a class="box height2" href="#" style="background: #d32c2c;">
					<span>GMail</span>
					<img class="icon big" src="<?= $asset_path; ?>/images/gmail.png" alt="" />
				</a>
				<a class="box" href="#" style="background: #3c5b9b;">
					<span>Facebook</span>
					<img class="icon" src="<?= $asset_path; ?>/images/facebook.png" alt="" />
				</a>
				<a class="box" href="#" style="background: #ffc808;">
					<span>Winamp</span>
					<img class="icon" src="<?= $asset_path; ?>/images/winamp.png" alt="" />
				</a>
				<a class="box" href="#" style="background: #00a9ec;">
					<span>Tasks</span>
					<img class="icon" src="<?= $asset_path; ?>/images/tasks.png" alt="" />
				</a>
				<a class="box height2" href="#" style="background: #4c5e51;">
					<span>DeviantART</span>
					<img class="icon big" src="<?= $asset_path; ?>/images/deviantart.png" alt="" />
				</a>
				<a class="box" href="#" style="background: #f874a4;">
					<span>Dribbble</span>
					<img class="icon" src="<?= $asset_path; ?>/images/dribbble.png" alt="" />
				</a>
			</div>
		</div>
	</div>


	<?php $this->endBody(); ?>
</body>
</html>

<?php $this->endPage(); ?>
