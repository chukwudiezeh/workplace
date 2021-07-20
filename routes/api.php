<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\JobTaskBoardController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobInviteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
// */
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('workplace')->group(function() {
    Route::post('register', [RegisterController::class, 'register']); //register
    Route::post('login', [LoginController::class, 'login']); //login
    Route::middleware('auth:sanctum')->group(function () {
        //Freelancer routes begin

        Route::prefix('{freelancer}')->group(function () {
            Route::prefix('profile')->group(function () {
                Route::patch('basicInformation', [FreelancerController::class, 'updateFreelancer'])->middleware('freelancer');
                Route::prefix('education')->group(function () {
                    Route::post('create', [ProfileController::class, 'addEducation'])->middleware('freelancer');
                    Route::put('{education}/update', [ProfileController::class, 'updateEducation'])->middleware('freelancer');
                    Route::get('{education}', [ProfileController::class, 'getEducation'])->middleware('freelancer');
                    Route::delete('{education}/delete', [ProfileController::class, 'deleteEducation'])->middleware('freelancer');
                });
                Route::prefix('portfolio')->group(function () {
                    Route::post('create', [ProfileController::class, 'addPortfolio'])->middleware('freelancer');
                    Route::put('{portfolio}/update', [ProfileController::class, 'updatePortfolio'])->middleware('freelancer');
                    Route::get('{portfolio}', [ProfileController::class, 'getPortfolio'])->middleware('freelancer');
                    Route::delete('{portfolio}/delete', [ProfileController::class, 'deletePortfolio'])->middleware('freelancer');
                });
                Route::prefix('employmentHistory')->group(function () {
                    Route::post('create', [ProfileController::class, 'addEmploymentHistory'])->middleware('freelancer');
                    Route::put('{employmentHistory}/update', [ProfileController::class, 'updateEmploymentHistory'])->middleware('freelancer');
                    Route::get('{employmentHistory}', [ProfileController::class, 'getEmploymentHistory'])->middleware('freelancer');
                    Route::delete('{employmentHistory}/delete', [ProfileController::class, 'deleteEmploymentHistory'])->middleware('freelancer');
                });
                Route::prefix('freelanceSkill')->group(function () {
                    Route::post('create', [ProfileController::class, 'addFreelanceSkill'])->middleware('freelancer');
                    Route::put('{freelanceSkill}/update', [ProfileController::class, 'updateFreelanceSkill'])->middleware('freelancer');
                    Route::get('{freelanceSkill}', [ProfileController::class, 'getFreelanceSkill'])->middleware('freelancer');
                    Route::delete('{freelanceSkill}/delete', [ProfileController::class, 'deleteFreelanceSkill'])->middleware('freelancer');
                });
            });
            Route::get('findJobs', [JobController::class, 'index'])->middleware('freelancer'); //retrieve jobs based on my category
            Route::prefix('jobs')->group(function(){
                Route::get('{job}', [JobController::class, 'show'])->middleware('freelancer'); // show job details so i can apply
                Route::post('{job}/send_proposal', [ProposalController::class, 'create'])->middleware('freelancer'); //submit proposals //TODO notify client of new proposal
                Route::get('{job}/{search}', [JobController::class, 'search'])->middleware('freelancer'); //search with keywords
            });
            Route::prefix('proposals')->group(function (){
                Route::get('', [ProposalController::class, 'index'])->middleware('freelancer'); //View my proposals
                Route::prefix('{proposal}')->group(function(){
                    Route::get('',[ProposalController::class, 'show'])->middleware('freelancer'); //show me a proposal details
                    Route::patch('update', [ProposalController::class, 'update'])->middleware('freelancer'); //update a sent proposal
                    Route::patch('withdraw', [ProposalController::class, 'withdrawProposal'])->middleware('freelancer'); //withdraw a proposal
                });
            });


            Route::prefix('contracts')->group(function(){
                Route::get('', [ContractController::class, 'showFreelancerContracts'])->middleware('freelancer');
                Route::prefix('{contract}')->group(function (){
                    Route::get('', [ContractController::class, 'showOneContract'])->middleware('freelancer');
                    Route::patch('markAsComplete',[ContractController::class, 'completeButPendingApproval'])->middleware('freelancer');//TODO notify client of completion of job

                    Route::prefix('jobTaskBoard')->group(function (){
                        Route::post('create', [JobTaskBoardController::class,'createJobTaskBoard']);
                        Route::prefix('{jobTaskBoard}')->group(function(){
                            Route::patch('addTask',[JobTaskBoardController::class, 'addJobTask']);
                            Route::get('view',[JobTaskBoardController::class, 'viewJobTaskBoard']);
                            Route::patch('{taskId}/move_to_todo', [JobTaskBoardController::class, 'moveToTodo']);
                            Route::patch('{taskId}/move_to_doing', [JobTaskBoardController::class, 'moveToDoing']);
                            Route::patch('{taskId}/move_to_done', [JobTaskBoardController::class, 'moveToDone']);
                            Route::patch('{taskId}/delete_task', [JobTaskBoardController::class, 'deleteJobTask']);
                        });

                    });

                    Route::prefix('conversations')->group(function(){
                        Route::get('',[ConversationController::class,'getAllConversations']); //TODO check this controller function
                        Route::post('create', [ConversationController::class, 'create'])->middleware('client');
                        Route::get('{conversation}/messages', [MessageController::class, 'getMessages']);
                        Route::post('{conversation}/messages/{message}/addMessage',[MessageController::class,'store']);
                    });
                });
            });


        });
    });
});