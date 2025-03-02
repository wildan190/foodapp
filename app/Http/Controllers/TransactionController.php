<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Repositories\Interface\TransactionRepositoryInterface;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function index()
    {
        $transactions = $this->transactionRepository->getAllTransactions();

        return view('transactions.index', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = $this->transactionRepository->getTransactionById($id);

        return view('transactions.show', compact('transaction'));
    }

    public function create()
    {
        $sales = Sales::all(); // Mengambil semua data penjualan untuk dropdown

        return view('transactions.create', compact('sales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sales_id' => 'required|exists:sales,id',
            'transaction_date' => 'required|date',
        ]);

        $data = [
            'sales_id' => $request->sales_id,
            'transaction_number' => 'TRX-'.strtoupper(uniqid()),
            'transaction_date' => $request->transaction_date,
            'invoice_number' => 'INV-'.strtoupper(uniqid()),
        ];

        $this->transactionRepository->createTransaction($data);

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully!');
    }

    public function destroy($id)
    {
        $this->transactionRepository->deleteTransaction($id);

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully!');
    }

    public function printInvoice($id)
    {
        $transaction = $this->transactionRepository->getTransactionById($id);
        $pdf = Pdf::loadView('transactions.invoice', compact('transaction'));

        return $pdf->stream('Invoice_'.$transaction->invoice_number.'.pdf');
    }
}
