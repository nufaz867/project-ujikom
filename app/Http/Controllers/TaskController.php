<?php

namespace App\Http\Controllers;
  
// untuk memamnggil class yang di perlukan
use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // funtion index untuk ngarahin file utamanya
    public function index()  {
        $data = [
            'title' => 'Home',
            'test'=> 'List',
            'lists' => TaskList::all(),
            'tasks' => Task::orderBy('created_at', 'desc')->get(),
            'priorities' => Task::PRIORITIES
        ];

    // mengarahkan ke volder view
        return view('pages.home', $data);
    }
    // funtion store untuk nyimpan data ke databases (required adalah data yang di butuhkan)
    public function store(Request $request)   {
        $request->validate([
            'name' => 'required|max:100',
            'deskripsi' => 'max:255',
            'priority' => 'required|in:low,medium,high',
            'list_id' => 'required'
        ]);
    // task create untuk memasukan data/tabel ke database  
        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'priority' => $request->priority,
            'list_id' => $request->list_id
        ]);

      // mengembalikan ke halaman sebelumnya
        return redirect()->back();
    }

    // merubah status dari yang belum selesai jadi sudah selesai
    public function complete($id) {
        Task::findOrFail($id)->update([
            'is_completed' => true
        ]);

        return redirect()->back();
    }

    // untuk menghapus data yang ada di database 
    public function destroy($id) {
        Task::findOrFail($id)->delete();

        return redirect()->back();
    }

    public function show($id) {
        $task =Task::findOrfail($id);

        $data = [
            'title' => 'Details',
            'task' => $task,
        ];

    // manggil tampilan
    return view('pages.details', $data);  

         
    }
}
// Kode ini adalah struktur dasar untuk menampilkan halaman dalam Laravel
