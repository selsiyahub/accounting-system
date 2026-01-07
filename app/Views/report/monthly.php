<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Monthly Income vs Expenses</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        h4 { margin-bottom: 20px; }
        .card { padding: 15px; margin-bottom: 20px; }
    </style>
</head>
<body>
<div class="container mt-4">

    <h4>Monthly Income vs Expenses Report</h4>

    <!-- Action Buttons -->
    <div class="mb-3">
        <a href="<?= base_url('transactions') ?>" class="btn btn-secondary">Back to Transactions</a>
        <a href="<?= base_url('report/export-csv') ?>" class="btn btn-success">Export CSV</a>
    </div>

    <!-- Totals Card -->
    <div class="row mb-3">
        <?php
        $totalIncome = array_sum(array_column($monthly, 'income'));
        $totalExpense = array_sum(array_column($monthly, 'expense'));
        $totalBalance = $totalIncome - $totalExpense;
        ?>
        <div class="col-md-4">
            <div class="card bg-light text-dark text-center">
                <h5>Income</h5>
                <p class="fs-4"><?= number_format($totalIncome, 2) ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-light text-dark text-center">
                <h5>Expense</h5>
                <p class="fs-4"><?= number_format($totalExpense, 2) ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-light text-dark text-center">
                <h5>Balance</h5>
                <p class="fs-4"><?= number_format($totalBalance, 2) ?></p>
            </div>
        </div>
    </div>

    <!-- Monthly Table -->
    <div class="card">
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>Month</th>
                    <th>Total Income</th>
                    <th>Total Expense</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($monthly as $row): ?>
                <tr>
                    <td><?= date('F Y', strtotime($row['month'].'-01')) ?></td>
                    <td><?= number_format($row['income'], 2) ?></td>
                    <td><?= number_format($row['expense'], 2) ?></td>
                    <td><?= number_format($row['income'] - $row['expense'], 2) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Chart -->
    <div class="card mt-4">
        <canvas id="incomeExpenseChart" height="150"></canvas>
    </div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('incomeExpenseChart').getContext('2d');

// Prepare data
const months = <?= json_encode(array_map(fn($r) => date('M Y', strtotime($r['month'].'-01')), $monthly)) ?>;
const incomes = <?= json_encode(array_map(fn($r) => $r['income'], $monthly)) ?>;
const expenses = <?= json_encode(array_map(fn($r) => $r['expense'], $monthly)) ?>;

// Create chart
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: months,
        datasets: [
            {
                label: 'Income',
                data: incomes,
                backgroundColor: 'rgba(54, 162, 235, 0.7)'
            },
            {
                label: 'Expense',
                data: expenses,
                backgroundColor: 'rgba(255, 99, 132, 0.7)'
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'top' },
            title: { display: true, text: 'Monthly Income vs Expenses' }
        },
        scales: { y: { beginAtZero: true } }
    }
});
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
