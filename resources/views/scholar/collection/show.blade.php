<x-scholar.layout>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholars.collection.index'),
                    'label' => 'Albums',
                ],
                [
                    'href' => '#',
                    'label' => $collection->title,
                ]
            ]
        "
    />
    <x-scholar.page.title>
        Details
    </x-scholar.page.title>
    <x-scholar.display.batch :model="$collection" :data="[
        ['label' => 'Type', 'name' => 'type'],
        ['label' => 'Title', 'name' => 'title'],
        ['label' => 'Description', 'name' => 'description'],
        ['label' => 'Credits', 'name' => 'credit'],
    ]"/>
     @if (count($optionWorks))
     <x-scholar.modal button="add work">
         <form action="{{route('scholars.add.work')}}" method="POST">
             @csrf
             <input type="hidden" name="class_type" value="{{get_class($collection)}}"/>
             <input type="hidden" name="class_id" value="{{$collection->id}}"/>
             <input type="hidden" name="work_type" value="{{get_class($optionWorks[0])}}"/>
             <x-scholar.form.select label="Work" name="work_id">
                 @foreach ($optionWorks as $option)
                     <option value="{{$option->id}}">{{$option->title}}</option>
                 @endforeach
             </x-scholar.form.select>
             <x-scholar.form.submit>
                 Submit
             </x-scholar.form.submit>
         </form>
     </x-scholar.modal>
 @endif
 <x-scholar.page.title>
    Works
</x-scholar.page.title>
    <div id="work-list">
        <input class="search quick-search my-4" placeholder="Quick search">

        <ul class="list flex">
            @foreach ($works as $w)
                <li>
                    <x-scholar.work-card
                    :href="\App\Models\ClassWork::INDEX[$w->work_type] . $w->work_id"
                    cover="{{$w->work->artFile ? optional($w->work->artFile)->getSize() : optional($w->work->cover)->getSize()}}">
                        <span class="title">{{$w->work->title}}</span>
                    </x-scholar.work-card>
                </li>
            @endforeach
        </ul>
    </div>

    @push('body-script')
        <x-vendor.listjs/>
        <script>
            let options  = {
                valueNames: ['title'],
            }

            let workList = new List('work-list', options);
        </script>
    @endpush
</x-scholar.layout>
