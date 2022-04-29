<div x-data="data">
    <div id="konva-container"></div>
</div>
@push('head-script')
    <x-vendor.konvajs />
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
                draggable:true,
            });


            // stage dragable
            this.stage.on('dragmove', function() {

                if(this.y() >= 0) {
                    this.y(0)
                }

                this.x(0)

                if (Math.abs(this.y()) >= (this.height() / 2) ) {
                    this.y(-(this.height() / 2))
                }
            })


            this.mainLayer = new Konva.Layer();

            this.stage.add(this.mainLayer);


            // load base map image
            let baseMap = new Image();
            baseMap.src = '/students/map/base.png';

            baseMap.onload = () => {
                let sw = this.screenWidth;
                let sh = this.screenHeight * (baseMap.width / baseMap.height);
                const kmap = new Konva.Image({
                    x:0,
                    y:0,
                    width: sw,
                    height:sh,
                    image: baseMap,
                });

                this.mainLayer.add(kmap);
            }

        }
    }
</script>
@endpush
