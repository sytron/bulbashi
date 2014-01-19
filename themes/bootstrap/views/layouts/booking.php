<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/mainFrontend'); ?>
<div class="row">
    <div class="span2"></div>
    <div class="span8">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
    <div class="span2"></div>
</div>
<?php $this->endContent(); ?>