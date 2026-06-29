@include('admin.top-header')
<div class="main-section">
    @include('admin.header')

    <style>
    :root {
        --bg: #f1f2f4; --surface: #ffffff; --border: #e3e5e8; --border-hover: #c9cccf;
        --text-primary: #202223; --text-secondary: #6d7175; --text-hint: #8c9196; --text-disabled: #babec3;
        --navy: #303d89; --navy-hover: #252f70; --navy-light: #eef0fc; --navy-border: #c5c9ef;
        --green: #007a5e; --green-bg: #e3f1ec; --green-border: #9fcfc3;
        --red: #c0392b; --red-bg: #fce8e8; --red-border: #f5b8b8;
        --amber: #916a00; --amber-bg: #fff5cc; --amber-border: #e8d080;
        --blue: #0069d9; --blue-bg: #e8f2ff; --blue-border: #a8cdf5;
        --purple: #6d28d9; --purple-bg: #ede9fe; --purple-border: #c4b5fd;
        --whatsapp: #25d366; --whatsapp-bg: #e8faf1; --whatsapp-border: #a3e8c4;
        --radius-sm: 6px; --radius-md: 8px; --radius-lg: 12px;
        --shadow: 0 1px 0 rgba(0,0,0,.05), 0 0 0 1px rgba(0,0,0,.07);
        --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .sp-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); font-size: 14px; }
    .sp-page * { box-sizing: border-box; }

    /* ── Page header ── */
    .sp-page-header { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
    .sp-page-title  { font-size: 20px; font-weight: 660; margin: 0 0 4px; letter-spacing: -.2px; }
    .sp-crumb { font-size: 12.5px; color: var(--text-hint); display: flex; align-items: center; gap: 4px; flex-wrap: wrap; }
    .sp-crumb a { color: var(--navy); text-decoration: none; font-weight: 500; }
    .sp-crumb a:hover { text-decoration: underline; }
    .sp-crumb-sep { color: var(--border-hover); }

    /* ── TOP channel tabs ── */
    .sp-channel-tabs { display: flex; align-items: center; gap: 2px; background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 4px; box-shadow: var(--shadow); margin-bottom: 20px; }
    .sp-channel-tab { display: inline-flex; align-items: center; gap: 8px; padding: 9px 20px; border-radius: var(--radius-md); font-size: 13.5px; font-weight: 600; cursor: pointer; transition: all .15s; color: var(--text-secondary); border: none; background: transparent; font-family: var(--font); flex: 1; justify-content: center; }
    .sp-channel-tab:hover { background: var(--bg); color: var(--text-primary); }
    .sp-channel-tab.active { color: #fff; }
    .sp-channel-tab.sms.active       { background: var(--navy); }
    .sp-channel-tab.email.active     { background: var(--blue); }
    .sp-channel-tab.whatsapp.active  { background: #128c7e; }
    .sp-channel-tab i { font-size: 15px; }

    /* ── Main layout ── */
    .sp-tpl-layout { display: grid; grid-template-columns: 220px 1fr; gap: 20px; align-items: start; }
    @media(max-width:960px) { .sp-tpl-layout { grid-template-columns: 1fr; } }

    /* ── Left sidebar nav ── */
    .sp-sidenav { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-lg); box-shadow: var(--shadow); overflow: hidden; }
    .sp-sidenav-header { padding: 12px 16px; border-bottom: 1px solid var(--border); background: #fafafa; }
    .sp-sidenav-label { font-size: 10.5px; font-weight: 750; letter-spacing: .08em; text-transform: uppercase; color: var(--text-hint); }
    .sp-sidenav-item { display: flex; align-items: center; gap: 10px; padding: 10px 16px; cursor: pointer; border-left: 3px solid transparent; transition: all .12s; font-size: 13px; font-weight: 500; color: var(--text-secondary); border-bottom: 1px solid var(--border); }
    .sp-sidenav-item:last-child { border-bottom: none; }
    .sp-sidenav-item:hover { background: var(--bg); color: var(--text-primary); }
    .sp-sidenav-item.active { background: var(--navy-light); color: var(--navy); border-left-color: var(--navy); font-weight: 650; }
    .sp-sidenav-item i { font-size: 14px; flex-shrink: 0; }
    .sp-sidenav-badge { margin-left: auto; font-size: 10px; font-weight: 700; padding: 2px 6px; border-radius: 10px; }
    .sp-sidenav-badge.active-badge { background: var(--green-bg); color: var(--green); border: 1px solid var(--green-border); }
    .sp-sidenav-badge.draft-badge   { background: var(--amber-bg); color: var(--amber); border: 1px solid var(--amber-border); }
    .sp-sidenav-badge.off-badge     { background: var(--bg); color: var(--text-hint); border: 1px solid var(--border); }

    /* ── Right content panel ── */
    .sp-panel { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-lg); box-shadow: var(--shadow); overflow: hidden; }
    .sp-panel-header { padding: 16px 20px; border-bottom: 1px solid var(--border); background: #fafafa; display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
    .sp-panel-title { font-size: 15px; font-weight: 660; color: var(--text-primary); margin: 0 0 3px; }
    .sp-panel-desc  { font-size: 12.5px; color: var(--text-hint); margin: 0; line-height: 1.5; }
    .sp-panel-body  { padding: 24px; }

    /* ── Status toggle bar ── */
    .sp-status-bar { display: flex; align-items: center; justify-content: space-between; background: var(--green-bg); border: 1px solid var(--green-border); border-radius: var(--radius-md); padding: 11px 16px; margin-bottom: 22px; }
    .sp-status-bar.inactive { background: var(--bg); border-color: var(--border); }
    .sp-status-bar-text { font-size: 13px; font-weight: 600; color: var(--green); }
    .sp-status-bar.inactive .sp-status-bar-text { color: var(--text-hint); }
    .sp-status-bar-sub { font-size: 11.5px; color: var(--green); opacity: .75; margin-top: 1px; }
    .sp-status-bar.inactive .sp-status-bar-sub { color: var(--text-hint); }

    /* ── Toggle switch ── */
    .sp-switch { position: relative; width: 40px; height: 22px; flex-shrink: 0; }
    .sp-switch input { opacity: 0; width: 0; height: 0; position: absolute; }
    .sp-switch-track { position: absolute; inset: 0; background: var(--border); border-radius: 22px; cursor: pointer; transition: background .2s; }
    .sp-switch-track::after { content: ''; position: absolute; left: 3px; top: 3px; width: 16px; height: 16px; background: #fff; border-radius: 50%; transition: transform .2s; box-shadow: 0 1px 3px rgba(0,0,0,.2); }
    .sp-switch input:checked + .sp-switch-track { background: var(--navy); }
    .sp-switch input:checked + .sp-switch-track::after { transform: translateX(18px); }

    /* ── Form fields ── */
    .sp-field { margin-bottom: 20px; }
    .sp-field:last-child { margin-bottom: 0; }
    .sp-label { display: flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 700; color: var(--text-secondary); letter-spacing: .04em; text-transform: uppercase; margin-bottom: 7px; }
    .sp-req { color: var(--red); }
    .sp-label-badge { font-size: 10px; font-weight: 700; padding: 1px 6px; border-radius: 10px; text-transform: uppercase; letter-spacing: .04em; }
    .sp-label-badge.sms-badge   { background: var(--navy-light); color: var(--navy); border: 1px solid var(--navy-border); }
    .sp-label-badge.email-badge { background: var(--blue-bg); color: var(--blue); border: 1px solid var(--blue-border); }
    .sp-label-badge.wa-badge    { background: var(--whatsapp-bg); color: #128c7e; border: 1px solid var(--whatsapp-border); }
    .sp-help  { font-size: 11.5px; color: var(--text-hint); margin-top: 5px; line-height: 1.55; }
    .sp-input, .sp-select, .sp-textarea {
        width: 100%; border: 1px solid var(--border); border-radius: var(--radius-md);
        padding: 0 12px; height: 38px; font-size: 13.5px; color: var(--text-primary);
        background: var(--surface); outline: none; font-family: var(--font);
        transition: border-color .15s, box-shadow .15s;
    }
    .sp-input:focus, .sp-select:focus, .sp-textarea:focus { border-color: var(--navy); box-shadow: 0 0 0 3px rgba(48,61,137,.10); }
    .sp-input::placeholder, .sp-textarea::placeholder { color: var(--text-disabled); }
    .sp-input[readonly] { background: #f7f8f9; cursor: not-allowed; color: var(--text-secondary); }
    .sp-select { appearance: none; -webkit-appearance: none; padding-right: 32px; cursor: pointer;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%238c9196'/%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right 10px center; }
    .sp-textarea { height: auto; padding: 11px 12px; resize: vertical; min-height: 120px; line-height: 1.65; font-size: 13.5px; }
    .sp-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    @media(max-width:640px) { .sp-grid-2 { grid-template-columns: 1fr; } }
    .sp-grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; }
    @media(max-width:640px) { .sp-grid-3 { grid-template-columns: 1fr; } }

    /* ── Template body editor ── */
    .sp-editor-wrap { border: 1px solid var(--border); border-radius: var(--radius-md); overflow: hidden; }
    .sp-editor-toolbar { padding: 8px 12px; background: #fafafa; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
    .sp-tb-btn { display: inline-flex; align-items: center; gap: 4px; font-size: 12px; font-weight: 600; padding: 4px 10px; border-radius: 5px; cursor: pointer; border: 1px solid var(--border); background: var(--surface); color: var(--text-secondary); font-family: var(--font); transition: all .12s; white-space: nowrap; }
    .sp-tb-btn:hover { background: var(--navy-light); border-color: var(--navy-border); color: var(--navy); }
    .sp-tb-btn i { font-size: 12px; }
    .sp-tb-sep { width: 1px; height: 20px; background: var(--border); margin: 0 2px; }
    .sp-editor-area { width: 100%; border: none; padding: 14px; font-size: 13.5px; font-family: var(--font); color: var(--text-primary); background: var(--surface); outline: none; resize: vertical; min-height: 140px; line-height: 1.7; }

    /* ── Variable chips ── */
    .sp-var-section { background: var(--bg); border: 1px solid var(--border); border-radius: var(--radius-md); padding: 14px 16px; }
    .sp-var-title { font-size: 12px; font-weight: 700; color: var(--text-secondary); letter-spacing: .05em; text-transform: uppercase; margin-bottom: 10px; display: flex; align-items: center; gap: 6px; }
    .sp-var-chips { display: flex; flex-wrap: wrap; gap: 6px; }
    .sp-var-chip { display: inline-flex; align-items: center; gap: 5px; font-size: 12px; font-weight: 600; padding: 4px 10px; border-radius: 5px; background: var(--navy-light); color: var(--navy); border: 1px solid var(--navy-border); cursor: pointer; font-family: 'SF Mono','Fira Code',monospace; transition: all .12s; user-select: none; }
    .sp-var-chip:hover { background: var(--navy); color: #fff; }
    .sp-var-chip i { font-size: 10px; }

    /* ── Preview panel ── */
    .sp-preview-wrap { border: 1px solid var(--border); border-radius: var(--radius-md); overflow: hidden; }
    .sp-preview-header { padding: 10px 14px; background: #fafafa; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
    .sp-preview-label { font-size: 11.5px; font-weight: 650; color: var(--text-secondary); display: flex; align-items: center; gap: 6px; }
    .sp-preview-body { padding: 16px; min-height: 80px; font-size: 13.5px; color: var(--text-primary); line-height: 1.7; background: var(--surface); }

    /* SMS preview bubble */
    .sp-sms-bubble { background: #e5e5ea; border-radius: 14px 14px 14px 4px; padding: 10px 14px; font-size: 13px; color: #1c1c1e; line-height: 1.55; max-width: 300px; }
    .sp-sms-sender { font-size: 11px; color: var(--text-hint); margin-bottom: 6px; font-weight: 600; }
    .sp-sms-char-count { font-size: 11px; color: var(--text-hint); margin-top: 8px; display: flex; gap: 10px; }

    /* SMS provider readonly bar */
    .sp-provider-bar { background: var(--navy-light); border: 1px solid var(--navy-border); border-radius: var(--radius-md); padding: 11px 16px; display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 20px; flex-wrap: wrap; }
    .sp-provider-bar-group { display: flex; gap: 24px; flex-wrap: wrap; }
    .sp-provider-bar-item-label { font-size: 10.5px; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--navy); margin-bottom: 3px; }
    .sp-provider-bar-item-val { font-size: 13.5px; font-weight: 650; color: var(--text-primary); }
    .sp-provider-bar-note { font-size: 11.5px; color: var(--text-hint); display: flex; align-items: center; gap: 5px; }

    /* WhatsApp preview */
    .sp-wa-preview { background: #ece5dd; border-radius: var(--radius-md); padding: 16px; }
    .sp-wa-bubble { background: #fff; border-radius: 0 10px 10px 10px; padding: 10px 14px 6px; max-width: 320px; box-shadow: 0 1px 2px rgba(0,0,0,.1); }
    .sp-wa-bubble-header { font-size: 14px; font-weight: 700; color: #1c1c1e; margin-bottom: 6px; }
    .sp-wa-bubble-body { font-size: 13px; color: #1c1c1e; line-height: 1.55; }
    .sp-wa-bubble-footer { font-size: 11.5px; color: #667781; margin-top: 6px; }
    .sp-wa-btn { display: block; text-align: center; font-size: 13px; font-weight: 600; color: #128c7e; padding: 8px; border-top: 1px solid #e0e0e0; margin-top: 8px; }

    /* Email preview */
    .sp-email-preview { border: 1px solid var(--border); border-radius: var(--radius-md); overflow: hidden; }
    .sp-email-header-bar { background: var(--bg); padding: 12px 16px; border-bottom: 1px solid var(--border); font-size: 12px; color: var(--text-hint); }
    .sp-email-header-bar div { display: flex; gap: 6px; margin-bottom: 4px; }
    .sp-email-header-bar span:first-child { font-weight: 650; color: var(--text-secondary); min-width: 36px; }
    .sp-email-html-body { padding: 24px; background: #fff; font-size: 14px; line-height: 1.7; }

    /* ── Section divider ── */
    .sp-divider { border: none; border-top: 1px solid var(--border); margin: 24px 0; }

    /* ── Info callout ── */
    .sp-callout { display: flex; align-items: flex-start; gap: 10px; padding: 12px 14px; border-radius: var(--radius-md); font-size: 12.5px; line-height: 1.6; margin-bottom: 20px; }
    .sp-callout i { flex-shrink: 0; margin-top: 1px; font-size: 14px; }
    .sp-callout.info  { background: var(--blue-bg); border: 1px solid var(--blue-border); color: var(--blue); }
    .sp-callout.warn  { background: var(--amber-bg); border: 1px solid var(--amber-border); color: var(--amber); }
    .sp-callout.success { background: var(--green-bg); border: 1px solid var(--green-border); color: var(--green); }

    /* ── Action bar ── */
    .sp-action-bar { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-lg); box-shadow: var(--shadow); padding: 14px 20px; display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-top: 20px; flex-wrap: wrap; }
    .sp-action-bar-left { font-size: 12.5px; color: var(--text-hint); display: flex; align-items: center; gap: 6px; }
    .sp-action-bar-right { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
    .sp-btn { display: inline-flex; align-items: center; gap: 6px; border-radius: var(--radius-md); padding: 8px 16px; font-size: 13.5px; font-weight: 600; font-family: var(--font); cursor: pointer; text-decoration: none; transition: all .15s; white-space: nowrap; border: 1px solid transparent; }
    .sp-btn-primary { background: var(--navy); color: #fff; border-color: var(--navy-hover); box-shadow: 0 1px 3px rgba(48,61,137,.2); }
    .sp-btn-primary:hover { background: var(--navy-hover); color: #fff; }
    .sp-btn-secondary { background: var(--surface); color: var(--text-primary); border-color: var(--border); }
    .sp-btn-secondary:hover { background: var(--bg); border-color: var(--border-hover); }
    .sp-btn-ghost { background: transparent; color: var(--navy); border-color: var(--navy-border); }
    .sp-btn-ghost:hover { background: var(--navy-light); }
    .sp-btn-sm { height: 32px; padding: 0 12px; font-size: 12.5px; }

    /* Channel tab panels */
    .sp-channel-panel { display: none; }
    .sp-channel-panel.active { display: block; }

    /* Test modal */
    .sp-modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.45); z-index: 1000; align-items: center; justify-content: center; padding: 20px; }
    .sp-modal-overlay.open { display: flex; }
    .sp-modal { background: var(--surface); border-radius: var(--radius-lg); box-shadow: 0 20px 60px rgba(0,0,0,.2); width: 100%; max-width: 440px; overflow: hidden; animation: mIn .18s ease; }
    @keyframes mIn { from { opacity:0; transform:translateY(-10px); } to { opacity:1; transform:none; } }
    .sp-modal-header { padding: 14px 20px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
    .sp-modal-title { font-size: 14px; font-weight: 650; margin: 0; }
    .sp-modal-close { width: 28px; height: 28px; border-radius: var(--radius-sm); border: none; background: var(--bg); color: var(--text-hint); cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 13px; }
    .sp-modal-body   { padding: 20px; }
    .sp-modal-footer { padding: 12px 20px; border-top: 1px solid var(--border); display: flex; justify-content: flex-end; gap: 8px; }

    @media(max-width:768px) { .sp-page { padding: 16px; } }
    </style>

    <div class="app-content content container-fluid">
        <div class="sp-page">

            <!-- Page header -->
            <div class="sp-page-header">
                <div>
                    <h1 class="sp-page-title">Message Templates</h1>
                    <div class="sp-crumb">
                        <a href="#">Dashboard</a>
                        <span class="sp-crumb-sep">›</span>
                        <a href="#">Admin Settings</a>
                        <span class="sp-crumb-sep">›</span>
                        <span>Message Templates</span>
                    </div>
                </div>
                <div style="display:flex;gap:8px;flex-wrap:wrap">
                    <button class="sp-btn sp-btn-secondary" onclick="openTestModal()">
                        <i class="fa fa-paper-plane"></i> Send Test
                    </button>
                    <button class="sp-btn sp-btn-primary" onclick="saveSmsTemplate()">
                        <i class="fa fa-save"></i> Save Template
                    </button>
                </div>
            </div>

            <!-- ── Channel tabs ── -->
            <div class="sp-channel-tabs">
                <button class="sp-channel-tab sms active" onclick="switchChannel('sms',this)">
                    <i class="fa fa-comment-dots"></i> SMS Templates
                </button>
                <button class="sp-channel-tab email" onclick="switchChannel('email',this)">
                    <i class="fa fa-envelope"></i> Email Templates
                </button>
                {{-- <button class="sp-channel-tab whatsapp" onclick="switchChannel('whatsapp',this)">
                    <i class="fa-brands fa-whatsapp"></i> WhatsApp Templates
                </button> --}}
            </div>

            {{-- ══════════════════════════════════════
                 SMS CHANNEL PANEL — fully dynamic
            ══════════════════════════════════════ --}}
            <div class="sp-channel-panel active" id="panel-sms">
                <div class="sp-tpl-layout">

                    {{-- ── Left sidenav — rendered from $meta / $templates ── --}}
                    <div class="sp-sidenav">
                        <div class="sp-sidenav-header">
                            <div class="sp-sidenav-label">SMS Template Events</div>
                        </div>

                        @php $firstKey = true; @endphp
                        @foreach (\App\Models\SmsTemplate::$eventKeys as $evKey)
                            @php
                                $tpl    = $templates[$evKey] ?? null;
                                $m      = $meta[$evKey];
                                $badge  = $tpl ? $tpl->navBadge() : ['class' => 'off-badge', 'label' => 'Off'];
                            @endphp
                            <div class="sp-sidenav-item {{ $firstKey ? 'active' : '' }}"
                                 onclick="switchSmsTemplate('{{ $evKey }}', this)"
                                 data-event="{{ $evKey }}">
                                <i class="{{ $m['icon'] }}"></i>
                                {{ $m['label'] }}
                                <span class="sp-sidenav-badge {{ $badge['class'] }}" id="nav-badge-{{ $evKey }}">
                                    {{ $badge['label'] }}
                                </span>
                            </div>
                            @php $firstKey = false; @endphp
                        @endforeach
                    </div>

                    {{-- ── Right panels — one per event key ── --}}
                    <div id="sms-panels-container">

                        @foreach (\App\Models\SmsTemplate::$eventKeys as $evKey)
                            @php
                                $tpl         = $templates[$evKey] ?? null;
                                $m           = $meta[$evKey];
                                $isEnabled   = $tpl?->enabled ?? false;
                                $dltId       = $tpl?->dlt_template_id ?? '';
                                $tplType     = $tpl?->template_type ?? $m['default_type'];
                                $body        = $tpl?->body ?? $m['default_body'];
                                $extra       = $tpl?->extra_settings ?? [];
                                $isFirst     = $evKey === \App\Models\SmsTemplate::$eventKeys[0];
                                $statusHtml  = $tpl ? $tpl->statusBadgeHtml() : '<span style="font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px;background:var(--bg);color:var(--text-hint);border:1px solid var(--border)">Off</span>';
                            @endphp

                            <div class="sp-panel sms-event-panel"
                                 id="sms-panel-{{ $evKey }}"
                                 style="{{ $isFirst ? '' : 'display:none' }}"
                                 data-event="{{ $evKey }}">

                                {{-- Panel header --}}
                                <div class="sp-panel-header">
                                    <div>
                                        <p class="sp-panel-title">
                                            <i class="{{ $m['icon'] }}" style="margin-right:7px;color:var(--navy)"></i>
                                            {{ $m['label'] }} Template
                                        </p>
                                        <p class="sp-panel-desc">{{ $m['desc'] }}</p>
                                    </div>
                                    {!! $statusHtml !!}
                                </div>

                                <div class="sp-panel-body">

                                    {{-- ── PROVIDER BAR (read-only, from SMS Settings) ── --}}
                                    <div class="sp-provider-bar">
                                        <div class="sp-provider-bar-group">
                                            <div>
                                                <div class="sp-provider-bar-item-label">Active Provider</div>
                                                <div class="sp-provider-bar-item-val">
                                                    {{ $smsSettings?->provider
                                                        ? strtoupper($smsSettings->provider)
                                                        : '— Not configured —' }}
                                                </div>
                                            </div>
                                            <div>
                                                <div class="sp-provider-bar-item-label">Sender ID</div>
                                                <div class="sp-provider-bar-item-val">
                                                    {{ $smsSettings?->sender_id ?? '— Not set —' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sp-provider-bar-note">
                                            <i class="fa fa-lock" style="font-size:11px"></i>
                                            Managed in <a href="{{ route('admin.admin-setting.index', ['tab' => 'sms']) }}"
                                                          style="color:var(--navy);font-weight:600">SMS Settings</a>
                                        </div>
                                    </div>

                                    {{-- ── Status toggle ── --}}
                                    <div class="sp-status-bar {{ $isEnabled ? '' : 'inactive' }}"
                                         id="status-bar-{{ $evKey }}">
                                        <div>
                                            <div class="sp-status-bar-text" id="status-text-{{ $evKey }}">
                                                @if($isEnabled)
                                                    <i class="fa fa-check-circle" style="margin-right:6px"></i>Template is active
                                                @else
                                                    Template is disabled
                                                @endif
                                            </div>
                                            <div class="sp-status-bar-sub" id="status-sub-{{ $evKey }}">
                                                @if($isEnabled)
                                                    SMS will be sent on every trigger for this event
                                                @else
                                                    Enable to activate this SMS event
                                                @endif
                                            </div>
                                        </div>
                                        <label class="sp-switch">
                                            <input type="checkbox"
                                                   id="enabled-{{ $evKey }}"
                                                   {{ $isEnabled ? 'checked' : '' }}
                                                   onchange="toggleSmsStatus('{{ $evKey }}', this)">
                                            <span class="sp-switch-track"></span>
                                        </label>
                                    </div>

                                    {{-- Promotional warning --}}
                                    @if(in_array($evKey, ['coupon', 'abandoned-cart', 'promotional']))
                                        <div class="sp-callout warn">
                                            <i class="fa fa-exclamation-triangle"></i>
                                            <span>Promotional SMSes require DND scrubbing and are governed by TRAI regulations. Ensure proper consent before enabling.</span>
                                        </div>
                                    @endif

                                    {{-- ── DLT Template ID + Template Type ── --}}
                                    <div class="sp-grid-2" style="margin-bottom:20px">
                                        <div class="sp-field" style="margin:0">
                                            <label class="sp-label">
                                                DLT Template ID <span class="sp-req">*</span>
                                            </label>
                                            <input type="text"
                                                   class="sp-input"
                                                   id="dlt-id-{{ $evKey }}"
                                                   value="{{ old('dlt_template_id', $dltId) }}"
                                                   placeholder="18-digit DLT Template ID">
                                            <div class="sp-help">Mandatory for India — register on TRAI DLT portal</div>
                                        </div>
                                        <div class="sp-field" style="margin:0">
                                            <label class="sp-label">Template Type</label>
                                            <select class="sp-select" id="tpl-type-{{ $evKey }}">
                                                @foreach(['transactional' => 'Transactional'] as $val => $label)
                                                    <option value="{{ $val }}" {{ $tplType === $val ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="sp-help">Use Transactional for OTP and order alerts</div>
                                        </div>
                                    </div>

                                    <hr class="sp-divider">

                                    {{-- ── Template Body ── --}}
                                    <div class="sp-field">
                                        <label class="sp-label">
                                            Template Body <span class="sp-req">*</span>
                                            <span class="sp-label-badge sms-badge">SMS</span>
                                        </label>
                                        <div class="sp-callout info">
                                            <i class="fa fa-info-circle"></i>
                                            <span>Click variable chips below to insert placeholders at cursor. The exact variable text must match your DLT-registered template.</span>
                                        </div>
                                        <div class="sp-editor-wrap">
                                            <div class="sp-editor-toolbar" id="toolbar-{{ $evKey }}">
                                                <span style="font-size:11.5px;font-weight:650;color:var(--text-hint);margin-right:4px">Insert:</span>
                                                @foreach($m['vars'] as $varKey => $varLabel)
                                                    <span class="sp-var-chip"
                                                          title="{{ $varLabel }}"
                                                          onclick="insertSmsVar('body-{{ $evKey }}', '{{ $varKey }}')">
                                                        <i class="fa fa-code" style="font-size:10px"></i>{{ $varKey }}
                                                    </span>
                                                @endforeach
                                            </div>
                                            <textarea class="sp-editor-area"
                                                      id="body-{{ $evKey }}"
                                                      oninput="updateSmsCharCount('{{ $evKey }}'); updateSmsPreview('{{ $evKey }}')">{{ old('body', $body) }}</textarea>
                                        </div>
                                        <div style="display:flex;justify-content:space-between;margin-top:5px">
                                            <div class="sp-help" id="char-count-{{ $evKey }}">0 chars</div>
                                            <div class="sp-help" id="char-status-{{ $evKey }}"></div>
                                        </div>
                                    </div>

                                    {{-- ── Variable chips ── --}}
                                    <div class="sp-var-section" style="margin-bottom:20px">
                                        <div class="sp-var-title">
                                            <i class="fa fa-code"></i> Available Variables — click to insert at cursor
                                        </div>
                                        <div class="sp-var-chips">
                                            @foreach($m['vars'] as $varKey => $varLabel)
                                                <span class="sp-var-chip"
                                                      title="{{ $varLabel }}"
                                                      onclick="insertSmsVar('body-{{ $evKey }}', '{{ $varKey }}')">
                                                    <i class="fa fa-hashtag" style="font-size:10px"></i>{{ $varKey }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>

                                    {{-- ── Live SMS Preview ── --}}
                                    <div class="sp-field" style="margin-bottom:20px">
                                        <label class="sp-label"><i class="fa fa-eye" style="margin-right:5px"></i>Live Preview</label>
                                        <div class="sp-preview-wrap">
                                            <div class="sp-preview-header">
                                                <span class="sp-preview-label"><i class="fa fa-mobile-alt"></i>SMS Preview</span>
                                                <span style="font-size:11.5px;color:var(--text-hint)">Sample data applied</span>
                                            </div>
                                            <div class="sp-preview-body">
                                                <div class="sp-sms-sender">
                                                    {{ $smsSettings?->sender_id ?? 'SENDER' }}
                                                </div>
                                                <div class="sp-sms-bubble" id="preview-bubble-{{ $evKey }}">
                                                    {{-- Populated by JS on load --}}
                                                </div>
                                                <div class="sp-sms-char-count" id="preview-stats-{{ $evKey }}"></div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- ── Event-specific extras ── --}}
                                    @if($m['extras'] === 'otp')
                                        <hr class="sp-divider">
                                        <div class="sp-grid-3">
                                            <div class="sp-field" style="margin:0">
                                                <label class="sp-label">OTP Length</label>
                                                <select class="sp-select" id="otp-length-{{ $evKey }}">
                                                    @foreach([4,6,8] as $len)
                                                        <option value="{{ $len }}"
                                                            {{ ($extra['otp_length'] ?? 6) == $len ? 'selected' : '' }}>
                                                            {{ $len }} digits
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="sp-field" style="margin:0">
                                                <label class="sp-label">OTP Expiry (min)</label>
                                                <input type="number" class="sp-input"
                                                       id="otp-expiry-{{ $evKey }}"
                                                       value="{{ $extra['otp_expiry'] ?? 10 }}"
                                                       min="1" max="60">
                                            </div>
                                            <div class="sp-field" style="margin:0">
                                                <label class="sp-label">Max Retry Attempts</label>
                                                <input type="number" class="sp-input"
                                                       id="otp-retries-{{ $evKey }}"
                                                       value="{{ $extra['max_retries'] ?? 3 }}"
                                                       min="1" max="10">
                                            </div>
                                        </div>
                                    @endif

                                    @if($m['extras'] === 'abandoned-cart')
                                        <hr class="sp-divider">
                                        <div class="sp-field">
                                            <label class="sp-label">Delay After Abandonment</label>
                                            <select class="sp-select" id="cart-delay-{{ $evKey }}" style="width:200px">
                                                @foreach(['30min' => '30 minutes', '1h' => '1 hour', '2h' => '2 hours', '6h' => '6 hours', '24h' => '24 hours'] as $val => $label)
                                                    <option value="{{ $val }}"
                                                        {{ ($extra['delay'] ?? '1h') === $val ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="sp-help">Wait time before sending the recovery SMS</div>
                                        </div>
                                    @endif

                                    {{-- ── Save button (per panel) ── --}}
                                    <hr class="sp-divider">
                                    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px">
                                        <div class="sp-help" id="save-note-{{ $evKey }}" style="display:flex;align-items:center;gap:5px">
                                            <i class="fa fa-info-circle"></i> Unsaved changes
                                        </div>
                                        <div style="display:flex;gap:8px">
                                            <button type="button"
                                                    class="sp-btn sp-btn-secondary sp-btn-sm"
                                                    onclick="openSmsTestModal('{{ $evKey }}')">
                                                <i class="fa fa-paper-plane"></i> Send Test
                                            </button>
                                            <button type="button"
                                                    class="sp-btn sp-btn-primary sp-btn-sm"
                                                    onclick="saveSmsTemplateFor('{{ $evKey }}')">
                                                <i class="fa fa-save"></i> Save Template
                                            </button>
                                        </div>
                                    </div>

                                </div>{{-- /sp-panel-body --}}
                            </div>{{-- /sp-panel --}}
                        @endforeach

                    </div>{{-- /sms-panels-container --}}
                </div>{{-- /sp-tpl-layout --}}
            </div>{{-- /panel-sms --}}

            {{-- ══════════════════════════════════════
                 EMAIL CHANNEL PANEL — unchanged
            ══════════════════════════════════════ --}}
            <div class="sp-channel-panel" id="panel-email">
                <div class="sp-tpl-layout">
                    <div class="sp-sidenav">
                        <div class="sp-sidenav-header"><div class="sp-sidenav-label">Email Template Events</div></div>
                        <div class="sp-sidenav-item active" onclick="switchEmailTemplate('welcome',this)"><i class="fa fa-star"></i>Welcome Email<span class="sp-sidenav-badge active-badge">On</span></div>
                        <div class="sp-sidenav-item" onclick="switchEmailTemplate('order-placed',this)"><i class="fa fa-shopping-bag"></i>Order Confirmation<span class="sp-sidenav-badge active-badge">On</span></div>
                        <div class="sp-sidenav-item" onclick="switchEmailTemplate('order-shipped',this)"><i class="fa fa-truck"></i>Order Shipped<span class="sp-sidenav-badge active-badge">On</span></div>
                        <div class="sp-sidenav-item" onclick="switchEmailTemplate('order-delivered',this)"><i class="fa fa-box-open"></i>Order Delivered<span class="sp-sidenav-badge active-badge">On</span></div>
                        <div class="sp-sidenav-item" onclick="switchEmailTemplate('order-cancelled',this)"><i class="fa fa-times-circle"></i>Order Cancelled<span class="sp-sidenav-badge active-badge">On</span></div>
                        <div class="sp-sidenav-item" onclick="switchEmailTemplate('payment-success',this)"><i class="fa fa-receipt"></i>Payment Receipt<span class="sp-sidenav-badge active-badge">On</span></div>
                        <div class="sp-sidenav-item" onclick="switchEmailTemplate('payment-failed',this)"><i class="fa fa-exclamation-circle"></i>Payment Failed<span class="sp-sidenav-badge draft-badge">Draft</span></div>
                        <div class="sp-sidenav-item" onclick="switchEmailTemplate('refund',this)"><i class="fa fa-undo"></i>Refund Processed<span class="sp-sidenav-badge active-badge">On</span></div>
                        <div class="sp-sidenav-item" onclick="switchEmailTemplate('return',this)"><i class="fa fa-reply"></i>Return Approved<span class="sp-sidenav-badge active-badge">On</span></div>
                        <div class="sp-sidenav-item" onclick="switchEmailTemplate('password-reset',this)"><i class="fa fa-key"></i>Password Reset<span class="sp-sidenav-badge active-badge">On</span></div>
                        <div class="sp-sidenav-item" onclick="switchEmailTemplate('newsletter',this)"><i class="fa fa-newspaper"></i>Newsletter<span class="sp-sidenav-badge off-badge">Off</span></div>
                        <div class="sp-sidenav-item" onclick="switchEmailTemplate('review',this)"><i class="fa fa-star-half-alt"></i>Review Request<span class="sp-sidenav-badge off-badge">Off</span></div>
                    </div>

                    <div>
                        <div class="sp-panel" id="email-welcome">
                            <div class="sp-panel-header">
                                <div>
                                    <p class="sp-panel-title"><i class="fa fa-star" style="margin-right:7px;color:var(--blue)"></i>Welcome Email Template</p>
                                    <p class="sp-panel-desc">Sent automatically when a new customer registers on the store.</p>
                                </div>
                                <span style="font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px;background:var(--green-bg);color:var(--green);border:1px solid var(--green-border)"><i class="fa fa-circle" style="font-size:7px;margin-right:4px"></i>Active</span>
                            </div>
                            <div class="sp-panel-body">
                                <div class="sp-status-bar">
                                    <div><div class="sp-status-bar-text"><i class="fa fa-check-circle" style="margin-right:6px"></i>Template is active</div><div class="sp-status-bar-sub">Welcome email sent on every new registration</div></div>
                                    <label class="sp-switch"><input type="checkbox" checked onchange="toggleStatus(this)"><span class="sp-switch-track"></span></label>
                                </div>
                                <div class="sp-grid-2" style="margin-bottom:20px">
                                    <div class="sp-field" style="margin:0"><label class="sp-label">From Name <span class="sp-req">*</span></label><input type="text" class="sp-input" value="Oudhyana Chikankaari"></div>
                                    <div class="sp-field" style="margin:0"><label class="sp-label">From Email <span class="sp-req">*</span></label><input type="email" class="sp-input" value="noreply@oudhyana.com"></div>
                                </div>
                                <div class="sp-grid-2" style="margin-bottom:20px">
                                    <div class="sp-field" style="margin:0"><label class="sp-label">Reply-To Email</label><input type="email" class="sp-input" value="support@oudhyana.com"></div>
                                    <div class="sp-field" style="margin:0"><label class="sp-label">CC (optional)</label><input type="email" class="sp-input" placeholder="e.g. sales@oudhyana.com"></div>
                                </div>
                                <div class="sp-field" style="margin-bottom:20px">
                                    <label class="sp-label">Email Subject <span class="sp-req">*</span></label>
                                    <input type="text" class="sp-input" value="Welcome to {store_name}, {customer_name}! 🎉">
                                    <div class="sp-help">Supports variables. Emoji supported. Recommended: 40–60 characters.</div>
                                </div>
                                <div class="sp-field" style="margin-bottom:20px">
                                    <label class="sp-label">Preview Text <span class="sp-label-badge email-badge">Gmail / Apple Mail</span></label>
                                    <input type="text" class="sp-input" value="Your account is ready — explore our latest collection!">
                                    <div class="sp-help">Shown as preview below subject in inbox. Keep under 90 characters.</div>
                                </div>
                                <hr class="sp-divider">
                                <div class="sp-field">
                                    <label class="sp-label">Email Body (HTML) <span class="sp-req">*</span><span class="sp-label-badge email-badge">HTML</span></label>
                                    <div class="sp-callout info"><i class="fa fa-info-circle"></i><span>Use full HTML for richly styled emails. Click variables below to insert at cursor. Test on multiple clients before activating.</span></div>
                                    <div class="sp-editor-wrap">
                                        <div class="sp-editor-toolbar">
                                            <button class="sp-tb-btn"><i class="fa fa-bold"></i></button>
                                            <button class="sp-tb-btn"><i class="fa fa-italic"></i></button>
                                            <button class="sp-tb-btn"><i class="fa fa-link"></i></button>
                                            <button class="sp-tb-btn"><i class="fa fa-image"></i></button>
                                            <div class="sp-tb-sep"></div>
                                            <button class="sp-tb-btn"><i class="fa fa-code"></i> Source</button>
                                            <button class="sp-tb-btn"><i class="fa fa-eye"></i> Preview</button>
                                        </div>
                                        <textarea class="sp-editor-area" style="min-height:200px">&lt;p&gt;Hi {customer_name},&lt;/p&gt;
&lt;p&gt;Welcome to &lt;strong&gt;{store_name}&lt;/strong&gt;! We're thrilled to have you with us.&lt;/p&gt;
&lt;p&gt;Your account is now active. Start exploring our handcrafted Chikankari collections.&lt;/p&gt;
&lt;a href="{shop_url}" style="display:inline-block;background:#303d89;color:#fff;padding:12px 28px;border-radius:6px;text-decoration:none;font-weight:600;margin:16px 0"&gt;Shop Now&lt;/a&gt;
&lt;p&gt;Need help? Reply to this email or call {support_number}.&lt;/p&gt;
&lt;p&gt;Warm regards,&lt;br&gt;Team {brand_name}&lt;/p&gt;</textarea>
                                    </div>
                                </div>
                                <div class="sp-var-section" style="margin-bottom:20px">
                                    <div class="sp-var-title"><i class="fa fa-code"></i> Available Variables</div>
                                    <div class="sp-var-chips">
                                        <span class="sp-var-chip">{customer_name}</span><span class="sp-var-chip">{customer_email}</span>
                                        <span class="sp-var-chip">{store_name}</span><span class="sp-var-chip">{brand_name}</span>
                                        <span class="sp-var-chip">{shop_url}</span><span class="sp-var-chip">{support_number}</span>
                                        <span class="sp-var-chip">{login_url}</span><span class="sp-var-chip">{logo_url}</span>
                                        <span class="sp-var-chip">{unsubscribe_url}</span>
                                    </div>
                                </div>
                                <div class="sp-field" style="margin:0">
                                    <label class="sp-label"><i class="fa fa-eye" style="margin-right:5px"></i>Email Preview</label>
                                    <div class="sp-email-preview">
                                        <div class="sp-email-header-bar">
                                            <div><span>From:</span><span>Oudhyana Chikankaari &lt;noreply@oudhyana.com&gt;</span></div>
                                            <div><span>To:</span><span>rahul.sharma@gmail.com</span></div>
                                            <div><span>Sub:</span><span>Welcome to Oudhyana Store, Rahul! 🎉</span></div>
                                        </div>
                                        <div class="sp-email-html-body">
                                            <p>Hi <strong>Rahul</strong>,</p>
                                            <p>Welcome to <strong>Oudhyana Store</strong>! We're thrilled to have you with us.</p>
                                            <p>Your account is now active. Start exploring our handcrafted Chikankari collections.</p>
                                            <a href="#" style="display:inline-block;background:#303d89;color:#fff;padding:12px 28px;border-radius:6px;text-decoration:none;font-weight:600;margin:12px 0" onclick="return false">Shop Now</a>
                                            <p>Need help? Reply to this email or call +91-9876543210.</p>
                                            <p>Warm regards,<br><strong>Team Oudhyana</strong></p>
                                        </div>
                                    </div>
                                </div>
                                <hr class="sp-divider">
                                <div class="sp-grid-2">
                                    <div class="sp-field" style="margin:0"><label class="sp-label">Email Service Provider</label><select class="sp-select"><option selected>SMTP (Custom)</option><option>SendGrid</option><option>Mailgun</option><option>Amazon SES</option></select></div>
                                    <div class="sp-field" style="margin:0"><label class="sp-label">Email Priority</label><select class="sp-select"><option>High</option><option selected>Normal</option><option>Low</option></select></div>
                                </div>
                            </div>
                        </div>

                        <div id="email-order-placed" style="display:none"><div class="sp-panel"><div class="sp-panel-header"><div><p class="sp-panel-title"><i class="fa fa-shopping-bag" style="margin-right:7px;color:var(--blue)"></i>Order Confirmation Email</p><p class="sp-panel-desc">Sent immediately when an order is successfully placed.</p></div></div><div class="sp-panel-body"><div class="sp-grid-2" style="margin-bottom:20px"><div class="sp-field" style="margin:0"><label class="sp-label">Subject <span class="sp-req">*</span></label><input class="sp-input" type="text" value="Your order #{order_id} is confirmed! ✅"></div><div class="sp-field" style="margin:0"><label class="sp-label">Preview Text</label><input class="sp-input" type="text" value="Your order is on its way to fulfilment!"></div></div><div class="sp-field"><label class="sp-label">Email Body <span class="sp-req">*</span></label><div class="sp-editor-wrap"><textarea class="sp-editor-area" style="min-height:160px">&lt;p&gt;Hi {customer_name},&lt;/p&gt;&lt;p&gt;Order #{order_id} of {order_amount} placed on {order_date}. Payment via {payment_method}. Expected: {expected_delivery}.&lt;/p&gt;&lt;a href="{order_url}"&gt;View Order&lt;/a&gt;</textarea></div></div><div class="sp-var-section"><div class="sp-var-title"><i class="fa fa-code"></i>Variables</div><div class="sp-var-chips"><span class="sp-var-chip">{customer_name}</span><span class="sp-var-chip">{order_id}</span><span class="sp-var-chip">{order_amount}</span><span class="sp-var-chip">{order_date}</span><span class="sp-var-chip">{payment_method}</span><span class="sp-var-chip">{expected_delivery}</span><span class="sp-var-chip">{order_url}</span><span class="sp-var-chip">{brand_name}</span></div></div></div></div></div>
                        <div id="email-order-shipped" style="display:none"><div class="sp-panel"><div class="sp-panel-header"><div><p class="sp-panel-title"><i class="fa fa-truck" style="margin-right:7px;color:var(--blue)"></i>Order Shipped Email</p></div></div><div class="sp-panel-body"><div class="sp-field"><label class="sp-label">Subject</label><input class="sp-input" type="text" value="Your order #{order_id} is on the way 🚚"></div><div class="sp-field"><label class="sp-label">Email Body</label><div class="sp-editor-wrap"><textarea class="sp-editor-area">&lt;p&gt;Hi {customer_name},&lt;/p&gt;&lt;p&gt;Order #{order_id} shipped via {courier_name}. Track with AWB: {awb_number} at {tracking_url}. Expected: {expected_delivery}.&lt;/p&gt;</textarea></div></div><div class="sp-var-section"><div class="sp-var-title"><i class="fa fa-code"></i>Variables</div><div class="sp-var-chips"><span class="sp-var-chip">{customer_name}</span><span class="sp-var-chip">{order_id}</span><span class="sp-var-chip">{courier_name}</span><span class="sp-var-chip">{awb_number}</span><span class="sp-var-chip">{tracking_url}</span><span class="sp-var-chip">{expected_delivery}</span></div></div></div></div></div>
                        <div id="email-order-delivered" style="display:none"><div class="sp-panel"><div class="sp-panel-header"><div><p class="sp-panel-title"><i class="fa fa-box-open" style="margin-right:7px;color:var(--blue)"></i>Order Delivered Email</p></div></div><div class="sp-panel-body"><div class="sp-field"><label class="sp-label">Subject</label><input class="sp-input" type="text" value="Your order #{order_id} has arrived! ⭐"></div><div class="sp-field"><label class="sp-label">Email Body</label><div class="sp-editor-wrap"><textarea class="sp-editor-area">&lt;p&gt;Hi {customer_name}, your order is delivered! Rate your experience: {review_url}&lt;/p&gt;</textarea></div></div><div class="sp-var-section"><div class="sp-var-title"><i class="fa fa-code"></i>Variables</div><div class="sp-var-chips"><span class="sp-var-chip">{customer_name}</span><span class="sp-var-chip">{order_id}</span><span class="sp-var-chip">{review_url}</span></div></div></div></div></div>
                        <div id="email-order-cancelled" style="display:none"><div class="sp-panel"><div class="sp-panel-header"><div><p class="sp-panel-title"><i class="fa fa-times-circle" style="margin-right:7px;color:var(--red)"></i>Order Cancelled Email</p></div></div><div class="sp-panel-body"><div class="sp-field"><label class="sp-label">Subject</label><input class="sp-input" type="text" value="Your order #{order_id} has been cancelled"></div><div class="sp-field"><label class="sp-label">Email Body</label><div class="sp-editor-wrap"><textarea class="sp-editor-area">&lt;p&gt;Hi {customer_name}, order #{order_id} cancelled. Refund of {refund_amount} in {refund_days} days.&lt;/p&gt;</textarea></div></div><div class="sp-var-section"><div class="sp-var-title"><i class="fa fa-code"></i>Variables</div><div class="sp-var-chips"><span class="sp-var-chip">{customer_name}</span><span class="sp-var-chip">{order_id}</span><span class="sp-var-chip">{cancel_reason}</span><span class="sp-var-chip">{refund_amount}</span><span class="sp-var-chip">{refund_days}</span></div></div></div></div></div>
                        <div id="email-payment-success" style="display:none"><div class="sp-panel"><div class="sp-panel-header"><div><p class="sp-panel-title"><i class="fa fa-receipt" style="margin-right:7px;color:var(--blue)"></i>Payment Receipt Email</p></div></div><div class="sp-panel-body"><div class="sp-field"><label class="sp-label">Subject</label><input class="sp-input" type="text" value="Payment receipt for order #{order_id}"></div><div class="sp-field"><label class="sp-label">Email Body</label><div class="sp-editor-wrap"><textarea class="sp-editor-area">&lt;p&gt;Payment of {payment_amount} received. Transaction ID: {transaction_id}. Download invoice: {invoice_url}&lt;/p&gt;</textarea></div></div><div class="sp-var-section"><div class="sp-var-title"><i class="fa fa-code"></i>Variables</div><div class="sp-var-chips"><span class="sp-var-chip">{payment_amount}</span><span class="sp-var-chip">{transaction_id}</span><span class="sp-var-chip">{invoice_url}</span><span class="sp-var-chip">{order_id}</span></div></div></div></div></div>
                        <div id="email-payment-failed" style="display:none"><div class="sp-panel"><div class="sp-panel-header"><div><p class="sp-panel-title"><i class="fa fa-exclamation-circle" style="margin-right:7px;color:var(--red)"></i>Payment Failed Email</p></div><span style="font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px;background:var(--amber-bg);color:var(--amber);border:1px solid var(--amber-border)">Draft</span></div><div class="sp-panel-body"><div class="sp-field"><label class="sp-label">Subject</label><input class="sp-input" type="text" value="Action needed: Payment failed for order #{order_id}"></div><div class="sp-field"><label class="sp-label">Email Body</label><div class="sp-editor-wrap"><textarea class="sp-editor-area">&lt;p&gt;Hi {customer_name}, payment of {payment_amount} for order #{order_id} failed. Please retry at {retry_url}.&lt;/p&gt;</textarea></div></div><div class="sp-var-section"><div class="sp-var-title"><i class="fa fa-code"></i>Variables</div><div class="sp-var-chips"><span class="sp-var-chip">{customer_name}</span><span class="sp-var-chip">{payment_amount}</span><span class="sp-var-chip">{order_id}</span><span class="sp-var-chip">{retry_url}</span></div></div></div></div></div>
                        <div id="email-refund" style="display:none"><div class="sp-panel"><div class="sp-panel-header"><div><p class="sp-panel-title"><i class="fa fa-undo" style="margin-right:7px;color:var(--blue)"></i>Refund Processed Email</p></div></div><div class="sp-panel-body"><div class="sp-field"><label class="sp-label">Email Body</label><div class="sp-editor-wrap"><textarea class="sp-editor-area">&lt;p&gt;Hi {customer_name}, refund of {refund_amount} for order #{order_id} processed. Reflects in {refund_days} days via {refund_method}.&lt;/p&gt;</textarea></div></div><div class="sp-var-section"><div class="sp-var-title"><i class="fa fa-code"></i>Variables</div><div class="sp-var-chips"><span class="sp-var-chip">{customer_name}</span><span class="sp-var-chip">{refund_amount}</span><span class="sp-var-chip">{order_id}</span><span class="sp-var-chip">{refund_days}</span><span class="sp-var-chip">{refund_method}</span></div></div></div></div></div>
                        <div id="email-return" style="display:none"><div class="sp-panel"><div class="sp-panel-header"><div><p class="sp-panel-title"><i class="fa fa-reply" style="margin-right:7px;color:var(--blue)"></i>Return Approved Email</p></div></div><div class="sp-panel-body"><div class="sp-field"><label class="sp-label">Email Body</label><div class="sp-editor-wrap"><textarea class="sp-editor-area">&lt;p&gt;Hi {customer_name}, return #{return_id} approved! Pickup on {pickup_date}. Refund {refund_amount} in {refund_days} days.&lt;/p&gt;</textarea></div></div><div class="sp-var-section"><div class="sp-var-title"><i class="fa fa-code"></i>Variables</div><div class="sp-var-chips"><span class="sp-var-chip">{customer_name}</span><span class="sp-var-chip">{return_id}</span><span class="sp-var-chip">{pickup_date}</span><span class="sp-var-chip">{refund_amount}</span></div></div></div></div></div>
                        <div id="email-password-reset" style="display:none"><div class="sp-panel"><div class="sp-panel-header"><div><p class="sp-panel-title"><i class="fa fa-key" style="margin-right:7px;color:var(--blue)"></i>Password Reset Email</p></div></div><div class="sp-panel-body"><div class="sp-callout warn"><i class="fa fa-exclamation-triangle"></i><span>Password reset emails are security-critical. Ensure the reset link includes a short-lived token (max 15 minutes). Never include the password in the email body.</span></div><div class="sp-field"><label class="sp-label">Subject</label><input class="sp-input" type="text" value="Reset your {store_name} password"></div><div class="sp-field"><label class="sp-label">Email Body</label><div class="sp-editor-wrap"><textarea class="sp-editor-area">&lt;p&gt;Hi {customer_name}, click below to reset your password. Link expires in {expiry_minutes} minutes.&lt;/p&gt;&lt;a href="{reset_url}" style="background:#303d89;color:#fff;padding:12px 24px;border-radius:6px;display:inline-block;text-decoration:none"&gt;Reset Password&lt;/a&gt;&lt;p&gt;Ignore if you didn't request this.&lt;/p&gt;</textarea></div></div><div class="sp-var-section"><div class="sp-var-title"><i class="fa fa-code"></i>Variables</div><div class="sp-var-chips"><span class="sp-var-chip">{customer_name}</span><span class="sp-var-chip">{reset_url}</span><span class="sp-var-chip">{expiry_minutes}</span><span class="sp-var-chip">{store_name}</span></div></div></div></div></div>
                        <div id="email-newsletter" style="display:none"><div class="sp-panel"><div class="sp-panel-header"><div><p class="sp-panel-title"><i class="fa fa-newspaper" style="margin-right:7px;color:var(--blue)"></i>Newsletter Template</p></div><span style="font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px;background:var(--bg);color:var(--text-hint);border:1px solid var(--border)">Off</span></div><div class="sp-panel-body"><div class="sp-field"><label class="sp-label">Subject</label><input class="sp-input" type="text" placeholder="{month} highlights from {store_name}"></div><div class="sp-field"><label class="sp-label">Email Body</label><div class="sp-editor-wrap"><textarea class="sp-editor-area" style="min-height:160px">&lt;p&gt;Hi {customer_name},&lt;/p&gt;&lt;p&gt;This month's highlights from {store_name}...&lt;/p&gt;&lt;p&gt;&lt;a href="{unsubscribe_url}"&gt;Unsubscribe&lt;/a&gt;&lt;/p&gt;</textarea></div></div><div class="sp-var-section"><div class="sp-var-title"><i class="fa fa-code"></i>Variables</div><div class="sp-var-chips"><span class="sp-var-chip">{customer_name}</span><span class="sp-var-chip">{store_name}</span><span class="sp-var-chip">{month}</span><span class="sp-var-chip">{unsubscribe_url}</span></div></div></div></div></div>
                        <div id="email-review" style="display:none"><div class="sp-panel"><div class="sp-panel-header"><div><p class="sp-panel-title"><i class="fa fa-star-half-alt" style="margin-right:7px;color:var(--blue)"></i>Review Request Email</p></div><span style="font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px;background:var(--bg);color:var(--text-hint);border:1px solid var(--border)">Off</span></div><div class="sp-panel-body"><div class="sp-field"><label class="sp-label">Send Delay After Delivery</label><select class="sp-select" style="width:200px"><option>1 day</option><option selected>3 days</option><option>7 days</option></select></div><div class="sp-field"><label class="sp-label">Email Body</label><div class="sp-editor-wrap"><textarea class="sp-editor-area">&lt;p&gt;Hi {customer_name}, how did you find your {product_name}? Leave a quick review: {review_url}&lt;/p&gt;</textarea></div></div><div class="sp-var-section"><div class="sp-var-title"><i class="fa fa-code"></i>Variables</div><div class="sp-var-chips"><span class="sp-var-chip">{customer_name}</span><span class="sp-var-chip">{product_name}</span><span class="sp-var-chip">{review_url}</span><span class="sp-var-chip">{order_id}</span></div></div></div></div></div>
                    </div>
                </div>
            </div>

            {{-- WhatsApp panel unchanged (omitted for brevity — paste from original) --}}

            <!-- Action bar -->
            <div class="sp-action-bar">
                <div class="sp-action-bar-left">
                    <i class="fa fa-info-circle"></i>
                    Changes save per template. Switch tabs to edit other channels.
                </div>
                <div class="sp-action-bar-right">
                    <button class="sp-btn sp-btn-secondary" onclick="openTestModal()">
                        <i class="fa fa-paper-plane"></i> Send Test
                    </button>
                    <button class="sp-btn sp-btn-secondary" onclick="window.location.reload()">
                        <i class="fa fa-history"></i> Reset to Default
                    </button>
                    <button class="sp-btn sp-btn-primary" onclick="saveSmsTemplate()">
                        <i class="fa fa-save"></i> Save Template
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- ── Send Test Modal ── -->
<div class="sp-modal-overlay" id="testModal">
    <div class="sp-modal">
        <div class="sp-modal-header">
            <h5 class="sp-modal-title"><i class="fa fa-paper-plane" style="margin-right:8px;color:var(--navy)"></i>Send Test SMS</h5>
            <button class="sp-modal-close" onclick="closeModal()"><i class="fa fa-times"></i></button>
        </div>
        <div class="sp-modal-body">
            <div class="sp-callout info"><i class="fa fa-info-circle"></i><span>Test messages use sample variable values. Actual customer data is not used.</span></div>
            <input type="hidden" id="testEventKey" value="">
            <div class="sp-field">
                <label class="sp-label">Mobile Number <span class="sp-req">*</span></label>
                <input type="text" class="sp-input" id="testMobile" placeholder="+91 98765 43210">
            </div>
        </div>
        <div class="sp-modal-footer">
            <button class="sp-btn sp-btn-secondary" onclick="closeModal()">Cancel</button>
            <button class="sp-btn sp-btn-primary" onclick="sendSmsTest()">
                <i class="fa fa-paper-plane"></i> Send Test
            </button>
        </div>
    </div>
</div>

@include('admin.footer')

<script>
/* ════════════════════════════════════════════════
   Sample values for live preview substitution
════════════════════════════════════════════════ */
const SMS_SAMPLE = {
    '{otp}':'847291','{otp_expiry}':'10',
    '{customer_name}':'Rahul','{store_name}':'Oudhyana Store',
    '{brand_name}':'Oudhyana','{website_url}':'oudhyana.com',
    '{order_id}':'ORD-1089','{order_amount}':'₹3,450',
    '{order_date}':'24 Jun 2026','{payment_method}':'UPI',
    '{expected_delivery}':'28 Jun 2026','{tracking_url}':'oudhyana.com/track/1089',
    '{courier_name}':'Delhivery','{awb_number}':'DEL123456789',
    '{review_url}':'oudhyana.com/review/1089','{cancel_reason}':'Out of stock',
    '{refund_amount}':'₹3,450','{refund_days}':'5',
    '{refund_method}':'UPI','{payment_amount}':'₹3,450',
    '{transaction_id}':'TXN8472910','{retry_url}':'oudhyana.com/retry/1089',
    '{support_number}':'+91-9876543210','{return_id}':'RTN-001',
    '{pickup_date}':'26 Jun 2026','{coupon_code}':'SAVE20',
    '{discount_value}':'₹200','{expiry_date}':'30 Jun 2026',
    '{store_url}':'oudhyana.com','{shop_url}':'oudhyana.com/shop',
    '{item_count}':'3','{cart_url}':'oudhyana.com/cart/abc','{discount}':'10',
};

/* ── Channel switcher ── */
function switchChannel(ch, btn) {
    document.querySelectorAll('.sp-channel-tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.sp-channel-panel').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById('panel-' + ch).classList.add('active');
}

/* ── SMS template nav switcher ── */
let activeSmsEvent = '{{ \App\Models\SmsTemplate::$eventKeys[0] }}';

function switchSmsTemplate(evKey, navItem) {
    document.querySelectorAll('#panel-sms .sp-sidenav-item').forEach(i => i.classList.remove('active'));
    navItem.classList.add('active');
    document.getElementById('sms-panel-' + activeSmsEvent).style.display = 'none';
    activeSmsEvent = evKey;
    document.getElementById('sms-panel-' + evKey).style.display = 'block';
}

/* ── Email template switcher (unchanged) ── */
let activeEmailPanel = 'email-welcome';
function switchEmailTemplate(key, navItem) {
    document.querySelectorAll('#panel-email .sp-sidenav-item').forEach(i => i.classList.remove('active'));
    navItem.classList.add('active');
    document.getElementById(activeEmailPanel).style.display = 'none';
    activeEmailPanel = 'email-' + key;
    document.getElementById(activeEmailPanel).style.display = 'block';
}

/* ── Insert variable at cursor ── */
function insertSmsVar(textareaId, variable) {
    const ta = document.getElementById(textareaId);
    if (!ta) return;
    const s = ta.selectionStart, e = ta.selectionEnd;
    ta.value = ta.value.substring(0, s) + variable + ta.value.substring(e);
    ta.selectionStart = ta.selectionEnd = s + variable.length;
    ta.focus();
    const evKey = textareaId.replace('body-', '');
    updateSmsCharCount(evKey);
    updateSmsPreview(evKey);
}

/* ── Char count + part calculation ── */
function updateSmsCharCount(evKey) {
    const ta  = document.getElementById('body-' + evKey);
    if (!ta) return;
    const len   = ta.value.length;
    const parts = len === 0 ? 0 : (len <= 160 ? 1 : Math.ceil(len / 153));
    const cc    = document.getElementById('char-count-' + evKey);
    const cs    = document.getElementById('char-status-' + evKey);
    if (cc) cc.textContent = `${len} chars · ${parts} SMS part${parts !== 1 ? 's' : ''}`;
    if (cs) {
        if (len > 480)      cs.innerHTML = '<span style="color:var(--amber)">Too long — consider splitting</span>';
        else if (len > 160) cs.innerHTML = '<span style="color:var(--amber)">Multi-part SMS</span>';
        else if (len > 0)   cs.innerHTML = '<span style="color:var(--green)">✓ Within 1 SMS</span>';
        else                cs.textContent = '';
    }
}

/* ── Live preview ── */
function updateSmsPreview(evKey) {
    const ta = document.getElementById('body-' + evKey);
    if (!ta) return;
    let preview = ta.value;
    Object.keys(SMS_SAMPLE).forEach(k => {
        preview = preview.split(k).join('<strong>' + SMS_SAMPLE[k] + '</strong>');
    });
    const bubble = document.getElementById('preview-bubble-' + evKey);
    const stats  = document.getElementById('preview-stats-' + evKey);
    if (bubble) bubble.innerHTML = preview || '<em style="color:var(--text-hint)">Template body is empty</em>';
    const len   = ta.value.length;
    const parts = len === 0 ? 0 : (len <= 160 ? 1 : Math.ceil(len / 153));
    if (stats && len > 0) {
        stats.innerHTML = `<span>${len} chars</span><span>${parts} SMS part${parts !== 1 ? 's' : ''}</span>`
            + (len <= 160 ? '<span style="color:var(--green)">✓ Within limit</span>' : '<span style="color:var(--amber)">Multi-part</span>');
    } else if (stats) {
        stats.innerHTML = '';
    }
}

/* ── Status bar toggle ── */
function toggleSmsStatus(evKey, cb) {
    const bar    = document.getElementById('status-bar-' + evKey);
    const text   = document.getElementById('status-text-' + evKey);
    const sub    = document.getElementById('status-sub-' + evKey);
    if (cb.checked) {
        bar.classList.remove('inactive');
        text.innerHTML = '<i class="fa fa-check-circle" style="margin-right:6px"></i>Template is active';
        sub.textContent = 'SMS will be sent on every trigger for this event';
    } else {
        bar.classList.add('inactive');
        text.textContent = 'Template is disabled';
        sub.textContent  = 'Enable to activate this SMS event';
    }
}

/* Legacy toggleStatus used by email panels */
function toggleStatus(cb) {
    const bar = cb.closest('.sp-status-bar');
    if (cb.checked) {
        bar.classList.remove('inactive');
        bar.querySelector('.sp-status-bar-text').innerHTML = '<i class="fa fa-check-circle" style="margin-right:6px"></i>Template is active';
    } else {
        bar.classList.add('inactive');
        bar.querySelector('.sp-status-bar-text').innerHTML = 'Template is disabled';
    }
}

/* ── Save a single SMS template (AJAX) ── */
function saveSmsTemplateFor(evKey) {
    const payload = {
        _token:          '{{ csrf_token() }}',
        enabled:         document.getElementById('enabled-' + evKey)?.checked ? 1 : 0,
        dlt_template_id: document.getElementById('dlt-id-' + evKey)?.value ?? '',
        template_type:   document.getElementById('tpl-type-' + evKey)?.value ?? 'transactional',
        body:            document.getElementById('body-' + evKey)?.value ?? '',
    };

    // OTP extras
    const otpLen = document.getElementById('otp-length-' + evKey);
    if (otpLen) {
        payload.otp_length  = otpLen.value;
        payload.otp_expiry  = document.getElementById('otp-expiry-' + evKey)?.value;
        payload.max_retries = document.getElementById('otp-retries-' + evKey)?.value;
    }

    // Abandoned cart extras
    const cartDelay = document.getElementById('cart-delay-' + evKey);
    if (cartDelay) {
        payload.cart_delay = cartDelay.value;
    }

    const note = document.getElementById('save-note-' + evKey);
    if (note) note.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Saving…';

    fetch(`{{ url('admin/settings/templates') }}/${evKey}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify(payload),
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            if (note) note.innerHTML = '<i class="fa fa-check-circle" style="color:var(--green)"></i> <span style="color:var(--green)">Saved</span>';
            updateNavBadge(evKey, payload.enabled, payload.body);
            Swal.fire({ icon: 'success', title: 'Template Saved!', text: data.message, timer: 1800, showConfirmButton: false });
        } else {
            if (note) note.innerHTML = '<i class="fa fa-exclamation-circle" style="color:var(--red)"></i> <span style="color:var(--red)">Error saving</span>';
            Swal.fire({ icon: 'error', title: 'Error', text: data.message, confirmButtonColor: '#303d89' });
        }
    })
    .catch(() => {
        if (note) note.innerHTML = '<i class="fa fa-exclamation-circle" style="color:var(--red)"></i> <span style="color:var(--red)">Network error</span>';
        Swal.fire({ icon: 'error', title: 'Network Error', text: 'Could not reach the server.', confirmButtonColor: '#303d89' });
    });
}

/* Save button in page header saves whichever SMS panel is active */
function saveSmsTemplate() {
    saveSmsTemplateFor(activeSmsEvent);
}

/* ── Update nav badge after save ── */
function updateNavBadge(evKey, enabled, body) {
    const badge = document.getElementById('nav-badge-' + evKey);
    if (!badge) return;
    badge.className = 'sp-sidenav-badge';
    if (enabled) {
        badge.className += ' active-badge'; badge.textContent = 'On';
    } else if (body && body.trim()) {
        badge.className += ' draft-badge'; badge.textContent = 'Draft';
    } else {
        badge.className += ' off-badge'; badge.textContent = 'Off';
    }
}

/* ── Test modal ── */
function openTestModal()              { openSmsTestModal(activeSmsEvent); }
function openSmsTestModal(evKey)      { document.getElementById('testEventKey').value = evKey; document.getElementById('testModal').classList.add('open'); }
function closeModal()                 { document.getElementById('testModal').classList.remove('open'); }
document.getElementById('testModal').addEventListener('click', function(e) { if (e.target === this) closeModal(); });

function sendSmsTest() {
    const mobile  = document.getElementById('testMobile').value.trim();
    const evKey   = document.getElementById('testEventKey').value;
    if (!mobile) { Swal.fire({ icon: 'warning', title: 'Mobile required', text: 'Enter a mobile number to send the test SMS.', confirmButtonColor: '#303d89' }); return; }
    closeModal();
    Swal.fire({ title: 'Sending…', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

    fetch('{{ route('admin.settings.templates.test') }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ event_key: evKey, mobile }),
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            Swal.fire({ icon: 'success', title: 'Test SMS Sent!', text: data.message, timer: 2500, showConfirmButton: false });
        } else {
            Swal.fire({ icon: 'error', title: 'Failed', text: data.message, confirmButtonColor: '#303d89' });
        }
    })
    .catch(() => {
        Swal.fire({ icon: 'error', title: 'Error', text: 'Something went wrong. Please try again.', confirmButtonColor: '#303d89' });
    });
}

/* ── Init: populate char counts and previews for all event panels ── */
document.addEventListener('DOMContentLoaded', function () {
    @foreach (\App\Models\SmsTemplate::$eventKeys as $evKey)
        updateSmsCharCount('{{ $evKey }}');
        updateSmsPreview('{{ $evKey }}');
    @endforeach
});
</script>