<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AgencyFlow — Delivery, without the drag</title>
    <meta name="description"
        content="AgencyFlow gives modern agencies one calm, connected workspace for projects, clients, finances, and delivery intelligence.">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700|space-grotesk:500,600,700" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --ink: #102a43;
            --muted: #627d98;
            --paper: #f8fbfd;
            --mint: #c9f7e6;
            --blue: #3f7cff;
            --violet: #8b6cff;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            color: var(--ink);
            background: var(--paper);
        }

        .font-display {
            font-family: 'Space Grotesk', sans-serif;
        }

        .hero-wash {
            background: radial-gradient(circle at 50% 0%, #ddf8ee 0, #f8fbfd 44%, #f8fbfd 100%);
        }

        .dot-grid {
            background-image: radial-gradient(#b8d1d2 1px, transparent 1px);
            background-size: 18px 18px;
            mask-image: linear-gradient(to bottom, black, transparent);
        }

        .browser-shadow {
            box-shadow: 0 35px 90px rgba(54, 91, 113, .18), 0 12px 24px rgba(54, 91, 113, .08);
        }

        .soft-shadow {
            box-shadow: 0 18px 45px rgba(54, 91, 113, .10);
        }

        .pill-gradient {
            background: linear-gradient(100deg, #effff8, #eef4ff);
        }

        .marquee {
            animation: marquee 24s linear infinite;
        }

        @keyframes marquee {
            to {
                transform: translateX(-50%);
            }
        }
    </style>
</head>

<body class="overflow-x-hidden">
    <header class="relative z-20 border-b border-[#dbe9e9]/70 bg-[#f8fbfd]/85 backdrop-blur-md">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5 lg:px-10">
            <a href="/" class="flex items-center gap-2.5" aria-label="AgencyFlow home">
                <span
                    class="grid size-8 place-items-center rounded-[10px] bg-[#102a43] text-sm font-bold text-white">A</span>
                <span class="font-display text-[19px] font-bold tracking-[-.04em]">agencyflow</span>
            </a>

            <nav class="hidden items-center gap-8 text-sm font-medium text-[#486581] lg:flex"
                aria-label="Primary navigation">
                <a class="transition hover:text-[#102a43]" href="#platform">Platform</a>
                <a class="transition hover:text-[#102a43]" href="#solutions">Solutions</a>
                <a class="transition hover:text-[#102a43]" href="#stories">Customer stories</a>
                <a class="transition hover:text-[#102a43]" href="#pricing">Pricing</a>
            </nav>

            <div class="flex items-center gap-3">
                <a href="/admin"
                    class="hidden px-3 py-2 text-sm font-semibold text-[#486581] transition hover:text-[#102a43] sm:inline-flex">Log
                    in</a>
                <a href="#demo"
                    class="rounded-full bg-[#102a43] px-5 py-2.5 text-sm font-semibold text-white transition hover:-translate-y-0.5 hover:bg-[#1c405e]">Book
                    a demo <span aria-hidden="true">↗</span></a>
            </div>
        </div>
    </header>

    <main>
        <section class="hero-wash relative overflow-hidden">
            <div class="dot-grid pointer-events-none absolute inset-x-0 top-0 h-72 opacity-70"></div>
            <div class="relative mx-auto max-w-7xl px-6 pb-20 pt-20 text-center lg:px-10 lg:pb-28 lg:pt-28">
                <div
                    class="mx-auto mb-8 inline-flex items-center gap-2 rounded-full border border-[#bde5db] bg-white/75 px-4 py-2 text-xs font-semibold uppercase tracking-[.16em] text-[#287b70]">
                    <span class="size-2 rounded-full bg-[#35bd9a]"></span>
                    The calm operating system for agencies
                </div>
                <h1
                    class="font-display mx-auto max-w-5xl text-5xl font-semibold leading-[1.02] tracking-[-.065em] text-[#102a43] sm:text-7xl lg:text-[88px]">
                    Make delivery your <span class="text-[#3f7cff]">competitive edge.</span>
                </h1>
                <p class="mx-auto mt-7 max-w-2xl text-lg leading-8 text-[#627d98] sm:text-xl">
                    AgencyFlow brings your projects, people, clients, and cash flow into one clear view — so great work
                    moves forward without the busywork.
                </p>
                <div class="mt-10 flex flex-col items-center justify-center gap-3 sm:flex-row">
                    <a href="#demo"
                        class="w-full rounded-full bg-[#3f7cff] px-7 py-3.5 text-sm font-bold text-white shadow-lg shadow-blue-200 transition hover:-translate-y-0.5 hover:bg-[#3169df] sm:w-auto">See
                        AgencyFlow in action <span aria-hidden="true">↗</span></a>
                    <a href="#platform"
                        class="w-full rounded-full border border-[#c8d9e5] bg-white/70 px-7 py-3.5 text-sm font-bold text-[#102a43] transition hover:border-[#9db8ca] sm:w-auto">Explore
                        the platform <span aria-hidden="true">↓</span></a>
                </div>
                <p class="mt-5 text-xs font-medium text-[#829ab1]">No credit card required · Built for ambitious teams
                </p>
            </div>

            <div id="platform" class="relative mx-auto max-w-6xl px-5 lg:px-10">
                <div class="browser-shadow overflow-hidden rounded-t-2xl border border-[#cfe1e3] bg-white">
                    <div class="flex items-center justify-between border-b border-[#e5eeee] px-5 py-4">
                        <div class="flex items-center gap-2">
                            <span class="size-2.5 rounded-full bg-[#ff8d8d]"></span><span
                                class="size-2.5 rounded-full bg-[#ffd66e]"></span><span
                                class="size-2.5 rounded-full bg-[#69d6b0]"></span>
                            <span
                                class="ml-4 hidden rounded-md bg-[#f3f7f8] px-3 py-1 text-[10px] text-[#829ab1] sm:inline">app.agencyflow.io
                                / overview</span>
                        </div>
                        <span class="rounded-full bg-[#e6faf2] px-3 py-1 text-[10px] font-bold text-[#25826e]">All
                            systems healthy</span>
                    </div>
                    <div class="grid min-h-[360px] grid-cols-[160px_1fr] text-left sm:grid-cols-[205px_1fr]">
                        <aside class="hidden border-r border-[#edf2f3] bg-[#fbfdfd] p-5 sm:block">
                            <div class="mb-8 flex items-center gap-2 text-xs font-bold"><span
                                    class="grid size-6 place-items-center rounded-md bg-[#102a43] text-[9px] text-white">A</span>
                                AgencyFlow</div>
                            <div class="space-y-1 text-xs font-semibold text-[#829ab1]">
                                <div class="rounded-lg bg-[#eaf0ff] px-3 py-2.5 text-[#3f7cff]">Overview</div>
                                <div class="px-3 py-2.5">Projects</div>
                                <div class="px-3 py-2.5">Clients</div>
                                <div class="px-3 py-2.5">Time & budgets</div>
                            </div>
                            <div
                                class="mt-16 border-t border-[#edf2f3] pt-4 text-[10px] font-bold uppercase tracking-wider text-[#a0b3c2]">
                                Workspace</div>
                            <div class="mt-3 px-3 text-xs font-semibold text-[#829ab1]">Settings</div>
                        </aside>
                        <div class="bg-white p-5 sm:p-8">
                            <div class="flex flex-wrap items-start justify-between gap-3">
                                <div>
                                    <p class="text-xs font-medium text-[#829ab1]">Monday, 19 October 2026</p>
                                    <h2 class="font-display mt-1 text-2xl font-semibold tracking-tight">Good morning,
                                        Jaffar <span aria-hidden="true">✦</span></h2>
                                </div>
                                <button class="rounded-lg bg-[#3f7cff] px-3 py-2 text-[11px] font-bold text-white">+ New
                                    project</button>
                            </div>
                            <div class="mt-7 grid gap-3 sm:grid-cols-3">
                                <div class="rounded-xl border border-[#e8f0f1] p-4">
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-[#829ab1]">Active
                                        projects</p>
                                    <p class="font-display mt-2 text-3xl font-semibold">24</p>
                                    <p class="mt-1 text-[10px] font-semibold text-[#2eaa84]">↑ 12% this month</p>
                                </div>
                                <div class="rounded-xl border border-[#e8f0f1] p-4">
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-[#829ab1]">On track
                                    </p>
                                    <p class="font-display mt-2 text-3xl font-semibold">87%</p>
                                    <p class="mt-1 text-[10px] font-semibold text-[#2eaa84]">↑ 8% this month</p>
                                </div>
                                <div class="rounded-xl border border-[#e8f0f1] p-4">
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-[#829ab1]">Billable
                                        hours</p>
                                    <p class="font-display mt-2 text-3xl font-semibold">1,248</p>
                                    <p class="mt-1 text-[10px] font-semibold text-[#e6a63d]">92% capacity</p>
                                </div>
                            </div>
                            <div class="mt-5 grid gap-5 lg:grid-cols-[1.35fr_1fr]">
                                <div class="rounded-xl border border-[#e8f0f1] p-4">
                                    <div class="flex justify-between text-xs font-bold"><span>Project health</span><span
                                            class="text-[#829ab1]">This quarter</span></div>
                                    <div class="mt-6 flex h-24 items-end gap-2 sm:gap-4"><span
                                            class="h-[42%] flex-1 rounded-t bg-[#dbe7ff]"></span><span
                                            class="h-[58%] flex-1 rounded-t bg-[#b7ccff]"></span><span
                                            class="h-[52%] flex-1 rounded-t bg-[#92b1ff]"></span><span
                                            class="h-[75%] flex-1 rounded-t bg-[#7196ff]"></span><span
                                            class="h-[66%] flex-1 rounded-t bg-[#3f7cff]"></span><span
                                            class="h-[88%] flex-1 rounded-t bg-[#2d61e3]"></span><span
                                            class="h-full flex-1 rounded-t bg-[#102a43]"></span></div>
                                </div>
                                <div class="rounded-xl border border-[#e8f0f1] p-4">
                                    <div class="flex justify-between text-xs font-bold"><span>Needs
                                            attention</span><span class="text-[#3f7cff]">View all</span></div>
                                    <div class="mt-4 space-y-3 text-[11px]">
                                        <div class="flex items-center gap-2"><span
                                                class="size-2 rounded-full bg-[#ff9d72]"></span><span
                                                class="flex-1 text-[#486581]">Northstar rebrand</span><b
                                                class="font-semibold text-[#829ab1]">2 days</b></div>
                                        <div class="flex items-center gap-2"><span
                                                class="size-2 rounded-full bg-[#ffd15c]"></span><span
                                                class="flex-1 text-[#486581]">Meridian launch</span><b
                                                class="font-semibold text-[#829ab1]">4 days</b></div>
                                        <div class="flex items-center gap-2"><span
                                                class="size-2 rounded-full bg-[#69d6b0]"></span><span
                                                class="flex-1 text-[#486581]">Oak & Co. website</span><b
                                                class="font-semibold text-[#829ab1]">On track</b></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="overflow-hidden border-b border-[#e2eeee] bg-white py-9">
            <p class="text-center text-xs font-bold uppercase tracking-[.2em] text-[#9ab0bd]">Trusted by teams who do
                their best work together</p>
            <div class="marquee mt-7 flex w-max gap-16 text-lg font-display font-semibold text-[#a0b2bd] sm:gap-24">
                <span>northstar<span class="text-[#c5d1d5]">/studio</span></span><span>MERIDIAN</span><span>oak &
                    co.</span><span class="italic">LUMEN</span><span>fieldwork</span><span>northstar<span
                        class="text-[#c5d1d5]">/studio</span></span><span>MERIDIAN</span><span>oak & co.</span><span
                    class="italic">LUMEN</span><span>fieldwork</span>
            </div>
        </section>

        <section id="solutions" class="mx-auto max-w-7xl px-6 py-24 lg:px-10 lg:py-32">
            <div class="max-w-2xl">
                <p class="text-sm font-bold uppercase tracking-[.18em] text-[#3f7cff]">One workspace. More momentum.</p>
                <h2 class="font-display mt-4 text-4xl font-semibold leading-tight tracking-[-.05em] sm:text-6xl">
                    Everything your agency needs to deliver <span class="text-[#8b6cff]">beautifully.</span></h2>
            </div>
            <div class="mt-14 grid gap-5 md:grid-cols-3">
                <article class="soft-shadow rounded-2xl border border-[#e2eeee] bg-white p-7">
                    <div class="grid size-11 place-items-center rounded-xl bg-[#eaf0ff] text-xl text-[#3f7cff]">◒</div>
                    <h3 class="font-display mt-8 text-2xl font-semibold">Projects that flow</h3>
                    <p class="mt-3 leading-7 text-[#627d98]">Plan, assign, and track every moving part with a view that
                        keeps the whole team one step ahead.</p><a href="#demo"
                        class="mt-7 inline-block text-sm font-bold text-[#3f7cff]">Explore project delivery <span
                            aria-hidden="true">→</span></a>
                </article>
                <article class="soft-shadow rounded-2xl border border-[#e2eeee] bg-white p-7">
                    <div class="grid size-11 place-items-center rounded-xl bg-[#fff4d8] text-xl text-[#de9b20]">◷</div>
                    <h3 class="font-display mt-8 text-2xl font-semibold">Clients in the loop</h3>
                    <p class="mt-3 leading-7 text-[#627d98]">Give clients a calm, branded space to review work, share
                        feedback, and feel part of the progress.</p><a href="#demo"
                        class="mt-7 inline-block text-sm font-bold text-[#3f7cff]">See the client portal <span
                            aria-hidden="true">→</span></a>
                </article>
                <article class="soft-shadow rounded-2xl border border-[#e2eeee] bg-white p-7">
                    <div class="grid size-11 place-items-center rounded-xl bg-[#e5faf2] text-xl text-[#28a77f]">↗</div>
                    <h3 class="font-display mt-8 text-2xl font-semibold">A healthier business</h3>
                    <p class="mt-3 leading-7 text-[#627d98]">Know what is profitable, what needs attention, and where to
                        focus next — before the numbers tell you.</p><a href="#demo"
                        class="mt-7 inline-block text-sm font-bold text-[#3f7cff]">Discover business intelligence <span
                            aria-hidden="true">→</span></a>
                </article>
            </div>
        </section>

        <section id="stories" class="bg-[#102a43] px-6 py-24 text-white lg:px-10 lg:py-28">
            <div class="mx-auto grid max-w-7xl gap-14 lg:grid-cols-[1fr_1.1fr] lg:items-center">
                <div>
                    <p class="text-sm font-bold uppercase tracking-[.18em] text-[#8ce0c4]">Less chasing. More creating.
                    </p>
                    <blockquote
                        class="font-display mt-5 max-w-xl text-4xl font-medium leading-[1.12] tracking-[-.04em] sm:text-5xl">
                        “AgencyFlow gave us back the headspace to do the work our clients actually hire us for.”
                    </blockquote>
                    <div class="mt-8 flex items-center gap-3">
                        <div
                            class="grid size-10 place-items-center rounded-full bg-[#f0b87c] text-sm font-bold text-[#102a43]">
                            MC</div>
                        <div>
                            <p class="text-sm font-bold">Maya Chen</p>
                            <p class="text-xs text-[#9fb6c7]">Managing Partner, Northstar / Studio</p>
                        </div>
                    </div>
                </div>
                <div class="rounded-3xl bg-[#1b405e] p-7 sm:p-10">
                    <div class="flex items-center justify-between"><span class="text-sm font-bold text-[#c9d9e4]">Your
                            agency, at a glance</span><span
                            class="rounded-full bg-[#2c5a76] px-3 py-1 text-[10px] font-bold text-[#9ce2cd]">LIVE
                            DATA</span></div>
                    <div class="mt-8 grid grid-cols-2 gap-3">
                        <div class="rounded-2xl bg-white/10 p-5">
                            <p class="text-xs text-[#9fb6c7]">Revenue forecast</p>
                            <p class="font-display mt-3 text-3xl font-semibold">$184k</p>
                            <p class="mt-2 text-xs text-[#8ce0c4]">↑ 14.6%</p>
                        </div>
                        <div class="rounded-2xl bg-white/10 p-5">
                            <p class="text-xs text-[#9fb6c7]">Team utilization</p>
                            <p class="font-display mt-3 text-3xl font-semibold">82%</p>
                            <p class="mt-2 text-xs text-[#8ce0c4]">Healthy range</p>
                        </div>
                    </div>
                    <div class="mt-3 rounded-2xl bg-white/10 p-5">
                        <div class="flex justify-between text-xs"><span class="text-[#c9d9e4]">Delivery
                                confidence</span><span class="font-bold text-[#8ce0c4]">Excellent</span></div>
                        <div class="mt-4 h-2 rounded-full bg-[#315a75]">
                            <div class="h-2 w-[86%] rounded-full bg-[#8ce0c4]"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="pricing" class="bg-[#eaf8f3] px-6 py-24 lg:px-10 lg:py-28">
            <div id="demo"
                class="mx-auto flex max-w-5xl flex-col items-start justify-between gap-8 rounded-3xl bg-[#c9f7e6] p-8 sm:p-12 lg:flex-row lg:items-center">
                <div>
                    <p class="text-sm font-bold uppercase tracking-[.18em] text-[#287b70]">Ready when you are</p>
                    <h2
                        class="font-display mt-3 max-w-2xl text-4xl font-semibold leading-tight tracking-[-.05em] text-[#102a43] sm:text-5xl">
                        Give your best work a better system.</h2>
                    <p class="mt-4 max-w-lg leading-7 text-[#486581]">See how AgencyFlow can fit the way your team
                        already works. We’ll bring the coffee and a real walkthrough.</p>
                </div><a href="mailto:hello@agencyflow.test"
                    class="shrink-0 rounded-full bg-[#102a43] px-7 py-3.5 text-sm font-bold text-white transition hover:-translate-y-0.5 hover:bg-[#1c405e]">Book
                    a personal demo <span aria-hidden="true">↗</span></a>
            </div>
        </section>
    </main>

    <footer class="bg-[#f8fbfd] px-6 py-10 lg:px-10">
        <div class="mx-auto flex max-w-7xl flex-col items-start justify-between gap-7 sm:flex-row sm:items-center"><a
                href="/" class="flex items-center gap-2.5"><span
                    class="grid size-7 place-items-center rounded-lg bg-[#102a43] text-xs font-bold text-white">A</span><span
                    class="font-display font-bold tracking-[-.04em]">agencyflow</span></a>
            <div class="flex flex-wrap gap-6 text-sm text-[#829ab1]"><a href="#platform"
                    class="hover:text-[#102a43]">Platform</a><a href="#solutions"
                    class="hover:text-[#102a43]">Solutions</a><a href="/portal" class="hover:text-[#102a43]">Client
                    portal</a><a href="/admin" class="hover:text-[#102a43]">Admin login</a></div>
            <p class="text-xs text-[#9ab0bd]">© {{ date('Y') }} AgencyFlow</p>
        </div>
    </footer>
</body>

</html>