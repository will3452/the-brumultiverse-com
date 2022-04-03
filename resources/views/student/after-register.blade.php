<x-student.layout>
    <x-student.static-background-container bg="/students/lobby-half.jpg">
        <div x-data="data">
             <template x-if="step == 1">
                <x-student.dialog-container>
                    <x-scholar.page.typing message="Now that you are officially enrolled, allow me to introduce you to our Student Assistant." delay="10" clear="0" class="text-white"/>
                    <div class="text-center">
                        <button class="btn-student-active mt-2" x-on:click="step++">
                            Ok
                        </button>
                    </div>
                </x-student.dialog-container>
             </template>

             <template x-if="step == 2">
                <div>
                    <x-student.dialog-container>
                        <x-scholar.page.typing message="Hi there, {{auth()->user()->first_name}}! Welcome to Berkeley-Reagan University or what we all call BRU." delay="10" clear="0" class="text-white"/>
                        <div class="text-center">
                            <button class="btn-student-active mt-2" x-on:click="step++">
                                Next
                            </button>
                        </div>
                    </x-student.dialog-container>
                    <img src="/students/character/miel.png" alt="" class=" animate__animated animate__fadeInLeft block absolute -left-40  ">
                </div>
             </template>

             <template x-if="step == 3">
                <div>
                    <x-student.dialog-container>
                        <x-scholar.page.typing message="I'm Miel Nice to meet you! I'm your {{auth()->user()->interest->college->name}} Student Assistant." delay="10" clear="0" class="text-white"/>
                        <div class="text-center">
                            <button class="btn-student-active mt-2" x-on:click="step++">
                                Next
                            </button>
                        </div>
                    </x-student.dialog-container>
                    <img src="/students/character/miel.png" alt="" class="block absolute -left-40">
                </div>
             </template>

             <template x-if="step == 4">
                <div>
                    <x-student.dialog-container>
                        <x-scholar.page.typing message="Here at BRU, you can never put a tag to the experiences that await you!" delay="10" clear="0" class="text-white"/>
                        <div class="text-center">
                            <button class="btn-student-active mt-2" x-on:click="step++">
                                Next
                            </button>
                        </div>
                    </x-student.dialog-container>
                    <img src="/students/character/miel.png" alt="" class="block absolute -left-40">
                </div>
             </template>

             <template x-if="step == 5">
                <div>
                    <x-student.dialog-container>
                        <x-scholar.page.typing message="Let me help you get started. Please choose which account you wish to enrol yourself into." delay="10" clear="0" class="text-white"/>
                        <div class="text-center mt-2 flex items-center justify-center">
                            <button class="block btn-student-active mx-1" x-on:click="step++">
                                Premium
                            </button>
                            <button class="block btn-student mx-1" x-on:click="step++">
                                Regular
                            </button>
                            <button class="block btn-student mx-1">
                                <img src="/img/icons/crud/help.svg" alt="" class="invert">
                            </button>
                        </div>
                    </x-student.dialog-container>
                    <img src="/students/character/miel.png" alt="" class="block absolute -left-40">
                </div>
             </template>
             <template x-if="step == 6">
                 <div class="p-2">
                    <table class="w-full border text-sm text-center  bg-white p-4">
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
                 </div>
             </template>
        </div>
    </x-student.static-background-container>
    @push('body-script')
        <script>
            var data = {
                step: 0,
                init() {
                    window.onload = () => this.step = {{request()->step ?? 1}};
                }
            }
        </script>
    @endpush
</x-student.layout>
