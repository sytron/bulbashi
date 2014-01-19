<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time_register')); ?>:</b>
	<?php echo CHtml::encode($data->time_register); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('supplier')); ?>:</b>
	<?php echo CHtml::encode($data->supplier); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('items')); ?>:</b>
	<?php echo CHtml::encode($data->items); ?>
	<br />


</div>