<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com" defer></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body>
    <div id="particles-js" class="bg-black fixed w-screen h-screen"></div>
    <div class="mx-auto">
            <div class="absolute">
                <!-- main container -->
                <header>
                    <nav x-data="{bruDropdown:false}">
                        <div class="flex justify-between items-center px-4">
                            <img class="w-48" src="https://raw.githubusercontent.com/will3452/bru-assets/main/home/textlogo.png" alt="">
                            <div>
                                <a href="https://brumultiverse.com/contact" class="text-white inline-block w-24 bg-gray-400 text-center p-1 hover:bg-gray-500 uppercase text-xs mx-4">
                                    Contact us
                                </a>
                                <a href="" x-on:click.prevent="bruDropdown = true" class="text-white inline-block w-24 bg-gray-400 text-center p-1 hover:bg-gray-500 uppercase text-xs mx-4">
                                    BRU
                                </a>
                            </div>
                        </div>
                        <div class="bg-black text-white inline-block absolute right-4 border-white border-2" x-show="bruDropdown" x-on:click.away="bruDropdown = false">
                            <a href="" class="block p-4 text-center hover:bg-blue-900">Sign up as Student</a>
                            <a href="" class="block p-4 text-center hover:bg-blue-900">Sign up as Scholar</a>
                        </div>
                    </nav>
                    <img src="/main.svg" alt="" class="mx-auto -mt-2 w-screen">
                    <div class="text-center text-white w-8/12 mx-auto">
                        <p class="pb-4" data-aos="fade-up">
                            BRUMULTIVERSE is the trade name of KamitHiraya Corporation, a software development and mass multimedia entertainment company established in 2020.
                        </p>
                        <p class="pb-4" data-aos="fade-up">
                            It is home to talented artists, authors, content creators, mentors from different fields and information technology experts that build digital and physical forms of connection to strengthen people, their art forms and craft, I.T. services and devices that make lives better and easier
                        </p>
                    </div>
                </header>

                <!-- first section -->
                <div class="flex flex-col md:flex-row items-center md:items-start m-2 md:mx-0 md:my-28 justify-center">
                    <div class="m-8/12 md:w-6/12 md:px-10">
                        <img
                        data-aos="flip-left"
                        data-aos-easing="ease-out-cubic"
                        data-aos-duration="2000"
                        src="https://raw.githubusercontent.com/will3452/bru-assets/main/home/map_bg.jpg" class="block object-cover border border-white h-96 m-2 md:m-0" alt="map">
                    </div>
                    <div class="m-8/12 md:w-6/12 md:px-10">
                        <div class="bg-white h-auto  w-full overflow-y-auto mx-auto" data-aos="fade-left">
                            <img src="https://raw.githubusercontent.com/will3452/bru-assets/main/home/map_bg.jpg" class="h-1/2 object-cover w-full" alt="">
                            <div class="p-4 text-center">
                                <h2 class="font-bold text-2xl text-center">The BRUMULTIVERSE</h2>
                                <p class="mt-4">
                                    The brainchild of Khiara Laurea and Miel Salva, BRUMULTIVERSE is vast, having multifold dimensions and realms, and parallel realities and universes, characters that come to life in the dead of nig...
                                    <a href="#" class="p-1 bg-gray-400 uppercase my-2 block text-center hover:bg-gray-900 hover:text-white">read more</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- end of first section -->
                <!-- second section -->

                <div class="flex flex-col md:flex-row items-center md:items-start m-2 md:mx-0 md:mb-28 justify-center">
                    <div class="m-8/12 md:w-6/12 md:px-10">
                        <div class="bg-white h-auto  w-100 overflow-y-auto mx-auto" data-aos="fade-right">
                            <img src="https://raw.githubusercontent.com/will3452/bru-assets/main/home/about/BRUNITY.jpg" class="h-1/2 object-cover w-full" alt="">
                            <div class="p-4 text-center">
                                <h2 class="font-bold text-2xl text-center">WRITE WITH US</h2>
                                <p class="mt-4">
                                    BRUMULTIVERSE is always in need of authors, artists and content creators, who see the world and the universe differently.
                                    <a href="https://brumultiverse.com/contact" class="p-1 bg-gray-400 uppercase my-2 block text-center hover:bg-gray-900 hover:text-white">how?</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="m-8/12 md:w-6/12 md:px-10">
                        <div class="bg-white h-auto  w-100 overflow-y-auto mx-auto" data-aos="fade-left">
                            <img src="https://raw.githubusercontent.com/will3452/bru-assets/main/home/about/BRU.jpg" class="h-1/2 object-cover w-full" alt="">
                            <div class="p-4 text-center">
                                <h2 class="font-bold text-2xl text-center">GATES ARE OPEN!</h2>
                                <p class="mt-4">
                                    Berkeley-Reagan University is a premiere FICTIONAL university in business sports, arts and sciences that bridges knowledge and culture and develops globally-competitive and responsible professionals attuned to a sustainable world.
                                    <a href="#" class="p-1 bg-gray-400 uppercase my-2 block text-center hover:bg-gray-900 hover:text-white">ENTER and ENROLL</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- end of second section -->

                <div class="flex m-2 md:mx-0 md:mb-28 justify-start">
                    <div class="m-8/12 md:w-6/12 md:px-10">
                        <div class="bg-white h-auto  w-100 overflow-y-auto mx-auto pt-4" data-aos="fade-right">
                            <img src="https://raw.githubusercontent.com/will3452/bru-assets/main/home/circle_logo.png" class="h-36 object-contain w-full" alt="">
                            <div class="p-4 text-center text-center">
                                <p>
                                    We’d love for you to join our growing BRU family!
                                </p>
                                <h2 class="font-bold text-2xl text-center">BRUMULTIVERSE</h2>
                                <p class="mt-4">
                                    Immerse yourself, experience and be part of each university story on e-books, audio books, short videos and songs from authors and artists around the globe!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of the main container -->
            </div>
            <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
            <script>
                particlesJS.load('particles-js', '/particlesjs-config.json', function() {
                    console.log('callback - particles.js config loaded');
                });
                AOS.init()
            </script>
    </div>
</body>
</html>
