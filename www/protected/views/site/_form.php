<?php
/* @var $model Url */
/* @var $form CBaseController */
?>
<div class="form">

    <?php $form = $this->beginWidget('CActiveForm'); ?>

    <?php echo CHtml::errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'source'); ?>
        <?php echo $form->textField($model, 'source', array('size' => 80, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'source'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::ajaxSubmitButton('Generate', '', array(
                'type' => 'POST',
                'update' => '#content',
            ),
            array(
                'type' => 'submit'
            )); ?>

    </div>
    <?php $this->endWidget(); ?>
</div>
<!-- form -->