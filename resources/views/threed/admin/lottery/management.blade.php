@extends('threed.layouts.master')

@section('title', 'Lottery Management')

@section('back')
    {{ route('threed.admin.home') }}
@endsection

@section('content')
<div class="w-full px-5 py-5 md:px-10">
    <div class="my-5 w-full grid gap-2 md:gap-5">
        @foreach ($data as $item)
            <div class="w-full block p-3 text-dark bg-white hover:bg-zinc-500/25 border border-zinc-500/30 rounded-lg shadow flex">
                <div class="w-1/5">
                    <div class="border border-4 {{ $item->status == 'on' ? 'border-green-600' : 'border-red-600' }} rounded-full w-16 h-16 flex justify-center items-center">
                        {{ $item->win_number }}
                    </div>
                </div>

                <div class="w-2/5 pl-2">
                    <h3 class="mt-2">{{ $item->date }}</h3>
                    <p>{{ $item->remark }}</p>
                    <span class="text-red-500">{{ $item->close_number }}</span>
                </div>

                <div class="w-2/5">
                    <div class="flex justify-between text-center">
                        @if ($item->win_number)
                            <a href="{{ route('threed.lottery.report', $item->id) }}"><i class="fa fa-star text-yellow-400"></i></a>
                        @else
                            <a href="#"><i class="fa fa-star text-dark"></i></a>
                        @endif
                        <a href="{{ route('threed.lottery.report.number', $item->id) }}"><i class="fa fa-file-pen"></i></a>
                        <a href="{{ route('threed.lottery.report.number.hot', $item->id) }}"><i class="fa fa-plus"></i></a>
                        <a href="#" onclick="editLottery({{ $item->id }})"
                            data-drawer-target="add-lottery"
                            data-drawer-show="add-lottery"
                            data-drawer-placement="bottom"
                            aria-controls="add-lottery">
                            <i class="fa fa-pen"></i>
                        </a>
                    </div>
                    <div class="flex justify-between text-center my-3">
                        <a href="#" onclick="deleteConfirm({{$item->id}})"><i class="fa fa-trash"></i></a>
                        <form id="deleteForm{{ $item->id }}" class="d-none" action="{{ route('threed.lottery.management.delete',$item->id) }}" method="post" enctype="multipart/form-data">
                            @csrf()
                            @method('DELETE')
                        </form>
                        <a href="{{ route('threed.lottery.report.number.lager', $item->id) }}"><i class="fa fa-list"></i></a>
                        <a href="{{ route('threed.lottery.report.number.boucher', $item->id) }}"><i class="fa fa-file-alt"></i></a>
                        <a href="{{ route('threed.lottery.report.user.comm', $item->id) }}"><i class="fa fa-tag"></i></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <button class="fixed z-90 bottom-8 right-8 border-0 w-16 h-16 rounded-full drop-shadow-md bg-blue-700 text-white text-3xl font-bold"
        data-drawer-target="add-lottery" data-drawer-show="add-lottery" data-drawer-placement="bottom" aria-controls="add-lottery">
        <i class="fa-solid fa-plus"></i>
    </button>

    {{-- Add Form --}}
    <div id="add-lottery" class="lg:w-1/2 mx-auto text-center fixed bottom-0 left-0 right-0 z-40 w-full p-4 overflow-y-auto transition-transform bg-white translate-y-full transition-transform rounded-xl" tabindex="-1" aria-labelledby="drawer-bottom-label">
        <h5 id="drawer-bottom-label" class="inline-flex items-center mb-5 text-xl font-semibold text-dark tracking-widest">
            Add Lottery
        </h5>

        <button type="button" data-drawer-hide="add-lottery" aria-controls="add-lottery"
            class="text-gray-400 bg-transparent hover:text-gray-200 rounded-lg text-sm w-8 h-8 absolute top-2.5 right-2.5 inline-flex items-center justify-center">
            <i class="fa-solid fa-close fa-xl"></i>
        </button>

        <div class="my-3 w-full grid gap-10">
            <form action="{{ route('threed.lottery.management.store') }}" method="POST" id="lottery-form" autocomplete="off">
                @csrf
                @method('POST')

                <div class="relative mb-6">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                        <i class="fa-solid fa-calendar text-dark"></i>
                    </div>
                    <input type="date" name="date" id="date" class="bg-white border border-gray-300 text-dark text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" value="{{ date('Y-m-d') }}">
                </div>

                {{-- <div class="relative mb-6">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                        <i class="fa-solid fa-file text-dark"></i>
                    </div>
                    <select name="name" id="name" class="bg-white border border-gray-300 text-dark text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                        <option value="am">am</option>
                        <option value="pm">pm</option>
                    </select>
                </div> --}}

                <div class="relative mb-6">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                        <i class="fa-solid fa-file text-dark"></i>
                    </div>
                    <input type="text" name="remark" id="remark" class="bg-white border border-gray-300 text-dark text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Remark">
                </div>

                <div class="relative mb-6">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                        <i class="fa-solid fa-file text-dark"></i>
                    </div>
                    <input type="number" name="win_number" id="win_number" class="bg-white border border-gray-300 text-dark text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="ပေါက်ဂဏန်း">
                </div>

                <div class="relative mb-6">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                        <i class="fa-solid fa-file text-dark"></i>
                    </div>
                    <input type="number" name="close_number" id="close_number" class="bg-white border border-gray-300 text-dark text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="ထိပ်ပိတ်ဂဏန်း">
                </div>

                <div class="w-full flex justify-between my-10">
                    <p class="text-dark">Status</p>

                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="status" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    </label>
                </div>
                <div class="w-full flex justify-between">
                    <button type="submit" id="formId" class="text-dark bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-700 font-medium rounded-lg text-sm block w-full px-5 py-2.5 text-center">
                        Add Lottery
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    function editLottery(id) {

        fetch(`/threed/admin/lottery-management/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('date').value = data.date;
            // document.getElementById('name').value = data.name;
            document.getElementById('remark').value = data.remark;
            document.getElementById('win_number').value = data.win_number;
            document.getElementById('close_number').value = data.close_number;
            const statusRadio = document.querySelector('input[name="status"]');
            statusRadio.checked = data.status === 'on';
            const form = document.getElementById('lottery-form');
            form.action = `/threed/admin/lottery-management/${id}`;
            form.method = 'POST';
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = '_method';
            hiddenInput.value = 'PUT';
            form.appendChild(hiddenInput);
            document.getElementById('drawer-bottom-label').innerText = 'Edit Lottery';
            document.getElementById('formId').innerText = 'Update Lottery';
        })
        .catch(error => console.error('Error fetching lottery data:', error));

    }
    const deleteConfirm=(id)=>{
        Swal.fire({html:'<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon><div class="mt-4 pt-2 fs-15 mx-5"><h4>Are you Sure ?</h4><p class="text-muted mx-4 mb-0">Are you Sure You want to Delete this ?</p></div></div>',showCancelButton:!0,confirmButtonClass:"btn btn-primary w-xs me-2 mb-1",confirmButtonText:"Yes, Delete It!",cancelButtonClass:"btn btn-danger w-xs mb-1",buttonsStyling:!1,showCloseButton:!0})
            .then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        `Data is deleted successfully `,
                        'success'
                    )
                    setTimeout(function(){
                        $('#deleteForm'+id).submit();
                    },1000)
                }
            })
    };
</script>
@endpush
