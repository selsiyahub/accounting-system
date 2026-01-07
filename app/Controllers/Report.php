<?php

namespace App\Controllers;
use App\Models\TransactionModel;

class Report extends BaseController
{
    // Monthly summary page
    public function monthly()
    {
        $model = new TransactionModel();

        // Select month, sum of income, sum of expense
        $data['monthly'] = $model->select("
                DATE_FORMAT(trans_date, '%Y-%m') as month,
                SUM(CASE WHEN type='income' THEN amount ELSE 0 END) as income,
                SUM(CASE WHEN type='expense' THEN amount ELSE 0 END) as expense
            ")
            ->groupBy("DATE_FORMAT(trans_date, '%Y-%m')")
            ->orderBy('month', 'ASC')
            ->findAll();

        return view('report/monthly', $data);
    }

    // CSV Export respecting filters
    public function exportCSV()
{
    $model = new TransactionModel();
    $builder = $model;

    // Apply filters from GET
    if ($this->request->getGet('type')) {
        $builder = $builder->where('type', $this->request->getGet('type'));
    }

    if ($this->request->getGet('category')) {
        $builder = $builder->where('category', $this->request->getGet('category'));
    }

    if ($this->request->getGet('from') && $this->request->getGet('to')) {
        $builder = $builder->where('trans_date >=', $this->request->getGet('from'))
                           ->where('trans_date <=', $this->request->getGet('to'));
    }

    $data = $builder->orderBy('trans_date', 'DESC')->findAll();

    // Set CSV headers
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename=transactions.csv');

    $file = fopen('php://output', 'w');

    // Column headers
    fputcsv($file, ['Date','Description','Amount','Type','Category','Account']);

    // Data rows in correct order
    foreach ($data as $row) {
        fputcsv($file, [
            $row['trans_date'],   // Date
            $row['description'],  // Description
            $row['amount'],       // Amount
            $row['type'],         // Type
            $row['category'],     // Category
            $row['account'],      // Account
        ]);
    }

    fclose($file);
    exit;
}


public function exportMonthlyCSV()
{
    $model = new TransactionModel();

    $data = $model->select("
            DATE_FORMAT(trans_date, '%Y-%m') as month,
            SUM(CASE WHEN type='income' THEN amount ELSE 0 END) as income,
            SUM(CASE WHEN type='expense' THEN amount ELSE 0 END) as expense
        ")
        ->groupBy("DATE_FORMAT(trans_date, '%Y-%m')")
        ->orderBy('month','ASC')
        ->findAll();

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename=monthly_report.csv');

    $file = fopen('php://output', 'w');

    fputcsv($file, ['Month','Income','Expense','Balance']);

    foreach ($data as $row) {
        fputcsv($file, [
            date('F Y', strtotime($row['month'].'-01')),
            $row['income'],
            $row['expense'],
            $row['income'] - $row['expense']
        ]);
    }

    fclose($file);
    exit;
}


}
