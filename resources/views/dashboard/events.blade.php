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
            @if(count($events) > 0)
            @foreach ($events as $event)
            <tr>
                <td>
                    <span class="custom-checkbox">
                        <input type="checkbox" id="checkbox_selectAll">
                        <label for="checkbox_selectAll"></label>
                    </span>
                </td>
                <td class="show-tr-modal" data-tr-modal="tr-modal-1" data-id="{{ $event->id }}">{{ $event->id }}</td>
                <td>{{ $event->nama_lomba }}</td>
                <td class="descript">{{ $event->deskripsi }}</td>
                <td>{{ $event->tempat }}</td>
                <td>{{ $event->tanggal_pendaftaran }}</td>
                <td>{{ $event->tanggal_penutupan_pendaftaran }}</td>
                <td>{{ $event->tanggal_pelaksanaan }}</td>
                <td>
                    <span class="status confirmed"><i class="fa-solid fa-user-group">{{ $event->kuota }}</i></span>
                </td>
                <td>{{ $event->penyelenggara->nama_penyelenggara }}</td>
                <td class="action">
                    <button href="{{ route('dashboard.events.edit', ['id' => $event->id]) }}" title="Edit" class="show-modal" data-modal="editModal" data-event-id="{{ $event->id }}"><i class="fa-solid fa-pen-clip"></i></button>
                    {{-- <button action="{{ route('dashboard.events.destroy', ['id' => $event->id]) }}" title="Delete" class="show-modal" data-modal="deleteModal" data-event-id="{{ $event->id }}"><i class="fa-solid fa-trash"></i></button> --}}
                </td>
                {{-- <td>
                    <a href="{{ route('dashboard.events.edit', $event->id) }}">Edit</a>
                    <form method="POST" action="{{ route('dashboard.events.destroy', $event->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td> --}}
                @endforeach
                @else
                <td style="text-align: center; width:100%">
                    <h1 ><i class="fa-solid fa-exclamation"></i> Tidak ada data Events yang tersedia.</h1>
                </td>
                @endif
            </tr>
        </tbody>
    </table>
    
    <div id="tr-modal-1" class="tr-modal">
        @foreach ($events as $event)
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
                    <strong><i class="fa-solid fa-people-group"></i>{{ $event->penyelenggara->nama_penyelenggara }}</strong>
                </li>
                <li><strong>Pendaftaran:</strong>{{ $event->tanggal_pendaftaran }}</li>
                <li><strong>Penutupan:</strong>{{ $event->tanggal_penutupan_pendaftaran }}</li>
                <li><strong>Pelaksanaan:</strong>{{ $event->tanggal_pelaksanaan }}</li>
            </ul>
        </div>
        @endforeach
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
                @foreach($events as $event)
                    <option value="{{ $event->penyelenggara->id }}">{{ $event->penyelenggara->nama_penyelenggara }}</option>
                @endforeach
            </select>               
            
            
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
            <form action="/dashboard/events/{{ $event->id }}" method="POST">
                @csrf
                @method('PUT')

                <label for="name">Nama Lomba:</label>
                <input type="text" name="nama_lomba" id="name" value="{{ $event->nama_lomba }}" required>
    
                <label for="description">Description:</label>
                <textarea name="deskripsi" id="description" value="{{ $event->deskripsi }}"required></textarea>
    
                <label for="location">Location:</label>
                <input type="text" name="tempat" id="location" value="{{ $event->tempat }}"required>
    
                <label for="quantity">Quantity:</label>
                <input type="number" name="kuota" id="quantity" value="{{ $event->kuota }}"required>
    
                <label for="registration_date">Registration Date:</label>
                <input type="date" name="tanggal_pendaftaran" id="registration_date" value="{{ $event->tanggal_pendaftaran }}"required>
    
                <label for="closing_date">Closing Date:</label>
                <input type="date" name="tanggal_penutupan_pendaftaran" id="closing_date" value="{{ $event->tanggal_penutupan_pendaftaran }}"required>
    
                <label for="event_date">Event Date:</label>
                <input type="date" name="tanggal_pelaksanaan" id="event_date" value="{{ $event->tanggal_pelaksanaan }}"required>
    
                <label for="penyelenggara_id">Pilih Penyelenggara:</label>
                <select name="penyelenggara_id" id="penyelenggara_id" class="form-control">
                    <option value="{{ $event->penyelenggara->id }}">{{ $event->penyelenggara->nama_penyelenggara }}</option>
                    @foreach($events as $event)
                        <option value="{{ $event->penyelenggara->id }}">{{ $event->penyelenggara->nama_penyelenggara }}</option>
                    @endforeach
                </select> 
                
                <div class="CC">
                    <button type="submit">Confirm</button>
                    <button onclick="closeModal('editModal')">Close</button>
                </div>
            </form>
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