<?= view('layout/header') ?>
<canvas id="chart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('chart'), {
  type: 'bar',
  data: {
    labels: <?= json_encode(array_column($data,'month')) ?>,
    datasets: [
      { label: 'Income', data: <?= json_encode(array_column($data,'income')) ?> },
      { label: 'Expense', data: <?= json_encode(array_column($data,'expense')) ?> }
    ]
  }
});
</script>

<?= view('layout/footer') ?>
