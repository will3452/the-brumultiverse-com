@props(['model' => null, 'type' => 'Bulletin', 'description' => '', 'tag' => 0])
<x-scholar.marketing.card title="Payment">
    <form action="/create-payment" method="POST">
        @csrf
        {{-- <input type="hidden" name="redirect" value="{{route('scholar.home')}}"> --}}
        <input type="hidden" name="type" value="{{$type}}">
        <input type="hidden" name="id" value="{{$model->id}}">
        <input type="hidden" name="description" value="{{$description}}">
        <input type="hidden" name="amount" value="{{$model->package->cost, 2}}">
        <x-scholar.form.input readonly name="description" label="Description" value="{{$description}}" />
        <x-scholar.form.input  readonly name="amount" help="Please settle your payment to proceed." label="Amount" value="PHP {{number_format($model->package->cost, 2)}}"/>
        <x-scholar.form.submit>
            Pay Now
        </x-scholar.form.submit>
    </form>
</x-scholar.marketing.card>
