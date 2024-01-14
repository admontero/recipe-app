<?php

namespace App\Http\Controllers\Back;

use App\Actions\User\DeleteUserAction;
use App\Actions\User\UpsertUserAction;
use App\DataTransferObjects\UserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Traits\Validation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class UserController extends Controller
{
    use Validation;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('back.users.index', [
            'users' => User::select('id', 'name', 'email', 'is_admin')
                ->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('back.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request, UpsertUserAction $upsertUserAction): RedirectResponse
    {
        $this->authorize('create', User::class);

        $upsertUserAction->handle(UserData::fromRequest($request));

        return Redirect::route('back.users.index')
            ->with('status', 'modules.user.success.saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        return view('back.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user, UpsertUserAction $upsertUserAction): RedirectResponse
    {
        $this->authorize('update', $user);

        if ($this->isLastAdmin($user, (bool) $request->validated('is_admin')))
            return Redirect::back()->with('status', 'modules.user.danger.minimun');

        $upsertUserAction->handle(UserData::fromRequest($request), $user);

        return Redirect::route('back.users.index')
            ->with('status', 'modules.user.success.saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, DeleteUserAction $deleteUserAction): RedirectResponse
    {
        $this->authorize('delete', $user);

        if ($this->isLastAdmin($user))
            return Redirect::back()->with('status', 'modules.user.danger.minimun');

        $deleteUserAction->handle($user);

        if (! auth()->check()) return redirect('/');

        return Redirect::route('back.users.index')
            ->with('status', 'modules.user.success.deleted');
    }
}
