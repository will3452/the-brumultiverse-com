<x-student.layout bg="bg-diary">
    <div class="h-screen overflow-y-auto pb-64">
        <div class="flex justify-end p-4 items-center">
            <x-student.modal button="new entry">
                <form action="{{route('student.diary.store')}}" method="POST">
                    @csrf
                    <label for="entry" class="text-white ">New Entry</label>
                    <input type="text" placeholder="Title" name="title" required class="mt-4 form-control input input-sm input-bordered rounded-none">
                    <textarea name="content" id="entry" required class="form-control textarea w-full rounded-none mt-2" placeholder="Write something..."></textarea>
                    <button type="submit" class="btn btn-scholar btn-sm mt-2">Submit Entry</button>
                </form>
            </x-student.modal>
            <form class="mt-4">
                <input type="date" name="date" class="input input-sm input-bordered mx-2" required> <button class="btn btn-sm btn-scholar">find</button>
            </form>
        </div>
        <div class="flex justify-center">
            <h2 class="text-2xl font-mono bg-white inline-block p-2 rounded-xl shadow-xl">
                {{ request()->has('date') ? \Carbon\Carbon::parse(request()->date)->format('M d, Y') :now()->format('M d, Y') }}
            </h2>
        </div>
        <div class="flex w-11/12 mx-auto mt-4 flex-wrap justify-between items-start">
            @forelse ($records as $item)
                <livewire:diary-entry-card :item="$item->id"/>
            @empty
                <h4 class="text-xl font-mono text-gray-700 bg-white inline-block rounded-xl shadow-sl p-4 border">
                    No Entry Found.
                </h4>
            @endforelse
        </div>
    </div>
</x-student.layout>

<style>
    .bg-diary {
        background: url('/students/diary/background.png') !important;
        background-size: cover !important;
        background-position: center !important;
    }
</style>
