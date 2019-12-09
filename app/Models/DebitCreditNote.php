<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DebitCreditNote extends Model
{
    protected $table = 'tbl_debit_credit_note';

    public static function getDebitCreditNoteLastID()
    {
        $last_id                = DB::select('call SP_GetLastID_Select(?)', ['debit_credit_note_id']);
        return $last_id;
    }

    public static function getDebitCreditNote($outlet_id)
    {
        $dbn                    = DB::select('call SP_POS_DebitCreditNote_Select(?)', [$outlet_id]);
        return $dbn;
    }

    public static function setDebitCreditNote($debit_credit_note_id, $debit_credit_note_date, $debit_credit_note_amount, $debit_credit_note_type, $debit_credit_note_desc)
    {
        $set_debit_credit_note                = DB::select('call SP_POS_DebitCreditNote_Insert(?,?,?,?,?)', [$debit_credit_note_id, $debit_credit_note_date, $debit_credit_note_amount, $debit_credit_note_type, $debit_credit_note_desc]);
        return $set_debit_credit_note;
    }
}
