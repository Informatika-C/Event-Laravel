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
    @include('widgets.navbar')
    <div class="blog__section">
        <div class="blog__title">All</div>
        <div class="blog__list">
            @isset($events)
                @foreach ($events as $event)
                    <a href="{{ route('home.lombapgs', ['event_id' => $event->id]) }}" class="card-link">
                        <div class="blog__item">
                            <div class="blog__image_container">
                                <img class="blog__image"
                                    src="{{ asset('storage/banner/' . $event->id . '/' . $event->banner) }}" />
                                <div class="blog__image_over"></div>
                            </div>
                            <div class="blog__details_container">
                                <span class="blog__details_title">{{ $event->nama_lomba }}</span>
                                <span class="blog__details_text">{{ $event->deskripsi }}</span>
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
                @endforeach
            @endisset
        </div>
    </div>


    @include('widgets.footer')

</body>

</html>
