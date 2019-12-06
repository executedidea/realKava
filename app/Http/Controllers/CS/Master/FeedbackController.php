<?php

namespace App\Http\Controllers\CS\Master;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    //
    public function index()
    {
        $feedback       = Feedback::getAllFeedbackList();
        return view('cs.master.feedback.index', compact('feedback'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (count(Feedback::all()) <= 0) {
            $feedback_category_id              = 1;
        } else {
            $feedback_category_lastID          = Feedback::getFeedbackCategoryLastID();
            $feedback_category_id              = $feedback_category_lastID[0]->feedback_category_id + 1;
        }

        if (count(Feedback::all()) <= 0) {
            $feedback_type_id              = 1;
        } else {
            $feedback_type_lastID          = Feedback::getFeedbackTypeLastID();
            $feedback_type_id              = $feedback_type_lastID[0]->feedback_type_id + 1;
        }
        
        $feedback_category_name            = $request->feedback_category_name;
        $feedback_type_name                = $request->feedback_type_name;


        Feedback::setFeedback(
            $feedback_category_id,
            $feedback_category_name,
            $feedback_type_id,
            $feedback_type_name
        );
        
        return back()->with('feedbackAdded');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $feedback_category_id)
    {        
        $feedback_category_name                = $request->feedback_category_name;
        $feedback_type_name                    = $request->feedback_type_name;

        Feedback::setUpdateFeedback(
            $feedback_category_id,
            $feedback_category_name,
            $feedback_type_name
        );
        
        return back()->with('feedbackEdited');
    }

    public function destroy(Request $request)
    {
        $feedback_category_id                  = $request->id;
        // CONDITION----------------------------------------------------------------------------
        if(!strpos($feedback_category_id, ',') !== false){
            Feedback::setDeleteFeedback($feedback_category_id);
        } else {
            $feedback_category_ids             = explode(",", $feedback_category_id);
            // INSERT---------------------------------------------------------------------------
            foreach($feedback_category_ids as $item){
                Feedback::setDeleteFeedback($item);
            }
            // ---------------------------------------------------------------------------------
        }
        // -------------------------------------------------------------------------------------
        return response()->json(['status'=>true, 'message'=>'Data deleted successfuly!']);
    }

    public function getFeedbackByID($feedback_category_id)
    {
        $feedback                     = Feedback::getFeedbackByID($feedback_category_id);
        return response()->json([
            'status'    => true,
            'feedback'  => $feedback
        ]);
    }
}
