<?php

class Dashboard extends BaseController
{
    public function index()
    {
        $transactionModel = new TransactionModel();

        $data = [
            'income'  => $transactionModel->getTotal('income'),
            'expense' => $transactionModel->getTotal('expense'),
        ];
        $data['balance'] = $data['income'] - $data['expense'];

        return view('dashboard', $data);
    }
}
