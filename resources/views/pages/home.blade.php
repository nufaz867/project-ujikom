@extends('layouts.app')

@section('content')
    {{-- Ringkasan Dashboard --}}
    <div class="container mt-2 mb-0">
        <div class="row">
            {{-- Total Daftar Tugas --}}
            <div class="col-md-6">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Total Daftar Tugas</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $lists->count() }}</h5>
                    </div>
                </div>
            </div>
            {{-- Total Tugas --}}
            <div class="col-md-6">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Total Tugas</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $tasks->count() }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Container utama untuk daftar tugas --}}
    <div id="content" class="overflow-y-hidden overflow-x-hidden pt-2">
        {{-- Jika tidak ada daftar tugas, tampilkan pesan dan tombol tambah --}}
        @if ($lists->count() == 0)
            <div class="d-flex flex-column align-items-center">
                <p class="fw-bold text-center">Belum ada tugas yang ditambahkan</p>
                <button type="button" class="btn btn-sm d-flex align-items-center gap-2 btn-outline-success" style="width: fit-content;">
                    <i class="bi bi-plus-square fs-3"></i> Tambah
                </button>
            </div>
        @endif

        {{-- Container daftar tugas dengan scroll horizontal --}}
        <div class="d-flex gap-3 px-3 flex-nowrap overflow-x-scroll overflow-y-hidden" style="height: 80vh;">
            @foreach ($lists as $list)
                <div class="card flex-shrink-0" style="width: 18rem; max-height: 80vh;">
                    {{-- Header daftar tugas --}}
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

                    {{-- Body daftar tugas --}}
                    <div class="card-body d-flex bg-white flex-column gap-2 overflow-x-hidden">
                        @foreach ($tasks as $task)
                            @if ($task->list_id == $list->id)
                                <div class="card">
                                    {{-- Header tugas --}}
                                    <div class="card-header">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex flex-column justify-content-center gap-2">
                                                <a href="{{ route('tasks.show', $task->id) }}" class="fw-bold lh-1 m-0 {{ $task->is_completed ? 'text-decoration-line-through' : '' }}">
                                                    {{ $task->name }}
                                                </a>
                                                <span class="badge text-bg-{{ $task->priorityClass }} badge-pill" style="width: fit-content">
                                                    {{ $task->priority }}
                                                </span>
                                            </div>
                                            {{-- Tombol hapus tugas --}}
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm p-0">
                                                    <i class="bi bi-x-square text-danger fs-5"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    {{-- Deskripsi tugas --}}
                                    <div class="card-body">
                                        <p class="card-text text-truncate">{{ $task->description }}</p>
                                    </div>
                                    {{-- Tombol selesai tugas --}}
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
                        {{-- Tombol tambah tugas --}}
                        <button type="button" class="btn btn-sm btn-outline bg-dark text-white" data-bs-toggle="modal" data-bs-target="#addTaskModal" data-list="{{ $list->id }}">
                            <span class="d-flex align-items-center justify-content-center">
                                <i class="bi bi-plus fs-5"></i>
                                Tambah
                            </span>
                        </button>
                    </div>
                    {{-- Footer daftar tugas --}}
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <p class="card-text">{{ $list->tasks->count() }} Tugas</p>
                    </div>
                </div>
            @endforeach
        </div>     
    </div>
@endsection
