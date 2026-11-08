<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Tasks for Today' }}</title>
    <style>
        :root { --ink: #f2f5f9; --muted: #aeb9c9; --paper: #0b1220; --card: #151f31; --line: #2c3b55; --accent: #e3b85f; --accent-dark: #b9812e; --navy: #0d1729; --blue: #6ea5e8; --silver: #cbd5e1; --bronze: #b96e43; }
        * { box-sizing: border-box; }
        body { min-height: 100vh; margin: 0; color: var(--ink); background: radial-gradient(circle at 85% 0%, rgba(76, 112, 166, .18), transparent 34%), linear-gradient(145deg, #0b1220 0%, #101b2e 52%, #0a111e 100%); font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; line-height: 1.6; }
        a { color: inherit; }
        a:focus-visible { outline: 3px solid var(--blue); outline-offset: 3px; }
        .site-header { color: #fff; background: linear-gradient(110deg, #0a1221 0%, #16243c 55%, #111c30 100%); border-bottom: 1px solid rgba(227, 184, 95, .34); box-shadow: 0 10px 28px rgba(0, 0, 0, .22); }
        .nav-shell, .main-shell { width: min(1120px, calc(100% - 40px)); margin: 0 auto; }
        .nav-shell { display: flex; align-items: center; justify-content: space-between; gap: 24px; min-height: 78px; }
        .brand { display: flex; align-items: center; gap: 12px; color: #fff; text-decoration: none; font-weight: 800; letter-spacing: .02em; }
        .brand-mark { display: grid; place-items: center; width: 40px; height: 40px; border: 1px solid rgba(255, 244, 204, .7); border-radius: 11px; color: #261b0b; background: linear-gradient(145deg, #ffe6a1, var(--accent) 48%, #ad7024); font-weight: 900; box-shadow: inset 0 1px 1px rgba(255, 255, 255, .6), 0 5px 16px rgba(227, 184, 95, .22); }
        .nav-links { display: flex; flex-wrap: wrap; gap: 8px; }
        .nav-links a { padding: 9px 13px; border: 1px solid transparent; border-radius: 8px; color: var(--silver); font-size: .95rem; text-decoration: none; transition: color .2s ease, background .2s ease, border-color .2s ease; }
        .nav-links a:hover, .nav-links a.active { color: #fff5d6; background: rgba(227, 184, 95, .12); border-color: rgba(227, 184, 95, .3); }
        .nav-form { display: inline; margin: 0; }
        .nav-form button { padding: 9px 13px; border: 1px solid transparent; border-radius: 8px; color: var(--silver); background: transparent; font: inherit; font-size: .95rem; cursor: pointer; transition: color .2s ease, background .2s ease, border-color .2s ease; }
        .nav-form button:hover { color: #fff5d6; background: rgba(227, 184, 95, .12); border-color: rgba(227, 184, 95, .3); }
        main { padding: 64px 0 82px; }
        .eyebrow { color: var(--accent); font-size: .78rem; font-weight: 800; letter-spacing: .13em; text-transform: uppercase; }
        h1, h2, h3 { margin: 0 0 14px; line-height: 1.15; }
        h1 { color: #f7f9fc; font-size: clamp(2.2rem, 5vw, 4.2rem); letter-spacing: -.05em; text-shadow: 0 3px 18px rgba(0, 0, 0, .22); }
        h2 { font-size: clamp(1.65rem, 3vw, 2.4rem); letter-spacing: -.035em; }
        h2, h3 { color: #eef3fa; }
        p { color: var(--muted); }
        .hero { display: grid; grid-template-columns: 1.25fr .75fr; align-items: center; gap: 48px; padding: 34px 0 78px; }
        .hero p { max-width: 600px; font-size: 1.1rem; }
        .button { display: inline-block; margin-top: 18px; padding: 12px 19px; border: 1px solid rgba(255, 234, 165, .72); border-radius: 9px; color: #241a0b; background: linear-gradient(135deg, #f8d889, var(--accent) 48%, #bd792f); font-weight: 800; text-decoration: none; box-shadow: 0 8px 18px rgba(0, 0, 0, .22), inset 0 1px 1px rgba(255, 255, 255, .55); transition: transform .2s ease, box-shadow .2s ease, filter .2s ease; }
        .button:hover { background: linear-gradient(135deg, #ffe39b, #e8b957 48%, #ca8240); box-shadow: 0 11px 24px rgba(0, 0, 0, .3), inset 0 1px 1px rgba(255, 255, 255, .6); filter: brightness(1.05); transform: translateY(-1px); }
        .terminal-card { padding: 30px; border: 1px solid rgba(110, 165, 232, .42); border-radius: 20px; color: #eaf0fb; background: linear-gradient(145deg, #1a2c49, #101b31 72%); box-shadow: 0 22px 44px rgba(0, 0, 0, .32), inset 0 1px 0 rgba(255, 255, 255, .08); }
        .terminal-top { display: flex; gap: 7px; margin-bottom: 26px; }
        .terminal-top span { width: 10px; height: 10px; border-radius: 50%; background: var(--bronze); box-shadow: 0 0 10px rgba(185, 110, 67, .42); }
        .terminal-top span:nth-child(2) { background: var(--accent); box-shadow: 0 0 10px rgba(227, 184, 95, .42); } .terminal-top span:nth-child(3) { background: var(--blue); box-shadow: 0 0 10px rgba(110, 165, 232, .42); }
        .terminal-line { display: flex; justify-content: space-between; gap: 20px; padding: 13px 0; border-bottom: 1px solid rgba(255,255,255,.1); font-size: .92rem; }
        .terminal-line:last-child { border-bottom: 0; }
        .terminal-value { color: #f5d889; font-weight: 800; }
        .section-heading { display: flex; align-items: end; justify-content: space-between; gap: 24px; margin-bottom: 26px; }
        .section-heading p { margin: 0; }
        .cards { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px; }
        .card { padding: 25px; border: 1px solid var(--line); border-radius: 16px; background: linear-gradient(145deg, rgba(29, 43, 66, .96), rgba(17, 26, 43, .98)); box-shadow: 0 14px 30px rgba(0, 0, 0, .2), inset 0 1px 0 rgba(255, 255, 255, .055); transition: border-color .2s ease, transform .2s ease, box-shadow .2s ease; }
        .card:hover { border-color: rgba(227, 184, 95, .48); box-shadow: 0 18px 34px rgba(0, 0, 0, .26), inset 0 1px 0 rgba(255, 255, 255, .07); transform: translateY(-2px); }
        .card-header { display: flex; align-items: start; justify-content: space-between; gap: 16px; margin-bottom: 18px; }
        .card h3 { margin-bottom: 4px; font-size: 1.15rem; }
        .record-id { color: #8fabc9; font-size: .84rem; font-weight: 700; }
        .badge { padding: 5px 10px; border: 1px solid rgba(227, 184, 95, .5); border-radius: 999px; color: #ffe5a4; background: linear-gradient(135deg, rgba(227, 184, 95, .2), rgba(185, 110, 67, .16)); font-size: .75rem; font-weight: 800; white-space: nowrap; }
        .badge.pending, .badge.away { color: #f5d99a; background: rgba(185, 110, 67, .2); }
        .badge.offline { color: var(--silver); background: rgba(203, 213, 225, .12); }
        .details { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 15px; margin: 0; }
        .details dt { color: #91a2b9; font-size: .75rem; font-weight: 800; letter-spacing: .05em; text-transform: uppercase; }
        .details dd { margin: 2px 0 0; color: #e4ebf4; font-size: .95rem; overflow-wrap: anywhere; }
        .about-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; margin-top: 34px; }
        .about-grid .card strong { display: block; margin-bottom: 7px; color: var(--accent); font-size: 1.7rem; text-shadow: 0 2px 12px rgba(227, 184, 95, .2); }
        .page-intro { max-width: 680px; margin-bottom: 36px; }
        .form-card { max-width: 720px; }
        .form-group { display: grid; gap: 7px; margin-bottom: 18px; }
        .form-group label { color: #dce6f4; font-weight: 700; }
        .form-control { width: 100%; padding: 11px 13px; border: 1px solid #405574; border-radius: 8px; color: var(--ink); background: #0f1a2d; font: inherit; }
        .form-control:focus { border-color: var(--accent); outline: 2px solid rgba(227, 184, 95, .28); }
        .error { color: #ffb4a8; font-size: .9rem; }
        .alert { margin-bottom: 22px; padding: 12px 15px; border: 1px solid rgba(227, 184, 95, .45); border-radius: 8px; color: #ffe9b2; background: rgba(227, 184, 95, .12); }
        .actions { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 22px; }
        .button.secondary { color: var(--ink); background: rgba(203, 213, 225, .12); border-color: #526683; }
        .button.archive-button { color: #fff0e8; background: linear-gradient(135deg, #a9503d, #753126); border-color: rgba(255, 190, 160, .62); cursor: pointer; font: inherit; }
        .button.archive-button:hover { background: linear-gradient(135deg, #bd604b, #873b2d); }
        .inline-form { display: inline; }
        footer { padding: 28px 0; border-top: 1px solid rgba(203, 213, 225, .16); color: var(--muted); background: rgba(5, 10, 18, .22); font-size: .9rem; }
        @media (max-width: 760px) { .nav-shell { align-items: flex-start; flex-direction: column; padding: 18px 0; } .hero { grid-template-columns: 1fr; padding-top: 10px; } .cards, .about-grid { grid-template-columns: 1fr; } .section-heading { align-items: start; flex-direction: column; } main { padding-top: 38px; } }
        @media (max-width: 460px) { .nav-shell, .main-shell { width: min(100% - 28px, 1120px); } .details { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="nav-shell">
            <a class="brand" href="{{ route('home') }}"><span class="brand-mark">TT</span><span>Tasks for Today</span></a>
            <nav class="nav-links" aria-label="Main navigation">
                <a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                <a class="{{ request()->routeIs('tasks.*') ? 'active' : '' }}" href="{{ route('tasks.index') }}">All Tasks</a>
                <a class="{{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.index') }}">Profile</a>
                <a class="{{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                @guest
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @else
                    <form class="nav-form" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                @endguest
            </nav>
        </div>
    </header>
    <main>
        <div class="main-shell">
            @if (session('status'))
                <div class="alert">{{ session('status') }}</div>
            @endif
            @yield('content')
        </div>
    </main>
    <footer><div class="main-shell">A simple Laravel foundations project for managing the tasks that matter today.</div></footer>
</body>
</html>
