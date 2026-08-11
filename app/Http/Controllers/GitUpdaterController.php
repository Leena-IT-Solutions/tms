<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Process;

class GitUpdaterController extends Controller
{
    /**
     * Get diagnostic git status and current commit information.
     */
    public function info(Request $request): JsonResponse
    {
        $branch = Process::path(base_path())->run('git rev-parse --abbrev-ref HEAD')->output();
        $lastCommit = Process::path(base_path())->run('git log -1 --pretty=format:"%h - %s (%cr) <%an>"')->output();
        $status = Process::path(base_path())->run('git status --short')->output();
        $remote = Process::path(base_path())->run('git remote get-url origin')->output();

        return response()->json([
            'status' => 'success',
            'branch' => trim($branch),
            'last_commit' => trim($lastCommit),
            'has_uncommitted_changes' => ! empty(trim($status)),
            'status_output' => trim($status),
            'remote_url' => trim($remote),
        ]);
    }

    /**
     * Perform automated git pull and framework cache clear/migrations.
     */
    public function update(Request $request): JsonResponse
    {
        $logs = [];

        // 1. Git Pull
        $gitResult = Process::path(base_path())->run('git pull origin ' . trim(Process::path(base_path())->run('git rev-parse --abbrev-ref HEAD')->output()));
        $logs[] = "[GIT PULL]:\n" . $gitResult->output() . $gitResult->errorOutput();

        // 2. Migration
        Artisan::call('migrate', ['--force' => true]);
        $logs[] = "[MIGRATIONS]:\n" . Artisan::output();

        // 3. Clear Caches
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        $logs[] = "[CACHE CLEAR]: System caches flushed successfully.";

        return response()->json([
            'status' => 'success',
            'message' => 'System self-update completed successfully.',
            'logs' => implode("\n----------------------------------------\n", $logs),
        ]);
    }
}
