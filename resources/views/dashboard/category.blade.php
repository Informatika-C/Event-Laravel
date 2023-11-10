@extends('dashboard')

@section('content')
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
                @endif

                @if ($errors->any())
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
                <button title="Delete" class="show-modal" data-modal="deleteModal"><i
                        class="fa-solid fa-trash-arrow-up"></i>
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
                @if (isset($events) && count($events) > 0)
                    @foreach ($events as $event)
                        <tr>
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox_selectAll">
                                    <label for="checkbox_selectAll"></label>
                                </span>
                            </td>
                            <td class="show-tr-modal" data-tr-modal="tr-modal-1" value="{{ $event->id }}">
                                {{ $event->id }}</td>
                            <td>{{ $event->nama_lomba }}</td>
                            <td class="descript">{{ $event->deskripsi }}</td>
                            <td>{{ $event->tempat }}</td>
                            <td>{{ $event->tanggal_pendaftaran }}</td>
                            <td>{{ $event->tanggal_penutupan_pendaftaran }}</td>
                            <td>{{ $event->tanggal_pelaksanaan }}</td>
                            <td>
                                <span class="status confirmed"><i
                                        class="fa-solid fa-user-group">{{ $event->kuota }}</i></span>
                            </td>
                            <td>{{ $event->penyelenggara->nama_penyelenggara }}</td>
                            <td class="action">
                                <button class="editbtn" type="button" value="{{ $event->id }}">
                                    <i class="fa-solid fa-pen-clip"></i>
                                </button>
                                <button class="deletebtn" type="button" value="{{ $event->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                    @endforeach
                @else
                    <td style="text-align: center; width:100%">
                        <h1><i class="fa-solid fa-exclamation"></i> Tidak ada data Events yang tersedia.</h1>
                    </td>
                @endif
                </tr>
            </tbody>
        </table>

        @if (isset($events) && count($events) > 0)
            @foreach ($events as $event)
                <div id="tr-modal-1" class="tr-modal">
                    <div class="tr-modal-content">
                        <div class="tr-det">
                            <h2>{{ $event->nama_lomba }}</h2>
                            <strong><i class="fa-solid fa-hashtag"></i>{{ $event->id }}</strong>
                        </div>
                        <div class="banner-container">
                            <img class="banner" src="{{ asset('assets/images/carrousel1.JPG') }}" alt="banner">
                        </div>
                        <ul>
                            <li><strong>Deskripsi:</strong> <br>{{ $event->deskripsi }}</li>
                            <li class="tr-det inf">
                                <strong><i class="fa-solid fa-map-location-dot"></i>{{ $event->tempat }}</strong>
                                <strong><i class="fa-solid fa-users-line"></i>{{ $event->kuota }}Person</strong>
                                <strong><i
                                        class="fa-solid fa-people-group"></i>{{ $event->penyelenggara->nama_penyelenggara }}</strong>
                            </li>
                            <li><strong>Pendaftaran:</strong>{{ $event->tanggal_pendaftaran }}</li>
                            <li><strong>Penutupan:</strong>{{ $event->tanggal_penutupan_pendaftaran }}</li>
                            <li><strong>Pelaksanaan:</strong>{{ $event->tanggal_pelaksanaan }}</li>
                        </ul>
                    </div>
                </div>
            @endforeach
        @else
            <td style="text-align: center; width:100%">
                <h1><i class="fa-solid fa-exclamation"></i> Tidak ada data Events yang tersedia.</h1>
            </td>
        @endif



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
                    @if (isset($events) && count($events) > 0)
                        <select name="penyelenggara_id" id="penyelenggara_id" class="form-control">
                            <option value="">Pilih Penyelenggara</option>
                            @foreach ($events as $event)
                                <option value="{{ $event->penyelenggara->id }}">
                                    {{ $event->penyelenggara->nama_penyelenggara }}</option>
                            @endforeach
                        </select>
                    @else
                        <p><i class="fa-solid fa-exclamation"></i> Tidak ada data Events yang tersedia.</p>
                    @endif
                    <div class="CC">
                        <button type="submit">Add</button>
                        <button type="button"id="closeButton">Close</button>
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

                    <input type="text" name="id" id="id" value="">

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
                    <select name="penyelenggara_id" id="penyelenggara_id" class="form-control">
                        <option></option>
                    </select>

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
                <form action="/dashboard/events/destroy" method="POST">
                    @csrf
                    @method('DELETE')
                    <label for="del_id">Yakin untuk hapus data?</label>
                    <input type="text" id="del_id" name="del_id">
                    {{-- <input type="text" id="nama_lomba" name="nama_lomba"> --}}
                    <div class="CC">
                        <button type="submit">Confirm</button>
                        <button type="button" id="closeButton">Tutup</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
        function openModal() {
            $('#editModal').fadeIn();
        }

        function openDelModal() {
            $('#deleteModal').fadeIn();
        }

        function closeModal() {
            $('#editModal').fadeOut();
        }

        $(document).ready(function() {
            $(document).on('click', '.deletebtn', function() {
                var id = $(this).val();
                openDelModal();

                $('#del_id').val(id);
                // $('#nama_lomba').val(nama_lomba);
            });

            $(document).on('click', '.editbtn', function() {
                var id = $(this).val();
                openModal();

                $.ajax({
                    type: 'GET',
                    url: '/dashboard/events/edit/' + id,
                    success: function(response) {
                        console.log('Response from server:', response);
                        $('#id').val(response.event.id);
                        $('#nama_lomba').val(response.event.nama_lomba);
                        $('#deskripsi').val(response.event.deskripsi);
                        $('#tempat').val(response.event.tempat);
                        $('#kuota').val(response.event.kuota);
                        $('#tanggal_pendaftaran').val(response.event.tanggal_pendaftaran);
                        $('#tanggal_penutupan_pendaftaran').val(response.event
                            .tanggal_penutupan_pendaftaran);
                        $('#tanggal_pelaksanaan').val(response.event.tanggal_pelaksanaan);
                        $('#penyelenggara_id').val(response.event.penyelenggara_id);
                    }
                });
            });
        });
    </script>
    <script src="{{ asset('assets/js/modal.js') }}"></script>
@endsection
