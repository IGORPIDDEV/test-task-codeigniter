<?php if (!empty($items)): ?>
    <?php foreach ($items as $item): ?>
		<?php $this->load->view('components/cards/item_card', ['item' => $item]); ?>
	<?php endforeach; ?>
<?php else: ?>
    <div class="alert alert-primary ml-3" role="alert">
        No items found
    </div>
<?php endif; ?>
