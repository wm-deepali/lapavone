<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SmsTemplate;
use App\Models\SmsSetting;          // your existing SMS settings model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SmsTemplateController extends Controller
{
    /**
     * GET /admin/settings/sms/templates
     * Show the templates page.
     * Loads all event templates from DB (creates defaults for missing ones).
     */
    public function index()
    {
        $meta = SmsTemplate::eventMeta();
        $templates = SmsTemplate::whereIn('event_key', SmsTemplate::$eventKeys)
            ->get()
            ->keyBy('event_key');

        // Seed any missing event rows with defaults so the blade always has data
        foreach (SmsTemplate::$eventKeys as $key) {
            if (!isset($templates[$key])) {
                $m = $meta[$key];
                $tpl = SmsTemplate::create([
                    'event_key' => $key,
                    'enabled' => false,
                    'template_type' => $m['default_type'],
                    'body' => $m['default_body'],
                    'extra_settings' => $key === 'otp'
                        ? ['otp_length' => 6, 'otp_expiry' => 10, 'max_retries' => 3]
                        : ($key === 'abandoned-cart'
                            ? ['delay' => '1h']
                            : null),
                ]);
                $templates[$key] = $tpl;
            }
        }

        // Read active provider and sender from SMS settings (read-only in templates UI)
        $smsSettings = SmsSetting::first();

        $emailData = EmailTemplateController::getData();

        return view('admin.admin-settings.templates', array_merge(
            compact('templates', 'meta', 'smsSettings'),
            $emailData  // unpacks emailMeta, emailTemplates, smtpSettings into top-level variables
        ));
    }

    /**
     * POST /admin/settings/sms/templates/{eventKey}
     * Save a single event template.
     * Called per-panel when user clicks "Save Template".
     */
    public function update(Request $request, string $eventKey)
    {
        $meta = SmsTemplate::eventMeta();

        if (!array_key_exists($eventKey, $meta)) {
            return response()->json(['success' => false, 'message' => 'Unknown event key.'], 422);
        }

        $rules = [
            'enabled' => 'boolean',
            'dlt_template_id' => 'nullable|string|max:50',
            'template_type' => 'required|in:transactional,promotional,service-implicit,service-explicit',
            'body' => 'required|string|max:1600',
        ];

        // Event-specific extra validation
        if ($eventKey === 'otp') {
            $rules['otp_length'] = 'required|integer|in:4,6,8';
            $rules['otp_expiry'] = 'required|integer|min:1|max:60';
            $rules['max_retries'] = 'required|integer|min:1|max:10';
        }

        if ($eventKey === 'abandoned-cart') {
            $rules['cart_delay'] = 'required|in:30min,1h,2h,6h,24h';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], 422);
        }

        // Build extra_settings payload
        $extraSettings = null;
        if ($eventKey === 'otp') {
            $extraSettings = [
                'otp_length' => (int) $request->otp_length,
                'otp_expiry' => (int) $request->otp_expiry,
                'max_retries' => (int) $request->max_retries,
            ];
        } elseif ($eventKey === 'abandoned-cart') {
            $extraSettings = ['delay' => $request->cart_delay];
        }

        SmsTemplate::updateOrCreate(
            ['event_key' => $eventKey],
            [
                'enabled' => (bool) $request->input('enabled', false),
                'dlt_template_id' => $request->dlt_template_id,
                'template_type' => $request->template_type,
                'body' => $request->body,
                'extra_settings' => $extraSettings,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Template saved successfully.',
        ]);
    }

    /**
     * POST /admin/settings/sms/templates/test
     * Send a test SMS for the given event using sample variable values.
     */
    public function test(Request $request)
    {
        $request->validate([
            'event_key' => 'required|string',
            'mobile' => 'required|string',
        ]);

        // Sample variable values for every possible placeholder
        $sampleValues = [
            '{otp}' => '847291',
            '{otp_expiry}' => '10',
            '{customer_name}' => 'Test Customer',
            '{store_name}' => config('app.name', 'My Store'),
            '{brand_name}' => config('app.name', 'My Store'),
            '{order_id}' => 'ORD-TEST-001',
            '{order_amount}' => '1,000',
            '{order_date}' => now()->format('d M Y'),
            '{payment_method}' => 'UPI',
            '{expected_delivery}' => now()->addDays(3)->format('d M Y'),
            '{tracking_url}' => url('/track/test'),
            '{courier_name}' => 'Delhivery',
            '{awb_number}' => 'DEL123456789',
            '{review_url}' => url('/review/test'),
            '{cancel_reason}' => 'Customer request',
            '{refund_amount}' => '1,000',
            '{refund_days}' => '5',
            '{refund_method}' => 'original payment method',
            '{payment_amount}' => '1,000',
            '{transaction_id}' => 'TXN12345',
            '{retry_url}' => url('/retry/test'),
            '{support_number}' => '+91-9999999999',
            '{return_id}' => 'RTN-001',
            '{pickup_date}' => now()->addDays(1)->format('d M Y'),
            '{coupon_code}' => 'TEST20',
            '{discount_value}' => '200',
            '{expiry_date}' => now()->addDays(7)->format('d M Y'),
            '{store_url}' => url('/'),
            '{shop_url}' => url('/shop'),
            '{item_count}' => '3',
            '{cart_url}' => url('/cart'),
            '{discount}' => '10',
            '{website_url}' => url('/'),
        ];

        $result = \App\Services\Sms\SmsDispatcher::sendTest(
            $request->event_key,
            $request->mobile,
            $sampleValues
        );


        if ($result['success']) {
            return response()->json([
                'success' => true,
                'message' => "Test SMS sent to {$request->mobile}.",
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => is_string($result['response'])
                ? $result['response']
                : 'Failed to send. Check provider credentials.',
        ], 422);
    }
}