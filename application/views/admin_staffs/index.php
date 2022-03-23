<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h4 class="header-title m-t-0 m-b-20">
				<span>Bài viết - Danh mục</span>
				<div class="header-tools">
					<?php echo anchor('#', '<i class="fa fa-plus"></i> Thêm mới', 'class="btn btn-default btn-bordered btn-xs" id="btn_create"'); ?>
				</div>
			</h4>
		</div>
		<div class="col-md-12">
			<?php echo $template['partials']['message']; ?>
			<button id="btn-update-tree" type="button" class="btn btn-success btn-bordered btn-xs"><i class="fa fa-refresh"></i> Cập nhật cấu trúc</button>
			<div id="categories" class="dd"></div>
		</div>
	</div>
</div>

<div id="dialog" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Danh mục <span id="category-id"></span></h4>
			</div>
			<div class="modal-body" id="modal-html"></div>
			<div class="modal-footer">
				<button type="button" id="btn-modal-create" class="btn btn-bordered btn-primary" rel="btn-modal-action"><i class="fa fa-save"></i> Thêm</button>
				<button type="button" id="btn-modal-update" class="btn btn-bordered btn-primary" rel="btn-modal-action"><i class="fa fa-save"></i> Submit</button>
				<button type="button" id="btn-modal-delete" class="btn btn-bordered btn-danger" rel="btn-modal-action"><i class="fa fa-trash-o"></i> Xóa</button>
				<button type="button" class="btn btn-bordered btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Đóng</button>
			</div>
		</div><!-- /.modal-content -->
	</div>
</div>