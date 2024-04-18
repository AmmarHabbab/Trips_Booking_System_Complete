<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style1.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Dashbord</title>
</head>
<body>
    @php
        $user = Auth::user();
    @endphp
    <div class="wrapper">
       
        <aside id="sidebar">
            <div class="d-flex">
                <button id="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>

                </button>
                <div class="sidebar-logo">
                    <a href="" >Dashboard</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                @if ($user->role == 'admin' || $user->role == 'cashier')
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" has-dropdown collapsed data-bs-toggle="collapse" data-bs-target="#auth1" aria-expanded="false" aria-controls="auth1">
                        <i class="lni lni-protection"></i>
                        <span>الرحلات</span>
                    </a>
                    <ul id="auth1" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        @if ($user->role == 'admin')
                        <li class="sidebar-item">
                            <a href="/dashboard/trips/create" class="sidebar-link" id="login-link">انشاء رحلة</a>
                        </li>
                        @endif
                        <li class="sidebar-item">
                            <a href="/dashboard/trips/all" class="sidebar-link" id="register-link">جميع الرحلات</a>
                        </li>
                    </ul>
                </li>
                @endif
                @if ($user->role == 'admin' || $user->role == 'cashier')
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" has-dropdown collapsed data-bs-toggle="collapse" data-bs-target="#auth2" aria-expanded="false" aria-controls="auth2">
                        <i class="lni lni-protection"></i>
                        <span>الحجوزات</span>
                    </a>
                    
                    <ul id="auth2" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/dashboard/books/all" class="sidebar-link" id="login-link">جميع الحجوزات</a>
                        </li>
                    </ul>
                </li>
                @endif
                @if ($user->role == 'admin' || $user->role == 'writer')
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" has-dropdown collapsed data-bs-toggle="collapse" data-bs-target="#auth3" aria-expanded="false" aria-controls="auth3">
                        <i class="lni lni-protection"></i>
                        <span>التصنيفات</span>
                    </a>
                    
                    <ul id="auth3" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/dashboard/categories/create" class="sidebar-link" id="login-link">انشاء تصنيف</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/dashboard/categories/all" class="sidebar-link" id="register-link">جميع التصنيفات</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" has-dropdown collapsed data-bs-toggle="collapse" data-bs-target="#auth4" aria-expanded="false" aria-controls="auth4">
                        <i class="lni lni-protection"></i>
                        <span>المنشورات</span>
                    </a>
                    
                    <ul id="auth4" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/dashboard/posts/create" class="sidebar-link" id="login-link">انشاء المنشورات</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/dashboard/posts/all" class="sidebar-link" id="register-link">جميع المنشورات</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" has-dropdown collapsed data-bs-toggle="collapse" data-bs-target="#auth6" aria-expanded="false" aria-controls="auth6">
                        <i class="lni lni-protection"></i>
                        <span>الالبومات</span>
                    </a>
                    
                    <ul id="auth6" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/dashboard/albums/create" class="sidebar-link" id="login-link">انشاء البوم</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/dashboard/albums/all" class="sidebar-link" id="register-link">جميع الالبومات</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" has-dropdown collapsed data-bs-toggle="collapse" data-bs-target="#auth7" aria-expanded="false" aria-controls="auth7">
                        <i class="lni lni-protection"></i>
                        <span>الصور</span>
                    </a>
                    
                    <ul id="auth7" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/dashboard/photos/create" class="sidebar-link" id="login-link">اضافة صور للالبوم</a>
                        </li>
                    </ul>
                </li>
                @endif
                @if ($user->role == 'admin')
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" has-dropdown collapsed data-bs-toggle="collapse" data-bs-target="#auth5" aria-expanded="false" aria-controls="auth5">
                        <i class="lni lni-protection"></i>
                        <span>المترجمين</span>
                    </a>
                    
                    <ul id="auth5" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/dashboard/translaters/create" class="sidebar-link" id="login-link">اضافة مترجم</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/dashboard/translaters/all" class="sidebar-link" id="register-link">جميع المترجمين</a>
                        </li>
                    </ul>
                </li>
                
                
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" has-dropdown collapsed data-bs-toggle="collapse" data-bs-target="#auth8" aria-expanded="false" aria-controls="auth8">
                        <i class="lni lni-protection"></i>
                        <span>الاستبيانات</span>
                    </a>
                    
                    <ul id="auth8" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/dashboard/survey/create" class="sidebar-link" id="login-link">انشاء استبيانات</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/dashboard/survies/all" class="sidebar-link" id="login-link">جميع الاستبيانات</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" has-dropdown collapsed data-bs-toggle="collapse" data-bs-target="#auth9" aria-expanded="false" aria-controls="auth9">
                        <i class="lni lni-protection"></i>
                        <span>التقييمات</span>
                    </a>
                    
                    <ul id="auth9" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/dashboard/rates/all" class="sidebar-link" id="login-link">جميع التقيممات</a>
                        </li>

                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" has-dropdown collapsed data-bs-toggle="collapse" data-bs-target="#auth10" aria-expanded="false" aria-controls="auth10">
                        <i class="lni lni-protection"></i>
                        <span>الاقتراحات</span>
                    </a>
                    
                    <ul id="auth10" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/dashboard/suggestions/all" class="sidebar-link" id="login-link">جميع الاقتراحات</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" has-dropdown collapsed data-bs-toggle="collapse" data-bs-target="#auth11" aria-expanded="false" aria-controls="auth11">
                        <i class="lni lni-protection"></i>
                        <span>المستخدمين</span>
                    </a>
                    
                    <ul id="auth11" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/dashboard/users/all" class="sidebar-link" id="login-link">جميع المستخدمين</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" has-dropdown collapsed data-bs-toggle="collapse" data-bs-target="#auth12" aria-expanded="false" aria-controls="auth12">
                        <i class="lni lni-protection"></i>
                        <span>الاحصائيات</span>
                    </a>
                    
                    <ul id="auth12" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/dashboard/charts" class="sidebar-link" id="login-link">مخططات الاحصائية</a>
                        </li>
                    </ul>
                </li>
                @endif
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" has-dropdown collapsed data-bs-toggle="collapse" data-bs-target="#auth13" aria-expanded="false" aria-controls="auth13">
                        <i class="lni lni-protection"></i>
                        <span>حجوزاتي</span>
                    </a>
                    
                    <ul id="auth13" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="/dashboard/book/user" class="sidebar-link" id="login-link">الحجوزات</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="/dashboard/coupons" class="sidebar-link" id="login-link">اكواد الحسم</a>
                        </li>
                    </ul>
                </li>
                <div class="sidebar-footer">
                   
                        <form action="/logout" method="post" class="sidebar-link">
                            @csrf
                        <i class="lni lni-exit"></i>
                        <span><button type="submit" style="border: 0;">Logout</button></span>
                    </form>
                    
                </div>
        </aside>
        <div class="main p-3">
            <div class="text-center">
                <h1>
                    Dashboard
                </h1>
            </div>
        </div>
    </div>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="/js/script.js"></script>
</body>
</html>