<x-scholar.layout>
    <x-scholar.page.title>
        Annex
    </x-scholar.page.title>
    <div  x-data="data">
        <div class="bg-gray-200 border h-96 mt-2 overflow-y-scroll">
            <div style="width:8in;height:11in;" class="relative p-4 my-4 mx-auto bg-white pt-10 font-serif" id="element-to-print">
                <h1 class="text-6xl text-center">Annex</h1>
                <div class="text-right  mt-4">
                    Ref no. {{$model->ref()}}
                </div>
                <table class="w-full border text-left">
                    <tr>
                        <th class="border">Category</th>
                        <td class="border">{{$model->type()}}</td>
                    </tr>
                    <tr>
                        <th class="border">Schedule</th>
                        <td class="border">{{$model->scheduled_at->format('m/d/Y')}}</td>
                    </tr>
                    <tr>
                        <th class="border">Duration</th>
                        <td class="border">{{$model->package->number_of_days}} {{$model->package->number_of_days > 1 ? 'days': 'day'}}</td>
                    </tr>
                    <tr>
                        <th class="border">Cost</th>
                        <td class="border">Php {{number_format($model->package->cost, 2)}}</td>
                    </tr>
                </table>

                <img src="/bru_assets/textlogo.png" class="absolute rotate-45 opacity-5" alt="">
            </div>
        </div>
        <button class="btn btn-sm mt-4" x-on:click="download()">
            Download PDF
        </button>
    </div>
    @push('body-script')
        <x-vendor.alpinejs/>
        <x-vendor.html2pdf/>
        <script>
            var data = {
                element: null,
                init () {
                    this.element = document.getElementById('element-to-print');
                },
                download() {
                    html2pdf(this.element);
                }
            }
        </script>
    @endpush
</x-scholar.layout>
