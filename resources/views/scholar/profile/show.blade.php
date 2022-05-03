<x-scholar.layout>
    <x-scholar.page.title>
        Profile
    </x-scholar.page.title>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => '#',
                    'label' => 'My Profile',
                ]
            ]
        "
    />
    <x-scholar.profile :user="$user"/>
    <div class="mt-4">
        <x-scholar.table responsive="0">
            <x-slot name="label">
                Pen Names <span class="text-xs font-thin">({{$user->accounts()->count()}}/{{nova_get_setting('max_account', 3)}})</span>
            </x-slot>
           @if (count($user->accounts) < nova_get_setting('max_account', 3))
                <x-slot name="option">
                    <x-scholar.modal id="create-pen-name" no-button="1">
                        <x-slot name="trigger">
                            <label for="create-pen-name" class="btn btn-sm">
                                create pen name
                            </label>
                        </x-slot>
                        <form action="{{route('scholar.profile.account.register')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <x-scholar.form.input
                            help="Please note that your pen names become permanent when used on an uploaded material."
                            name="penname" label="Pen-name"/>

                            <x-scholar.form.select
                                label="Gender"
                                name="gender">
                                <option value="{{\App\Models\User::GENDER_MALE}}">
                                    {{\App\Models\User::GENDER_MALE}}
                                </option>
                                <option value="{{\App\Models\User::GENDER_FEMALE}}">
                                    {{\App\Models\User::GENDER_FEMALE}}
                                </option>
                                <option value="{{\App\Models\User::GENDER_LGBT}}">
                                    {{\App\Models\User::GENDER_LGBT}}
                                </option>
                            </x-scholar.form.select>

                            <x-scholar.form.select label="Type" name="type">
                                <option value="Author">Author</option>
                                <option value="Artist">Artist</option>
                            </x-scholar.form.select>

                            <x-scholar.form.select
                                name="country"
                                label="Country"
                            >
                                @foreach (\App\Helpers\CountryHelper::getAllCountries() as $key=>$value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </x-scholar.form.select>

                            <x-scholar.form.file help="This is the profile photo of your pen name or your scholar persona. This will be shown to the public." name="picture" label="Picture"/>

                            <x-scholar.form.submit>
                                Submit
                            </x-scholar.form.submit>
                        </form>
                    </x-scholar.modal>
                </x-slot>
           @endif
            <thead class="dark:bg-gray-900">
                <tr class="dark:bg-gray-900">
                    <th class="dark:bg-gray-900 dark:text-white">
                        Date
                    </th>
                    <th></th>
                    <th class="dark:bg-gray-900 dark:text-white">
                        Pen Name
                    </th>
                    <th class="dark:bg-gray-900 dark:text-white">
                        Type
                    </th>
                    <th class="dark:bg-gray-900 dark:text-white">
                        Country
                    </th>
                    <th class="dark:bg-gray-900 dark:text-white">
                        Gender
                    </th>
                    <th class="dark:bg-gray-900 dark:text-white">

                    </th>
                </tr>
            </thead>
            <tbody >
                @foreach ($user->accounts as $a)
                    <tr>
                        <td class="dark:bg-gray-900 dark:text-white">
                            {{$a->created_at->format('m/d/y')}}
                        </td>
                        <td>
                            <x-scholar.modal no-button="1">
                                <x-slot name="trigger">
                                    <div class="tooltip tooltip-right" data-tip="click to upload new picture">
                                        <img  src="/img/profiles/30-30-{{$a->picture}}" alt=""  class=" block w-10 h-10 object-cover rounded-full border-2">
                                    </div>
                                </x-slot>
                                <form action="{{route('scholar.profile.account.picture.update', ['account' => $a->id])}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <x-scholar.form.file name="file" label="New Picture"/>
                                        <x-scholar.form.submit>
                                            Submit
                                        </x-scholar.form.submit>
                                    </div>
                                </form>
                            </x-scholar.modal>

                        </td>
                        <td class="dark:bg-gray-900 dark:text-white">
                            {{$a->penname}}
                        </td>
                        <td class="dark:bg-gray-900 dark:text-white">
                            {{$a->type}}
                        </td>
                        <td class="dark:bg-gray-900 dark:text-white">
                            {{$a->country_full}}
                        </td>
                        <td class="dark:bg-gray-900 dark:text-white">
                            {{$a->gender}}
                        </td>
                        <td class="dark:bg-gray-900 dark:text-white">
                            @if (is_null($a->approved_at))
                                <x-scholar.modal button="delete" id="delete{{$a->id}}" extra="btn-xs bg-red-600 hover:bg-red-700 border-none text-white text-xs">
                                    <form action="{{route('scholar.profile.account.delete', ['account' => $a->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="font-bold text-xl">
                                            Are you sure you want to delete this account?
                                        </div>
                                        <div class="mt-2">
                                            <button class="btn btn-sm">
                                                Yes
                                            </button>
                                            <label for="delete{{$a->id}}" class="btn bg-white hover:bg-gray-200 text-gray-900 btn-sm">
                                                No
                                            </label>
                                        </div>
                                    </form>
                                </x-scholar.modal>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-scholar.table>
    </div>
    @push('head-script')
        <x-vendor.alpinejs/>
    @endpush
</x-scholar.layout>
