@extends('dashboard')

@section('content')
<h1>Events</h1>
<p>Welcome to the Events.</p>
<div class="card detail">
    <div class="detail-header">
        <h2>All</h2>
        <div class="crud">
            <button title="Add" class="show-modal" data-modal="addModal"><i class="fa-solid fa-notes-medical"></i> <h5>Add</h5></button>
            <button title="Delete" class="show-modal" data-modal="deleteModal"><i class="fa-solid fa-trash-arrow-up"></i> <h5>Delete</h5></button>
        </div>
    </div>
    {{-- <table>
        <thead>
            <tr>
                <th>
                    <span class="custom-checkbox">
                        <input type="checkbox" id="checkbox_selectAll">
                        <label for="checkbox_selectAll"></label>
                    </span>
                </th>
                <th>Code #</th>
                <th>Banner</th>
                <th>Nama Lomba</th>
                <th>Deskripsi</th>
                <th>Tempat</th>
                <th>Kuota</th>
                <th>Pendaftaran</th>
                <th>Penutupan</th>
                <th>Pelaksanaan</th>
                <th>Penyelenggara</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
            <tr>
                <td>
                    <span class="custom-checkbox">
                        <input type="checkbox" id="checkbox_selectAll">
                        <label for="checkbox_selectAll"></label>
                    </span>
                </td>
                <td class="show-tr-modal" data-tr-modal="tr-modal-1">#PW-0001</td>
                <td><img class="banner" src="{{ asset('assets/images/card.png') }}" alt="banner"></td>
                <td>{{ $event->nama_lomba }}</td>
                <td class="descript">{{ $event->deskripsi }}</td>
                <td>{{ $event->tempat }}</td>
                <td>
                    <span class="status confirmed"><i class="fa-solid fa-user-group">{{ $event->kuota }}</i></span>
                </td>
                <td>{{ $event->tanggal_pendaftaran }}</td>
                <td>{{ $event->tanggal_penutupan_pendaftaran }}</td>
                <td>{{ $event->tanggal_pelaksanaan }}</td>
                <td>{{ $event->penyelenggara_id }}</td>
                <td class="action">
                    <button href="#" title="Edit" class="show-modal" data-modal="editModal"><i class="fa-solid fa-pen-clip"></i></button>
                    <button href="#" title="Delete" class="show-modal" data-modal="deleteModal"><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>
            @empty
            <p>Tidak ada data event yang ditemukan.</p>
            @endforelse
        </tbody>
    </table> --}}
    <table>
        <thead>
            <tr>
                <th>Nama Lomba</th>
                <th>Deskripsi</th>
                <th>Tempat</th>
                <th>Tanggal Pendaftaran</th>
                <th>Tanggal Penutupan Pendaftaran</th>
                <th>Tanggal Pelaksanaan</th>
                <th>Kuota</th>
                <th>Penyelenggara</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>{{ $event->nama_lomba }}</td>
                <td>{{ $event->deskripsi }}</td>
                <td>{{ $event->tempat }}</td>
                <td>{{ $event->tanggal_pendaftaran }}</td>
                <td>{{ $event->tanggal_penutupan_pendaftaran }}</td>
                <td>{{ $event->tanggal_pelaksanaan }}</td>
                <td>{{ $event->kuota }}</td>
                <td>{{ $event->penyelenggara_id }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div id="tr-modal-1" class="tr-modal">
        <!-- Isi tr-modal -->
        <div class="tr-modal-content">
            <div class="tr-det">
                <h2>Campus Expo</h2>
                <strong> #PW-0001</strong>
            </div>
            <div class="banner-container">
                <img class="banner" src="{{ asset('assets/images/carrousel1.JPG') }}" alt="banner">
            </div>
            <ul>
                <li><strong>Deskripsi:</strong> <br>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugiat fuga optio iste doloribus architecto suscipit repellendus ea. Nihil, modi! Sint?</li>
                <li class="tr-det inf">
                    <strong><i class="fa-solid fa-map-location-dot"></i>Universitas Teknokrat Indonesia</strong>
                    {{-- <strong><i class="fa-solid fa-users-line"></i>30</strong> --}}
                    <strong><i class="fa-solid fa-people-group"></i>HIMA FTIK</strong>
                </li>
                <li><strong>Pendaftaran:</strong>11 Apr 2023</li>
                <li><strong>Penutupan:</strong>20 Aug 2023</li>
                <li><strong>Pelaksanaan:</strong>1 Sep 2023</li>
            </ul>
        </div>
    </div>
    
    
    <div class="modal-overlay"></div>

<!-- Modal Add -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <h2>Add</h2>
        <form method="POST" action="{{ route('events.store')}}">
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

            <label for="organizer">Organizer:</label>
            <input type="text" name="penyelenggara_id" id="organizer" required>

            <div class="CC">
                <button type="submit">Add</button>
                <button onclick="closeModal('addModal')">Close</button>
            </div>
        </form>
    </div>
</div>


    <!-- Modal Edit -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <h2>Edit</h2>
            <form method="post">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>

                <label for="description">Description:</label>
                <textarea name="description" id="description" required></textarea>

                <label for="location">Location:</label>
                <input type="text" name="location" id="location" required>

                <label for="registration_date">Registration Date:</label>
                <input type="text" name="registration_date" id="registration_date" required>

                <label for="closing_date">Closing Date:</label>
                <input type="text" name="closing_date" id="closing_date" required>

                <label for="event_date">Event Date:</label>
                <input type="text" name="event_date" id="event_date" required>

                <label for="organizer">Organizer:</label>
                <input type="text" name="organizer" id="organizer" required>

            </form>
            <div class="CC">
                <button type="submit">Confirm</button>
                <button onclick="closeModal('editModal')">Close</button>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h2>Delete</h2>
            <p>Informasi untuk tombol Delete.</p>
            <button onclick="closeModal('deleteModal')">Tutup</button>
        </div>
    </div>

</div>
<script src="{{ asset('assets/js/modal.js') }}"></script>
@endsection