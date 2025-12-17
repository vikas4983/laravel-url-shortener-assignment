<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateShortUrlRequest;
use App\Models\ShortUrl;
use App\Policies\InvitationPolicy;
use App\Policies\ShortUrlPolicy;
use App\services\StaticDataService;
use Faker\Provider\Base;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use ParagonIE\ConstantTime\Base64;

class ShortUrlController extends Controller
{
    protected  $staticData;
    public function __construct(StaticDataService $staticData)
    {
        return $this->staticData = $staticData;
    }
    public function index()
    {
        $user = auth()->user();
        $policy = app(ShortUrlPolicy::class);
        $shortUrls =  $policy->view($user);
        return view('shorturls.index', compact('shortUrls'));
    }
    public function craete()
    {
        if (Gate::denies('shortUrl-create-view')) {
            return redirect()->back()->with('error', 'You are not allowed');
        }
        $user = auth()->user();
        $policy = app(ShortUrlPolicy::class);
        $staticData = $this->staticData->getData();
        $response = [
            'companies' => collect(),
        ];

        //  Companies for Admin
        if ($policy->visibleCompanies($user) === 'OWN') {
            $response['companies'] = $staticData['companies']
                ->where('id', $user->company_id)
                ->values();
        }
        //  Companies for Member
        if ($policy->visibleCompanies($user) === 'OWN') {
            $response['companies'] = $staticData['companies']
                ->where('id', $user->company_id)
                ->values();
        }

        return view('shorturls.create', ['staticData' => $response]);
    }
    public function store(CreateShortUrlRequest $request)
    {
        $validatedData = $request->validated();
        $exists = ShortUrl::where('original_url', $validatedData['original_url'])->first();
        if (!$exists) {
            $shortUrl =  ShortUrl::create([
                'original_url' => $validatedData['original_url'],
                'user_id' => auth()->id(),
                'company_id' => $validatedData['company_id'],
            ]);
            $encoded_string = base64_encode($shortUrl->id);
            $shortUrl->update([
                'short_code' => $encoded_string
            ]);
            $staticData = $this->staticData->getData();
            return redirect()->route('shortUrls.index')->with('success', 'ShortUrl created successfully');
        }else{
            return redirect()->route('shortUrls.index')->with('error', 'ShortUrl already created ');
        }
    }
    public function redirect(Request $request)
    {
        dd($request->all());
    }
}
