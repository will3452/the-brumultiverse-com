@props(['label' => '', 'readonly' => false, 'value'=> null, 'name' => '', 'help' => '', 'placeholder' => '', 'required' => true])
<x-scholar.form.input :readonly="$readonly" :value="$value" :label="$label" :name="$name" :help="$help" :placeholder="$placeholder" :required="$required" type="number" />
