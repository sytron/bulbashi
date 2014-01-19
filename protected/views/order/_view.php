<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_id')); ?>:</b>
	<?php echo CHtml::encode($data->client_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time_created')); ?>:</b>
	<?php echo CHtml::encode($data->time_created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cost')); ?>:</b>
	<?php echo CHtml::encode($data->cost); ?>
	<br />


</div>