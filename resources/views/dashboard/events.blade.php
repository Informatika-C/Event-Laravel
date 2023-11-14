@extends('dashboard')

@section('content')
    <script>
        function chageBanner(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                // get modal 
                var modal = document.getElementById("upImageModal");
                // get banner container
                var bannerContainer = modal.querySelector("#banner-container");

                reader.onload = function(e) {
                    // create image element and add inside div with id="poster-container" in this modal
                    bannerContainer.style.display = "block";
                    bannerContainer.src = e.target.result;
                    bannerContainer.alt = "Banner Lomba";
                    bannerContainer.style.width = "10em";
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function chagePoster(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                // get modal 
                var modal = document.getElementById("upImageModal");
                // get banner container
                var posterContainer = modal.querySelector("#poster-container");

                reader.onload = function(e) {
                    // create image element and add inside div with id="poster-container" in this modal
                    posterContainer.style.display = "block";
                    posterContainer.src = e.target.result;
                    posterContainer.alt = "Banner Lomba";
                    posterContainer.style.width = "10em";
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <h1>Events</h1>

    <p>Welcome to the Events.</p>
    <div class="card detail">
        <div class="detail-header">
            <div id="alert-container">
                <h2>All</h2>
                @if (session('status'))
                    <h2 class="alert @if (session('status') == 'error') alert-error @else alert-success @endif">
                        {{ session('status') }}
                    </h2>
                @elseif (session('success'))
                    <h2 class="alert alert-success">
                        {{ session('success') }}
                    </h2>
                @elseif(session('error'))
                    <h2 class="alert alert-error">
                        {{ session('error') }}
                    </h2>
                @elseif($errors->any())
                    <div class="alert alert-error ">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="crud">
                <button title="Add" class="show-modal" data-modal="addModal"><i class="fa-solid fa-notes-medical"></i>
                    <h5>Add</h5>
                </button>
                <button title="Delete" class="del-modal" data-modal="deletecheckModal">
                    <i class="fa-solid fa-trash-arrow-up"></i>
                    <h5>Delete</h5>
                </button>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>
                        <span class="custom-checkbox">
                            <input type="checkbox" id="checkbox_selectAll">
                            <label for="checkbox_selectAll"></label>
                        </span>
                    </th>
                    <th>#ID</th>
                    <th>Nama Event</th>
                    <th>Deskripsi</th>
                    <th>Tempat</th>
                    <th>Pendaftaran</th>
                    <th>Penutupan</th>
                    <th>Pelaksanaan</th>
                    <th>Kuota</th>
                    <th>Penyelenggara</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($events) > 0)
                    @foreach ($events as $event)
                        <tr>
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" data-id="{{ $event->id }}">
                                    <label for="checkbox_selectAll"></label>
                                </span>
                            </td>
                            <td class="openInfoModalBtn" data-event-id="{{ $event->id }}">{{ $event->id }}</td>
                            <td>{{ $event->nama_lomba }}</td>
                            <td class="descript">{{ $event->deskripsi }}</td>
                            <td>{{ $event->tempat }}</td>
                            <td>{{ $event->tanggal_pendaftaran }}</td>
                            <td>{{ $event->tanggal_penutupan_pendaftaran }}</td>
                            <td>{{ $event->tanggal_pelaksanaan }}</td>
                            <td>
                                <span class="status confirmed">
                                    <i class="fa-solid fa-user-group">{{ $event->kuota }}</i>
                                </span>
                            </td>
                            @if ($event->penyelenggara_id == null)
                                <td> - </td>
                            @else
                                <td>{{ $event->penyelenggara->nama_penyelenggara }}</td>
                            @endif
                            <td class="action">
                                <button class="editbtn" type="button" value="{{ $event->id }}">
                                    <i class="fa-solid fa-pen-clip"></i>
                                </button>
                                <button class="upImagebtn" type="button" value="{{ $event->id }}">
                                    <i class="fa-solid fa-image"></i>
                                </button>
                                <button class="deletebtn" type="button" del-id="{{ $event->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                <button class="lombabtn"
                                    onclick="window.location='{{ route('dashboard.lomba', ['event_id' => $event->id]) }}'">
                                    <i class="fa-solid fa-circle-chevron-right"></i>
                                </button>

                                {{-- <button class="lombabtn" type="button"
                                    onclick="window.location='{{ url('dashboard/lomba') }}'">
                                    <i class="fa-solid fa-person-running"></i>
                                </button> --}}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <td style="text-align: center; width:100%">
                        <h1><i class="fa-solid fa-exclamation"></i> Tidak ada data Events yang tersedia.</h1>
                    </td>
                @endif
            </tbody>
        </table>

        <div id="infoModal" class="tr-modal">
            <div class="tr-modal-content">
                <div class="tr-det">
                    <h2 id="info_nama_lomba"></h2>
                    <strong><i class="fa-solid fa-hashtag"></i>
                        <span id="id"></span>
                    </strong>
                </div>
                <div class="banner-container">
                    <img class="banner" id="info_banner" src="{{ asset('assets/images/carrousel1.JPG') }}" alt="banner">
                </div>
                <ul>
                    <li><strong>Deskripsi:</strong> <span id="info_deskripsi"></span></li>
                    <li class="tr-det inf">
                        <strong><i class="fa-solid fa-map-location-dot"></i>
                            <span id="info_tempat"></span>
                        </strong>
                        <strong><i class="fa-solid fa-users-line"></i>
                            <span id="info_kuota"></span>
                        </strong>
                        <strong><i class="fa-solid fa-people-group"></i>
                            <span id="info_penyelenggara_id"></span>
                        </strong>
                    </li>
                    <li><strong>Pendaftaran:</strong> <span id="info_tanggal_pendaftaran"></span></li>
                    <li><strong>Penutupan:</strong> <span id="info_tanggal_penutupan_pendaftaran"></span></li>
                    <li><strong>Pelaksanaan:</strong> <span id="info_tanggal_pelaksanaan"></span></li>
                </ul>
            </div>
        </div>

        <div class="modal-overlay"></div>

        <!-- Modal Add -->
        <div id="addModal" class="modal">
            <div class="modal-content">
                <h2>Add</h2>
                <form method="post" action="/dashboard/events">
                    @csrf

                    <label for="name">Nama Lomba:</label>
                    <input type="text" name="nama_lomba" id="name" required>

                    <label for="description">Description:</label>
                    <textarea name="deskripsi" id="description" required></textarea>

                    <label for="location">Location:</label>
                    <input type="text" name="tempat" id="location" required>

                    <label for="quantity">Quantity:</label>
                    <input type="number" name="kuota" id="quantity" required>

                    <label for="registration_date">Registration Date:</label>
                    <input type="date" name="tanggal_pendaftaran" id="registration_date" required>

                    <label for="closing_date">Closing Date:</label>
                    <input type="date" name="tanggal_penutupan_pendaftaran" id="closing_date" required>

                    <label for="event_date">Event Date:</label>
                    <input type="date" name="tanggal_pelaksanaan" id="event_date" required>

                    <label for="penyelenggara_id">Pilih Penyelenggara:</label>
                    <select name="penyelenggara_id" id="penyelenggara_id" class="form-control">
                        <option value="">Pilih Penyelenggara</option>
                        @foreach ($penyelenggaras as $penyelenggara)
                            <option value="{{ $penyelenggara->id }}"
                                {{ old('penyelenggara_id') == $penyelenggara->id || (isset($event) && $event->penyelenggara_id == $penyelenggara->id) ? 'selected' : '' }}>
                                {{ $penyelenggara->nama_penyelenggara }}
                            </option>
                        @endforeach
                    </select>
                    <div class="CC">
                        <button type="submit">Add</button>
                        <button type="button" id="closeButton">Close</button>
                    </div>
                </form>
            </div>
        </div>



        <!-- Modal Edit -->
        <div id="editModal" class="modal" style="display: none;">
            <div class="modal-content">
                <h2>Edit</h2>
                <form id="editForm" action="/dashboard/events/update" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" id="id">

                    <label for="name">Nama Lomba:</label>
                    <input type="text" name="nama_lomba" id="nama_lomba" required>

                    <label for="description">Description:</label>
                    <textarea name="deskripsi" id="deskripsi" required></textarea>

                    <label for="location">Location:</label>
                    <input type="text" name="tempat" id="tempat"required>

                    <label for="quantity">Quantity:</label>
                    <input type="number" name="kuota" id="kuota" required>

                    <label for="registration_date">Registration Date:</label>
                    <input type="date" name="tanggal_pendaftaran" id="tanggal_pendaftaran"required>

                    <label for="closing_date">Closing Date:</label>
                    <input type="date" name="tanggal_penutupan_pendaftaran"
                        id="tanggal_penutupan_pendaftaran"required>

                    <label for="event_date">Event Date:</label>
                    <input type="date" name="tanggal_pelaksanaan" id="tanggal_pelaksanaan"required>

                    <label for="penyelenggara_id">Pilih Penyelenggara:</label>
                    <select id="penyelenggara_id" name="penyelenggara_id">
                        <option value="">Pilih Penyelenggara</option>
                    </select>

                    <div class="CC">
                        <button type="submit">Confirm</button>
                        <button type="button" id="closeButton">Close</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Upload Image Modal Edit -->
        <div id="upImageModal" class="modal" style="display: none;">
            <div class="modal-content">
                <h2>Upload Image</h2>
                <form id="upImageForm" action="/dashboard/events/upload-image" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" id="id">

                    <div style="display: flex; gap: 2em">
                        <div>
                            <label for="banner">Banner:</label>
                            <img id="banner-container" />
                            <input type="file" accept="image/jpeg" name="banner" id="banner"
                                onchange="chageBanner(this);">
                        </div>

                        <div>
                            <label for="poster">Poster:</label>
                            <img id="poster-container" />
                            <input type="file" accept="image/jpeg" name="poster" id="poster"
                                onchange="chagePoster(this);">
                        </div>
                    </div>


                    <div class="CC">
                        <button type="submit">Confirm</button>
                        <button type="button" id="closeButton">Close</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Delete -->
        <div id="deleteModal" class="modal">
            <div class="modal-content">
                <h2>Delete</h2>
                <div class="message">Confirm untuk hapus data!</div>
                <div class="tr-det">
                    <h2 id="del_nama_lomba"></h2>
                    <strong><i class="fa-solid fa-hashtag"></i>
                        <span id="del_id"></span>
                    </strong>
                </div>
                <div class="CC">
                    <button type="submit" id="confirmButton">Confirm</button>
                    <button type="button" id="closeButton">Tutup</button>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="{{ asset('assets/js/modal.js') }}"></script>
    <script src="{{ asset('assets/js/modal/eventModal.js') }}"></script>
@endsection
