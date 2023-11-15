@extends('dashboard')

@section('content')
    <script>
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
    <h1>Lomba</h1>
    <p>Welcome to the Lomba.</p>
    <div class="card detail">
        <div class="detail-header">
            @foreach ($lombas->take(1) as $lomba)
                <p><b>{{ $lomba->event->nama_lomba }}</b> Events</p>
            @endforeach

            @include('widgets.alert')

            <div class="crud">
                <button class="show-modal" data-modal="addModal">
                    <i class="fa-solid fa-notes-medical"></i>
                    <h5>Add</h5>
                </button>
                <button title="Delete" class="del-modal" data-modal="deletecheckModal">
                    <i class="fa-solid fa-trash-arrow-up"></i>
                    <h5>Delete</h5>
                </button>
            </div>
        </div>

        @if (count($lombas) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="checkbox_selectAll">
                                <label for="checkbox_selectAll"></label>
                            </span>
                        </th>
                        <th>No</th>
                        <th>Nama Lomba</th>
                        <th>Keterangan</th>
                        <th>Ruangan Lomba</th>
                        <th>Kuota Lomba</th>
                        <th>Kategori</th>
                        <th>Pelaksanaan Lomba</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lombas as $lomba)
                        <tr>
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" data-id="{{ $lomba->id }}">
                                    <label for="checkbox_selectAll"></label>
                                </span>
                            </td>
                            <td class="openInfoModalBtn" data-lomba-id="{{ $lomba->id }}">{{ $loop->iteration }}</td>
                            <td>{{ $lomba->nama_lomba }}</td>
                            <td class="descript">{{ $lomba->keterangan }}</td>
                            <td>{{ $lomba->ruangan_lomba }}</td>
                            <td>
                                <span class="status confirmed">
                                    <i class="fa-solid fa-user-group">{{ $lomba->kuota_lomba }}</i>
                                </span>
                            </td>
                            <td class="kategory">
                                @foreach ($lomba->kategoris as $kategori)
                                    {{ $kategori->nama_kategori }} |
                                @endforeach
                            </td>
                            <td>{{ \Carbon\Carbon::parse($lomba->pelaksanaan_lomba)->format('l, j F Y') }}</td>
                            <td class="action">
                                <button class="editbtn" type="button" title="Edit" data-lomba-id="{{ $lomba->id }}">
                                    <i class="fa-solid fa-pen-clip"></i>
                                </button>
                                <button class="deletebtn" type="button"title="Delete" data-lomba-id="{{ $lomba->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                <button class="upImagebtn" type="button" value="{{ $lomba->id }}">
                                    <i class="fa-solid fa-image"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h1 class="empty">
                <i class="fa-solid fa-triangle-exclamation"></i>
                Tidak ada data Lomba, Mulai Tambahkan lomba.
            </h1>
        @endif

        <div id="infoModal" class="tr-modal bg-modal">
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

        <!-- Modal Add Lomba -->
        <div id="addModal" class="modal bg-modal">
            <div class="modal-content">
                <h2>Tambah Lomba</h2>
                <form method="POST" action="{{ route('dashboard.lomba.store') }}">
                    @csrf
                    <input type="hidden" name="event_id" value="{{ $event_id }}">

                    <label for="nama_lomba">Nama Lomba:</label>
                    <input type="text" name="nama_lomba" required>

                    <label for="keterangan">Keterangan:</label>
                    <textarea name="keterangan" required></textarea>

                    <label for="ruangan_lomba">Ruangan Lomba:</label>
                    <input type="text" name="ruangan_lomba" required>

                    <label for="kuota_lomba">Kuota Lomba:</label>
                    <input type="number" name="kuota_lomba" required>

                    <label for="pelaksanaan_lomba">Pelaksanaan Lomba:</label>
                    <input type="datetime-local" name="pelaksanaan_lomba" required>

                    <div style="display: none;" id="kategoriListModal"></div>

                    <div class="CC" style="margin-bottom: 1em">
                        <button id="kategoriButton" type="button">Kategori</button>
                    </div>

                    <div class="CC">
                        <button type="submit">Add</button>
                        <button type="button" id="closeButton">Close</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Edit -->
        <div id="editModal" class="modal bg-modal">
            <div class="modal-content">
                <h2>Edit Lomba</h2>
                <form method="POST" action="/dashboard/lomba/update">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" id="id">

                    <label for="nama_lomba">Nama Lomba:</label>
                    <input type="text" name="nama_lomba" id="nama_lomba" required>

                    <label for="keterangan">Keterangan:</label>
                    <textarea name="keterangan" id="keterangan" required></textarea>

                    <label for="ruangan_lomba">Ruangan Lomba:</label>
                    <input type="text" name="ruangan_lomba" id="ruangan_lomba" required>

                    <label for="kuota_lomba">Kuota Lomba:</label>
                    <input type="number" name="kuota_lomba" id="kuota_lomba" required>

                    <label for="pelaksanaan_lomba">Pelaksanaan Lomba:</label>
                    <input type="datetime-local" id="pelaksanaan_lomba" name="pelaksanaan_lomba" required>

                    <div style="display: none;" id="kategoriListModal"></div>

                    <div class="CC" style="margin-bottom: 1em">
                        <button id="editKategoriButton" type="button">Kategori</button>
                    </div>

                    <div class="CC">
                        <button type="submit">Confirm</button>
                        <button type="button" id="closeButton">Close</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Delete -->
        <div id="deleteModal" class="modal bg-modal">
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

        <!-- Upload Image Modal Edit -->
        <div id="upImageModal" class="modal bg-modal">
            <div class="modal-content">
                <h2>Upload Image</h2>
                <form id="upImageForm" action="/dashboard/lomba/upload-image" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" id="id">

                    <div style="display: flex; gap: 2em;">
                        <div>
                            <label for="poster">Poster:</label>
                            <div class="loader"></div>
                            <img id="poster-container" />
                            <input type="file" accept="image/png, image/gif, image/jpeg" name="poster"
                                id="poster" onchange="chagePoster(this);">
                        </div>
                    </div>

                    <div class="CC">
                        <button type="submit">Confirm</button>
                        <button type="button" id="closeButton">Close</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Kategori Modal -->
        <div id="kategoriModal" class="modal bg-modal">
            <div class="modal-content">
                <h2>Kategori Lomba</h2>
                <input type="hidden" name="lomba_id" id="lomba_id">

                <label for="kategori_id">Kategori:</label>
                <div id="kategoriList"></div>

                <input type="text" id="inputListkategori" placeholder="Tambah Kategori">
                <div style="width: 100%; display: flex; justify-content: center;">
                    <button type="button" id="addListKategoriButton" style="margin-bottom: 1em">Add</button>
                </div>

                <div class="CC">
                    <button id="confirmKategoriEdit">Confirm</button>
                    <button type="button" id="closeKategoriButton">Close</button>
                </div>
            </div>

        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="{{ asset('assets/js/modallomba.js') }}"></script>
        <script src="{{ asset('assets/js/modal/lombaModal.js') }}"></script>
    @endsection
