<?php

namespace App;

use App\Client;
use App\Service;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $guarded = [];

    protected $dates = [
        'accomplished_at',
    ];

    public function formattedAccomplishedAt()
    {
        return $this->accomplished_at->format('d/m/Y H:i');
    }

    public function accomplishedAtDate()
    {
        return $this->accomplished_at->format('d/m/Y');
    }

    public function accomplishedAtHour()
    {
        return $this->accomplished_at->format('H:i');
    }

    public function clientName()
    {
        return $this->client->name;
    }

    public function serviceName()
    {
        return $this->service->name;
    }

    public function paymentMethod()
    {
        switch ($this->payment_method) {
            case 0:
                return 'A vista (Dinheiro)';
            case 1:
                return 'A vista (Débito)';
            case 2:
                return 'A vista (Crédito)';
            case 3:
                return '2x (Crédito)';
            case 4:
                return '3x (Crédito)';
            default:
                return 'Unknow payment method.';
        }
    }

    public function price()
    {
        return 'R$' . number_format($this->total_cost, 2, ',', '.');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function scopeAccomplished($query, $period)
    {
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);

        switch ($period) {
            case 'this week':
                $start = Carbon::now()->startOfWeek();
                $end = Carbon::now()->endOfWeek();
                break;
            case 'last week':
                $start = Carbon::now()->subWeek()->startOfWeek();
                $end = Carbon::now()->subWeek()->endOfWeek();
                break;
            case 'this month':
                $start = Carbon::now()->startOfMonth();
                $end = Carbon::now()->endOfMonth();
                break;
            case 'last month':
                $start = Carbon::now()->startOfMonth()->subMonth();
                $end = Carbon::now()->startOfMonth()->subMonth()->endOfMonth();
                break;
            default:
                $start = Carbon::now()->startOfDay();
                $end = Carbon::now()->endOfDay();
                break;
        }
            
        return $query->whereBetween('accomplished_at', [$start, $end]);
    }

    public function scopeAccomplishedBetween($query, $start)
    {
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);

        $start = Carbon::parse($start)->startOfMonth();
        $end = Carbon::parse($start)->endOfMonth();
            
        return $query->whereBetween('accomplished_at', [$start, $end]);
    }
}
