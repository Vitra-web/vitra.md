<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $guarded = false;

    const STATUS_NEW = 'new';
    const STATUS_OPEN = 'open';
    const STATUS_CLOSE = 'close';
    const STATUS_RETURNED = 'return';

    static function getStatus() {
        return [
            self::STATUS_NEW => trans('panel.status_new'),
            self::STATUS_OPEN => trans('panel.status_process'),
            self::STATUS_CLOSE => trans('panel.status_close'),
            self::STATUS_RETURNED => trans('panel.status_return'),
        ];
    }
    public function getStatusTitleAttribute() {
        return self::getStatus()[$this->status];
    }

    const DELIVERY_VITRA = 1;
    const DELIVERY_NOVA_POSHTA = 2;
    const DELIVERY_PICKUP = 3;

    static function getType() {
        return [
            self::DELIVERY_VITRA => trans('panel.delivery_vitra'),
            self::DELIVERY_NOVA_POSHTA => trans('panel.delivery_nova'),
            self::DELIVERY_PICKUP => trans('panel.delivery_pickup'),
        ];
    }
    public function getDeliveryNameAttribute() {
        return self::getType()[$this->deliveryType];
    }

    const PAYMENT_CARD = 1;
    const PAYMENT_TRANSFER = 2;
    const PAYMENT_CASH = 3;

    static function getPayment() {
        return [
            self::PAYMENT_CARD => trans('panel.payment_card'),
            self::PAYMENT_TRANSFER => trans('panel.payment_transfer'),
            self::PAYMENT_CASH => trans('panel.payment_cash'),
        ];
    }
    public function getPaymentNameAttribute() {
        return self::getPayment()[$this->paymentType];
    }


}
