<?php

namespace App\Http\Controllers;

use App\Http\Resources\MemberResource;
use App\Models\File;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Traits\FileUploadTrait;

class MemberController extends SchoolController
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Per page count from request
        $perPage = $request->per_page;
        $members = Member::with(['user','country'])->paginate($perPage);
        dd($this->paginatedResourceCollection(MemberResource::class,$members));
        dd(MemberResource::collection($members));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'first_name'    => 'required|string|max:255',
                'last_name'     => 'required|string|max:255',
                'address'       => 'required|string',
                'mobile_number' => 'required|string|max:255',
                'dob'           => 'required|date_format:Y-m-d',
                'gender'        => 'required|in:1,2,3',
                'username'      => 'required|unique:users,username|max:255',
                'member_type'   => 'required|in:1,2',
                'email'         => 'required|email',
                'country'       => ['required', 'exists:countries,id'],
                'state'         => ['required', 'exists:states,id'],
                'city'          => ['required', 'exists:cities,id'],
                'pincode'       => 'required',
                'location'      => 'required|string',
                'profile_photo' => '|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $validator->validate();

            $inputs = $validator->safe()->only([
                'first_name',
                'last_name',
                'address',
                'mobile_number',
                'dob',
                'gender',
                'member_type',
                'country',
                'state',
                'city',
                'pincode',
                'location'
            ]);

            $user = User::create([
                'name'     => $inputs['first_name'],
                'email'    => $request->input('email'),
                'username' => $request->input('username'),
                'password' => Hash::make(date('dmY', strtotime($inputs['dob'])))
            ]);
            if ($request->hasFile('profile_photo')) {
                $this->storeFile($request->file('profile_photo'),'public/profilePhotos',"App\Models\User",File::USER_PROFILE_PHOTO,$user->id);
            }
            // dd($user->file()->file_name);
            $inputs['user_id'] = $user->id;

            Arr::forget($inputs, ['username', 'email']);
            $member =  Member::create($inputs);

            DB::commit();

            return $this->sendSuccessResponse($member, 'New member has been added');
        } catch (Exception $exception) {
            DB::rollBack();

            return $this->handleApiException($exception);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        try {

            $response = [
                'data'=>$member
            ];
            return $this->sendSuccessResponse($response,'Member fetched successfully');
        } catch  (Exception $exception) {
            return $this->handleApiException($exception);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        //
    }
}
