<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\RaiseFundStatus;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\RaiseFund;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    use ApiResponseTrait;

    public function payment(Request $request, Campaign $campaign)
    {
        $data = $request->validate([
            'firstname' => 'required',
            'email' => 'required|email',
            'phone' => 'required|max:10',
            'amount' => 'required'
        ]);

        $data['txnid'] = Str::random();
        $data['campaign_id'] = $campaign->id;
        $data['productinfo'] = $campaign->name;
        $data['key'] = env('PAYU_KEY');
        $data['surl'] = route('api.payment.status', $campaign);
        $data['furl'] = route('api.payment.status', $campaign);

        $str = sprintf(
            '%s|%s|%s|%s|%s|%s|||||||||||%s',
            env('PAYU_KEY'),
            $data['txnid'],
            $data['amount'],
            $data['productinfo'],
            $data['firstname'],
            $data['email'],
            env('PAYU_SALT'),
        );

        $data['hash'] = hash('sha512', $str);

        return $this->responseOk($data);
    }

    public function status(Request $request, $slug)
    {

        $campaign = Campaign::where('slug', $slug)->first();

        RaiseFund::create([
            'campaign_id' => $campaign->id,
            'name' => $request->firstname,
            'email' => $request->email,
            'phone' => $request->phone,
            'amount' => $request->amount,
            'txnid' => $request->txnid,
            'status' => RaiseFundStatus::getStatus(strtolower($request->status)),
        ]);

        $msg = $request->status == 'success' ? 'Your payment has been successfully processed, thankyou for donating.' : 'We are sorry to inform you that your payment was not successful.';

        return redirect()->away("http://localhost:5173?msg=$msg&type=" . $request->status);
    }
}
