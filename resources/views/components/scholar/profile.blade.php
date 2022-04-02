@props(['user' => null])
<input type="checkbox" id="edit" class="modal-toggle">
    <div class="modal">
        <div class="modal-box relative">
            <label for="edit" class="absolute top-2 right-2">
                <img src="/img/icons/crud/x.svg" alt="">
            </label>
            <form action="{{route('scholar.profile.update', ['user' => $user->id])}}" method="POST">
                @csrf
                @method('PUT')
                <x-scholar.form.input name="user_name" label="Username/BRUname" :value="$user->user_name"/>

                <x-scholar.form.input readonly="1" name="first_name" label="First Name" :value="$user->first_name" />

                <x-scholar.form.input readonly="1" name="last_name" label="Last Name" :value="$user->last_name" />

                <x-scholar.form.input name="address" label="Address" :value="$user->address" />

                <x-scholar.form.input readonly="1" name="email" type="email" label="Email" :value="$user->email" />

                <x-scholar.form.password name="password" label="New Password" />

                <x-scholar.form.submit>
                    Update
                </x-scholar.form.submit>
            </form>
        </div>
    </div>
    <div  class="relative flex flex-col md:flex-row items-center justify-center md:justify-start p-4 bg-base-200 rounded-lg shadow">
        <label for="edit" class="absolute right-2 top-2 text-blue-700 text-sm underline underline-offset-1 cursor-pointer">
            <img src="/img/icons/crud/edit.svg" alt="">
        </label>
        <div x-on:mouseover="isHover = true" x-on:mouseout="isHover = false" class="relative overflow-hidden w-24 h-24 rounded-full" x-data="{
            isHover:false,
        }">
            <img  src="/storage/{{$user->picture}}" alt="" x-bind:class="{'blur brightness-125':isHover}" class=" w-24 h-24 rounded-full object-cover border-white border-4 shadow-lg">
            <div x-show="isHover" class="absolute w-24 h-24 top-0 bottom-0 left-0 right-0 flex items-center justify-center">
                <x-scholar.modal id="upload-image" no-button="1">
                    <x-slot name="trigger">
                        <label for="upload-image">
                            <div class="flex justify-center">
                                <img src="/img/icons/crud/upload.svg" alt="">
                            </div>
                            <div class="uppercase font-bold text-xs text-center">
                                Update
                            </div>
                        </label>
                    </x-slot>
                    <form action="{{route('scholar.profile.update.picture')}}" method="POST">
                        @csrf
                        @method('PUT')
                        <x-scholar.form.filepond name="file" accept="image" label="Upload New Image" enable="#upload-button"/>
                        <x-scholar.form.submit disabled="1" id="upload-button">
                            Submit
                        </x-scholar.form.submit>
                    </form>
                </x-scholar.modal>
            </div>
        </div>
        <div class="ml-4">
            <h2 class="text-xl font-bold text-gray-700 uppercase dark:text-white">{{$user->name}}</h2>
            <div class="text-sm">
                {{$user->user_name}} | {{auth()->user()->role}}
            </div>
            <div class="text-xs">
                {{$user->email}}
                @if ($user->hasVerifiedEmail())
                    <span class="text-green-700">
                        ( Verified )
                    </span>
                @else
                    <span class="text-red-700">
                        ( Unverified )
                    </span>
                @endif
                @if (! is_null($user->phone))
                    | {{$user->phone}}
                @endif
            </div>
            <div>
                Joined at {{$user->created_at->format('M d, Y')}}
            </div>
        </div>
    </div>
