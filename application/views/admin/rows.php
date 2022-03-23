<?php if (isset($items) && $items) : ?>
	<?php foreach ($items as $item) : ?>
		<tr class="<?php echo "active" . $item->status; ?>">
			<td><?php echo form_checkbox('action_to[]', $item->id); ?></td>
			<td>
				<img src="<?php echo json_decode($item->image)->tmb ?? "{$base_url}uploads/images/no_image.jpg"; ?>" alt="<?php echo json_decode($item->image)->name ?? ""; ?>" class="img-thumbnail" />
			</td>
			<td>
				<h5>
					<?php echo anchor('article/' . $item->id . '/' . url_title($item->title), $item->title, 'target="_blank" class="active_' . $item->status . '"'); ?>
					<?php if ($item->is_featured == 1) : ?><span class="label label-danger">Nổi bật</span><?php endif; ?>
					<?php if ($item->is_privated == 1) : ?><span class="label label-dark">Nội bộ</span><?php endif; ?>
				</h5>
				<div>
					<?php echo word_limiter(htmlspecialchars_decode($item->description), 75) ?>
				</div>
				<div>
					<?php echo $item->file ? anchor($item->file, '<b><i class="fa fa-file-o"></i> File đính kèm</b>', 'target="_blank"') : ""; ?>
				</div>
			</td>
			<td><?php echo isset($item->category->title) ? anchor('articles/category/' . $item->category->id . '/' . url_title($item->category->title), $item->category->title, 'target="_blank"') : ''; ?></td>
			<td class="text-center"><?php echo $item->views; ?></td>
			<td><?php echo $item->author; ?></td>
			<td><?php echo $item->published_at; ?></td>
			<td>
				<div>
					<?php echo isset($item->creater->id) ? anchor('admin/users/user/' . $item->creater->id,  $item->creater->username) : "Bot"; ?> [<?php echo date('H:i d/m/y', strtotime($item->created_at)); ?>]
				</div>
				<div>
					<?php echo isset($item->updater->id) ? anchor('admin/users/user/' . $item->updater->id,  $item->updater->username) : "Bot"; ?> [<?php echo date('H:i d/m/y', strtotime($item->updated_at)); ?>]
				</div>
			</td>
			<td class="text-center ctrl">
				<?php echo anchor('admin/articles/featured/' . $item->id, '<i class="fa fa-star"></i>', 'title="Thay đổi trạng thái" class="btn btn-ajax btn-xs btn-bordered btn-warning"'); ?>
				<?php echo anchor('admin/articles/privated/' . $item->id, '<i class="fa fa-lock"></i>', 'title="Thay đổi trạng thái" class="btn btn-ajax btn-xs btn-bordered btn-info"'); ?>
				<?php echo anchor('admin/articles/active/' . $item->id, '<i class="fa fa-check"></i>', 'title="Thay đổi trạng thái" class="btn btn-ajax btn-xs btn-bordered btn-default"'); ?>
				<?php echo anchor('admin/articles/update/' . $item->id, '<i class="fa fa-edit"></i>', 'title="Cập nhật" rel="update" class="btn btn-xs btn-bordered btn-primary"'); ?>
				<?php echo anchor('admin/articles/delete/' . $item->id, '<i class="fa fa-trash-o"></i>', 'class="btn btn-xs btn-bordered btn-danger btn-ajax btn-confirm" title="Xóa bản ghi!?"'); ?>
			</td>
		</tr>
	<?php endforeach; ?>
<?php endif; ?>