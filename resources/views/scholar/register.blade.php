<x-scholar.layout>
      <div class="flex justify-center">

        <form action="{{route('scholar.register')}}" method="POST" class="w-full mt-4" enctype="multipart/form-data">
            <h1 class="text-2xl mb-4 uppercase font-bold">Scholar's Registration Page</h1>
             <x-scholar.page.typing loop="1" delay="20" pause="2000" :message="['Hello! Welcome to BRUMULTIVERSE!', 'The Sign Up page is for authors, artists and creators who have received their contracts with BRUMULTIVERSE.', 'If you have no contract yet and are looking to join the growing BRU family, please click I HAVE NO AAN YET.', 'If you have a contract with BRU and have not received your AAN yet, please click on the same link. Thank you!']" />
            @csrf

            <x-scholar.form.input label="AAN" name="aan" help="<a href='/contact-form' class='block animate-bounce text-purple-700' >I have no yet AAN</a>" />

            <x-scholar.form.select name="role" label="Register As">
                <option value="{{\App\Models\User::ROLE_AUTHOR}}">{{\App\Models\User::ROLE_AUTHOR}}</option>
                <option value="{{\App\Models\User::ROLE_ARTIST}}">{{\App\Models\User::ROLE_ARTIST}}</option>
            </x-scholar.form.select>

            <div class="flex w-full">
                <div class="w-1/2 pr-1">
                    <x-scholar.form.input name="first_name" label="First Name"/>
                </div>
                <div class="w-1/2 pl-1">
                    <x-scholar.form.input name="last_name" label="Last Name"/>
                </div>
            </div>


        <x-scholar.form.input name="user_name" label="Username"/>

        <div class="flex w-full">
            <div class="w-1/2 pr-1">
                <x-scholar.form.select name="gender" label="Gender">
                    <option value="{{\App\Models\User::GENDER_FEMALE}}">{{\App\Models\User::GENDER_FEMALE}}</option>
                    <option value="{{\App\Models\User::GENDER_MALE}}">{{\App\Models\User::GENDER_MALE}}</option>
                    <option value="{{\App\Models\User::GENDER_LGBT}}">{{\App\Models\User::GENDER_LGBT}}</option>
                </x-scholar.form.select>
            </div>
            <div class="w-1/2 pl-1">
                <x-scholar.form.select name="sex" label="Sex">
                    <option value="{{\App\Models\User::GENDER_FEMALE}}">{{\App\Models\User::GENDER_FEMALE}}</option>
                    <option value="{{\App\Models\User::GENDER_MALE}}">{{\App\Models\User::GENDER_MALE}}</option>
                </x-scholar.form.select>
            </div>
        </div>

        <x-scholar.form.input name="address" label="Complete Address" />

        <x-scholar.form.select name="country" label="Country">
            {{-- {{dd(\App\Helpers\CountryHelper::getAllCountriesForSelect())}} --}}
            @foreach (\App\Helpers\CountryHelper::getAllCountries() as $key => $val)
                <option value="{{$key}}">{{$val}}</option>
            @endforeach
        </x-scholar.form.select>

        <x-scholar.form.input name="city" label="City"/>

        <x-scholar.form.file name="picture" label="Picture"/>

        <x-scholar.form.date name="birth_date" label="Birthdate" help="You must be 15 years old or above to register and use this site."/>

        <div x-data="{
            college:null,
            colleges:null,
            init() {
                this.college = {{$colleges[0]->id}};
            }
        }">

            <x-scholar.form.select model="college" name="college" label="College">
                @foreach ($colleges as $c)
                <option value="{{$c->id}}">
                    {{$c->name}}
                </option>
                @endforeach
            </x-scholar.form.select>

            @foreach ($colleges as $college)
                <template x-if="college == {{$college->id}}">
                    <x-scholar.form.select name="course" label="Course">
                        @foreach ($college->courses as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </x-scholar.form.select>
                </template>

                <template x-if="college == {{$college->id}}">
                    <x-scholar.form.select name="club" label="Club">
                        @foreach ($college->clubs as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </x-scholar.form.select>
                </template>
            @endforeach

        </div>

        <x-scholar.form.input type="email" name="email" label="Email"/>

        <x-scholar.form.password name="password" label="Password"/>

        <x-scholar.form.password name="password_confirmation" label="Confirm Password"/>


        <x-scholar.form.submit extra="btn-block">
            Register
        </x-scholar.form.submit>
        </form>
    </div>
    <x-vendor.typewriterjs/>
    <x-vendor.alpinejs/>
</x-scholar.layout>
