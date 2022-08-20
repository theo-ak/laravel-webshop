<nav class="navbar navbar-expand-lg navbar navbar-light" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">{{ __('labels.Index') }}</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#cart">{{ __('labels.Cart') }}</a>
                </li>

                @auth()
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#products">{{ __('labels.Products') }}</a></li>
                            <li><a class="dropdown-item" href="#orders">{{ __('labels.Orders') }}</a></li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="#login">{{ __('labels.Login') }}</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
