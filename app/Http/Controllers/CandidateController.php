<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CandidateController extends Controller
{
    // Display jobs applied by the candidate
    public function appliedJobs(Request $request)
    {
        try {
            $email = $request->session()->get('email');
            $jobs = DB::table('jobs_applied')
                ->join('jobs', 'jobs_applied.job_id', '=', 'jobs.job_id')
                ->where('jobs_applied.email', $email)
                ->select('jobs.*')
                ->get();

            return view('layout', [
                'view' => 'candidates.applied-jobs',
                'jobs' => $jobs,
            ]);
        } catch (\Exception $e) {
            return redirect()->route("response.show", [
                'status' => "error",
                'message' => "Couldn't fetch applied jobs.",
                'code' => 500,
                'redirectUrl' => '/candidates/applied-jobs'
            ]);
        }
    }

    // Display all available jobs
    public function allJobs()
    {
        try {
            $jobs = DB::table('jobs')->where('verified', true)->get();

            return view('layout', [
                'view' => 'candidates.jobs',
                'jobs' => $jobs,
            ]);
        } catch (\Exception $e) {
            return redirect()->route("response.show", [
                'status' => "error",
                'message' => "Couldn't fetch jobs.",
                'code' => 500,
                'redirectUrl' => '/candidates/jobs'
            ]);
        }
    }

    // Apply for a job
    public function applyForJob(Request $request, $jobId)
    {
        try {
            $email = $request->session()->get('email');

            // Check if already applied
            $alreadyApplied = DB::table('jobs_applied')
                ->where('email', $email)
                ->where('job_id', $jobId)
                ->exists();

            if ($alreadyApplied) {
                return redirect()->route('response.show', [
                    'status' => "error",
                    'message' => "You have already applied for this job.",
                    'code' => 400,
                    'redirectUrl' => '/candidates/jobs'
                ]);
            }

            DB::table('jobs_applied')->insert([
                'email' => $email,
                'job_id' => $jobId,
            ]);

            return redirect()->route('response.show', [
                'status' => "success",
                'message' => "You have successfully applied for the job.",
                'code' => 200,
                'redirectUrl' => '/candidates/jobs'
            ]);
        } catch (Exception $e) {
            return redirect()->route("response.show", [
                'status' => "error",
                'message' => "There was an error applying for the job.",
                'code' => 500,
                'redirectUrl' => '/candidates/jobs'
            ]);
        }
    }
    public function unapplyJob(Request $request, $jobId)
    {
        try {
            $email = $request->session()->get('email');

            DB::table('jobs_applied')
                ->where('email', $email)
                ->where('job_id', $jobId)
                ->delete();

            return redirect()->route('response.show', [
                'status' => "success",
                'message' => "You have successfully unapplied from the job.",
                'code' => 200,
                'redirectUrl' => '/candidates/applied-jobs'
            ]);
        } catch (\Exception $e) {
            return redirect()->route("response.show", [
                'status' => "error",
                'message' => "There was an error when trying to unapply from the job.",
                'code' => 500,
                'redirectUrl' => '/candidates/applied-jobs'
            ]);
        }
    }
}
