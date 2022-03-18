{{-- this will upload large file --}}
@props(['name' => 'file', 'label' => '', 'required' => true, 'enable' => ''])

<div class="form-control">
    <div class="label">
        <div class="label-text">
            {{$label}}
        </div>
    </div>
    <input type="file" name="{{$name}}" required/>
</div>

@push('head-script')
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endpush

    @push('body-script')
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
        <script>
            window.onload = function () {
                const iFile = document.querySelector('input[name={{$name}}]');
                const pond = FilePond.create(iFile);
                FilePond.setOptions({
                    instantUpload:false,
                    chunkUploads:true,
                    chunkForce:true,
                    required: {{$required}},
                    server: {
                            process: '/filepond-process',
                            patch: '/filepond-patch?patch=',
                            revert: '/filepond-revert',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                    },
                    onprocessfiles() {
                        document.querySelector('{{$enable}}').removeAttribute('disabled')
                    },
                    onremovefile(error, file) {
                        document.querySelector('{{$enable}}').disabled = 'true';
                    }
                });
            }
        </script>
@endpush
