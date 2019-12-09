<?php

namespace App\Http\Controllers\POS\Transaction;

use App\Models\DebitCreditNote;
use App\Http\Controllers\Controller;
use App\Models\DebitCreditNote as ModelsDebitCreditNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class DebitcreditnoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet_id  = Auth::user()->outlet_id;
        $dbn    = DebitCreditNote::getDebitCreditNote($outlet_id);
        return view('pos.transaction.debit-credit-note.index', compact('dbn'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (count(DebitCreditNote::all()) <= 0) {
            $debit_credit_note_id              = 1;
        } else {
            $debit_credit_note_lastID          = DebitCreditNote::getDebitCreditNoteLastID();
            $debit_credit_note_id              = $debit_credit_note_lastID[0]->debit_credit_note_id + 1;
        }
        
            
        $debit_credit_note_date             = $request->debit_credit_note_date;  
        $debit_credit_note_amount           = $request->debit_credit_note_amount;  
        $debit_credit_note_type             = $request->debit_credit_note_type;  
        $debit_credit_note_desc             = $request->debit_credit_note_desc; 

        DebitCreditNote::setDebitCreditNote(
            $debit_credit_note_id, 
            $debit_credit_note_date, 
            $debit_credit_note_amount, 
            $debit_credit_note_type, 
            $debit_credit_note_desc
        );
        
        return back()->with('debitCreditNoteAdded');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
