<div>
    <h1>WELCOME INTO THE TASK {{ $test }} {{ $search }} </h1>

    <div class="container">
        <div class="row">
            <div class="header d-flex justify-content-around border-secondary pb-2 border-bottom opacity-50">
                <div class="left-box">
                    <form class="d-flex">
                        <span class="fw-bold fs-3 me-2 mb-2">TaskMgr</span>
                        <input wire:model="search" class="form-control me-2" type="search" placeholder="Search ..."
                            aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
                <div class="right-box">
                    <button type="button" class="btn btn-success" wire:click="newtTask" data-bs-toggle="modal"
                        data-bs-target="#newTask">
                        <i class="fa-solid fa-bars-progress"></i> New Task
                    </button>
                    <button class="btn btn-primary"> <i class="fa-solid fa-calendar"></i> Calendar</button>
                </div>
            </div>
        </div>

        
     

    <div class="row">
        @if (session()->has('message'))
            <div class="alert alert-success text-center"> {{ session('message') }} </div>
        @endif
    </div>

    <div class="row">
        <div class="col-12">
            @if ($tasks->count() > 0)
                @foreach ($tasks as $task)
                    <div class="task d-flex justify-content-around pb-2 shadow-lg p-3 mb-2 mt-1 bg-body rounded"  >
                        <div class="task-left">
                            <span class="title d-block"> {{ $task->title }} </span>
                            <span class="start text-secondary"> <i class="fa-solid fa-calendar"></i> start
                                {{ $task->startdates }} </span>
                            <span class="end text-secondary"> <i class="fa-solid fa-calendar"></i> end
                                {{ $task->endates }} </span>
                            <span class="description d-block"> {{ $task->description }} </span>
                        </div>
                        <div class="task-right mt-2">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                    style="width: {{ $task->progress }}%" aria-valuenow=" {{ $task->progress }} "
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <h6 class="">&#128161; {{ $task->progress }}% </h6>
                            <div class="btn-action">
                                <button wire:click="editTask({{ $task->id }})"
                                    style="background: none; border:none;"
                                    class="text-primary text-decoration-none text-decoration-underline">Edit</button>
                                <button wire:click="viewTask({{ $task->id }})"
                                style="background: none; border:none;"
                                    class="text-primary text-decoration-none text-decoration-underline">Close</button>
                                <button wire:click="deleteTask({{ $task->id }})"
                                    style="background: none; border:none;"
                                    class="text-danger text-decoration-none text-decoration-underline">Delete</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center">
                    <i class="fa-solid fa-bars-progress pt-4"></i>
                    <h2 class="py-1">You Have no tasks scheduled for today</h2>
                    <span>Please Click on the button below to create or save your tasks</span>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-success my-2 d-block" data-bs-toggle="modal"
                            data-bs-target="#newTask">
                            <i class="fa-solid fa-bars-progress"></i> New Task
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>






@if ($taskAdd == 'active')
    <div class="modals  d-flex justify-content-center  p-2 ">
        <div class="col-8 w-50 mx-5 mt-5 position-absolute top-0 end-0 shadow-lg p-3 mb-5 bg-body rounded">

            <div class="modalHead d-flex justify-content-between border-bottom border-dark">
                <div class="title">Add Task</div>
                <div class="close">
                    <i wire:click="closeAdd" class="fa-solid fa-xmark fs-2"></i>
                </div>
            </div>

            <form action="" wire:submit.prevent="storeTaskData">

                <div class="mb-3">
                    <label for="title" class="form-label">Task Title</label>
                    <input wire:model="title" type="text" id="title" class="form-control"
                        id="exampleFormControlInput1" placeholder="title">
                    @error('title')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="startdates" class="form-label">Start Task</label>
                    <input wire:model="startdates" type="date" id="start" class="form-control"
                        id="exampleFormControlInput1" placeholder="">
                    @error('startdates')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="endates" class="form-label">End Task </label>
                    <input wire:model="endates" type="date" id="title" class="form-control"
                        id="exampleFormControlInput1" placeholder="title">
                    @error('endates')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                    <textarea wire:model="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    @error('description')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="btnAction border-top border-secondary pt-2 d-flex justify-content-end">
                    <button wire:click="closeAdd" class="btn btn-secondary">Close</button>
                    <button type="submit" class="btn btn-primary mx-2">Add Task</button>
                </div>

            </form>
        </div>
    </div>
@endif


@if ($taskEdit == 'active')
    <div class="modals  d-flex justify-content-center  p-2 ">
        <div class="col-8 w-50 mx-5 mt-5 position-absolute top-0 end-0 shadow-lg p-3 mb-5 bg-body rounded">

            <div class="modalHead d-flex justify-content-between border-bottom border-dark">
                <div class="title">Edit Task</div>
                <div class="close">
                    <i wire:click="closeEdit" class="fa-solid fa-xmark fs-2"></i>
                </div>
            </div>

            <form action="" wire:submit.prevent="editTaskData">

                <div class="mb-3">
                    <label for="title" class="form-label">Task Title</label>
                    <input wire:model="title" type="text" id="title" class="form-control"
                        id="exampleFormControlInput1" placeholder="title">
                    @error('title')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="startdates" class="form-label">Start Task</label>
                    <input wire:model="startdates" type="date" id="start" class="form-control"
                        id="exampleFormControlInput1" placeholder="">
                    @error('startdates')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="endates" class="form-label">End Task </label>
                    <input wire:model="endates" type="date" id="title" class="form-control"
                        id="exampleFormControlInput1" placeholder="title">
                    @error('endates')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                    <textarea wire:model="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    @error('description')
                        <span class="text-danger"> {{ $message }} </span>
                    @enderror
                </div>

                <div class="btnAction border-top border-secondary pt-2 d-flex justify-content-end">
                    <button wire:click="closeEdit" class="btn btn-secondary">Close</button>
                    <button type="submit" class="btn btn-primary mx-2">Edit Task</button>
                </div>

            </form>
        </div>
    </div>
@endif


@if ($taskDelete == 'active')
    <div class="modals  d-flex justify-content-center  p-2 ">
        <div class="col-8 w-50 mx-5 mt-5 position-absolute top-0 end-0 shadow-lg p-3 mb-5 bg-body rounded">

            <div class="modalHead d-flex justify-content-between border-bottom border-dark">
                <div class="title">Delete Task</div>
                <div class="close">
                    <i wire:click="closeDelete" class="fa-solid fa-xmark fs-2"></i>
                </div>
            </div>

            <form action="" wire:submit.prevent="editTaskData">

                <div class="my-3">
                    <h5 clas> Are you sure ? You want to delete this Task ! </h5>
                </div>

                <div class="btnAction border-top border-secondary pt-2 d-flex justify-content-end">
                    <button wire:click="closeDelete" class="btn btn-secondary">Close</button>
                    <button type="submit" wire:click="deleteTaskData()" class="btn btn-danger mx-2">Delete
                        Task</button>
                </div>

            </form>
        </div>
    </div>
@endif

@if ($taskView == 'active')
    <div class="modals  d-flex justify-content-center  p-2 ">
        <div class="col-8 w-50 mx-5 mt-5 position-absolute top-0 end-0 shadow-lg p-3 mb-5 bg-body rounded">

            <div class="modalHead d-flex justify-content-between border-bottom border-dark">
                <div class="title">Delete Task</div>
                <div class="close">
                    <i wire:click="closeView" class="fa-solid fa-xmark fs-2"></i>
                </div>
            </div>

            <form action="">

                <div class="my-3">
                    <h5 clas> Are you sure ? Your Task is completed ! </h5>
                </div>

                <div class="btnAction border-top border-secondary pt-2 d-flex justify-content-end">
                    <button wire:click="closeView" class="btn btn-secondary">Close</button>
                    <button type="submit" wire:click="fullTask()" class="btn btn-danger mx-2">Finish
                        Task</button>
                </div>

            </form>
        </div>
    </div>
@endif



</div>
