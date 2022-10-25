<?php

namespace App\Http\Controllers;
use Session;
use App\Models\Comment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    /**
     * Create a comment for tasks and leads
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
        ]);

        $modelsMapping = [
            'task' => 'App\Models\Task',
            'lead' => 'App\Models\Lead',
            'project' => 'App\Models\Project',
        ];

        if (!array_key_exists($request->type, $modelsMapping)) {
            Session::flash('flash_message_warning', __('Could not create comment, type not found'));
            throw new \Exception("Could not create comment with type " . $request->type);
            return redirect()->back();
        }

        if ($request->has('image')) {
            $fileUpload = $request->file('image');
            $filename = $fileUpload->getClientOriginalName();
            $name = "assets/files/uploaded-$filename";
            Storage::disk('oss')->put($name, file_get_contents($fileUpload));
            $fileUrl = "https://cdn.erakomp.co.id/$name";
        }else{
            $fileUrl = NULL;
        }

        $model = $modelsMapping[$request->type];
        $source = $model::whereExternalId($request->external_id)->first();
        $source->comments()->create(
            [
                'image' => $fileUrl,
                'description' => clean($request->description),
                'user_id' => auth()->user()->id
            ]
        );


        Session::flash('flash_message', __('Comment successfully added')); //Snippet in Master.blade.php
        \LogActivity::addToLog('just commented');

        return redirect()->back();
    }
    public function logActivity()
    {
        $logs = \LogActivity::logActivityLists();
        return view('logActivity', compact('logs'));
    }
    public function destroy(Comment $comment, Request $request)
    {
        /**$deleteTasks = $request->delete_tasks ? true : false;
        if ($project->tasks && $deleteTasks) {
            $project->tasks()->delete();
        } else {
            $project->tasks()->update(['project_id' => null]);
        }

        $project->delete();**/
        $comment->delete();

        Session()->flash('flash_message', __('Comment deleted'));
        return redirect()->back();
    }
    public function edit($id)
    {

        $comment = Comment::with(['task'])
            ->where('id', $id)
            ->first();


        return view('comments.edit', compact('comment'));
    }
    public function update($comment, Request $request)
    {
        $getExt = Comment::join('tasks', 'comments.source_id', '=', 'tasks.id')->where('source_type', '=', 'App\Models\Task')->select('tasks.external_id')->get();
        // dd($product);
        //return $product;
        $request->validate([
            'description' => 'sometimes',

        ]);
        Comment::findOrFail($comment)->update($request->all());

        return redirect()->back();
    }
}
