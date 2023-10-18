<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Todo as TodoModel;
use Livewire\Attributes\Rule;
use Masmerise\Toaster\Toaster;
use Illuminate\Support\Facades\Validator;


class Todo extends Component
{
    public $filterType="all";
    public $filterColor ='';
    public $isEdit=null;
    public $name="";
    public $editTodo="";

    public function toggoleComplete($id){
        try{
            $todo = TodoModel::where('id', $id)->first();
            $message = $todo->completed ? "Todo incompleted successfully." : "Todo completed successfully.";
            $todo->completed =  !$todo->completed;
            $todo->save();
            Toaster::success($message);
        } catch (\Exception $e){
            Toaster::error('Something wrong try again!');
        }
    }

    public function completeAll(){
        try{
            $todos = TodoModel::where('completed', 0)->get();
            foreach ($todos as $todo) {
                $todo->completed = 1;
                $todo->save();
            }
            Toaster::success('All todo completed successfully.');
        } catch (\Exception $e){
            Toaster::error('Something wrong try again!');
        }
    }

    public function inCompleteAll(){
        try{
            $todos = TodoModel::where('completed', 1)->get();
            foreach ($todos as $todo) {
                $todo->completed = 0;
                $todo->save();
            }
            Toaster::success('All todo incompleted successfully.');
        } catch (\Exception $e){
            Toaster::error('Something wrong try again!');
        }
    }

    public function clearAllCompleted(){
        try{
            $todos = TodoModel::where('completed', 1)->get();
            foreach ($todos as $todo) {
                $todo->delete();
            }
            Toaster::success('Clear all completed todo successfully.');
        } catch (\Exception $e){
            Toaster::error('Something wrong try again!');
        }
    }

    public function toggleColorFilter($value){
        if($this->filterColor == $value){
            $this->filterColor = '';
        }else{
            $this->filterColor = $value;
        }
    }

    public function updateColor($id, $color){
        try{
            $todo = TodoModel::where('id', $id)->first();
            $todo->color = $color;
            $todo->save();
            Toaster::success('Todo color updated successfully.');
        } catch (\Exception $e){
            Toaster::error('Something wrong try again!');
        }
    }

    public function delete($id){
        try{
            TodoModel::where('id', $id)->delete();
            Toaster::success('Todo deleted successfully.');
        } catch (\Exception $e){
            Toaster::error('Something wrong try again!');
        }
    }

    public function save(){
        $validated = Validator::make(
            // Data to validate...
            ['name' => $this->name],

            // Validation rules to apply...
            ['name' => 'required|min:3'],

            // Custom validation messages...
            [
                'name.required' => 'Todo name is required!',
                'name.min' => 'Todo name must be grater then 3 characters!',
            ],
         )->validate();

        try{
            $this->resetValidation();
            TodoModel::create($validated);
            $this->reset('name');
            Toaster::success('Todo added successfully.');
        } catch (\Exception $e){
            Toaster::error('Something wrong try again!');
        }
    }

    public function setEditng($id, $name){
        if($this->isEdit && $this->isEdit == $id){
            $this->updateTodo();
            $this->reset('isEdit', 'editTodo');
        }else{
            $this->isEdit = $id;
            $this->editTodo = $name;
        }

    }

    public function updateTodo(){
        $validated = Validator::make(
            // Data to validate...
            ['editTodo' => $this->editTodo],

            // Validation rules to apply...
            ['editTodo' => 'required|min:3'],

            // Custom validation messages...
            [
                'editTodo.required' => 'Todo name is required!',
                'editTodo.min' => 'Todo name must be grater then 3 characters!',
            ],
         )->validate();

        try{
            $this->resetValidation();
            $todo = TodoModel::where('id', $this->isEdit)->first();

            if($todo->name != $this->editTodo){
                $todo->completed = 0;
            }
            $todo->name = $this->editTodo;
            $todo->save();

            $this->reset('editTodo', 'isEdit');
            Toaster::success('Todo updated successfully.');
        } catch (\Exception $e){
            Toaster::error('Something wrong try again!');
        }
    }

    public function render()
    {
        $todos = TodoModel::latest()->get();
        $this->filterType == "all" ?: $todos = $todos->where('completed', $this->filterType);
        $this->filterColor === '' ?: $todos = $todos->where('color', $this->filterColor);
        $count = $todos->where('completed', '0')->count();
        return view('livewire.todo', [
            'todos' => $todos,
            'count' => $count
        ]);
    }
}
