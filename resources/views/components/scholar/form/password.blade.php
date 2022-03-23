@props(['model' => '', 'ref' => 'default', 'label' => '', 'value'=> null, 'readonly' => false, 'name' => '', 'help' => '', 'placeholder' => '', 'required' => true, 'type' => 'text'])

<div
    class="relative"
    x-data="{
        visible:false,
        toggle() {
            this.$refs.{{$ref}}.focus();
            this.visible = ! this.visible;
            this.$refs.{{$ref}}.type = this.visible ? 'text' : 'password';
        }
    }">
    <x-scholar.form.input
    ref="{{$ref}}"
    :label="$label"
    :value="$value"
    :readonly="$readonly"
    type="password"
    :name="$name"
    :help="$help"
    :placeholder="$placeholder"
    :required="$required"
    />
    <button type="button" class="text-xs bottom-8 right-2 absolute" x-on:click="toggle()" x-show=" ! visible">show</button>
    <button type="button" class="text-xs bottom-8 right-2 absolute" x-on:click="toggle()" x-show=" visible">hide</button>
</div>
