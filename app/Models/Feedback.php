<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Feedback extends Model
{
    protected $table        = 'tbl_feedback';

    public static function getFeedbackCategoryLastID()
    {
        $category_last_id                = DB::select('call SP_GetLastID_Select(?)', ['feedback_category_id']);
        return $category_last_id;
    }

    public static function getFeedbackTypeLastID()
    {
        $type_last_id                = DB::select('call SP_GetLastID_Select(?)', ['feedback_type_id']);
        return $type_last_id;
    }

    public static function getAllFeedbackList()
    {
        $feedback           = DB::select('call SP_CS_Five_FeedbackList_Select');
        return $feedback;
    }

    public static function setFeedback($feedback_category_id, $feedback_category_name, $feedback_type_id, $feedback_type_name)
    {
        $set_feedback                = DB::select('call SP_CS_Five_FeedbackList_Insert(?,?,?,?)', [$feedback_category_id, $feedback_category_name, $feedback_type_id, $feedback_type_name]);
        return $set_feedback;
    }

    public static function setUpdateFeedback($feedback_category_id, $feedback_category_name, $feedback_type_name)
    {
        $set_update_feedback                = DB::select('call SP_CS_Five_FeedbackList_Update(?,?,?)', [$feedback_category_id, $feedback_category_name, $feedback_type_name]);
        return $set_update_feedback;
    }
    
    public static function getFeedbackByID($feedback_category_id)
    {
        $feedback       = DB::select('call SP_CS_FeedbackList_ByID_Select(?)', [$feedback_category_id]);
        return $feedback;
    }

    public static function setDeleteFeedback($feedback_category_id)
    {
        $delete                = DB::select('call SP_CS_Five_FeedbackList_Delete(?)', [$feedback_category_id]);
        return $delete;
    }
}
