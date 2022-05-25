<x-student.static-background-container bg="#fff">
    <div x-data="data">
        <template x-if="step == 'library'">
            <x-student.dialog-container>
                <x-student.typing message="Do you want to enter the Library?" delay="20" clear="0"/>
                <x-student.dialog-button-container>
                    <a class="btn-student-active m-2" href="{{route('student.library.intro')}}">
                        Yes
                    </a>
                    <button class="btn-student m-2" x-on:click="step = null;">
                        No
                    </button>
                </x-student.dialog-button-container>
            </x-student.dialog-container>
        </template>

        <template x-if="step == 'museum'">
            <x-student.dialog-container>
                <x-student.typing message="Do you want to enter the Museum?" delay="20" clear="0"/>
                <x-student.dialog-button-container>
                    <a class="btn-student-active m-2" href="{{route('student.museum.intro')}}">
                        Yes
                    </a>
                    <button class="btn-student m-2" x-on:click="step = null;">
                        No
                    </button>
                </x-student.dialog-button-container>
            </x-student.dialog-container>
        </template>
        <div id="konva-container"></div>
    </div>
</x-student.static-background-container>
@push('head-script')
    <x-vendor.konvajs />
@endpush

@push('body-script')
<script>
    var data = {
        step:null,
        stage:null,
        mainLayer:null,
        screenWidth: null,
        screenHeight: null,
        baseUri:'/students/map/',
        clickableHeight:null,
        clickableSetter() {
            this.objectClickables.forEach((item) => this.loadClickables(item))
        },
        userDorm:`{{auth()->user()->interest->college_id}}`,
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
                    });

                    let dorms = ['berkeley', 'is', 'reagan'];

                    kItem.on('click', () => {
                        if (dorms.find((e) => e === item)) {
                            if (this.userDorm == 1 && item == 'is') {
                                window.location.href = '{{route("student.dorm.me")}}';
                                return;
                            }
                            if (this.userDorm == 2 && item == 'berkeley') {
                                window.location.href = '{{route("student.dorm.me")}}';
                                return;
                            }
                            if (this.userDorm == 3 && item == 'reagan') {
                                window.location.href = '{{route("student.dorm.me")}}';
                                return;
                            }
                        }
                        this.step = item;
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
                {item:'library', path:'active-library-min.png', url:''},
                {item:'admin', path:'active-admin-building-min.png', url:''},
                {item:'berkeley', path:'active-berkeley-hall-min.png', url:''},
                {item:'hippodrome', path:'active-hippodrome-min.png', url:''},
                {item:'is', path:'active-integrated-school-min.png', url:''},
                {item:'museum', path:'active-museum-min.png', url:''},
                {item:'reagan', path:'active-reagan-hall-min.png', url:''},
                {item:'teather', path:'active-theater-min.png', url:''},
                {item:'vacant', path:'active-vacant-slot-min.png', url:''}
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
            baseMap.src = this.baseUri + 'base-min.png';

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
