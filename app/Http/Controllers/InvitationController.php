<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Http\Controllers\Controller;
use App\Http\Requests\InviteUserRequest;
use App\Jobs\SendInvitationJob;
use App\Models\Role;
use App\Models\User;
use App\Policies\InvitationPolicy;
use App\services\StaticDataService;
use App\Traits\RoleTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class InvitationController extends Controller
{
    use AuthorizesRequests;
    protected $staticData;
    public function __construct(StaticDataService $staticData)
    {
        return $this->staticData = $staticData;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $policy = app(InvitationPolicy::class);
        $invitations = $policy->view($user);

        return view('invitations.index', compact('invitations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $policy = app(InvitationPolicy::class);
        $staticData = $this->staticData->getData();
        $response = [
            'roles' => collect(),
            'companies' => collect(),
        ];
        $allowedRoles = $policy->visibleRoles($user);
        if (!empty($allowedRoles)) {
            $response['roles'] = $staticData['roles']->whereIn('name', $allowedRoles)->values();
        }
        // Companies for SuperAdmin
        if ($policy->visibleCompanies($user) === 'ALL') {
            $response['companies'] = $staticData['companies'];
        }
        // Companies for Admin
        if ($policy->visibleCompanies($user) === 'OWN') {
            $response['companies'] = $staticData['companies']->where('id', $user->company_id)->values();
        }
        return view('invitations.create', ['staticData' => $response]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InviteUserRequest $request)
    {
        $validatedData = $request->validated();
        $roleId = (int) $validatedData['role_id'];
        if (!Gate::allows('create', [Invitation::class, $validatedData['company_id'], $roleId])) {
            return redirect()->back()->withInput()->with('error', 'You are not authorized to invite this user');
        }

        DB::beginTransaction();

        try {
            $invite = Invitation::create([
                'company_id' => $validatedData['company_id'],
                'invited_by' => auth()->id(),
                'role_id' => $roleId,
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
            ]);
            SendInvitationJob::dispatch($invite);
            DB::commit();
            return redirect()->back()->with('success', 'Invitation sent successfully');
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Invitation transaction failed', [
                'invite' => $invite ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
