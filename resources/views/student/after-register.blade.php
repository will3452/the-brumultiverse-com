<x-student.layout>
    <x-student.static-background-container bg="/students/lobby.jpg">
        <div x-data="data" x-effect="console.log(account)">
             <template x-if="step == 1">
                <x-student.dialog-container>
                    <x-student.typing message="Now that you are officially enrolled, allow me to introduce you to our Student Assistant." delay="10" clear="0"/>
                    <x-student.dialog-button-container>
                        <button class="btn-student-active mt-2" x-on:click="step++">
                            Ok
                        </button>
                    </x-student.dialog-button-container>
                </x-student.dialog-container>
             </template>

             <template x-if="step == 2">
                <div>
                    <x-student.dialog-container>
                        <x-student.typing message="Hi there, {{auth()->user()->user_name}}! Welcome to Berkeley-Reagan University or what we all call BRU." delay="10" clear="0"/>
                            <x-student.dialog-button-container>
                                <button class="btn-student-active mt-2" x-on:click="step++">
                                    Next
                                </button>
                            </x-student.dialog-button-container>
                    </x-student.dialog-container>
                    <x-student.scene blur="1">
                        <img src="{{auth()->user()->getAssistant('image')}}" alt="" class="avatar-img block -bottom-1/2">
                    </x-student.scene>
                </div>
             </template>

             <template x-if="step == 3">
                <div>
                    <x-student.dialog-container>
                        <x-student.typing message="I'm {{auth()->user()->getAssistant('name')}} Nice to meet you! I'm your  {{auth()->user()->getAssistant('school')}} Student Assistant." delay="10" clear="0"/>
                        <x-student.dialog-button-container>
                            <button class="btn-student-active mt-2" x-on:click="step++">
                                Next
                            </button>
                        </x-student.dialog-button-container>
                    </x-student.dialog-container>
                    <x-student.scene blur="1">
                        <img src=" {{auth()->user()->getAssistant('image')}}" alt="" class="avatar-img block -bottom-1/2">
                    </x-student.scene>
                </div>
             </template>

             <template x-if="step == 4">
                <div>
                    <x-student.dialog-container>
                        <x-student.typing message="Here at BRU, you can never put a tag to the experiences that await you!" delay="10" clear="0"/>
                        <x-student.dialog-button-container>
                            <button class="btn-student-active mt-2" x-on:click="step++">
                                Next
                            </button>
                        </x-student.dialog-button-container>
                    </x-student.dialog-container>
                    <x-student.scene blur="1">
                        <img src=" {{auth()->user()->getAssistant('image')}}" alt="" class="avatar-img block -bottom-1/2">
                    </x-student.scene>
                </div>
             </template>

             <template x-if="step == 5">
                <div>
                    <x-student.dialog-container>
                        <x-student.typing message="Let me help you get started. Please choose which account you wish to enrol yourself into." delay="10" clear="0"/>
                        <x-student.dialog-button-container>
                            <button class="block btn-student-active mx-1" x-on:click="step = 9;account = `{{\App\Models\User::ACCOUNT_PREMIUM}}`">
                                Premium
                            </button>
                            <button class="block btn-student mx-1" x-on:click="step++;account = `{{\App\Models\User::ACCOUNT_FREE}}`">
                                Regular
                            </button>
                            <button class="block btn-student mx-1 p-3" x-on:click="step = 8">
                                <img src="/img/icons/crud/help.svg" class="invert" alt="">
                            </button>
                        </x-student.dialog-button-container>
                    </x-student.dialog-container>
                    <x-student.scene blur="1">
                        <img src=" {{auth()->user()->getAssistant('image')}}" alt="" class="avatar-img block -bottom-1/2">
                    </x-student.scene>
                </div>
             </template>

             <template x-if="step == 6">
                <div>
                    <x-student.dialog-container>
                        <x-student.typing message="Are you satisfied on your account perks based on the account type you chose?" delay="10" clear="0"/>
                        <x-student.dialog-button-container>
                            <button class="block btn-student-active mx-1" x-on:click="step++">
                                Yes
                            </button>
                            <button class="block btn-student mx-1" x-on:click="step = 5">
                                Let me change account type
                            </button>
                        </x-student.dialog-button-container>
                    </x-student.dialog-container>
                    <x-student.scene blur="1">
                        <img src=" {{auth()->user()->getAssistant('image')}}" alt="" class="avatar-img block -bottom-1/2">
                    </x-student.scene>
                </div>
             </template>

             <template x-if="step == 7">
                <div>
                    <x-student.dialog-container>
                        <x-student.typing message="Awesome! You may now start customizing your experience! Remember, should you choose to upgrade your account, you may do so in your DASHBOARD for only P149/month." delay="10" clear="0"/>
                        <x-student.dialog-button-container>
                            <a class="block btn-student-active mx-1" x-on:click="submitForm">
                                Save
                            </a>
                            <button class="block btn-student mx-1" x-on:click="step = 5">
                                Let me change account type
                            </button>
                        </x-student.dialog-button-container>
                    </x-student.dialog-container>
                    <x-student.scene blur="1">
                        <img src=" {{auth()->user()->getAssistant('image')}}" alt="" class="avatar-img block -bottom-1/2">
                    </x-student.scene>
                </div>
             </template>

             <template x-if="step == 8">
                 <div class="animate__animated animate__fadeInUp backdrop-blur-sm absolute top-0 bottom-0 w-full flex flex-col text-sm justify-center items-center">
                    <table class=" border-2 p-4 bg-white">
                        <tr>
                            <th colspan="4" class="bg-gradient-to-r from-blue-900 to-purple-900 text-white">
                                Account Perks
                            </th>
                        </tr>
                        <tr>
                            <th class="border"></th>
                            <th class="border">Details</th>
                            <th class="border">Free</th>
                            <th class="border">Premium (at Php149/mo)</th>
                        </tr>
                        <tr>
                            <td class="border p-1">
                                01
                            </td>
                            <td class="border p-1">
                                Hall Pass
                            </td>
                            <td class="border p-1">
                                6 daily
                            </td>
                            <td class="border p-1">
                                9 daily
                            </td>
                        </tr>
                        <tr>
                            <td class="border p-1">
                                02
                            </td>
                            <td class="border p-1">
                                Monthly Purple Gem Allocation
                            </td>
                            <td class="border p-1">
                                N/a
                            </td>
                            <td class="border p-1">
                                3 monthly
                            </td>
                        </tr>
                        <tr>
                            <td class="border p-1">
                                03
                            </td>
                            <td class="border p-1">
                                Reward and prizes on Regular Events and Challenges
                            </td>
                            <td class="border p-1">
                                Regular count
                            </td>
                            <td class="border p-1">
                                Doubled
                            </td>
                        </tr>
                        <tr>
                            <td class="border p-1">
                                04
                            </td>
                            <td class="border p-1">
                                Avatar Customization
                            </td>
                            <td class="border p-1">
                                Basic
                            </td>
                            <td class="border p-1">
                                Premium
                            </td>
                        </tr>
                        <tr>
                            <td class="border p-1">
                                05
                            </td>
                            <td class="border p-1">
                                Ads
                            </td>
                            <td class="border p-1">
                                Yes
                            </td>
                            <td class="border p-1">
                                Minimal
                            </td>
                        </tr>
                        <tr>
                            <td class="border p-1">
                                06
                            </td>
                            <td class="border p-1">
                                Purchase of Silver Ticket and Purple Crystals
                            </td>
                            <td class="border p-1">
                                Yes
                            </td>
                            <td class="border p-1">
                                Yes
                            </td>
                        </tr>
                        <tr>
                            <td class="border p-1">
                                07
                            </td>
                            <td class="border p-1">
                                Special Invites to Special Events
                            </td>
                            <td class="border p-1">
                                N/a
                            </td>
                            <td class="border p-1">
                                Yes
                            </td>
                        </tr>
                        <tr>
                            <td class="border p-1">
                                08
                            </td>
                            <td class="border p-1">
                                Regular Events
                            </td>
                            <td class="border p-1">
                                Yes
                            </td>
                            <td class="border p-1">
                                Yes
                            </td>
                        </tr>
                        <tr>
                            <td class="border p-1">
                                09
                            </td>
                            <td class="border p-1">
                                Special Sneak Previous
                            </td>
                            <td class="border p-1">
                                N/a
                            </td>
                            <td class="border p-1">
                                Yes
                            </td>
                        </tr>
                    </table>
                    <button class="btn-student-active mt-2" x-on:click="step = 5">
                        Close
                    </button>
                 </div>
             </template>

             <template x-if="step == 9">
                <div>
                    <x-student.dialog-container>
                        <x-student.typing message="Great! Let's get started on your payment options." delay="10" clear="0"/>
                        <x-student.dialog-button-container>
                            <a href="{{route('student.pay-tuition')}}" class="block btn-student-active mx-1">
                                Ok
                            </a>
                            <button class="block btn-student mx-1" x-on:click="step = 5">
                                Let me change account type
                            </button>
                        </x-student.dialog-button-container>
                    </x-student.dialog-container>
                    <x-student.scene blur="1">
                        <img src=" {{auth()->user()->getAssistant('image')}}" alt="" class="avatar-img block -bottom-1/2">
                    </x-student.scene>
                </div>
             </template>

             <template x-if="step == 10">
                <div>
                    <x-student.dialog-container>
                        <x-student.typing message="Awesome! Now that we have that settled, you may now start customizing your experience!" delay="10" clear="0"/>
                        <x-student.dialog-button-container>
                            <button class="block btn-student-active mx-1" x-on:click="step++; account = `{{\App\Models\User::ACCOUNT_PREMIUM}}`">
                                Ok
                            </button>
                        </x-student.dialog-button-container>
                    </x-student.dialog-container>
                    <x-student.scene blur="1">
                        <img src=" {{auth()->user()->getAssistant('image')}}" alt="" class="avatar-img block -bottom-1/2">
                    </x-student.scene>
                </div>
             </template>

             <template x-if="step == 11">
                <div>
                    <x-student.dialog-container>
                        <x-student.typing message="Remember, you may opt to change your account type anytime in the SETTINGS PAGE of your DASHBOARD." delay="10" clear="0"/>
                        <x-student.dialog-button-container>
                            <button class="block btn-student-active mx-1" x-on:click="submitForm">
                                Save
                            </button>
                        </x-student.dialog-button-container>
                    </x-student.dialog-container>
                    <x-student.scene blur="1">
                        <img src=" {{auth()->user()->getAssistant('image')}}" alt="" class="avatar-img block -bottom-1/2">
                    </x-student.scene>
                </div>
             </template>
             <form action="{{route('student.save.account')}}" x-ref="saveForm" method="POST">
                @csrf
                 <input type="hidden" name="account" x-model="account">
             </form>
        </div>
    </x-student.static-background-container>
    @push('body-script')
        <script>
            var data = {
                step: 0,
                account:null,
                submitForm() {
                    this.$refs.saveForm.submit();
                },
                init() {
                    window.onload = () => this.step = {{request()->step ?? 1}};
                }
            }
        </script>
    @endpush
</x-student.layout>
