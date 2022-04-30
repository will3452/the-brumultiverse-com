<x-scholar.layout>
      <div class="flex justify-center">

        <form action="{{route('scholars.register')}}" method="POST" class="w-full mt-4" enctype="multipart/form-data">
            <h1 class="text-2xl mb-4 uppercase font-bold">Scholar's Registration Page</h1>
             <x-scholar.page.typing loop="1" delay="20" pause="2000" :message="['Hello! Welcome to BRUMULTIVERSE!', 'The Sign Up page is for authors, artists and creators who have received their contracts with BRUMULTIVERSE.', 'If you have no contract yet and are looking to join the growing BRU family, please click I HAVE NO AAN YET.', 'If you have a contract with BRU and have not received your AAN yet, please click on the same link. Thank you!']" />
            @csrf

            <x-scholar.form.input label="AAN" name="aan" help="<a href='/contact-form' class='block  text-purple-700' >I have no yet AAN</a>" />

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

        <div class="flex w-full">
        <x-scholar.form.select name="sex" label="Sex">
            <option value="{{\App\Models\User::GENDER_FEMALE}}">{{\App\Models\User::GENDER_FEMALE}}</option>
            <option value="{{\App\Models\User::GENDER_MALE}}">{{\App\Models\User::GENDER_MALE}}</option>
        </x-scholar.form.select>
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

        <div class="shadow-lg mb-2 bg-yellow-100 text-yellow-900 flex p-4 text-xs rounded items-center">
            <div>
                <x-scholar.form.checkbox label="TERMS AND CONDITION"/>
                <div class="pl-7" id="tncc">
                    I have read and I agree with the <a href="#tnc" class="underline underline-offset-0 font-bold">Terms and Conditions.</a>
                    <div class="modal bg-white" id="tnc">
                        <div class="modal-box w-full w-11/12 max-w-5xl h-96">
                            <iframe src="/terms-and-conditions" class="w-full h-72" frameborder="0"></iframe>
                            <a href="#tncc" class="btn btn-sm mt-4 btn-block">Close</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="shadow-lg mb-2 bg-yellow-100 text-yellow-900 flex p-4 text-xs rounded items-center">
            <div>
                <x-scholar.form.checkbox label="ARE YOU SURE ABOUT ALL THE INFORMATION YOU HAVE DECLARED?"/>
                <div class="pl-7">
                    I certify that all information I have declared in this registration are true and correct to the best of my knowledge. I further understand that any false statement may result in denial or revocation of my account.
                </div>
            </div>
        </div>
        <div class="shadow-lg mb-2 bg-yellow-100 text-yellow-900 flex p-4 text-xs rounded items-center">
            <div>
                <x-scholar.form.checkbox label="COPYRIGHT CERTIFICATION"/>
                <div class="pl-7">
                    This is to reaffirm my duty to ensure all materials under my name and account in the BRUMULTIVERSE site and/or app are my property, and that I own the rights to them or I have obtained approval in writing to use them, as stated in my contract with BRUMULTIVERSE.
                </div>
            </div>
        </div>
        <div class="shadow-lg mb-2 bg-yellow-100 text-yellow-900 flex p-4 text-xs rounded items-center">
            <div>
                <x-scholar.form.checkbox label="DATA PRIVACY"/>

                <div class="pl-7" id="ppc">
                     I have read and I agree with the <a href="#pp" class="underline underline-offset-0 font-bold" >Privacy Policy.</a>
                     <div class="modal bg-white" id="pp">
                        <div class="modal-box w-full w-11/12 max-w-5xl h-96">
                            <iframe src="/privacy-policy"  class="w-full h-72" frameborder="0"></iframe>
                            <a href="#ppc" class="btn btn-sm mt-4 btn-block">Close</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-scholar.form.submit extra="btn-block">
            Register
        </x-scholar.form.submit>
        </form>
    </div>
    <x-vendor.typewriterjs/>
    <x-vendor.alpinejs/>
</x-scholar.layout>
