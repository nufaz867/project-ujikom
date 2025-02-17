{{-- Modal untuk menambahkan daftar tugas (List) --}}
<div class="modal fade" id="addListModal" tabindex="-1" aria-labelledby="addListModalLabel" aria-hidden="true">
    <div class="modal-dialog">
       <div class="modal-content">
         {{-- Form untuk menyimpan daftar tugas --}}
         <form action="{{ route('lists.store') }}" method="POST" class="modal-content">
            @method('POST')
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addListModalLabel">Tambah List</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- Input nama daftar tugas --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Masukkan nama list">
                </div>
            </div>
            <div class="modal-footer">
                {{-- Tombol batal untuk menutup modal --}}
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                {{-- Tombol submit untuk menambahkan daftar tugas --}}
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
       </div>
    </div>
</div>

{{-- Modal untuk menambahkan tugas (Task) ke dalam daftar --}}
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {{-- Form untuk menyimpan tugas --}}
            <form action="{{ route('tasks.store') }}" method="POST" class="modal-content">
                @method('POST')
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addTaskModalLabel">Tambah Task</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Input tersembunyi untuk menyimpan ID daftar tugas yang dipilih --}}
                    <input type="text" id="taskListId" name="list_id" hidden>

                    {{-- Input nama tugas --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Masukkan nama tugas">
                    </div>

                    {{-- Input deskripsi tugas --}}
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                            placeholder="Masukkan deskripsi">
                    </div>

                    {{-- Dropdown untuk memilih prioritas tugas --}}
                    <div class="mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <select name="priority" class="form-select" aria-label="priority" id="priority">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- Tombol batal untuk menutup modal --}}
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    {{-- Tombol submit untuk menambahkan tugas ke daftar --}}
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
