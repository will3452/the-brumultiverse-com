{{-- this will upload large file --}}
@props(['name' => 'file', 'label' => '', 'required' => true, 'enable' => '', 'accept' => ''])

<div class="form-control">
    <div class="label">
        <div class="label-text">
            {{$label}}
        </div>
    </div>
    <input type="file" name="{{$name}}" required/>
    <div class="text-xs mb-4">
        Please click the arrow button on the right to upload.
    </div>
    <x-scholar.form.copyright-disclaimer/>
</div>

@push('head-script')
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
@endpush

    @push('body-script')
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
        <script>
            function getAllowedTypes(allowed) {
                if (allowed == 'image') {
                    return ['image/png', 'image/svg+xml', 'image/jpg', 'image/jpeg', 'image/webp', 'image/JPG'];
                }

                if (allowed == 'video') {
                    return ['video/webm', 'video/ogg', 'video/mp4', 'video/MP2T', 'video/3gpp', 'video/quicktime', 'video/x-msvideo', 'video/x-ms-wmv']
                }

                if (allowed == 'audio') {
                    return ['audio/mp3', 'audio/webm', 'audio/ogg', 'audio/wave', 'audio/wav', 'audio/x-wav', 'audio/x-pn-wav', 'audio/mpeg']
                }

                return [];
            }
            window.onload = function () {
                const iFile = document.querySelector('input[name={{$name}}]');
                const pond = FilePond.create(iFile);
                pond.required = {{$required}};
                FilePond.setOptions({
                    beforeAddFile(item) {
                        let allowedTypes = getAllowedTypes(`{{$accept}}`);
                        return allowedTypes.indexOf(item.file.type) !== -1;
                    },
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
