<x-scholar.layout>
    <x-scholar.page.title>
        Message Blast
    </x-scholar.page.title>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholars.message-blast.index'),
                    'label' => 'Message Blasts',
                ],
                [
                    'href' => '#',
                    'label' => 'Create',
                ]
            ]
        "
    />
    <form
    enctype="multipart/form-data"
    action="{{route('scholars.message-blast.store')}}"
    method="POST"
    >
        @csrf
         <div x-data="{
             packageId:null,
             sDate:null,
             init() {
                 this.packageId = {{request()->package ?? $packages[0]->id}};
                 this.sDate = `{{request()->date ?? ''}}`
             },
             reload() {
                 let current = '{{url()->current()}}';
                 window.location.href=`${current}?package=${this.packageId}&date=${this.sDate}`;
             }
         }">
            <x-scholar.form.select  change="reload" model="packageId" name="package_id" label="Duration">
                @foreach ($packages as $p)
                    <option value="{{$p->id}}">
                        {{$p->name}}
                    </option>
                @endforeach
            </x-scholar.form.select>
            <x-scholar.form.input model="sDate" type="date" name="scheduled_at" label="Schedule" help="Schedule must be 14 days from date of creation." />
         </div>

         @php
             $days = 0;
             if (request()->has('package')) {
                $days =  \App\Models\Package::find(request()->package)->number_of_days;
             } else {
                 $days = $packages[0]->number_of_days;
             }
         @endphp
         @for ($i = 0; $i < $days; $i++)
             <div class="border-dashed border-4 mb-4 p-2 font-bold">
                 <div>
                     Day {{$i + 1}}
                 </div>
                 <x-scholar.form.input name="subjects[]" label="Subject"/>
                 <x-scholar.form.ckeditor name="messages[]" label="Message"/>
             </div>
         @endfor

        <x-scholar.form.file name="file" required="0" label="Upload image"/>
        <x-scholar.form.submit>
            Submit
        </x-scholar.form.submit>
    </form>

    @push('head-script')
        <x-vendor.alpinejs/>
    @endpush
</x-scholar.layout>
