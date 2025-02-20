<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
                //index () digunakan untuk menampilkan daftar data dari database.
                public function index(Request $request)
                {
                    $query = $request->input('query');
                    
                    if ($query) {
                        $tasks = Task::where('name', 'like', "%{$query}%")
                            ->orWhere('description', 'like', "%{$query}%")
                            ->latest()
                            ->get();
            
                        $lists = TaskList::where('name', 'like', "%{$query}%")
                            ->orWhereHas('tasks', function ($q) use ($query) {
                                $q->where('name', 'like', "%{$query}%")
                                    ->orWhere('description', 'like', "%{$query}%");
                            })
                            ->with(['tasks' => function ($q) use ($query) {
                                $q->where('name', 'like', "%{$query}%")
                                    ->orWhere('description', 'like', "%{$query}%");
                            }])
                            ->get();
                    } else {
                        $tasks = Task::latest()->get();
                        $lists = TaskList::with('tasks')->get();
                    }
            
                    $data = [
                        'title' => 'Home', 
                        'lists' => $lists,
                        'tasks' => $tasks,
                        'priorities' => Task::PRIORITIES,
                    ];
                    
                    return view('pages.home', $data);
                }

                public  function profile(){
                    $data = [
                        'title' => 'about',
                    ];

                    return view('pages.profile', $data);
                }

            //store (Request) $request digunakan untuk menyimpan data baru ke dalam database
public function store(Request $request) {
    $request->validate([
        'name' => 'required|max:100',
        'description'=> 'required|max:100',
        'priority' => 'required|in:low,medium,high',
        'list_id' => 'required'
    ]);
            //Menambahkan Database
    Task::create([
        'name' => $request->name,
        'description' => $request->description,
        'priority' => $request->priority,
        'list_id' => $request->list_id
    ]);

            //Mengembalikan ke halaman sebelum'nya
    return redirect()->back();
}
                //complete($id) biasanya digunakan dalam Controller untuk menandai suatu item sebagai selesai atau memperbarui statusnya berdasarkan ID
public function complete($id) {
    Task::findOrFail($id)->update([
        'is_completed' => true
    ]);

            //Mengembalikan ke halaman sebelum'nya
    return redirect()->back();
}
        //digunakan untuk menghapus data berdasarkan ID-nya dari database
public function destroy($id) {
            //berfungsi untuk mencari data dalam tabel tasks berdasarkan ID yang diberikan dan kemudian menghapusnya
    Task::findOrFail($id)->delete();

            //Mengembalikan ke halaman sebelum'nya
    return redirect()->route('home');
}
public function show($id)
{
    $data = [
        'title' => 'Task',
        'lists' => TaskList::all(),
        'task' => Task::findOrFail($id),
    ];

    return view('pages.details', $data);
}
public function changeList(Request $request, Task $task)
{
    $request->validate([
        'list_id' => 'required|exists:task_lists,id',
    ]);

    Task::findOrFail($task->id)->update([
        'list_id' => $request->list_id
    ]);

    return redirect()->back()->with('success', 'List berhasil diperbarui!');
}
public function update(Request $request, Task $task)
{
    $request->validate([
        'list_id' => 'required',
        'name' => 'required|max:100',
        'description' => 'max:255',
        'priority' => 'required|in:low,medium,high'
    ]);

    Task::findOrFail($task->id)->update([
        'list_id' => $request->list_id,
        'name' => $request->name,
        'description' => $request->description,
        'priority' => $request->priority
    ]);

    return redirect()->back()->with('success', 'Task berhasil diperbarui!');
}


}