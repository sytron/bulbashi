<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
	<?php echo CHtml::encode($data->category_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price_z')); ?>:</b>
	<?php echo CHtml::encode($data->price_z); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price_s')); ?>:</b>
	<?php echo CHtml::encode($data->price_s); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price_m')); ?>:</b>
	<?php echo CHtml::encode($data->price_m); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('dependence')); ?>:</b>
	<?php echo CHtml::encode($data->dependence); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('barcode')); ?>:</b>
	<?php echo CHtml::encode($data->barcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unit')); ?>:</b>
	<?php echo CHtml::encode($data->unit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('minimal_amount')); ?>:</b>
	<?php echo CHtml::encode($data->minimal_amount); ?>
	<br />

	*/ ?>

</div>