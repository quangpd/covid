<div class="container-fluid">
	<?php echo form_open('articles/admin', ['id' => "form"]); ?>
	<div class="row">
		<div class="col-md-12">
			<h4 class="header-title m-t-0 m-b-20">
				<span>Bài viết</span>
				<div class="header-tools">
					<?php echo anchor('admin/articles/create', '<i class="fa fa-plus"></i> Thêm mới', 'class="btn btn-xs btn-bordered btn-default" id="btn_create"'); ?>
					<?php echo anchor('admin/articles/categories', '<i class="fa fa-bars"></i> Danh mục', 'class="btn btn-xs btn-bordered btn-default" id="btn_categories"'); ?>
					<?php echo anchor('#', '<i class="fa fa-remove"></i> Xóa', 'class="btn btn-xs btn-bordered btn-danger" id="btn_delete"'); ?>
				</div>
			</h4>
		</div>
		<div class="col-md-12">
			<?php echo $template['partials']['message']; ?>
			<table class="table table-striped table-bordered table-hover table-sortable">
				<thead>
					<tr>
						<th width="1"><input type="checkbox" class="chkall" value="" name="action_to_all"></th>
						<th width="100">Hình ảnh</th>
						<th field="articles.title" class="sorter">Tiêu đề</th>
						<th field="category_title" class="sorter" width="200">Danh mục</th>
						<th field="articles.views" class="sorter" width="75">Xem</th>
						<th field="articles.author" class="sorter" width="125">Tác giả</th>
						<th field="articles.published_at" class="sorter" width="100">Xuất bản</th>
						<th field="articles.created_at" class="sorter" width="165">Ngày tạo</th>
						<th width="150">&nbsp;</th>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><input type="text" name="title" class="form-control" autocomplete="off" /></td>
						<td>
							<select id="category" name="category" class="form-control select2">
								<?php echo dropdown_nested_menu(0, $categories, 0, null); ?>
							</select>
						</td>
						<td>&nbsp;</td>
						<td><input type="text" name="author" class="form-control" autocomplete="off" /></td>
						<td><input type="text" name="published_at" class="form-control datepicker" autocomplete="off" /></td>
						<td><input type="text" name="created_at" class="form-control datepicker" autocomplete="off" /></td>
						<td class="text-center">
							<button id="btn_filter" class="btn btn-sm btn-bordered btn-default"><i class="fa fa-filter"></i></button>
							<button id="btn_clear" class="btn btn-sm btn-bordered btn-default"><i class="fa fa-recycle"></i></button>
						</td>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<td colspan="8" class="paging"><?php echo $pagination['links']; ?></td>
						<td class="total_rows"><?php echo $pagination['total_rows'] ?> bản ghi</td>
					</tr>
				</tfoot>
				<tbody>
					<?php if (isset($items) && $items) : ?>
						<?php echo $this->template->load_view('articles/admin/rows', array('items' => $items)); ?>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
	<?php echo form_close(); ?>
</div>