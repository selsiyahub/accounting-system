<?= view('layout/header') ?>

<h3>Budget Tracking</h3>

<div class="card">
    <div class="card-body">

        <table class="table table-bordered">
            <tr>
                <th>Category</th>
                <th>Budget</th>
                <th>Spent</th>
                <th>Status</th>
            </tr>

            <?php foreach ($budgets as $b): ?>
            <tr>
                <td><?= $b->name ?></td>
                <td><?= $b->budget ?></td>
                <td><?= $b->spent ?></td>
                <td>
                    <?php if ($b->spent > $b->budget): ?>
                        <span class="badge badge-danger">Over Budget</span>
                    <?php else: ?>
                        <span class="badge badge-success">Within Budget</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

    </div>
</div>

<?= view('layout/footer') ?>
