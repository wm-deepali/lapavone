<form action="{{ route('admin.settings.sms.update') }}" method="POST">
    @csrf
    @method('POST')

    <div class="settings-layout">

        <!-- Section nav -->
        <div class="settings-sidenav">
            <span class="settings-sidenav-label">Sections</span>
            <a href="#sms-provider" class="active"><i class="fa-solid fa-plug"></i> Provider</a>
            <a href="#sms-credentials"><i class="fa-solid fa-key"></i> API Credentials</a>
            <a href="#sms-sender"><i class="fa-solid fa-id-badge"></i> Sender ID</a>
            <a href="#sms-notifications"><i class="fa-solid fa-bell"></i> Notifications</a>
        </div>

        <!-- Content -->
        <div class="settings-content">

            @if ($errors->any())
                <div class="info-banner" style="background:#fff0f0;border-color:#f5c6cb;margin-bottom:20px">
                    <i class="fa-solid fa-circle-xmark" style="color:#dc3545"></i>
                    <div>
                        <strong>Please fix the following errors:</strong>
                        <ul style="margin:6px 0 0;padding-left:18px">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="info-banner" style="background:#f0fff4;border-color:#b7ebc8;margin-bottom:20px">
                    <i class="fa-solid fa-circle-check" style="color:#28a745"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <!-- ── Provider ── -->
            <div class="settings-section" id="sms-provider">
                <div class="settings-section-title">
                    <i class="fa-solid fa-message"></i> SMS Provider
                </div>
                <p class="settings-section-desc">
                    Select your SMS gateway provider. Only one provider can be active at a time. API credentials below will update based on your selection.
                </p>

                <div class="form-grid">
                    <div class="field-group col-full">
                        <label class="field-label">Active Provider <span class="req">*</span></label>
                        <select name="provider" id="smsProvider" class="field-select" onchange="toggleSmsProvider(this.value)">
                            <option value="">— Select Provider —</option>
                            <option value="msg91"     {{ old('provider', $settings?->provider) === 'msg91'     ? 'selected' : '' }}>MSG91</option>
                            {{-- Uncomment as you add more providers --}}
                            {{-- <option value="twilio"    {{ old('provider', $settings?->provider) === 'twilio'    ? 'selected' : '' }}>Twilio</option> --}}
                            {{-- <option value="textlocal" {{ old('provider', $settings?->provider) === 'textlocal' ? 'selected' : '' }}>Textlocal</option> --}}
                            {{-- <option value="kaleyra"   {{ old('provider', $settings?->provider) === 'kaleyra'   ? 'selected' : '' }}>Kaleyra (Solutions Infini)</option> --}}
                            {{-- <option value="vonage"    {{ old('provider', $settings?->provider) === 'vonage'    ? 'selected' : '' }}>Vonage (Nexmo)</option> --}}
                            {{-- <option value="aws_sns"   {{ old('provider', $settings?->provider) === 'aws_sns'   ? 'selected' : '' }}>AWS SNS</option> --}}
                            {{-- <option value="fast2sms"  {{ old('provider', $settings?->provider) === 'fast2sms'  ? 'selected' : '' }}>Fast2SMS</option> --}}
                            {{-- <option value="sinch"     {{ old('provider', $settings?->provider) === 'sinch'     ? 'selected' : '' }}>Sinch</option> --}}
                        </select>
                        <span class="field-hint">Only the selected provider will be used for all outgoing SMS. Switching providers does not delete saved credentials.</span>
                    </div>

                    <div class="field-group col-full">
                        <div class="info-banner amber" style="margin-bottom:0">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <div>
                                <strong>One provider at a time.</strong> Saving this form activates the selected provider and pauses all others. Make sure you have valid credentials entered before saving.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="section-divider">

            <!-- ── API Credentials ── -->
            <div class="settings-section" id="sms-credentials">
                <div class="settings-section-title">
                    <i class="fa-solid fa-key"></i> API Credentials
                </div>
                <p class="settings-section-desc">
                    Enter the credentials for your selected SMS provider. These are stored encrypted and never exposed in logs.
                </p>

                <!-- Empty state -->
                <div id="sms-creds-empty" style="text-align:center;padding:32px 0;color:var(--text-hint)">
                    <i class="fa fa-plug" style="font-size:32px;color:var(--border);display:block;margin-bottom:10px"></i>
                    Select a provider above to see credential fields.
                </div>

                <!-- ── MSG91 ── -->
                <div id="sms-creds-msg91" class="sms-provider-fields" style="display:none">
                    <div class="info-banner blue" style="margin-bottom:20px">
                        <i class="fa-solid fa-circle-info"></i>
                        <div>
                            <strong>MSG91</strong> — Find your Auth Key in the
                            <a href="https://msg91.com/in/signup" target="_blank" style="color:#0069d9;font-weight:600">MSG91 Dashboard</a>
                            under API &rarr; Auth Key.
                        </div>
                    </div>
                    <div class="form-grid">
                        <div class="field-group col-full">
                            <label class="field-label">Auth Key <span class="req">*</span></label>
                            <div style="position:relative">
                                <input type="password" id="msg91AuthKey" name="msg91_auth_key"
                                    class="field-input monospace @error('msg91_auth_key') is-invalid @enderror"
                                    value="{{ old('msg91_auth_key', $settings?->msg91_auth_key) }}"
                                    placeholder="{{ $settings?->msg91_auth_key ? $settings?->msg91_auth_key : '••••••••••••••••••••••••••••' }}">
                                <button type="button" onclick="togglePass('msg91AuthKey', this)" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--text-hint)"><i class="fa fa-eye"></i></button>
                            </div>
                            @error('msg91_auth_key')
                                <span class="field-hint" style="color:#dc3545">{{ $message }}</span>
                            @else
                                <span class="field-hint">Your MSG91 authentication key from the dashboard.</span>
                            @enderror
                        </div>
                        <div class="field-group">
                            <label class="field-label">Route</label>
                            <select name="msg91_route" class="field-select">
                                <option value="4" {{ old('msg91_route', $settings?->msg91_route) == 4 ? 'selected' : '' }}>Transactional (Route 4)</option>
                                <option value="1" {{ old('msg91_route', $settings?->msg91_route) == 1 ? 'selected' : '' }}>Promotional (Route 1)</option>
                            </select>
                            <span class="field-hint">Use Transactional for order/OTP SMS.</span>
                        </div>
                        <div class="field-group">
                            <label class="field-label">DLT Entity ID</label>
                            <input type="text" name="msg91_dlt_entity_id"
                                class="field-input monospace @error('msg91_dlt_entity_id') is-invalid @enderror"
                                placeholder="DLT-registered Entity ID"
                                value="{{ old('msg91_dlt_entity_id', $settings?->msg91_dlt_entity_id) }}">
                            @error('msg91_dlt_entity_id')
                                <span class="field-hint" style="color:#dc3545">{{ $message }}</span>
                            @else
                                <span class="field-hint">Required for India. Register on TRAI DLT portal.</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- ── Twilio ── (uncomment option above to enable) -->
                <div id="sms-creds-twilio" class="sms-provider-fields" style="display:none">
                    <div class="info-banner blue" style="margin-bottom:20px">
                        <i class="fa-solid fa-circle-info"></i>
                        <div>
                            <strong>Twilio</strong> — Get your credentials from the
                            <a href="https://console.twilio.com" target="_blank" style="color:#0069d9;font-weight:600">Twilio Console</a>
                            under Account Info.
                        </div>
                    </div>
                    <div class="form-grid">
                        <div class="field-group">
                            <label class="field-label">Account SID <span class="req">*</span></label>
                            <input type="text" name="twilio_account_sid" class="field-input monospace"
                                placeholder="ACxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
                                value="{{ old('twilio_account_sid', $settings?->twilio_account_sid) }}">
                        </div>
                        <div class="field-group">
                            <label class="field-label">Auth Token <span class="req">*</span></label>
                            <div style="position:relative">
                                <input type="password" id="twilioSmsToken" name="twilio_auth_token" class="field-input monospace"
                                    placeholder="{{ $settings?->twilio_auth_token ? '(saved — leave blank to keep)' : '••••••••••••••••••••••••••••••••' }}">
                                <button type="button" onclick="togglePass('twilioSmsToken', this)" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--text-hint)"><i class="fa fa-eye"></i></button>
                            </div>
                        </div>
                        <div class="field-group col-full">
                            <label class="field-label">From Number <span class="req">*</span></label>
                            <input type="text" name="twilio_from_number" class="field-input"
                                placeholder="+14155238886"
                                value="{{ old('twilio_from_number', $settings?->twilio_from_number) }}">
                            <span class="field-hint">The Twilio phone number to send SMS from. Must include country code.</span>
                        </div>
                    </div>
                </div>

                <!-- ── Textlocal ── -->
                <div id="sms-creds-textlocal" class="sms-provider-fields" style="display:none">
                    <div class="info-banner blue" style="margin-bottom:20px">
                        <i class="fa-solid fa-circle-info"></i>
                        <div>
                            <strong>Textlocal</strong> — Retrieve your API Key from
                            <a href="https://www.textlocal.in" target="_blank" style="color:#0069d9;font-weight:600">Textlocal Dashboard</a>
                            under Settings &rarr; API Keys.
                        </div>
                    </div>
                    <div class="form-grid">
                        <div class="field-group col-full">
                            <label class="field-label">API Key <span class="req">*</span></label>
                            <div style="position:relative">
                                <input type="password" id="textlocalKey" name="textlocal_api_key" class="field-input monospace"
                                    placeholder="{{ $settings?->textlocal_api_key ? '(saved — leave blank to keep)' : '••••••••••••••••••••••••••••••••' }}">
                                <button type="button" onclick="togglePass('textlocalKey', this)" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--text-hint)"><i class="fa fa-eye"></i></button>
                            </div>
                        </div>
                        <div class="field-group col-full">
                            <label class="field-label">Registered Username / Email</label>
                            <input type="text" name="textlocal_username" class="field-input"
                                placeholder="your@email.com"
                                value="{{ old('textlocal_username', $settings?->textlocal_username) }}">
                            <span class="field-hint">The email used to register your Textlocal account.</span>
                        </div>
                    </div>
                </div>

                <!-- ── Kaleyra ── -->
                <div id="sms-creds-kaleyra" class="sms-provider-fields" style="display:none">
                    <div class="info-banner blue" style="margin-bottom:20px">
                        <i class="fa-solid fa-circle-info"></i>
                        <div>
                            <strong>Kaleyra (Solutions Infini)</strong> — Get your SID and API Key from the
                            <a href="https://kaleyra.com" target="_blank" style="color:#0069d9;font-weight:600">Kaleyra Console</a>.
                        </div>
                    </div>
                    <div class="form-grid">
                        <div class="field-group">
                            <label class="field-label">Account SID <span class="req">*</span></label>
                            <input type="text" name="kaleyra_sid" class="field-input monospace"
                                placeholder="KLxxxxxxxxxxxxxxxx"
                                value="{{ old('kaleyra_sid', $settings?->kaleyra_sid) }}">
                        </div>
                        <div class="field-group">
                            <label class="field-label">API Key <span class="req">*</span></label>
                            <div style="position:relative">
                                <input type="password" id="kaleyraKey" name="kaleyra_api_key" class="field-input monospace"
                                    placeholder="{{ $settings?->kaleyra_api_key ? '(saved — leave blank to keep)' : '••••••••••••••••••••••••••••' }}">
                                <button type="button" onclick="togglePass('kaleyraKey', this)" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--text-hint)"><i class="fa fa-eye"></i></button>
                            </div>
                        </div>
                        <div class="field-group">
                            <label class="field-label">DLT Entity ID</label>
                            <input type="text" name="kaleyra_dlt_entity_id" class="field-input monospace"
                                placeholder="DLT Entity ID"
                                value="{{ old('kaleyra_dlt_entity_id', $settings?->kaleyra_dlt_entity_id) }}">
                        </div>
                        <div class="field-group">
                            <label class="field-label">DLT Template ID (default)</label>
                            <input type="text" name="kaleyra_dlt_template_id" class="field-input monospace"
                                placeholder="DLT Template ID"
                                value="{{ old('kaleyra_dlt_template_id', $settings?->kaleyra_dlt_template_id) }}">
                        </div>
                    </div>
                </div>

                <!-- ── Vonage / Nexmo ── -->
                <div id="sms-creds-vonage" class="sms-provider-fields" style="display:none">
                    <div class="info-banner blue" style="margin-bottom:20px">
                        <i class="fa-solid fa-circle-info"></i>
                        <div>
                            <strong>Vonage (Nexmo)</strong> — Your API Key and Secret are on the
                            <a href="https://dashboard.nexmo.com" target="_blank" style="color:#0069d9;font-weight:600">Vonage Dashboard</a>
                            home page.
                        </div>
                    </div>
                    <div class="form-grid">
                        <div class="field-group">
                            <label class="field-label">API Key <span class="req">*</span></label>
                            <input type="text" name="vonage_api_key" class="field-input monospace"
                                placeholder="xxxxxxxx"
                                value="{{ old('vonage_api_key', $settings?->vonage_api_key) }}">
                        </div>
                        <div class="field-group">
                            <label class="field-label">API Secret <span class="req">*</span></label>
                            <div style="position:relative">
                                <input type="password" id="vonageSecret" name="vonage_api_secret" class="field-input monospace"
                                    placeholder="{{ $settings?->vonage_api_secret ? '(saved — leave blank to keep)' : '••••••••••••••••••••••••••••••••' }}">
                                <button type="button" onclick="togglePass('vonageSecret', this)" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--text-hint)"><i class="fa fa-eye"></i></button>
                            </div>
                        </div>
                        <div class="field-group col-full">
                            <label class="field-label">From Name / Number <span class="req">*</span></label>
                            <input type="text" name="vonage_from" class="field-input"
                                placeholder="YourBrand or +14155238886"
                                value="{{ old('vonage_from', $settings?->vonage_from) }}">
                            <span class="field-hint">Alphanumeric sender ID (max 11 chars) or a virtual number.</span>
                        </div>
                    </div>
                </div>

                <!-- ── AWS SNS ── -->
                <div id="sms-creds-aws_sns" class="sms-provider-fields" style="display:none">
                    <div class="info-banner blue" style="margin-bottom:20px">
                        <i class="fa-solid fa-circle-info"></i>
                        <div>
                            <strong>AWS SNS</strong> — Create an IAM user with <code>sns:Publish</code> permission and generate Access Keys in the
                            <a href="https://console.aws.amazon.com/iam" target="_blank" style="color:#0069d9;font-weight:600">AWS IAM Console</a>.
                        </div>
                    </div>
                    <div class="form-grid">
                        <div class="field-group">
                            <label class="field-label">Access Key ID <span class="req">*</span></label>
                            <input type="text" name="aws_access_key_id" class="field-input monospace"
                                placeholder="AKIAxxxxxxxxxxxxxxxxxxxx"
                                value="{{ old('aws_access_key_id', $settings?->aws_access_key_id) }}">
                        </div>
                        <div class="field-group">
                            <label class="field-label">Secret Access Key <span class="req">*</span></label>
                            <div style="position:relative">
                                <input type="password" id="awsSecretKey" name="aws_secret_access_key" class="field-input monospace"
                                    placeholder="{{ $settings?->aws_secret_access_key ? '(saved — leave blank to keep)' : '••••••••••••••••••••••••••••••••••••••••' }}">
                                <button type="button" onclick="togglePass('awsSecretKey', this)" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--text-hint)"><i class="fa fa-eye"></i></button>
                            </div>
                        </div>
                        <div class="field-group">
                            <label class="field-label">AWS Region <span class="req">*</span></label>
                            <select name="aws_region" class="field-select">
                                @foreach(['ap-south-1' => 'ap-south-1 (Mumbai)', 'us-east-1' => 'us-east-1 (N. Virginia)', 'us-west-2' => 'us-west-2 (Oregon)', 'eu-west-1' => 'eu-west-1 (Ireland)', 'ap-southeast-1' => 'ap-southeast-1 (Singapore)'] as $val => $label)
                                    <option value="{{ $val }}" {{ old('aws_region', $settings?->aws_region) === $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field-group">
                            <label class="field-label">SMS Type</label>
                            <select name="aws_sms_type" class="field-select">
                                <option value="Transactional" {{ old('aws_sms_type', $settings?->aws_sms_type) === 'Transactional' ? 'selected' : '' }}>Transactional</option>
                                <option value="Promotional"   {{ old('aws_sms_type', $settings?->aws_sms_type) === 'Promotional'   ? 'selected' : '' }}>Promotional</option>
                            </select>
                            <span class="field-hint">Transactional has higher priority and delivery reliability.</span>
                        </div>
                    </div>
                </div>

                <!-- ── Fast2SMS ── -->
                <div id="sms-creds-fast2sms" class="sms-provider-fields" style="display:none">
                    <div class="info-banner blue" style="margin-bottom:20px">
                        <i class="fa-solid fa-circle-info"></i>
                        <div>
                            <strong>Fast2SMS</strong> — Copy your API Key from the
                            <a href="https://www.fast2sms.com/dashboard/dev-api" target="_blank" style="color:#0069d9;font-weight:600">Fast2SMS Developer API</a>
                            page.
                        </div>
                    </div>
                    <div class="form-grid">
                        <div class="field-group col-full">
                            <label class="field-label">API Key <span class="req">*</span></label>
                            <div style="position:relative">
                                <input type="password" id="fast2smsKey" name="fast2sms_api_key" class="field-input monospace"
                                    placeholder="{{ $settings?->fast2sms_api_key ? '(saved — leave blank to keep)' : '••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••' }}">
                                <button type="button" onclick="togglePass('fast2smsKey', this)" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--text-hint)"><i class="fa fa-eye"></i></button>
                            </div>
                            <span class="field-hint">Long API key from your Fast2SMS account developer panel.</span>
                        </div>
                        <div class="field-group">
                            <label class="field-label">Route</label>
                            <select name="fast2sms_route" class="field-select">
                                <option value="dlt" {{ old('fast2sms_route', $settings?->fast2sms_route) === 'dlt' ? 'selected' : '' }}>DLT (Transactional)</option>
                                <option value="v3"  {{ old('fast2sms_route', $settings?->fast2sms_route) === 'v3'  ? 'selected' : '' }}>Quick SMS (Promotional)</option>
                            </select>
                        </div>
                        <div class="field-group">
                            <label class="field-label">Language</label>
                            <select name="fast2sms_language" class="field-select">
                                <option value="english" {{ old('fast2sms_language', $settings?->fast2sms_language) === 'english' ? 'selected' : '' }}>English</option>
                                <option value="unicode" {{ old('fast2sms_language', $settings?->fast2sms_language) === 'unicode' ? 'selected' : '' }}>Unicode</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- ── Sinch ── -->
                <div id="sms-creds-sinch" class="sms-provider-fields" style="display:none">
                    <div class="info-banner blue" style="margin-bottom:20px">
                        <i class="fa-solid fa-circle-info"></i>
                        <div>
                            <strong>Sinch</strong> — Retrieve your Service Plan ID and API Token from the
                            <a href="https://dashboard.sinch.com/sms/api/rest" target="_blank" style="color:#0069d9;font-weight:600">Sinch Dashboard</a>.
                        </div>
                    </div>
                    <div class="form-grid">
                        <div class="field-group">
                            <label class="field-label">Service Plan ID <span class="req">*</span></label>
                            <input type="text" name="sinch_service_plan_id" class="field-input monospace"
                                placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx"
                                value="{{ old('sinch_service_plan_id', $settings?->sinch_service_plan_id) }}">
                        </div>
                        <div class="field-group">
                            <label class="field-label">API Token <span class="req">*</span></label>
                            <div style="position:relative">
                                <input type="password" id="sinchToken" name="sinch_api_token" class="field-input monospace"
                                    placeholder="{{ $settings?->sinch_api_token ? '(saved — leave blank to keep)' : '••••••••••••••••••••••••••••••••' }}">
                                <button type="button" onclick="togglePass('sinchToken', this)" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--text-hint)"><i class="fa fa-eye"></i></button>
                            </div>
                        </div>
                        <div class="field-group col-full">
                            <label class="field-label">From Number <span class="req">*</span></label>
                            <input type="text" name="sinch_from_number" class="field-input"
                                placeholder="+14155238886"
                                value="{{ old('sinch_from_number', $settings?->sinch_from_number) }}">
                            <span class="field-hint">Virtual number rented from Sinch, with country code.</span>
                        </div>
                    </div>
                </div>

            </div>

            <hr class="section-divider">

            <!-- ── Sender ID ── -->
            <div class="settings-section" id="sms-sender">
                <div class="settings-section-title">
                    <i class="fa-solid fa-id-badge"></i> Sender ID / From Name
                </div>
                <p class="settings-section-desc">
                    Configure the sender name or number shown to customers. This must match your DLT registration in India.
                </p>

                <div class="form-grid">
                    <div class="field-group">
                        <label class="field-label">Sender ID / Name <span class="req">*</span></label>
                        <input type="text" name="sender_id"
                            class="field-input @error('sender_id') is-invalid @enderror"
                            placeholder="MYSHOP"
                            maxlength="11"
                            value="{{ old('sender_id', $settings?->sender_id) }}">
                        @error('sender_id')
                            <span class="field-hint" style="color:#dc3545">{{ $message }}</span>
                        @else
                            <span class="field-hint">Max 11 characters (alphanumeric). Must be registered with your telecom operator in India.</span>
                        @enderror
                    </div>
                    <div class="field-group">
                        <label class="field-label">Country Code Default</label>
                        <div class="input-wrap">
                            <span class="input-prefix">+</span>
                            <input type="text" name="default_country_code"
                                class="field-input @error('default_country_code') is-invalid @enderror"
                                placeholder="91"
                                value="{{ old('default_country_code', $settings?->default_country_code ?? '91') }}">
                        </div>
                        @error('default_country_code')
                            <span class="field-hint" style="color:#dc3545">{{ $message }}</span>
                        @else
                            <span class="field-hint">Prepended to numbers that don't already include a country code.</span>
                        @enderror
                    </div>
                </div>
            </div>

            <hr class="section-divider">

            <!-- ── Notification Toggles ── -->
            <div class="settings-section" id="sms-notifications">
                <div class="settings-section-title">
                    <i class="fa-solid fa-bell"></i> Notification Events
                </div>
                <p class="settings-section-desc">
                    Choose which events trigger an SMS to the customer. The master switch must be on for any SMS to send.
                </p>

                <div class="toggle-row">
                    <div>
                        <div class="toggle-info-label">Enable SMS Notifications</div>
                        <div class="toggle-info-sub">Master switch — turns all SMS messaging on or off.</div>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" name="enabled" id="smsMasterToggle"
                            onchange="toggleSmsNotifs(this)"
                            {{ old('enabled', $settings?->enabled) ? 'checked' : '' }}>
                        <span class="toggle-track"></span>
                    </label>
                </div>

                @php
                    $notifEvents = [
                        'notify_order_placed'     => ['Order Placed / Confirmed',    'Send SMS when a new order is successfully placed.'],
                        'notify_otp'              => ['OTP / Order Verification',    'Send OTP for account login, COD confirmation, or order changes.'],
                        'notify_payment_received' => ['Payment Received',            'Notify customer when payment is successfully processed.'],
                        'notify_order_shipped'    => ['Order Shipped',               'Alert customer when the order is dispatched with tracking info.'],
                        'notify_out_for_delivery' => ['Out for Delivery',            'Notify when the order is out for delivery.'],
                        'notify_order_delivered'  => ['Order Delivered',             'Send a delivery confirmation SMS to the customer.'],
                        'notify_order_cancelled'  => ['Order Cancelled',             'Notify customer when their order is cancelled.'],
                        'notify_refund_initiated' => ['Refund Initiated',            'Inform customer when a refund has been processed.'],
                        'notify_abandoned_cart'   => ['Abandoned Cart Reminder',     'Send a reminder SMS when a customer leaves items in cart.'],
                        'notify_promotional'      => ['Promotional / Marketing',     'Send promotional campaigns and offers via SMS.'],
                    ];
                @endphp

                <div id="sms-notif-rows" style="opacity:{{ old('enabled', $settings?->enabled) ? '1' : '0.4' }};pointer-events:{{ old('enabled', $settings?->enabled) ? 'auto' : 'none' }};transition:opacity .2s">

                    @foreach($notifEvents as $name => [$label, $desc])
                    <div class="toggle-row">
                        <div>
                            <div class="toggle-info-label">{{ $label }}</div>
                            <div class="toggle-info-sub">{{ $desc }}</div>
                        </div>
                        <label class="toggle-switch">
                            <input type="checkbox" name="{{ $name }}"
                                {{ old($name, $settings?->{$name}) ? 'checked' : '' }}>
                            <span class="toggle-track"></span>
                        </label>
                    </div>
                    @endforeach

                </div>
            </div>

        </div><!-- /settings-content -->
    </div><!-- /settings-layout -->

    <div class="action-bar">
        <button type="button" class="btn-test" onclick="testSms()">
            <i class="fa fa-paper-plane"></i> Send Test SMS
        </button>
        <button type="button" class="btn-secondary-dash" onclick="window.location.reload()">Discard Changes</button>
        <button type="submit" class="btn-primary-dash">
            <i class="fa fa-save"></i> Save SMS Settings
        </button>
    </div>

</form>

<script>
// ── Restore active provider panel on page load ───────────────────────────────
document.addEventListener('DOMContentLoaded', function () {
    const provider = document.getElementById('smsProvider').value;
    if (provider) toggleSmsProvider(provider);
});

// ── Show credential panel for selected provider ──────────────────────────────
function toggleSmsProvider(val) {
    document.querySelectorAll('.sms-provider-fields').forEach(el => el.style.display = 'none');
    const emptyEl = document.getElementById('sms-creds-empty');
    emptyEl.style.display = 'none';
    const target = document.getElementById('sms-creds-' + val);
    if (target) {
        target.style.display = 'block';
    } else {
        emptyEl.style.display = 'block';
    }
}

// ── Master toggle ────────────────────────────────────────────────────────────
function toggleSmsNotifs(checkbox) {
    const rows = document.getElementById('sms-notif-rows');
    rows.style.opacity      = checkbox.checked ? '1'    : '0.4';
    rows.style.pointerEvents = checkbox.checked ? 'auto' : 'none';
}

// ── Show/hide password ───────────────────────────────────────────────────────
function togglePass(id, btn) {
    const input = document.getElementById(id);
    const isText = input.type === 'text';
    input.type = isText ? 'password' : 'text';
    btn.querySelector('i').className = isText ? 'fa fa-eye' : 'fa fa-eye-slash';
}

// ── Test SMS (AJAX) ──────────────────────────────────────────────────────────
function testSms() {
    const provider = document.getElementById('smsProvider').value;
    if (!provider) {
        Swal.fire({
            icon: 'warning',
            title: 'No provider selected',
            text: 'Please select and configure an SMS provider first.',
            confirmButtonColor: '#303d89'
        });
        return;
    }

    Swal.fire({
        title: 'Send Test SMS',
        input: 'text',
        inputLabel: 'Enter mobile number (with country code)',
        inputPlaceholder: '+91 98765 43210',
        showCancelButton: true,
        confirmButtonColor: '#303d89',
        confirmButtonText: 'Send',
    }).then(result => {
        if (!result.isConfirmed || !result.value) return;

        Swal.fire({ title: 'Sending…', allowOutsideClick: false, didOpen: () => Swal.showLoading() });

        fetch('{{ route('admin.settings.sms.test') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ mobile: result.value })
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Test SMS Sent!',
                    text: data.message,
                    timer: 2500,
                    showConfirmButton: false
                });
            } else {
                Swal.fire({ icon: 'error', title: 'Failed', text: data.message, confirmButtonColor: '#303d89' });
            }
        })
        .catch(() => {
            Swal.fire({ icon: 'error', title: 'Error', text: 'Something went wrong. Please try again.', confirmButtonColor: '#303d89' });
        });
    });
}
</script>