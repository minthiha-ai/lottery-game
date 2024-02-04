@extends('threed.layouts.master')

@section('title', 'Add Lottery')

@section('back')
    {{ route('threed.admin.home') }}
@endsection

@section('content')

    <div class="w-full px-5 py-5 md:px-10">

        <div class='my-5 w-full grid gap-2 md:gap-5'>
            @foreach ($data as $item)
                <div class="w-full block p-3 text-dark bg-white hover:bg-zinc-500/25 border border-zinc-500/30 rounded-lg shadow flex">
                    <div class="w-1/5">
                        <div class="border border-4 {{ ($item->status == 'on') ? 'border-green-600' : 'border-red-600' }} rounded-full w-16 h-16 flex justify-center items-center">
                            {{ $item->win_number }}
                        </div>
                    </div>

                    <div class="w-2/5 pl-2">
                        <h3 class="mt-2">{{ Carbon\Carbon::parse($item->date)->format('d-M-Y') }}</h3>
                        <p> {{ $item->name }} </p>
                        <span class="text-red-500">{{ $item->close_number }}</span>
                    </div>

                    <div class="w-2/5">
                        <div class="flex justify-around text-center">
                            <a href="#">&nbsp</a>
                            <a href="#">&nbsp </a>
                            <a href="#">&nbsp </a>
                        </div>
                        <div class="flex justify-around text-center">
                            @if ($item->win_number != "")
                                <a href="{{ route('threed.lottery.management.boucher-report',$item->id) }}"> <i class="fa fa-star text-yellow-400"></i> </a>
                            @else
                                <a href="#"> <i class="fa fa-star text-dark-400"></i> </a>
                            @endif
                            <a href="{{ route('threed.lottery.management.number.report',$item->id) }}"> <i class="fa fa-file-pen"></i> </a>
                            @if ($item->status == 'on')
                                <a href="{{ route('threed.lottery.management.create',$item->id) }}"> <i class="fa fa-plus text-green-600"></i> </a>
                            @else
                                <a href="#"> <i class="fa fa-plus text-red-600"></i> </a>
                            @endif

                        </div>
                        <div class="flex justify-around text-center">
                            <a href="#">&nbsp</a>
                            <a href="#">&nbsp </a>
                            <a href="#">&nbsp </a>
                        </div>
                    </div>


                </div>
            @endforeach
        </div>

    </div>

@endsection

@push('js')

<script>

</script>

@endpush
