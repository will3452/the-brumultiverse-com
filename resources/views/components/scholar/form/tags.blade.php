@props(['label' => '', 'readonly' => false, 'name' => '', 'value' => '', 'help' => '', 'placeholder' => '', 'required' => true])
<x-scholar.form.input :readonly="$readonly" :label="$label" :name="$name" :help="$help" :placeholder="$placeholder" :required="$required" type="text" :value="$value"/>

@push('head-style')
    <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endpush
@push('body-script')
    <script src="https://unpkg.com/@yaireo/tagify"></script>
    <script src="https://unpkg.com/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <script>
        var input = document.querySelector('input[name={{$name}}]');
        new Tagify(input)
    </script>
@endpush
