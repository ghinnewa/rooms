<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use Flash;
use Illuminate\Http\Request;
use App\Models\Card;

use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Hash;
use Response;
// use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role ;
use Throwable;

class UserController extends AppBaseController
{
    /** @var UserRepository $userRepository*/
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
        // $this->middleware('CheckAdminRoles')->only('edit');

        $this->middleware('permission:users.index')->only('index');
        $this->middleware('permission:users.show')->only('show');
        $this->middleware('permission:users.create')->only('create');
        $this->middleware('permission:users.edit')->only('edit');
        $this->middleware('permission:users.store')->only('store');
        // $this->middleware('permission:users.destroy')->only('destroy');
        $this->middleware('permission:users.update')->only('update');

    }

    /**
     * Display a listing of the User.
     *
     * @param UserDataTable $userDataTable
     *
     * @return Response
     */
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('users.index');
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id')->toArray();

        return view('users.create')->with('roles', $roles);
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {

            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user = $this->userRepository->create($input);


                $role=Role::findById($input['role_id']);
                $user->assignRole($role);
                $user->save();





            Flash::success('User saved successfully.');

        return redirect(route('users.index'));
    }


    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }
        if (auth()->user()->hasRole('student') && auth()->user()->id !== $user->id) {
            abort(403, 'Unauthorized access');
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);
    
        // If user is not found
        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }
    
        // If the user is a student, ensure they can only edit their own profile
        if (auth()->user()->hasRole('student') && auth()->user()->id !== $user->id) {
            abort(403, 'Unauthorized access');
        }
    
        // Get roles only if the current user is an admin
        $roles = auth()->user()->hasRole('admin|system admin') ? Role::pluck('name', 'id')->toArray() : [];
    
        return view('users.edit')->with('user', $user)->with('roles', $roles);
    }
    

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);
    
        // If user is not found
        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }
    
        // Ensure students can only update their own profiles
        if (auth()->user()->hasRole('student') && auth()->user()->id !== $user->id) {
            abort(403, 'Unauthorized access');
        }
    
        $input = $request->all();
    
        // Hash the password if it's being updated
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']); // Do not update the password if it's not provided
        }
    
        // Update user information
        $user = $this->userRepository->update($input, $id);
    
        // Update role only if the current user is an admin
        if (auth()->user()->hasRole('admin|system admin') && !empty($input['role_id'])) {
            $role = Role::findById($input['role_id']);
            $user->syncRoles($role);
        }
    
        Flash::success('User updated successfully.');
    
        return redirect(auth()->user()->hasRole('student') ? route('users.show', $user->id) : route('users.index'));
    }
    

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }
    public function updateProfile(Request $request)
{
    $user = auth()->user();
    
    $input = $request->except('roles');
    
    if($request->has('password')){
        $input['password'] = bcrypt($request->password);
    } else {
        unset($input['password']);
    }

    $user->update($input);

    return redirect()->route('my-profile.edit')->with('success', 'Profile updated successfully');
}

public function showQrScanner()
    {
        return view('qr');  // Ensure that you have a Blade file named 'scan-qr.blade.php'
    }
    public function checkCardAvailability(Request $request)
    {
        $qrCode = $request->input('qr_code');

        // Assuming 'qrcode' is the field in the 'cards' table that stores the QR code
        $card = Card::where('qrcode', $qrCode)->first();

        if ($card) {
            return response()->json(['exists' => true]);
        } else {
            return response()->json(['exists' => false]);
        }
    }


    public function verifyCard(Request $request)
    {
        $qrCodeData = $request->input('qr_code');
    
        // Decode the JSON data from the QR code
        $decodedData = json_decode($qrCodeData, true);
    
        if (!$decodedData || !isset($decodedData['id'])) {
            return response()->json(['exists' => false]);
        }
    
        // Now search for the card using the ID from the QR code
        $card = Card::find($decodedData['id']);
    
        if ($card) {
            // Check if the card is approved
            if ($card->paid) {
                return response()->json(['exists' => true, 'approved' => true]);
            } else {
                return response()->json(['exists' => true, 'approved' => false]);
            }
        } else {
            return response()->json(['exists' => false]);
        }
    }
    
}
