<!DOCTYPE html>
<html>
<head>
    <title>Edit Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h4>Edit Transaction</h4>

<form method="post" action="<?= base_url('transactions/update/'.$transaction['id']) ?>">
    <input type="date" name="trans_date" value="<?= $transaction['trans_date'] ?>" class="form-control mb-2">
    <input type="text" name="description" value="<?= $transaction['description'] ?>" class="form-control mb-2">
    <input type="number" step="0.01" name="amount" value="<?= $transaction['amount'] ?>" class="form-control mb-2">

    <select name="type" class="form-control mb-2">
        <option value="income" <?= $transaction['type']=='income'?'selected':'' ?>>Income</option>
        <option value="expense" <?= $transaction['type']=='expense'?'selected':'' ?>>Expense</option>
    </select>

    <input type="text" 
       name="category" 
       value="<?= $transaction['category'] ?>" 
       class="form-control mb-2">

       <select name="account" class="form-control mb-2" required>
    <option value="Cash" <?= $transaction['account']=='Cash'?'selected':'' ?>>Cash</option>
    <option value="Bank" <?= $transaction['account']=='Bank'?'selected':'' ?>>Bank</option>
    <option value="Credit Card" <?= $transaction['account']=='Credit Card'?'selected':'' ?>>Credit Card</option>
</select>

    <button class="btn btn-success">Update</button>
    <a href="<?= base_url('transactions') ?>" class="btn btn-secondary">Back</a>
</form>

</body>
</html>
