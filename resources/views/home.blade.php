<!DOCTYPE html>
<html lang="en">

@include('widgets.head')


<body>

    <canvas id="world"></canvas>
    <div class="all">
        <div id="home" class="container">
            @include('widgets.navbar')

            <div class="content">
                <div class="welcome">
                    <h1 class="lead"><b data-aos="fade-right" data-aos-delay="300" data-aos-duration="2000">HI !</b>
                    </h1>
                    <a href="#about">
                        <i class="fa-solid fa-chevron-down animated"></i>
                    </a>
                </div>
            </div>
            <div class="footer">
                <img class="logo" src="{{ asset('assets/images/uti.png') }}" alt="Nama Gambar" />

                <div class="diagonal-text">
                    Universitas Teknokrat &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    <br />Indonesia
                </div>
            </div>
            <div class="icon-container" data-aos="fade-right" data-aos-offset="300" data-aos-delay="200" data-aos-duration="1000">
                <i onclick="window.location.href='https://github.com/'" class="fa-brands fa-twitter"></i>
                <i onclick="window.location.href='https://github.com/'" class="fa-brands fa-github"></i>
                <i onclick="window.location.href='https://github.com/'" class="fa-brands fa-instagram"></i>
            </div>
        </div>

        <svg class="svg-filters" width="0" height="0" viewBox="0 0 0 0" xmlns="http://www.w3.org/2000/svg" version="1.1">
            <defs>
                <filter id="stroke">
                    <feMorphology in="SourceGraphic" operator="erode" radius="1" result="erode" />
                    <feMorphology in="SourceGraphic" operator="dilate" radius="1" result="dilate" />
                    <feComposite in="erode" in2="dilate" operator="xor" />
                </filter>
            </defs>
        </svg>

        <h1 class="outline-css typ">Universitas</h1>
        <h1 class="outline-svg typ">Teknokrat</h1>
        <h1 class="outline-svg gradient typ">Indonesia</h1>

        <section id="about" class="about-section">
            <div class="marquee">
                <h4 class="text">
                    <img src="{{ asset('assets/images/1.svg') }}" alt="Image 1" />
                    <img src="{{ asset('assets/images/1.svg') }}" alt="Image 2" />
                    <img src="{{ asset('assets/images/2.svg') }}" alt="Image 3" />
                </h4>
                <h4 class="text">
                    <img src="{{ asset('assets/images/1.svg') }}" alt="Image 1" />
                    <img src="{{ asset('assets/images/1.svg') }}" alt="Image 2" />
                    <img src="{{ asset('assets/images/2.svg') }}" alt="Image 3" />
                </h4>
                <h4 class="text">
                    <img src="{{ asset('assets/images/1.svg') }}" alt="Image 1" />
                    <img src="{{ asset('assets/images/1.svg') }}" alt="Image 2" />
                    <img src="{{ asset('assets/images/2.svg') }}" alt="Image 3" />
                </h4>
                <h4 class="text">
                    <img src="{{ asset('assets/images/1.svg') }}" alt="Image 1" />
                    <img src="{{ asset('assets/images/1.svg') }}" alt="Image 2" />
                    <img src="{{ asset('assets/images/2.svg') }}" alt="Image 3" />
                </h4>
            </div>
            <div class="about-content">
                <div class="Info">
                    <div class="about-text">
                        <h2>ABOUT</h2>
                        <h2>ABOUT</h2>
                    </div>
                    <p data-aos="fade-right" data-aos-delay="300" data-aos-duration="2000">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, quaerat. Laboriosam provident
                        quae beatae veniam eius alias doloribus iusto, molestias numquam odit vel facere nam, minima
                        magni! Sunt, ullam aliquam. Unde velit
                        reiciendis delectus quisquam laborum aspernatur quidem ipsa cupiditate ullam! Cupiditate
                        consequuntur est nesciunt sint dolore ullam quam, sapiente, dignissimos nihil, maxime qui
                        doloribus unde voluptatum aspernatur modi sunt
                        voluptatem eligendi non mollitia nisi! Ad exercitationem molestiae ratione cumque tempore
                        architecto incidunt illo, nobis repudiandae nesciunt, nam animi saepe minima deserunt
                        consequatur. Quibusdam animi accusamus molestiae
                        quo excepturi deserunt.
                    </p>
                </div>

                <div class="video-container">
                    <video autoplay loop muted>
                        <source src="{{ asset('assets/images/vid.mp4') }}" type="video/mp4" />
                    </video>
                </div>
            </div>
            <div class="marquee2">
                <h4 class="text">Fakultas Teknik dan Ilmu Komputer - Fakultas Ekonomi Dan Bisnis - FAKULTAS SASTRA DAN
                    ILMU PENDIDIKAN -&nbsp;</h4>
                <h4 class="text">Fakultas Teknik dan Ilmu Komputer - Fakultas Ekonomi Dan Bisnis - FAKULTAS SASTRA DAN
                    ILMU PENDIDIKAN -&nbsp;</h4>
                <h4 class="text">Fakultas Teknik dan Ilmu Komputer - Fakultas Ekonomi Dan Bisnis - FAKULTAS SASTRA DAN
                    ILMU PENDIDIKAN -&nbsp;</h4>
                <h4 class="text">Fakultas Teknik dan Ilmu Komputer - Fakultas Ekonomi Dan Bisnis - FAKULTAS SASTRA DAN
                    ILMU PENDIDIKAN -&nbsp;</h4>
            </div>
        </section>

        <section id="events" class="events-section">
            <section class="top-content">
                <div class="carousel">
                    <div class="carousel-item"><img src="{{ asset('assets/images/carrousel1.JPG') }}" /></div>
                    <div class="carousel-item"><img src="{{ asset('assets/images/carrousel2.JPG') }}" /></div>
                    <div class="carousel-item"><img src="{{ asset('assets/images/carrousel3.JPG') }}" /></div>
                </div>
                <div class="events-Info">
                    <div class="events-text">
                        <h2>EVENT</h2>
                        <h2>EVENT</h2>
                    </div>
                    <p data-aos="fade-down" data-aos-delay="300" data-aos-duration="2000">Lorem ipsum dolor, sit amet
                        consectetur adipisicing. Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt,
                        voluptates.</p>
                    <div class="bottom">
                        <h3 data-aos="fade-right" data-aos-delay="400" data-aos-duration="1200">© 2023 CONST - All
                            Rights Reserved.</h3>
                        <button onclick="window.location.href='./page/events.html'" data-aos="zoom-in" data-aos-delay="800" data-aos-duration="2000">Selengkapnya</button>
                    </div>
                </div>
            </section>

            <!-- Events section -->

            <section class="grid-card">
                <div class="card-container" data-aos="zoom-in-left" data-aos-delay="700" data-aos-duration="2000">
                    <div class="card">
                        <div class="fornt"><img class="img-card" src="{{ asset('assets/images/card.png') }}" /></div>
                        <div class="back"></div>
                        <div class="infomation">
                            <img src="{{ asset('assets/images/3.svg') }}" class="profile_image" />
                            <div class="names">
                                <div class="project_name">Campus Expo</div>
                                <div class="user_name">HIMA FTIK</div>
                            </div>
                        </div>

                        <div class="li_co_vi">
                            <div class="like bg">
                                <i class="fa-solid fa-file-pen"></i>
                                <div class="num">0</div>
                            </div>

                            <div class="view bg">
                                <i class="fa-solid fa-user-check"></i>
                                <div class="num">0</div>
                            </div>
                            <!-- <div class="coment bg">
                <i class="fas fa-comment-alt"></i>
                <div class="num">0</div>
              </div> -->
                        </div>
                    </div>
                </div>
                <div class="card-container" data-aos="zoom-in-left" data-aos-delay="700" data-aos-duration="2000">
                    <div class="card">
                        <div class="fornt"><img class="img-card" src="{{ asset('assets/images/card.png') }}" /></div>
                        <div class="back"></div>
                        <div class="infomation">
                            <img src="{{ asset('assets/images/3.svg') }}" class="profile_image" />
                            <div class="names">
                                <div class="project_name">Campus Expo</div>
                                <div class="user_name">HIMA FTIK</div>
                            </div>
                        </div>

                        <div class="li_co_vi">
                            <div class="like bg">
                                <i class="fa-solid fa-file-pen"></i>

                                <div class="num">0</div>
                            </div>

                            <div class="view bg">
                                <i class="fa-solid fa-user-check"></i>
                                <div class="num">0</div>
                            </div>
                            <!-- <div class="coment bg">
              <i class="fas fa-comment-alt"></i>
              <div class="num">0</div>
            </div> -->
                        </div>
                    </div>
                </div>
                <div class="card-container" data-aos="zoom-in-left" data-aos-delay="700" data-aos-duration="2000">
                    <div class="card">
                        <div class="fornt"><img class="img-card" src="{{ asset('assets/images/card.png') }}" /></div>
                        <div class="back"></div>
                        <div class="infomation">
                            <img src="{{ asset('assets/images/3.svg') }}" class="profile_image" />
                            <div class="names">
                                <div class="project_name">Campus Expo</div>
                                <div class="user_name">HIMA FTIK</div>
                            </div>
                        </div>

                        <div class="li_co_vi">
                            <div class="like bg">
                                <i class="fa-solid fa-file-pen"></i>

                                <div class="num">0</div>
                            </div>

                            <div class="view bg">
                                <i class="fa-solid fa-user-check"></i>
                                <div class="num">0</div>
                            </div>
                            <!-- <div class="coment bg">
              <i class="fas fa-comment-alt"></i>
              <div class="num">0</div>
            </div> -->
                        </div>
                    </div>
                </div>
                <div class="card-container" data-aos="zoom-in-left" data-aos-delay="700" data-aos-duration="2000">
                    <div class="card">
                        <div class="fornt"><img class="img-card" src="{{ asset('assets/images/card.png') }}" /></div>
                        <div class="back"></div>
                        <div class="infomation">
                            <img src="{{ asset('assets/images/3.svg') }}" class="profile_image" />
                            <div class="names">
                                <div class="project_name">Campus Expo</div>
                                <div class="user_name">HIMA FTIK</div>
                            </div>
                        </div>

                        <div class="li_co_vi">
                            <div class="like bg">
                                <i class="fa-solid fa-file-pen"></i>

                                <div class="num">0</div>
                            </div>

                            <div class="view bg">
                                <i class="fa-solid fa-user-check"></i>
                                <div class="num">0</div>
                            </div>
                            <!-- <div class="coment bg">
              <i class="fas fa-comment-alt"></i>
              <div class="num">0</div>
            </div> -->
                        </div>
                    </div>
                </div>
                <div class="card-container" data-aos="zoom-in-left" data-aos-delay="700" data-aos-duration="2000">
                    <div class="card">
                        <div class="fornt"><img class="img-card" src="{{ asset('assets/images/card.png') }}" /></div>
                        <div class="back"></div>
                        <div class="infomation">
                            <img src="{{ asset('assets/images/3.svg') }}" class="profile_image" />
                            <div class="names">
                                <div class="project_name">Campus Expo</div>
                                <div class="user_name">HIMA FTIK</div>
                            </div>
                        </div>

                        <div class="li_co_vi">
                            <div class="like bg">
                                <i class="fa-solid fa-file-pen"></i>

                                <div class="num">0</div>
                            </div>

                            <div class="view bg">
                                <i class="fa-solid fa-user-check"></i>
                                <div class="num">0</div>
                            </div>
                            <!-- <div class="coment bg">
              <i class="fas fa-comment-alt"></i>
              <div class="num">0</div>
            </div> -->
                        </div>
                    </div>
                </div>
            </section>
            <div class="marquee">
                <h4 class="text">
                    <img src="{{ asset('assets/images/1.svg') }}" alt="Image 1" />
                    <img src="{{ asset('assets/images/1.svg') }}" alt="Image 2" />
                    <img src="{{ asset('assets/images/2.svg') }}" alt="Image 3" />
                </h4>
                <h4 class="text">
                    <img src="{{ asset('assets/images/1.svg') }}" alt="Image 1" />
                    <img src="{{ asset('assets/images/1.svg') }}" alt="Image 2" />
                    <img src="{{ asset('assets/images/2.svg') }}" alt="Image 3" />
                </h4>
                <h4 class="text">
                    <img src="{{ asset('assets/images/1.svg') }}" alt="Image 1" />
                    <img src="{{ asset('assets/images/1.svg') }}" alt="Image 2" />
                    <img src="{{ asset('assets/images/2.svg') }}" alt="Image 3" />
                </h4>
                <h4 class="text">
                    <img src="{{ asset('assets/images/1.svg') }}" alt="Image 1" />
                    <img src="{{ asset('assets/images/1.svg') }}" alt="Image 2" />
                    <img src="{{ asset('assets/images/2.svg') }}" alt="Image 3" />
                </h4>
            </div>
        </section>

        <section class="sponsor">
            <div class="thx">
                <h2>
                    Special <br />
                    Thanks!
                </h2>
            </div>
            <div class="sponsor-content" data-aos="fade-right" data-aos-delay="500" data-aos-duration="2000">
                <div class="sponsor-container">
                    <div class="sponsor-logo">
                        <img src="{{ asset('assets/images/alibb.png') }}" alt="Sponsor Logo 1" />
                    </div>
                </div>
                <div class="sponsor-container">
                    <div class="sponsor-logo">
                        <img src="{{ asset('assets/images/mongo.png') }}" alt="Sponsor Logo 2" />
                    </div>
                </div>
                <div class="sponsor-container">
                    <div class="sponsor-logo">
                        <img src="{{ asset('assets/images/nasa.png') }}" alt="Sponsor Logo 3" />
                    </div>
                </div>
                <div class="sponsor-container">
                    <div class="sponsor-logo">
                        <img src="{{ asset('assets/images/micr.png') }}" alt="Sponsor Logo 4" />
                    </div>
                </div>
                <div class="sponsor-container">
                    <div class="sponsor-logo">
                        <img src="{{ asset('assets/images/pertamina.svg') }}" alt="Sponsor Logo 5" />
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div id="contact">
        <div class="footer-container">
            <div class="contact">
                <h3>Contact Us</h3>
                <ul class="contact-text">
                    <li>Email: contact@example.com</li>
                    <li>Phone: (123) 456-7890</li>
                    <li>Address: 123 Main Street, City</li>
                </ul>
            </div>
            <div class="route-page">
                <h3>Route Pages</h3>
                <ul class="contact-text">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#events">Events</a></li>
                    <li><a href="#contact">Contacts</a></li>
                    <li class="route-btm">
                        @if(Auth::guard('admin')->check())
                        <h4>{{ auth()->guard('admin')->user()->name }}</h4>
                        <div class=" route-icons-btm">
                            <a href="{{route('dashboard')}}"><i class="fa-solid fa-laptop-code" title="Dashboard"></i></a>
                            <a href="{{route('logout')}}"><i class="fa-solid fa-door-open" title="LogOut"></i></a>
                        </div>
                        @elseif(Auth::check())
                        <h4>{{ auth()->user()->name }}</h4>
                        <a href="{{route('logout')}}" title="LogOut">LogOut</a>
                        @else
                        <a href="{{route('login')}}">LogIn</a>
                        @endif
                    </li>
                </ul>
            </div>

            <div class="img-footer">
                <img src="{{ asset('assets/images/uti.png') }}" alt="img-footer" />
            </div>
        </div>
    </div>
    <footer>
        <p class="copyright">&copy; 2023 Const. All Rights Reserved.</p>
    </footer>
</body>

</html>