<html lang="en">

<head>
    <title>Tvent - Event List</title>
</head>

<link rel="stylesheet" href="{{ asset('assets/css/modal.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/eventpgs.css') }}">
@include('widgets.head')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets/js/daftarLombaModal.js') }}"></script>

<body>
    <div class="navonHome">
        @include('widgets.navbar')
    </div>
    </div>
    <div class="sidebar close">
        {{-- <div class="logo-details">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
            <i class="bx bxl-c-plus-plus"></i>
            <span class="logo_name">Tvents</span>
        </div> --}}
        <ul class="nav-links">
            <li>
                <a href="#">
                    <i class="fa-solid fa-arrow-rotate-right"></i>
                    <span class="link_name">Filter</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Aply</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class="fa-solid fa-sheet-plastic"></i>
                        <span class="link_name">Kategori</span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Kategori</a></li>
                    <li><a href="#">Sport</a></li>
                    <li><a href="#">Hack</a></li>
                    <li><a href="#">Design</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class="fa-solid fa-calendar-day"></i>
                        <span class="link_name">Waktu</span>
                    </a>
                    <i class="fa-solid fa-angle-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Waktu</a></li>
                    <li><a href="#">Hari Ini</a></li>
                    <li><a href="#">Besok</a></li>
                    <li><a href="#">Minggu Ini</a></li>
                    <li><a href="#">Minggu Depan</a></li>
                    <li><a href="#">Bulan Ini</a></li>
                    <li><a href="#">Bulan Depan</a></li>
                    <li><a href="#">Tahun Depan</a></li>
                </ul>
            </li>
            {{-- <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="image/profile.jpg" alt="profileImg" />
                    </div>
                    <div class="name-job">
                        <div class="profile_name">Prem Shahi</div>
                        <div class="job">Web Desginer</div>
                    </div>
                    <i class="bx bx-log-out"></i>
                </div>
            </li> --}}
        </ul>
    </div>
    <section class="home-section">
        <div class="home-content">
            <i class="fa-solid fa-bars bx-menu"></i>
            <span class="head-text">Drop Down Sidebar</span>
        </div>

        <div class="content-card">
            <img class="bg-image"src="{{ asset('assets/images/widhtimg2.jpg') }}" />
            {!! Breadcrumbs::render() !!}
            <div class="blog__title">All</div>
            <ul class="cards">
                @isset($events)
                    @foreach ($events as $event)
                        <li class="cards__item">
                            <a href="{{ route('home.lombapgs', ['event_id' => $event->id]) }}" class="linked">
                                <div class="card">
                                    <div class="card__image"
                                        style="background-image: url('{{ asset('storage/banner/' . $event->id . '/' . $event->banner) }}');">
                                    </div>
                                    <div class="card__content">
                                        <div class="card__title">{{ $event->nama_lomba }}</div>
                                        <p class="card__text">{{ $event->deskripsi }}</p>
                                        <div class="blog__author_container">
                                            <div class="blog__author_avatar">
                                                <img src="{{ asset('storage/poster/' . $event->id . '/' . $event->poster) }}"
                                                    class="blog__author_avatar_image">
                                                <div class="blog__author_avatar_over"></div>
                                            </div>
                                            <div class="blog__author_details">
                                                <span
                                                    class="blog__author_name">{{ $event->penyelenggara->nama_penyelenggara }}</span>
                                                <span class="blog__author_date">
                                                    <i class="fa-solid fa-location-dot"></i>{{ $event->tempat }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                @endisset
            </ul>
        </div>
        @include('widgets.footer')
    </section>
    <script>
        let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement;
                arrowParent.classList.toggle("showMenu");
            });
        }
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        console.log(sidebarBtn);
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
    </script>



</body>

</html>
