<?php

/**
 * 
 *  @var $titulo \app\core\View
 * 
 */

$this->title = 'Contact';
?>

<?php $form = \app\core\form\Form::begin('', 'post') ?>
<?php echo $form->field($model, 'subject'); ?>
<?php echo $form->field($model, 'email'); ?>
<?php echo  new \app\core\form\textAreaField($model, 'body') ?>
<input type="submit" class="btn btn-success">
<?php $form = \app\core\form\Form::end() ?>