<x-student.layout>
<x-student.static-background-container>
    <div x-data="data">
        <template x-if="step == 'init'">
            <x-student.dialog-container>
                <x-student.typing message="Try to click on the shimmering items to reveal where they would take you." delay="20" clear="0"/>
                <x-student.dialog-button-container>
                    <button class="btn-student-active mt-2" x-on:click="loadItem(); step = null;">
                        Ok
                    </button>
                </x-student.dialog-button-container>
            </x-student.dialog-container>
        </template>
        <template x-if="step == 'book'">
            <x-student.dialog-container>
                <x-student.typing message="Ready to read? your bookshelf opens your COLLECTION of BOOKS, AUDIO BOOKS, ARTWORKS, SHORT FILMS AND SONGS." delay="10" clear="0"/>
                <x-student.dialog-button-container>
                    <button class="btn-student-active mt-2" x-on:click="item = {item:'computer', path:'active-computer.png'};loadItem(); step = null; ">
                        Ok
                    </button>
                </x-student.dialog-button-container>
            </x-student.dialog-container>
        </template>
        <template x-if="step == 'computer'">
            <x-student.dialog-container>
                <x-student.typing message="Got changes to set? Your compute helps you to tweak your SETTINGS thru your DASHBOARD." delay="10" clear="0"/>
                <x-student.dialog-button-container>
                    <button class="btn-student-active mt-2" x-on:click="item = {item:'phone', path:'active-phone.png'};loadItem(); step = null; ">
                        Ok
                    </button>
                </x-student.dialog-button-container>
            </x-student.dialog-container>
        </template>
        <template x-if="step == 'phone'">
            <x-student.dialog-container>
                <x-student.typing message="Your phone holds your contacts and your mails. You may visit your FRIENDS by clicking on their Profile Photos here." delay="10" clear="0"/>
                <x-student.dialog-button-container>
                    <button class="btn-student-active mt-2" x-on:click="item = {item:'diary', path:'active-diary.png'};loadItem(); step = null; ">
                        Ok
                    </button>
                </x-student.dialog-button-container>
            </x-student.dialog-container>
        </template>
        <template x-if="step == 'diary'">
            <x-student.dialog-container>
                <x-student.typing message="Ah. Of course, You have memories to keep. Clicking your BRU DIARY will bring you right to its pages." delay="10" clear="0"/>
                <x-student.dialog-button-container>
                    <button class="btn-student-active mt-2" x-on:click="item = {item:'newspaper', path:'active-newspaper.png'};loadItem(); step = null; ">
                        Ok
                    </button>
                </x-student.dialog-button-container>
            </x-student.dialog-container>
        </template>
        <template x-if="step == 'newspaper'">
            <x-student.dialog-container>
                <x-student.typing message="The Official University Paper. where you get the latest and hottest news about everything and everyone." delay="10" clear="0"/>
                <x-student.dialog-button-container>
                    <button class="btn-student-active mt-2" x-on:click="item = {item:'radio', path:'active-radio.png'};loadItem(); step = null; ">
                        Ok
                    </button>
                </x-student.dialog-button-container>
            </x-student.dialog-container>
        </template>
        <template x-if="step == 'radio'">
            <x-student.dialog-container>
                <x-student.typing message="Your speakers will blast the hottest songs and the latest university station podcasts." delay="10" clear="0"/>
                <x-student.dialog-button-container>
                    <button class="btn-student-active mt-2" x-on:click="item = {item:'closet', path:'active-closet.png'};loadItem(); step = null; ">
                        Ok
                    </button>
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
                step:'init',
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
                item: {path:'active-books.png', item:'book'},
                stage:null,
                layer:null,
                center:null,
                dorm:null,
                loadItem() {
                    const itemImage = new Image();
                    itemImage.src = `${this.assetUri}/${this.item.path}`;
                    itemImage.onload = () => {
                        const kItem = new Konva.Image({
                            image:itemImage,
                            x: this.center,
                            y:0,
                            width: this.stage.height() * (this.dorm.width / this.dorm.height),
                            height:this.stage.height(),
                        })
                        kItem.zIndex(4);
                        kItem.on('click', () => {
                            if (this.item.item == 'closet') {
                                window.location.href = '{{route("student.closet.tutorial")}}';
                                return;
                            }
                            this.step = this.item.item;
                            kItem.destroy();
                        })
                        kItem.cache();
                        kItem.drawHitFromCache();
                        this.layer.add(kItem);
                    }
                },
                loadImages() {
                    const dorm = new Image();
                    this.dorm = dorm;
                    const newspaper = new Image();
                    const diary = new Image();
                    var dormWidth;
                    dorm.onload = () => {
                        dormWidth = this.stage.height() * (dorm.width / dorm.height);
                        this.center = (this.stage.width() - dormWidth) / 2;
                        console.log('loaded')
                        let w = dormWidth;
                        let h = this.stage.height();
                        let kdorm = new Konva.Image({
                            x: this.center,
                            y:0,
                            width: w,
                            height: h,
                            image:dorm,
                        });
                        kdorm.cache();
                        kdorm.filters([Konva.Filters.Brighten])
                        this.layer.add(kdorm);
                        kdorm.brightness(-0.3);
                    }
                    dorm.src = `${this.assetUri}/base.png`;
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
