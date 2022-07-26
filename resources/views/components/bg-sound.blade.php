@props(['path'])
<script>
    var sound = new Howl({
        src:'{{$path}}',
        loop: true,
        // html5: true,
    })
    sound.play()
</script>
