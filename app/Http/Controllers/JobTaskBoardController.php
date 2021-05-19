<?php

namespace App\Http\Controllers;

use App\Models\JobTaskBoard;
use App\Models\Contract;
use Illuminate\Http\Request;

class JobTaskBoardController extends Controller
{

    public function viewJobTaskBoard(Contract $contract, $jobTaskBoard)
    {
        if (JobTaskBoard::where('contract_id', $contract->id)->exists()) {
            $job_task_board = JobTaskBoard::where('contract_id' )->get();
            return response()->json(['data' => $job_task_board], 200);
        }
    }


    public function createJobTaskBoard(Request $request,Contract $contract){
        $job_task_board = new JobTaskBoard;
        $job_task_board->contract_id = $contract->id;
        $job_task_board->job_tasks = array();
        $job_task_board->save();

        return response()->json(['data'=> $job_task_board], 201);
    }


    public function addJobTask(Request $request, Contract $contract, $jobTaskBoard){
        $job_task_board = JobTaskBoard::find($jobTaskBoard);
        if ($job_task_board->contract_id == $contract->id){
            $job_tasks = $job_task_board->job_tasks;

            foreach($request->all() as $item){
                array_push($job_tasks, $item);
            }

            $job_task_board->job_tasks = $job_tasks;
            $job_task_board->save();

            return response()->json(['data' => $job_task_board]);
        }

//        return response()->json(['data'=> $job_task_board], 201);
    }

    public function moveToTodo(Contract $contract, JobTaskBoard $jobTaskBoard, $taskId)
    {
        if ($jobTaskBoard->contract_id == $contract->id){
            $job_tasks = $jobTaskBoard->job_tasks;
            for ($i =0; $i< count($job_tasks); $i++){
                if ($job_tasks[$i]['task_id'] == $taskId){
                    $job_tasks[$i]['status'] = "Todo";
                }
            }

            $jobTaskBoard->job_tasks = $job_tasks;
            $jobTaskBoard->save();

            return response()->json(['data' => $jobTaskBoard]);
        }
    }

    public function moveToDoing(Contract $contract, JobTaskBoard $jobTaskBoard, $taskId)
    {
        if ($jobTaskBoard->contract_id == $contract->id){
            $job_tasks = $jobTaskBoard->job_tasks;
            for ($i =0; $i< count($job_tasks); $i++){
                if ($job_tasks[$i]['task_id'] == $taskId){
                    $job_tasks[$i]['status'] = "Doing";
                }
            }

            $jobTaskBoard->job_tasks = $job_tasks;
            $jobTaskBoard->save();

            return response()->json(['data' => $jobTaskBoard]);
        }
    }

    public function moveToDone(Contract $contract, JobTaskBoard $jobTaskBoard, $taskId)
    {
        if ($jobTaskBoard->contract_id == $contract->id){
            $job_tasks = $jobTaskBoard->job_tasks;
            for ($i =0; $i< count($job_tasks); $i++){
                if ($job_tasks[$i]['task_id'] == $taskId){
                    $job_tasks[$i]['status'] = "Done";
                }
            }

            $jobTaskBoard->job_tasks = $job_tasks;
            $jobTaskBoard->save();

            return response()->json(['data' => $jobTaskBoard]);
        }
    }

    public function deleteJobTask(Contract $contract, JobTaskBoard $jobTaskBoard, $taskId)
    {
        if ($jobTaskBoard->contract_id == $contract->id) {
            $job_tasks = $jobTaskBoard->job_tasks;
            for ($i = 0; $i < count($job_tasks); $i++) {
                if ($job_tasks[$i]['task_id'] == $taskId) {
                    unset($job_tasks[$i]);
                }
            }

            $job_tasks = array_values($job_tasks);
            $jobTaskBoard->job_tasks = $job_tasks;
            $jobTaskBoard->save();

            return response()->json(['data' => $jobTaskBoard]);
        }
    }


//    public function deleteJobTaskBoard(){
//
//    }
}
