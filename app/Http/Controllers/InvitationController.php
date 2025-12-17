<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Http\Controllers\Controller;
use App\Http\Requests\InviteUserRequest;
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

class InvitationController extends Controller
{
    use AuthorizesRequests;
    use RoleTrait;
    protected  $staticData;
    public function __construct(StaticDataService $staticData)
    {
        return $this->staticData = $staticData;
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invitations = Invitation::paginate(5);
        return view('invitations.index', compact('invitations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('invite-create-view')) {
            abort(403, 'You are not allowed for this action');
        }

        $user = auth()->user();
        $policy = app(InvitationPolicy::class);
        $staticData = $this->staticData->getData();

        $response = [
            'roles'     => collect(),
            'companies' => collect(),
        ];

        // Roles 
        $allowedRoles = $policy->visibleRoles($user);
        if (!empty($allowedRoles)) {
            $response['roles'] = $staticData['roles']
                ->whereIn('name', $allowedRoles)
                ->values();
        }

        // Companies for SuperAdmin
        if ($policy->visibleCompanies($user) === 'ALL') {
            $response['companies'] = $staticData['companies'];
        }
        // Companies for Admin
        if ($policy->visibleCompanies($user) === 'OWN') {
            $response['companies'] = $staticData['companies']
                ->where('id', $user->company_id)
                ->values();
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

        // dd( $validatedData);


        if (! Gate::allows('create', [
            Invitation::class,
            $validatedData['company_id'],
            $roleId
        ])) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'You are not authorized to invite this user');
        }


        Invitation::create([
            'company_id' => $validatedData['company_id'],
            'invited_by' => auth()->id(),
            'role_id'    => $roleId,
            'name'       => $validatedData['name'],
            'email'      => $validatedData['email'],
        ]);

        return redirect()
            ->back()
            ->with('success', 'Invitation sent successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invitation $invitation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invitation $invitation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invitation $invitation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invitation $invitation)
    {
        //
    }
    public function accept(Request $request, $id)
    {
        dd($request->all());
        $invitation = Invitation::findOrFail($id);

        $this->authorize('accept', $invitation);

        DB::transaction(function () use ($invitation) {

            $user = User::create([
                'name'       => $invitation->name,
                'email'      => $invitation->email,
                'password'   => bcrypt('password'),
                'company_id' => $invitation->company_id,
            ]);

            $user->roles()->attach($invitation->role_id);

            $invitation->update(['status' => 'accepted']);
        });

        return redirect()
            ->route('dashboard')
            ->with('success', 'Invitation accepted');
    }
    public function reject(Request $request, $id)
    {
        dd($request->all());
        $invitation = Invitation::findOrFail($id);

        $this->authorize('reject', $invitation);

        $invitation->update(['status' => 'rejected']);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Invitation rejected');
    }
}
