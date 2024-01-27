<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    @if (auth()->user()->ActiveStatus == 2 && strpos(request()->url(), '/change-password') == false)
        <script>
            window.location.href = '/change-password';
        </script>
    @endif

    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/sidebar.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/sweetalert2@10.14.0/dist/sweetalert2.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"></script>
    <link href="{{ asset('img/favi.png') }}" rel="icon" />
    <link href="{{ asset('/css/dashboard.css') }}" rel="stylesheet">

</head>

<body style="background: #e4e9f7">

    <header class="header fixed-top header-scrolled" style="max-height: 170px">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-9 text-left" id="name-header">
                    <h3 id="name-span-header">{{ substr(auth()->user()->client->ClientName, 0, 30) }}{{ strlen(auth()->user()->client->ClientName) > 30 ? "...":"" }}
                    </h3>

                </div>
                <div class="col-sm-3 text-center" id="logo-header">
                    @if(auth()->user()->ClientID == 10)
                        <img src="{{ asset('img/favi.png') }}" id="logo-img-header-epi" alt="" style="height: 63px" />
                    @else
                        <img src="{{ asset('img/new-logo.png') }}" class="img-fluid" id="logo-img-header" alt="" />
                    @endif
                </div>
            </div>
        </div>

        <i class='bx bx-menu' id="header-menu-box" onclick="document.getElementById('menu-box').click()"
            style="font-size: 25px"></i>
    </header>
    @if (auth()->user()->userType === 'ADMIN' || auth()->user()->userType === 'SUPER ADMIN')
        <div class="notification">
            <button data-bs-toggle="modal" data-bs-target="#notification-modal"><i class="fas fa-bell"></i></button>
            <p id="notification-count-button">5</p>
        </div>
    @endif


    @include('includes.dashboard_sidebar')

    <section class="home-section">
        <br><br><br>
        <div class="home-content">

        </div>
        @yield('contents')

        <br><br><br>

    </section>

    @include('components.notification_modal')

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.4/dist/sweetalert2.js"></script>
    <script src="{{ asset('js/showPassword.js') }}"></script>
    <script src="{{ asset('js/session.js') }}"></script>
    @yield('scripts')
    <script>
        let arrow = document.querySelectorAll(".arrow");
        let notificationTable = null;

        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
                arrowParent.classList.toggle("showMenu");
            });
        }
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector("#menu-box");
        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });

        var session = "{{ auth()->check() ? 'true' : 'false' }}"
        if (!session)
            window.location.replace("{{ route('sign-in.index') }}")

        var mediaQuery = window.matchMedia('(max-width: 600px)');

        function handleMediaQueryChange(mediaQuery) {
            var nameElement = document.getElementById('name-span-header');

            if (mediaQuery.matches) {
                // Change h2 to h6
                if (nameElement && nameElement.tagName.toLowerCase() === 'h2') {
                    var h6Element = document.createElement('h6');
                    h6Element.id = 'name-span-header';
                    h6Element.innerHTML = nameElement.innerHTML;
                    nameElement.parentNode.replaceChild(h6Element, nameElement);
                }
            } else {
                // Change h6 to h2
                if (nameElement && nameElement.tagName.toLowerCase() === 'h6') {
                    var h2Element = document.createElement('h2');
                    h2Element.id = 'name-span-header';
                    h2Element.innerHTML = nameElement.innerHTML;
                    nameElement.parentNode.replaceChild(h2Element, nameElement);
                }
            }
        }

        mediaQuery.addEventListener('change', function() {
            handleMediaQueryChange(mediaQuery);
        });

        handleMediaQueryChange(mediaQuery);

        $(document).ready(function() {
            $('#notification-count-button').css('display', 'none');
        });

        document.addEventListener('DOMContentLoaded', function() {
            if (notificationTable === null) {
                $('#notification-table').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax: {
                        url: "{{ route('notification.table') }}",
                        type: "GET",
                    },
                    columns: [{
                            data: 'notification_status',
                            orderable: false
                        },
                        {
                            data: 'date'
                        },
                        {
                            data: 'subject'
                        },
                        {
                            data: 'message'
                        },
                        {
                            data: 'actions',
                            orderable: false
                        },
                    ],
                    fnDrawCallback: function(oSettings) {
                        $('#notification-table th').removeAttr('rowspan').removeAttr('colspan').css(
                            'width', '');
                    },
                    sorting: [],
                    pageLength: 5,
                    language: {
                        "processing": `
                        <div class="spinner-border text-success"></div>
                        <p>Loading data. Please wait ...</p>
                    `,
                    },
                    dom: 'rtip'
                });

            }

            $.ajax({
                url: "{{ route('notification.count') }}",
                type: "GET",
                success: function(response) {
                    if (response <= 0) {
                        $('#notification-count-button').css('display', 'none');
                        $('#notification-title').html('NOTIFICATIONS');
                    } else {
                        $('#notification-title').html(
                            `NOTIFICATIONS ( <span id="number-of-new-notification">0</span> )</h5>`);
                        $('#notification-count-button').css('display', 'flex');
                    }

                    $('#notification-count-button').text(response);
                    $('#number-of-new-notification').text(response);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    </script>
</body>

</html>
