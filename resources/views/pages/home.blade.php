{{-- Menggunakan layout utama --}}
@extends('layouts.app')

@section('content')
    {{-- Container utama yang menangani tampilan daftar tugas --}}
    <div id="content" class="overflow-y-hidden overflow-x-hidden">

        
        {{-- Jika tidak ada daftar tugas, tampilkan pesan dan tombol tambah --}}
        @if ($lists->count() == 0)
            <div class="d-flex flex-column align-items-center">
                <p class="fw-bold text-center">Belum ada tugas yang ditambahkan</p>
                <button type="button" class="btn btn-sm d-flex align-items-center gap-2 btn-outline-success"
                    style="width: fit-content;">
                    <i class="bi bi-plus-square fs-3"></i> Tambah
                </button>
            </div>
        @endif


        {{-- Container untuk menampilkan daftar tugas dengan scroll horizontal --}}
        <div class="d-flex gap-3 px-3 flex-nowrap overflow-x-scroll overflow-y-hidden" style="height: 100vh;">
            <table class="table text-white">

            {{-- Looping daftar tugas --}}
            @foreach ($lists as $list)  
                <div class="card flex-shrink-0" style="width: 18rem; max-height: 100vh;">
                    
                    {{-- Header kartu berisi nama daftar dan tombol hapus --}}
                    <div class="card-header d-flex align-items-center justify-content-between bg-success">
                        <h4 class="card-title">{{ $list->name }}</h4>
                        <form action="{{ route('lists.destroy', $list->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm p-0">
                                <i class="bi bi-trash fs-5 text-danger"></i>
                            </button>
                        </form>
                    </div>

                    {{-- Body kartu berisi daftar tugas --}}
                    <div class="card-body d-flex bg-primary flex-column gap-2 overflow-x-hidden">
                        @foreach ($tasks as $task)
                            @if ($task->list_id == $list->id)
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex flex-column justify-content-center gap-2">
                                                {{-- Link menuju detail tugas, dengan garis coret jika selesai --}}
                                                <a href="{{ route('tasks.show', $task->id) }}"
                                                     class="fw-bold lh-1 m-0 {{ $task->is_completed ? 'text-decoration-line-through' : '' }}">
                                                    {{ $task->name }}
                                                </a>
                                                {{-- Badge prioritas tugas --}}
                                                <span class="badge text-bg-{{ $task->priorityClass }} badge-pill"
                                                    style="width: fit-content">
                                                    {{ $task->priority }}
                                                </span>
                                            </div>

                                            {{-- Tombol hapus tugas --}}
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm p-0">
                                                    <i class="bi bi-x-square text-danger fs-5"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    {{-- Body kartu berisi deskripsi tugas --}}
                                    <div class="card-body">
                                        <p class="card-text text-truncate">
                                            {{ $task->description }}
                                        </p>
                                    </div>

                                    {{-- Jika tugas belum selesai, tampilkan tombol "Selesai" --}}
                                    @if (!$task->is_completed)
                                        <div class="card-footer">
                                            <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-primary w-100">
                                                    <span class="d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-check-circle fs-5"></i>
                                                        Selesai
                                                    </span>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                        
                        {{-- Tombol tambah tugas ke dalam daftar --}}
                        <button type="button" class="btn btn-sm btn-outline bg-dark text-white" data-bs-toggle="modal"
                            data-bs-target="#addTaskModal" data-list="{{ $list->id }}">
                            <span class="d-flex align-items-center justify-content-center">
                                <i class="bi bi-plus fs-5"></i>
                                Tambah
                            </span>
                        </button>
                    </div>

                    {{-- Footer kartu berisi jumlah tugas dalam daftar --}}
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <p class="card-text">{{ $list->tasks->count() }} Tugas</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Script JavaScript untuk pencarian tugas secara real-time --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search-input'); // Ambil elemen input pencarian
            
            searchInput.addEventListener('input', function () {
                const query = searchInput.value.trim(); // Ambil nilai input dan hapus spasi berlebih
    
                if (query.length >= 3) { // Mulai pencarian hanya jika minimal 3 karakter diketik
                    fetch(`/search?query=${query}`)
                        .then(response => response.json()) // Mengubah response ke JSON
                        .then(data => {
                            renderSearchResults(data); // Render hasil pencarian
                        })
                        .catch(error => console.error('Error fetching search results:', error));
                }
            });

            // Fungsi untuk menampilkan hasil pencarian
            function renderSearchResults(data) {
                const container = document.getElementById('content'); // Ambil container daftar tugas
                container.innerHTML = ''; // Kosongkan isi sebelumnya
    
                // Jika tidak ada hasil ditemukan
                if (data.task_lists.length === 0 && data.tasks.length === 0) {
                    container.innerHTML = '<p class="fw-bold text-center">Tidak ada hasil ditemukan</p>';
                    return;
                }
    
                let contentHTML = '<div class="d-flex gap-3 px-3 flex-nowrap overflow-x-scroll overflow-y-hidden" style="height: 80vh;">';
    
                // Loop daftar tugas yang sesuai dengan pencarian
                data.task_lists.forEach(list => {
                    contentHTML += `
                        <div class="card flex-shrink-0 bg-info" style="width: 18rem; max-height: 80vh;">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h4 class="card-title">${list.name}</h4>
                            </div>
                        <div class="card-body d-flex flex-column gap-2 overflow-x-hidden">`
                    
                    // Filter tugas berdasarkan daftar yang sesuai
                    const filteredTasks = data.tasks.filter(task => task.list_id === list.id);
                    filteredTasks.forEach(task => {
                        contentHTML += `
                            <div class="card">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <div class="d-flex flex-column justify-content-center gap-2">
                                        <a href="/tasks/${task.id}" class="fw-bold lh-1 m-0 ${task.is_completed ? 'text-decoration-line-through' : ''}">
                                            ${task.name}
                                        </a>
                                        <span class="badge text-bg-${task.priority}" style="width: fit-content">${task.priority}</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="card-text text-truncate">${task.description ?? ''}</p>
                                </div>
                            </div>
                        `;
                    });

                    contentHTML += '</div></div>'; // Tutup div list
                });

                contentHTML += '</div>'; // Tutup container utama
                container.innerHTML = contentHTML;
            }
        });
    </script>

@endsection
