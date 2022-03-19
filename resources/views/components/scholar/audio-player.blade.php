@props(['src' => ''])
<div
class="bg-base-200 p-2 rounded border my-4"
x-data = "{
    status:'stopped',
    sound:null,
    currentTime:0,
    interval:null,
    init() {
        this.sound = new Howl({
            src: ['{{$src}}'],
            onload:()=>{
                this.$refs.progress.max = this.sound.duration();
                console.log(this.sound.duration())
            },
            onend: () => {
                this.status = 'stopped';
            }
          });
          this.setIntervalPlayer();
    },
    setIntervalPlayer() {
        this.interval = setInterval(()=>{
            this.currentTime = Math.ceil(this.sound.seek());
        }, 1000);
    },
    play() {
        this.sound.play();
        this.status = 'playing';
    },
    pause() {
        this.sound.pause();
        this.status = 'paused';
    },
    stop() {
        this.sound.stop();
        this.status = 'stopped';
    },
    restart() {
        this.sound.stop();
        this.play();
        this.status = 'playing';
    },
    changeValue() {
        console.log('hello world')
        clearInterval(this.interval);
        if (this.status !== 'paused') {
            this.sound.stop();
        }
        this.sound.seek(this.$refs.progress.value);
        if (this.status !== 'paused') {
            this.sound.play();
        }
        this.setIntervalPlayer();
    }
}">
    <input type="range" min="0" max="100" x-ref="progress" x-bind:value="currentTime" x-on:change="changeValue()" class="range range-xs">
    <div class="flex justify-center">
        <button class="mx-2" x-on:click="stop()" x-show="status === 'playing' || status === 'paused'">
            <img src="/img/icons/audio-player/stop-circle.svg" alt="">
        </button>
        <button class="mx-2" x-on:click="play()" x-show="status === 'stopped' || status === 'paused'">
            <img src="/img/icons/audio-player/play-circle.svg" alt="">
        </button>
        <button class="mx-2" x-on:click="pause()" x-show="status === 'playing'">
            <img src="/img/icons/audio-player/pause-circle.svg" alt="">
        </button>
        <button class="mx-2" x-on:click="restart()" x-show="status === 'playing' || status === 'paused'">
            <img src="/img/icons/audio-player/repeat.svg" alt="">
        </button>
    </div>
</div>
