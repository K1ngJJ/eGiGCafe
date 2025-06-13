@extends('layouts.guest')

@section('links')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('bodyID')
{{ 'home' }}@endsection

@section('navTheme')
{{ 'dark' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}@endsection


@section('content')
<style>
    .animated-card {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 1s forwards ease-in-out;
    }

    .animated-card:hover {
        transform: scale(1.05) translateY(-5px);
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
    }

    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    #best-month:hover, #best-services:hover {
    transform: scale(1.05);
}

</style>
<section class="banner">
    <div class="container">
        <div class="col-md-10 col-lg-8 details">
            <h3>ALL IN RESTAURANT IN TOWN</h3>
            <h1>Excellent cuisine and catering services tailored to your budget and needs.</h1>

            <a href="{{ route('reservations.step.one') }}" class="btn primary-btn" style="width:250px;">Book Now!</a>
    
        </div>
    </div>
</section>

<!-- Best Reservation Month and Best Events/Services -->
<div class="row my-5 justify-content-between">
<div class="col-lg-6 col-12 mb-3 position-relative">
<div id="best-month" class="col-12 p-4 shadow-lg rounded bg-gradient-light position-relative overflow-hidden" 
         style="border: 2px solid #E0E0E0; background: linear-gradient(135deg, #f7f7f7, #fdeaea); transition: transform 0.5s ease-in-out, box-shadow 0.3s ease;">
        <div class="icon-overlay animate-spin-slow" style="position: absolute; top: -20px; right: -20px; opacity: 0.1; z-index: 0;">
            <img src="{{ URL::asset('/images/book.svg') }}" style="height: 100px; width: 100px;">
        </div>
        <div class="icon-overlay animate-float" style="position: absolute; top: 10%; left: 42.5%; transform: translate(-50%, -50%); opacity: 0.1; z-index: 0;">
            <img src="{{ URL::asset('/images/book.svg') }}" style="height: 100px; width: 100px;">
        </div> 
        <div class="icon-overlay animate-spin-slow" style="position: absolute; bottom: -20px; left: -20px; opacity: 0.1; z-index: 0;">
            <img src="{{ URL::asset('/images/book.svg') }}" style="height: 100px; width: 100px;">
        </div>
        <h5 class="text-center mb-3 position-relative" style="z-index: 1;">
            <img src="{{ URL::asset('/images/menu.svg') }}" style="height: 28px; width: 28px; margin-right: 10px; vertical-align: middle;">
            <span style="color: #8B0000; font-weight: bold;">Welcome to GiG Cafe, 😊</span> <!-- Dark Red Color -->
        </h5>
        <div class="position-relative glow-on-hover" style="background: #ffffff; padding: 10px; border-radius: 10px; z-index: 1; transition: box-shadow 0.3s ease-in-out;">
    <h2 class="my-2 apexcharts-yaxis-title  text-center" style="color: #000000; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0);"> 
        " Good food is the foundation of genuine happiness, bringing people together and creating memorable moments. It nourishes not just the body, but the soul, turning ordinary days into something extraordinary. "
    </h2>
</div>

        <p class="small text-muted text-center mt-2 position-relative" style="z-index: 1;">Join us at GiG Cafe, where every bite brings joy, and every visit feels like home."</p>
    </div>

<style>
    #best-month:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .icon-overlay {
        transition: transform 0.6s ease-in-out;
    }

    .icon-overlay:hover {
        transform: rotate(15deg);
    }

    .animate-spin-slow {
        animation: spin 20s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .glow-on-hover {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        transition: box-shadow 0.3s ease-in-out;
    }

    .glow-on-hover:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
    }

    .pulse {
        animation: pulseAnimation 1.5s infinite;
    }

    @keyframes pulseAnimation {
        0%, 100% {
            transform: scale(1);
           
        }
        50% {
            transform: scale(1.05);
         
        }
    }
</style>

    <div id="best-services" class="mt-4 col-12 p-4 shadow-lg rounded bg-gradient-light position-relative overflow-hidden" 
         style="border: 2px solid #E0E0E0; background: linear-gradient(135deg, #ffe5d4, #ffd8b1); transition: transform 0.4s ease-in-out, box-shadow 0.3s ease;">
        <div class="icon-overlay animate-spin-slow" style="position: absolute; bottom: -35px; left: -20px; opacity: 0.1; z-index: 0;">
            <img src="{{ asset('/images/tea.svg') }}" style="height: 150px; width: 150px;">
        </div>
        <div class="icon-overlay animate-float" style="position: absolute; top: 1%; left: 39%; transform: translate(-50%, -50%); opacity: 0.1; z-index: 0;">
            <img src="{{ URL::asset('/images/tea.svg') }}" style="height: 150px; width: 150px;">
        </div>
        <div class="icon-overlay animate-spin-slow" style="position: absolute; top: -20px; right: -25px; opacity: 0.1; z-index: 0;">
            <img src="{{ asset('/images/tea.svg') }}" style="height: 150px; width: 150px;">
        </div>
        <h5 class="text-center mb-3 position-relative" style="z-index: 1;">
            <img src="{{ asset('/images/tea.svg') }}" style="height: 28px; width: 28px; margin-right: 10px; vertical-align: middle;">
            <span style="color: #FF4500; font-weight: bold;">Best Event</span> <!-- Dark Orange Color -->
        </h5>
        <div class="position-relative glow-on-hover" style="background: rgba(255, 255, 255, 0.95); padding: 10px; border-radius: 10px; z-index: 1; transition: box-shadow 0.3s ease-in-out;">

            <!-- Collage of Gallery Images -->
            <div class="gallery-collage" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px;">
                <!-- Directly referencing images in the public/gallery folder -->
                <div class="gallery-item" style="position: relative;">
                    <img src="{{ asset('/galleryImages/1727052993-gigcafe img 1.jpg') }}" alt="Gallery Image" 
                         style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">
                </div>
                <div class="gallery-item" style="position: relative;">
                    <img src="{{ asset('/galleryImages/1727053071-358067062_709105824564439_6559889952019422459_n.jpg') }}" alt="Gallery Image" 
                         style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">
                </div>
                <div class="gallery-item" style="position: relative;">
                    <img src="{{ asset('/galleryImages/1727052904-357098911_704934234981598_6771800479847694702_n.jpg') }}" alt="Gallery Image" 
                         style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">
                </div>
            </div>

            <h2 class="my-4 apexcharts-yaxis-title fw-bold text-center pulse" style="color: #FF4500;"> <!-- Dark Orange Text -->
                @if($eventOrServiceData)
                    {{ $eventOrServiceData['name'] }}
                @else
                    <span style="color: #FF4500;">No Data Available</span> <!-- Dark Orange for No Data -->
                @endif
            </h2>
        </div>
        <p class="small text-muted text-center mt-2 position-relative" style="z-index: 1;">Event with the Most Reservations</p>
    </div>
</div>







<div class="col-lg-6 col-12 mb-3 position-relative">
    <div id="best-services" class="col-12 p-4 shadow-lg rounded bg-gradient-light position-relative overflow-hidden" 
         style="border: 2px solid #E0E0E0; background: rgba(255, 105, 97, 0.4); transition: transform 0.4s ease-in-out, box-shadow 0.3s ease;">
        <div class="icon-overlay animate-spin-slow" style="position: absolute; bottom: -35px; left: -20px; opacity: 0.1; z-index: 0;">
            <img src="{{ asset('/images/burger.svg') }}" style="height: 150px; width: 150px;">
        </div>
        <div class="icon-overlay animate-float" style="position: absolute; top: 1%; left: 39%; transform: translate(-50%, -50%); opacity: 0.1; z-index: 0;">
            <img src="{{ URL::asset('/images/burger.svg') }}" style="height: 150px; width: 150px;">
        </div>
        <div class="icon-overlay animate-spin-slow" style="position: absolute; top: -20px; right: -25px; opacity: 0.1; z-index: 0;">
            <img src="{{ asset('/images/burger.svg') }}" style="height: 150px; width: 150px;">
        </div>
        <h5 class="text-center mb-3 position-relative" style="z-index: 1;">
            <img src="{{ asset('/images/burger.svg') }}" style="height: 28px; width: 28px; margin-right: 10px; vertical-align: middle;">
            <span style="color: #FF4500; font-weight: bold;">Top 3</span> <!-- Dark Orange Color -->
        </h5>
        <div class="position-relative glow-on-hover" style="background: rgba(255, 255, 255, 0.95); padding: 10px; border-radius: 10px; z-index: 1; transition: box-shadow 0.3s ease-in-out;">
            <h2 class="my-4 apexcharts-yaxis-title fw-bold text-center pulse" style="color: #FF4500;"> <!-- Dark Orange Text -->
              Menus
            </h2>

          <!-- Images Grid -->
            <div class="gallery-collage" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px;">
                @foreach($sortedSales as $product)
                    <img 
                        src="{{ asset('menuImages/' . $product->image) }}" 
                        alt="{{ $product->x }}" 
                        style="
                            width: 100%; 
                            height: 200px; 
                            object-fit: cover; 
                            border-radius: 8px; 
                            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
                        "
                        onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 4px 15px rgba(0, 0, 0, 0.3)';"
                        onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';"
                    >
                @endforeach
            </div>


           <!-- Labels Grid -->
            <div class="labels-grid mt-3" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px;">
                @foreach($sortedSales as $product)
                    <div class="text-center">
                        <h5 style="font-size: 0.680rem; font-weight: bold; color: darkred;">{{ $product->x }}</h5> <!-- Display product name -->
                    </div>
                @endforeach
            </div>
        </div>
        <p class="small text-muted text-center mt-2 position-relative" style="z-index: 1;">Menu with the Most Sales</p>
    </div>


<style>
    #best-services:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
    }

    .icon-overlay {
        transition: transform 0.5s ease-in-out;
    }

    .animate-float {
        animation: float 4s infinite ease-in-out;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .glow-on-hover {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        transition: box-shadow 0.3s ease-in-out;
    }

    .glow-on-hover:hover {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    }

    .gallery-collage {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
    }

    .gallery-item img {
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .gallery-item img:hover {
        transform: scale(1.08);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .pulse {
        animation: pulseEffect 2s infinite;
    }

    @keyframes pulseEffect {
        0%, 100% {
            transform: scale(1);

        }
        50% {
            transform: scale(1.03);
         
        }
    }
</style>

    <div id="best-month" class="mt-4 col-12 p-4 shadow-lg rounded bg-gradient-light position-relative overflow-hidden" 
         style="border: 2px solid #E0E0E0; background: linear-gradient(135deg, #f7f7f7, #fdeaea); transition: transform 0.5s ease-in-out, box-shadow 0.3s ease;">
        <div class="icon-overlay animate-spin-slow" style="position: absolute; top: -20px; right: -20px; opacity: 0.1; z-index: 0;">
            <img src="{{ URL::asset('/images/calendar.svg') }}" style="height: 100px; width: 100px;">
        </div>
        <div class="icon-overlay animate-float" style="position: absolute; top: 10%; left: 42.5%; transform: translate(-50%, -50%); opacity: 0.1; z-index: 0;">
            <img src="{{ URL::asset('/images/calendar.svg') }}" style="height: 100px; width: 100px;">
        </div> 
        <div class="icon-overlay animate-spin-slow" style="position: absolute; bottom: -20px; left: -20px; opacity: 0.1; z-index: 0;">
            <img src="{{ URL::asset('/images/calendar.svg') }}" style="height: 100px; width: 100px;">
        </div>
        <h5 class="text-center mb-3 position-relative" style="z-index: 1;">
            <img src="{{ URL::asset('/images/calendar.svg') }}" style="height: 28px; width: 28px; margin-right: 10px; vertical-align: middle;">
            <span style="color: #8B0000; font-weight: bold;">Best Month</span> <!-- Dark Red Color -->
        </h5>
        <div class="position-relative glow-on-hover" style="background: rgba(255, 255, 255, 0.95); padding: 10px; border-radius: 10px; z-index: 1; transition: box-shadow 0.3s ease-in-out;">
            <h2 class="my-2 apexcharts-yaxis-title fw-bold text-center pulse" style="color: #8B0000;"> <!-- Dark Red Text -->
                @if($reservationMonthData)
                    @php
                        // Map month numbers to names
                        $months = [
                            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 
                            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 
                            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                        ];
                        $monthName = $months[$reservationMonthData['month']] ?? 'Unknown';
                    @endphp
                    {{ $monthName }}
                @else
                    <span style="color: #8B0000;">No Data Available</span> <!-- Dark Red for No Data -->
                @endif
            </h2>
        </div>
        <p class="small text-muted text-center mt-2 position-relative" style="z-index: 1;">Month with the Most Reservations</p>
    </div>
</div>

<section class="chefs">
    <div class="container">
        <h2 class="title flex-center">Meet our Resto-teams</h2>
        <div class="row justify-content-evenly align-items-center chefs-wrapper">
            <div class="card col-lg-3 col-md-8 col-10 mt-5">
                <div class="chef-img d-flex align-items-center justify-content-center">
                    <img src="./images/chef1.jpg" alt="">
                </div>
                <div class="chef-desc d-flex flex-column align-items-center justify-content-start">
                    <p class="chef-name"></p>
                    <p class="chef-position"></p>
                </div>
            </div>
            <div class="card col-lg-3 col-md-8 col-10 mt-5">
                <div class="chef-img d-flex align-items-center justify-content-center">
                    <img src="./images/chef2.jpg" alt="">
                </div>
                <div class="chef-desc d-flex flex-column align-items-center justify-content-start">
                    <p class="chef-name">Dess C. Aquino</p>
                    <p class="chef-position"></p>
                </div>
            </div>
            <div class="card col-lg-3 col-md-8 col-10 mt-5">
                <div class="chef-img d-flex align-items-center justify-content-center">
                    <img src="./images/chef3.jpg" alt="">
                </div>
                <div class="chef-desc d-flex flex-column align-items-center justify-content-start">
                    <p class="chef-name"></p>
                    <p class="chef-position"></p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact">
    <div class="container">
        <h2 class="title flex-center">Contact Us</h2>
        <div class="flex-center contact-wrapper">
        <div class="form-wrapper flex-center">
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" style="height: 100px"></textarea>
                </div>
                <div class="w-100 flex-center">
                <a href="mailto:gigcafe026@gmail.com" class="primary-btn msg-btn w-100 px-3 py-2 text-center rounded">
                    Send Message
                </a>
                </div>
            </form>
        </div>

        <div class="gmap flex-center">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3921.5128460050384!2d121.18556741539966!3d13.410328102560425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397d560e573e1ad%3A0x6ac7129ab6d568d8!2sBarangay%20San%20Vicente%20East%2C%20Calapan%2C%20Oriental%20Mindoro!5e0!3m2!1sen!2sph!4v1644981583964!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" class="rounded"></iframe>
        </div>              
            

        </div>
    </div>
</section>
@endsection