@extends('dashboard')

@section('content')
    <script>
        function changeLogo(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                // get modal 
                var modal = document.getElementById("upImageModal");
                // get banner container
                var posterContainer = modal.querySelector("#logo-container");

                reader.onload = function(e) {
                    // create image element and add inside div with id="poster-container" in this modal
                    posterContainer.style.display = "block";
                    posterContainer.src = e.target.result;
                    posterContainer.alt = "Logo";
                    posterContainer.style.width = "10em";
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <h1>Penyelenggara</h1>
    <p>Welcome to the Penyelenggara.</p>
    <div class="card detail">
        <div class="detail-header">
            <h2>All</h2>

            @include('widgets.alert')

            <div class="crud">
                <button title="Add" class="show-modal" data-modal="addModal"><i class="fa-solid fa-notes-medical"></i>
                    <h5>Add</h5>
                </button>
                <button title="Delete" class="show-modal" data-modal="deleteModal"><i class="fa-solid fa-trash-arrow-up"></i>
                    <h5>Delete</h5>
                </button>
            </div>
        </div>

        @if (count($penyelenggaras) > 0)
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
                        <th>Nama Penyelenggara</th>
                        <th>Nomor Telepon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penyelenggaras as $penyelenggara)
                        <tr>
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox_selectAll">
                                    <label for="checkbox_selectAll"></label>
                                </span>
                            </td>
                            <td class="openInfoModalBtn" data-penyelenggara-id="{{ $penyelenggara->id }}">
                                {{ $penyelenggara->id }}
                            </td>
                            <td>{{ $penyelenggara->nama_penyelenggara }}</td>
                            <td>{{ $penyelenggara->no_telp }}</td>
                            <td class="action">
                                <button class="editbtn" type="button" value="{{ $penyelenggara->id }}">
                                    <i class="fa-solid fa-pen-clip"></i>
                                </button>
                                <button class="deletebtn" type="button" del-id="{{ $penyelenggara->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                <button class="upImagebtn" type="button" data-penyelenggara="{{ $penyelenggara }}">
                                    <i class="fa-solid fa-image"></i>
                                </button>
                            </td>
                    @endforeach
                    </tr>
                </tbody>
            </table>
        @else
            <h1 class="empty">
                <i class="fa-solid fa-triangle-exclamation"></i>
                Tidak ada data Penyelenggara, Mulai Tambahkan data.
            </h1>
        @endif

        <div id="infoModal" class="tr-modal bg-modal">
            <div class="tr-modal-content">
                <div class="tr-det">
                    <h2 id="info_nama_penyelenggara"></h2>
                </div>
                <ul>
                    <li class="tr-det inf">
                        <strong><i class="fa-solid fa-hashtag"></i>
                            <span id="info_id"></span>
                        </strong>
                        <strong><i class="fa-solid fa-users-line"></i>
                            <span id="info_no_telp"></span>
                        </strong>
                    </li>
                </ul>
            </div>
        </div>

        <div class="modal-overlay"></div>

        <!-- Modal Add -->
        <div id="addModal" class="modal bg-modal">
            <div class="modal-content">
                <h2>Add</h2>
                <form method="post" action="/dashboard/penyelenggara">
                    @csrf
                    <label for="nama_penyelenggara">Nama Penyelenggara:</label>
                    <input type="text" name="nama_penyelenggara" required>

                    <label for="no_telp">Nomor Telepon:</label>
                    <input type="text" name="no_telp" required>

                    <div class="CC">
                        <button type="submit">Confirm</button>
                        <button type="button" id="closeButton">Close</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Edit -->
        <div id="editModal" class="modal bg-modal">
            <div class="modal-content">
                <h2>Edit</h2>
                <form id="editForm" action="/dashboard/penyelenggara/update" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" id="id">

                    <label for="nama_penyelenggara">Nama Penyelenggara:</label>
                    <input type="text" name="nama_penyelenggara" id="nama_penyelenggara" required>

                    <label for="no_telp">Nomor Telepon:</label>
                    <input type="number" name="no_telp" id="no_telp" required>

                    <div class="CC">
                        <button type="submit">Simpan</button>
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
                    <h2 id="del_nama_penyelenggara"></h2>
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
                <form id="upImageForm" action="/dashboard/penyelenggara/upload-image" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" id="id">

                    <div style="display: flex; gap: 2em;">
                        <div>
                            <label for="poster">Logo:</label>
                            <div class="loader"></div>
                            <img id="logo-container" />
                            <input type="file" accept="image/png, image/gif, image/jpeg" name="logo"
                                id="logo" onchange="changeLogo(this);">
                        </div>
                    </div>

                    <div class="CC">
                        <button type="submit">Confirm</button>
                        <button type="button" id="closeButton">Close</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="{{ asset('assets/js/modal.js') }}"></script>
    <script src="{{ asset('assets/js/modal/penyelenggaraModal.js') }}"></script>
@endsection
