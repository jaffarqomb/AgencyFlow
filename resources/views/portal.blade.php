<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client Portal — AgencyFlow AI ERP</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|syne:700,800" rel="stylesheet" />

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #0b0b0e;
            color: #e5e5e7;
        }
        .font-heading {
            font-family: 'Syne', sans-serif;
        }
        .glass-card {
            background: rgba(18, 18, 24, 0.75);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen pb-16" x-data="{
    approvalModalOpen: false,
    revisionModalOpen: false,
    deliverableTitle: 'Horizon EV Core Identity Deck (V1)',
    clientSignature: 'Charlotte Dubois',
    signatureSuccess: false,
    revisionNotes: '',
    submitApproval() {
        this.signatureSuccess = true;
        setTimeout(() => {
            this.approvalModalOpen = false;
        }, 1500);
    }
}">

    <!-- Top Portal Bar -->
    <header class="glass-card border-b border-white/5 px-6 md:px-12 py-4 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="/" class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-amber-500 shadow-[0_0_10px_#f59e0b]"></span>
                    <span class="font-heading font-extrabold text-white text-lg">AGENCYFLOW</span>
                </a>
                <span class="text-neutral-500 text-sm hidden sm:inline">&bull;</span>
                <span class="text-xs font-mono uppercase bg-amber-500/10 text-amber-400 border border-amber-500/20 px-2.5 py-1 rounded-md">
                    Client Portal &bull; Horizon Luxury EV
                </span>
            </div>

            <div class="flex items-center gap-6">
                <div class="text-right hidden md:block">
                    <div class="text-xs font-semibold text-white">Charlotte Dubois</div>
                    <div class="text-[11px] text-neutral-400">Chief Brand Officer &bull; Horizon EV</div>
                </div>
                <div class="w-9 h-9 rounded-full bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold text-xs border border-amber-500/40">
                    CD
                </div>
                <a href="/admin" class="text-xs text-neutral-400 hover:text-amber-400 font-mono underline ml-2">
                    Switch to ERP Admin
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 md:px-12 pt-10">

        <!-- Client Welcome Ribbon -->
        <div class="glass-card rounded-3xl p-8 mb-8 border-l-4 border-l-amber-500 relative overflow-hidden">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <span class="text-xs font-mono uppercase text-amber-400">Client Workspace</span>
                    <h1 class="font-heading text-2xl md:text-3xl font-extrabold text-white mt-1">
                        Horizon EV Global Brand Identity & Launch
                    </h1>
                    <p class="text-sm text-neutral-400 mt-1">
                        Commission Code: <code class="font-mono text-amber-300">PRJ-2026-001</code> &bull; Project Lead: Marcus Sterling (Senior Project Director)
                    </p>
                </div>

                <div class="flex items-center gap-6">
                    <div class="text-center px-4 py-2 rounded-xl bg-white/5 border border-white/5">
                        <span class="text-[10px] font-mono uppercase text-neutral-400 block">AI Health Score</span>
                        <span class="font-heading text-xl font-bold text-emerald-400">94.5%</span>
                    </div>
                    <div class="text-center px-4 py-2 rounded-xl bg-white/5 border border-white/5">
                        <span class="text-[10px] font-mono uppercase text-neutral-400 block">Current Stage</span>
                        <span class="font-heading text-xl font-bold text-amber-400">Stage 4 / 7</span>
                    </div>
                </div>
            </div>

            <!-- Stage Progress Indicator -->
            <div class="mt-8 pt-6 border-t border-white/5">
                <div class="flex items-center justify-between text-xs font-mono text-neutral-400 mb-2">
                    <span>Stage Cadence: Logo & Identity System</span>
                    <span>57% Completed</span>
                </div>
                <div class="w-full bg-neutral-900 rounded-full h-2 overflow-hidden">
                    <div class="bg-gradient-to-r from-amber-500 to-amber-300 h-2 rounded-full" style="width: 57%"></div>
                </div>
            </div>
        </div>

        <!-- Two Column Workspace: Deliverable Signoff & Financial Milestones -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Deliverable Signoff Center (Col 1 & 2) -->
            <div class="lg:col-span-2 space-y-8">
                <div class="glass-card rounded-3xl p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <span class="text-xs font-mono uppercase text-amber-400">Action Required</span>
                            <h2 class="font-heading text-xl font-bold text-white mt-1">Deliverables for Client Review</h2>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/20 animate-pulse">
                            1 Pending Sign-Off
                        </span>
                    </div>

                    <!-- Deliverable Card -->
                    <div class="bg-black/40 rounded-2xl p-6 border border-white/5">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
                            <div>
                                <h3 class="font-heading font-bold text-lg text-white" x-text="deliverableTitle"></h3>
                                <p class="text-xs text-neutral-400 mt-1">Uploaded by Marcus Sterling &bull; Stage: Logo & Identity System &bull; Version 1.0</p>
                            </div>
                            <span class="px-2.5 py-1 rounded-md text-xs font-mono bg-blue-500/10 text-blue-400 border border-blue-500/20 self-start sm:self-auto">
                                Under Client Review
                            </span>
                        </div>

                        <!-- Image Preview -->
                        <div class="rounded-xl overflow-hidden mb-6 border border-white/10 bg-neutral-950">
                            <img src="https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=1200&q=80" alt="Identity Preview" class="w-full h-64 object-cover">
                        </div>

                        <div class="flex flex-wrap items-center justify-between gap-4 pt-4 border-t border-white/5">
                            <a href="#" class="text-xs text-neutral-400 hover:text-white flex items-center gap-1.5 font-mono">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                Download High-Res Proof (PDF, 42MB)
                            </a>

                            <div class="flex items-center gap-3">
                                <button @click="revisionModalOpen = true" class="px-4 py-2 rounded-xl bg-neutral-900 hover:bg-neutral-800 text-xs text-neutral-300 font-semibold border border-white/10 transition-colors">
                                    Request Revisions
                                </button>
                                <button @click="approvalModalOpen = true" class="px-5 py-2 rounded-xl bg-amber-500 hover:bg-amber-400 text-xs text-black font-semibold transition-all shadow-md shadow-amber-500/20">
                                    Approve & Sign-Off &rarr;
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Complete Project Stages Checklist -->
                <div class="glass-card rounded-3xl p-8">
                    <h2 class="font-heading text-xl font-bold text-white mb-6">Delivery Stage Matrix</h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 rounded-xl bg-white/5 border border-white/5">
                            <div class="flex items-center gap-3">
                                <span class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs font-bold">&check;</span>
                                <div>
                                    <h4 class="text-sm font-semibold text-white">Stage 1: Discovery & Brand Audit</h4>
                                    <span class="text-xs text-neutral-400">Completed on August 15, 2026</span>
                                </div>
                            </div>
                            <span class="text-xs font-mono text-emerald-400">Approved</span>
                        </div>

                        <div class="flex items-center justify-between p-4 rounded-xl bg-white/5 border border-white/5">
                            <div class="flex items-center gap-3">
                                <span class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs font-bold">&check;</span>
                                <div>
                                    <h4 class="text-sm font-semibold text-white">Stage 2: Brand Strategy & Positioning</h4>
                                    <span class="text-xs text-neutral-400">Completed on August 30, 2026</span>
                                </div>
                            </div>
                            <span class="text-xs font-mono text-emerald-400">Approved</span>
                        </div>

                        <div class="flex items-center justify-between p-4 rounded-xl bg-white/5 border border-white/5">
                            <div class="flex items-center gap-3">
                                <span class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs font-bold">&check;</span>
                                <div>
                                    <h4 class="text-sm font-semibold text-white">Stage 3: Moodboards & Visual Direction</h4>
                                    <span class="text-xs text-neutral-400">Completed on September 15, 2026</span>
                                </div>
                            </div>
                            <span class="text-xs font-mono text-emerald-400">Approved</span>
                        </div>

                        <div class="flex items-center justify-between p-4 rounded-xl bg-amber-500/10 border border-amber-500/30">
                            <div class="flex items-center gap-3">
                                <span class="w-6 h-6 rounded-full bg-amber-500/30 text-amber-400 flex items-center justify-center text-xs font-bold">4</span>
                                <div>
                                    <h4 class="text-sm font-semibold text-amber-300">Stage 4: Logo & Identity System</h4>
                                    <span class="text-xs text-neutral-400">In Active Creative Review</span>
                                </div>
                            </div>
                            <span class="text-xs font-mono text-amber-400">In Progress</span>
                        </div>

                        <div class="flex items-center justify-between p-4 rounded-xl bg-white/[0.02] border border-white/5 text-neutral-500">
                            <div class="flex items-center gap-3">
                                <span class="w-6 h-6 rounded-full bg-white/5 flex items-center justify-center text-xs">5</span>
                                <div>
                                    <h4 class="text-sm font-semibold">Stage 5: 3D Concept Visualization</h4>
                                    <span class="text-xs text-neutral-600">Pending Stage 4 sign-off</span>
                                </div>
                            </div>
                            <span class="text-xs font-mono">Scheduled</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Financials & Invoices (Col 3) -->
            <div class="space-y-8">
                <div class="glass-card rounded-3xl p-8">
                    <span class="text-xs font-mono uppercase text-amber-400">Financial Ledger</span>
                    <h2 class="font-heading text-xl font-bold text-white mt-1 mb-6">Invoices & Milestones</h2>

                    <div class="space-y-4">
                        <div class="bg-black/40 rounded-2xl p-5 border border-white/5">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-mono font-bold text-white">INV-2026-001</span>
                                <span class="px-2 py-0.5 rounded text-[10px] font-mono uppercase bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                    PAID
                                </span>
                            </div>
                            <div class="text-xs text-neutral-400">50% Initial Project Deposit</div>
                            <div class="font-heading text-2xl font-black text-white mt-2">$47,500.00</div>
                            <div class="text-[11px] text-neutral-500 mt-1">Paid on Sep 28 via Wire Transfer</div>
                        </div>

                        <div class="bg-black/40 rounded-2xl p-5 border border-white/5">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-mono font-bold text-neutral-400">INV-2026-002</span>
                                <span class="px-2 py-0.5 rounded text-[10px] font-mono uppercase bg-neutral-800 text-neutral-400">
                                    UPCOMING
                                </span>
                            </div>
                            <div class="text-xs text-neutral-400">Stage 4 Sign-Off Milestone</div>
                            <div class="font-heading text-2xl font-black text-neutral-400 mt-2">$23,750.00</div>
                            <div class="text-[11px] text-neutral-500 mt-1">Scheduled for delivery gate release</div>
                        </div>
                    </div>

                    <div class="mt-6 pt-6 border-t border-white/5">
                        <div class="flex items-center justify-between text-xs text-neutral-400 font-mono mb-1">
                            <span>Agreed Total SOW:</span>
                            <span class="text-white font-bold">$95,000.00</span>
                        </div>
                        <div class="flex items-center justify-between text-xs text-neutral-400 font-mono">
                            <span>Total Settled to Date:</span>
                            <span class="text-emerald-400 font-bold">$47,500.00 (50%)</span>
                        </div>
                    </div>
                </div>

                <!-- Agency Contact Card -->
                <div class="glass-card rounded-3xl p-8 border-t-2 border-t-amber-500">
                    <span class="text-xs font-mono uppercase text-amber-400">Dedicated Account Lead</span>
                    <h3 class="font-heading text-lg font-bold text-white mt-1">Marcus Sterling</h3>
                    <p class="text-xs text-neutral-400 mt-1">Senior Project Director &bull; Operations</p>
                    <div class="mt-4 space-y-2 text-xs font-mono text-neutral-300">
                        <div>Email: <a href="mailto:pm@agencyflow.ai" class="text-amber-400 underline">pm@agencyflow.ai</a></div>
                        <div>Direct: +1 (555) 010-9902</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Approval & Digital Signature Modal -->
        <div x-show="approvalModalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md" style="display: none;">
            <div class="glass-card max-w-lg w-full p-8 rounded-3xl border border-amber-500/30">
                <h3 class="font-heading text-2xl font-bold text-white mb-2">Formal Deliverable Sign-Off</h3>
                <p class="text-xs text-neutral-400 mb-6">
                    By submitting this digital approval, you confirm acceptance of <span class="text-amber-300 font-semibold" x-text="deliverableTitle"></span> and authorize progression to Stage 5.
                </p>

                <div x-show="!signatureSuccess">
                    <label class="block text-xs font-mono text-neutral-400 uppercase mb-2">Digital Signature</label>
                    <input type="text" x-model="clientSignature" class="w-full bg-neutral-900 border border-white/10 rounded-xl p-3 text-sm text-white mb-6 focus:border-amber-500 focus:outline-none">

                    <div class="flex items-center justify-end gap-3">
                        <button @click="approvalModalOpen = false" class="px-4 py-2.5 rounded-xl bg-neutral-900 text-xs font-semibold text-neutral-400 hover:text-white">
                            Cancel
                        </button>
                        <button @click="submitApproval()" class="px-6 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-xs font-semibold text-black transition-all">
                            Sign & Approve Deliverable
                        </button>
                    </div>
                </div>

                <div x-show="signatureSuccess" class="text-center py-6">
                    <span class="w-12 h-12 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xl font-bold mx-auto mb-3">&check;</span>
                    <h4 class="font-heading text-lg font-bold text-white">Deliverable Approved!</h4>
                    <p class="text-xs text-neutral-400 mt-1">Audit log generated with cryptographic hash: <code class="font-mono text-amber-400">sha256-7fa91c...</code></p>
                </div>
            </div>
        </div>

        <!-- Revision Request Modal -->
        <div x-show="revisionModalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-md" style="display: none;">
            <div class="glass-card max-w-lg w-full p-8 rounded-3xl border border-white/20">
                <h3 class="font-heading text-2xl font-bold text-white mb-2">Request Deliverable Revisions</h3>
                <p class="text-xs text-neutral-400 mb-4">Provide detailed feedback to the creative team.</p>

                <textarea x-model="revisionNotes" rows="4" placeholder="Detail specific adjustments required (e.g. typography weight, color palette contrast, icon scale)..." class="w-full bg-neutral-900 border border-white/10 rounded-xl p-3 text-sm text-white mb-6 focus:border-amber-500 focus:outline-none"></textarea>

                <div class="flex items-center justify-end gap-3">
                    <button @click="revisionModalOpen = false" class="px-4 py-2.5 rounded-xl bg-neutral-900 text-xs font-semibold text-neutral-400 hover:text-white">
                        Cancel
                    </button>
                    <button @click="revisionModalOpen = false; alert('Revision request transmitted to creative director.');" class="px-6 py-2.5 rounded-xl bg-neutral-200 hover:bg-white text-xs font-semibold text-black transition-all">
                        Transmit Revision Request
                    </button>
                </div>
            </div>
        </div>

    </main>

</body>
</html>
