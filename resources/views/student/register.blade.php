<x-student.layout>
    <x-student.static-background-container>
        <div x-data="data" x-effect="mouseClick(step)">
            <template x-if="step == 1">
                <div  class="w-full max-h-fit" >
                    <x-student.dialog-container>
                        <x-student.typing message="Hello there! I’m Antonina, your Admin Clerk. To enjoy the full Berkeley-Reagan University experience, please enrol." delay="10" clear="0" />
                        <x-student.dialog-button-container>
                            <button class="btn-student-active mt-4" x-on:click="step++;">
                                Ok
                            </button>
                        </x-student.dialog-button-container>
                    </x-student.dialog-container>
                    <x-student.scene blur="1">
                        <img src="{{getAsset('avatars/antonina.png')}}" alt="Antonina" class="avatar-img right-0 animate__animated animate__fadeInRight right-0">
                    </x-student.scene>
                </div>
            </template>

            <template x-if="step == 2">
                <div class="w-full">
                    <x-student.dialog-container>
                        <x-student.typing message="Welcome to Berkeley-Reagan University. Let's enrol you, shall we?" delay="10" clear="0" />
                        <x-student.dialog-button-container>
                            <button class="btn-student-active mx-2" x-on:click="step++">
                                Ok
                            </button>
                            <button class="btn-student mx-2" x-on:click="step = -1;">
                                Next Time
                            </button>
                            <a class="btn-student" href="{{route('student.map')}}">
                                I'm already a BRU Student.
                            </a>
                        </x-student.dialog-button-container>
                    </x-student.dialog-container>
                    <x-student.scene blur="1">
                        <img src="{{getAsset('avatars/antonina.png')}}" alt="Antonina" class="avatar-img right-0 ">
                    </x-student.scene>
                </div>
            </template>

            <template x-if="step == -1">
                <div class="w-full">
                    <x-student.dialog-container>
                        <x-student.typing message="Thank you for visiting. Come again!" delay="10" clear="0"/>
                        <x-student.dialog-button-container>
                            <a href="/" class="btn-student-active mx-2">
                                Leave
                            </a>
                        </x-student.dialog-button-container>
                    </x-student.dialog-container>
                    <x-student.scene blur="1">
                        <img src="{{getAsset('avatars/antonina.png')}}" alt="Antonina" class="avatar-img right-0">
                    </x-student.scene>
                </div>
            </template>

            <div class="w-full mx-auto flex justify-center"  style="height:60vh" x-show="step == 3">
                <form
                action="{{route('student.register')}}"
                method="POST"
                class="w-full md:w-1/2 pb-4 mx-auto relative backdrop-brightness-50 mt-10 overflow-y-scroll"
                >

                @csrf
                <h2 class="bg-black text-white p-1 font-bold uppercase">Registration</h2>
                <div class="px-4">
                    <x-student.form.input name="first_name" label="First Name"/>
                    <x-student.form.input name="last_name" label="Last Name"/>
                    <x-student.form.input name="user_name" label="BRU Name"/>
                    <x-student.form.select name="gender" label="Gender">
                        <option value="{{\App\Models\User::GENDER_MALE}}">{{\App\Models\User::GENDER_MALE}}</option>
                        <option value="{{\App\Models\User::GENDER_FEMALE}}">{{\App\Models\User::GENDER_FEMALE}}</option>
                        {{-- <option value="{{\App\Models\User::GENDER_LGBT}}">{{\App\Models\User::GENDER_LGBT}}</option> --}}
                    </x-student.form.select>
                    <x-student.form.select name="sex" label="Sex">
                        <option value="{{\App\Models\User::GENDER_MALE}}">{{\App\Models\User::GENDER_MALE}}</option>
                        <option value="{{\App\Models\User::GENDER_FEMALE}}">{{\App\Models\User::GENDER_FEMALE}}</option>
                    </x-student.form.select>
                    <x-student.form.date name="birth_date" label="Birthdate"/>
                    {{-- <x-student.form.input name="address" label="Address"/> --}}
                    <x-student.form.input name="city" label="City"/>
                    <x-student.form.select name="country" label="Country">
                        @foreach (\App\Helpers\CountryHelper::getAllCountries() as $key => $val)
                            <option value="{{$key}}">{{$val}}</option>
                        @endforeach
                    </x-student.form.select>
                    <div x-data="{
                        college:null,
                        colleges:null,
                        init() {
                            this.college = {{$colleges[0]->id}};
                        }
                    }">

                        <x-student.form.select model="college" name="college" label="College">
                            @foreach ($colleges as $c)
                            <option value="{{$c->id}}">
                                {{$c->name}}
                            </option>
                            @endforeach
                        </x-student.form.select>

                        @foreach ($colleges as $college)
                            <template x-if="college == {{$college->id}}">
                                <x-student.form.select name="course" label="Course">
                                    @foreach ($college->courses as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </x-student.form.select>
                            </template>

                            <template x-if="college == {{$college->id}}">
                                <x-student.form.select name="club" label="Club">
                                    @foreach ($college->clubs as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </x-student.form.select>
                            </template>
                        @endforeach

                    </div>
                    <x-student.form.input type="email" label="Email" name="email"/>
                    <x-student.form.input type="password" label="Password" name="password"/>
                    <x-student.form.input type="password" label="Confirm Password" name="password_confirmation"/>
                    <x-student.form.checker title="ARE YOU SURE ABOUT ALL THE INFORMATION YOU HAVE DECLARED?">
                        I certify that all information I have declared in this registration are true and correct to the best of my knowledge. I further understand that any false statement may result in denial or revocation of my account.
                    </x-student.form.checker>
                    <x-student.form.checker title="COPYRIGHT CERTIFICATION">
                        This is to reaffirm my duty to ensure all materials under my name and account in the BRUMULTIVERSE site and/or app are my property, and that I own the rights to them or I have obtained approval in writing to use them, as stated in my contract with BRUMULTIVERSE.
                    </x-student.form.checker>
                    <x-student.form.checker title="TERMS AND CONDITIONS">
                        I have read and I agree with the <a class="underline" href="/terms-and-conditions" target="_blank">Terms and Conditions</a>.
                    </x-student.form.checker>
                    <x-student.form.checker title="DATA PRIVACY">
                        I have read and I agree with the <a class="underline" href="/terms-and-conditions" target="_blank">Privacy Policy.</a>
                    </x-student.form.checker>
                    <x-student.form.submit>
                        Enrol Now
                    </x-student.form.submit>
                </div>
            </form>
            </div>
        </div>
    </x-student.static-background-container>
    @push('body-script')
        <script>
            var data = {
                step:0,
                mouseClick(label) {
                    // window.mouseClick.play();
                },
                init () {
                    window.onload = () => this.step = {{request()->has('step') ? request()->step : 1}};
                },
            }
        </script>
    @endpush
</x-student.layout>
