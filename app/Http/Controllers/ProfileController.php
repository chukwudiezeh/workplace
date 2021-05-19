<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmploymentHistory;
use App\Models\Education;
use App\Models\Portfolio;
use App\Models\FreelanceSkill;

class ProfileController extends Controller
{

//FREELANCER
    public function addEmploymentHistory(Request $request, $freelancer){
        $employment = new EmploymentHistory;

        $employment->freelancer_id = $freelancer;
        $employment->company = $request->company;
        $employment->location = $request->location;
        $employment->title = $request->title;
        $employment->role = $request->role;
        $employment->start_year = $request->start_year;
        $employment->end_year = $request->end_year;
        $employment->currently_working = $request->currently_working;

        if ($employment->save()){
            return response()->json(['message'=>'Employment History Updated']);
        }
    }

    public function updateEmploymentHistory(Request $request, EmploymentHistory $employmentHistory, $freelancer){
        if ($employmentHistory->freelancer_id == $freelancer){
            $employmentHistory->freelancer_id = $freelancer;
            $employmentHistory->company = $request->company;
            $employmentHistory->location = $request->location;
            $employmentHistory->title = $request->title;
            $employmentHistory->role = $request->role;
            $employmentHistory->start_year = $request->start_year;
            $employmentHistory->end_year = $request->end_year;
            $employmentHistory->currently_working = $request->currently_working;
            $employmentHistory->save();

            return response()->json(['message'=> 'Employment History Updated!']);
        }
    }

    public function getEmploymentHistory($freelancer){
        $employment_histories = EmploymentHistory::where('freelancer_id',$freelancer)->get();

        if (count($employment_histories) > 0){
            return response()->json(['data'=> $employment_histories]);
        }
        return response()->json(['message'=> 'No Employment History added yet!']);
    }

    public function deleteEmploymentHistory(EmploymentHistory $employmentHistory, $freelancer){
        if ($employmentHistory->freelancer_id == $freelancer){
            $employmentHistory->delete();
            return response()->json(['message'=> 'Employment History Deleted!']);
        }
    }

    //EDUCATION
    public function addEducation(Request $request, $freelancer){
        $education = new Education;

        $education->freelancer_id = $freelancer;
        $education->school = $request->school;
        $education->attended_from = $request->attended_from;
        $education->attended_to = $request->attended_to;
        $education->degree = $request->degree;
        $education->area_of_study = $request->area_of_study;
        if ($education->save()){
            return response()->json(['message'=>'Education Added!']);
        }
    }

    public function updateEducation(Request $request, Education $education, $freelancer){
        if ($education->freelancer_id == $freelancer){
            $education->freelancer_id = $freelancer;
            $education->school = $request->school;
            $education->attended_from = $request->attended_from;
            $education->attended_to = $request->attended_to;
            $education->degree = $request->degree;
            $education->area_of_study = $request->area_of_study;
            $education->save();
            return response()->json(['message'=> 'Education Updated!']);
        }
    }

    public function getEducations($freelancer){
        $educations = Education::where('freelancer_id',$freelancer)->get();

        if (count($educations) > 0){
            return response()->json(['data'=> $educations]);
        }
        return response()->json(['message'=> 'No Education added yet!']);
    }

    public function deleteEducation(Education $education, $freelancer){
        if ($education->freelancer_id == $freelancer){
            $education->delete();
            return response()->json(['message'=> 'Education Deleted!']);
        }
    }

    //PORTFOLIO
    public function addPortfolio(Request $request, $freelancer){


        $portfolio = new Portfolio;

        $portfolio->freelancer_id = $freelancer;
        $portfolio->title = $request->title;
        $portfolio->description = $request->description;

        if ($request->hasFile('image')) {
            $request->validate(['image' => 'image|mimes:jpeg,png,jpg,gif, svg|max:2048']);
            $image_name = 'portfolio' . time() . '.' . $request->image->extension();
            if ($request->image->storeAs('portfolios', $image_name)) {

                $portfolio->image = $image_name;
            }
        }
        if ($request->has('link')){
            $portfolio->link = $request->link;
        }

        if ($portfolio->save()){
            return response()->json(['message'=>'Portfolio Added!']);
        }
    }

    public function updatePortfolio(Request $request, Portfolio $portfolio, $freelancer){
        if ($portfolio->freelancer_id == $freelancer){
            $portfolio->freelancer_id = $freelancer;
            $portfolio->title = $request->title;
            $portfolio->description = $request->description;
            if ($request->hasFile('image')) {
                $request->validate(['image' => 'image|mimes:jpeg,png,jpg,gif, svg|max:2048']);
                $image_name = 'portfolio' . time() . '.' . $request->image->extension();
                if ($request->image->storeAs('portfolios', $image_name)) {

                    $portfolio->image = $image_name;
                }
            }

            if ($request->has('link')){
                $portfolio->link = $request->link;
            }
            $portfolio->save();
            return response()->json(['message'=> 'Portfolio Updated!']);
        }
    }

    public function getPortfolios($freelancer){
        $portfolios = Portfolio::where('freelancer_id',$freelancer)->get();

        if (count($portfolios) > 0){
            return response()->json(['data'=> $portfolios]);
        }
        return response()->json(['message'=> 'No Portfolio added yet!']);
    }

    public function deletePortfolio(Portfolio $portfolio, $freelancer){
        if ($portfolio->freelancer_id == $freelancer){
            $portfolio->delete();
            return response()->json(['message'=> 'Portfolio Deleted!']);
        }
    }

    //FREELANCE SKILLS
    public function addFreelanceSkill(Request $request, $freelancer){
        $freelance_skill = new FreelanceSkill;

        $freelance_skill->freelancer_id = $freelancer;
        $freelance_skill->skill_id = $request->skill_id;
        if ($freelance_skill->save()){
            return response()->json(['message'=>'Skill Added!']);
        }
    }

    public function updateFreelanceSkill(Request $request, FreelanceSkill $freelance_skill, $freelancer){
        if ($freelance_skill->freelancer_id == $freelancer){
            $freelance_skill->freelancer_id = $freelancer;
            $freelance_skill->skill_id = $request->skill_id;
            $freelance_skill->save();
            return response()->json(['message'=> 'Skill Updated!']);
        }
    }

    public function getFreelanceSkill($freelancer){
        $freelance_skills = FreelanceSkill::where('freelancer_id',$freelancer)->get();

        if (count($freelance_skills) > 0){
            return response()->json(['data'=> $freelance_skills]);
        }
        return response()->json(['message'=> 'No Skill added yet!']);
    }

    public function deleteFreelanceSkill(FreelanceSkill $freelance_skill, $freelancer){
        if ($freelance_skill->freelancer_id == $freelancer){
            $freelance_skill->delete();
            return response()->json(['message'=> 'Skill Deleted!']);
        }
    }
}
