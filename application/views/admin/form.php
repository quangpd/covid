<div class="container-fluid">
	<div class="row">
		<?php echo form_open_multipart(uri_string(), 'id="' . $method . '-form"'); ?>
		<div class="col-md-12">
			<h4 class="header-title m-t-0 m-b-20">
				<span>Bài viết</span>
				<span class="header-tools">
					<?php echo anchor('admin/articles/categories', '<i class="fa fa-bars"></i> Danh mục', 'class="btn btn-xs btn-bordered btn-default" id="btn_create"'); ?>
				</span>
			</h4>
		</div>
		<div class="col-md-12">
			<?php echo $template['partials']['message']; ?>
			<div class="row m-b-20">
				<div class="col-sm-12 col-xs-12">
					<button type="submit" class="btn btn-sm btn-primary btn-bordered"><i class="fa fa-save"></i> Submit</button>
					<button type="button" class="btn btn-bordered btn-default" onclick="return history.back();"><i class="fa fa-mail-reply-all"></i> Back</button>
				</div>
			</div>
			<div class="col-md-9 form-horizontal">
				<div class="form-group">
					<?php echo form_label('Danh mục', 'category_id', array('class' => 'control-label col-sm-1 col-xs-2')); ?>
					<div class="col-xs-10 col-sm-11">
						<select id="category_id" name="category_id" class="form-control chosen-select">
							<?php echo dropdown_nested_menu(0, $categories, 0, $item->category_id); ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<?php echo form_label('Tiêu đề', "title", array('class' => 'control-label col-sm-1 col-xs-2')); ?>
					<div class="col-xs-10 col-sm-11">
						<?php echo form_input("title", html_entity_decode(set_value("title", strip_tags($item->{"title"}))), "id=\"title\" class=\"form-control text-slug\""); ?>
					</div>
				</div>

				<div class="form-group">
					<?php echo form_label('Mô tả', "description", array('class' => 'control-label col-sm-1 col-xs-2')); ?>
					<div class="col-xs-10 col-sm-11">
						<textarea name="description" id="description" class="form-control ckeditor" spellcheck="false"><?php echo html_entity_decode(set_value("description", $item->{"description"})) ?></textarea>
					</div>
				</div>

				<div class="form-group">
					<?php echo form_label('Nội dung', 'content', array('class' => 'control-label col-sm-1 col-xs-2')); ?>
					<div class="col-xs-10 col-sm-11">
						<textarea name="content" id="content" class="form-control ckeditor" spellcheck="false"><?php echo html_entity_decode(set_value("content", $item->{"content"})) ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<?php echo form_label('File đính kèm', 'file', array('class' => 'control-label col-sm-1 col-xs-2')); ?>
					<div class="col-xs-5 col-sm-6">
						<div class="input-group">
							<input type="text" name="file" class="button-open-file form-control" placeholder="File" readonly="readonly" value="<?php echo set_value('file', strip_tags($item->file)) ?>" />
							<span class="input-group-addon button-file"><i class="fa fa-folder-o"></i></span>
							<span class="input-group-addon button-clear-file"><i class="fa fa-remove"></i></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<?php echo form_label('Trạng thái', 'status', array('class' => 'control-label')); ?>
					<input type="checkbox" name="status" value="1" <?php echo $item->status == 1 ? "checked" : "" ?> data-plugin="switchery" data-color="#23b195" data-size="small" />
				</div>
				<div class="form-group">
					<?php echo form_label('Nổi bật', 'is_featured', array('class' => 'control-label')); ?>
					<input type="checkbox" name="is_featured" value="1" <?php echo $item->is_featured == 1 ? "checked" : "" ?> data-plugin="switchery" data-color="#23b195" data-size="small" />
				</div>
				<div class="form-group">
					<?php echo form_label('Nội bộ', 'is_privated', array('class' => 'control-label')); ?>
					<input type="checkbox" name="is_privated" value="1" <?php echo $item->is_privated == 1 ? "checked" : "" ?> data-plugin="switchery" data-color="#23b195" data-size="small" />
				</div>
				<div class="form-group">
					<?php echo form_label('Hình ảnh', 'image', array('class' => 'control-label')); ?>
					<div class="div-image">
						<a class="img-thumbnail" data-toggle="image" href="#">
							<img data-placeholder="<?php echo $base_url ?>uploads/images/no_image.jpg" title="" alt="" src="<?php echo json_decode($item->image)->tmb ?? "{$base_url}uploads/images/no_image.jpg"; ?>" />
						</a>
						<input type="hidden" value="<?php echo set_value('image', $item->image) ?>" name="image" class="hidden-image" />
					</div>
				</div>
				<div class="form-group">
					<?php echo form_label('Tác giả', 'author', array('class' => 'control-label')); ?>
					<div>
						<?php echo form_input('author', html_entity_decode(set_value('author', strip_tags($item->author))), 'id="author" class="form-control"'); ?>
					</div>
				</div>
				<div class="form-group">
					<?php echo form_label('Nguồn', 'source', array('class' => 'control-label')); ?>
					<div>
						<?php echo form_input('source', html_entity_decode(set_value('source', strip_tags($item->source))), 'id="source" class="form-control"'); ?>
					</div>
				</div>
				<div class="form-group">
					<?php echo form_label('Xuất bản', 'published_at', array('class' => 'control-label')); ?>
					<div>
						<?php echo form_input('published_at', html_entity_decode(set_value('published_at', strip_tags($item->published_at))), 'id="published_at" class="form-control datepicker"'); ?>
					</div>
				</div>
				<div class="form-group">
					<?php echo form_label('Tags', 'tags', array('class' => 'control-label')); ?>
					<div>
						<?php echo form_input('tags', html_entity_decode(set_value('tags', strip_tags($item->tags))), 'id="tags" class="form-control"'); ?>
					</div>
				</div>
				<div class="form-group">
					<?php echo form_label('Meta keywords', "meta_keywords", array('class' => 'control-label')); ?>
					<div>
						<?php echo form_input("meta_keywords", html_entity_decode(set_value("meta_keywords", strip_tags($item->{"meta_keywords"}))), 'id="meta_keywords" class="form-control" max-length="100"'); ?>
					</div>
				</div>

				<div class="form-group">
					<?php echo form_label('Meta description', "meta_description", array('class' => 'control-label')); ?>
					<div>
						<?php echo form_input("meta_description", html_entity_decode(set_value("meta_description", strip_tags($item->{"meta_description"}))), 'id="meta_description" class="form-control" max-length="159"'); ?>
					</div>
				</div>
				<div class="form-group">
					<?php echo form_label('Layout', 'layout', array('class' => 'control-label')); ?>
					<div>
						<?php echo form_input('layout', html_entity_decode(set_value('layout', strip_tags($item->layout))), 'id="layout" class="form-control"'); ?>
					</div>
				</div>

				<div class="form-group">
					<?php echo form_label('Template', 'template', array('class' => 'control-label')); ?>
					<div>
						<?php echo form_input('template', html_entity_decode(set_value('template', strip_tags($item->template))), 'id="template" class="form-control"'); ?>
					</div>
				</div>
			</div>

			<div class="row m-b-20">
				<div class="col-sm-12 col-xs-12">
					<button type="submit" class="btn btn-sm btn-primary btn-bordered"><i class="fa fa-save"></i> Submit</button>
					<button type="button" class="btn btn-bordered btn-default" onclick="return history.back();"><i class="fa fa-mail-reply-all"></i> Back</button>
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>