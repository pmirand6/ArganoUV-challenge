<?php

namespace App\Http\Controllers;

use App\Services\GithubService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GithubController extends Controller
{

    public function __construct(private GithubService $githubService)
    {
    }

    public function pullRepos(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
        ], [
            'name.required' => 'Username field is required.',
        ]);

        $this->githubService->pullRepos($validatedData['username']);

        return Redirect::back()->with('message','Operation Successful !');

    }

    public function index()
    {
        $repos = $this->githubService->getAllRepos();

        return view('pages.listrepos', compact('repos'));
    }
}
