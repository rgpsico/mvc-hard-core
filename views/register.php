<?php

/** @var $model \app\models\User */


?>

<h1>create account</h1>

<?php $form = \app\core\form\Form::begin('', 'post') ?>
<?php echo $form->field($model, 'firstname'); ?>
<?php echo $form->field($model, 'lastname'); ?>
<?php echo $form->field($model, 'email'); ?>
<?php echo $form->field($model, 'password')->passwordField();; ?>
<?php echo $form->field($model, 'confirmPassword')->passwordField(); ?>
<input type="submit" class="btn btn-success">
<?php $form = \app\core\form\Form::end() ?>