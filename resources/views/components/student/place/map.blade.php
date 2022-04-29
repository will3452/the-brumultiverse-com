<div x-data="data">
    <div id="konva-container"></div>
</div>
@push('head-script')
    <x-vendor.konvajs/>
@endpush

@push('body-script')
<script>
    var data = {
        stage:null,
        mainLayer:null,
        screenWidth: null,
        screenHeight: null,
        init () {
            this.screenWidth = window.innerWidth;
            this.screenHeight = window.innerHeight - document.querySelector('#bottombar').clientHeight;

            // init stage
            this.stage = new Konva.Stage({
                container: 'konva-container',
                width: this.screenWidth,
                height: this.screenHeight,
            });


            this.mainLayer = new Konva.Layer();

            this.stage.add(this.mainLayer);


            // load base map image
            let baseMap = new Image();
            baseMap.src = '/map/base.png';

            baseMap.onload = () => {
                const kmap = new Konva.Image({
                    x:0,
                    y:0,
                    width: this.screenWidth,
                    height:this.screenHeight,
                    image: baseMap,
                })
            }
        }
    }
</script>
@endpush
