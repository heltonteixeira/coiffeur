<?php

namespace App;

use App\Job;
use App\Service;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];

    protected $dates = [
        'birthday',
    ];

    public function formdata()
    {
        $data = collect([
            'cellphone' => $this->cellphone(),
            'phone' => $this->phone(),
            'address' => $this->address(),
            'birthday' => $this->birthday ? $this->formattedBirthday() . ' (' . $this->age() . ')' : null,
            'email' => $this->mailLink(),
            // 'facebook' => $this->messengerLink(),
            // 'instagram' => $this->instagramLink(),
            // 'whatsapp' => $this->whatsappLink(),
            // 'gender' => $this->gender,
        ]);

        return $data->filter(function ($item) {
            return !is_null($item);
        });
    }

    public function address()
    {
        $address = null;
        $city = null;

        if ($this->address && $this->neighborhood) {
            $address .= $this->address . ' - ' . $this->neighborhood;
        }
        if ($this->address && is_null($this->neighborhood)) {
            $address .= $this->address;
        }
        if (is_null($this->address) && $this->neighborhood) {
            $address .= $this->neighborhood;
        }

        if ($this->city && $this->state) {
            $city .= $this->city . '/' . $this->state;
        }
        if ($this->city && is_null($this->state)) {
            $city .= $this->city;
        }
        if (is_null($this->city) && $this->state) {
            $city .= $this->state;
        }

        if (!is_null($address) && !is_null($city)) {
            return $address . ', ' . $city;
        }
    }

    public function formattedBirthday()
    {
        return $this->birthday ? $this->birthday->format('d/m/Y') : null;
    }

    public function age()
    {
        if (!$this->birthday) {
            return null;
        }
        return $this->birthday->diff(Carbon::now())
                    ->format('%y years');
    }

    public function cellphone()
    {
        return $this->cellphone ? $this->formatPhoneNumber($this->cellphone) : null;
    }

    public function phone()
    {
        return $this->phone ? $this->formatPhoneNumber($this->phone) : null;
    }

    public function mailLink()
    {
        return $this->email ? "<a href='mailto:{$this->email}'>{$this->email}</a>" : null;
    }

    public function whatsappLink()
    {
        if ($this->whatsapp) {
            return 'intent://send/+55' . $this->cellphone . '#Intent;scheme=smsto;package=com.whatsapp;action=android.intent.action.SENDTO;end';
        }
    }

    public function messengerLink()
    {
        return $this->facebook ? 'https://www.facebook.com/messages/t/' . $this->facebook : null;
    }

    public function instagramLink()
    {
        return $this->instagram ? 'https://www.instagram.com/' . $this->instagram : null;
    }

    public function formatPhoneNumber($number)
    {
        // if (is_null($number) || $number == '') {
        //     return null;
        // }

        $size = strlen(preg_replace("/[^0-9]/", "", $number));
        if ($size == 13) { // COM CÓDIGO DE ÁREA NACIONAL E DO PAIS e 9 dígitos
            return "+" . substr($number, 0, $size -11) . "(" . substr($number, $size -11, 2) . ") " . substr($number, $size -9, 5) . "-" . substr($number, -4);
        }
        if ($size == 12) { // COM CÓDIGO DE ÁREA NACIONAL E DO PAIS
            return "+" . substr($number, 0, $size -10) . "(" . substr($number, $size -10, 2) . ") " . substr($number, $size -8, 4) . "-" . substr($number, -4);
        }
        if ($size == 11) { // COM CÓDIGO DE ÁREA NACIONAL e 9 dígitos
            return "(" . substr($number, 0, 2) . ") " . substr($number, 2, 5) . "-" . substr($number, 7, 11);
        }
        if ($size == 10) { // COM CÓDIGO DE ÁREA NACIONAL
            return "(" . substr($number, 0, 2) . ") " . substr($number, 2, 4) . "-" . substr($number, 6, 10);
        }
        if ($size <= 9) { // SEM CÓDIGO DE ÁREA
            return substr($number, 0, $size -4) . "-" . substr($number, -4);
        }
    }

    public function lastService()
    {
        if (!$this->jobs->count()) {
            return 'No services realized yet.';
        }

        return 'Latest service realized ' . $this->jobs->sortByDesc('accomplished_at')->first()->accomplished_at->diffForHumans();
    }

    public function lastServiceName()
    {
        if (!$this->jobs->count()) {
            return 'No services realized yet.';
        }

        return $this->jobs->sortByDesc('accomplished_at')->first()->serviceName();
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    /**
     * Scope a query to only return clients with jobs in the given period
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  \App\Job $period
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasJobsAccomplished($query, $period)
    {
        return $query->whereHas('jobs', function ($query) use ($period) {
            return $query->accomplished($period);
        });
    }
}
