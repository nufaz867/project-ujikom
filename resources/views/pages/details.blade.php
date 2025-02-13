@extends('layouts.app')

@section('content')
    <div id="content" class="container pb-3">
        <!-- Tombol kembali ke halaman utama -->
        <div class="d-flex align-items-center justify-content-center">
            <a href="{{ route('home') }}" class="btn btn-sm fw-bold fs-4">
                <i class="bi bi-arrow-left-short"></i>
                Kembali
            </a>
        </div>

        <!-- Menampilkan notifikasi sukses jika ada -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-8">
                <!-- Kartu utama untuk menampilkan detail tugas -->
                <div class="card" style="height: 80vh; max-height: 80vh;">
                    <div class="card-header d-flex align-items-center justify-content-between overflow-hidden">
                        <h3 class="fw-bold fs-4 text-truncate" style="max-width: 80%;">
                            {{ $task->name }}
                            <span class="fs-6 fw-medium"> 
                                di {{ $task->list->name }}
                            </span>
                        </h3>
                        <!-- Tombol edit tugas -->
                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#editTaskModal">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <p>
                            {{ $task->description }}
                        </p>
                    </div>
                    <div class="card-footer">
                        <!-- Form untuk menghapus tugas -->
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <!-- Kartu untuk menampilkan detail tambahan tugas -->
                <div class="card" style="height: 80vh;">
                    <div class="card-header d-flex align-items-center justify-content-between overflow-hidden">
                        <h3 class="fw-bold fs-4 text-truncate mb-0" style="width: 80%">Details</h3>
                    </div>
                    <div class="card-body d-flex flex-column gap-2">
                        <!-- Form untuk memindahkan tugas ke daftar lain -->
                        <form action="{{ route('tasks.changeList', $task->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select class="form-select" name="list_id" onchange="this.form.submit()">
                                @foreach ($lists as $list)
                                    <option value="{{ $list->id }}" {{ $list->id == $task->list_id ? 'selected' : '' }}>
                                        {{ $list->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                        <!-- Menampilkan prioritas tugas dengan badge warna -->
                        <h6 class="fs-6">
                            Prioritas:
                            <span class="badge text-bg-{{ $task->priorityClass }} badge-pill" style="width: fit-content">
                                {{ $task->priority }}
                            </span>
                        </h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk mengedit tugas -->
        <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="modal-content">
                    @method('PUT')
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editTaskModalLabel">Edit Task</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Input tersembunyi untuk menyimpan ID daftar tugas -->
                        <input type="text" value="{{ $task->list_id }}" name="list_id" hidden>
                        <!-- Input untuk mengedit nama tugas -->
                       
