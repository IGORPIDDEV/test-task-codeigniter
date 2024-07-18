<div class="col-md-3 mb-3 item-card">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= $item->name ?></h5>
            <p class="card-text">Category: <?= $item->category_name ?></p>
            <p class="card-text">
                Status: 
                <?php if ($item->status): ?>
                    <span class="badge bg-success">Purchased</span>
                <?php else: ?>
                    <span class="badge bg-warning">Not Purchased</span>
                <?php endif; ?>
            </p>
            <p class="card-text">Created at: <?= date('Y-m-d H:i:s', strtotime($item->created_at)) ?></p>
            <button class="btn btn-danger deleteItem" data-id="<?= $item->id ?>">Delete</button>
            <button class="btn <?= $item->status ? 'btn-danger' : 'btn-success' ?> updateStatus" data-id="<?= $item->id ?>" data-status="<?= $item->status ? 0 : 1 ?>">
                <?= $item->status ? 'Not Purchased' : 'Purchased' ?>
            </button>
        </div>
    </div>
</div>
