<x-scholar.layout>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholar.series.index'),
                    'label' => 'Series',
                ],
                [
                    'href' => '#',
                    'label' => $series->title,
                ]
            ]
        "
    />
    <x-scholar.page.title>
        Details
    </x-scholar.page.title>
    <x-scholar.display.batch :model="$series" :data="[
        ['label' => 'Type', 'name' => 'type'],
        ['label' => 'Title', 'name' => 'title'],
        ['label' => 'Description', 'name' => 'description'],
        ['label' => 'Credits', 'name' => 'credit'],
    ]"/>
     @if (count($optionWorks))
     <x-scholar.modal button="add work">
         <form action="{{route('scholar.add.work')}}" method="POST">
             @csrf
             <input type="hidden" name="class_type" value="{{get_class($series)}}"/>
             <input type="hidden" name="class_id" value="{{$series->id}}"/>
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
