<!DOCTYPE html>
<html lang="en">

<head>
    @include('widgets.head')
    <title>Tvent - HomePage</title>

    @isset($event_time)
        <script>
            var countdownDate = {{ $event_time }} * 1000;

            var x = setInterval(function() {
                var now = new Date().getTime();
                // remove last 
                var distance = countdownDate - now;

                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor(
                    (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
                );
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                var daysText = days;
                var hoursText = hours;
                var minutesText = minutes;
                var secondsText = seconds;

                // Tampilkan waktu dalam elemen dengan id "countdown"
                document.getElementById("countdown-days").innerHTML = daysText;
                document.getElementById("countdown-hours").innerHTML = hoursText;
                document.getElementById("countdown-minutes").innerHTML = minutesText;
                document.getElementById("countdown-seconds").innerHTML = secondsText;

                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("countdown").innerHTML = "EXPIRED";
                }
            }, 1000);
        </script>
    @endisset

    <script src="{{ asset('assets/js/animated.js') }}" type="module"></script>
</head>

<body>

    @include('widgets.notify')

    <div class="navonHome">
        @include('widgets.navbar')
    </div>
    <canvas id="world"></canvas>
    <div id="home" class="container">

        <div class="content">
            <div class="welcome">
                <h1 class="lead">
                    <b data-aos="fade-right" data-aos-delay="300" data-aos-duration="2000">HI !</b>
                </h1>
                <a href="#count">
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
        <div class="icon-container" data-aos="fade-right" data-aos-offset="300" data-aos-delay="200"
            data-aos-duration="1000">
            <i onclick="window.location.href='https://github.com/'" class="fa-brands fa-twitter"></i>
            <i onclick="window.location.href='https://github.com/Informatika-C/Event-Laravel'"
                class="fa-brands fa-github" title="Source"></i>
            <i onclick="window.location.href='https://github.com/'" class="fa-brands fa-instagram"></i>
        </div>
    </div>

    <svg class="svg-filters" width="0" height="0" viewBox="0 0 0 0" xmlns="http://www.w3.org/2000/svg"
        version="1.1">
        <defs>
            <filter id="stroke">
                <feMorphology in="SourceGraphic" operator="erode" radius="1" result="erode" />
                <feMorphology in="SourceGraphic" operator="dilate" radius="1" result="dilate" />
                <feComposite in="erode" in2="dilate" operator="xor" />
            </filter>
        </defs>
    </svg>

    <h2 class="outline-css typ">Universitas</h2>
    <h2 class="outline-svg typ">Teknokrat</h2>
    <h2 class="outline-svg gradient typ">Indonesia</h2>

    @isset($event_first)
        <section id="count" class="coundown-section">
            {{-- <h5>Ayo Ikuti!</h5> --}}
            <div class="count-wrap">
                <div class="event-name">{{ $event_first->nama_lomba }}</div>
                <div class="count-left">
                    <div class="event-name-left">{{ $event_first->nama_lomba }}</div>
                    <div class="img-count"
                        style="background-image: url('{{ asset('storage/banner/' . $event_first->id . '/' . $event_first->banner) }}');">
                    </div>
                    <div class="desc">{{ $event_first->deskripsi }}
                        Diselenggarakan
                        oleh
                        @isset($event_first->penyelenggara)
                            <b id="event-authors" class="event-authors">
                                <span class="spn" title="Click">{{ $event_first->penyelenggara->nama_penyelenggara }}</span>

                                <span class="event-penyelenggara">
                                    <img
                                        class="bg-author"src="{{ asset('storage/penyelenggara/logo/' . $event_first->penyelenggara->id . '/' . $event_first->penyelenggara->logo) }}" />
                                    <h3>{{ $event_first->penyelenggara->nama_penyelenggara }}</h3>
                                </span>
                            </b>
                        @endisset
                    </div>

                    <div class="place">
                        Berlokasi Di
                        <b>
                            {{ $event_first->tempat }}
                        </b>
                        total kuota
                        <b>
                            <i class="fa-solid fa-user-group">{{ $event_first->add }}</i> orang
                        </b>
                        Pendaftaran dibuka pada
                        <b>
                            {{ \Carbon\Carbon::parse($event_first->tanggal_pendaftaran)->format('l, j F Y') }}
                            -
                            {{ \Carbon\Carbon::parse($event_first->tanggal_penutupan_pendaftaran)->format('l, j F Y') }}
                        </b>
                        dan Event akan di mulai pada
                        <b>
                            {{ \Carbon\Carbon::parse($event_first->tanggal_pelaksanaan)->format('l, j F Y') }}
                        </b>
                        <span class="status">
                            Ayo Segera daftarkan timmu!
                        </span>
                    </div>
                </div>
                {{-- <div class="count-right">
                    <div class="event-name">{{ $event_first->nama_lomba }}</div>
                    <div class="category-letter">CateGory</div>
                    <div class="horizon-card">
                        <div class="cardZone">Category 1</div>
                        <div class="cardZone">Category 2</div>
                        <div class="cardZone">Category 3</div>
                        <div class="cardZone">Category 4</div>
                        <div class="cardZone">Category 5</div>
                        <div class="cardZone">Category 6</div>
                        <div class="cardZone">Category 7</div>
                    </div>
                </div> --}}
            </div>

            <div class="body-count">
                <div id="countdown" class="clock-container">
                    <div class="count-letter">CountDown</div>
                    <div class="clock-col">
                        <h5 id="countdown-days" class="clock-timer"></h5>
                        <h6 class="clock-label">Day</h6>
                    </div>
                    <div class="clock-col">
                        <h5 id="countdown-hours" class="clock-timer"></h5>
                        <h6 class="clock-label">Hours</h6>
                    </div>
                    <div class="clock-col">
                        <h5 id="countdown-minutes" class="clock-timer"></h5>
                        <h6 class="clock-label">Minutes</h6>
                    </div>
                    <div class="clock-col">
                        <h5 id="countdown-seconds" class="clock-timer"></h5>
                        <h6 class="clock-label">Seconds</h6>
                    </div>
                </div>
                <button class="joint"
                    onclick="window.location.href='{{ route('home.lombapgs', ['event_id' => $event_first->id]) }}'">JOINT
                    Now!</button>
            </div>
        </section>
    @endisset

    <section id="events" class="events-section">
        <div class="marquee" style="margin-top: 2rem">
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
        <section class="top-content">
            <div class="carousel-container">
                <div class="carousel">
                    <div class="prev-arrow"><i class="fa-solid fa-angle-left"></i></div>
                    <div class="carousel-sections-scroll">
                        <div class="carousel-sections">
                            @isset($eventCrsl['eventImages'])
                                @foreach ($eventCrsl['eventImages'] as $index => $imageUrl)
                                    <div class="carousel-section{{ $index === 0 ? ' active' : '' }}"
                                        style="background-image: url('{{ $imageUrl }}');">
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                    <div class="next-arrow"><i class="fa-solid fa-angle-right"></i></div>
                </div>
                <div class="carousel-dots">
                    @isset($eventCrsl['numImages'])
                        @for ($i = 0; $i < $eventCrsl['numImages']; $i++)
                            <div class="carousel-dot{{ $i === 0 ? ' active' : '' }}" data-index="{{ $i }}">
                            </div>
                        @endfor
                    @endisset
                </div>
            </div>

            <div class="events-Info">
                <div class="events-text">
                    <h2>EVENT</h2>
                    <h2>EVENT</h2>
                </div>
                <p data-aos="fade-down" data-aos-delay="300" data-aos-duration="2000">Tvent, Ayo Buka potensi
                    dirimu, Temukan kesempatan baru, Raih impian dan Jadilah sang juara!</p>
                <div class="bottom">
                    <h3 data-aos="fade-right" data-aos-delay="400" data-aos-duration="1200">© 2023 CONST - All
                        Rights Reserved.</h3>
                    <button data-aos="zoom-in" data-aos-delay="800" data-aos-duration="2000"
                        onclick="window.location.href='{{ route('home.eventpgs') }}'">Selengkapnya</button>
                </div>
            </div>
        </section>

        <!-- Events section -->

        <section class="grid-card" data-aos="fade-left" data-aos-delay="700" data-aos-duration="2000">

            @isset($events)
                @foreach ($events as $event)
                    <a href="{{ route('home.lombapgs', ['event_id' => $event->id]) }}" class="card-link">
                        <div class="card-container">
                            <div class="card">
                                <div class="fornt">
                                    <img
                                        class="img-card"src="{{ asset('storage/banner/' . $event->id . '/' . $event->banner) }}" />
                                </div>
                                <div class="back"></div>
                                @isset($event->penyelenggara)
                                    <div class="infomation">
                                        <img src="{{ asset('storage/penyelenggara/logo/' . $event->penyelenggara->id . '/' . $event->penyelenggara->logo) }}"
                                            class="profile_image" />
                                        <div class="names">
                                            <div class="project_name">{{ $event->nama_lomba }}</div>
                                            <div class="user_name">{{ $event->penyelenggara->nama_penyelenggara }} </div>
                                        </div>
                                    </div>
                                @endisset
                                <div class="li_co_vi">
                                    <div class="view bg" title="Quota">
                                        <i class="fa-solid fa-user-lock"></i>
                                        <div class="num">{{ $event->add }}</div>
                                    </div>

                                    <div class="coment bg" title="Location">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <div class="num">{{ $event->tempat }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endisset
        </section>
    </section>

    <section id="about" class="about-section">
        <div class="marquee" style="margin-top: 2rem">
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
                <div class="styled-list" data-aos="fade-right" data-aos-delay="300" data-aos-duration="2000">
                    <b>
                        Selamat Datang di Tvent: Menjelajahi Acara Kampus dengan Lebih Mudah!
                    </b>

                    Tvent adalah wadah eksklusif untuk menjelajahi dan mendaftar acara kampus yang penuh semangat.
                    Didesain khusus untuk memudahkan Anda dalam merencanakan dan menghadiri setiap pertemuan,
                    pameran, dan aktivitas kampus.
                    <br><br>
                    <b>Fitur Unggulan Tvent:</b>

                    <ol>
                        <li>Pendaftaran Acara yang Simpel: Daftar dan ikuti acara kampus favorit Anda dengan
                            langkah-langkah pendaftaran yang sederhana dan cepat.</li>

                        <li>Jelajahi Aktivitas Kampus: Temukan berbagai kegiatan kampus yang sesuai dengan minat dan
                            hobi Anda. Jelajahi agenda acara kampus dalam hitungan klik.</li>

                        <li>Komunitas Mahasiswa yang Solid: Sertai komunitas mahasiswa yang solid, berbagi
                            pengalaman, dan dapatkan teman sejawat yang memiliki minat serupa.</li>

                        <li>Berita Kampus Terkini: Tetap terinformasi dengan berita dan informasi terkini seputar
                            kehidupan kampus. Dapatkan wawasan dari kegiatan dan acara terbaru.</li>
                    </ol>

                    Tvent diciptakan untuk memperkaya pengalaman kampus Anda. Jadikan Tvent sebagai teman setia
                    dalam menjalani kehidupan kampus Anda. Bergabunglah sekarang dan raih momen berharga di setiap
                    langkah Anda! Tvent: Temukan Kampus, Temukan Momen!
                </div>
            </div>

            <div class="video-container">
                <video autoplay loop muted>
                    <source src="{{ asset('assets/images/lv_0_20231108111358.mp4') }}" type="video/mp4" />
                </video>
            </div>
        </div>
        <div class="marquee2">
            <h4 class="text">Fakultas Teknik dan Ilmu Komputer - Fakultas Ekonomi Dan Bisnis - FAKULTAS SASTRA
                DAN
                ILMU PENDIDIKAN -&nbsp;</h4>
            <h4 class="text">Fakultas Teknik dan Ilmu Komputer - Fakultas Ekonomi Dan Bisnis - FAKULTAS SASTRA
                DAN
                ILMU PENDIDIKAN -&nbsp;</h4>
            <h4 class="text">Fakultas Teknik dan Ilmu Komputer - Fakultas Ekonomi Dan Bisnis - FAKULTAS SASTRA
                DAN
                ILMU PENDIDIKAN -&nbsp;</h4>
            <h4 class="text">Fakultas Teknik dan Ilmu Komputer - Fakultas Ekonomi Dan Bisnis - FAKULTAS SASTRA
                DAN
                ILMU PENDIDIKAN -&nbsp;</h4>
        </div>
    </section>

    <section class="sponsor">
        <div class="thx">
            <h3>
                Special <br />
                Thanks!
            </h3>
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


    @include('widgets.footer')

    <script src="{{ asset('assets/js/carousel.js') }}"></script>
    <script>
        var eventAuthors = document.getElementById('event-authors');
        var penyelenggaraDiv = document.querySelector('.event-penyelenggara');

        function togglePenyelenggara() {
            penyelenggaraDiv.classList.toggle('showp');

            if (penyelenggaraDiv.classList.contains('showp')) {
                eventAuthors.style.color = 'var(--text-color-rev)';
                eventAuthors.style.backgroundColor = 'var(--text-hov)';
            } else {
                eventAuthors.style.color = '';
                eventAuthors.style.backgroundColor = '';
            }
        }

        eventAuthors.addEventListener('click', togglePenyelenggara);
    </script>

</body>

</html>
