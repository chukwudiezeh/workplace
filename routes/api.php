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
//    Route::middleware('auth:sanctum')->group(function () {
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
                Route::get('', [ProposalController::class, 'index']); //View my proposals
                Route::prefix('{proposal}')->group(function(){
                    Route::get('',[ProposalController::class, 'show'])->middleware('freelancer'); //show me a proposal details
                    Route::patch('update', [ProposalController::class, 'update'])->middleware('freelancer'); //update a sent proposal
                    Route::patch('withdraw', [ProposalController::class, 'withdrawProposal'])->middleware('freelancer'); //withdraw a proposal
                });
            });


        });
//    });
});