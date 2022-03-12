<x-home-layout>
    <x-container>
        <div class="w-11/12 md:w-8/12 mx-auto my-10">
            <h1 class="text-center text-2xl font-bold text-white uppercase">
                Leave us Message
            </h1>
            <form action="/contact-form" method="POST">
                @csrf
                <x-vspace>
                    <x-form-input required="true" type="email" name="email" label="Email"></x-form-input>
                </x-vspace>
                <x-vspace>
                    <div class="flex flex-col md:flex-row md:items-center">
                        <div class="text-white font-bold block w-4/12 p-0 text-left md:text-right md:px-4 md:pr-6">
                            Message
                        </div>
                        <textarea name="message" class="p-2  border-2 border-gray-400 w-full md:w-8/12"></textarea>
                    </div>
                </x-vspace>
                <x-vspace>
                    <div class="text-right">
                        <button class="bg-purple-900 text-white font-bold p-2 uppercase" type="submit">
                            Submit
                        </button>
                    </div>
                </x-vspace>
            </form>
        </div>
    </x-container>
</x-home-layout>
