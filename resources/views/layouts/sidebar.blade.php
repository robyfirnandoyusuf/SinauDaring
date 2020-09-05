<div class="sidebar" data-active-color="rose" data-background-color="black" data-image="../assets/img/sidebar-1.jpg">
    <div class="logo">
        <a href="http://www.creative-tim.com/" class="simple-text">
            Belajar Daring
        </a>
    </div>
    <div class="logo logo-mini">
        <a href="http://www.creative-tim.com/" class="simple-text">
            Ct
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="../assets/img/faces/avatar.jpg" />
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    Tania Andrew
                    <b class="caret"></b>
                </a>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li>
                            <a href="#">My Profile</a>
                        </li>
                        <li>
                            <a href="#">Edit Profile</a>
                        </li>
                        <li>
                            <a href="#">Settings</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            {{-- <li class="active">
                <a href="/">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li> --}}
             <li class="@yield('soalActive')">
                <a href="{{ route('user.soal.index') }}">
                    <i class="material-icons">books</i>
                    <p>Soal</p>
                </a>
            </li>

            <li class="@yield('scoreAnalysisActive')">
                <a href="{{ route('user.analysis.score') }}">
                    <i class="material-icons">score</i>
                    <p>Analisis Nilai</p>
                </a>
            </li>
        </ul>
    </div>
</div>