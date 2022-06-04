<x-student.layout>
    <x-student.static-background-container>
        <div x-data="data">
            <template x-if="step == 'closet'">
                <x-student.dialog-container>
                    <x-student.typing message="Got new uniform and clothes? change into them here." delay="20" clear="0"/>
                    <x-student.dialog-button-container>
                        <button class="btn-student-active mt-2" x-on:click="item = {item:'mirror', path:'active-mirror.png'}; loadItem(); step = null;">
                            Ok
                        </button>
                    </x-student.dialog-button-container>
                </x-student.dialog-container>
            </template>

            <template x-if="step == 'mirror'">
                <x-student.dialog-container>
                    <x-student.typing message="In the mood for new hair? DO it here." delay="20" clear="0"/>
                    <x-student.dialog-button-container>
                        <button class="btn-student-active mt-2" x-on:click="item = {item:'bag', path:'active-bag.png'}; loadItem(); step = null;">
                            Ok
                        </button>
                    </x-student.dialog-button-container>
                </x-student.dialog-container>
            </template>

            <template x-if="step == 'bag'">
                <x-student.dialog-container>
                    <x-student.typing message="Got items on STORAGE you wish to bring out? Open your bag." delay="20" clear="0"/>
                    <x-student.dialog-button-container>
                        <a class="btn-student-active mt-2" href="{{route('student.welcome.closet', ['step' => 0])}}">
                            Ok
                        </a>
                    </x-student.dialog-button-container>
                </x-student.dialog-container>
            </template>

            <div id="konva-container"></div>
        </div>
    </x-student.static-background-container>
        @push('body-script')
            <x-vendor.konvajs/>
            <script>
                var data = {
                    step:null,
                    assetUri:'{{getAsset("closet/", true)}}',
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
                        });
                    },
                    item: {path:'active-closet.png', item:'closet'},
                    stage:null,
                    layer:null,
                    center:null,
                    baseCloset:null,
                    loadItem() {
                        const itemImage = new Image();
                        itemImage.src = `${this.assetUri}/${this.item.path}`;
                        itemImage.onload = () => {
                            const kItem = new Konva.Image({
                                image:itemImage,
                                x: this.center,
                                y:0,
                                width: this.stage.height() * (this.baseCloset.width / this.baseCloset.height),
                                height:this.stage.height(),
                            })
                            kItem.zIndex(4);
                            kItem.on('click', () => {
                                this.step = this.item.item;
                                kItem.destroy();
                            })
                            kItem.cache();
                            kItem.drawHitFromCache();
                            this.layer.add(kItem);
                        }
                    },
                    loadImages() {
                        const baseCloset = new Image();
                        this.baseCloset = baseCloset;
                        const newspaper = new Image();
                        const diary = new Image();
                        var baseClosetWidth;
                        baseCloset.onload = () => {
                            baseClosetWidth = this.stage.height() * (baseCloset.width / baseCloset.height);
                            this.center = (this.stage.width() - baseClosetWidth) / 2;
                            console.log('loaded')
                            let w = baseClosetWidth;
                            let h = this.stage.height();
                            let kbaseCloset = new Konva.Image({
                                x: this.center,
                                y:0,
                                width: w,
                                height: h,
                                image:baseCloset,
                            });
                            kbaseCloset.cache();
                            kbaseCloset.filters([Konva.Filters.Brighten])
                            this.layer.add(kbaseCloset);
                            kbaseCloset.brightness(-0.3);
                            this.loadItem();
                        }
                        baseCloset.src = `${this.assetUri}/base.png`;
                    },
                    init() {
                        this.initStage();
                        this.stage.content.style.background = '#000';
                        this.layer = new Konva.Layer();
                        //loader
                        this.loadImages();
                        this.stage.add(this.layer);
                    }
                };
            </script>
        @endpush

    </x-student.layout>
