<!DOCTYPE html>
<html>
<head>
    <title>Add Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h4>Add Transaction</h4>

<form method="post" action="<?= base_url('transactions/store') ?>">
    <input type="date" name="trans_date" class="form-control mb-2" required>
    <input type="text" name="description" class="form-control mb-2" placeholder="Description">
    <input type="number" step="0.01" name="amount" class="form-control mb-2" required>

    <select name="type" class="form-control mb-2" required>
        <option value="">Select Type</option>
        <option value="income">Income</option>
        <option value="expense">Expense</option>
    </select>

    <input type="text" 
       name="category" 
       class="form-control mb-2" 
       placeholder="Category (Salary, Rent, Utilities)">

       <select name="account" class="form-control mb-2" required>
    <option value="">Select Account</option>
    <option value="Cash">Cash</option>
    <option value="Bank">Bank</option>
    <option value="Credit Card">Credit Card</option>
</select>


    <button class="btn btn-success">Save</button>
    <a href="<?= base_url('transactions') ?>" class="btn btn-secondary">Back</a>
</form>

</body>
</html>
