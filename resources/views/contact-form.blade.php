<x-scholar.layout>
    <div class="flex justify-center">
        <form action="/contact-form" method="POST" class="w-full">
            @csrf
            <h1 class="text-2xl mb-4 uppercase font-bold">Contact us</h1>
            <x-scholar.page.typing clear="0" loop="0" delay="20" message="Hi! We welcome all unique voices and expressions of art. Should you wish to join our growing BRU family, please leave us a message and we'll get back to you as soon as we can."/>
            <x-scholar.form.input name="email" label="Your Email"/>
            <textarea name="message" id="" cols="30" rows="10"></textarea>
            <x-scholar.form.submit>
                Submit
            </x-scholar.form.submit>
        </form>
    </div>

    <x-vendor.ckeditor/>
    <x-vendor.typewriterjs/>
    <x-vendor.alpinejs/>
</x-scholar.layout>
