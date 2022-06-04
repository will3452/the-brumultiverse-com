<div x-data="data">
    <div id="konva-container"></div>
</div>
@push('body-script')
    <x-vendor.konvajs/>
    <script>
        var data = {
            assetUri:'{{auth()->user()->isGenderMale() ? getAsset("male-dorm/", true) : getAsset("female-dorm/", true)}}',
            loadClickables({item, path}) {
                const Item = new Image();

                Item.onload = ()=>{
                    const kItem = new Konva.Image({
                        x:this.center,
                        y:0,
                        width:this.stage.height() * (this.dorm.width / this.dorm.height),
                        height:this.stage.height(),
                        image:Item,
                    });

                    kItem.opacity(0)
                    kItem.zIndex(4);

                    kItem.on('mouseover', function () {
                        this.opacity(1)
                    })

                    kItem.on('mouseout', function () {
                        this.opacity(0)
                    })

                    kItem.cache();
                    kItem.drawHitFromCache();
                    this.layer.add(kItem)
                }

                Item.src = `${this.assetUri}/${path}`;
            },
            objectClickables : [
                {item:'book', path:'active-books.png', url:''},
                {item:'computer', path:'active-computer.png', url:''},
                {item:'phone', path:'active-phone.png', url:''},
                {item:'newspaper', path:'active-newspaper.png', url:''},
                {item:'diary', path:'active-diary.png', url:''},
                {item:'radio', path:'active-radio.png', url:''},
                {item:'closet', path:'active-closet.png', url:''}
            ],
            clickableSetter() {
                this.objectClickables.forEach((item) => this.loadClickables(item))
            },
            initStage() {
                let width = window.innerWidth;
                let height = window.innerHeight - document.querySelector('#bottombar').clientHeight;
                this.stage = new Konva.Stage({
                    container: '#konva-container',
                    height: height,
                    width:width,
                })

                this.stage.on('dragmove', function() {
                    this.y(0)
                })
            },

            stage:null,
            layer:null,
            center:null,
            dorm:null,
            loadImages() {
                const dorm = new Image();

                this.dorm = dorm;

                dorm.onload = () => {
                    const dormW = this.stage.height() * (dorm.width / dorm.height);
                    this.center = (this.stage.width() - dormW) / 2;
                    let w = dormW;
                    let h = this.stage.height();
                    let kdorm = new Konva.Image({
                        x: this.center,
                        y:0,
                        width: w,
                        height: h,
                        image:dorm,
                    });
                    this.layer.add(kdorm);
                    this.clickableSetter();
                }

                dorm.src = `${this.assetUri}/base.png`
            },
            init() {
                this.initStage();
                this.stage.content.style.background = '#000';
                this.layer = new Konva.Layer();

                this.loadImages();
                this.stage.add(this.layer);
            }
        };
    </script>
@endpush
