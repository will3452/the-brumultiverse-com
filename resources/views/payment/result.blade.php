<x-scholar.layout>
    <x-scholar.page.title>
        Payment Result
    </x-scholar.page.title>
    <div class=" p-4 mt-2 border-4 border-dashed">
        <div>
            Status: <span class="font-bold text-gray-800">{{\App\Models\PaymentTransaction::STATUSES[$status]}}</span>
        </div>
        <div>
            Message: <span class="font-bold text-gray-800">{{$message}}</span>
        </div>
        <div>
            Ref. No: <span class="font-bold text-gray-800">{{$refno}}</span>
        </div>
    </div>
</x-scholar.layout>
