<x-scholar.layout>
    <x-chat.breadcrumbs
        :links="
            [
                [
                    'href' => route('scholars.home'),
                    'label' => 'Home',
                ],
                [
                    'href' => route('scholars.group.index'),
                    'label' => 'Groups',
                ],
                [
                    'href' => '#',
                    'label' => $group->name,
                ]
            ]
        "
    />
    <x-scholar.page.title>
        {{$group->name}}
    </x-scholar.page.title>

    <x-scholar.display.text label="Group Name">
        {{$group->name}}
    </x-scholar.display.text>

    <x-scholar.display.text label="Group Type">
        {{$group->type}}
    </x-scholar.display.text>

    <x-scholar.display.text label="Members">
        {{$group->members_count}}
    </x-scholar.display.text>

    <x-scholar.display.text label="Description">
        {!!$group->description!!}
    </x-scholar.display.text>

<div class="flex items-center justify-between">
    <x-scholar.page.title>
        <span>Members</span>
    </x-scholar.page.title>
    <div>
        <x-scholar.modal no-button="1" id="addnew">
            <x-slot name="trigger">
                <label for="addnew" class="btn btn-sm btn-scholar">
                    Add new member
                </label>
            </x-slot>
            <div
            x-data="{
                penname:'',
                accountNotFound:false,
                checkIfAccountIsExists() {
                    axios.post('/api/account-exists', {'penname' : this.penname})
                    .then(res => {
                        if (res.data == '') {
                            this.accountNotFound = true;
                        } else {
                            this.accountNotFound = false;
                            this.submitFormNow();
                        }
                    })
                },
                submitFormNow () {
                    this.$refs.formSubmit.submit();
                },
                submitForm() {
                   this.checkIfAccountIsExists();
                },
            }">
            <form
            x-ref="formSubmit"
             x-on:submit.prevent="submitForm"
                action="{{route('scholars.group.add.member', ['group' => $group->id])}}" method="POST">
                @csrf
                <div x-show="accountNotFound" class="text-sm text-red-600">
                    Account not found!
                </div>
                <x-scholar.form.input model="penname" name="account" label="Account Name"/>

                <x-scholar.form.input name="position" label="Position"/>
                <x-scholar.form.submit id="submitAdd">
                    Submit
                </x-scholar.form.submit>
            </form>
            </div>

        </x-scholar.modal>
    </div>
</div>
    <x-scholar.table>
        <thead>
            <tr>
                <th>
                    Account
                </th>
                <th>
                    Remarks
                </th>
                <th>
                    Position
                </th>
                <th>
                    Status
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($group->members as $m)
                <tr>
                    <td>
                        {{$m->member->penname}}
                    </td>
                    <td>
                        {{$m->remarks}}
                    </td>
                    <td>
                        {{$m->position ?? '--'}}
                    </td>
                    <td>
                        {{$m->status}}
                    </td>
                    <td>
                        <x-scholar.modal id="edit{{$m->id}}" no-button="1">
                            <x-slot name="trigger">
                                <label for="edit{{$m->id}}" class="btn btn-sm btn-scholar">Edit position</label>
                            </x-slot>
                            <form method="POST" action="{{route('scholars.group.edit.position', ['member' => $m->id])}}">
                                @csrf
                                <x-scholar.form.input name="position" label="New Position"/>
                                <x-scholar.form.submit>
                                    Submit
                                </x-scholar.form.submit>
                            </form>
                        </x-scholar.modal>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-scholar.table>
    <x-vendor.alpinejs/>
</x-scholar.layout>
