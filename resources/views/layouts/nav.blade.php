<div class="bg-neutral-100 p-5">
    <div class="flex justify-between items-center">
        <div>
            <a href="@yield('back')" class="text-dark">
                <i class="fa-solid fa-arrow-left fa-lg md:fa-xl"></i>
            </a>
        </div>
        <div>
            <h3 class="text-xl md:text-2xl font-bold tracking-wider text-dark ">
                @yield('title', 'Dashboard')
            </h3>
        </div>

        <div>
            <form class="dropdown-item" method="post" action="{{ route('logout') }}" style="cursor: pointer">
                @csrf
                <button type="submit" class="inline-block text-center text-dark hover:text-slate-300">
                    <i class="fa-solid fa-right-from-bracket fa-lg md:fa-xl"></i>
                </button>
            </form>
        </div>
    </div>
</div>
