<x-student.layout>
    <x-student.static-background-container bg="#">
        <div x-data="data">
            <div id="konva-container"></div>
        </div>
    </x-student.static-background-container>
    <x-vendor.konvajs/>
    @push('body-script')
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

                    this.stage.add(this.layer);
                }
            };
        </script>
    @endpush
</x-student.layout>
