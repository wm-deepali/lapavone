<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsTemplate extends Model
{
    protected $fillable = [
        'event_key',
        'enabled',
        'dlt_template_id',
        'template_type',
        'body',
        'extra_settings',
    ];

    protected $casts = [
        'enabled'        => 'boolean',
        'extra_settings' => 'array',
    ];

    /**
     * All valid event keys, in sidebar display order.
     * Changing this list is the only thing needed to add/remove events.
     */
    public static array $eventKeys = [
        'otp',
        'order-placed',
        'order-confirmed',
        'order-shipped',
        'order-delivered',
        'order-cancelled',
        'payment-received',
        'payment-failed',
        'refund',
        'return-approved',
        'coupon',
        'abandoned-cart',
    ];

    /**
     * Human-readable metadata for each event key.
     * Used in the blade to render nav labels, icons, descriptions.
     */
    public static function eventMeta(): array
    {
        return [
            'otp' => [
                'label'       => 'OTP / Verification',
                'icon'        => 'fa fa-key',
                'desc'        => 'Sent when a customer requests a one-time password for login, registration, or checkout verification.',
                'default_type'=> 'transactional',
                'default_body'=> '{otp} is the One Time Password(OTP) to verify your MOB number at Web Mingo, This OTP is Usable only once and is valid for 10 min,PLS DO NOT SHARE THE OTP WITH ANYONE',
                'vars'        => [
                    '{otp}'           => 'OTP Code',
                    '{otp_expiry}'    => 'Expiry (min)',
                    '{store_name}'    => 'Store Name',
                    '{brand_name}'    => 'Brand Name',
                ],
                'extras' => 'otp',
            ],
            'order-placed' => [
                'label'       => 'Order Placed',
                'icon'        => 'fa fa-shopping-bag',
                'desc'        => 'Sent immediately when a customer successfully places an order.',
                'default_type'=> 'transactional',
                'default_body'=> 'Hi {customer_name}, your order #{order_id} worth {order_amount} has been placed! Expected delivery: {expected_delivery}. Track: {tracking_url} - {brand_name}',
                'vars'        => [
                    '{customer_name}'    => 'Customer Name',
                    '{order_id}'         => 'Order ID',
                    '{order_amount}'     => 'Order Amount',
                    '{order_date}'       => 'Order Date',
                    '{payment_method}'   => 'Payment Method',
                    '{expected_delivery}'=> 'Expected Delivery',
                    '{tracking_url}'     => 'Tracking URL',
                    '{store_name}'       => 'Store Name',
                    '{brand_name}'       => 'Brand Name',
                ],
                'extras' => null,
            ],
            'order-confirmed' => [
                'label'       => 'Order Confirmed',
                'icon'        => 'fa fa-check-circle',
                'desc'        => 'Sent when payment is verified and the order moves to confirmed status.',
                'default_type'=> 'transactional',
                'default_body'=> 'Hi {customer_name}, great news! Order #{order_id} is confirmed. Payment of {order_amount} received via {payment_method}. Expected: {expected_delivery}. - {brand_name}',
                'vars'        => [
                    '{customer_name}'    => 'Customer Name',
                    '{order_id}'         => 'Order ID',
                    '{order_amount}'     => 'Order Amount',
                    '{payment_method}'   => 'Payment Method',
                    '{expected_delivery}'=> 'Expected Delivery',
                    '{brand_name}'       => 'Brand Name',
                ],
                'extras' => null,
            ],
            'order-shipped' => [
                'label'       => 'Order Shipped',
                'icon'        => 'fa fa-truck',
                'desc'        => 'Sent when the order is dispatched from the warehouse with tracking details.',
                'default_type'=> 'transactional',
                'default_body'=> 'Order #{order_id} shipped via {courier_name}! Track AWB: {awb_number} at {tracking_url}. Expected by {expected_delivery}. - {brand_name}',
                'vars'        => [
                    '{order_id}'         => 'Order ID',
                    '{courier_name}'     => 'Courier Name',
                    '{awb_number}'       => 'AWB Number',
                    '{tracking_url}'     => 'Tracking URL',
                    '{expected_delivery}'=> 'Expected Delivery',
                    '{customer_name}'    => 'Customer Name',
                    '{brand_name}'       => 'Brand Name',
                ],
                'extras' => null,
            ],
            'order-delivered' => [
                'label'       => 'Order Delivered',
                'icon'        => 'fa fa-box-open',
                'desc'        => 'Sent when delivery is confirmed by the courier or customer.',
                'default_type'=> 'transactional',
                'default_body'=> 'Hi {customer_name}, your order #{order_id} has been delivered! We hope you love it. Rate your experience: {review_url} - {brand_name}',
                'vars'        => [
                    '{customer_name}' => 'Customer Name',
                    '{order_id}'      => 'Order ID',
                    '{review_url}'    => 'Review URL',
                    '{store_name}'    => 'Store Name',
                    '{brand_name}'    => 'Brand Name',
                ],
                'extras' => null,
            ],
            'order-cancelled' => [
                'label'       => 'Order Cancelled',
                'icon'        => 'fa fa-times-circle',
                'desc'        => 'Sent when an order is cancelled, either by the customer or the store.',
                'default_type'=> 'transactional',
                'default_body'=> 'Hi {customer_name}, your order #{order_id} has been cancelled. Refund of {refund_amount} will be processed in {refund_days} business days. - {brand_name}',
                'vars'        => [
                    '{customer_name}' => 'Customer Name',
                    '{order_id}'      => 'Order ID',
                    '{cancel_reason}' => 'Cancel Reason',
                    '{refund_amount}' => 'Refund Amount',
                    '{refund_days}'   => 'Refund Days',
                    '{brand_name}'    => 'Brand Name',
                ],
                'extras' => null,
            ],
            'payment-received' => [
                'label'       => 'Payment Received',
                'icon'        => 'fa fa-credit-card',
                'desc'        => 'Sent when a payment is successfully processed.',
                'default_type'=> 'transactional',
                'default_body'=> 'Payment of {payment_amount} received for order #{order_id} via {payment_method}. Txn ID: {transaction_id}. Thank you! - {brand_name}',
                'vars'        => [
                    '{payment_amount}'  => 'Payment Amount',
                    '{order_id}'        => 'Order ID',
                    '{payment_method}'  => 'Payment Method',
                    '{transaction_id}'  => 'Transaction ID',
                    '{customer_name}'   => 'Customer Name',
                    '{brand_name}'      => 'Brand Name',
                ],
                'extras' => null,
            ],
            'payment-failed' => [
                'label'       => 'Payment Failed',
                'icon'        => 'fa fa-exclamation-circle',
                'desc'        => 'Alert sent when a payment attempt fails so the customer can retry.',
                'default_type'=> 'transactional',
                'default_body'=> 'Hi {customer_name}, payment of {payment_amount} for order #{order_id} failed. Retry at {retry_url}. Need help? Call {support_number}. - {brand_name}',
                'vars'        => [
                    '{customer_name}'  => 'Customer Name',
                    '{payment_amount}' => 'Payment Amount',
                    '{order_id}'       => 'Order ID',
                    '{retry_url}'      => 'Retry URL',
                    '{support_number}' => 'Support Number',
                    '{brand_name}'     => 'Brand Name',
                ],
                'extras' => null,
            ],
            'refund' => [
                'label'       => 'Refund Initiated',
                'icon'        => 'fa fa-undo',
                'desc'        => 'Sent when a refund is initiated after cancellation or return.',
                'default_type'=> 'transactional',
                'default_body'=> 'Hi {customer_name}, refund of {refund_amount} for order #{order_id} has been initiated. Reflects in {refund_days} business days to your {refund_method}. - {brand_name}',
                'vars'        => [
                    '{customer_name}' => 'Customer Name',
                    '{refund_amount}' => 'Refund Amount',
                    '{order_id}'      => 'Order ID',
                    '{refund_days}'   => 'Refund Days',
                    '{refund_method}' => 'Refund Method',
                    '{brand_name}'    => 'Brand Name',
                ],
                'extras' => null,
            ],
            'return-approved' => [
                'label'       => 'Return Approved',
                'icon'        => 'fa fa-reply',
                'desc'        => 'Sent when a return request is approved and pickup is scheduled.',
                'default_type'=> 'transactional',
                'default_body'=> 'Your return #{return_id} for order #{order_id} is approved. Pickup on {pickup_date}. Refund: {refund_amount}. - {brand_name}',
                'vars'        => [
                    '{return_id}'     => 'Return ID',
                    '{order_id}'      => 'Order ID',
                    '{pickup_date}'   => 'Pickup Date',
                    '{refund_amount}' => 'Refund Amount',
                    '{brand_name}'    => 'Brand Name',
                ],
                'extras' => null,
            ],
            'coupon' => [
                'label'       => 'Coupon / Offer',
                'icon'        => 'fa fa-tag',
                'desc'        => 'Promotional SMS for coupon codes and special offers sent to opted-in customers.',
                'default_type'=> 'promotional',
                'default_body'=> 'Exclusive for you! Use code {coupon_code} and get {discount_value} off on your next order at {store_url}. Valid till {expiry_date}. Shop now! - {brand_name}',
                'vars'        => [
                    '{coupon_code}'   => 'Coupon Code',
                    '{discount_value}'=> 'Discount Value',
                    '{expiry_date}'   => 'Expiry Date',
                    '{customer_name}' => 'Customer Name',
                    '{store_url}'     => 'Store URL',
                    '{shop_url}'      => 'Shop URL',
                    '{brand_name}'    => 'Brand Name',
                ],
                'extras' => null,
            ],
            'abandoned-cart' => [
                'label'       => 'Abandoned Cart',
                'icon'        => 'fa fa-shopping-cart',
                'desc'        => 'Recovery SMS sent after a customer leaves items in the cart without checking out.',
                'default_type'=> 'promotional',
                'default_body'=> 'Hi {customer_name}, you left {item_count} item(s) in your cart! Complete your order at {cart_url} and use code {coupon_code} for {discount}% off. - {brand_name}',
                'vars'        => [
                    '{customer_name}' => 'Customer Name',
                    '{item_count}'    => 'Item Count',
                    '{cart_url}'      => 'Cart URL',
                    '{coupon_code}'   => 'Coupon Code',
                    '{discount}'      => 'Discount %',
                    '{brand_name}'    => 'Brand Name',
                ],
                'extras' => 'abandoned-cart',
            ],
        ];
    }

    /**
     * Get badge class and label for the nav sidebar.
     * Returns ['class' => 'active-badge|draft-badge|off-badge', 'label' => 'On|Draft|Off']
     */
    public function navBadge(): array
    {
        if ($this->enabled) {
            return ['class' => 'active-badge', 'label' => 'On'];
        }

        // Has a body saved but not enabled → Draft
        if (!empty($this->body)) {
            return ['class' => 'draft-badge', 'label' => 'Draft'];
        }

        return ['class' => 'off-badge', 'label' => 'Off'];
    }

    /**
     * Returns the status badge HTML shown in the panel header.
     */
    public function statusBadgeHtml(): string
    {
        if ($this->enabled) {
            return '<span style="font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px;background:var(--green-bg);color:var(--green);border:1px solid var(--green-border)">
                        <i class="fa fa-circle" style="font-size:7px;margin-right:4px"></i>Active
                    </span>';
        }

        if (!empty($this->body)) {
            return '<span style="font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px;background:var(--amber-bg);color:var(--amber);border:1px solid var(--amber-border)">Draft</span>';
        }

        return '<span style="font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px;background:var(--bg);color:var(--text-hint);border:1px solid var(--border)">Off</span>';
    }
}