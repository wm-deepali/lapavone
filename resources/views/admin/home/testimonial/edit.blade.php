{{-- resources/views/admin/home/testimonial/edit.blade.php --}}

@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <style>
    :root {
        --bg: #f1f2f4; --surface: #ffffff; --border: #e3e5e8;
        --text-primary: #202223; --text-secondary: #6d7175; --text-hint: #8c9196;
        --accent: #303d89; --accent-light: #f0f1fc;
        --green: #007a5e; --green-bg: #e3f1ec; --red: #b22222;
        --radius-sm: 8px; --radius-md: 12px;
        --shadow-card: 0 1px 3px rgba(0,0,0,.08), 0 0 0 1px var(--border);
        --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }
    .create-page { background: var(--bg); padding: 24px 28px; min-height: 100vh; font-family: var(--font); color: var(--text-primary); }
    .create-page * { box-sizing: border-box; }
    .create-page-header { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
    .create-page-header h1 { font-size: 20px; font-weight: 650; color: var(--text-primary); margin: 0; }
    .crumb { font-size: 12.5px; color: var(--text-hint); margin-top: 3px; }
    .crumb a { color: var(--accent); text-decoration: none; }
    .crumb a:hover { text-decoration: underline; }
    .crumb span { margin: 0 5px; }
    .btn-primary-dash { display: inline-flex; align-items: center; gap: 6px; background: var(--accent); color: #fff !important; border: none; border-radius: var(--radius-sm); padding: 8px 18px; font-size: 13px; font-weight: 600; cursor: pointer; text-decoration: none !important; font-family: var(--font); transition: background .15s; box-shadow: 0 1px 3px rgba(48,61,137,.25); }
    .btn-primary-dash:hover { background: #252f70; }
    .btn-secondary-dash { display: inline-flex; align-items: center; gap: 6px; background: var(--surface); color: var(--text-primary) !important; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 8px 18px; font-size: 13px; font-weight: 500; cursor: pointer; text-decoration: none !important; font-family: var(--font); transition: background .15s; }
    .btn-secondary-dash:hover { background: var(--bg); }
    .create-layout { display: grid; grid-template-columns: 1fr 320px; gap: 20px; align-items: start; }
    @media(max-width:900px) { .create-layout { grid-template-columns: 1fr; } }
    .section-card { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); overflow: hidden; margin-bottom: 16px; }
    .section-card:last-child { margin-bottom: 0; }
    .section-card-header { padding: 14px 20px; border-bottom: 1px solid var(--border); background: #fafafa; }
    .section-card-header h5 { font-size: 13px; font-weight: 650; color: var(--text-primary); margin: 0; }
    .section-card-body { padding: 20px; }
    .field-group { margin-bottom: 16px; }
    .field-group:last-child { margin-bottom: 0; }
    .field-label { display: block; font-size: 12px; font-weight: 600; color: var(--text-secondary); letter-spacing: .03em; text-transform: uppercase; margin-bottom: 6px; }
    .field-input { width: 100%; height: 38px; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 0 12px; font-size: 13.5px; color: var(--text-primary); background: var(--surface); outline: none; transition: border-color .15s, box-shadow .15s; font-family: var(--font); }
    .field-input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(48,61,137,.12); }
    .field-hint { font-size: 11.5px; color: var(--text-hint); margin-top: 4px; }
    .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    @media(max-width:640px) { .field-row { grid-template-columns: 1fr; } }
    .file-upload-area { border: 2px dashed var(--border); border-radius: var(--radius-md); padding: 28px 20px; text-align: center; cursor: pointer; transition: border-color .15s, background .15s; position: relative; }
    .file-upload-area:hover { border-color: var(--accent); background: var(--accent-light); }
    .file-upload-area input[type=file] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
    .file-upload-area .upload-icon { font-size: 26px; color: var(--text-hint); margin-bottom: 8px; }
    .file-upload-area p { font-size: 13px; color: var(--text-secondary); margin: 0; }
    .file-upload-area small { font-size: 11.5px; color: var(--text-hint); }
    .action-bar { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-card); padding: 14px 20px; display: flex; align-items: center; justify-content: flex-end; gap: 10px; margin-top: 20px; }
    .alert-success { background: var(--green-bg); border: 1px solid #b2dac9; color: var(--green); border-radius: var(--radius-sm); padding: 10px 16px; font-size: 13px; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
    @media(max-width:768px) { .create-page { padding: 16px; } }
    </style>

    <div class="app-content content container-fluid">
        <div class="create-page">

            <div class="create-page-header">
                <div>
                    <h1>Testimonial Banner</h1>
                    <div class="crumb">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <span>›</span>
                        <a href="{{ route('admin.home.index') }}">Home Widgets</a>
                        <span>›</span>
                        Testimonial Banner
                    </div>
                </div>
                <a href="{{ route('admin.home.index') }}" class="btn-secondary-dash">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>

            @if(session('success'))
                <div class="alert-success"><i class="fa fa-check-circle"></i> {{ session('success') }}</div>
            @endif

            <form action="{{ route('admin.home.testimonial.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="create-layout">

                    {{-- LEFT --}}
                    <div>
                        <div class="section-card">
                            <div class="section-card-header"><h5>Quote</h5></div>
                            <div class="section-card-body">
                                <div class="field-row">
                                    <div class="field-group">
                                        <label class="field-label">Quote Line 1</label>
                                        <input type="text" name="quote_line1" class="field-input"
                                            value="{{ old('quote_line1', $testimonial->quote_line1) }}"
                                            placeholder="A very beautiful way">
                                    </div>
                                    <div class="field-group">
                                        <label class="field-label">Quote Line 2</label>
                                        <input type="text" name="quote_line2" class="field-input"
                                            value="{{ old('quote_line2', $testimonial->quote_line2) }}"
                                            placeholder="to start the day!">
                                    </div>
                                </div>
                                <div class="field-group">
                                    <label class="field-label">Author</label>
                                    <input type="text" name="author" class="field-input"
                                        value="{{ old('author', $testimonial->author) }}"
                                        placeholder="Bilal Khilji">
                                    <div class="field-hint">Displayed below the quote as attribution.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT --}}
                    <div>
                        <div class="section-card">
                            <div class="section-card-header"><h5>Background Image</h5></div>
                            <div class="section-card-body">
                                <div class="file-upload-area" id="uploadArea">
                                    <input type="file" name="background_image" accept="image/*" id="imageInput">
                                    <div class="upload-icon"><i class="fa fa-cloud-upload"></i></div>
                                    <p>Click or drag image here</p>
                                    <small>JPG, PNG, WEBP — max 3 MB</small>
                                </div>
                                <div id="imagePreview" style="display:none; margin-top:12px; text-align:center;">
                                    <img id="previewImg" src="" alt="Preview"
                                        style="max-width:100%; border-radius:var(--radius-sm); border:1px solid var(--border);">
                                    <div style="margin-top:8px;">
                                        <button type="button" onclick="clearImage()"
                                            style="font-size:12px; color:var(--red); background:none; border:none; cursor:pointer;">
                                            <i class="fa fa-times"></i> Remove
                                        </button>
                                    </div>
                                </div>
                                @if($testimonial->background_image)
                                    <div style="margin-top:12px;">
                                        <div style="font-size:11.5px; color:var(--text-hint); margin-bottom:6px;">Current image:</div>
                                        <img src="{{ asset('storage/'.$testimonial->background_image) }}" alt="Current"
                                            style="max-width:100%; border-radius:var(--radius-sm); border:1px solid var(--border);">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                <div class="action-bar">
                    <a href="{{ route('admin.home.index') }}" class="btn-secondary-dash">Cancel</a>
                    <button type="submit" class="btn-primary-dash"><i class="fa fa-save"></i> Save Changes</button>
                </div>

            </form>
        </div>
    </div>
</div>

@include('admin.footer')

<script>
document.getElementById('imageInput').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('previewImg').src = e.target.result;
        document.getElementById('imagePreview').style.display = 'block';
        document.getElementById('uploadArea').style.display = 'none';
    };
    reader.readAsDataURL(file);
});
function clearImage() {
    document.getElementById('imageInput').value = '';
    document.getElementById('imagePreview').style.display = 'none';
    document.getElementById('uploadArea').style.display = 'block';
}
</script>