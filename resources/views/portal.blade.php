<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client Portal &bull; {{ $project->client->company_name ?? 'Horizon Luxury EV' }} &bull; AgencyFlow</title>
    <meta name="description" content="Secure enterprise client portal for creative deliverable proofing, stage governance, and milestone billing.">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|syne:700,800|space-mono:400,700" rel="stylesheet" />

    <style>
        :root {
            --font-sans: 'Instrument Sans', sans-serif;
            --font-heading: 'Syne', sans-serif;
            --font-mono: 'Space Mono', monospace;
        }
        body {
            font-family: var(--font-sans);
            background-color: #060608;
            color: #ededef;
            overflow-x: hidden;
        }
        .font-heading {
            font-family: var(--font-heading);
        }
        .font-mono-code {
            font-family: var(--font-mono);
        }
        .ambient-glow {
            background: radial-gradient(circle at 50% -10%, rgba(245, 158, 11, 0.14) 0%, rgba(10, 10, 14, 0) 70%);
        }
        .glass-panel {
            background: rgba(14, 14, 18, 0.72);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.5);
        }
        .glass-panel:hover {
            border-color: rgba(255, 255, 255, 0.14);
        }
        .glass-panel-amber {
            background: rgba(22, 18, 12, 0.75);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(245, 158, 11, 0.25);
        }
        .gold-gradient-text {
            background: linear-gradient(135deg, #FFFFFF 0%, #FBBF24 50%, #D97706 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #08080a;
        }
        ::-webkit-scrollbar-thumb {
            background: #22222a;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #f59e0b;
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="selection:bg-amber-500 selection:text-black antialiased relative" x-data="{
    activeTab: 'deliverables',
    approvalModalOpen: false,
    revisionModalOpen: false,
    paymentModalOpen: false,
    scopeAssistantOpen: false,
    signatureSuccess: false,
    paymentSuccess: false,
    copiedHex: '',
    selectedVersion: 'v1.2',
    proofViewMode: 'mockup',
    signatoryName: 'Charlotte Dubois',
    signatoryTitle: 'Chief Brand Officer',
    signatureHash: 'sha256-7f9a88b19e44bc602b1f8876c5d4e33918a0',
    revisionCategory: 'typography',
    revisionPriority: 'high',
    revisionFeedback: '',
    revisionSubmitted: false,
    hotspotActive: null,
    
    // AI Scope Calculator state
    scopeDeliverable: '3d_animation',
    scopeRounds: 2,
    scopeTimeline: 'express',
    calculateScopeAddon() {
        let base = this.scopeDeliverable === '3d_animation' ? 7500 : (this.scopeDeliverable === 'packaging_sku' ? 3800 : 4500);
        let speed = this.scopeTimeline === 'express' ? 1.3 : 1.0;
        return Math.round(base * speed);
    },
    
    copyToClipboard(text) {
        navigator.clipboard.writeText(text);
        this.copiedHex = text;
        setTimeout(() => { this.copiedHex = ''; }, 2000);
    },
    
    signAndApprove() {
        this.signatureSuccess = true;
        setTimeout(() => {
            this.approvalModalOpen = false;
        }, 1800);
    },

    submitRevision() {
        this.revisionSubmitted = true;
        setTimeout(() => {
            this.revisionModalOpen = false;
            this.revisionSubmitted = false;
            this.revisionFeedback = '';
        }, 1800);
    },

    processMockPayment() {
        this.paymentSuccess = true;
        setTimeout(() => {
            this.paymentModalOpen = false;
        }, 1800);
    }
}">

    <!-- Ambient Gradient Background -->
    <div class="absolute inset-0 top-0 h-[600px] ambient-glow pointer-events-none -z-10"></div>

    <!-- Top Global App Bar -->
    <header class="glass-panel border-b border-white/5 px-6 md:px-12 py-3.5 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="/" class="flex items-center gap-2.5 group">
                    <span class="w-3.5 h-3.5 rounded-full bg-amber-500 shadow-[0_0_12px_#f59e0b] animate-pulse"></span>
                    <span class="font-heading font-extrabold text-white text-lg tracking-tight group-hover:text-amber-400 transition-colors">
                        AGENCYFLOW
                    </span>
                </a>
                <span class="text-neutral-600 text-sm hidden sm:inline">&bull;</span>
                <div class="hidden sm:flex items-center gap-2 px-3 py-1 rounded-full bg-neutral-900 border border-white/10 text-xs font-mono-code text-neutral-300">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <span>LIVE PORTAL</span>
                    <span class="text-neutral-500">&bull;</span>
                    <span class="text-amber-400 font-bold">{{ $project->client->company_name ?? 'Horizon Luxury EV' }}</span>
                </div>
            </div>

            <div class="flex items-center gap-5">
                <div class="hidden md:flex flex-col text-right">
                    <span class="text-xs font-semibold text-white tracking-wide">Charlotte Dubois</span>
                    <span class="text-[11px] text-neutral-400 font-mono-code">Chief Brand Officer &bull; Verified Client</span>
                </div>

                <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-amber-600 to-amber-300 text-black flex items-center justify-center font-bold text-xs shadow-md shadow-amber-500/20">
                    CD
                </div>

                <div class="h-6 w-px bg-white/10 hidden sm:block"></div>

                <a href="/admin" class="text-xs font-mono-code text-neutral-400 hover:text-amber-400 flex items-center gap-1.5 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Agency ERP HQ
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 md:px-12 pt-8 pb-16">

        <!-- Project Hero Card with Real-time Telemetry -->
        <div class="glass-panel rounded-3xl p-8 md:p-10 mb-8 border-l-4 border-l-amber-500 relative overflow-hidden">
            <!-- Background Ambient Glow -->
            <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8 relative z-10">
                <div class="space-y-3">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="px-2.5 py-1 rounded-md text-[11px] font-mono-code font-bold uppercase bg-amber-500/15 text-amber-400 border border-amber-500/30">
                            {{ $project->project_code ?? 'PRJ-2026-001' }}
                        </span>
                        <span class="px-2.5 py-1 rounded-md text-[11px] font-mono-code uppercase bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                            Active Creative Sprint
                        </span>
                        <span class="text-xs text-neutral-400 font-mono-code">
                            Director: <strong class="text-white">{{ $project->projectManager->name ?? 'Marcus Sterling' }}</strong>
                        </span>
                    </div>

                    <h1 class="font-heading text-3xl md:text-4xl lg:text-5xl font-black text-white tracking-tight leading-tight">
                        {{ $project->project_name ?? 'Horizon EV Global Brand Identity & Launch' }}
                    </h1>

                    <p class="text-sm md:text-base text-neutral-400 max-w-3xl leading-relaxed">
                        {{ $project->description ?? 'Complete corporate rebranding, custom aerodynamic typography, 3D visual language, and digital launch campaign.' }}
                    </p>
                </div>

                <!-- KPI Metric Tiles -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 self-start lg:self-center shrink-0">
                    <div class="glass-panel p-4 rounded-2xl text-center border border-white/5">
                        <span class="text-[10px] font-mono-code uppercase text-neutral-400 block tracking-wider">AI Health Score</span>
                        <div class="font-heading text-2xl font-black text-emerald-400 mt-0.5">
                            {{ number_format($project->health_score ?? 94.5, 1) }}%
                        </div>
                        <span class="text-[10px] text-emerald-500 font-mono-code">Optimal Condition</span>
                    </div>

                    <div class="glass-panel p-4 rounded-2xl text-center border border-white/5">
                        <span class="text-[10px] font-mono-code uppercase text-neutral-400 block tracking-wider">Active Stage</span>
                        <div class="font-heading text-2xl font-black text-amber-400 mt-0.5">
                            4 <span class="text-neutral-500 text-sm font-normal">/ 7</span>
                        </div>
                        <span class="text-[10px] text-amber-500 font-mono-code">Logo & Identity</span>
                    </div>

                    <div class="glass-panel p-4 rounded-2xl text-center border border-white/5 col-span-2 sm:col-span-1">
                        <span class="text-[10px] font-mono-code uppercase text-neutral-400 block tracking-wider">Settled SOW</span>
                        <div class="font-heading text-2xl font-black text-white mt-0.5">
                            $47.5k
                        </div>
                        <span class="text-[10px] text-neutral-400 font-mono-code">50% Milestone</span>
                    </div>
                </div>
            </div>

            <!-- Stage Cadence Stepper -->
            <div class="mt-8 pt-6 border-t border-white/10">
                <div class="flex items-center justify-between text-xs font-mono-code text-neutral-400 mb-3">
                    <span class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                        Current Progress: <strong class="text-white">Stage 4: Logo & Identity System</strong>
                    </span>
                    <span class="text-amber-400 font-bold">57% Total Cadence Completed</span>
                </div>

                <div class="w-full bg-neutral-900/90 rounded-full h-2.5 p-0.5 overflow-hidden border border-white/5">
                    <div class="bg-gradient-to-r from-amber-600 via-amber-400 to-emerald-400 h-1.5 rounded-full transition-all duration-1000 shadow-[0_0_12px_rgba(245,158,11,0.5)]" style="width: 57%"></div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-2 mt-4 text-[11px] font-mono-code">
                    <div class="text-emerald-400 flex items-center gap-1.5">&check; 1. Discovery</div>
                    <div class="text-emerald-400 flex items-center gap-1.5">&check; 2. Strategy</div>
                    <div class="text-emerald-400 flex items-center gap-1.5">&check; 3. Moodboard</div>
                    <div class="text-amber-400 font-bold flex items-center gap-1.5">&bull; 4. Identity (Now)</div>
                    <div class="text-neutral-500 flex items-center gap-1.5">&bull; 5. 3D Render</div>
                    <div class="text-neutral-500 flex items-center gap-1.5">&bull; 6. Guidelines</div>
                    <div class="text-neutral-500 flex items-center gap-1.5">&bull; 7. Global Launch</div>
                </div>
            </div>
        </div>

        <!-- Navigation Tabs Bar -->
        <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-8 border-b border-white/5">
            <button @click="activeTab = 'deliverables'" :class="activeTab === 'deliverables' ? 'bg-amber-500 text-black font-bold shadow-lg shadow-amber-500/20' : 'glass-panel text-neutral-300 hover:text-white'" class="px-5 py-2.5 rounded-xl text-xs font-semibold uppercase tracking-wider transition-all shrink-0 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Deliverables & Proofing
                <span class="px-1.5 py-0.5 rounded-full text-[10px] bg-black/20 text-black">1 Pending</span>
            </button>

            <button @click="activeTab = 'stages'" :class="activeTab === 'stages' ? 'bg-amber-500 text-black font-bold shadow-lg shadow-amber-500/20' : 'glass-panel text-neutral-300 hover:text-white'" class="px-5 py-2.5 rounded-xl text-xs font-semibold uppercase tracking-wider transition-all shrink-0 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                Delivery Roadmap
            </button>

            <button @click="activeTab = 'financials'" :class="activeTab === 'financials' ? 'bg-amber-500 text-black font-bold shadow-lg shadow-amber-500/20' : 'glass-panel text-neutral-300 hover:text-white'" class="px-5 py-2.5 rounded-xl text-xs font-semibold uppercase tracking-wider transition-all shrink-0 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Financials & SOW
            </button>

            <button @click="activeTab = 'scope_assistant'" :class="activeTab === 'scope_assistant' ? 'bg-amber-500 text-black font-bold shadow-lg shadow-amber-500/20' : 'glass-panel text-neutral-300 hover:text-white'" class="px-5 py-2.5 rounded-xl text-xs font-semibold uppercase tracking-wider transition-all shrink-0 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                AI Scope Assistant
            </button>

            <button @click="activeTab = 'brand_vault'" :class="activeTab === 'brand_vault' ? 'bg-amber-500 text-black font-bold shadow-lg shadow-amber-500/20' : 'glass-panel text-neutral-300 hover:text-white'" class="px-5 py-2.5 rounded-xl text-xs font-semibold uppercase tracking-wider transition-all shrink-0 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                Brand Asset Vault
            </button>
        </div>

        <!-- ========================================== -->
        <!-- TAB 1: DELIVERABLES & PROOFING STUDIO -->
        <!-- ========================================== -->
        <div x-show="activeTab === 'deliverables'" class="space-y-8" style="display: block;">

            <!-- Proofing Canvas & Sign-Off Station -->
            <div class="glass-panel rounded-3xl p-6 md:p-8 relative">
                
                <!-- Proofing Header -->
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-white/5">
                    <div>
                        <div class="flex items-center gap-2 text-xs font-mono-code text-amber-400 uppercase">
                            <span>Stage 4 Deliverable</span>
                            <span>&bull;</span>
                            <span class="text-emerald-400">Ready for Client Decision</span>
                        </div>
                        <h2 class="font-heading text-2xl font-black text-white mt-1">
                            Horizon EV Core Identity Deck & Bespoke Emblem
                        </h2>
                    </div>

                    <!-- Version Switcher & View Mode -->
                    <div class="flex flex-wrap items-center gap-3">
                        <div class="bg-neutral-900 p-1 rounded-xl border border-white/10 flex items-center text-xs font-mono-code">
                            <button @click="selectedVersion = 'v1.2'" :class="selectedVersion === 'v1.2' ? 'bg-amber-500 text-black font-bold' : 'text-neutral-400 hover:text-white'" class="px-3 py-1.5 rounded-lg transition-all">
                                V1.2 (Latest)
                            </button>
                            <button @click="selectedVersion = 'v1.1'" :class="selectedVersion === 'v1.1' ? 'bg-amber-500 text-black font-bold' : 'text-neutral-400 hover:text-white'" class="px-3 py-1.5 rounded-lg transition-all">
                                V1.1
                            </button>
                            <button @click="selectedVersion = 'v1.0'" :class="selectedVersion === 'v1.0' ? 'bg-amber-500 text-black font-bold' : 'text-neutral-400 hover:text-white'" class="px-3 py-1.5 rounded-lg transition-all">
                                V1.0
                            </button>
                        </div>

                        <div class="bg-neutral-900 p-1 rounded-xl border border-white/10 flex items-center text-xs font-mono-code">
                            <button @click="proofViewMode = 'mockup'" :class="proofViewMode === 'mockup' ? 'bg-white/15 text-white font-bold' : 'text-neutral-400'" class="px-3 py-1.5 rounded-lg transition-all">
                                3D Vehicle Render
                            </button>
                            <button @click="proofViewMode = 'vector'" :class="proofViewMode === 'vector' ? 'bg-white/15 text-white font-bold' : 'text-neutral-400'" class="px-3 py-1.5 rounded-lg transition-all">
                                Monogram Spec
                            </button>
                            <button @click="proofViewMode = 'colors'" :class="proofViewMode === 'colors' ? 'bg-white/15 text-white font-bold' : 'text-neutral-400'" class="px-3 py-1.5 rounded-lg transition-all">
                                Palette & Grid
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Proof Canvas Area -->
                <div class="mt-6 rounded-2xl bg-black border border-white/10 overflow-hidden relative group">

                    <!-- Mode 1: Photorealistic Mockup -->
                    <div x-show="proofViewMode === 'mockup'" class="relative">
                        <img src="https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=1600&q=85" alt="Emblem on Vehicle" class="w-full h-[520px] object-cover opacity-90 transition-opacity">
                        
                        <!-- Hotspot 1 -->
                        <div class="absolute top-[42%] left-[48%] -translate-x-1/2 -translate-y-1/2 cursor-pointer" @click="hotspotActive = hotspotActive === 1 ? null : 1">
                            <span class="relative flex h-7 w-7">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-7 w-7 bg-amber-500 text-black font-black text-xs items-center justify-center border-2 border-black">1</span>
                            </span>
                            
                            <div x-show="hotspotActive === 1" @click.outside="hotspotActive = null" class="absolute left-8 top-0 w-64 glass-panel p-4 rounded-xl z-20 text-xs shadow-2xl border border-amber-500/40">
                                <span class="font-mono-code text-[10px] text-amber-400 uppercase font-bold">Annotation Pin #1</span>
                                <p class="text-white font-semibold mt-1">Aerodynamic Grille Emblem</p>
                                <p class="text-neutral-400 text-[11px] mt-1">Brushed anodized titanium finish with laser-etched edge chamfering.</p>
                                <span class="inline-block mt-2 px-2 py-0.5 rounded text-[10px] bg-emerald-500/20 text-emerald-400 font-mono-code">&check; Lead Designer Approved</span>
                            </div>
                        </div>

                        <!-- Hotspot 2 -->
                        <div class="absolute top-[28%] left-[72%] -translate-x-1/2 -translate-y-1/2 cursor-pointer" @click="hotspotActive = hotspotActive === 2 ? null : 2">
                            <span class="relative flex h-7 w-7">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-7 w-7 bg-amber-500 text-black font-black text-xs items-center justify-center border-2 border-black">2</span>
                            </span>

                            <div x-show="hotspotActive === 2" @click.outside="hotspotActive = null" class="absolute right-8 top-0 w-64 glass-panel p-4 rounded-xl z-20 text-xs shadow-2xl border border-amber-500/40">
                                <span class="font-mono-code text-[10px] text-amber-400 uppercase font-bold">Annotation Pin #2</span>
                                <p class="text-white font-semibold mt-1">Night-Mode Optical Glow</p>
                                <p class="text-neutral-400 text-[11px] mt-1">4500K soft amber LED back-illumination calibrated for international road regulations.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Mode 2: Vector Geometry -->
                    <div x-show="proofViewMode === 'vector'" class="h-[520px] flex items-center justify-center p-12 bg-neutral-950 relative" style="display: none;">
                        <div class="text-center space-y-6">
                            <div class="w-48 h-48 mx-auto border-2 border-dashed border-amber-500/40 rounded-3xl p-8 flex items-center justify-center relative">
                                <span class="text-6xl font-heading font-black text-amber-400 tracking-tighter">H&bull;E</span>
                                <div class="absolute -top-3 left-4 px-2 bg-neutral-950 text-[10px] font-mono-code text-amber-400">OPTICAL SAFE-ZONE (2.5x)</div>
                            </div>
                            <div>
                                <h3 class="font-heading text-xl font-bold text-white">Bespoke Monogram Optical Construction</h3>
                                <p class="text-xs font-mono-code text-neutral-400 mt-1">Geometrically aligned to 16.18&deg; Golden Ratio aerodynamic vector curves.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Mode 3: Brand Palette & Tokens -->
                    <div x-show="proofViewMode === 'colors'" class="h-[520px] p-12 flex flex-col justify-center bg-neutral-950" style="display: none;">
                        <h3 class="font-heading text-2xl font-black text-white mb-6 text-center">Calibrated Brand Chromatics</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-3xl mx-auto w-full">
                            <div @click="copyToClipboard('#060608')" class="p-5 rounded-2xl bg-[#060608] border border-white/20 cursor-pointer hover:border-amber-400 transition-all text-center">
                                <div class="h-16 rounded-xl bg-[#060608] border border-white/10 mb-3"></div>
                                <span class="font-mono-code text-xs text-white block">Obsidian Black</span>
                                <span class="font-mono-code text-[11px] text-neutral-400">#060608</span>
                            </div>

                            <div @click="copyToClipboard('#F59E0B')" class="p-5 rounded-2xl bg-neutral-900 border border-white/10 cursor-pointer hover:border-amber-400 transition-all text-center">
                                <div class="h-16 rounded-xl bg-amber-500 mb-3 shadow-[0_0_15px_rgba(245,158,11,0.4)]"></div>
                                <span class="font-mono-code text-xs text-white block">Kinetic Amber</span>
                                <span class="font-mono-code text-[11px] text-amber-400">#F59E0B</span>
                            </div>

                            <div @click="copyToClipboard('#ECECEC')" class="p-5 rounded-2xl bg-neutral-900 border border-white/10 cursor-pointer hover:border-amber-400 transition-all text-center">
                                <div class="h-16 rounded-xl bg-[#ECECEC] mb-3"></div>
                                <span class="font-mono-code text-xs text-white block">Nordic Platinum</span>
                                <span class="font-mono-code text-[11px] text-neutral-400">#ECECEC</span>
                            </div>

                            <div @click="copyToClipboard('#10B981')" class="p-5 rounded-2xl bg-neutral-900 border border-white/10 cursor-pointer hover:border-amber-400 transition-all text-center">
                                <div class="h-16 rounded-xl bg-emerald-500 mb-3 shadow-[0_0_15px_rgba(16,185,129,0.4)]"></div>
                                <span class="font-mono-code text-xs text-white block">Bio-Electric Green</span>
                                <span class="font-mono-code text-[11px] text-emerald-400">#10B981</span>
                            </div>
                        </div>
                        <p class="text-center text-xs font-mono-code text-neutral-500 mt-6" x-text="copiedHex ? 'Copied ' + copiedHex + ' to clipboard!' : 'Click any swatch to copy HEX color token'"></p>
                    </div>

                    <!-- Canvas Bottom Control Bar -->
                    <div class="p-4 bg-neutral-900/90 border-t border-white/10 flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center gap-3 text-xs text-neutral-400 font-mono-code">
                            <span class="flex items-center gap-1.5 text-amber-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                2 Annotation Pins on Canvas
                            </span>
                            <span>&bull;</span>
                            <span>Revision Round: 1 of 3 Included</span>
                        </div>

                        <div class="flex items-center gap-3">
                            <a href="#" class="px-4 py-2 rounded-xl bg-neutral-800 hover:bg-neutral-700 text-xs font-mono-code text-white transition-colors flex items-center gap-2">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                Raw PDF Export (42MB)
                            </a>

                            <button @click="revisionModalOpen = true" class="px-5 py-2 rounded-xl bg-neutral-800 hover:bg-neutral-700 text-xs font-semibold text-neutral-200 border border-white/10 transition-colors">
                                Request Revisions
                            </button>

                            <button @click="approvalModalOpen = true" class="px-6 py-2 rounded-xl bg-amber-500 hover:bg-amber-400 text-xs font-bold text-black transition-all shadow-lg shadow-amber-500/20 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Approve & Sign-Off &rarr;
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Client Review Timeline & Audit Card -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="glass-panel p-6 rounded-2xl border border-white/5">
                    <span class="text-[10px] font-mono-code uppercase text-neutral-400 tracking-wider">Contractual Terms</span>
                    <h4 class="font-heading font-bold text-white text-base mt-1">IP & Rights Assignment</h4>
                    <p class="text-xs text-neutral-400 mt-2 leading-relaxed">Upon final milestone clearance, full worldwide perpetual trademark and industrial copyright transfers directly to Horizon Luxury EV Inc.</p>
                </div>

                <div class="glass-panel p-6 rounded-2xl border border-white/5">
                    <span class="text-[10px] font-mono-code uppercase text-neutral-400 tracking-wider">Next In Sequence</span>
                    <h4 class="font-heading font-bold text-white text-base mt-1">Stage 5: 3D Visualization</h4>
                    <p class="text-xs text-neutral-400 mt-2 leading-relaxed">Immediately upon Stage 4 sign-off, RenderCraft 3D Studio initializes photorealistic environment raytracing and lighting passes.</p>
                </div>

                <div class="glass-panel p-6 rounded-2xl border border-white/5">
                    <span class="text-[10px] font-mono-code uppercase text-neutral-400 tracking-wider">Support Liaison</span>
                    <h4 class="font-heading font-bold text-white text-base mt-1">Direct Director Line</h4>
                    <p class="text-xs text-neutral-400 mt-2 leading-relaxed">Marcus Sterling (Senior Project Director) is on call for strategic consultation and live design review sessions.</p>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- TAB 2: DELIVERY ROADMAP & STAGES -->
        <!-- ========================================== -->
        <div x-show="activeTab === 'stages'" class="space-y-6" style="display: none;">
            <div class="glass-panel rounded-3xl p-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                    <div>
                        <span class="text-xs font-mono-code text-amber-400 uppercase">Stage Governance</span>
                        <h2 class="font-heading text-2xl font-black text-white mt-1">Comprehensive 7-Stage Delivery Cadence</h2>
                    </div>
                    <span class="px-3 py-1.5 rounded-xl text-xs font-mono-code bg-white/5 border border-white/10 text-neutral-300">
                        Methodology: IDENTIFY &bull; CREATE &bull; COMMUNICATE
                    </span>
                </div>

                <div class="space-y-4">
                    <!-- Stage 1 -->
                    <div class="p-5 rounded-2xl bg-neutral-900/60 border border-emerald-500/30 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-start gap-4">
                            <span class="w-8 h-8 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold text-sm shrink-0">&check;</span>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h4 class="font-heading font-bold text-white text-base">Stage 1: Discovery & Brand Audit</h4>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-mono-code bg-emerald-500/10 text-emerald-400">COMPLETED</span>
                                </div>
                                <p class="text-xs text-neutral-400 mt-1">Competitor benchmarking, consumer perception matrix, and stakeholder interviews.</p>
                            </div>
                        </div>
                        <div class="text-right text-xs font-mono-code text-neutral-400">
                            <div>Signed off on Aug 15</div>
                            <span class="text-emerald-400">Formal Report Delivered</span>
                        </div>
                    </div>

                    <!-- Stage 2 -->
                    <div class="p-5 rounded-2xl bg-neutral-900/60 border border-emerald-500/30 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-start gap-4">
                            <span class="w-8 h-8 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold text-sm shrink-0">&check;</span>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h4 class="font-heading font-bold text-white text-base">Stage 2: Brand Strategy & Positioning</h4>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-mono-code bg-emerald-500/10 text-emerald-400">COMPLETED</span>
                                </div>
                                <p class="text-xs text-neutral-400 mt-1">Brand architecture, luxury value proposition, tone of voice, and taglines.</p>
                            </div>
                        </div>
                        <div class="text-right text-xs font-mono-code text-neutral-400">
                            <div>Signed off on Aug 30</div>
                            <span class="text-emerald-400">Strategy Deck Approved</span>
                        </div>
                    </div>

                    <!-- Stage 3 -->
                    <div class="p-5 rounded-2xl bg-neutral-900/60 border border-emerald-500/30 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-start gap-4">
                            <span class="w-8 h-8 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold text-sm shrink-0">&check;</span>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h4 class="font-heading font-bold text-white text-base">Stage 3: Moodboards & Visual Direction</h4>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-mono-code bg-emerald-500/10 text-emerald-400">COMPLETED</span>
                                </div>
                                <p class="text-xs text-neutral-400 mt-1">Art direction explorations, tactile finish curation, and aerodynamic colorways.</p>
                            </div>
                        </div>
                        <div class="text-right text-xs font-mono-code text-neutral-400">
                            <div>Signed off on Sep 15</div>
                            <span class="text-emerald-400">Moodboard V2 Approved</span>
                        </div>
                    </div>

                    <!-- Stage 4 (Active) -->
                    <div class="p-6 rounded-2xl glass-panel-amber border-2 border-amber-500/60 flex flex-col md:flex-row md:items-center justify-between gap-4 relative overflow-hidden">
                        <div class="flex items-start gap-4">
                            <span class="w-8 h-8 rounded-full bg-amber-500 text-black flex items-center justify-center font-black text-sm shrink-0">4</span>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h4 class="font-heading font-bold text-amber-300 text-lg">Stage 4: Logo & Identity System</h4>
                                    <span class="px-2.5 py-0.5 rounded text-[10px] font-mono-code font-bold bg-amber-500/20 text-amber-300 animate-pulse">ACTIVE SPRINT</span>
                                </div>
                                <p class="text-xs text-neutral-300 mt-1">Primary monogram, responsive vehicle badging, typography matrix, and color tokens.</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <button @click="approvalModalOpen = true" class="px-4 py-2 rounded-xl bg-amber-500 hover:bg-amber-400 text-black text-xs font-bold transition-all shadow-md shadow-amber-500/20">
                                Sign-Off Stage &rarr;
                            </button>
                        </div>
                    </div>

                    <!-- Stage 5 -->
                    <div class="p-5 rounded-2xl bg-neutral-950/60 border border-white/5 flex flex-col md:flex-row md:items-center justify-between gap-4 text-neutral-500">
                        <div class="flex items-start gap-4">
                            <span class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center font-mono-code text-sm shrink-0">5</span>
                            <div>
                                <h4 class="font-heading font-bold text-neutral-300 text-base">Stage 5: 3D Concept Visualization & CGI</h4>
                                <p class="text-xs text-neutral-500 mt-1">Photorealistic vehicle lighting studies, motion badges, and chassis animations.</p>
                            </div>
                        </div>
                        <div class="text-xs font-mono-code text-neutral-500">
                            Locked &bull; Begins immediately upon Stage 4 sign-off
                        </div>
                    </div>

                    <!-- Stage 6 -->
                    <div class="p-5 rounded-2xl bg-neutral-950/60 border border-white/5 flex flex-col md:flex-row md:items-center justify-between gap-4 text-neutral-500">
                        <div class="flex items-start gap-4">
                            <span class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center font-mono-code text-sm shrink-0">6</span>
                            <div>
                                <h4 class="font-heading font-bold text-neutral-300 text-base">Stage 6: Brand Guidelines & Collateral System</h4>
                                <p class="text-xs text-neutral-500 mt-1">Digital brand book, environmental signage dielines, UI vehicle dashboard kit.</p>
                            </div>
                        </div>
                        <div class="text-xs font-mono-code text-neutral-500">
                            Locked &bull; Scheduled for November
                        </div>
                    </div>

                    <!-- Stage 7 -->
                    <div class="p-5 rounded-2xl bg-neutral-950/60 border border-white/5 flex flex-col md:flex-row md:items-center justify-between gap-4 text-neutral-500">
                        <div class="flex items-start gap-4">
                            <span class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center font-mono-code text-sm shrink-0">7</span>
                            <div>
                                <h4 class="font-heading font-bold text-neutral-300 text-base">Stage 7: Global Launch Campaign Strategy</h4>
                                <p class="text-xs text-neutral-500 mt-1">Worldwide media activations, keynote presentation deck, and teaser social assets.</p>
                            </div>
                        </div>
                        <div class="text-xs font-mono-code text-neutral-500">
                            Locked &bull; Final Delivery Gate
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- TAB 3: FINANCIAL LEDGER & SOW -->
        <!-- ========================================== -->
        <div x-show="activeTab === 'financials'" class="space-y-8" style="display: none;">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Left 2 Cols: Invoices & Breakdown -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="glass-panel rounded-3xl p-8">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <span class="text-xs font-mono-code text-amber-400 uppercase">Billing History</span>
                                <h2 class="font-heading text-2xl font-black text-white mt-1">Invoices & Statements</h2>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-mono-code bg-emerald-500/15 text-emerald-400 border border-emerald-500/30">
                                In Good Standing
                            </span>
                        </div>

                        <div class="space-y-4">
                            <!-- Invoice 1 -->
                            <div class="p-6 rounded-2xl bg-black/50 border border-white/10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2">
                                        <span class="font-mono-code text-sm font-bold text-white">INV-2026-001</span>
                                        <span class="px-2 py-0.5 rounded text-[10px] font-mono-code font-bold bg-emerald-500/20 text-emerald-400 border border-emerald-500/40">
                                            SETTLED / PAID
                                        </span>
                                    </div>
                                    <h4 class="text-sm font-semibold text-neutral-300">50% Initial SOW Deposit (Brand Strategy & Discovery)</h4>
                                    <span class="text-xs text-neutral-500 font-mono-code block">Issued Aug 10, 2026 &bull; Paid via Wire Transfer (JPMorgan Chase)</span>
                                </div>

                                <div class="text-right">
                                    <div class="font-heading text-2xl font-black text-white">$47,500.00</div>
                                    <a href="#" class="text-xs font-mono-code text-amber-400 underline hover:text-amber-300 mt-1 inline-block">
                                        Download Official PDF
                                    </a>
                                </div>
                            </div>

                            <!-- Invoice 2 (Upcoming Milestone) -->
                            <div class="p-6 rounded-2xl bg-black/50 border border-amber-500/30 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2">
                                        <span class="font-mono-code text-sm font-bold text-amber-300">INV-2026-002</span>
                                        <span class="px-2 py-0.5 rounded text-[10px] font-mono-code font-bold bg-amber-500/20 text-amber-300 border border-amber-500/40">
                                            UPCOMING MILESTONE
                                        </span>
                                    </div>
                                    <h4 class="text-sm font-semibold text-neutral-300">25% Milestone 2 (Logo & Identity Sign-Off)</h4>
                                    <span class="text-xs text-neutral-500 font-mono-code block">Payable upon formal Stage 4 approval</span>
                                </div>

                                <div class="text-right">
                                    <div class="font-heading text-2xl font-black text-amber-400">$23,750.00</div>
                                    <button @click="paymentModalOpen = true" class="mt-2 px-4 py-1.5 rounded-lg bg-amber-500 hover:bg-amber-400 text-black text-xs font-bold font-mono-code transition-all">
                                        Authorize Early Payment &rarr;
                                    </button>
                                </div>
                            </div>

                            <!-- Invoice 3 (Final Milestone) -->
                            <div class="p-6 rounded-2xl bg-neutral-950/40 border border-white/5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 text-neutral-500">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2">
                                        <span class="font-mono-code text-sm">INV-2026-003</span>
                                        <span class="px-2 py-0.5 rounded text-[10px] font-mono-code bg-white/5 text-neutral-500">
                                            FINAL RELEASE (25%)
                                        </span>
                                    </div>
                                    <h4 class="text-sm">Final Project Release & IP Transfer</h4>
                                    <span class="text-xs text-neutral-600 font-mono-code block">Payable upon Stage 7 final handoff</span>
                                </div>

                                <div class="text-right">
                                    <div class="font-heading text-2xl font-bold text-neutral-400">$23,750.00</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Col: SOW Summary -->
                <div class="space-y-6">
                    <div class="glass-panel rounded-3xl p-8 border-t-2 border-t-amber-500">
                        <span class="text-xs font-mono-code text-amber-400 uppercase">Contract Summary</span>
                        <h3 class="font-heading text-xl font-bold text-white mt-1 mb-6">Financial Ledger</h3>

                        <div class="space-y-3 font-mono-code text-xs">
                            <div class="flex justify-between py-2 border-b border-white/5">
                                <span class="text-neutral-400">Total Agreed SOW:</span>
                                <span class="text-white font-bold">$95,000.00</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-white/5">
                                <span class="text-neutral-400">Settled to Date:</span>
                                <span class="text-emerald-400 font-bold">$47,500.00</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-white/5">
                                <span class="text-neutral-400">Remaining Balance:</span>
                                <span class="text-amber-400 font-bold">$47,500.00</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-white/5">
                                <span class="text-neutral-400">Currency:</span>
                                <span class="text-white">USD ($)</span>
                            </div>
                            <div class="flex justify-between py-2">
                                <span class="text-neutral-400">VAT Registration:</span>
                                <span class="text-white">{{ $project->client->vat_number ?? 'US-983421098' }}</span>
                            </div>
                        </div>

                        <div class="mt-6 p-4 rounded-xl bg-amber-500/10 border border-amber-500/20 text-xs text-neutral-300">
                            <strong>Direct Wire Details:</strong><br>
                            Bank: JPMorgan Chase NA (New York)<br>
                            SWIFT/BIC: CHASUS33XXX<br>
                            Beneficiary: AgencyFlow Creative Operating Corp
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- TAB 4: AI SCOPE & CHANGE ORDER ASSISTANT -->
        <!-- ========================================== -->
        <div x-show="activeTab === 'scope_assistant'" class="space-y-8" style="display: none;">
            <div class="glass-panel rounded-3xl p-8 md:p-12 border border-amber-500/30 relative overflow-hidden">
                <div class="absolute -right-20 -top-20 w-80 h-80 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>

                <div class="max-w-2xl">
                    <span class="text-xs font-mono-code text-amber-400 uppercase">Autonomous Intelligence Engine</span>
                    <h2 class="font-heading text-3xl font-black text-white mt-1">Real-Time Scope Add-On Estimator</h2>
                    <p class="text-sm text-neutral-400 mt-2">
                        Need additional deliverables, extra packaging variants, or an expedited launch teaser? Configure specifications below for an instant machine-calculated change order estimate.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                    <div>
                        <label class="block text-xs font-mono-code text-neutral-400 uppercase mb-2">Requested Deliverable</label>
                        <select x-model="scopeDeliverable" class="w-full bg-neutral-900 border border-white/10 rounded-xl p-3.5 text-sm text-white focus:border-amber-500 focus:outline-none">
                            <option value="3d_animation">3D Vehicle Reveal Film (15s Motion CGI)</option>
                            <option value="packaging_sku">Secondary Packaging Dieline & Foil Study</option>
                            <option value="social_suite">Omnichannel Social Advertising Launch Kit</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-mono-code text-neutral-400 uppercase mb-2">Revision Allocations</label>
                        <select x-model="scopeRounds" class="w-full bg-neutral-900 border border-white/10 rounded-xl p-3.5 text-sm text-white focus:border-amber-500 focus:outline-none">
                            <option value="2">2 Creative Revision Iterations (Standard)</option>
                            <option value="4">4 Creative Revision Iterations (Comprehensive)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-mono-code text-neutral-400 uppercase mb-2">Turnaround Speed</label>
                        <select x-model="scopeTimeline" class="w-full bg-neutral-900 border border-white/10 rounded-xl p-3.5 text-sm text-white focus:border-amber-500 focus:outline-none">
                            <option value="express">Express Delivery (7 Business Days)</option>
                            <option value="standard">Synchronized with Stage 5 Roadmap</option>
                        </select>
                    </div>
                </div>

                <div class="mt-8 p-6 rounded-2xl bg-black/60 border border-white/10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <span class="text-xs font-mono-code text-neutral-400 uppercase">Estimated Scope Addition</span>
                        <div class="font-heading text-4xl font-black text-amber-400 mt-1">
                            $<span x-text="calculateScopeAddon().toLocaleString()"></span> <span class="text-xs text-neutral-400 font-mono-code">USD</span>
                        </div>
                        <span class="text-xs text-neutral-500 font-mono-code">Includes creative director oversight, studio rendering time, and license transfer.</span>
                    </div>

                    <button @click="alert('Change order drafted! Marcus Sterling will formalize this addendum within 2 business hours.');" class="px-6 py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-black font-bold text-xs uppercase tracking-wider transition-all shadow-md shadow-amber-500/20">
                        Generate Scope Change Order &rarr;
                    </button>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- TAB 5: BRAND ASSET VAULT -->
        <!-- ========================================== -->
        <div x-show="activeTab === 'brand_vault'" class="space-y-6" style="display: none;">
            <div class="glass-panel rounded-3xl p-8">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <span class="text-xs font-mono-code text-amber-400 uppercase">Master Assets Repository</span>
                        <h2 class="font-heading text-2xl font-black text-white mt-1">Approved Brand Asset Vault</h2>
                    </div>
                    <button class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-xs font-mono-code text-white transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Download Master Zip (1.2GB)
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Asset 1 -->
                    <div class="p-6 rounded-2xl bg-neutral-900/60 border border-white/5 flex flex-col justify-between h-48 group hover:border-amber-400/40 transition-all">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[10px] font-mono-code px-2 py-0.5 rounded bg-white/10 text-white uppercase">SVG &bull; EPS &bull; PNG</span>
                                <span class="text-emerald-400 text-xs font-mono-code">&check; Approved</span>
                            </div>
                            <h4 class="font-heading font-bold text-white text-base">Primary Monogram Lockup</h4>
                            <p class="text-xs text-neutral-400 mt-1">High-contrast vector formats for dark and light application.</p>
                        </div>
                        <a href="#" class="text-xs font-mono-code text-amber-400 hover:text-amber-300 flex items-center gap-1.5">
                            Download Package (18MB) &rarr;
                        </a>
                    </div>

                    <!-- Asset 2 -->
                    <div class="p-6 rounded-2xl bg-neutral-900/60 border border-white/5 flex flex-col justify-between h-48 group hover:border-amber-400/40 transition-all">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[10px] font-mono-code px-2 py-0.5 rounded bg-white/10 text-white uppercase">PDF &bull; INDD</span>
                                <span class="text-emerald-400 text-xs font-mono-code">&check; Approved</span>
                            </div>
                            <h4 class="font-heading font-bold text-white text-base">Brand Strategy & Positioning Book</h4>
                            <p class="text-xs text-neutral-400 mt-1">Stage 2 ratified corporate strategy, narrative, and linguistic guidelines.</p>
                        </div>
                        <a href="#" class="text-xs font-mono-code text-amber-400 hover:text-amber-300 flex items-center gap-1.5">
                            Download PDF (34MB) &rarr;
                        </a>
                    </div>

                    <!-- Asset 3 -->
                    <div class="p-6 rounded-2xl bg-neutral-900/60 border border-white/5 flex flex-col justify-between h-48 group hover:border-amber-400/40 transition-all">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[10px] font-mono-code px-2 py-0.5 rounded bg-amber-500/20 text-amber-300 uppercase">3D OBJ &bull; FBX</span>
                                <span class="text-amber-400 text-xs font-mono-code">&bull; Draft V1.2</span>
                            </div>
                            <h4 class="font-heading font-bold text-white text-base">Front Grille Badge 3D Mesh</h4>
                            <p class="text-xs text-neutral-400 mt-1">Subdivision-ready CAD geometry for automotive manufacturing prototyping.</p>
                        </div>
                        <a href="#" class="text-xs font-mono-code text-amber-400 hover:text-amber-300 flex items-center gap-1.5">
                            Download CAD Files (88MB) &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- ========================================== -->
    <!-- MODAL 1: FORMAL CRYPTOGRAPHIC SIGN-OFF -->
    <!-- ========================================== -->
    <div x-show="approvalModalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/85 backdrop-blur-xl" style="display: none;">
        <div class="glass-panel max-w-xl w-full p-8 md:p-10 rounded-3xl border border-amber-500/40 relative shadow-2xl" @click.outside="if(!signatureSuccess) approvalModalOpen = false">
            
            <div x-show="!signatureSuccess">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-mono-code text-amber-400 uppercase font-bold tracking-wider">Formal Sign-Off Station</span>
                    <button @click="approvalModalOpen = false" class="text-neutral-400 hover:text-white">&times;</button>
                </div>

                <h3 class="font-heading text-2xl font-black text-white">Cryptographic Deliverable Acceptance</h3>
                <p class="text-xs text-neutral-400 mt-2 leading-relaxed">
                    By submitting this digital sign-off, you confirm client approval of <strong class="text-amber-300">Horizon EV Core Identity Deck (V1.2)</strong>. This action certifies completion of Stage 4 and authorizes progression to Stage 5 (3D Concept Visualization).
                </p>

                <div class="space-y-4 my-6">
                    <div>
                        <label class="block text-xs font-mono-code text-neutral-400 uppercase mb-1.5">Authorized Signatory Name</label>
                        <input type="text" x-model="signatoryName" class="w-full bg-neutral-900 border border-white/10 rounded-xl p-3 text-sm text-white font-medium focus:border-amber-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-mono-code text-neutral-400 uppercase mb-1.5">Corporate Title</label>
                        <input type="text" x-model="signatoryTitle" class="w-full bg-neutral-900 border border-white/10 rounded-xl p-3 text-sm text-white font-medium focus:border-amber-500 focus:outline-none">
                    </div>

                    <div class="p-3.5 rounded-xl bg-black/50 border border-white/5 font-mono-code text-[11px] text-neutral-400">
                        <span class="text-neutral-500 block mb-1">Generated Cryptographic Audit Stamp:</span>
                        <code class="text-amber-400 font-bold" x-text="signatureHash"></code>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-white/10">
                    <button @click="approvalModalOpen = false" class="px-5 py-2.5 rounded-xl bg-neutral-900 text-xs font-mono-code text-neutral-400 hover:text-white">
                        Cancel
                    </button>
                    <button @click="signAndApprove()" class="px-6 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-black text-xs font-bold uppercase tracking-wider transition-all shadow-lg shadow-amber-500/20">
                        Authorize Digital Sign-Off &rarr;
                    </button>
                </div>
            </div>

            <!-- Approval Success Celebration State -->
            <div x-show="signatureSuccess" class="text-center py-8 space-y-4">
                <div class="w-16 h-16 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-3xl font-black mx-auto border-2 border-emerald-500/40 animate-bounce">
                    &check;
                </div>
                <h3 class="font-heading text-2xl font-black text-white">Stage 4 Formally Approved!</h3>
                <p class="text-xs text-neutral-400 max-w-md mx-auto">
                    Digital approval certified and recorded in the AgencyFlow immutability ledger. Stage 5 has officially unlocked in the project operations queue.
                </p>
                <div class="inline-block px-4 py-1.5 rounded-full bg-neutral-900 font-mono-code text-xs text-amber-400 border border-amber-500/30">
                    Receipt Hash: SHA-256 Validated
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- MODAL 2: REQUEST REVISIONS -->
    <!-- ========================================== -->
    <div x-show="revisionModalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/85 backdrop-blur-xl" style="display: none;">
        <div class="glass-panel max-w-xl w-full p-8 md:p-10 rounded-3xl border border-white/20 relative shadow-2xl" @click.outside="revisionModalOpen = false">
            <div x-show="!revisionSubmitted">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-mono-code text-amber-400 uppercase font-bold tracking-wider">Design Review Station</span>
                    <button @click="revisionModalOpen = false" class="text-neutral-400 hover:text-white">&times;</button>
                </div>

                <h3 class="font-heading text-2xl font-black text-white">Request Deliverable Adjustments</h3>
                <p class="text-xs text-neutral-400 mt-2">
                    Submit precision feedback directly to the lead brand designer and project director.
                </p>

                <div class="space-y-4 my-6">
                    <div>
                        <label class="block text-xs font-mono-code text-neutral-400 uppercase mb-1.5">Adjustment Area</label>
                        <select x-model="revisionCategory" class="w-full bg-neutral-900 border border-white/10 rounded-xl p-3 text-sm text-white focus:border-amber-500 focus:outline-none">
                            <option value="typography">Typography & Kerning Calibration</option>
                            <option value="chromatics">Color Saturation & Night Mode Contrast</option>
                            <option value="scale">Emblem Proportions & Vehicle Dieline</option>
                            <option value="other">General Creative Direction</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-mono-code text-neutral-400 uppercase mb-1.5">Feedback & Detailed Notes</label>
                        <textarea x-model="revisionFeedback" rows="4" placeholder="Describe the specific adjustments required for V1.3..." class="w-full bg-neutral-900 border border-white/10 rounded-xl p-3 text-sm text-white focus:border-amber-500 focus:outline-none"></textarea>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-white/10">
                    <button @click="revisionModalOpen = false" class="px-5 py-2.5 rounded-xl bg-neutral-900 text-xs font-mono-code text-neutral-400 hover:text-white">
                        Cancel
                    </button>
                    <button @click="submitRevision()" class="px-6 py-2.5 rounded-xl bg-neutral-200 hover:bg-white text-black text-xs font-bold uppercase tracking-wider transition-all">
                        Transmit Revision Request
                    </button>
                </div>
            </div>

            <div x-show="revisionSubmitted" class="text-center py-8 space-y-3">
                <span class="w-12 h-12 rounded-full bg-blue-500/20 text-blue-400 flex items-center justify-center text-xl font-bold mx-auto">&check;</span>
                <h4 class="font-heading text-xl font-bold text-white">Revision Request Dispatched</h4>
                <p class="text-xs text-neutral-400">Marcus Sterling and Julian Drake have been notified via HQ priority queue.</p>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- MODAL 3: INSTANT PAYMENT AUTHORIZATION -->
    <!-- ========================================== -->
    <div x-show="paymentModalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/85 backdrop-blur-xl" style="display: none;">
        <div class="glass-panel max-w-lg w-full p-8 md:p-10 rounded-3xl border border-amber-500/40 relative shadow-2xl" @click.outside="paymentModalOpen = false">
            <div x-show="!paymentSuccess">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs font-mono-code text-amber-400 uppercase font-bold tracking-wider">Secure Escrow Clearance</span>
                    <button @click="paymentModalOpen = false" class="text-neutral-400 hover:text-white">&times;</button>
                </div>

                <h3 class="font-heading text-2xl font-black text-white">Authorize Milestone Clearance</h3>
                <p class="text-xs text-neutral-400 mt-1">Invoice: <code class="font-mono-code text-white">INV-2026-002</code> &bull; Stage 4 Milestone</p>

                <div class="p-6 rounded-2xl bg-black/60 border border-white/10 my-6 text-center">
                    <span class="text-xs font-mono-code text-neutral-400 uppercase">Amount Due</span>
                    <div class="font-heading text-4xl font-black text-amber-400 mt-1">$23,750.00 <span class="text-xs text-neutral-400 font-mono-code">USD</span></div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-white/10">
                    <button @click="paymentModalOpen = false" class="px-5 py-2.5 rounded-xl bg-neutral-900 text-xs font-mono-code text-neutral-400 hover:text-white">
                        Cancel
                    </button>
                    <button @click="processMockPayment()" class="px-6 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-black text-xs font-bold uppercase tracking-wider transition-all">
                        Confirm Wire Clearance &rarr;
                    </button>
                </div>
            </div>

            <div x-show="paymentSuccess" class="text-center py-8 space-y-3">
                <span class="w-12 h-12 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xl font-bold mx-auto">&check;</span>
                <h4 class="font-heading text-xl font-bold text-white">Payment Authorized & Reconciled!</h4>
                <p class="text-xs text-neutral-400">Receipt generated and registered to Financials & SOW Ledger.</p>
            </div>
        </div>
    </div>

</body>
</html>
