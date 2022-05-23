<x-scholar.layout>
    <x-scholar.page.title>
        Banner Editor
    </x-scholar.page.title>
    <x-scholar.alert no-ok="1">
        Please note that banners created thru this site are solely for BRUMULTIVERSE App's purposes. Do not download and use outside of the App and this site.
    </x-scholar.alert>

    <div x-data="data" class="mt-4">
        <div class="relative flex justify-center bg-gray-900 w-full items-center" style="height:400px">
            <template x-if="loading">
                <div class="text-white text-2xl absolute w-full h-full items-center justify-center flex">
                    Loading Image...
                </div>
            </template>
            <div id="konva-canvas"></div>
        </div>
        <div x-show="step == 1">
            <span class="my-4 font-bold">Choose from among these default banner backgrounds.</span>
            <div class="w-full bg-gray-200 flex flex-wrap justify-start items-start">
                @for ($i = 1; $i <= 11; $i++)
                    <img x-on:click="selectBgHandler({{$i}})" id="bg{{$i}}" src="{{getAsset('banner/' . $i .'.jpg')}}" class="w-2/12 h-24 p-1 banners"/>
                @endfor
            </div>
            <div>
                <button class="btn btn-scholar" x-on:click="step++">
                    Next
                </button>
            </div>
        </div>

        <div x-show="step == 2">
            <span class="my-4 font-bold">Upload your Cover Book and Customize Text</span>
            <div class="my-4">
                <input type="file" id="bookCover">
            </div>
            <div class="my-2">
                <label for="title">Book Title</label>
                <input type="text" x-ref="title" id="title" class="input input-sm input-bordered">
                <label for="titlesize">Size</label>
                <input type="number" value="20" x-ref="titlesize" id="titlesize" class="input input-sm input-bordered">
                <label for="titlecolor">Color</label>
                <input type="color" x-ref="titlecolor" id="titlecolor">
            </div>
            <div class="my-2">
                <label for="description">Description</label>
                <input type="text" x-ref="description" id="description" class="input input-sm input-bordered">
                <label for="descriptionsize">Size</label>
                <input type="number" value="20" x-ref="descriptionsize" id="descriptionsize" class="input input-sm input-bordered">
                <label for="descriptioncolor">Color</label>
                <input type="color" x-ref="descriptioncolor" id="descriptioncolor">
            </div>
            <div class="my-2">
                <label for="cost">Cost</label>
                <input type="text" x-ref="cost" id="cost" class="input input-sm input-bordered">
                <label for="costsize">Size</label>
                <input type="number" value="20" x-ref="costsize" id="costsize" class="input input-sm input-bordered">
                <label for="costcolor">Color</label>
                <input type="color" x-ref="costcolor" id="costcolor">
            </div>
            <div>
                <a class="btn" href="{{url()->current()}}">
                    Restart
                </a>
                <button class="btn btn-scholar" x-on:click="download">
                    Download
                </button>
            </div>
        </div>
    </div>

    <x-vendor.alpinejs/>
    <x-vendor.konvajs/>
    @push('body-script')
        <script>
            var data = {
                step: 0,
                stage: null,
                layer:null,
                loading:false,
                fileReader:null,
                cover:null,
                selectBgHandler(e) {
                    let banners = document.querySelectorAll('.banners');
                    banners.forEach(e => e.classList.remove('selected-bg'));
                    document.querySelector('#bg' + e).classList.add('selected-bg');
                    this.loadImageSelected(e);
                },
                loadImageSelected(e) {
                    this.loading = true;
                    var imageOb = new Image();
                    imageOb.onload = () => {
                        var kbg = new Konva.Image({
                            x:0,
                            y:0,
                            image: imageOb,
                            width: 620,
                            height:320,
                        });
                        this.layer.add(kbg);
                        this.loading = false;
                    }
                    imageOb.crossOrigin = 'Anonymous';
                    imageOb.src = `{{getAsset('banner/')}}${e}.jpg`;
                },
                download() {
                    let dataURL = this.stage.toDataURL({ pixelRatio: 3 });
                    this.downloadURI(dataURL, 'stage.jpg');
                },
                downloadURI(uri, name) {
                    var link = document.createElement('a');
                    link.download = name;
                    link.href = uri;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    delete link;
                },
                initLayer() {
                    this.stage = new Konva.Stage({
                        container:'konva-canvas',
                        width: 620,
                        height:320,
                    });
                    this.layer = new Konva.Layer();

                    this.stage.add(this.layer);
                    this.layer.draw();
                },
                init() {
                    this.step = 1;
                    // this.loadImageSelected(1); // for testing
                    this.initLayer();
                    var bookCoverEl = document.querySelector('#bookCover');
                    bookCoverEl.addEventListener('change', () => {
                        console.log('if ' + bookCoverEl.files[0] && bookCoverEl.files)
                        if (bookCoverEl.files[0] && bookCoverEl.files) {
                            this.fileReader = new FileReader();
                            this.fileReader.readAsDataURL(bookCoverEl.files[0]);
                            this.fileReader.addEventListener('load', () => {
                                let kImage = new Image();
                                let kImageSrc = this.fileReader.result;
                                kImage.src = kImageSrc;
                                kImage.onload =  () => {

                                    let cover = new Konva.Image({
                                        scaleX:1,
                                        scaleY:1,
                                        skewY:-0.5,
                                        skewX:0.31,
                                        // offsetX:55,
                                        // offsetY:65,
                                        width:125,
                                        height:182,
                                        x:50,
                                        y:104,
                                        image:kImage,
                                        // draggable:true,
                                    });

                                    this.layer.add(cover);
                                }
                            })
                        }
                    })
                    this.loadEventText();
                },
                getElement(str) {
                    return document.querySelector(str);
                },
                setText(ins, val, size, color) {
                    if (ins != null) {
                        ins.destroy();
                    }
                    let text =  new Konva.Text({
                            draggable:true,
                            text: val,
                        });
                    text.fill(color);
                    text.fontSize(size);
                    return text;
                },
                loadEventText() {
                    let title = this.getElement('#title');
                    let titlesize = this.getElement('#titlesize');
                    let titlecolor = this.getElement('#titlecolor');
                    let description = this.getElement('#description');
                    let descriptionsize = this.getElement('#descriptionsize');
                    let descriptioncolor = this.getElement('#descriptioncolor');
                    let descriptionText = null;
                    let titleText = null;
                    let costText = null;

                    title.addEventListener('keyup', ()=>{
                        titleText = this.setText(titleText, this.$refs.title.value, this.$refs.titlesize.value, this.$refs.titlecolor.value);
                        titleText.x(620 / 2)
                        titleText.y(320 / 2)
                        this.layer.add(titleText);
                    });

                    titlesize.addEventListener('keyup', () => {
                        titleText = this.setText(titleText, this.$refs.title.value, this.$refs.titlesize.value, this.$refs.titlecolor.value);
                        titleText.x(620 / 2)
                        titleText.y(320 / 2)
                        this.layer.add(titleText);
                    });

                    titlecolor.addEventListener('change', () => {
                        titleText = this.setText(titleText, this.$refs.title.value, this.$refs.titlesize.value, this.$refs.titlecolor.value);
                        titleText.x(620 / 2)
                        titleText.y(320 / 2)
                        this.layer.add(titleText);
                    });

                    description.addEventListener('keyup', ()=>{
                        descriptionText = this.setText(descriptionText, this.$refs.description.value, this.$refs.descriptionsize.value, this.$refs.descriptioncolor.value);
                        descriptionText.x(620 / 2)
                        descriptionText.y(320 / 2)
                        this.layer.add(descriptionText);
                    });

                    descriptionsize.addEventListener('keyup', () => {
                        descriptionText = this.setText(descriptionText, this.$refs.description.value, this.$refs.descriptionsize.value, this.$refs.descriptioncolor.value);
                        descriptionText.x(620 / 2)
                        descriptionText.y(320 / 2)
                        this.layer.add(descriptionText);
                    });

                    descriptioncolor.addEventListener('change', () => {
                        descriptionText = this.setText(descriptionText, this.$refs.description.value, this.$refs.descriptionsize.value, this.$refs.descriptioncolor.value);
                        descriptionText.x(620 / 2)
                        descriptionText.y(320 / 2)
                        this.layer.add(descriptionText);
                    });

                    cost.addEventListener('keyup', ()=>{
                        costText = this.setText(costText, this.$refs.cost.value, this.$refs.costsize.value, this.$refs.costcolor.value);
                        costText.x(620 - 80)
                        costText.y(320 - 80)
                        this.layer.add(costText);
                    });

                    costsize.addEventListener('keyup', () => {
                        costText = this.setText(costText, this.$refs.cost.value, this.$refs.costsize.value, this.$refs.costcolor.value);
                        costText.x(620 - 80)
                        costText.y(320 - 80)
                        this.layer.add(costText);
                    });

                    costcolor.addEventListener('change', () => {
                        costText = this.setText(costText, this.$refs.cost.value, this.$refs.costsize.value, this.$refs.costcolor.value);
                        costText.x(620 - 80)
                        costText.y(320 - 80)
                        this.layer.add(costText);
                    });

                }
            }
        </script>
    @endpush
</x-scholar.layout>
