<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', "GigCafe's Restaurant") }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/White Logo.png') }}">
    

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script>
        var assetBaseUrl = "{{ asset('') }}";
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('js/backend.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/a94b89670e.js"></script>
    <link href="{{ asset('css/backend.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!--Modal css-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    <!--NEW-->



    @yield('links')

    <style>
    .floating-icons {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
    }
    .floating-icons .icon {
        display: block;
        width: 50px;
        height: 50px;
        background: #fff;
        color: #fff;
        text-align: center;
        line-height: 50px;
        border-radius: 50%;
        margin-bottom: 10px;
        /* Add more styles as needed */
    }
</style>
<style>
    .dropdown-menu {
        width: 150px;
        margin: 0 auto;
    }

    .dropdown-menu button {
        width: 100%;
    }

    .header-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .custom-left-margin {
        margin-left: 6px;
    }
</style>


</head>
<body id="@yield('bodyID')">
<header>
    <nav data-theme="@yield('navTheme')" class="home-nav @yield('navTheme')">
        <a href="/" class="logo-wrapper">
            <img class="logo" src="@yield('logoFileName')" alt="logo">
            <h3 class="logo-name">{{ config('app.name') }}</h3>
        </a>

        <!-- Navigation links -->
        <ul class="nav-links">
            @if (Auth::check() && auth()->user()->role == 'admin')
              <!--li class="relative w-full md:w-auto">
                <a href="{{ route('dashboard') }}" class="nav-link flex flex-row items-center w-full px-3 py-1.5 mt-1 text-base font-medium text-left bg-white rounded-lg  focus:outline-none focus:shadow-outline">
                    Dashb<i class="fa fa-th-large ml-2" aria-hidden="true"></i>ard
                </a>
            </li-->
            <li class="relative w-full md:w-auto" @click.away="open = false" class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex flex-row items-center w-full px-3 py-1.5 mt-1 text-base font-medium text-left bg-white rounded-lg  focus:outline-none focus:shadow-outline">
                    <a><!--i class="fa fa-arrow-down" aria-hidden="true"-->Restaurant</a>
                    <!--svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg-->
                </button>
                <div style="z-index:4" x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-1 origin-top-right rounded-md shadow-lg">
                     <div class="px-2 py-2 bg-white rounded-md shadow" >
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('kitchenOrder')" :active="request()->routeIs('kitchenOrder')">
                                <i class="fa fa-shopping-cart mr-2" aria-hidden="true"></i> {{ __('Orders') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('menu')" :active="request()->routeIs('menu')">
                                <i class="fa fa-book mr-2" aria-hidden="true"></i> {{ __('Menu') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('discount')" :active="request()->routeIs('discount')">
                                <i class="fa fa-ticket mr-2" aria-hidden="true"></i> {{ __('Discount') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('gallery')" :active="request()->routeIs('gallery')">
                                <i class="fa fa-picture-o mr-2" aria-hidden="true"></i> {{ __('Gallery') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>            
            </li>
            <li class="relative w-full md:w-auto" @click.away="open = false" class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex flex-row items-center w-full px-3 py-1.5 mt-1 text-base font-medium text-left bg-white rounded-lg  focus:outline-none focus:shadow-outline">
                    <a><!--i class="fa fa-arrow-down" aria-hidden="true"-->Catering</a>
                    <!--svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg-->
                </button>
                <div style="z-index:4" x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-1 origin-top-right rounded-md shadow-lg">
                    <div class="px-2 py-2 bg-white rounded-md shadow">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.index')">
                                <i class="fa fa-calendar mr-2" aria-hidden="true"></i> {{ __('Reserves') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('packages.index')" :active="request()->routeIs('packages.index')">
                                <i class="fa fa-th-large mr-2" aria-hidden="true"></i> {{ __('Packages') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('services.index')" :active="request()->routeIs('services.index')">
                                <i class="fas fa-concierge-bell mr-2" aria-hidden="true"></i> {{ __('Services') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('cateringoptions.index')" :active="request()->routeIs('cateringoptions.index')">
                                <i class="fas fa-tasks mr-2" aria-hidden="true"></i> {{ __('Options') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('inventory.index')" :active="request()->routeIs('inventory.index')">
                                <i class="fas fa-box mr-2" aria-hidden="true"></i> {{ __('Supplies') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('reviews.index')" :active="request()->routeIs('reviews.index')">
                                <i class="fas fa-star" aria-hidden="true"></i> {{ __('Reviews') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>       
            </li>
           <li class="relative w-full md:w-auto" @click.away="open = false" class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex flex-row items-center w-full px-3 py-1.5 mt-1 text-base font-medium text-left bg-white rounded-lg  focus:outline-none focus:shadow-outline">
                    <a><!--i class="fa fa-arrow-down" aria-hidden="true"-->Account</a>
                    <!--svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg-->
                </button>
                <div style="z-index:4" x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-1 origin-top-right rounded-md shadow-lg">
                     <div class="px-2 py-2 bg-white rounded-md shadow" >
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('accountCreation')" :active="request()->routeIs('accountCreation')">
                                <i class="fa fa-user mr-2" aria-hidden="true"></i> {{ __('Create') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('manageAccount')" :active="request()->routeIs('manageAccount')">
                                <i class="fas fa-tasks mr-2" aria-hidden="true"></i> {{ __('Manage') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            </li>
            @endif

            @if (Auth::check() && auth()->user()->role == 'kitchenStaff')
                <li class="relative w-full md:w-auto" @click.away="open = false" class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-lg font- text-left bg-white rounded-lg  focus:outline-none focus:shadow-outline">
                     <a><!--i class="fa fa-arrow-down" aria-hidden="true"--></i>Restaurant</a>
                     <!--svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                         <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                     </svg-->
                 </button>
                 <!-- Unveil the menu -->
                 <div style="z-index:4" x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                      <div class="px-2 py-2 bg-white rounded-md shadow" > <!-- Set the background color here -->
                         <!-- A feast of options -->
                         <form method="POST" action="{{ route('logout') }}">
                             @csrf
                             <x-responsive-nav-link :href="route('kitchenOrder')" :active="request()->routeIs('kitchenOrder')">
                                 <i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ __('Orders') }}
                             </x-responsive-nav-link>
                             <x-responsive-nav-link :href="route('menu')" :active="request()->routeIs('menu')">
                                 <i class="fa fa-book" aria-hidden="true"></i> {{ __('Menu') }}
                             </x-responsive-nav-link>
                             <x-responsive-nav-link :href="route('gallery')" :active="request()->routeIs('gallery')">
                                 <i class="fa fa-picture-o" aria-hidden="true"></i> {{ __('Gallery') }}
                             </x-responsive-nav-link>
                             <!--<x-responsive-nav-link :href="route('discount')" :active="request()->routeIs('discount')">
                                 <i class="fa fa-ticket" aria-hidden="true"></i> {{ __('Discount') }}
                             </x-responsive-nav-link>-->
                         </form>
                     </div>
                 </div>            
                </li>
                <li class="relative w-full md:w-auto" @click.away="open = false" class="relative" x-data="{ open: false }">
                   <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-lg font- text-left bg-white rounded-lg  focus:outline-none focus:shadow-outline">
                     <a><!--i class="fa fa-arrow-down" aria-hidden="true"--></i>Catering</a>
                     <!--svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                         <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                     </svg-->
                 </button>
                 <!-- Unveil the menu -->
                 <div style="z-index:4" x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                      <div class="px-2 py-2 bg-white rounded-md shadow" > <!-- Set the background color here -->
                         <!-- A feast of options -->
                         <form method="POST" action="{{ route('logout') }}">
                             @csrf
                             <x-responsive-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.index')">
                                 <i class="fa fa-calendar" aria-hidden="true"></i> {{ __('Reserves') }}
                             </x-responsive-nav-link>
                             <x-responsive-nav-link :href="route('packages.index')" :active="request()->routeIs('packages.index')">
                                 <i class="fa fa-th-large" aria-hidden="true"></i> {{ __('Packages') }}
                             </x-responsive-nav-link>
                             <x-responsive-nav-link :href="route('services.index')" :active="request()->routeIs('services.index')">
                                 <i class="fa fa-th-large" aria-hidden="true"></i> {{ __('Services') }}
                             </x-responsive-nav-link>
                             <x-responsive-nav-link :href="route('cateringoptions.index')" :active="request()->routeIs('cateringoptions.index')">
                                <i class="fas fa-tasks" aria-hidden="true"></i> {{ __('Options') }}
                             </x-responsive-nav-link>
                             <x-responsive-nav-link :href="route('inventory.index')" :active="request()->routeIs('inventory.index')">
                                <i class="fas fa-box" aria-hidden="true"></i> {{ __('Supplies') }}
                             </x-responsive-nav-link>
                             <x-responsive-nav-link :href="route('reviews.index')" :active="request()->routeIs('reviews.index')">
                                <i class="fas fa-star" aria-hidden="true"></i> {{ __('Reviews') }}
                             </x-responsive-nav-link>
                         </form>
                     </div>
                 </div>           
                </li>
            @endif
            </ul>
            
            
              @if (Auth::check())
                  
     <div x-data="{ openDropdown: false, openAccount: false, openRestaurant: false }" class="relative inline-block text-left">
    <!-- Trigger Button for Username Dropdown -->
    <button @click="openDropdown = !openDropdown" class="inline-flex items-center px-2 py-1 border border-transparent text-xs bg-white leading-4 font-medium rounded-md text-gray-500 focus:outline-none transition ease-in-out duration-150">
        <div>{{ Auth::user()->username }}</div>
        <div class="ms-1">
            <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 10a4 4 0 100-8 4 4 0 000 8zm0 2a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6z"/>
            </svg>
        </div>
    </button>

    <!-- Main Dropdown Content -->
    <div x-show="openDropdown" x-cloak class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
        <div class="py-1">

                    <!-- Profile Option -->
                    <x-dropdown-link :href="route('profile.edit')" class="flex items-center text-gray-700 hover:bg-gray-100 rounded-md p-1 text-xs no-text-shadow">
                        <i class="fa fa-user me-1" aria-hidden="true"></i>
                        <span>{{ __('Profile') }}</span>
                    </x-dropdown-link>
        
                    <!-- Dashboard Option -->
                    <x-dropdown-link :href="route('dashboard')" class="flex items-center text-gray-700 hover:bg-gray-100 rounded-md p-1 text-xs no-text-shadow">
                        <i class="fa fa-tachometer me-1" aria-hidden="true"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </x-dropdown-link>
            
                    <!-- Restaurant Section with Nested Dropdown -->
                    <div x-data="{ openRestaurant: false }" class="relative">
                        <x-dropdown-link @click="openRestaurant = !openRestaurant" class="flex items-center justify-between text-gray-700 hover:bg-gray-100 rounded-md p-1 text-xs no-text-shadow">
                            <div class="flex items-center">
                                <i class="fas fa-store me-1" aria-hidden="true"></i>
                                <span>{{ __('Restaurant') }}</span>
                            </div>
                            <svg :class="{'rotate-180': openRestaurant, 'rotate-0': !openRestaurant}" class="inline w-4 h-4 transition-transform duration-200 transform" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </x-dropdown-link>
                    
                        <!-- Nested Dropdown Content for Restaurant -->
                        <div x-show="openRestaurant" x-cloak x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="ml-4 mt-1 origin-top-right rounded-md shadow-lg bg-white">
                            <x-dropdown-link :href="route('kitchenOrder')" class="flex items-center text-gray-700 hover:bg-gray-100 rounded-md p-1 text-xs no-text-shadow">
                                <i class="fa fa-shopping-cart me-1" aria-hidden="true"></i>
                                <span>{{ __('Orders') }}</span>
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('menu')" class="flex items-center text-gray-700 hover:bg-gray-100 rounded-md p-1 text-xs no-text-shadow">
                                <i class="fa fa-book me-1" aria-hidden="true"></i>
                                <span>{{ __('Menu') }}</span>
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('discount')" class="flex items-center text-gray-700 hover:bg-gray-100 rounded-md p-1 text-xs no-text-shadow">
                                <i class="fa fa-ticket me-1" aria-hidden="true"></i>
                                <span>{{ __('Discount') }}</span>
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('gallery')" class="flex items-center text-gray-700 hover:bg-gray-100 rounded-md p-1 text-xs no-text-shadow">
                                <i class="fa fa-picture-o me-1" aria-hidden="true"></i>
                                <span>{{ __('Gallery') }}</span>
                            </x-dropdown-link>
                        </div>
                    </div>

                    
                    <!-- Catering Section with Nested Dropdown -->
                    <div x-data="{ openCatering: false }" class="relative">
                        <x-dropdown-link @click="openCatering = !openCatering" class="flex items-center justify-between text-gray-700 hover:bg-gray-100 rounded-md p-1 text-xs no-text-shadow">
                            <div class="flex items-center">
                                <i class="fas fa-utensils me-1" aria-hidden="true"></i>
                                <span>{{ __('Catering') }}</span>
                            </div>
                            <svg :class="{'rotate-180': openCatering, 'rotate-0': !openCatering}" class="inline w-4 h-4 transition-transform duration-200 transform" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </x-dropdown-link>
                    
                        <!-- Nested Dropdown Content for Catering -->
                        <div x-show="openCatering" x-cloak x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="ml-4 mt-1 origin-top-right rounded-md shadow-lg bg-white">
                            <x-dropdown-link :href="route('reservations.index')" class="flex items-center text-gray-700 hover:bg-gray-100 rounded-md p-1 text-xs no-text-shadow">
                                <i class="fa fa-calendar me-1" aria-hidden="true"></i>
                                <span>{{ __('Reservation') }}</span>
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('packages.index')" class="flex items-center text-gray-700 hover:bg-gray-100 rounded-md p-1 text-xs no-text-shadow">
                                <i class="fa fa-th-large me-1" aria-hidden="true"></i>
                                <span>{{ __('Packages') }}</span>
                            </x-dropdown-link>
                             <x-dropdown-link :href="route('services.index')" class="flex items-center text-gray-700 hover:bg-gray-100 rounded-md p-1 text-xs no-text-shadow">
                                <i class="fas fa-concierge-bell me-1" aria-hidden="true"></i>
                                <span>{{ __('Services') }}</span>
                            </x-dropdown-link>
                             <x-dropdown-link :href="route('cateringoptions.index')" class="flex items-center text-gray-700 hover:bg-gray-100 rounded-md p-1 text-xs no-text-shadow">
                                <i class="fas fa-tasks me-1" aria-hidden="true"></i>
                                <span>{{ __('Options') }}</span>
                            </x-dropdown-link>
                             <x-dropdown-link :href="route('inventory.index')" class="flex items-center text-gray-700 hover:bg-gray-100 rounded-md p-1 text-xs no-text-shadow">
                                <i class="fas fa-box me-1" aria-hidden="true"></i>
                                <span>{{ __('Supplies') }}</span>
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('reviews.index')" class="flex items-center text-gray-700 hover:bg-gray-100 rounded-md p-1 text-xs no-text-shadow">
                                <i class="fas fa-star" aria-hidden="true"></i>
                                <span>{{ __('Reviews') }}</span>
                            </x-dropdown-link>
                        </div>
                    </div>

          
                    <!-- Account Section with Nested Dropdown -->
                    <div x-data="{ openAccount: false }" class="relative">
                        <x-dropdown-link @click="openAccount = !openAccount" class="flex items-center justify-between text-gray-700 hover:bg-gray-100 rounded-md p-1 text-xs no-text-shadow">
                            <div class="flex items-center">
                                <i class="fa fa-cogs me-1" aria-hidden="true"></i>
                                <span>{{ __('Account') }}</span>
                            </div>
                            <svg :class="{'rotate-180': openAccount, 'rotate-0': !openAccount}" class="inline w-4 h-4 transition-transform duration-200 transform" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </x-dropdown-link>
                    
                        <!-- Nested Dropdown Content for Account -->
                        <div x-show="openAccount" x-cloak x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="ml-4 mt-1 origin-top-right rounded-md shadow-lg bg-white">
                            <x-dropdown-link :href="route('accountCreation')" class="flex items-center text-gray-700 hover:bg-gray-100 rounded-md p-1 text-xs no-text-shadow">
                                <i class="fa fa-user-plus me-1" aria-hidden="true"></i>
                                <span>{{ __('Create Account') }}</span>
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('manageAccount')" class="flex items-center text-gray-700 hover:bg-gray-100 rounded-md p-1 text-xs no-text-shadow">
                                <i class="fas fa-tasks me-1" aria-hidden="true"></i>
                                <span>{{ __('Manage Account') }}</span>
                            </x-dropdown-link>
                        </div>
                    </div>


            <!-- Logout Option -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')"
                    class="flex items-center text-gray-700 hover:bg-gray-100 rounded-md p-2 text-xs no-text-shadow"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fa fa-sign-out me-1" aria-hidden="true"></i>
                    <span>{{ __('Logout') }}</span>
                </x-dropdown-link>
            </form>
        </div>
    </div>

    <!-- Styles to support dropdowns -->
    <style>
        [x-cloak] { display: none; }
        .rotate-0 { transform: rotate(0deg); }
        .rotate-180 { transform: rotate(180deg); }
    </style>
</div>

             
              
    <!--div class="floating-icons" style="position: fixed; top: 80px; right: 30px;">
    @include('partials.notification', ['unreadNotifications' => auth()->user()->unreadNotifications])
    </div-->
                   
                    
            @endif
            <div class="ml-5 text-xs">
                @include('partials.notification', ['unreadNotifications' => auth()->user()->unreadNotifications])
            </div>

               <!-- Mobile menu button -->
        <!--div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div-->
    </nav>
</header>


    <!-- Chatify container -->


    <!-- Floating icons -->
    <div class="floating-icons">
        <!-- Add your floating icons here -->
        <a href="/chatify" class="icon">
            <!-- Icon image or font-awesome icon -->
            <img src="{{ asset('images/Black Logo.png') }}" alt="Chat Icon">
        </a>
    </div>

    <div class="sidebar">
    <header class="header-container">
        <img id="logo" src="@yield('logoFileName')" alt="logo">
    </header>
        <ul>
        <!-- ADMIN -->
        @if (auth()->user()->role == 'admin')
        <li>
            <div class="header-container">
            <nav x-data="{ open: false }">     
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                   <!-- Blade Component for Dropdown -->
                        <div class="flex justify-center"> <!-- Flex container to center the dropdown -->
                            <x-dropdown align="center" width="32"> <!-- Adjusted the width to make it smaller -->
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ms-1">
                                            <svg class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 10a4 4 0 100-8 4 4 0 000 8zm0 2a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6z"/>
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')" class="flex items-center text-gray-700 hover:bg-gray-100 rounded-md p-1 text-sm">
                                        <!-- FontAwesome Profile Icon -->
                                        <i class="fa fa-user me-1" aria-hidden="true"></i> 
                                        <span>{{ __('Profile') }}</span> <!-- Smaller text using text-sm class -->
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}" class="mt-0">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')" 
                                            class="flex items-center text-gray-700 hover:bg-gray-100 rounded-md p-2 text-sm"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            <!-- FontAwesome Logout Icon -->
                                            <i class="fa fa-sign-out me-1" aria-hidden="true"></i> 
                                            <span>{{ __('Logout') }}</span> <!-- Smaller text using text-sm class -->
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="custom-left-margin  text-xs">
            @include('partials.notification', ['unreadNotifications' => auth()->user()->unreadNotifications])
        </div>
        </div>
        </li>
        <br>
        <li ><a href="{{ route('dashboard') }}" id="sidebar-dashboard"><i class="fas fa-chart-bar" aria-hidden="true"></i>Dashboard</a></li>
     
            <div @click.away="open = false" class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-lg font- text-left bg-white rounded-lg  focus:outline-none focus:shadow-outline">
                    <a><i class="fas fa-store" aria-hidden="true"></i>Restaurant</a>
                    <!--svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg-->
                </button>
                <!-- Unveil the menu -->
                <div style="z-index:4" x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                    <div class="px-2 py-2 bg-white rounded-md shadow" > <!-- Set the background color here -->
                        <!-- A feast of options -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('kitchenOrder')" :active="request()->routeIs('kitchenOrder')">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ __('Orders') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('menu')" :active="request()->routeIs('menu')">
                                <i class="fa fa-book" aria-hidden="true"></i> {{ __('Menu') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('discount')" :active="request()->routeIs('discount')">
                                <i class="fa fa-ticket" aria-hidden="true"></i> {{ __('Discount') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('gallery')" :active="request()->routeIs('gallery')">
                                    <i class="fa fa-picture-o" aria-hidden="true"></i> {{ __('Gallery') }}
                                </x-responsive-nav-link>
                        </form>
                    </div>
                </div>            
            </div>
            

            <div @click.away="open = false" class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-lg font- text-left bg-white rounded-lg  focus:outline-none focus:shadow-outline">
                    <a><i class="fas fa-utensils" aria-hidden="true"></i>Catering</a>
                    <!--svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg-->
                </button>
                <!-- Unveil the menu -->
                <div style="z-index:4" x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                    <div class="px-2 py-2 bg-white rounded-md shadow" > <!-- Set the background color here -->
                        <!-- A feast of options -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.index')">
                                <i class="fa fa-calendar" aria-hidden="true"></i> {{ __('Reserves') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('packages.index')" :active="request()->routeIs('packages.index')">
                                <i class="fa fa-th-large" aria-hidden="true"></i> {{ __('Packages') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('services.index')" :active="request()->routeIs('services.index')">
                                <i class="fas fa-concierge-bell" aria-hidden="true"></i> {{ __('Services') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('cateringoptions.index')" :active="request()->routeIs('cateringoptions.index')">
                                    <i class="fas fa-tasks" aria-hidden="true"></i> {{ __('Options') }}
                                </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('inventory.index')" :active="request()->routeIs('inventory.index')">
                                <i class="fas fa-box" aria-hidden="true"></i> {{ __('Supplies') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('reviews.index')" :active="request()->routeIs('reviews.index')">
                                <i class="fas fa-star" aria-hidden="true"></i> {{ __('Reviews') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>            
            </div>

            <div @click.away="open = false" class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-lg font- text-left bg-white rounded-lg  focus:outline-none focus:shadow-outline">
                    <a><i class="fas fa-user" aria-hidden="true"></i>Account</a>
                    <!--svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg-->
                </button>
                <!-- Unveil the menu -->
                <div style="z-index:4" x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                     <div class="px-2 py-2 bg-white rounded-md shadow" > <!-- Set the background color here -->
                        <!-- A feast of options -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('accountCreation')" :active="request()->routeIs('accountCreation')">
                                    <i class="fa fa-user-plus" aria-hidden="true"></i> {{ __('Create') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('manageAccount')" :active="request()->routeIs('manageAccount')">
                                    <i class="fas fa-tasks" aria-hidden="true"></i> {{ __('Manage') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>            
            </div>

            <!-- STAFF -->
            @else
            <li>
            <div class="header-container">
            <nav x-data="{ open: false }">     
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                   <!-- Blade Component for Dropdown -->
                        <div class="flex justify-center"> <!-- Flex container to center the dropdown -->
                            <x-dropdown align="center" width="32"> <!-- Adjusted the width to make it smaller -->
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ms-1">
                                            <svg class="fill-current h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 10a4 4 0 100-8 4 4 0 000 8zm0 2a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6z"/>
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')" class="flex items-center text-gray-700 hover:bg-gray-100 rounded-md p-1 text-sm">
                                        <!-- FontAwesome Profile Icon -->
                                        <i class="fa fa-user me-1" aria-hidden="true"></i> 
                                        <span>{{ __('Profile') }}</span> <!-- Smaller text using text-sm class -->
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}" class="mt-0">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')" 
                                            class="flex items-center text-gray-700 hover:bg-gray-100 rounded-md p-2 text-sm"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            <!-- FontAwesome Logout Icon -->
                                            <i class="fa fa-sign-out me-1" aria-hidden="true"></i> 
                                            <span>{{ __('Logout') }}</span> <!-- Smaller text using text-sm class -->
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="custom-left-margin  text-xs">
            @include('partials.notification', ['unreadNotifications' => auth()->user()->unreadNotifications])
        </div>
        </div>
        </li>
        <br>
        <!--<li ><a href="{{ route('dashboard') }}" id="sidebar-dashboard"><i class="fa fa-th-large" aria-hidden="true"></i>Dashboard</a></li>-->
     
            <div @click.away="open = false" class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-lg font- text-left bg-white rounded-lg  focus:outline-none focus:shadow-outline">
                    <a><i class="fas fa-store" aria-hidden="true"></i>Restaurant</a>
                    <!--svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg-->
                </button>
                <!-- Unveil the menu -->
                <div style="z-index:4" x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                     <div class="px-2 py-2 bg-white rounded-md shadow" > <!-- Set the background color here -->
                        <!-- A feast of options -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('kitchenOrder')" :active="request()->routeIs('kitchenOrder')">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ __('Orders') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('menu')" :active="request()->routeIs('menu')">
                                <i class="fa fa-book" aria-hidden="true"></i> {{ __('Menu') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('gallery')" :active="request()->routeIs('gallery')">
                                <i class="fa fa-picture-o" aria-hidden="true"></i> {{ __('Gallery') }}
                            </x-responsive-nav-link>
                            <!--<x-responsive-nav-link :href="route('discount')" :active="request()->routeIs('discount')">
                                <i class="fa fa-ticket" aria-hidden="true"></i> {{ __('Discount') }}
                            </x-responsive-nav-link>-->
                        </form>
                    </div>
                </div>            
            </div>
            

            <div @click.away="open = false" class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-lg font- text-left bg-white rounded-lg  focus:outline-none focus:shadow-outline">
                    <a><i class="fas fa-utensils" aria-hidden="true"></i>Catering</a>
                    <!--svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg-->
                </button>
                <!-- Unveil the menu -->
                <div style="z-index:4" x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                     <div class="px-2 py-2 bg-white rounded-md shadow" > <!-- Set the background color here -->
                        <!-- A feast of options -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('reservations.index')" :active="request()->routeIs('reservations.index')">
                                <i class="fa fa-calendar" aria-hidden="true"></i> {{ __('Reserves') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('packages.index')" :active="request()->routeIs('packages.index')">
                                <i class="fa fa-th-large" aria-hidden="true"></i> {{ __('Packages') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('services.index')" :active="request()->routeIs('services.index')">
                                <i class="fas fa-concierge-bell" aria-hidden="true"></i> {{ __('Services') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('cateringoptions.index')" :active="request()->routeIs('cateringoptions.index')">
                                    <i class="fas fa-cogs" aria-hidden="true"></i> {{ __('Options') }}
                                </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('inventory.index')" :active="request()->routeIs('inventory.index')">
                                <i class="fas fa-box" aria-hidden="true"></i> {{ __('Supplies') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link :href="route('reviews.index')" :active="request()->routeIs('reviews.index')">
                                <i class="fas fa-star" aria-hidden="true"></i> {{ __('Reviews') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>            
            </div>

            <br>
        @endif


            <li >
                <a href="{{ route('logout') }}" id="sidebar-logout" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>{{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
            
        </ul>
    </div>

    <div class="container">
        <div class="pl-250">
        @yield('content')
        </div>
    </div>
    
</body>
</html>