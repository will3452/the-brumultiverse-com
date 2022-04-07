<div x-data="data">
    <div id="konva-container"></div>
</div>
@push('body-script')
    <x-vendor.konvajs/>
    <script>
        var data = {
            assetUri:'{{auth()->user()->isGenderMale() ? getAsset("male-dorm/", true) : getAsset("female-dorm/", true)}}',
            initStage() {
                let width = window.innerWidth;
                let height = window.innerHeight - document.querySelector('#bottombar').clientHeight;
                this.stage = new Konva.Stage({
                    container: '#konva-container',
                    height: height,
                    width:width,
                    draggable:true,
                })

                this.stage.on('dragmove', function() {
                    this.y(0)
                })
            },
            stage:null,
            layer:null,
            center:null,
            init() {
                this.initStage();
                this.center = this.stage.width() / 8;
                this.stage.content.style.background = '#000';
                this.layer = new Konva.Layer();

                //loader
                const loader = new Konva.Text({text:'loading...', fill:'white', x:0,y:0});
                this.layer.add(loader);
                //

                const dorm = new Image();

                dorm.onload = () => {
                    console.log('loaded')
                    let w = this.stage.height() * (dorm.width / dorm.height);
                    let h = this.stage.height();
                    let kdorm = new Konva.Image({
                        x: this.center,
                        y:0,
                        width: w,
                        height: h,
                        image:dorm,
                    });

                    console.log(kdorm);
                    this.layer.add(kdorm);
                }

                dorm.src = `${this.assetUri}/base.png`

                const phone = new Image();

                phone.onload = ()=>{
                    const kphone = new Konva.Image({
                        x:this.center,
                        y:0,
                        width:this.stage.height() * (dorm.width / dorm.height),
                        height:this.stage.height(),
                        image:phone,
                    });

                    kphone.opacity(0)
                    kphone.zIndex(4);

                    kphone.on('mouseover', function () {
                        this.opacity(1)
                        console.log('phone in')
                    })

                    kphone.on('mouseout', function () {
                        this.opacity(0)
                        console.log('phone out')
                    })

                    kphone.cache();
                    kphone.drawHitFromCache();
                    this.layer.add(kphone)
                }

                phone.src = `${this.assetUri}/active-phone.png`;

                const newspaper = new Image();

                newspaper.onload = () => {
                    const knewspaper = new Konva.Image({
                        width: this.stage.height() * (dorm.width / dorm.height),
                        height:this.stage.height(),
                        x:this.center,
                        y:0,
                        image:newspaper,
                    });
                    knewspaper.zIndex(4);
                    knewspaper.opacity(0);
                    knewspaper.on('mouseover', function() {
                        this.opacity(1)
                        console.log('newspaper in')
                    })
                    knewspaper.on('mouseout', function () {
                        this.opacity(0)
                        console.log('newspaper out')
                    })

                    knewspaper.cache();
                    knewspaper.drawHitFromCache();
                    this.layer.add(knewspaper);
                }

                newspaper.src = `${this.assetUri}/active-newspaper.png`;

                const diary = new Image();

                diary.onload = () => {
                    const kdiary = new Konva.Image({
                        x:this.center,
                        y:0,
                        width:  this.stage.height() * (dorm.width / dorm.height),
                        height: this.stage.height(),
                        image:diary,
                    });
                    kdiary.zIndex(4);
                    kdiary.opacity(0);

                    kdiary.on('mouseover', function () {
                        this.opacity(1);
                        console.log('diary in');
                    })

                    kdiary.on('mouseout', function () {
                        this.opacity(0);
                        console.log('diary out');
                    })
                    kdiary.cache();
                    kdiary.drawHitFromCache();
                    this.layer.add(kdiary);
                }

                diary.src = `${this.assetUri}/active-diary.png`;

                const closet = new Image();

                closet.src = `${this.assetUri}/active-closet.png`;

                closet.onload = () => {
                    const kcloset = new Konva.Image({
                        image:closet,
                        x: this.center,
                        y:0,
                        width: this.stage.height() * (dorm.width / dorm.height),
                        height:this.stage.height(),
                    });
                    kcloset.opacity(0);
                    kcloset.zIndex(4);
                    kcloset.on('mouseover', function () {
                        console.log('closet in');
                        this.opacity(1);
                    })
                    kcloset.on('mouseout', function () {
                        console.log('closet out');
                        this.opacity(0);
                    })
                    kcloset.cache();
                    kcloset.drawHitFromCache();
                    this.layer.add(kcloset);
                }

                const computer = new Image();

                computer.src = `${this.assetUri}/active-computer.png`;

                computer.onload = () => {
                    const kcomputer = new Konva.Image({
                        image:computer,
                        x: this.center,
                        y:0,
                        width: this.stage.height() * (dorm.width / dorm.height),
                        height:this.stage.height(),
                    });
                    kcomputer.opacity(0);
                    kcomputer.zIndex(4);
                    kcomputer.on('mouseover', function () {
                        console.log('computer in');
                        this.opacity(1);
                    })
                    kcomputer.on('mouseout', function () {
                        console.log('computer out');
                        this.opacity(0);
                    })
                    kcomputer.cache();
                    kcomputer.drawHitFromCache();
                    this.layer.add(kcomputer);
                }

                const radio = new Image();

                radio.src = `${this.assetUri}/active-radio.png`;

                radio.onload = () => {
                    const kradio = new Konva.Image({
                        image:radio,
                        x: this.center,
                        y:0,
                        width: this.stage.height() * (dorm.width / dorm.height),
                        height:this.stage.height(),
                    });
                    kradio.opacity(0);
                    kradio.zIndex(4);
                    kradio.on('mouseover', function () {
                        console.log('radio in');
                        this.opacity(1);
                    })
                    kradio.on('mouseout', function () {
                        console.log('radio out');
                        this.opacity(0);
                    })
                    kradio.cache();
                    kradio.drawHitFromCache();
                    this.layer.add(kradio);
                }

                const books = new Image();

                books.src = `${this.assetUri}/active-books.png`;

                books.onload = () => {
                    const kbooks = new Konva.Image({
                        image:books,
                        x: this.center,
                        y:0,
                        width: this.stage.height() * (dorm.width / dorm.height),
                        height:this.stage.height(),
                    });
                    kbooks.opacity(0);
                    kbooks.zIndex(4);
                    kbooks.on('mouseover', function () {
                        console.log('books in');
                        this.opacity(1);
                    })
                    kbooks.on('mouseout', function () {
                        console.log('books out');
                        this.opacity(0);
                    })
                    kbooks.cache();
                    kbooks.drawHitFromCache();
                    this.layer.add(kbooks);
                }

                this.stage.add(this.layer);
            }
        };
    </script>
@endpush
