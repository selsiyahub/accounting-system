<?= view('layout/header') ?>

<h3>Dashboard</h3>
<div class="row">
<div class="col">Income: <b><?= $income ?></b></div>
<div class="col">Expense: <b><?= $expense ?></b></div>
<div class="col">Balance: <b><?= $balance ?></b></div>
</div>

<?= view('layout/footer') ?>
