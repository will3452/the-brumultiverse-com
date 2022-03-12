<x-scholar.layout>

    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholar.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => '#',
                    'label' => 'Books',
                ]
            ]
        "
    />
    <div class="items-center justify-between hidden md:flex">
        <div class="items-center flex justify-between md:justify-start sm:w-full md:w-1/2">
            <h1 class="text-2xl font-bold capatitalize">
                My Books
            </h1>
            <a href="#create-book" class="btn btn-primary btn-sm mx-2 capitalize">create new</a>
        </div>
        <form action="{{url()->current()}}" class="flex hidden md:block ">
            <input type="text" name="keyword" class="input input-bordered input-sm">
            <button class="btn btn-sm">Search</button>
        </form>
    </div>
    <div class="md:hidden">
        <form class="mb-4 justify-center flex" action="{{url()->current()}}">
            <input type="text" name="keyword" class="input input-bordered input-sm">
            <button class="btn btn-sm ml-1">Search</button>
        </form>
        <div class="text-center capitalize text-2xl">
            My books
        </div>
    </div>

    <div class="mt-4 flex flex-wrap justify-start">
        <x-scholar.work-card/>
        <x-scholar.work-card/>
        <x-scholar.work-card/>
        <x-scholar.work-card/>
        <x-scholar.work-card/>
    </div>
    <div class="fixed bottom-2 right-2 md:hidden">
        <a href="#create" class="btn btn-primary btn-sm">create new</a>
    </div>

</x-scholar.layout>
