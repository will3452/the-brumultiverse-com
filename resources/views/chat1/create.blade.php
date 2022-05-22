<x-scholar.layout>
    <div class="flex">
        <div class="w-full md:w-10/12">
            <x-scholar.page.title>
                Messages
            </x-scholar.page.title>
            <form action="{{route('chat.1.store')}}" method="POST">
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
</x-scholar.layout>
