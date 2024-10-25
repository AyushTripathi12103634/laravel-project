<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployerController extends Controller
{
    public function createJob(Request $request)
    {
        try {
            DB::table('jobs')->insert([
                'created_by' => $request->created_by,
                'company' => $request->company,
                'role' => $request->role,
                'location' => $request->location,
                'salary' => $request->salary,
                'joining_date' => $request->joining_date,
                'required_skillset' => $request->required_skillset,
                'rest_of_requirements' => $request->rest_of_requirements,
                'lei' => $request->lei,
                'lei_issuer' => $request->lei_issuer
            ]);

            return redirect()->route("response.show", [
                'status' => "success",
                'message' => "Job created successfully. Wait for acceptance from admin.",
                'code' => 201,
                'redirectUrl' => '/employers/jobs'
            ]);
        } catch (Exception $e) {
            return redirect()->route("response.show", [
                'status' => "error",
                'message' => "Job couldn't be created.",
                'code' => 500,
                'redirectUrl' => '/employers/jobs'
            ]);
        }
    }

    public function index(Request $request)
    {
        try {
            $createdBy = $request->session()->get('id');
            $jobs = DB::table('jobs')->where('created_by', $createdBy)->get();

            return view('layout', [
                'view' => 'employers.jobs',
                'jobs' => $jobs,
            ]);
        } catch (Exception $e) {
            return redirect()->route("response.show", [
                'status' => "error",
                'message' => "Couldn't fetch jobs.",
                'code' => 500,
                'redirectUrl' => '/employers/jobs'
            ]);
        }
    }

    public function delete($id)
    {
        try {
            DB::table('jobs')->where('job_id', $id)->delete();

            return redirect()->route("response.show", [
                'status' => "success",
                'message' => "Job deleted successfully.",
                'code' => 200,
                'redirectUrl' => '/employers/jobs'
            ]);
        } catch (Exception $e) {
            return redirect()->route("response.show", [
                'status' => "error",
                'message' => "Job couldn't be deleted.",
                'code' => 500,
                'redirectUrl' => '/employers/jobs'
            ]);
        }
    }

    public function showApplicants($jobId)
    {
        try {
            $applicants = DB::table('jobs_applied')
                ->join('Authentication', 'jobs_applied.email', '=', 'Authentication.email')
                ->where('jobs_applied.job_id', $jobId)
                ->select('Authentication.name', 'Authentication.email')
                ->get();

            return view('layout', [
                'view' => 'employers.applicants',
                'applicants' => $applicants,
                'jobId' => $jobId,
            ]);
        } catch (\Exception $e) {
            return redirect()->route("response.show", [
                'status' => "error",
                'message' => "Couldn't fetch applicants.",
                'code' => 500,
                'redirectUrl' => '/employers/jobs'
            ]);
        }
    }
}
