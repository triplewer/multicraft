<?php
/**
 *
 *   Copyright © 2010-2012 by xhost.ch GmbH
 *
 *   All rights reserved.
 *
 **/

$this->pageTitle=Yii::app()->name . ' - '.Yii::t('admin', 'Add or Remove Files');
$this->breadcrumbs=array(
    Yii::t('admin', 'Settings')=>array('index'),
    Yii::t('admin', 'Update Minecraft'),
    Yii::t('admin', 'Add or Remove Files'),
);

$this->menu=array(
    array(
        'label'=>Yii::t('admin', 'Back'),
        'url'=>array('daemon/updateMc'),
        'icon'=>'arrow-left',
    ),
);
?>
<?php if(Yii::app()->user->hasFlash('files-success')): ?>
<div class="alert alert-success">
    <?php echo Yii::app()->user->getFlash('files-success'); ?>
</div>
<?php endif ?>
<?php if(Yii::app()->user->hasFlash('files-error')): ?>
<div class="alert alert-danger">
    <?php echo Yii::app()->user->getFlash('files-error'); ?>
</div>
<?php endif ?>
<?php echo CHtml::beginForm() ?>

<?php echo CHtml::dropDownList('daemon_id', $daemon_id, array(''=>Yii::t('admin', 'All Daemons')) + McBridge::get()->conStrings()) ?>

<table class="table table-striped detail-view">
<tr class="titlerow">
    <td colspan="2"><?php echo Yii::t('admin', 'Add Files') ?></td>
</tr>
<tr>
    <th>
        Download Target
    </th>
    <td>
        <?php echo CHtml::textField('download-target', @$_POST['download-target']) ?>
    </td>
</tr>
<tr>
    <th>
        <?php echo Yii::t('admin', 'File URL') ?>
    </th>
    <td>
        <?php echo CHtml::textField('download-file', @$_POST['download-file'], array('style'=>'width: 95%')) ?>
    </td>
</tr>
<tr>
    <th>
        <?php echo Yii::t('admin', 'Conf URL') ?>
    </th>
    <td>
        <?php echo CHtml::textField('download-conf', @$_POST['download-conf'],  array('style'=>'width: 95%')) ?>
    </td>
</tr>
<tr>
    <th>
        &nbsp;
    </th>
    <td>
        <?php
        echo CHtml::submitButton(Yii::t('admin', 'Add'), array('name'=>'do_download'));
        ?>
    </td>
</tr>
</table>

<table class="table table-striped detail-view">
<tr class="titlerow">
    <td colspan="2"><?php echo Yii::t('admin', 'Remove Files') ?></td>
</tr>
<tr>
    <td>
        <?php
        if (count($jars))
            echo CHtml::dropDownList('delete-target', @$_POST['delete-target'], $jars);
        else
            echo CHtml::textField('delete-target', @$_POST['delete-target']);
        ?>
    </td>
    <td>
        <?php echo Yii::t('admin', 'Type') ?>
    </td>
    <td>
        <?php echo CHtml::dropDownList('delete-file', @$_POST['delete-file'], array(''=>'Select', 'file'=>'JAR File', 'conf'=>'.conf File', 'both'=>'Both Files'), array('style'=>'width: 95%')) ?>
    </td>
    <td>
        <?php echo CHtml::submitButton(Yii::t('admin', 'Remove'), array('name'=>'do_delete')) ?>
    </td>
</tr>
</table>
<?php echo CHtml::endForm() ?>
<div class="infoBox">
<?php echo Yii::t('admin', 'The target filename should always be of the format "example.jar". The downloaded files will automatically be named "example.jar" and "example.jar.conf" no matter how they were named in their original location. To skip one of the files you can simply leave the URL field empty.') ?><br/>
<br/>
<?php echo Yii::t('admin', 'When you want to delete the "example.jar.conf" you can enter "example.jar" as the file to delete and then select ".conf File" in the drop down menu. Seleting "Both Files" will delete both the "example.jar" and the "example.jar.conf".') ?>
</div>
