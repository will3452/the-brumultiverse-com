<x-student.layout bg="bg-white">
    <div class="flex p-2">
        <div class="w-full">
            <x-scholar.page.title>
                Messages
            </x-scholar.page.title>
            <form action="{{route('student.chat.store')}}" method="POST">
                @csrf
                <x-scholar.form.select name="user_id" label="Select user to message">
                    @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->email}}</option>
                    @endforeach
                </x-scholar.form.select>
                <textarea name="message" class="w-full border rouded p-2" placeholder="Aa" id="" cols="30" rows="10"></textarea>
                <x-scholar.form.submit>
                    send message
                </x-scholar.form.submit>
            </form>
        </div>
        <div class="w-2/12 bg-base-100 hidden md:block">
            {{-- extra space --}}
        </div>
    </div>

    @push('head-script')
        <x-vendor.alpinejs/>
        <x-vendor.ckeditor/>
    @endpush
</x-student.layout>
