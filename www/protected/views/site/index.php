<?php
/* @var $this SiteController */
/* @var $model Url */
/* @var $modelNew Url */

$this->pageTitle = Yii::app()->name;
?>
<?php if ($model): ?>
    <?php $this->renderPartial('_view', array(
        'data' => $model,
    )); ?>
<?php endif ?>
<?php echo $this->renderPartial('_form', array('model' => $modelNew)); ?>
