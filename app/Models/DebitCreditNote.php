<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Debit_credit_note extends Model
{
    protected $table = 'tbl_debit_credit_note';

    public static function getDebitCreditNoteLastID()
    {
        $last_id                = DB::select('call SP_GetLastID_Select(?)', ['petty_cash_id']);
        return $last_id;
    }

    public static function setDebitCreditNote($debit_credit_note_id, $debit_credit_note_date, $debit_credit_note_amount, $debit_credit_note_type, $debit_credit_note_desc)
    {
        $set_debit_credit_note                = DB::select('call SP_POS_DebitCreditNote_Insert(?,?,?,?,?)', [$debit_credit_note_id, $debit_credit_note_date, $debit_credit_note_amount, $debit_credit_note_type, $debit_credit_note_desc]);
        return $set_debit_credit_note;
    }
}
