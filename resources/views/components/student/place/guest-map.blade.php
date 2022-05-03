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
        baseUri:'/students/map/',
        clickableHeight:null,
        clickableSetter() {
            this.objectClickables.forEach((item) => this.loadClickables(item))
        },
        loadClickables({item, path}) {
                const Item = new Image();

                Item.onload = ()=>{
                    const kItem = new Konva.Image({
                        x:0,
                        y:0,
                        width:this.screenWidth,
                        height:this.clickableHeight,
                        image:Item,
                    });

                    kItem.opacity(0)
                    kItem.zIndex(4);

                    kItem.on('mouseover', function () {
                        this.opacity(1)
                    })

                    kItem.on('click', function () {
                        console.log(item)
                    });

                    kItem.on('mouseout', function () {
                        this.opacity(0)
                    })

                    kItem.cache();
                    kItem.drawHitFromCache();
                    console.log(kItem);
                    this.mainLayer.add(kItem)
                }

                Item.src = `${this.baseUri}/${path}`;
            },
            objectClickables : [
                {item:'library', path:'active-library.png', url:''},
                {item:'admin', path:'active-admin-building.png', url:''},
                {item:'berkeley', path:'active-berkeley-hall.png', url:''},
                {item:'hippodrome', path:'active-hippodrome.png', url:''},
                {item:'is', path:'active-integrated-school.png', url:''},
                {item:'museum', path:'active-museum.png', url:''},
                {item:'reagan', path:'active-reagan-hall.png', url:''},
                {item:'teather', path:'active-theater.png', url:''},
                {item:'vacant', path:'active-vacant-slot.png', url:''}
            ],
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
            baseMap.src = this.baseUri + 'base.png';

            baseMap.onload = () => {
                let sw = this.screenWidth;
                let sh = this.screenHeight * (baseMap.width / baseMap.height);
                this.clickableHeight = sh; // must be the height of all clickables
                const kmap = new Konva.Image({
                    x:0,
                    y:0,
                    width: sw,
                    height:sh,
                    image: baseMap,
                });

                this.mainLayer.add(kmap);
                this.clickableSetter();
            }

        }
    }
</script>
@endpush
