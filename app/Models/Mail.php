<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $table = 'mails';
    protected $guarded = false;

    const TYPE_QUESTION = 'question';
    const TYPE_CAREER = 'career';
    const TYPE_NULL = '';

    static function getType() {
        return [
            self::TYPE_QUESTION => 'Întrebare',
            self::TYPE_CAREER => 'Carieră',
            self::TYPE_NULL => '',
        ];
    }

    public function getContactTypeAttribute() {
        return self::getType()[$this->type];
    }

    const SOURCE_CONSULTATION = 1;
    const SOURCE_CONTACT = 2;
    const SOURCE_FEEDBACK = 3;
    const SOURCE_ABOUT = 4;
    const SOURCE_VACANCY = 5;
    const SOURCE_VACANCY_FULL = 6;
    const SOURCE_VACANCY_SPECIAL = 7;


    static function getSource() {
        return [
            self::SOURCE_CONSULTATION => trans('panel.consultation'),
            self::SOURCE_CONTACT => trans('panel.contact_page'),
            self::SOURCE_FEEDBACK => trans('panel.feedback'),
            self::SOURCE_ABOUT => trans('panel.company_page'),
            self::SOURCE_VACANCY => trans('panel.vacancy_cv'),
            self::SOURCE_VACANCY_FULL => trans('panel.vacancy_without_cv'),
            self::SOURCE_VACANCY_SPECIAL => trans('panel.vacancy_special'),

        ];
    }

    public function getSourceNameAttribute() {
        return self::getSource()[$this->source];
    }


    const STATUS_NEW = 'new';
    const STATUS_VIEW = 'viewed';
    const STATUS_WORK = 'work';
    const STATUS_OFFER = 'offer';
    const STATUS_WON = 'won';
    const STATUS_VISIT = 'visit';
    const STATUS_LOST = 'lost';


    static function getStatus() {
        return [

            self::STATUS_NEW => trans('panel.status_new'),
            self::STATUS_VIEW => trans('panel.status_view'),
            self::STATUS_WORK => trans('panel.status_work'),
            self::STATUS_OFFER => trans('panel.status_offer'),
            self::STATUS_WON => trans('panel.status_won'),
            self::STATUS_VISIT => trans('panel.status_visit'),
            self::STATUS_LOST => trans('panel.status_lost'),

        ];
    }

    public function getStatusNameAttribute() {
        return self::getStatus()[$this->status];
    }

    public function vacancy()
    {
        return $this->belongsTo('App\Models\Vacancy', 'vacancy_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
    public function userClosed()
    {
        return $this->belongsTo('App\Models\User', 'user_closed', 'id');
    }
    public function manager()
    {
        return $this->belongsTo('App\Models\User', 'manager_id', 'id');
    }
}
