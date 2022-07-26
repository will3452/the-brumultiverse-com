@props(['path'])
<script>
    var sound = new Howl({
        src:'{{$path}}',
        loop: true,
        volume: 0.5,
        // html5: true,
    })
    sound.play()
</script>
