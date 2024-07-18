<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .modal-header, .modal-body, .modal-footer {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
		<?php $this->load->view('components/filters/items_filter', ['categories' => $categories]); ?>

		<div class="mb-4">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addItemModal">Add Item</button>
			<?php $this->load->view('components/modals/add_item_modal', ['categories' => $categories]); ?>

			<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addCategoryModal">Add Category</button>
			<?php $this->load->view('components/modals/add_category_modal'); ?>
		</div>
        
        <div class="row" id="itemsList">
            <?php foreach ($items as $item): ?>
                <?php $this->load->view('components/cards/item_card', ['item' => $item]); ?>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {

			let statusLabels = {
				0: { buttonClass: 'btn-success', buttonText: 'Purchased', badgeClass: 'bg-success', badgeText: 'Purchased' },
				1: { buttonClass: 'btn-danger', buttonText: 'Not Purchased', badgeClass: 'bg-danger', badgeText: 'Not Purchased' }
			};

			function updateStatusUI(button, newStatus) {
				let itemCard = button.closest('.item-card');
				let badge = itemCard.find('.card-text .badge');
				
				let statusProperties = statusLabels[newStatus];

				button.text(statusProperties.buttonText);
				button.removeClass('btn-success btn-danger').addClass(statusProperties.buttonClass);
				button.data('status', newStatus);

				badge.text(statusProperties.badgeText);
				badge.removeClass('bg-warning bg-danger').addClass(statusProperties.badgeClass);
			}

			$('#itemsList').on('click', '.updateStatus', function() {
				let button = $(this);
				let id = button.data('id');
				let currentStatus = button.data('status');
				let newStatus = currentStatus === 1 ? 0 : 1;
				let inverted = 1 - currentStatus;
				$.post('<?= site_url('items/update_status') ?>/' + id, { status: currentStatus }, function(response) {
					if (response.status) {
						updateStatusUI(button, currentStatus);
					} else {
						console.log(response)
					}
				}, 'json');
			});

			$('#itemsList').on('click', '.deleteItem', function() {
				let id = $(this).data('id');
				let itemCard = $(this).closest('.item-card');

				$.post('<?= site_url('items/delete') ?>/' + id, function(response) {
					if (response.status) {
						itemCard.remove();
					} else {
						alert(response.message);
					}
				}, 'json');
			});

			$('#addItemFormModal').submit(function(e) {
                e.preventDefault();
                $.post('<?= site_url('items/add') ?>', $(this).serialize(), function(response) {
                    if (response.status) {
						$('#itemsList').append(response.new_item_html);
						$('#addItemFormModal')[0].reset();
					} else {
						alert(response.errors || response.message);
					}
                }, 'json');
                $('#addItemModal').modal('hide');
            });

			$('#addCategoryForm').submit(function(e) {
				e.preventDefault();
				let categoryName = $('#categoryName').val();

				$.post('<?= site_url('categories/add') ?>', { category_name: categoryName }, function(response) {
					
				if (response.status) {
					var newOption = $('<option>', {
						value: response.category.id,
						text: response.category.name
					});
					$('#category_filter').append(newOption);
					$('#itemCategory').append(newOption);

					$('#addCategoryModal').modal('hide');
					$('#addCategoryForm')[0].reset();
				} else {
					alert(response.message);
				}
				}, 'json');
			});

            $('#applyFilters').click(function() {
				let status = $('#status_filter').val();
				let category_id = $('#category_filter').val();
				
				$.post('<?= site_url('items/filter') ?>', { status: status, category_id: category_id }, function(response) {
					$('#itemsList').html(response);
				});
			});

            $('#clearFilters').click(function() {
				$('#status_filter').val('');
				$('#category_filter').val('');
				$.post('<?= site_url('items/filter') ?>', {
					category_id: '',
					status: ''
				}, function(response) {
					$('#itemsList').html(response);
				});
			});
        });
    </script>
</body>
</html>
