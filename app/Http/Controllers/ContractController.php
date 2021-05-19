<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Client;


class ContractController extends Controller
{
    public function showClientContracts($client)
    {
        $contracts = Contract::where('client_id',$client)->get();

        return response()->json(['data' =>$contracts], 200);


    }

    public function showFreelancerContracts($freelancer)
    {
        $contracts = Contract::where('freelancer_id', $freelancer)->get();
    }

    public function showOneContract($id, Contract $contract)
    {
        if ($id == $contract->client_id || $id == $contract->freelancer_id) {
            return response()->json(['data' => $contract], 200);
        }
    }


    public function approvedForPayments($client, Contract $contract)
    {
        if ($client == $contract->client_id){
            $contract->contract_status_id = 1;
            $contract->save();

            return response()->json(['data'=>$contract], 200);
        }

    }

    public function completedButPendingApproval($freelancer, Contract $contract){
        if ($freelancer == $contract->freelancer_id){
            $contract->contract_status_id = 2;
            $contract->save();

            return response()->json(['data'=>$contract], 200);
        }
    }

    public function needChanges($client, Contract $contract){
        if ($client == $contract->client_id){
            $contract->contract_status_id = 3;
            $contract->save();

            return response()->json(['data'=>$contract], 200);
        }
    }

    public function delayed(Contract $contract){
        $contract->contract_status_id = 4;
        $contract->save();

        return response()->json(['data'=>$contract], 200);
    }





}
