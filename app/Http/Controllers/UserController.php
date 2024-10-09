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
use Illuminate\Database\QueryException;

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
     *
     * @return Response
     */
    public function index(UserDataTable $userDataTable, Request $request)
    {
        
        // Get all available roles for the filter dropdown
        $roles = Role::all();
    
        // Pass roles to the view, DataTables will handle the rest
        return $userDataTable->render('users.index', compact('roles'));
    }
    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        if (auth()->user()->hasRole('admin')) {
            // Ensure admins can only assign the student role
            $roles = Role::where('name', 'student')->pluck('name', 'id')->toArray();
        } else {
            // Super admins can assign any role
            $roles = Role::pluck('name', 'id')->toArray();
        }

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

        // Wrapping everything in a try-catch block to handle errors gracefully
        try {
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
    
            // Create the user
            $user = $this->userRepository->create($input);
    
            // Check if a role is selected and assign the role
            if (!empty($input['role'])) {
                $role = Role::findById($input['role']); // Use 'role' instead of 'role_id'
                $user->assignRole($role); // Assign the role to the user
            }
    
            // Save the user after assigning roles
            $user->save();
    
            // If everything goes well, flash success message
            Flash::success('User saved successfully.');
            return redirect(route('users.index'));
    
        } catch (QueryException $e) {
            // If there's a query error (e.g., database issues or duplicate entry), catch it
    
            // Roll back user creation if something went wrong with roles
            if (isset($user)) {
                $user->delete(); // Optional: delete the user if roles weren't successfully assigned
            }
    
            // Log the error for debugging purposes (optional)
            \Log::error($e->getMessage());
    
            // Flash an error message for the user
            Flash::error('An error occurred while saving the user. Please try again.');
            return redirect()->back()->withInput(); // Return to the form with previous input
        } catch (\Exception $e) {
            // Catch any general exceptions
            \Log::error($e->getMessage()); // Log the error
    
            // Roll back user creation if an error occurred
            if (isset($user)) {
                $user->delete(); // Optional: remove user if other steps fail
            }
    
            // Flash an error message
            Flash::error('Something went wrong. Please try again.');
            return redirect()->back()->withInput(); // Return back to form with input
        }
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
      
        if (auth()->user()->hasRole('admin') && !$user->hasRole('student') && $user->id =!auth()->user()->id) {
            abort(403, 'Unauthorized action.');
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
    
        // Get roles to display in the dropdown
       

        // Ensure that admins can only edit students
        if (auth()->user()->hasRole('admin') && !$user->hasRole('student')) {
            abort(403, 'Unauthorized action.');
        }
    
        $roles = auth()->user()->hasRole('admin') ? Role::where('name', 'student')->pluck('name', 'id')->toArray() : Role::pluck('name', 'id')->toArray();
    
    
        // Get the user's current role ID
        $selectedRole = $user->roles->first() ? $user->roles->first()->id : null;
    
        return view('users.edit')->with([
            'user' => $user,
            'roles' => $roles,
            'selectedRole' => $selectedRole
        ]);
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
    
        // Check if the user exists
        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('users.index'));
        }
    
        // Validate the request, passing the user ID to the validation rules
        $request->validate(UpdateUserRequest::rules($user->id));
    
        // Update the user's information
        $input = $request->all();
    
        // Only hash the password if a new one is provided
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']); // Remove the password from the update if it's not being changed
        }
    
        $user = $this->userRepository->update($input, $id);
    
        // Update the role if provided
        if (!empty($input['role'])) {
            $role = Role::findById($input['role']);
            $user->syncRoles([$role]);
        }
    
        Flash::success('User updated successfully.');
        return redirect(route('users.index'));
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
 // Ensure that admins can only delete students
 if (auth()->user()->hasRole('admin') && !$user->hasRole('student')) {
    abort(403, 'Unauthorized action.');
}

// Prevent the deletion of super admins
if ($user->hasRole('super admin')) {
    abort(403, 'Super admins cannot be deleted.');
}
        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }




    public function updateProfile(CreateUserRequest $request)
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
    public function search(Request $request)
    {
        $query = $request->get('q'); // Get the search query
    
        // Find users where the name matches the search query
        $users = User::where('name', 'LIKE', "%$query%")->get();
    
        // Return a JSON response with the id and name of the users
        return response()->json($users->map(function($user) {
            return [
                'id' => $user->id,
                'name' => $user->name
            ];
        }));
    }
    

}
