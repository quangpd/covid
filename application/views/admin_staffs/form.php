<form class="form-horizontal" role="form">
	<input type="hidden" name="id" id="id" />
	<input type="hidden" name="parent_id" id="parent_id" value="" />
	<div class="form-group">
		<?php echo form_label('Trạng thái', 'status', array('class' => 'control-label col-sm-3 col-xs-3')); ?>
		<div class="col-sm-9">
			<input type="checkbox" name="status" id="status" value="1" data-plugin="switchery" data-color="#23b195" data-size="small" <?php echo set_value("status", $item->status) == 1 ? 'checked="checked"' : ""; ?> />
		</div>
	</div>
	<div class="form-group">
		<?php echo form_label('Hiển thị', 'display', array('class' => 'col-xs-3 col-sm-3 control-label')); ?>
		<div class="col-xs-9 col-sm-9">
			<input name="display" value="1" type="checkbox" data-plugin="switchery" data-color="#23b195" data-size="small" <?php echo $item->display == 1 ? "checked" : "" ?> />
		</div>
	</div>
	<div class="form-group">
		<?php echo form_label('Tiêu đề', "title", array('class' => 'control-label col-sm-3 col-xs-3')); ?>
		<div class="col-xs-9 col-sm-9">
			<?php echo form_input("title", html_entity_decode(set_value("title", strip_tags($item->{"title"}))), "id=\"title\" class=\"form-control text-slug\""); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo form_label('Meta keywords', "meta_keywords", array('class' => 'control-label col-sm-3 col-xs-3')); ?>
		<div class="col-xs-9 col-sm-9">
			<?php echo form_input("meta_keywords", html_entity_decode(set_value("meta_keywords", strip_tags($item->{"meta_keywords"}))), 'id="meta_keywords" class="form-control" max-length="100"'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo form_label('Meta description', "meta_description", array('class' => 'control-label col-sm-3 col-xs-3')); ?>
		<div class="col-xs-9 col-sm-9">
			<?php echo form_input("meta_description", html_entity_decode(set_value("meta_description", strip_tags($item->{"meta_description"}))), 'id="meta_description" class="form-control" max-length="159"'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo form_label('Layout', 'layout', array('class' => 'col-xs-3 col-sm-3 control-label')); ?>
		<div class="col-xs-9 col-sm-9">
			<?php echo form_input('layout', html_entity_decode(set_value('layout', strip_tags($item->layout))), 'id="layout" class="form-control"'); ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo form_label('Template', 'template', array('class' => 'col-xs-3 col-sm-3 control-label')); ?>
		<div class="col-xs-9 col-sm-9">
			<?php echo form_input('template', html_entity_decode(set_value('template', strip_tags($item->template))), 'id="template" class="form-control"'); ?>
		</div>
	</div>
</form>