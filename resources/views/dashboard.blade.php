<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-white tracking-tight">
                    Temperature Monitoring System (TMS)
                </h2>
                <p class="text-xs text-slate-400 mt-1">Real-time machine telemetry & PT100 probe monitoring center</p>
            </div>
            <div class="flex items-center space-x-3">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-cyan-500/10 text-cyan-400 border border-cyan-500/20">
                    <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                    Asia/Kolkata (IST)
                </span>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Machine Status Stat Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div class="p-5 rounded-2xl bg-slate-900/80 border border-slate-800/80 shadow-lg hover:border-slate-700/80 transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Host Module</span>
                    <span class="p-2 rounded-xl bg-emerald-500/10 text-emerald-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path>
                        </svg>
                    </span>
                </div>
                <div class="mt-4 flex items-baseline justify-between">
                    <span class="text-2xl font-black text-white">Online</span>
                    <span class="text-xs text-emerald-400 font-semibold">4G LTE + Wi-Fi</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-2">SIM & Wi-Fi Gateway Ready</p>
            </div>

            <div class="p-5 rounded-2xl bg-slate-900/80 border border-slate-800/80 shadow-lg hover:border-slate-700/80 transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Temperature Client</span>
                    <span class="p-2 rounded-xl bg-cyan-500/10 text-cyan-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                        </svg>
                    </span>
                </div>
                <div class="mt-4 flex items-baseline justify-between">
                    <span class="text-2xl font-black text-white">4 PT100 Probes</span>
                    <span class="text-xs text-cyan-400 font-semibold">MAX31865 RTD</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-2">High Precision Sensor Hub</p>
            </div>

            <div class="p-5 rounded-2xl bg-slate-900/80 border border-slate-800/80 shadow-lg hover:border-slate-700/80 transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Battery & Power</span>
                    <span class="p-2 rounded-xl bg-blue-500/10 text-blue-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </span>
                </div>
                <div class="mt-4 flex items-baseline justify-between">
                    <span class="text-2xl font-black text-white">98%</span>
                    <span class="text-xs text-emerald-400 font-semibold">AC Mains Connected</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-2">Charging Module Active</p>
            </div>

            <div class="p-5 rounded-2xl bg-slate-900/80 border border-slate-800/80 shadow-lg hover:border-slate-700/80 transition-all">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Sanctum API Ingestion</span>
                    <span class="p-2 rounded-xl bg-purple-500/10 text-purple-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </span>
                </div>
                <div class="mt-4 flex items-baseline justify-between">
                    <span class="text-2xl font-black text-white">Active</span>
                    <span class="text-xs text-purple-400 font-semibold">Token Auth</span>
                </div>
                <p class="text-[11px] text-slate-500 mt-2">Machine Endpoint Security</p>
            </div>
        </div>

        <!-- Git Self-Updater Console Panel -->
        <div x-data="{
            loading: false,
            gitInfo: null,
            consoleLogs: '',
            fetchInfo() {
                fetch('{{ route('git.info') }}')
                    .then(res => res.json())
                    .then(data => { this.gitInfo = data; })
                    .catch(err => console.error(err));
            },
            runUpdate() {
                if (!confirm('Run automated git pull, migrations, and cache clear?')) return;
                this.loading = true;
                this.consoleLogs = '[PROCESS STARTED]: Pulling origin code and running migrations...\n';
                fetch('{{ route('git.update') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    this.loading = false;
                    this.consoleLogs += data.logs + '\n' + '[STATUS]: ' + data.message;
                    this.fetchInfo();
                })
                .catch(err => {
                    this.loading = false;
                    this.consoleLogs += '[ERROR]: ' + err.message;
                });
            }
        }" x-init="fetchInfo()" class="p-6 rounded-3xl bg-slate-900/90 border border-slate-800/80 shadow-2xl space-y-4">
            
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
                <div class="flex items-center space-x-3">
                    <div class="p-3 rounded-2xl bg-cyan-500/10 text-cyan-400 border border-cyan-500/20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg text-white">Git Self-Updater & System Diagnostics</h3>
                        <p class="text-xs text-slate-400">Automated deployment control & repository sync</p>
                    </div>
                </div>

                <button @click="runUpdate()" :disabled="loading" 
                        class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-semibold text-xs uppercase tracking-wider shadow-lg shadow-cyan-500/25 transition-all disabled:opacity-50">
                    <svg x-show="loading" class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span x-text="loading ? 'Updating System...' : 'Pull & Update Repository'"></span>
                </button>
            </div>

            <!-- Diagnostics Grid -->
            <template x-if="gitInfo">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                    <div class="p-3 rounded-xl bg-slate-950/60 border border-slate-800">
                        <span class="text-slate-500 block mb-1">Current Branch</span>
                        <span class="font-mono font-bold text-cyan-400" x-text="gitInfo.branch"></span>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-950/60 border border-slate-800">
                        <span class="text-slate-500 block mb-1">Latest Commit</span>
                        <span class="font-mono text-slate-200 truncate block" x-text="gitInfo.last_commit"></span>
                    </div>
                    <div class="p-3 rounded-xl bg-slate-950/60 border border-slate-800">
                        <span class="text-slate-500 block mb-1">Repository Remote</span>
                        <span class="font-mono text-slate-300 truncate block" x-text="gitInfo.remote_url"></span>
                    </div>
                </div>
            </template>

            <!-- Console Log Panel -->
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Console Output Log</label>
                <div class="p-4 rounded-2xl bg-slate-950 border border-slate-800 font-mono text-xs text-emerald-400 h-48 overflow-y-auto whitespace-pre-wrap leading-relaxed shadow-inner">
                    <span x-text="consoleLogs || '> System diagnostics ready. Click [Pull & Update Repository] to perform live git sync.'"></span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
