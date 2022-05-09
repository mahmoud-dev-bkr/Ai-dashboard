@extends("Dashboard-layouts.app-tailwind")
@section('content')
<style>
    .profile-img{
        margin-top:30px; 
        padding-left:20px; 
    }
    .profile-img img{
        border-radius:50%;
        border: 4px solid #1c3140 ; 
        width: 150px;
        margin: auto;
        
    }
    .profile-content{
        width: 80%;
    }
    /* .content{
        margin: auto;
 */
    /* } */
    .profile-content{
        padding-left: 60px;
    }
</style>

    <div class="profile-img">
        <img class="" src="{{asset("images/avatar.jpg")}}" alt="">
    </div>
    <div class="profile-content inline-block mx-auto">
        <div class="content container">
            
            <div class="items-center my-2 input-group">
                <label class="w-40">Name (en)</label>
                <input type="text" disabled class="w-full input bg-base-300/50" value="{{$users->name}}"  name="pay_date" />
            </div>

            <div class="items-center my-2 input-group">
                <label class="w-40">Name (ar) </label>
                <input type="text" disabled class="w-full input bg-base-300/50" value="{{$users->name_ar}}" name="pay_date" />
            </div>

            <div class="items-center my-2 input-group">
                <label class="w-40">Email</label>
                <input type="text" disabled class="w-full input bg-base-300/50" value="{{$users->email}}" name="pay_date" />
            </div>
            
            <div class="items-center my-2 input-group">
                <label class="w-40">Tel(1) </label>
                <input type="text" disabled class="w-full input bg-base-300/50" value="{{$users->Tel_1}}" name="pay_date" />
            </div>

            
            <div class="items-center my-2 input-group">
                <label class="w-40">Tel(2) </label>
                <input type="text" disabled class="w-full input bg-base-300/50" value="{{$users->Tel_2}}" name="pay_date" />
            </div>

            
            <div class="items-center my-2 input-group">
                <label class="w-40">Tel(3) </label>
                <input type="text" disabled class="w-full input bg-base-300/50" value="{{$users->Tel_3}}" name="pay_date" />
            </div>

            <div class="items-center my-2 input-group mb-3">
                <label class="w-40">Role </label>
                <input type="text" disabled class="w-full input bg-base-300/50" value="{{$user_role->name}}" name="pay_date" />
            </div>
            
        <a href="{{ route('updatePage', $users->id) }}"  data-mdb-ripple="true" data-mdb-ripple-color="light"
        class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Update
        Profile</a>

        <a  href="{{url("admin/profile/changepassword")}}" data-mdb-ripple="true" data-mdb-ripple-color="light"
            class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Change Password</a>
        </div>
    </div>

@endsection
@section('scripts')


@endsection