<?php

namespace App\Controllers;
use App\Models\TransactionModel;

class Transactions extends BaseController
{
    /*public function index()
    {
        $model = new TransactionModel();
        $data['transactions'] = $model->orderBy('trans_date','DESC')->findAll();
        return view('transactions/index', $data);
    }*/

    public function index()
{
    $model = new TransactionModel();

    $builder = $model;

    // Filters
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

    $data['transactions'] = $builder->orderBy('trans_date','DESC')->findAll();

    // Totals
    $data['income'] = $model->selectSum('amount')->where('type','income')->first()['amount'] ?? 0;
    $data['expense'] = $model->selectSum('amount')->where('type','expense')->first()['amount'] ?? 0;
    $data['balance'] = $data['income'] - $data['expense'];

    return view('transactions/index', $data);
}








    public function create()
    {
        return view('transactions/create');
    }

    public function store()
    {
        $model = new TransactionModel();

        $model->save([
            'trans_date' => $this->request->getPost('trans_date'),
            'description' => $this->request->getPost('description'),
            'amount' => $this->request->getPost('amount'),
            'type' => $this->request->getPost('type'),
            'category' => $this->request->getPost('category'),
            'account'     => $this->request->getPost('account'),
        ]);

        return redirect()->to('/transactions');
    }

    public function edit($id)
    {
        $model = new TransactionModel();
        $data['transaction'] = $model->find($id);
        return view('transactions/edit', $data);
    }

    public function update($id)
    {
        $model = new TransactionModel();

        $model->update($id, [
            'trans_date' => $this->request->getPost('trans_date'),
            'description' => $this->request->getPost('description'),
            'amount' => $this->request->getPost('amount'),
            'type' => $this->request->getPost('type'),
            'category' => $this->request->getPost('category'),
            'account'     => $this->request->getPost('account'),
        ]);

        return redirect()->to('/transactions');
    }

    public function delete($id)
    {
        $model = new TransactionModel();
        $model->delete($id);
        return redirect()->to('/transactions');
    }
}
