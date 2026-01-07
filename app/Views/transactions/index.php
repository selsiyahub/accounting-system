<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ACCOUNTING SYSTEM</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h4>ACCOUNTING SYSTEM</h4>

    <!-- Totals -->
    <div class="row mb-3">
        <div class="col">Income: <b><?= $income ?></b></div>
        <div class="col">Expense: <b><?= $expense ?></b></div>
        <div class="col">Balance: <b><?= $balance ?></b></div>
    </div>

    <!-- Filter Form -->
    <form method="get" class="row mb-3">
        <div class="col">
            <input type="date" name="from" class="form-control" value="<?= $_GET['from'] ?? '' ?>">
        </div>
        <div class="col">
            <input type="date" name="to" class="form-control" value="<?= $_GET['to'] ?? '' ?>">
        </div>
        <div class="col">
            <input type="text" name="category" class="form-control" placeholder="Category" value="<?= $_GET['category'] ?? '' ?>">
        </div>
        <div class="col">
            <select name="type" class="form-control">
                <option value="">All</option>
                <option value="income" <?= ($_GET['type'] ?? '') == 'income' ? 'selected' : '' ?>>Income</option>
                <option value="expense" <?= ($_GET['type'] ?? '') == 'expense' ? 'selected' : '' ?>>Expense</option>
            </select>
        </div>
        <div class="col">
            <button class="btn btn-primary">Filter</button>
        </div>
    </form>

    <!-- Action Buttons -->
    <div class="mb-3">
        <a href="<?= base_url('transactions/create') ?>" class="btn btn-primary">Add Transaction</a>
        <a href="<?= base_url('report/export-csv') ?>?from=<?= $_GET['from'] ?? '' ?>&to=<?= $_GET['to'] ?? '' ?>&category=<?= $_GET['category'] ?? '' ?>&type=<?= $_GET['type'] ?? '' ?>"
       class="btn btn-success">
        Export CSV
    </a>
       
        <a href="<?= base_url('report/monthly') ?>" class="btn btn-info">View Monthly Summary</a>
    </div>

    <!-- Transactions Table -->
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Type</th>
                <th>Category</th>
                <th>Account</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($transactions as $row): ?>
            <tr>
                <td><?= $row['trans_date'] ?></td>
                <td><?= $row['description'] ?></td>
                <td><?= $row['amount'] ?></td>
                <td><?= $row['type'] ?></td>
                <td><?= $row['category'] ?></td>
                <td><?= $row['account'] ?></td>
                <td>
                    <a href="<?= base_url('transactions/edit/'.$row['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="<?= base_url('transactions/delete/'.$row['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
