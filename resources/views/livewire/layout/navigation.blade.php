<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div x-data="{ sidebarOpen: false }">
    <!-- Mobile Top Header Bar -->
    <header class="lg:hidden bg-slate-900 border-b border-slate-800 text-white flex items-center justify-between px-4 py-3 sticky top-0 z-40">
        <div class="flex items-center space-x-3">
            <button @click="sidebarOpen = true" class="p-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center space-x-2">
                <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-cyan-500 to-blue-600 flex items-center justify-center font-bold text-white shadow-lg shadow-cyan-500/20">
                    TMS
                </div>
                <span class="font-semibold text-lg tracking-wide text-white">TMS Portal</span>
            </a>
        </div>

        <div class="flex items-center space-x-2">
            <span class="text-xs px-2.5 py-1 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 font-medium">Online</span>
        </div>
    </header>

    <!-- Mobile Drawer Overlay -->
    <div x-show="sidebarOpen" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false" 
         class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm z-50 lg:hidden" x-cloak></div>

    <!-- Sidebar Container (Desktop & Mobile Drawer) -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
           class="fixed top-0 left-0 bottom-0 w-64 bg-slate-900 border-e border-slate-800/80 z-50 flex flex-col transition-transform duration-300 ease-in-out lg:translate-x-0">
        
        <!-- Sidebar Brand Logo -->
        <div class="h-16 flex items-center justify-between px-5 border-b border-slate-800/80">
            <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center space-x-3">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-cyan-500 via-blue-600 to-indigo-600 flex items-center justify-center font-extrabold text-white shadow-lg shadow-cyan-500/25">
                    TMS
                </div>
                <div>
                    <h1 class="font-bold text-base tracking-tight text-white">TMS Monitor</h1>
                    <p class="text-[10px] uppercase font-semibold tracking-wider text-cyan-400">Live Temperature System</p>
                </div>
            </a>
            <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <div class="flex-1 overflow-y-auto px-4 py-6 space-y-1.5 scrollbar-thin">
            <div class="px-3 pb-2 text-[11px] font-bold uppercase tracking-wider text-slate-500">Navigation</div>
            
            <a href="{{ route('dashboard') }}" wire:navigate 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-xl font-medium text-sm transition-all duration-150 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-cyan-500/20 to-blue-500/10 text-cyan-400 border border-cyan-500/30' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('profile') }}" wire:navigate 
               class="flex items-center space-x-3 px-3 py-2.5 rounded-xl font-medium text-sm transition-all duration-150 {{ request()->routeIs('profile') ? 'bg-gradient-to-r from-cyan-500/20 to-blue-500/10 text-cyan-400 border border-cyan-500/30' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span>Profile Settings</span>
            </a>
        </div>

        <!-- User Info & Logout Footer Card -->
        <div class="p-4 border-t border-slate-800/80 bg-slate-900/60">
            <div class="flex items-center justify-between p-2 rounded-2xl bg-slate-800/50 border border-slate-700/50">
                <div class="flex items-center space-x-3 overflow-hidden">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-cyan-500 to-blue-600 flex items-center justify-center font-bold text-white text-xs shrink-0 shadow-md">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
                    </div>
                    <div class="truncate">
                        <p class="text-xs font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-slate-400 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>

                <button wire:click="logout" title="Log Out" class="p-2 rounded-xl text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </button>
            </div>
        </div>
    </aside>
</div>
