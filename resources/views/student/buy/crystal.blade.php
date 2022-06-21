<x-student.layout bg='bg-white'>
    <div class="bg-white">
        <h1 class="text-center text-2xl uppercase mt-4">Buy Crystal</h1>
    </div>
    <div class="mt-5" x-data="{
        active:'',
        total:0,
        quantity:0,
        selectCard (e) {
            this.active = e.target.id
            this.calculate()
        },
        prizes: {
            hall_pass:12,
            silver_ticket: 15,
            white_crystal: 32,
            purple_crystal: 30,
        },
        calculate () {
            let crystal = this.prizes[this.active] ? this.prizes[this.active] : 0
            this.total = crystal * this.quantity
        }
    }">
        <div class="flex justify-center">
            <div x-bind:class="{'bg-purple-800 text-white': active == 'hall_pass'}" class="crystal-card pointer" x-on:click='selectCard' id='hall_pass'>
                HALL PASS
            </div>
            <div x-bind:class="{'bg-purple-800 text-white': active == 'silver_ticket'}" class="crystal-card pointer" x-on:click='selectCard' id='silver_ticket'>
                SILVER TICKET
            </div>
            <div x-bind:class="{'bg-purple-800 text-white': active == 'purple_crystal'}" class="crystal-card pointer" x-on:click='selectCard' id='purple_crystal'>
                PURPLE CRYSTAL
            </div>
            <div x-bind:class="{'bg-purple-800 text-white': active == 'white_crystal'}" class="crystal-card pointer" x-on:click='selectCard' id='white_crystal'>
                WHITE CRYSTAL
            </div>
        </div>
        <div class="flex justify-center mt-4">
            <div class="shadow-xl w-5/12 text-center p-4 rounded bg-gray-100">
                <div class="text-2xl font-bold">
                    TOTAL
                </div>
                <div class="text-4xl">
                    <span x-text="total"></span> <span class="text-sm font-bold">PHP</span>
                </div>
                <form action="{{route('student.buy.crystal.create.payment')}}" method="POST" class="flex justify-center mt-4 items-center">
                    @csrf
                    <input type="hidden" name="type" x-bind:value='active'>
                    <select name="quantity" id="" class="select select-bordered select-sm mx-2" x-model="quantity" x-on:change="calculate">
                        <option value="0" selected default disabled>---</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="40">40</option>
                        <option value="80">80</option>
                        <option value="100">100</option>
                    </select>
                    <button class="btn-student-active">PROCEED</button>
                </form>
            </div>
        </div>
    </div>
</x-student.layout>
