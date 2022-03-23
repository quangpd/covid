$(function () {
	var category_id = '';

	function reload_tree() {
		$.post(BASE_PATH + 'admin/articles/categories', function (response) {
			$('#categories').html(response).nestable({ group: 1 });
		});
	}

	reload_tree();

	$(document).on('click', '#btn-update-tree', function (event) {
		event.preventDefault();

		$.post(
			BASE_PATH + 'admin/articles/categories/ajax_position',
			{ list: $('#categories').nestable('serialize') },
			function (data) {
				toastr['success']('Cập nhật thành công');
			}
		);

		return false;
	});

	$('button[rel="btn-modal-action"]').hide();

	$(document).on('click', '#btn_create', function (event) {
		event.preventDefault();
		$.getJSON(
			BASE_PATH + 'admin/articles/categories/create?r=' + rand_str(),
			function (response) {
				$('#modal-html').html(response.html);
				$('#display').prop('checked', true);
				$('[data-plugin="switchery"]').each(function (idx, obj) {
					new Switchery($(this)[0], $(this).data());
				});

				$('#dialog').modal('show');
				$('#btn-modal-create').show();
			},
			'json'
		);

		return false;
	});

	$(document).on('click', '#btn-modal-create', function (event) {
		event.preventDefault();
		if ($('.text-slug').val().length > 0) {
			var parent_id = $('#parent_id').val();
			$.post(
				BASE_PATH + 'admin/articles/categories/create/' + parent_id,
				$('#dialog form').serialize(),
				function (data) {
					if (data == 'OK') {
						reload_tree();
						$('#dialog').modal('hide');
					} else {
						toastr['error'](data);
					}
				},
				'json'
			);
		}

		return false;
	});

	$(document).on('click', 'a.item', function (event) {
		event.preventDefault();
		$.getJSON(
			$(this).attr('href') + '?r=' + rand_str(),
			function (response) {
				category_id = response.id;
				$('#category-id').html('<span class="badge badge-primary">#' + category_id + '</span>');
				$('#modal-html').html(response.html);
				$('#display').prop('checked', true);
				$('[data-plugin="switchery"]').each(function (idx, obj) {
					new Switchery($(this)[0], $(this).data());
				});

				$('#dialog').modal('show');
				$('#btn-modal-update').show();
				$('#btn-modal-delete').show();
			},
			'json'
		);
		return false;
	});

	$(document).on('click', '#btn-modal-update', function (event) {
		event.preventDefault();
		if ($('.text-slug').val().length > 0) {
			$.post(
				BASE_PATH + 'admin/articles/categories/update/' + category_id,
				$('#dialog form').serialize(),
				function (data) {
					if (data == 'OK') {
						reload_tree();
						$('#dialog').modal('hide');
						toastr['success']('Cập nhật thành công!');
					} else {
						toastr['error'](data);
					}
				},
				'json'
			);
		}
	});

	$(document).on('click', '#btn-modal-delete', function (event) {
		event.preventDefault();
		if (confirm('Xóa bản ghi này!?')) {
			$.post(
				BASE_PATH + 'admin/articles/categories/delete/' + category_id,
				$('#dialog form').serialize(),
				function (data) {
					reload_tree();
					$('#dialog').modal('hide');
				}
			);
		}
	});

	$(document).on('click', 'a.remove', function (event) {
		event.preventDefault();
		if (confirm('Xóa bản ghi này!?')) {
			$.post($(this).attr('href'), function (response) {
				reload_tree();
				$('#dialog').modal('hide');
				toastr['success']('Cập nhật thành công!');
			});
		}
		return false;
	});

	$(document).on('click', 'a.add', function (event) {
		event.preventDefault();
		$.getJSON($(this).attr('href'), function (response) {
			$('#modal-html').html(response.html);
			$('#parent_id').val(response.parent_id);
			$('[data-plugin="switchery"]').each(function (idx, obj) {
				new Switchery($(this)[0], $(this).data());
			});
			$('#status[data-plugin="switchery"]')
				.prop('checked', response.status == 0)
				.trigger('click');
			$('#external[data-plugin="switchery"]')
				.prop('checked', response.external == 0)
				.trigger('click');
			$('#dialog').modal('show');
			$('#btn-modal-create').show();
		});

		return false;
	});

	$('#display').prop('checked', true);
	$('#dialog').on('hide.bs.modal', function () {
		$('button[rel="btn-modal-action"]').hide();
		$('#category-id').html('');
	});
});
