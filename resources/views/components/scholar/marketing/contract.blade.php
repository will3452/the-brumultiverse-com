@props(['model' => null, 'type' => 'Bulletin'])
<x-scholar.marketing.card title="Contract">
    <div class="text-sm">
        <p class="mb-2 border-b-2 border-dashed pb-2">
            Your marketing event will be under a specific contract.
        </p>
        <p class="mb-2 border-b-2 border-dashed pb-2">
            Please download the contract to review the  terms and conditions <a href="/contract.pdf" download class="underline underline-offset-1 text-purple-600">here</a>.
        </p>
        <p class="mb-2 pb-2">
            Please download the Annex to the contract, as you have indicated above, right <a target="_blank" href="/get-annex?type={{$type}}&id={{$model->id}}" class="underline underline-offset-1 text-purple-600">here</a>.
        </p>
    </div>
</x-scholar.marketing.card>
