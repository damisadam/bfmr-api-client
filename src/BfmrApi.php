<?php

namespace damisadam\BfmrApiClient;

use Illuminate\Support\Facades\Http;

class BfmrApi
{
    protected $baseUrl;
    protected $key;
    protected $secret;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('bfmr.base_uri'), '/');
        $this->key = config('bfmr.api_key');
        $this->secret = config('bfmr.api_secret');
    }

    protected function headers()
    {
        return [
            'API-KEY' => $this->key,
            'API-SECRET' => $this->secret,
        ];
    }

    public function getDeals($params = [])
    {
        return Http::withHeaders($this->headers())
            ->get("{$this->baseUrl}/api/v2/deals", $params)
            ->json();
    }

    public function reserveDeal($data)
    {
        return Http::withHeaders($this->headers())
            ->asForm()
            ->post("{$this->baseUrl}/api/v2/deals/reserve", $data)
            ->json();
    }

    public function getActiveReservations()
    {
        return Http::withHeaders($this->headers())
            ->get("{$this->baseUrl}/api/v2/deal/reservations/active")
            ->json();
    }

    public function getDealDetails($slug)
    {
        return Http::withHeaders($this->headers())
            ->get("{$this->baseUrl}/api/v2/deals/{$slug}")
            ->json();
    }

    public function getMyTracker($params = [])
    {
        return Http::withHeaders($this->headers())
            ->get("{$this->baseUrl}/api/v2/my-tracker", $params)
            ->json();
    }

    public function postMyTracker(array $payload)
    {
        return Http::withHeaders($this->headers())
            ->post("{$this->baseUrl}/api/v2/my-tracker", $payload)
            ->json();
    }

    public function cancelPurchase(array $purchaseIds)
    {
        return Http::withHeaders($this->headers())
            ->post("{$this->baseUrl}/api/v2/my-tracker/purchase/cancel", [
                'purchase_id' => $purchaseIds
            ])
            ->json();
    }

    public function cancelReservation(array $reserveIds)
    {
        return Http::withHeaders($this->headers())
            ->post("{$this->baseUrl}/api/v2/my-tracker/reservation/cancel", [
                'reserve_id' => $reserveIds
            ])
            ->json();
    }

    public function getActiveRetailers($params = [])
    {
        return Http::withHeaders($this->headers())
            ->get("{$this->baseUrl}/api/v2/look-ups/retailers", $params)
            ->json();
    }

    public function submitAmazonOTP(array $otp_data)
    {
        return Http::withHeaders($this->headers())
            ->post("{$this->baseUrl}/api/v2/shipments/otp/amazon", [
                'otp_data' => $otp_data
            ])
            ->json();
    }

    public function getTrackingNumberStatus($params = [])
    {
        return Http::withHeaders($this->headers())
            ->get("{$this->baseUrl}/api/v2/shipments/status", $params)
            ->json();
    }
    public function doNotProcessShipment($params = [])
    {
        return Http::withHeaders($this->headers())
            ->post("{$this->baseUrl}/api/v2/shipments/do-not-process", $params)
            ->json();
    }
}