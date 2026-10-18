<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AgencyFlow AI ERP — Haute Creative Agency & Enterprise Intelligence</title>
    <meta name="description" content="Next-generation Creative Agency Management and Enterprise ERP uniting brand strategy, packaging, 3D visualization, and multi-model AI forecasting.">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|syne:700,800" rel="stylesheet" />

    <style>
        :root {
            --font-sans: 'Instrument Sans', sans-serif;
            --font-heading: 'Syne', sans-serif;
        }
        body {
            font-family: var(--font-sans);
            background-color: #08080a;
            color: #ececec;
            overflow-x: hidden;
        }
        .font-heading {
            font-family: var(--font-heading);
        }
        .glow-radial {
            background: radial-gradient(circle at 50% 0%, rgba(245, 158, 11, 0.12) 0%, rgba(20, 20, 25, 0) 70%);
        }
        .glass-panel {
            background: rgba(18, 18, 22, 0.65);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.07);
        }
        .glass-panel:hover {
            border-color: rgba(245, 158, 11, 0.35);
        }
        .gold-gradient-text {
            background: linear-gradient(135deg, #FFF6E5 0%, #F59E0B 50%, #D97706 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="selection:bg-amber-500 selection:text-black">

    <!-- Top Glow Background -->
    <div class="absolute inset-0 top-0 h-[800px] glow-radial pointer-events-none -z-10"></div>

    <!-- Navigation Header -->
    <header class="sticky top-0 z-50 glass-panel border-b border-white/5 py-4 px-6 md:px-12 transition-all">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="/" class="flex items-center gap-3 group">
                <span class="w-3.5 h-3.5 rounded-full bg-amber-500 animate-pulse shadow-[0_0_12px_#f59e0b]"></span>
                <span class="font-heading font-extrabold text-xl tracking-tight text-white group-hover:text-amber-400 transition-colors">
                    AGENCYFLOW <span class="text-xs px-2 py-0.5 rounded-full bg-amber-500/10 text-amber-400 border border-amber-500/30 tracking-widest font-sans uppercase">AI ERP</span>
                </span>
            </a>

            <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-neutral-300">
                <a href="#services" class="hover:text-amber-400 transition-colors">Services</a>
                <a href="#pillars" class="hover:text-amber-400 transition-colors">4 Pillars</a>
                <a href="#works" class="hover:text-amber-400 transition-colors">Selected Works</a>
                <a href="#ai-estimator" class="hover:text-amber-400 transition-colors">AI Estimator</a>
            </nav>

            <div class="flex items-center gap-4">
                <a href="/portal" class="text-xs uppercase tracking-wider font-semibold px-4 py-2 rounded-lg bg-neutral-900 border border-white/10 hover:border-amber-500/50 hover:text-amber-300 transition-all">
                    Client Portal
                </a>
                <a href="/admin" class="text-xs uppercase tracking-wider font-semibold px-4 py-2 rounded-lg bg-amber-500 text-black hover:bg-amber-400 shadow-[0_0_20px_rgba(245,158,11,0.25)] transition-all">
                    ERP Admin &rarr;
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 md:px-12 pt-24 pb-20 text-center relative">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/5 border border-white/10 text-xs text-amber-300 font-medium tracking-widest uppercase mb-8">
            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
            Haute Brand Creation &bull; Autonomous ERP Operations
        </div>

        <h1 class="font-heading text-4xl sm:text-6xl md:text-7xl lg:text-8xl font-black tracking-tight leading-[1.05] uppercase max-w-5xl mx-auto mb-8">
            Crafting <span class="gold-gradient-text">Iconic Brands</span> with Machine Precision.
        </h1>

        <p class="text-lg md:text-xl text-neutral-400 max-w-3xl mx-auto leading-relaxed mb-12">
            A creative agency designed for modern market leaders. We fuse bespoke brand identity, packaging dielines, and photorealistic 3D visualization with an autonomous, predictive AI operating system.
        </p>

        <div class="flex flex-wrap items-center justify-center gap-4">
            <a href="/admin" class="px-8 py-4 rounded-xl bg-amber-500 hover:bg-amber-400 text-black font-semibold text-sm tracking-wider uppercase transition-all shadow-lg shadow-amber-500/20">
                Explore Enterprise ERP
            </a>
            <a href="/portal" class="px-8 py-4 rounded-xl glass-panel hover:bg-white/10 text-white font-semibold text-sm tracking-wider uppercase transition-all">
                Access Client Portal
            </a>
        </div>

        <!-- 4-Pillar Ribbon -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-5xl mx-auto mt-24">
            <div class="glass-panel p-6 rounded-2xl text-left border-l-2 border-l-amber-500">
                <span class="text-xs font-mono text-amber-400 font-semibold">01 / DISCOVERY</span>
                <h3 class="font-heading text-xl font-bold text-white mt-1">IDENTIFY</h3>
                <p class="text-xs text-neutral-400 mt-2">Brand Strategy, Competitive Positioning, and Linguistic Naming Systems.</p>
            </div>
            <div class="glass-panel p-6 rounded-2xl text-left border-l-2 border-l-amber-500">
                <span class="text-xs font-mono text-amber-400 font-semibold">02 / CRAFT</span>
                <h3 class="font-heading text-xl font-bold text-white mt-1">CREATE</h3>
                <p class="text-xs text-neutral-400 mt-2">Visual Identity, Tactile Packaging Dielines, Editorial & Design Systems.</p>
            </div>
            <div class="glass-panel p-6 rounded-2xl text-left border-l-2 border-l-amber-500">
                <span class="text-xs font-mono text-amber-400 font-semibold">03 / ACTIVATION</span>
                <h3 class="font-heading text-xl font-bold text-white mt-1">COMMUNICATE</h3>
                <p class="text-xs text-neutral-400 mt-2">Worldwide Launch Campaigns, Motion Animation, and Photorealistic 3D CGI.</p>
            </div>
            <div class="glass-panel p-6 rounded-2xl text-left border-l-2 border-l-amber-500">
                <span class="text-xs font-mono text-amber-400 font-semibold">04 / GROWTH</span>
                <h3 class="font-heading text-xl font-bold text-white mt-1">CAPTURE</h3>
                <p class="text-xs text-neutral-400 mt-2">Community Governance, Analytics Auditing, and Brand Cultivation.</p>
            </div>
        </div>
    </section>

    <!-- Selected Works Showcase -->
    <section id="works" class="max-w-7xl mx-auto px-6 md:px-12 py-20 border-t border-white/5">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div>
                <span class="text-xs uppercase tracking-widest text-amber-400 font-mono">Portfolio</span>
                <h2 class="font-heading text-3xl md:text-5xl font-black text-white mt-2">SELECTED COMMISSIONS</h2>
            </div>
            <p class="text-neutral-400 text-sm max-w-md mt-4 md:mt-0">
                Managed from brief to invoice through AgencyFlow's stage governance engine.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Work 1 -->
            <div class="group glass-panel rounded-3xl overflow-hidden relative">
                <div class="h-80 overflow-hidden bg-neutral-950">
                    <img src="https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=1200&q=80" alt="Horizon EV" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-80 group-hover:opacity-100">
                </div>
                <div class="p-8">
                    <div class="flex items-center justify-between text-xs font-mono text-amber-400 uppercase tracking-wider mb-2">
                        <span>Horizon Luxury EV</span>
                        <span>$95,000 Budget &bull; 94.5% Health</span>
                    </div>
                    <h3 class="font-heading text-2xl font-bold text-white group-hover:text-amber-300 transition-colors">Global Electric Brand Identity & Launch Architecture</h3>
                    <p class="text-sm text-neutral-400 mt-2">Comprehensive identity deck, custom aerodynamic typography, bespoke front grille emblem, and photorealistic launch film.</p>
                </div>
            </div>

            <!-- Work 2 -->
            <div class="group glass-panel rounded-3xl overflow-hidden relative">
                <div class="h-80 overflow-hidden bg-neutral-950">
                    <img src="https://images.unsplash.com/photo-1527061011665-3652c757a4d4?auto=format&fit=crop&w=1200&q=80" alt="Aethelgard Spirits" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 opacity-80 group-hover:opacity-100">
                </div>
                <div class="p-8">
                    <div class="flex items-center justify-between text-xs font-mono text-amber-400 uppercase tracking-wider mb-2">
                        <span>Aethelgard Botanical Spirits</span>
                        <span>$48,000 Budget &bull; 98.0% Health</span>
                    </div>
                    <h3 class="font-heading text-2xl font-bold text-white group-hover:text-amber-300 transition-colors">Sustainable Botanical Spirits Packaging & Embossed Glass Dielines</h3>
                    <p class="text-sm text-neutral-400 mt-2">Single-origin Scandinavian gin bottles, gold foil hot stamping, custom wooden closures, and export carton engineering.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive AI Cost & Proposal Estimator Widget -->
    <section id="ai-estimator" class="max-w-5xl mx-auto px-6 md:px-12 py-20" x-data="{
        serviceType: 'branding',
        scope: 'full',
        timeline: 6,
        calculateEstimate() {
            let base = this.serviceType === 'branding' ? 25000 : (this.serviceType === 'packaging' ? 18000 : 35000);
            let multiplier = this.scope === 'full' ? 1.4 : 1.0;
            return Math.round(base * multiplier);
        }
    }">
        <div class="glass-panel p-8 md:p-12 rounded-3xl border border-amber-500/20 relative overflow-hidden">
            <div class="absolute -top-24 -right-24 w-72 h-72 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs uppercase tracking-widest text-amber-400 font-mono">AI Intelligence Engine</span>
                <h2 class="font-heading text-3xl md:text-4xl font-extrabold text-white mt-2">Instant Creative Scope & Budget Estimator</h2>
                <p class="text-neutral-400 text-sm mt-3">Calculated via AgencyFlow historical deliverable and labor telemetry.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div>
                    <label class="block text-xs font-mono text-neutral-400 uppercase mb-2">Service Discipline</label>
                    <select x-model="serviceType" class="w-full bg-neutral-900 border border-white/10 rounded-xl p-3 text-sm text-white focus:outline-none focus:border-amber-500">
                        <option value="branding">Brand Identity & Strategy (CREATE)</option>
                        <option value="packaging">Luxury Packaging & Dielines (CREATE)</option>
                        <option value="campaign">Launch Campaign & 3D CGI (COMMUNICATE)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-mono text-neutral-400 uppercase mb-2">Engagement Scope</label>
                    <select x-model="scope" class="w-full bg-neutral-900 border border-white/10 rounded-xl p-3 text-sm text-white focus:outline-none focus:border-amber-500">
                        <option value="core">Core Identity & Guidelines</option>
                        <option value="full">Enterprise Full-Spectrum Rollout</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-mono text-neutral-400 uppercase mb-2">Delivery Cadence</label>
                    <select x-model="timeline" class="w-full bg-neutral-900 border border-white/10 rounded-xl p-3 text-sm text-white focus:outline-none focus:border-amber-500">
                        <option value="4">Accelerated Sprint (4 Weeks)</option>
                        <option value="6">Standard Delivery (6-8 Weeks)</option>
                        <option value="12">Global Enterprise (12 Weeks)</option>
                    </select>
                </div>
            </div>

            <div class="bg-black/60 rounded-2xl p-6 flex flex-col md:flex-row items-center justify-between border border-white/5">
                <div>
                    <span class="text-xs text-neutral-400 font-mono uppercase">AI Estimated Investment</span>
                    <div class="font-heading text-3xl md:text-5xl font-black text-amber-400 mt-1">
                        $<span x-text="calculateEstimate().toLocaleString()"></span>
                    </div>
                    <span class="text-xs text-neutral-500">Includes labor rate, revision caps, and IP assignment</span>
                </div>

                <div class="mt-4 md:mt-0 flex gap-4">
                    <a href="/portal" class="px-6 py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-black font-semibold text-xs tracking-wider uppercase transition-all">
                        Request Formal SOW &rarr;
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-white/5 py-12 px-6 md:px-12 text-sm text-neutral-500">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-3">
                <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                <span class="font-heading font-bold text-white text-base">AgencyFlow AI ERP</span>
                <span>&bull; &copy; {{ date('Y') }} All Rights Reserved.</span>
            </div>

            <div class="flex items-center gap-6">
                <a href="/portal" class="hover:text-amber-400 transition-colors">Client Portal</a>
                <a href="/admin" class="hover:text-amber-400 transition-colors">ERP Admin Panel</a>
                <a href="/admin/login" class="hover:text-amber-400 transition-colors">Employee Gateway</a>
            </div>
        </div>
    </footer>

</body>
</html>
