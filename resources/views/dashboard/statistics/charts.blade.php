{{-- @extends('pages.master')

@section('content')

<div class="container pt-5 pb-3">
    <div class="text-center mb-3 pb-3">
        <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Our Blog</h6>
        <h1>Latest From Our Blog</h1>
    </div>
    <div class="row pb-3"> --}}
        {{-- @foreach ($posts as $post)
            
       
        <div class="col-lg-4 col-md-6 mb-4 pb-2">
            <div class="blog-item">
                <div class="position-relative">
                    <img class="img-fluid w-100" style="width: 370px;height:250px;object-fit: cover;" src="{{$post->image}}" alt="">
                    <div class="blog-date">
                        <h6 class="font-weight-bold mb-n1">{{$post->updated_at->format('d/M')}}</h6>
                        <small class="text-white text-uppercase">{{$post->updated_at->format('Y')}}</small>
                    </div>
                </div>
                <div class="bg-white p-4">
                    <div class="d-flex mb-2">
                        <a class="text-primary text-uppercase text-decoration-none" href="">{{$post->user->name}}</a>
                        <span class="text-primary px-2">|</span>
                        <a class="text-primary text-uppercase text-decoration-none" href="/categories/{{$post->category->translate('en')->name}}">{{$post->category->translate()->name}}</a>
                    </div>
                   <center> <a class="h5 m-0 text-decoration-none" href="/posts/{{$post->slug}}">{{$post->translate()->title}}</a></center>
                </div>
            </div>
        </div>
        @endforeach --}}
    {{-- </div>
</div> --}}


{{-- @endsection --}}

@extends('imports')

@section('content')
    <!-- Blog Start -->
    <div class="container pt-5 pb-3">
        <div class="text-center mb-3 pb-3">
            <h6 class="text-primary text-uppercase" style="">الاحصائيات</h6>
            <h1>مخططات احصائية</h1>
        </div>
        <div class="row pb-3">
        
           
            <div class="col-lg-6 col-md-6 mb-4 pb-2">

                            <div class="blog-item">
                                <div class="bg-white p-4">
                                    <div class="d-flex mb-2">
                                        <a class="text-primary text-uppercase text-decoration-none">
                                            <h4>عدد عمليات الحجز حسب اليوم في اخر 10 ايام</h4>
                                        </a>
                                    </div>
                                    <a class="h5 m-0 text-decoration-none"><canvas id="bookingsperday"></canvas></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 mb-4 pb-2">
                            <div class="blog-item">
                                <div class="bg-white p-4">
                                    <div class="d-flex mb-2">
                                        <a class="text-primary text-uppercase text-decoration-none">
                                            <h4>عدد عمليات الحجز حسب الاسبوع في في اخر 12 اسبوع</h4>
                                        </a>
                                    </div>
                                    <a class="h5 m-0 text-decoration-none"><canvas id="bookingsperweek"></canvas></a>
                                </div>
                            </div>
                        </div>
                    </div>
                            <br>
                            <div class="row pb-3">
                                <div class="col-lg-6 col-md-6 mb-4 pb-2">
                    
                            <div class="blog-item">
                                <div class="bg-white p-4">
                                    <div class="d-flex mb-2">
                                        <a class="text-primary text-uppercase text-decoration-none">
                                            <h4>عدد عمليات الحجز حسب الشهر لهذه السنة</h4>
                                        </a>
                                    </div>
                                    <a class="h5 m-0 text-decoration-none"><canvas id="bookingspermonth"></canvas></a>
                                </div>
                            </div>
                        </div>
                            <br>
                            <div class="col-lg-6 col-md-6 mb-4 pb-2">
                            <div class="blog-item">
                                <div class="bg-white p-4">
                                    <div class="d-flex mb-2">
                                        <a class="text-primary text-uppercase text-decoration-none">
                                            <h4>عدد المستخدمين المسجلين حسب الشهر لهذه السنة</h4>
                                        </a>
                                    </div>
                                    <a class="h5 m-0 text-decoration-none"><canvas id="users"></canvas></a>
                                </div>
                            </div>
                        </div></div>
                            <br>
                            <div class="row pb-3">
                                <div class="col-lg-6 col-md-6 mb-4 pb-2">
                            <div class="blog-item">
                                <div class="bg-white p-4">
                                    <div class="d-flex mb-2">
                                        <a class="text-primary text-uppercase text-decoration-none">
                                            <h4>الرحلات العشرة الأكثر اعجاباً</h4>
                                        </a>
                                    </div>
                                    <a class="h5 m-0 text-decoration-none"><canvas id="triplikes"></canvas></a>
                                </div>
                            </div>
                        </div>
                            <br>
                            <div class="col-lg-6 col-md-6 mb-4 pb-2">
                            <div class="blog-item">
                                <div class="bg-white p-4">
                                    <div class="d-flex mb-2">
                                        <a class="text-primary text-uppercase text-decoration-none">
                                            <h4>الرحلات العشرة الأقل اعجاباً</h4>
                                        </a>
                                    </div>
                                    <a class="h5 m-0 text-decoration-none"><canvas id="tripdislikes"></canvas></a>
                                </div>
                            </div>
                        </div></div>
                            <br>
                            <div class="row pb-3">
                                <div class="col-lg-6 col-md-6 mb-4 pb-2">
                            <div class="blog-item">
                                <div class="bg-white p-4">
                                    <div class="d-flex mb-2">
                                        <a class="text-primary text-uppercase text-decoration-none">
                                            <h4>الرحلات العشرة الأكثر تعليقا</h4>
                                        </a>
                                    </div>
                                    <a class="h5 m-0 text-decoration-none"><canvas id="tripcomments"></canvas></a>
                                </div>
                            </div>
                                </div>
                            <br>
                            <div class="col-lg-6 col-md-6 mb-4 pb-2">
                            <div class="blog-item">
                                <div class="bg-white p-4">
                                    <div class="d-flex mb-2">
                                        <a class="text-primary text-uppercase text-decoration-none">
                                            <h4>المنشورات العشرة الأكثر اعجاباً</h4>
                                        </a>
                                    </div>
                                    <a class="h5 m-0 text-decoration-none"><canvas id="postlikes"></canvas></a>
                                </div>
                            </div>
                        </div></div>
                            <br>
                            <div class="row pb-3">
                                <div class="col-lg-6 col-md-6 mb-4 pb-2">
                            <div class="blog-item">
                                <div class="bg-white p-4">
                                    <div class="d-flex mb-2">
                                        <a class="text-primary text-uppercase text-decoration-none">
                                            <h4>المنشورات العشرة الأقل اعجاباً</h4>
                                        </a>
                                    </div>
                                    <a class="h5 m-0 text-decoration-none"><canvas id="postdislikes"></canvas></a>
                                </div>
                            </div>
                        </div>
                            <br>
                            <div class="col-lg-6 col-md-6 mb-4 pb-2">
                            <div class="blog-item">
                                <div class="bg-white p-4">
                                    <div class="d-flex mb-2">
                                        <a class="text-primary text-uppercase text-decoration-none">
                                            <h4>المنشورات العشرة الأكثر تعليقا</h4>
                                        </a>
                                    </div>
                                    <a class="h5 m-0 text-decoration-none"><canvas id="postcomments"></canvas></a>
                                </div>
                            </div>
                        </div></div>
                            <br>
                            <div class="row pb-3">
                                <div class="col-lg-6 col-md-6 mb-4 pb-2">
                            <div class="blog-item">
                                <div class="bg-white p-4">
                                    <div class="d-flex mb-2">
                                        <a class="text-primary text-uppercase text-decoration-none">
                                            <h4>الألبومات العشرة الأكثر اعجاباً</h4>
                                        </a>
                                    </div>
                                    <a class="h5 m-0 text-decoration-none"><canvas id="albumlikes"></canvas></a>
                                </div>
                            </div>
                        </div>
                        
                            <br>
                            <div class="col-lg-6 col-md-6 mb-4 pb-2">
                            <div class="blog-item">
                                <div class="bg-white p-4">
                                    <div class="d-flex mb-2">
                                        <a class="text-primary text-uppercase text-decoration-none">
                                            <h4>الألبومات العشرة الأقل اعجاباً</h4>
                                        </a>
                                    </div>
                                    <a class="h5 m-0 text-decoration-none"><canvas id="albumdislikes"></canvas></a>
                                </div>
                            </div>
                        </div></div>
                            <br>
                                         <div class="row pb-3"> 
                                <div class="col-lg-6 col-md-6 mb-4 pb-2">
                            <div class="blog-item">
                                <div class="bg-white p-4">
                                    <div class="d-flex mb-2">
                                        <a class="text-primary text-uppercase text-decoration-none">
                                            <h4>الألبومات العشرة الأكثر تعليقا</h4>
                                        </a>
                                    </div>
                                    <a class="h5 m-0 text-decoration-none"><canvas id="albumcomments"></canvas></a>
                                </div>
                            </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-4 pb-2">
                                <div class="blog-item">
                                    <div class="bg-white p-4">
                                        <div class="d-flex mb-2">
                                            <a class="text-primary text-uppercase text-decoration-none">
                                                <h4>الرحلات العشرى الأكثر حجزا</h4>
                                            </a>
                                        </div>
                                        <a class="h5 m-0 text-decoration-none"><canvas id="mostbookedtrips"></canvas></a>
                                    </div>
                                </div>
                                </div>
                                </div>
                                
</div>

    <!-- triplikes -->
    <script>
        const ctx = document.getElementById('triplikes').getContext('2d');
        const labels = [
            @foreach ($mostLikedTrips as $trip)
                '{{ $trip->translate('ar')->name }}{{-$trip->id}}',
            @endforeach
        ];
        const data = {
            labels: labels,
            datasets: [{
                label: 'Likes',
                data: [
                    @foreach ($mostLikedTrips as $trip)
                        '{{ $trip->likes_count }}',
                    @endforeach
                ],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1
            }]
        };
        const options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };
        const myChart = new Chart(ctx, {
            type: 'bar', // bar - pie
            data: data,
            options: options
        });
    </script>

    <!-- tripdislikes -->
    <script>
        const ctx2 = document.getElementById('tripdislikes').getContext('2d');
        const labels2 = [
            @foreach ($mostDislikedTrips as $trip)
                '{{ $trip->translate('ar')->name }}{{-$trip->id}}',
            @endforeach
        ];
        const data2 = {
            labels: labels2,
            datasets: [{
                label: 'DisLikes',
                data: [
                    @foreach ($mostDislikedTrips as $trip)
                        '{{ $trip->dislikes_count }}',
                    @endforeach
                ],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1
            }]
        };
        const options2 = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };
        const myChart2 = new Chart(ctx2, {
            type: 'bar', // bar - pie
            data: data2,
            options: options2
        });
    </script>

        <!-- post likes -->
        <script>
            const ctx3 = document.getElementById('postlikes').getContext('2d');
            const labels3 = [
                @foreach ($mostLikedPosts as $post)
                    '{{ $post->translate('ar')->title }}{{-$trip->id}}',
                @endforeach
            ];
            const data3 = {
                labels: labels3,
                datasets: [{
                    label: 'Likes',
                    data: [
                        @foreach ($mostLikedPosts as $post)
                            '{{ $post->likes_count }}',
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            };
            const options3 = {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };
            const myChart3 = new Chart(ctx3, {
                type: 'bar', // bar - pie
                data: data3,
                options: options3,
            });
        </script>
        <!-- post dislikes -->
        <script>
            const ctx4 = document.getElementById('postdislikes').getContext('2d');
            const labels4 = [
                @foreach ($mostDislikedPosts as $post)
                    '{{ $post->translate('ar')->title }}{{-$trip->id}}',
                @endforeach
            ];
            const data4 = {
                labels: labels4,
                datasets: [{
                    label: 'DisLikes',
                    data: [
                        @foreach ($mostDislikedPosts as $post)
                            '{{ $post->dislikes_count }}',
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            };
            const options4 = {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };
            const myChart4 = new Chart(ctx4, {
                type: 'bar', // bar - pie
                data: data4,
                options: options4,
            });
        </script>
            <!-- album likes -->
            <script>
                const ctx5 = document.getElementById('albumlikes').getContext('2d');
                const labels5 = [
                    @foreach ($mostLikedAlbums as $album)
                        '{{ $album->album_name }}{{-$album->id }}',
                    @endforeach
                ];
                const data5 = {
                    labels: labels5,
                    datasets: [{
                        label: 'Likes',
                        data: [
                            @foreach ($mostLikedAlbums as $album)
                                '{{ $album->likes_count }}',
                            @endforeach
                        ],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                        ],
                        borderWidth: 1
                    }]
                };
                const options5 = {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                };
                const myChart5 = new Chart(ctx5, {
                    type: 'bar', // bar - pie
                    data: data5,
                    options: options5,
                });
            </script>
              <!-- album dislikes -->
              <script>
                const ctx6 = document.getElementById('albumdislikes').getContext('2d');
                const labels6 = [
                    @foreach ($mostDislikedAlbums as $album)
                        '{{ $album->album_name }}{{-$album->id }}',
                    @endforeach
                ];
                const data6 = {
                    labels: labels6,
                    datasets: [{
                        label: 'DisLikes',
                        data: [
                            @foreach ($mostDislikedAlbums as $album)
                                '{{ $album->dislikes_count }}',
                            @endforeach
                        ],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                        ],
                        borderWidth: 1
                    }]
                };
                const options6 = {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                };
                const myChart6 = new Chart(ctx6, {
                    type: 'bar', // bar - pie
                    data: data6,
                    options: options6,
                });
            </script>
               <!-- trip comments -->
        <script>
            const ctx7 = document.getElementById('tripcomments').getContext('2d');
            const labels7 = [
                @foreach ($mostCommentedTrips as $trip)
                    '{{ $trip->translate('ar')->name }}{{-$trip->id}}',
                @endforeach
            ];
            const data7 = {
                labels: labels7,
                datasets: [{
                    label: 'Comments',
                    data: [
                        @foreach ($mostCommentedTrips as $trip)
                            '{{ $trip->comments_count }}',
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            };
            const options7 = {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };
            const myChart7 = new Chart(ctx7, {
                type: 'bar', // bar - pie
                data: data7,
                options: options7,
            });
        </script>
            <!-- post comment -->
            <script>
                const ctx8 = document.getElementById('postcomments').getContext('2d');
                const labels8 = [
                    @foreach ($mostCommentedPosts as $post)
                        '{{ $post->translate('ar')->title }}{{-$post->id}}',
                    @endforeach
                ];
                const data8 = {
                    labels: labels8,
                    datasets: [{
                        label: 'Comments',
                        data: [
                            @foreach ($mostCommentedPosts as $post)
                                '{{ $post->comments_count }}',
                            @endforeach
                        ],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                        ],
                        borderWidth: 1
                    }]
                };
                const options8 = {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                };
                const myChart8 = new Chart(ctx8, {
                    type: 'bar', // bar - pie
                    data: data8,
                    options: options8,
                });
            </script>
              <!-- album comments -->
              <script>
                const ctx9 = document.getElementById('albumcomments').getContext('2d');
                const labels9 = [
                    @foreach ($mostCommentedAlbums as $album)
                        '{{ $album->name }}{{-$album->id }}',
                    @endforeach
                ];
                const data9 = {
                    labels: labels9,
                    datasets: [{
                        label: 'DisLikes',
                        data: [
                            @foreach ($mostCommentedAlbums as $album)
                                '{{ $album->comments_count }}',
                            @endforeach
                        ],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                        ],
                        borderWidth: 1
                    }]
                };
                const options9 = {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                };
                const myChart9 = new Chart(ctx9, {
                    type: 'bar', // bar - pie
                    data: data9,
                    options: options9,
                });
            </script>

              <!-- users per month -->
              <script>
                const ctx10 = document.getElementById('users').getContext('2d');
                const labels10 = [
                    @foreach ($usersPerMonth as $users)
                        '{{ $users->month }}:شهر',
                    @endforeach
                ];
                const data10 = {
                    labels: labels10,
                    datasets: [{
                        label: 'Users Count',
                        data: [
                            @foreach ($usersPerMonth as $users)
                                '{{ $users->user_count }}',
                                @endforeach
                        ],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                        ],
                        borderWidth: 1
                    }]
                };
                const options10 = {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                };
                const myChart10 = new Chart(ctx10, {
                    type: 'bar', // bar - pie
                    data: data10,
                    options: options10,
                });
            </script>
            <!-- bookings per month -->
            <script>
                const ctx11 = document.getElementById('bookingspermonth').getContext('2d');
                const labels11 = [
                    @foreach ($bookingsPerMonth as $book)
                        '{{ $book->month }}:شهر',
                    @endforeach
                ];
                const data11 = {
                    labels: labels11,
                    datasets: [{
                        label: 'Bookings Count',
                        data: [
                            @foreach ($bookingsPerMonth as $users)
                                '{{ $book->booking_count }}',
                                @endforeach
                        ],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                        ],
                        borderWidth: 1
                    }]
                };
                const options11 = {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                };
                const myChart11 = new Chart(ctx11, {
                    type: 'bar', // bar - pie
                    data: data11,
                    options: options11,
                });
            </script>
            <!-- bookings per week -->
            <script>
                const ctx12 = document.getElementById('bookingsperweek').getContext('2d');
                const labels12 = [
                    @foreach ($bookingsPerWeek as $book)
                        '{{ $book->week }}:اسبوع',
                    @endforeach
                ];
                const data12 = {
                    labels: labels12,
                    datasets: [{
                        label: 'Bookings Count',
                        data: [
                            @foreach ($bookingsPerWeek as $book)
                                '{{ $book->booking_count }}',
                                @endforeach
                        ],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                        ],
                        borderWidth: 1
                    }]
                };
                const options12 = {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                };
                const myChart12 = new Chart(ctx12, {
                    type: 'bar', // bar - pie
                    data: data12,
                    options: options12,
                });
            </script>
            <!-- bookings per day -->
            <script>
                const ctx13 = document.getElementById('bookingsperday').getContext('2d');
                const labels13 = [
                    @foreach ($bookingsPerDay as $book)
                        '{{ $book->date }}:اليوم',
                    @endforeach
                ];
                const data13 = {
                    labels: labels13,
                    datasets: [{
                        label: 'Bookings Count',
                        data: [
                            @foreach ($bookingsPerDay as $users)
                                '{{ $book->booking_count }}',
                                @endforeach
                        ],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                        ],
                        borderWidth: 1
                    }]
                };
                const options13 = {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                };
                const myChart13 = new Chart(ctx13, {
                    type: 'bar', // bar - pie
                    data: data13,
                    options: options13,
                });
            </script>
            <!-- most booked trips -->
            <script>
                const ctx14 = document.getElementById('mostbookedtrips').getContext('2d');
                const labels14 = [
                    @foreach ($mostBookedTrips as $trip)
                        '{{ $trip->translate('ar')->name }}:اليوم',
                    @endforeach
                ];
                const data14 = {
                    labels: labels14,
                    datasets: [{
                        label: 'Bookings Count',
                        data: [
                            @foreach ($mostBookedTrips as $trip)
                                '{{ $trip->books_count }}',
                                @endforeach
                        ],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                        ],
                        borderWidth: 1
                    }]
                };
                const options14 = {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                };
                const myChart14 = new Chart(ctx14, {
                    type: 'bar', // bar - pie
                    data: data14,
                    options: options14,
                });
            </script>
@endsection

