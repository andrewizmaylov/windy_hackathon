<?php

namespace App\Http\Controllers;

use App\Enums\PromptEnum;
use App\Models\Prompt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PromptController extends Controller
{
	public function index(): \Inertia\Response
	{
		return Inertia::render('Prompt/PromptIndex', [
			'prompts' => Prompt::all(),
		]);
    }

	public function create(): \Inertia\Response
	{
		return Inertia::render('Prompt/PromptCreate', [
			'prompt' => null,
		]);
	}

	public function store(Request $request)
	{
		$validated = $request->validate([
			'text' => 'required',
			'type' => 'required',
		]);

		Prompt::create($validated);

		return back()->with('success', 'Prompt has been created.');
	}

	public function update(Prompt $prompt): \Inertia\Response
	{
		return Inertia::render('Prompt/PromptCreate', [
			'prompt' => $prompt,
		]);
	}
}
