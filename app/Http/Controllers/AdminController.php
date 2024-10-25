<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function showProfile(Request $request)
    {
        try {
            $filter = $request->input('filter', 'all');
            $query = DB::table('jobs');

            if ($filter === 'verified') {
                $query->where('verified', true);
            } elseif ($filter === 'unverified') {
                $query->where('verified', false);
            }

            $jobs = $query->get();

            return view('layout', [
                'view' => 'admin.profile',
                'jobs' => $jobs,
            ]);
        } catch (Exception $e) {
            return redirect()->route("response.show", [
                'status' => "error",
                'message' => "Couldn't fetch jobs.",
                'code' => 500,
                'redirectUrl' => '/admin/profile'
            ]);
        }
    }

    public function verifyJob(Request $request, $id)
    {
        try {
            DB::table('jobs')->where('job_id', $id)->update([
                'verified' => $request->verified,
            ]);

            return redirect()->route("response.show", [
                'status' => "success",
                'message' => "Job verification status updated successfully.",
                'code' => 200,
                'redirectUrl' => '/admin/profile'
            ]);
        } catch (Exception $e) {
            return redirect()->route("response.show", [
                'status' => "error",
                'message' => "Job verification status couldn't be updated.",
                'code' => 500,
                'redirectUrl' => '/admin/profile'
            ]);
        }
    }
}
