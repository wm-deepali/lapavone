@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <style>
    :root {
        --bg:            #f1f2f4;
        --surface:       #ffffff;
        --border:        #e3e5e8;
        --text-primary:  #202223;
        --text-secondary:#6d7175;
        --text-hint:     #8c9196;
        --accent:        #303d89;
        --accent-light:  #f0f1fc;
        --green:         #007a5e;
        --green-bg:      #e3f1ec;
        --blue:          #0069d9;
        --blue-bg:       #e8f2ff;
        --amber:         #916a00;
        --amber-bg:      #fff5cc;
        --radius-sm:     8px;
        --radius-md:     12px;
        --shadow-card:   0 1px 3px rgba(0,0,0,.08), 0 0 0 1px var(--border);
        --font:          'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .home-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); }
    .home-page * { box-sizing: border-box; }

    .page-header { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
    .page-header h1 { font-size: 20px; font-weight: 650; color: var(--text-primary); margin: 0; }
    .crumb { font-size: 12.5px; color: var(--text-hint); margin-top: 3px; }
    .crumb a { color: var(--accent); text-decoration: none; }
    .crumb a:hover { text-decoration: underline; }
    .crumb span { margin: 0 5px; }

    .info-banner {
        background: var(--accent-light);
        border: 1px solid #c7cdf5;
        border-radius: var(--radius-md);
        padding: 12px 18px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        color: var(--accent);
        font-weight: 500;
    }
    .info-banner i { font-size: 15px; flex-shrink: 0; }

    .widget-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
    }
    @media(max-width:960px) { .widget-grid { grid-template-columns: repeat(2,1fr); } }
    @media(max-width:580px)  { .widget-grid { grid-template-columns: 1fr; } }

    .widget-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-card);
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 14px;
        transition: box-shadow .15s, transform .15s;
    }
    .widget-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,.1), 0 0 0 1px var(--border);
        transform: translateY(-2px);
    }

    .widget-icon {
        width: 44px; height: 44px; border-radius: var(--radius-sm);
        display: flex; align-items: center; justify-content: center;
        font-size: 18px; flex-shrink: 0;
    }
    .wi-blue   { background: var(--blue-bg);    color: var(--blue); }
    .wi-green  { background: var(--green-bg);   color: var(--green); }
    .wi-accent { background: var(--accent-light); color: var(--accent); }
    .wi-amber  { background: var(--amber-bg);   color: var(--amber); }

    .widget-head { display: flex; align-items: flex-start; gap: 12px; }
    .widget-num {
        width: 22px; height: 22px; border-radius: 50%; background: var(--bg);
        display: flex; align-items: center; justify-content: center;
        font-size: 11px; font-weight: 700; color: var(--text-hint);
        flex-shrink: 0; margin-top: 2px;
    }
    .widget-title { font-size: 13.5px; font-weight: 650; color: var(--text-primary); line-height: 1.3; }

    .type-badge { display: inline-flex; align-items: center; gap: 4px; font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 20px; margin-top: 4px; }
    .tb-fixed    { background: var(--accent-light); color: var(--accent); }
    .tb-multiple { background: var(--blue-bg);      color: var(--blue); }

    .widget-actions { display: flex; gap: 7px; flex-wrap: wrap; margin-top: auto; }

    .btn-manage {
        display: inline-flex; align-items: center; gap: 5px;
        background: var(--accent); color: #fff !important;
        border: none; border-radius: var(--radius-sm);
        padding: 7px 13px; font-size: 12.5px; font-weight: 600;
        cursor: pointer; text-decoration: none !important;
        font-family: var(--font); transition: background .15s;
        flex: 1; justify-content: center;
    }
    .btn-manage:hover { background: #252f70; }

    @media(max-width:768px) { .home-page { padding: 16px; } }
    </style>

    <div class="app-content content container-fluid">
        <div class="home-page">

            <div class="page-header">
                <div>
                    <h1>Home Page Widgets</h1>
                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        Manage Home Page
                    </div>
                </div>
            </div>

            <div class="info-banner">
                <i class="fa fa-info-circle"></i>
                Manage all homepage sections from here — click <strong>Manage</strong> on any widget to edit its content.
            </div>

            <div class="widget-grid">

                <!-- 1. Hero Section -->
                <div class="widget-card">
                    <div class="widget-head">
                        <div class="widget-icon wi-blue"><i class="fa fa-picture-o"></i></div>
                        <div>
                            <div style="display:flex;align-items:center;gap:8px">
                                <span class="widget-num">1</span>
                                <span class="widget-title">Hero Section</span>
                            </div>
                            <span class="type-badge tb-fixed"><i class="fa fa-minus"></i> Fixed</span>
                        </div>
                    </div>
                    <div style="font-size:12px;color:var(--text-hint)">Full-width background banner with heading text and Shop All / New Arrivals CTAs.</div>
                    <div class="widget-actions">
                        <a href="{{ route('admin.home.hero.edit') }}" class="btn-manage">
                            <i class="fa fa-pencil"></i> Manage
                        </a>
                    </div>
                </div>

    
                <!-- 2. Static Banner 1 -->
                <div class="widget-card">
                    <div class="widget-head">
                        <div class="widget-icon wi-amber"><i class="fa fa-image"></i></div>
                        <div>
                            <div style="display:flex;align-items:center;gap:8px">
                                <span class="widget-num">2</span>
                                <span class="widget-title">Static Banner 1</span>
                            </div>
                            <span class="type-badge tb-fixed"><i class="fa fa-minus"></i> Fixed</span>
                        </div>
                    </div>
                    <div style="font-size:12px;color:var(--text-hint)">Full-width banner with the "Rooted in culture. Designed for today." heading overlay.</div>
                    <div class="widget-actions">
                        <a href="{{ route('admin.home.banner1.edit') }}" class="btn-manage">
                            <i class="fa fa-pencil"></i> Manage
                        </a>
                    </div>
                </div>

                <!-- 3. Testimonial Banner -->
                <div class="widget-card">
                    <div class="widget-head">
                        <div class="widget-icon wi-green"><i class="fa fa-quote-left"></i></div>
                        <div>
                            <div style="display:flex;align-items:center;gap:8px">
                                <span class="widget-num">3</span>
                                <span class="widget-title">Testimonial Banner</span>
                            </div>
                            <span class="type-badge tb-fixed"><i class="fa fa-minus"></i> Fixed</span>
                        </div>
                    </div>
                    <div style="font-size:12px;color:var(--text-hint)">Static banner displaying a customer quote with author attribution.</div>
                    <div class="widget-actions">
                        <a href="{{ route('admin.home.testimonial.edit') }}" class="btn-manage">
                            <i class="fa fa-pencil"></i> Manage
                        </a>
                    </div>
                </div>

                <!-- 4. Audio Section -->
                <div class="widget-card">
                    <div class="widget-head">
                        <div class="widget-icon wi-blue"><i class="fa fa-music"></i></div>
                        <div>
                            <div style="display:flex;align-items:center;gap:8px">
                                <span class="widget-num">4</span>
                                <span class="widget-title">Audio Section</span>
                            </div>
                            <span class="type-badge tb-fixed"><i class="fa fa-minus"></i> Fixed</span>
                        </div>
                    </div>
                    <div style="font-size:12px;color:var(--text-hint)">"The Fragrance of Restraint" section with a feature image and ambient audio player.</div>
                    <div class="widget-actions">
                        <a href="{{ route('admin.home.audio.edit') }}" class="btn-manage">
                            <i class="fa fa-pencil"></i> Manage
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@include('admin.footer')