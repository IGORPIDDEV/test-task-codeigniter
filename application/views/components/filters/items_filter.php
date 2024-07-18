<div class="row mb-4 mt-4">
    <div class="col-md-4">
        <select class="form-control" id="status_filter" name="status">
            <option value="">All</option>
            <option value="0">Not Purchased</option>
            <option value="1">Purchased</option>
        </select>
    </div>
    <div class="col-md-4">
        <select class="form-control" id="category_filter" name="category_id">
            <option value="">All Categories</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category->id ?>"><?= $category->name ?></option>
            <?php endforeach; ?>
        </select>
    </div>
	<div class="col-md-2">
        <button type="button" id="clearFilters" class="btn btn-outline-primary btn-block">Clear Filters</button>
    </div>
    <div class="col-md-2">
        <button type="button" id="applyFilters" class="btn btn-primary btn-block">Apply Filters</button>
    </div>
</div>
